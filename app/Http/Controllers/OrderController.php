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
use Illuminate\Support\Facades\Session;

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
            'khuyen_mai' => 'nullable|string|max:255',
        ]);

        // Lấy giỏ hàng của người dùng hiện tại
        $cart = Cart::with('cartItems.san_pham', 'cartItems.color', 'cartItems.size')
            ->where('user_id', Auth::id())
            ->first();

        $cartItems = $cart->cartItems;
        $total = $cart->cartItems->sum(fn($item) => $item->price);

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

        $shippingCost = 30000;
        $totall = $total + $shippingCost;

        // Tính `newTotal` sau khi áp dụng giảm giá
        $newTotal = $coupon ? ($totall - $coupon->gia_tri_khuyen_mai) : $totall;

        // Lấy phương thức thanh toán từ request
        $paymentMethodId = $validatedData['phuong_thuc_thanh_toan'];

        // Lấy thông tin phương thức thanh toán
        $paymentMethod = phuong_thuc_thanh_toan::find($paymentMethodId);

        // Kiểm tra xem có phải phương thức thanh toán VnPay
        if ($paymentMethod->kieu_thanh_toan === 'Thanh toán online') {
            // Lưu thông tin order vào session
            Session::put('order_details', [
                'user_id' => Auth::id(),
                'khuyen_mai_id' => $validatedData['khuyen_mai'] ? $coupon->id : null,
                'ho_ten' => $user->ho_ten ?? $validatedData['ho_ten'],
                'so_dien_thoai' => $user->so_dien_thoai ?? $validatedData['so_dien_thoai'],
                'email' => $user->email ?? $validatedData['email'],
                'dia_chi' => $user->dia_chi ?? $validatedData['dia_chi'],
                'phuong_thuc_thanh_toan_id' => $validatedData['phuong_thuc_thanh_toan'],
                'phuong_thuc_van_chuyen_id' => 9,
                'ngay_tao' => now()->timezone('Asia/Ho_Chi_Minh'),
                'tong_tien' => $totall,
                'trang_thai_don_hang' => 'Chờ xác nhận',
                'trang_thai_thanh_toan' => 'Đã thanh toán'
            ]);

            // Xử lý chuyển hướng đến trang thanh toán VnPay
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://du_an_tot_nghiep.test/order/success"; // Đường dẫn xử lý kết quả thanh toán
            $vnp_TmnCode = "TQL3PNVO"; // Mã website tại VNPAY 
            $vnp_HashSecret = "SDOLTO3JSO8WXIMDIIIFMSUL9NSR39BD"; // Chuỗi bí mật

            $vnp_TxnRef = rand(00, 9999);
            $vnp_OrderInfo = 'Nội dung thanh toán';
            $vnp_OrderType = 'bill payment';
            $vnp_Amount = $totall * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            );
            // Redirect to VNPay for payment
            return redirect($vnp_Url);
        } else { // Thanh toán khi nhận hàng
            // Tạo đơn hàng mới và lưu thông tin người dùng
            $order = new don_hang();
            $order->user_id = Auth::id();
            $order->khuyen_mai_id = $validatedData['khuyen_mai'] ? $coupon->id : null;
            $order->ho_ten = $user->ho_ten ?? $validatedData['ho_ten'];
            $order->so_dien_thoai = $user->so_dien_thoai ?? $validatedData['so_dien_thoai'];
            $order->email = $user->email ?? $validatedData['email'];
            $order->dia_chi = $user->dia_chi ?? $validatedData['dia_chi'];
            $order->phuong_thuc_thanh_toan_id = $validatedData['phuong_thuc_thanh_toan'];
            $order->phuong_thuc_van_chuyen_id = 9;
            $order->ngay_tao = now()->timezone('Asia/Ho_Chi_Minh');
            $order->tong_tien = $totall;
            $order->trang_thai_don_hang = 'Chờ xác nhận';
            $order->trang_thai_thanh_toan = 'Chưa thanh toán';
            $order->save();

            // Lưu chi tiết đơn hàng từ giỏ hàng
            $orderId = $order->id;
            foreach ($cart->cartItems as $item) {
                $orderDetail = new chi_tiet_don_hang();
                $orderDetail->don_hang_id = $orderId;
                $orderDetail->san_pham_id = $item->san_pham_id;
                $orderDetail->color_san_pham_id = $item->color_san_pham_id;
                $orderDetail->size_san_pham_id = $item->size_san_pham_id;
                $orderDetail->so_luong = $item->quantity;
                $orderDetail->gia_tien = $item->price;
                $orderDetail->thanh_tien = $item->price;
                $orderDetail->save();
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            $cart->cartItems()->delete();
            $cart->delete();

            return redirect()->route('order.success_nhanhang')->with('success', 'Đặt hàng thành công!');
        }
    }

    public function success(Request $request)
    {
        $orderDetails = Session::get('order_details');

        if ($orderDetails) {
            // Tạo đơn hàng mới
            $order = new don_hang();
            $order->user_id = $orderDetails['user_id'];
            $order->khuyen_mai_id = $orderDetails['khuyen_mai_id'];
            $order->ho_ten = $orderDetails['ho_ten'];
            $order->so_dien_thoai = $orderDetails['so_dien_thoai'];
            $order->email = $orderDetails['email'];
            $order->dia_chi = $orderDetails['dia_chi'];
            $order->phuong_thuc_thanh_toan_id = $orderDetails['phuong_thuc_thanh_toan_id'];
            $order->phuong_thuc_van_chuyen_id = $orderDetails['phuong_thuc_van_chuyen_id'];
            $order->ngay_tao = $orderDetails['ngay_tao'];
            $order->tong_tien = $orderDetails['tong_tien'];
            $order->trang_thai_don_hang = 'Chờ xác nhận';
            $order->trang_thai_thanh_toan = 'Đã thanh toán';
            $order->save();

            // Lưu chi tiết đơn hàng từ giỏ hàng
            $orderId = $order->id;
            $cart = Cart::with('cartItems.san_pham', 'cartItems.color', 'cartItems.size')
                ->where('user_id', Auth::id())
                ->first();
            foreach ($cart->cartItems as $item) {
                $orderDetail = new chi_tiet_don_hang();
                $orderDetail->don_hang_id = $orderId;
                $orderDetail->san_pham_id = $item->san_pham_id;
                $orderDetail->color_san_pham_id = $item->color_san_pham_id;
                $orderDetail->size_san_pham_id = $item->size_san_pham_id;
                $orderDetail->so_luong = $item->quantity;
                $orderDetail->gia_tien = $item->price;
                $orderDetail->thanh_tien = $item->price;
                $orderDetail->save();
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            $cart->cartItems()->delete();
            $cart->delete();

            // Xóa order_details trong session
            Session::forget('order_details');

            // Redirect to order success page
            return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
        }

        return view('client.order.success');
    }
    public function success_nhanhang()
    {
        return view('client.order.success');
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $totalAmount = $request->input('totall'); // Tổng tiền trước khi áp mã

        // Kiểm tra mã giảm giá và tính toán tổng tiền mới
        $discount = 0;

        // Giả sử bạn có bảng coupon trong cơ sở dữ liệu hoặc một cách khác để kiểm tra mã giảm giá
        $coupon = khuyen_mai::where('ma_khuyen_mai', $couponCode)->first();
        $giakm = $coupon->gia_tri_khuyen_mai;

        if ($coupon) {
            // Giả sử mã giảm giá có thể là phần trăm giảm
            $discount = $totalAmount - $coupon->gia_tri_khuyen_mai;
        } else {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ!']);
        }

        // Tính tổng tiền sau khi giảm giá
        $newTotal =  $discount;

        // Trả về tổng tiền mới
        return response()->json([
            'success' => true,
            'newTotal' => number_format($newTotal, 2), // Định dạng số tiền
            'discountAmount' => number_format($giakm, 2) // Trả về số tiền giảm giá
        ]);
    }
}
