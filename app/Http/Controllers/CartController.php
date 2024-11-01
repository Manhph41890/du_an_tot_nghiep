<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\color_san_pham;
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
            'color' => 'required|array|min:1',  // Yêu cầu ít nhất 1 màu được chọn
            'quantity' => 'required|integer|min:1|max:10',
        ], [
            'san_pham_id.required' => 'Sản phẩm không hợp lệ.',
            'size_san_pham_id.required' => 'Vui lòng chọn size sản phẩm.',
            'color.required' => 'Vui lòng chọn màu sản phẩm.',
            'color.min' => 'Vui lòng chọn ít nhất một màu cho sản phẩm.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng tối thiểu là 1.',
            'quantity.max' => 'Số lượng tối đa là 10.',
        ]);

        // Lấy thông tin sản phẩm
        $sanPham = san_pham::findOrFail($validatedData['san_pham_id']);

        // Lấy user_id của người dùng hiện tại
        $userId = auth()->id();

        // Kiểm tra xem giỏ hàng của người dùng hiện tại đã tồn tại chưa
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Tạo hoặc cập nhật thông tin giỏ hàng
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('san_pham_id', $sanPham->id)
            ->where('size_san_pham_id', $validatedData['size_san_pham_id'])
            ->where('color_san_pham_id', $validatedData['color'][0]) // Lấy màu đầu tiên
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
            $cartItem->color_san_pham_id = $validatedData['color'][0]; // Lưu màu đầu tiên
            $cartItem->quantity = $validatedData['quantity'];
            $cartItem->price = $sanPham->gia_km; // Thêm giá sản phẩm vào giỏ hàng
        }

        // Lưu CartItem vào database
        $cartItem->save();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'redirect' => route('cart.index')]);
        }

        // Chuyển hướng tới trang giỏ hàng với thông báo thành công
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
    }


    // Cập nhật số lượng sản phẩm trong giỏ hàng
    // public function update(Request $request, $id)
    // {
    //     // Xác thực dữ liệu
    //     $validatedData = $request->validate([
    //         'size_san_pham_id' => 'nullable|exists:size_san_phams,id',
    //         'color' => 'nullable|array',
    //     ]);

    //     // Lấy thông tin sản phẩm trong giỏ hàng
    //     $cartItem = CartItem::findOrFail($id);

    //     // Kiểm tra xem sản phẩm có thuộc giỏ hàng của người dùng hiện tại không
    //     if ($cartItem->cart->user_id !== auth()->id()) {
    //         return redirect()->route('cart.index')->with('error', 'Bạn không có quyền sửa đổi sản phẩm này trong giỏ hàng.');
    //     }

    //     // Cập nhật thông tin
    //     $cartItem->size_san_pham_id = $validatedData['size_san_pham_id'];
    //     $cartItem->color_san_pham_id = $validatedData['color_id'][0]; // Lấy màu đầu tiên

    //     // Lưu vào database
    //     $cartItem->save();

    //     // Chuyển hướng tới trang giỏ hàng với thông báo thành công
    //     return redirect()->route('cart.index')->with('success', 'Cập nhật sản phẩm trong giỏ hàng thành công!');
    // }



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
}