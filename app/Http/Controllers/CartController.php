<?php

namespace App\Http\Controllers;

use App\Models\bien_the_san_pham;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\color_san_pham;
use App\Models\don_hang;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use App\Models\san_pham;
use App\Models\size_san_pham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Lấy giỏ hàng của người dùng hiện tại cùng với cart items và quan hệ màu sắc và kích thước
        $cart = Cart::with('cartItems.san_pham.bien_the_san_phams.size', 'cartItems.san_pham.bien_the_san_phams.color')
            ->where('user_id', Auth::id())
            ->first();

        // 
        if (!$cart) {
            return view('client.cart.index', ['cartItems' => [], 'message' => 'Giỏ hàng của bạn đang trống.']);
        }

        // Lấy cart items dựa trên cart_id
        $cartItems = $cart->cartItems;

        return view('client.cart.index', compact('cartItems'));
    }
    public function backup()
    {
        // Lấy giỏ hàng của người dùng hiện tại cùng với cart items và quan hệ màu sắc và kích thước
        $cart = Cart::with('cartItems.san_pham.bien_the_san_phams.size', 'cartItems.san_pham.bien_the_san_phams.color')
            ->where('user_id', Auth::id())
            ->first();

        // Nếu không có cart, bạn có thể xử lý như sau
        if (!$cart) {
            return view('client.cart.index', ['cartItems' => [], 'message' => 'Giỏ hàng của bạn đang trống.']);
        }

        // Lấy cart items dựa trên cart_id
        $cartItems = $cart->cartItems;

        return view('client.cart.backup', compact('cartItems'));
    }



    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'san_pham_id' => 'required|exists:san_phams,id',
            'size_san_pham_id' => 'required|exists:size_san_phams,id',
            'color' => 'required|exists:color_san_phams,id',
            'quantity' => 'required|integer|min:1|',
        ], [
            'san_pham_id.required' => 'Sản phẩm không hợp lệ.',
            'size_san_pham_id.required' => 'Vui lòng chọn size sản phẩm.',
            'color.required' => 'Vui lòng chọn màu sản phẩm.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
        ]);

        // Lấy thông tin sản phẩm
        $sanPham = san_pham::findOrFail($validatedData['san_pham_id']);

        // Lấy thông tin biến thể sản phẩm
        $variant = bien_the_san_pham::where('san_pham_id', $sanPham->id)
            ->where('size_san_pham_id', $validatedData['size_san_pham_id'])
            ->where('color_san_pham_id', $validatedData['color'])
            ->first();

        // Kiểm tra tồn kho trước khi thêm vào giỏ
        if ($variant && $variant->so_luong < $validatedData['quantity']) {
            return response()->json(['success' => false, 'message' => 'Số lượng yêu cầu vượt quá tồn kho.']);
        }


        // Lấy user_id của người dùng hiện tại
        $userId = auth()->id();

        // Kiểm tra xem giỏ hàng của người dùng hiện tại đã tồn tại chưa
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Tạo hoặc cập nhật thông tin giỏ hàng
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('san_pham_id', $sanPham->id)
            ->where('size_san_pham_id', $validatedData['size_san_pham_id'])
            ->where('color_san_pham_id', $validatedData['color'])
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $cartItem->quantity += $validatedData['quantity'];
        } else {
            // Nếu sản phẩm chưa tồn tại, tạo mới
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->san_pham_id = $sanPham->id;
            $cartItem->size_san_pham_id = $validatedData['size_san_pham_id'];
            $cartItem->color_san_pham_id = $validatedData['color'];
            $cartItem->quantity = $validatedData['quantity'];
        }

        // Tính giá cho sản phẩm khi thêm vào giỏ hàng
        $discountedPrice = $sanPham->gia_km;  // Lấy giá khuyến mãi của sản phẩm
        $variantPrice = $variant->gia;  // Lấy giá của biến thể sản phẩm


        // Tính tổng giá cho sản phẩm (giá khuyến mãi + giá biến thể) * số lượng
        $totalPrice = ($discountedPrice + $variantPrice) * $cartItem->quantity;
        $cartItem->price = $totalPrice;


        // Lưu CartItem vào database
        $cartItem->save();

        // Trả về phản hồi JSON với thông báo thành công
        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'total_price' => $totalPrice]);
    }

    // Cập nhật giỏ hàng
    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'size_san_pham_id' => 'required|exists:size_san_phams,id',
            'color_san_pham_id' => 'required|exists:color_san_phams,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy thông tin sản phẩm trong giỏ hàng
        $cartItem = CartItem::findOrFail($id);
        $oldQuantity = $cartItem->quantity;  // Số lượng cũ

        // Cập nhật size và màu trong giỏ hàng
        $cartItem->size_san_pham_id = $request->size_san_pham_id;
        $cartItem->color_san_pham_id = $request->color_san_pham_id;
        $cartItem->quantity = $request->quantity;

        // Lấy biến thể sản phẩm tương ứng
        $variant = bien_the_san_pham::where('san_pham_id', $cartItem->san_pham_id)
            ->where('size_san_pham_id', $request->size_san_pham_id)
            ->where('color_san_pham_id', $request->color_san_pham_id)
            ->first();

        if ($variant) {
            // Kiểm tra số lượng có đủ không
            $newQuantity = $request->quantity;
            $availableQuantity = $variant->so_luong; // Tổng số lượng hiện có (bao gồm số lượng cũ đã có trong giỏ)

            if ($newQuantity > $availableQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng không được vượt quá ' . $availableQuantity . ' sản phẩm còn lại.'
                ]);
            }

            // Cập nhật giá cho sản phẩm trong giỏ hàng
            $product = san_pham::find($cartItem->san_pham_id);
            $discountedPrice = $product->gia_km ?? 0;
            $cartItem->price = ($variant->gia + $discountedPrice) * $newQuantity;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Biến thể sản phẩm không tồn tại.'
            ]);
        }

        // Lưu lại thông tin giỏ hàng
        $cartItem->save();

        // Trả về phản hồi JSON thành công
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công'
        ]);
    }






    // Xóa sản phẩm khỏi giỏ hàng
    // public function removeFromCart($id)
    // {
    //     // Tìm mục trong giỏ hàng theo ID
    //     $cartItem = CartItem::find($id);

    //     // Kiểm tra xem có tìm thấy mục không
    //     if (!$cartItem) {
    //         return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng');
    //     }

    //     // Kiểm tra xem mục này có thuộc về giỏ hàng của người dùng hiện tại không
    //     $cart = Cart::where('user_id', Auth::id())->first();

    //     if ($cart && $cart->id === $cartItem->cart_id) {
    //         // Lấy thông tin biến thể sản phẩm
    //         $variant = bien_the_san_pham::where('san_pham_id', $cartItem->san_pham_id)
    //             ->where('size_san_pham_id', $cartItem->size_san_pham_id)
    //             ->where('color_san_pham_id', $cartItem->color_san_pham_id)
    //             ->first();

    //         // Nếu biến thể sản phẩm tồn tại, cập nhật lại số lượng sản phẩm trong kho
    //         if ($variant) {
    //             // Cộng lại số lượng vào bảng `bien_the_san_pham`
    //             $variant->so_luong += $cartItem->quantity;
    //             $variant->save();
    //         }

    //         // Cập nhật lại số lượng trong bảng `san_pham` (nếu cần)
    //         $product = san_pham::find($cartItem->san_pham_id);
    //         if ($product) {
    //             $product->so_luong += $cartItem->quantity;  // Cộng lại số lượng trong bảng `san_pham`
    //             $product->save();
    //         }

    //         // Xóa sản phẩm khỏi giỏ hàng
    //         $cartItem->delete();

    //         return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    //     }

    //     return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng');
    // }


    public function showCart()
    {
        // Lấy user_id của người dùng hiện tại
        $userId = auth()->id();

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            // Nếu giỏ hàng trống
            $cartItemsCount = 0;
            $insufficientStockItems = [];
        } else {
            // Lấy tất cả sản phẩm trong giỏ hàng
            $cartItems = CartItem::with(['san_pham', 'size', 'color'])
                ->where('cart_id', $cart->id)
                ->get();

            // Nhóm các sản phẩm theo `san_pham_id`
            $groupedByProduct = $cartItems->groupBy('san_pham_id');

            $cartItemsCount = 0; // Đếm tổng số sản phẩm (bao gồm biến thể)

            $insufficientStockItems = []; // Sản phẩm không đủ hàng

            foreach ($groupedByProduct as $sanPhamId => $items) {
                if ($items->count() === 1) {
                    // Nếu chỉ có 1 biến thể cho sản phẩm, tăng số lượng
                    $cartItemsCount++;
                } else {
                    // Nếu có nhiều biến thể, đếm từng biến thể
                    $uniqueVariants = $items->unique(function ($item) {
                        return $item->color_san_pham_id . '-' . $item->size_san_pham_id;
                    });

                    $cartItemsCount += $uniqueVariants->count();
                }

                // Kiểm tra tồn kho của từng biến thể
                foreach ($items as $item) {
                    $variant = bien_the_san_pham::where('san_pham_id', $item->san_pham_id)
                        ->where('color_san_pham_id', $item->color_san_pham_id)
                        ->where('size_san_pham_id', $item->size_san_pham_id)
                        ->first();

                    if ($variant && $variant->so_luong < $item->quantity) {
                        $insufficientStockItems[] = [
                            'id' => $item->id,
                            'name' => $item->san_pham->ten_san_pham,
                            'size' => $item->size->ten_size ?? 'N/A',
                            'color' => $item->color->ten_color ?? 'N/A',
                            'available_quantity' => $variant->so_luong,
                            'requested_quantity' => $item->quantity,
                        ];
                    }
                }
            }
        }

        // Trả về view với dữ liệu đã xử lý
        return view('client.partials.header', compact('cartItemsCount', 'insufficientStockItems'));
    }



    // Quá trình thanh toán
    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (!$request->has('checkout_items') || empty($request->checkout_items)) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm nào được chọn để thanh toán.');
        }

        // Lấy danh sách phương thức thanh toán
        $phuongThucThanhToans = phuong_thuc_thanh_toan::all();
        // Lấy danh sách phương thức vận chuyển
        $phuongThucVanChuyens = phuong_thuc_van_chuyen::all();

        // Lấy giỏ hàng của người dùng và chỉ lấy các sản phẩm được chọn
        $cart = Cart::with(['cartItems' => function ($query) use ($request) {
            $query->whereIn('id', $request->checkout_items);
        }, 'cartItems.san_pham.bien_the_san_phams.size', 'cartItems.san_pham.bien_the_san_phams.color'])
            ->where('user_id', Auth::id())
            ->first();

        // Kiểm tra nếu giỏ hàng trống hoặc không có sản phẩm được chọn
        if (!$cart || $cart->cartItems->isEmpty()) {
            return view('client.cart.index', ['cartItems' => [], 'message' => 'Giỏ hàng của bạn đang trống hoặc không có sản phẩm nào được chọn.']);
        }

        $cartItems = $cart->cartItems;

        // Kiểm tra số lượng hàng còn lại trước khi thanh toán
        foreach ($cartItems as $item) {
            $availableStock = optional($item->san_pham->bien_the_san_phams->firstWhere('size_san_pham_id', $item->size_san_pham_id)
                ->firstWhere('color_san_pham_id', $item->color_san_pham_id))->so_luong;
            if ($item->quantity > $availableStock) {
                return redirect()->route('cart.index')->with('error', 'Một hoặc nhiều sản phẩm trong giỏ hàng có số lượng không đủ.');
            }
        }

        // Tính tổng tiền của các sản phẩm đã chọn
        $total = $cartItems->sum(fn($item) => $item->price);
        $shippingCost = 30000; // 30,000 VND
        $totall = $total + $shippingCost;

        // Chuyển hướng về trang xác nhận đơn hàng và truyền biến vào view
        return view('client.order.index', compact('user', 'cartItems', 'cart', 'total', 'totall', 'phuongThucThanhToans', 'phuongThucVanChuyens'))
            ->with('success', 'Vui lòng xác nhận thông tin đặt hàng!');
    }


    public function updateMultiple(Request $request)
    {
        // Lấy tất cả các id sản phẩm mà người dùng đã chọn
        $selectedItems = $request->input('selected_items', []);

        // Nếu không có sản phẩm nào được chọn
        if (empty($selectedItems)) {
            return redirect()->route('cart.index')->with('message', 'Bạn chưa chọn sản phẩm nào.');
        }

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('user_id', Auth::id())->first();

        // Lấy tất cả các cart items
        $cartItems = CartItem::whereIn('id', $selectedItems)
            ->where('cart_id', $cart->id)
            ->get();

        // Tính tổng tiền của các sản phẩm đã chọn
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity; // Bạn có thể điều chỉnh cách tính tổng nếu cần
        }

        // Trả về view giỏ hàng cùng với tổng tiền
        return redirect()->route('cart.index')->with('totalPrice', $totalPrice);
    }
    public function removeMultiple(Request $request)
    {
        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (!$request->has('remove_items') || empty($request->remove_items)) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm nào được chọn để xóa.');
        }

        // Xóa tất cả các sản phẩm được chọn
        CartItem::whereIn('id', $request->remove_items)->delete();

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}