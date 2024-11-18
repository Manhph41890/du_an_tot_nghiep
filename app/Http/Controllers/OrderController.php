<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\chi_tiet_don_hang;
use App\Models\don_hang;
use App\Models\khuyen_mai;
use App\Models\lich_su_thanh_toan;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use App\Models\san_pham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function add(Request $request)
    {
        $user = Auth::user();
        // Khởi tạo biến coupon là null
        $coupon = null;
        // Kiểm tra và xác thực các trường cần thiết
        $validatedData = $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'email' => 'required|email',
            'dia_chi' => 'required|string|max:255',
            'phuong_thuc_thanh_toan' => 'required|integer|exists:phuong_thuc_thanh_toans,id',
            'khuyen_mai' => 'nullable|string|max:255',
        ]);

        // Lấy danh sách sản phẩm được chọn từ request
        $selectedProductIds = $request->input('selected_products', []);

        // Lấy giỏ hàng của người dùng và lọc các sản phẩm được chọn
        $cart = Cart::with('cartItems.san_pham.bien_the_san_phams.size', 'cartItems.san_pham.bien_the_san_phams.color')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return view('client.cart.index', ['cartItems' => [], 'message' => 'Giỏ hàng của bạn đang trống.']);
        }

        // Lọc các sản phẩm được chọn dựa trên selectedProductIds
        $cartItems = $cart->cartItems->filter(function ($item) use ($selectedProductIds) {
            return in_array($item->id, $selectedProductIds);
        });

        $total = $cart->cartItems->sum(fn($item) => $item->price);

        $discount = 0;

        if ($validatedData['khuyen_mai']) {
            $coupon = khuyen_mai::where('ma_khuyen_mai', $validatedData['khuyen_mai'])
                ->where('ngay_bat_dau', '<=', now())
                ->where('ngay_ket_thuc', '>=', now())
                ->first();

            if ($coupon) {
                // Kiểm tra xem người dùng đã sử dụng mã này chưa
                $alreadyUsed = DB::table('coupon_usages')
                    ->where('user_id', $user->id)
                    ->where('coupon_id', $coupon->id)
                    ->exists();

                if ($alreadyUsed) {
                    return redirect()->back()->with('error', 'Bạn đã sử dụng mã giảm giá này trước đó.');
                }

                // Áp dụng giảm giá
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
        if ($paymentMethod->kieu_thanh_toan === 'Thanh toán bằng Vnpay') {
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
                'tong_tien' => $totall, // Sử dụng tổng tiền đã tính trước
                'trang_thai_don_hang' => 'Chờ xác nhận',
                'trang_thai_thanh_toan' => 'Đã thanh toán'
            ]);

            // Xử lý chuyển hướng đến trang thanh toán VnPay
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/order/success"; // Đường dẫn xử lý kết quả thanh toán
            $vnp_TmnCode = "TQL3PNVO"; // Mã website tại VNPAY 
            $vnp_HashSecret = "SDOLTO3JSO8WXIMDIIIFMSUL9NSR39BD"; // Chuỗi bí mật

            $vnp_TxnRef = rand(00, 9999);
            Session::put('vnp_TxnRef', $vnp_TxnRef); // Lưu vào session
            $vnp_OrderInfo = 'Nội dung thanh toán';
            $vnp_OrderType = 'bill payment';
            $vnp_Amount = round($totall * 100);
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
            // return redirect()->route('order.success');
        } elseif ($paymentMethod->kieu_thanh_toan === 'Thanh toán bằng Ví') {
            //
            return redirect()->route('order.success');
        } else {

            // Thanh toán khi nhận hàng
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
                $orderDetail->gia_tien = $item->san_pham->gia_km ?? $item->san_pham->gia_ban;
                $orderDetail->thanh_tien = $item->price;
                $orderDetail->save();
            }
            if ($coupon) {
                DB::table('coupon_usages')->insert([
                    'user_id' => $user->id,
                    'coupon_id' => $coupon->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


            // Giảm số lượng mã khuyến mãi
            if ($coupon) {
                $coupon->so_luong_ma -= 1;
                $coupon->save();
            }

            $variant = $item->san_pham->bien_the_san_phams()->where('color_san_pham_id', $item->color_san_pham_id)
                ->where('size_san_pham_id', $item->size_san_pham_id)
                ->first();

            if ($variant) {
                // Giảm số lượng của biến thể sản phẩm
                $variant->so_luong -= $item->quantity;
                $variant->save();
            }
            // Trừ số lượng sản phẩm trong kho
            $product = san_pham::find($item->san_pham_id);
            if ($product) {
                $product->so_luong -= $item->quantity;  // Trừ số lượng sản phẩm
                $product->save();
            }

            Mail::send('auth.success_order', [
                'ho_ten' => $user->ho_ten,
                'order' => $order,
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Đặt hàng thành công');
            });

            // Xóa giỏ hàng sau khi đặt hàng thành công
            $cart->cartItems()->delete();
            $cart->delete();

            // Gửi email với mã xác thực


            return redirect()->route('order.success_nhanhang')->with('success', 'Đặt hàng thành công!');
        }
    }

    public function success(Request $request)
    {
        // Lấy thông tin từ session
        $user = Auth::user();
        $orderDetails = Session::get('order_details');
        $vnp_TxnRef = Session::get('vnp_TxnRef');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');

        if ($vnp_ResponseCode == '00' && $orderDetails) { // '00' là mã giao dịch thành công
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
            $order->ngay_tao = now()->timezone('Asia/Ho_Chi_Minh');
            $order->tong_tien = $orderDetails['tong_tien'];
            $order->trang_thai_don_hang = 'Chờ xác nhận';
            $order->trang_thai_thanh_toan = 'Đã thanh toán';
            $order->save();

            // Lưu chi tiết đơn hàng
            $cart = Cart::with('cartItems')->where('user_id', Auth::id())->first();
            if ($cart) {
                foreach ($cart->cartItems as $item) {
                    $orderDetail = new chi_tiet_don_hang();
                    $orderDetail->don_hang_id = $order->id;
                    $orderDetail->san_pham_id = $item->san_pham_id;
                    $orderDetail->color_san_pham_id = $item->color_san_pham_id;
                    $orderDetail->size_san_pham_id = $item->size_san_pham_id;
                    $orderDetail->so_luong = $item->quantity;
                    $orderDetail->gia_tien = $item->san_pham->gia_km ?? $item->san_pham->gia_ban;
                    $orderDetail->thanh_tien = $item->price;
                    $orderDetail->save();

                    $variant = $item->san_pham->bien_the_san_phams()
                        ->where('color_san_pham_id', $item->color_san_pham_id)
                        ->where('size_san_pham_id', $item->size_san_pham_id)
                        ->first();
                    if ($variant) {
                        $variant->so_luong -= $item->quantity;
                        $variant->save();
                    }

                    $product = san_pham::find($item->san_pham_id);
                    if ($product) {
                        $product->so_luong -= $item->quantity;
                        $product->save();
                    }
                }
                $coupon = null;
                if ($coupon) {
                    DB::table('coupon_usages')->insert([
                        'user_id' => $user->id,
                        'coupon_id' => $coupon->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Giảm số lượng mã khuyến mãi
                if ($coupon) {
                    $coupon->so_luong_ma -= 1;
                    $coupon->save();
                }

                $variant = $item->san_pham->bien_the_san_phams()->where('color_san_pham_id', $item->color_san_pham_id)
                    ->where('size_san_pham_id', $item->size_san_pham_id)
                    ->first();

                if ($variant) {
                    // Giảm số lượng của biến thể sản phẩm
                    $variant->so_luong -= $item->quantity;
                    $variant->save();
                }
                // Trừ số lượng sản phẩm trong kho
                $product = san_pham::find($item->san_pham_id);
                if ($product) {
                    $product->so_luong -= $item->quantity;  // Trừ số lượng sản phẩm
                    $product->save();
                }


                // Xóa giỏ hàng
                $cart->cartItems()->delete();
                $cart->delete();

                // Lưu thông tin lịch sử thanh toán vào bảng lich_su_thanh_toan
                DB::table('lich_su_thanh_toans')->insert([
                    'don_hang_id' => $order->id,
                    'vnp_TxnRef_id' => $vnp_TxnRef,
                    'vnp_ngay_tao' => now()->timezone('Asia/Ho_Chi_Minh'),
                    'vnp_tong_tien' => $order->tong_tien,
                    'trang_thai' => 'Thanh toán thành công',
                ]);

                Mail::send('auth.success_order', [
                    'ho_ten' => $user->ho_ten,
                    'order' => $order,
                ], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Đặt hàng thành công');
                });
            }

            Session::forget(['order_details', 'vnp_TxnRef']);

            return redirect()->route('order.success_nhanhang')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được tạo.');
        }

        return redirect()->route('client.cart.index')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
    }

    public function success_vi(Request $request)
    {
        // Lấy thông tin từ session
        $user = Auth::user();
        $orderDetails = Session::get('order_details');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');

        if ($vnp_ResponseCode == '00' && $orderDetails) { // '00' là mã giao dịch thành công
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
            $order->ngay_tao = now()->timezone('Asia/Ho_Chi_Minh');
            $order->tong_tien = $orderDetails['tong_tien'];
            $order->trang_thai_don_hang = 'Chờ xác nhận';
            $order->trang_thai_thanh_toan = 'Đã thanh toán';
            $order->save();

            // Lưu chi tiết đơn hàng
            $cart = Cart::with('cartItems')->where('user_id', Auth::id())->first();
            if ($cart) {
                foreach ($cart->cartItems as $item) {
                    $orderDetail = new chi_tiet_don_hang();
                    $orderDetail->don_hang_id = $order->id;
                    $orderDetail->san_pham_id = $item->san_pham_id;
                    $orderDetail->color_san_pham_id = $item->color_san_pham_id;
                    $orderDetail->size_san_pham_id = $item->size_san_pham_id;
                    $orderDetail->so_luong = $item->quantity;
                    $orderDetail->gia_tien = $item->san_pham->gia_km ?? $item->san_pham->gia_ban;
                    $orderDetail->thanh_tien = $item->price;
                    $orderDetail->save();

                    $variant = $item->san_pham->bien_the_san_phams()
                        ->where('color_san_pham_id', $item->color_san_pham_id)
                        ->where('size_san_pham_id', $item->size_san_pham_id)
                        ->first();
                    if ($variant) {
                        $variant->so_luong -= $item->quantity;
                        $variant->save();
                    }

                    $product = san_pham::find($item->san_pham_id);
                    if ($product) {
                        $product->so_luong -= $item->quantity;
                        $product->save();
                    }
                }
                $coupon = null;
                if ($coupon) {
                    DB::table('coupon_usages')->insert([
                        'user_id' => $user->id,
                        'coupon_id' => $coupon->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Giảm số lượng mã khuyến mãi
                if ($coupon) {
                    $coupon->so_luong_ma -= 1;
                    $coupon->save();
                }

                $variant = $item->san_pham->bien_the_san_phams()->where('color_san_pham_id', $item->color_san_pham_id)
                    ->where('size_san_pham_id', $item->size_san_pham_id)
                    ->first();

                if ($variant) {
                    // Giảm số lượng của biến thể sản phẩm
                    $variant->so_luong -= $item->quantity;
                    $variant->save();
                }
                // Trừ số lượng sản phẩm trong kho
                $product = san_pham::find($item->san_pham_id);
                if ($product) {
                    $product->so_luong -= $item->quantity;  // Trừ số lượng sản phẩm
                    $product->save();
                }


                // Xóa giỏ hàng
                $cart->cartItems()->delete();
                $cart->delete();

                // Lưu thông tin lịch sử thanh toán vào bảng lich_su_thanh_toan
                DB::table('lich_su_thanh_toans')->insert([
                    'don_hang_id' => $order->id,
                    'vnp_TxnRef_id' => rand(''),
                    'vnp_ngay_tao' => now()->timezone('Asia/Ho_Chi_Minh'),
                    'vnp_tong_tien' => $order->tong_tien,
                    'trang_thai' => 'Thanh toán thành công',
                ]);

                Mail::send('auth.success_order', [
                    'ho_ten' => $user->ho_ten,
                    'order' => $order,
                ], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Đặt hàng thành công');
                });
            }

            Session::forget(['order_details']);

            return redirect()->route('order.success_nhanhang')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được tạo.');
        }

        return redirect()->route('client.cart.index')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
    }

    public function success_nhanhang()
    {
        return view('client.order.success_nhanhang');
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code'); // Mã giảm giá người dùng nhập
        $totalAmount = $request->input('totall'); // Tổng tiền trước khi áp mã giảm giá

        $userId = Auth::id(); // Lấy ID người dùng đang đăng nhập

        // 1. Tìm mã giảm giá trong cơ sở dữ liệu
        $coupon = khuyen_mai::where('ma_khuyen_mai', $couponCode)->first();

        if (!$coupon) {
            // Nếu mã giảm giá không tồn tại
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ!']);
        }

        // 2. Kiểm tra ngày hết hạn của mã giảm giá
        $currentDate = now(); // Lấy thời gian hiện tại

        if ($coupon->ngay_ket_thuc && $currentDate->greaterThan($coupon->ngay_ket_thuc)) {
            // Nếu mã giảm giá đã hết hạn
            return response()->json(['success' => false, 'message' => 'Mã giảm giá đã hết hạn!']);
        }

        // 3. Kiểm tra xem người dùng đã sử dụng mã này chưa
        $usedCoupon = DB::table('coupon_usages')
            ->where('user_id', $userId)
            ->where('coupon_id', $coupon->id)
            ->exists();

        if ($usedCoupon) {
            // Nếu người dùng đã sử dụng mã này
            return response()->json(['success' => false, 'message' => 'Bạn đã sử dụng mã giảm giá này rồi!']);
        }

        // 4. Tính toán số tiền giảm giá
        $discountAmount = min($coupon->gia_tri_khuyen_mai, $totalAmount); // Giảm tối đa đến tổng tiền
        $newTotal = max(0, $totalAmount - $discountAmount); // Tổng tiền mới sau khi giảm (không âm)

        return response()->json([
            'success' => true,
            'newTotal' => number_format($newTotal, 2), // Tổng tiền mới
            'discountAmount' => number_format($discountAmount, 2), // Số tiền giảm giá
            'message' => 'Áp dụng mã giảm giá thành công!',
        ]);
    }
}
