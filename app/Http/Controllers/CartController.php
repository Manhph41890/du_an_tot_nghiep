<?php

namespace App\Http\Controllers;

use App\Models\san_pham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $title = "";
        return view('client.cart.index', compact('cart', 'title'));
    }
    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)

    {
        $productId = $request->input('san_pham_id');
        $so_luong = $request->input('so_luong', 1);
        $product = san_pham::find($productId);

        if ($product) {
            $cart = Session::get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['so_luong'] += $so_luong;
            } else {
                $cart[$productId] = [
                    'id' => $product->id,
                    'ten_san_pham' => $product->ten_san_pham,
                    'gia_km' => $product->gia_km,
                    'anh_san_pham' => $product->anh_san_pham,
                    'so_luong' => $so_luong,
                ];
            }
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Thêm giỏ hàng thành công!');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('san_pham_id');

        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);

        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm
            Session::put('cart', $cart); // Cập nhật giỏ hàng trong session
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
}
