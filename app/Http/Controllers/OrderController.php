<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\chi_tiet_don_hang;
use App\Models\don_hang;
use App\Models\khuyen_mai;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function add(Request $request)
    {
        $user = Auth::user();
        // Kiểm tra và xác thực các trường cần thiết
        $validatedData = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'email' => 'required|email',
            'dia_chi' => 'required|string|max:255',
            'phuong_thuc_thanh_toan' => 'required|integer|exists:phuong_thuc_thanh_toans,id',
            'phuong_thuc_van_chuyen' => 'required|integer|exists:phuong_thuc_van_chuyens,id',
            'khuyen_mai' => 'nullable|string|max:255',
        ]);

        // Lấy giỏ hàng của người dùng hiện tại
        $cart = Cart::with('cartItems.san_pham', 'cartItems.color', 'cartItems.size')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = 0; // Khởi tạo biến tổng
        foreach ($cart->cartItems as $item) {
            $total += $item->price * $item->quantity; // Cộng dồn giá trị cho mỗi mặt hàng
        }
        $discount = 0;

        if ($validatedData['khuyen_mai']) {
            $coupon = khuyen_mai::where('ma_khuyen_mai', $validatedData['khuyen_mai'])
                ->where('ngay_bat_dau', '<=', now())
                ->where('ngay_ket_thuc', '>=', now())
                ->first();

            if ($coupon) {
                $discount = $coupon->gia_tri_khuyen_mai;
                $total -= $discount;
            } else {
                return redirect()->back()->with('error', 'Mã khuyến mãi không hợp lệ hoặc đã hết hạn.');
            }
        }

        $shippingMethod = phuong_thuc_van_chuyen::find($validatedData['phuong_thuc_van_chuyen']);
        $shippingCost = $shippingMethod ? $shippingMethod->gia_ship : 0;

        // Trừ phí vận chuyển vào tổng tiền
        $total += $shippingCost;


        // Tạo đơn hàng mới và lưu thông tin người dùng
        $order = new don_hang();
        $order->user_id = Auth::id();
        $order->khuyen_mai_id = $validatedData['khuyen_mai'] ? $coupon->id : null;
        $order->ho_ten = $user->ho_ten ?? $validatedData['ho_ten'];
        $order->so_dien_thoai = $user->so_dien_thoai ?? $validatedData['so_dien_thoai'];
        $order->email = $user->email ?? $validatedData['email'];
        $order->dia_chi = $user->dia_chi ?? $validatedData['dia_chi'];
        $order->phuong_thuc_thanh_toan_id = $validatedData['phuong_thuc_thanh_toan'];
        $order->phuong_thuc_van_chuyen_id = $validatedData['phuong_thuc_van_chuyen'];
        $order->ngay_tao = now();
        $order->tong_tien = $total;
        $order->trang_thai = 'Chờ xác nhận';
        $order->save();

        // Lưu chi tiết đơn hàng từ giỏ hàng
        foreach ($cart->cartItems as $item) {
            $orderDetail = new chi_tiet_don_hang();
            $orderDetail->don_hang_id = $order->id; // Gán ID đơn hàng
            $orderDetail->san_pham_id = $item->san_pham_id;
            $orderDetail->color_san_pham_id = $item->color_san_pham_id; // Gán ID màu cho chi tiết đơn hàng
            $orderDetail->size_san_pham_id = $item->size_san_pham_id; // Gán ID size cho chi tiết đơn hàng
            $orderDetail->so_luong = $item->quantity; // Gán số lượng
            $orderDetail->gia_tien = $item->price; // Gán giá tiền
            $orderDetail->thanh_tien = $orderDetail->so_luong * $orderDetail->gia_tien; // Tính thành tiền
            $orderDetail->save(); // Lưu chi tiết đơn hàng
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        $cart->cartItems()->delete();
        $cart->delete();

        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }

    public function success()
    {
        return view('client.order.success');
    }

    public function validateCoupon(Request $request)
    {
        $code = $request->input('code');

        $coupon = khuyen_mai::where('ma_khuyen_mai', $code)
            ->where('ngay_bat_dau', '<=', now())
            ->where('ngay_ket_thuc', '>=', now())
            ->first();

        if ($coupon) {
            return response()->json([
                'success' => true,
                'discount' => $coupon->gia_tri_khuyen_mai
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
