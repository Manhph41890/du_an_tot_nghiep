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

        // Nếu không có cart, bạn có thể xử lý như sau
        if (!$cart) {
            return view('client.cart.index', ['cartItems' => [], 'message' => 'Giỏ hàng của bạn đang trống.']);
        }

        // Lấy cart items dựa trên cart_id
        $cartItems = $cart->cartItems;

        return view('client.cart.index', compact('cartItems'));
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

        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'Biến thể sản phẩm không hợp lệ.']);
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






    public function update(Request $request, $id)
    {
        $request->validate([
            'size_san_pham_id' => 'required|exists:size_san_phams,id',
            'color_san_pham_id' => 'required|exists:color_san_phams,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->size_san_pham_id = $request->size_san_pham_id;
        $cartItem->color_san_pham_id = $request->color_san_pham_id;
        $cartItem->quantity = $request->quantity;

        $variant = bien_the_san_pham::where('san_pham_id', $cartItem->san_pham_id)
            ->where('size_san_pham_id', $request->size_san_pham_id)
            ->where('color_san_pham_id', $request->color_san_pham_id)
            ->first();

        if ($variant) {
            if ($request->quantity > $variant->so_luong) {
                return back()->withErrors(['quantity' => 'Số lượng không được vượt quá ' . $variant->so_luong . ' sản phẩm.']);
            }

            $product = san_pham::find($cartItem->san_pham_id);
            $discountedPrice = $product->gia_km ?? 0;
            $cartItem->price = ($variant->gia + $discountedPrice) * $request->quantity;
        } else {
            return back()->with('error', 'Biến thể sản phẩm không tồn tại.');
        }

        $cartItem->save();

        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật thành công!');
    }
    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        // Tìm mục trong giỏ hàng theo ID
        $cartItem = CartItem::find($id);

        // Kiểm tra xem có tìm thấy mục không
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng');
        }

        // Kiểm tra xem mục này có thuộc về giỏ hàng của người dùng hiện tại không
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart && $cart->id === $cartItem->cart_id) {
            // Nếu thuộc về giỏ hàng của người dùng, xóa mục
            $cartItem->delete();

            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        }

        return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng');
    }
    public function showCart()
    {
        // Lấy user_id của người dùng hiện tại
        $userId = auth()->id();

        // Lấy cart của người dùng hiện tại
        $cart = Cart::where('user_id', $userId)->first();

        // Nếu không có giỏ hàng, số lượng sản phẩm sẽ là 0
        if (!$cart) {
            $cartItemsCount = 0;
        } else {
            // Đếm số lượng sản phẩm khác nhau trong giỏ hàng
            $cartItemsCount = CartItem::where('cart_id', $cart->id)
                ->distinct('san_pham_id')
                ->count('san_pham_id');
        }

        return view('client.partials.header', compact('cartItemsCount'));
    }

    // Quá trình thanh toán
    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Lấy danh sách phương thức thanh toán
        $phuongThucThanhToans = phuong_thuc_thanh_toan::all();
        // Lấy danh sách phương thức vận chuyển
        $phuongThucVanChuyens = phuong_thuc_van_chuyen::all();

        // Lấy giỏ hàng của người dùng
        $cart = Cart::with('cartItems.san_pham.bien_the_san_phams.size', 'cartItems.san_pham.bien_the_san_phams.color')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return view('client.cart.index', ['cartItems' => [], 'message' => 'Giỏ hàng của bạn đang trống.']);
        }

        $cartItems = $cart->cartItems;
        $total = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);

        $shippingCost = 30000; // 30,000 VND

        // Trừ phí vận chuyển vào tổng tiền 
        $totall = $total + $shippingCost;

        // Chuyển hướng về trang xác nhận đơn hàng và truyền biến $user vào view
        return view('client.order.index', compact('user', 'cart', 'total', 'totall', 'phuongThucThanhToans', 'phuongThucVanChuyens'))->with('success', 'Đặt hàng thành công!');
    }
}