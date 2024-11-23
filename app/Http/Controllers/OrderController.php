<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\CartItem;
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
use Illuminate\Support\Facades\Log;
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
            'cart_items' => 'required|array',
            'cart_items.*.san_pham_id' => 'required|exists:san_phams,id',
            'cart_items.*.variant_id' => 'nullable|exists:bien_the_san_phams,id',
            'cart_items.*.size_id' => 'nullable|exists:size_san_phams,id',
            'cart_items.*.color_id' => 'nullable|exists:color_san_phams,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
            'cart_items.*.price' => 'required|numeric|min:0',
            'totall' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        $totall = $request->totall;
        $total = $request->total;

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
                $discount = $coupon->gia_tri_khuyen_mai;
                $total -= $discount;
                // Áp dụng giảm giá
            } else {
                return redirect()->back()->with('error', 'Mã khuyến mãi không hợp lệ hoặc đã hết hạn.');
            }
        }

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
                'ho_ten' => $validatedData['ho_ten'],
                'so_dien_thoai' => $validatedData['so_dien_thoai'],
                'email' => $validatedData['email'],
                'dia_chi' => $validatedData['dia_chi'],
                'phuong_thuc_thanh_toan_id' => $validatedData['phuong_thuc_thanh_toan'],
                'phuong_thuc_van_chuyen_id' => 9,
                'ngay_tao' => now()->timezone('Asia/Ho_Chi_Minh'),
                'tong_tien' => $totall,
                'trang_thai_don_hang' => 'Chờ xác nhận',
                'trang_thai_thanh_toan' => 'Đã thanh toán',
                'cart_items' => $validatedData['cart_items'],
                'khuyen_mai' => $validatedData['khuyen_mai'],
                'total' => $validatedData['total'],
                'totall' => $validatedData['totall'],
            ]);

            // Xử lý chuyển hướng đến trang thanh toán VnPay
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/order/success"; // Đường dẫn xử lý kết quả thanh toán
            $vnp_TmnCode = "LA4W2ILI"; // Mã website tại VNPAY 
            $vnp_HashSecret = "N63WYTF57CWU6R33CWZASHLS64RMKS2H"; // Chuỗi bí mật

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
            Log::info('VNPAY redirect URL: ' . $vnp_Url);

            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            );

            // Redirect to VNPay for payment
            return redirect($returnData['data']);
            // return redirect()->route('order.success');
        } elseif ($paymentMethod->kieu_thanh_toan === 'Thanh toán bằng Ví') {

            // dd($user->vi_nguoi_dungs->tong_tien);

            // Kiểm tra số dư trong ví
            if ($user->vi_nguoi_dungs->tong_tien < $totall) {
                return redirect()->back()->withErrors(['message' => 'Tiền trong tài khoản không đủ để thanh toán.']);
            }
            $order = new don_hang();
            $order->user_id = Auth::id();
            $order->khuyen_mai_id = $validatedData['khuyen_mai'] ? $coupon->id : null;
            $order->ho_ten = $validatedData['ho_ten'];
            $order->so_dien_thoai = $validatedData['so_dien_thoai'];
            $order->email = $validatedData['email'];
            $order->dia_chi = $validatedData['dia_chi'];
            $order->phuong_thuc_thanh_toan_id = $validatedData['phuong_thuc_thanh_toan'];
            $order->phuong_thuc_van_chuyen_id = 9;
            $order->ngay_tao = now()->timezone('Asia/Ho_Chi_Minh');
            $order->tong_tien =  $totall;
            $order->trang_thai_don_hang = 'Chờ xác nhận';
            $order->trang_thai_thanh_toan = 'Chưa thanh toán';
            $order->save();


            $cartItemsToDelete = $validatedData['cart_items']; // Mảng chứa các sản phẩm trong giỏ

            // Lưu chi tiết đơn hàng từ giỏ hàng
            foreach ($validatedData['cart_items'] as $item) {
                chi_tiet_don_hang::create([
                    'don_hang_id' => $order->id,
                    'san_pham_id' => $item['san_pham_id'],
                    'size_san_pham_id' => $item['size_id'] ?? null,
                    'color_san_pham_id' => $item['color_id'] ?? null,
                    'so_luong' => $item['quantity'],
                    'gia_tien' => $item['price'],
                    'thanh_tien' => $total,

                ]);
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

                $sanPham = san_pham::find($item['san_pham_id']);
                $variant = $sanPham->bien_the_san_phams()
                    ->where('color_san_pham_id', $item['color_id'])
                    ->where('size_san_pham_id', $item['size_id'])
                    ->first();


                if ($variant) {
                    // Giảm số lượng của biến thể sản phẩm
                    $variant->so_luong -= $item['quantity'];
                    $variant->save();
                }
                // Trừ số lượng sản phẩm trong kho
                $product = san_pham::find($item['san_pham_id']);
                if ($product) {
                    $product->so_luong -= $item['quantity'];  // Trừ số lượng sản phẩm
                    $product->save();
                }
            }
            // Lưu thông tin lịch sử thanh toán vào bảng lich_su_thanh_toan
            DB::table('lich_su_thanh_toans')->insert([
                'don_hang_id' => $order->id,
                'vnp_TxnRef_id' => rand(00, 9999),
                'vnp_ngay_tao' => now()->timezone('Asia/Ho_Chi_Minh'),
                'vnp_tong_tien' => $order->tong_tien,
                'trang_thai' => 'Thanh toán thành công',
            ]);

            $user->vi_nguoi_dungs->update([
                'tong_tien' => $user->vi_nguoi_dungs->tong_tien - $totall,
            ]);

            // Lưu thông tin lịch sử thanh toán vào bảng ls_thanh_toan_vi
            DB::table('ls_thanh_toan_vis')->insert([
                'don_hang_id' => $order->id,
                'vi_nguoi_dung_id' => $user->vi_nguoi_dungs->id,
                'thoi_gian_thanh_toan' => now()->timezone('Asia/Ho_Chi_Minh'),
                'tien_thanh_toan' => $totall,
                'trang_thai' => 'Thành công',
            ]);

            // Gửi email với mã xác thực
            Mail::send('auth.success_order', [
                'ho_ten' => $user->ho_ten,
                'order' => $order,
            ], function ($message) use ($order) {
                $message->to($order->email)
                    ->subject('Đặt hàng thành công');
            });

            Mail::send('auth.success_order', [
                'ho_ten' => $user->ho_ten,
                'order' => $order,
            ], function ($message) use ($order) {
                $message->to($order->email)
                    ->subject('Đặt hàng thành công');
            });

            // Xóa giỏ hàng sau khi đặt hàng thành công
            // Xóa giỏ hàng sau khi đặt hàng thành công
            foreach ($cartItemsToDelete as $item) {
                CartItem::where('san_pham_id', $item['san_pham_id'])
                    ->where('color_san_pham_id', $item['color_id'])
                    ->where('size_san_pham_id', $item['size_id'])
                    ->delete();
            }

            return redirect()->route('order.success_nhanhang')->with('success', 'Đặt hàng thành công!');
        } else {

            // Thanh toán khi nhận hàng
            // Tạo đơn hàng mới và lưu thông tin người dùng
            $order = new don_hang();
            $order->user_id = Auth::id();
            $order->khuyen_mai_id = $validatedData['khuyen_mai'] ? $coupon->id : null;
            $order->ho_ten = $validatedData['ho_ten'];
            $order->so_dien_thoai = $validatedData['so_dien_thoai'];
            $order->email = $validatedData['email'];
            $order->dia_chi = $validatedData['dia_chi'];
            $order->phuong_thuc_thanh_toan_id = $validatedData['phuong_thuc_thanh_toan'];
            $order->phuong_thuc_van_chuyen_id = 9;
            $order->ngay_tao = now()->timezone('Asia/Ho_Chi_Minh');
            $order->tong_tien =  $totall;
            $order->trang_thai_don_hang = 'Chờ xác nhận';
            $order->trang_thai_thanh_toan = 'Chưa thanh toán';
            $order->save();


            $cartItemsToDelete = $validatedData['cart_items']; // Mảng chứa các sản phẩm trong giỏ

            // Lưu chi tiết đơn hàng từ giỏ hàng
            foreach ($validatedData['cart_items'] as $item) {
                chi_tiet_don_hang::create([
                    'don_hang_id' => $order->id,
                    'san_pham_id' => $item['san_pham_id'],
                    'size_san_pham_id' => $item['size_id'] ?? null,
                    'color_san_pham_id' => $item['color_id'] ?? null,
                    'so_luong' => $item['quantity'],
                    'gia_tien' => $item['price'],
                    'thanh_tien' => $total,

                ]);
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

                $sanPham = san_pham::find($item['san_pham_id']);
                $variant = $sanPham->bien_the_san_phams()
                    ->where('color_san_pham_id', $item['color_id'])
                    ->where('size_san_pham_id', $item['size_id'])
                    ->first();


                if ($variant) {
                    // Giảm số lượng của biến thể sản phẩm
                    $variant->so_luong -= $item['quantity'];
                    $variant->save();
                }
                // Trừ số lượng sản phẩm trong kho
                $product = san_pham::find($item['san_pham_id']);
                if ($product) {
                    $product->so_luong -= $item['quantity'];  // Trừ số lượng sản phẩm
                    $product->save();
                }
            }

            Mail::send('auth.success_order', [
                'ho_ten' => $user->ho_ten,
                'order' => $order,
            ], function ($message) use ($order) {
                $message->to($order->email)
                    ->subject('Đặt hàng thành công');
            });

            // Xóa giỏ hàng sau khi đặt hàng thành công
            // Xóa giỏ hàng sau khi đặt hàng thành công
            foreach ($cartItemsToDelete as $item) {
                CartItem::where('san_pham_id', $item['san_pham_id'])
                    ->where('color_san_pham_id', $item['color_id'])
                    ->where('size_san_pham_id', $item['size_id'])
                    ->delete();
            }

            // Gửi email với mã xác thực


            return redirect()->route('order.success_nhanhang')->with('success', 'Đặt hàng thành công!');
        }
    }

    public function success(Request $request)
    {
        Log::info($request->all());
        // Lấy thông tin từ session
        $user = Auth::user();
        $orderDetails = Session::get('order_details');
        // $orderDetails = Session::get('order_details');
        $vnp_TxnRef = Session::get('vnp_TxnRef');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');

        // Đảm bảo session không rỗng
        if (!$vnp_TxnRef) {
            Log::error('Thanh toán thất bại với mã phản hồi:', ['response_code' => $vnp_ResponseCode]);
        }
        if ($vnp_ResponseCode === '00') { // '00' là mã giao dịch thành công
            // Tạo đơn hàng mới
            $total = $orderDetails['total'];
            $totall = $orderDetails['totall'];

            $discount = 0;
            if ($orderDetails['khuyen_mai']) {
                $coupon = khuyen_mai::where('ma_khuyen_mai', $orderDetails['khuyen_mai'])
                    ->where('ngay_bat_dau', '<=', now())
                    ->where('ngay_ket_thuc', '>=', now())
                    ->first();

                if ($coupon) {
                    $alreadyUsed = DB::table('coupon_usages')
                        ->where('user_id', $user->id)
                        ->where('coupon_id', $coupon->id)
                        ->exists();

                    if ($alreadyUsed) {
                        return redirect()->back()->with('error', 'Bạn đã sử dụng mã giảm giá này trước đó.');
                    }
                    $discount = $coupon->gia_tri_khuyen_mai;
                    $total -= $discount;
                    if ($coupon) {
                        DB::table('coupon_usages')->insert([
                            'user_id' => $user->id,
                            'coupon_id' => $coupon->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }


                    if ($coupon) {
                        $coupon->so_luong_ma -= 1;
                        $coupon->save();
                    }
                } else {
                    return redirect()->back()->with('error', 'Mã khuyến mãi không hợp lệ hoặc đã hết hạn.');
                }
            }
            $order = new don_hang();
            $order->user_id = $user->id;
            $order->khuyen_mai_id = $orderDetails['khuyen_mai'] ? $coupon->id : null;
            $order->ho_ten = $orderDetails['ho_ten'];
            $order->so_dien_thoai = $orderDetails['so_dien_thoai'];
            $order->email = $orderDetails['email'];
            $order->dia_chi = $orderDetails['dia_chi'];
            $order->phuong_thuc_thanh_toan_id = $orderDetails['phuong_thuc_thanh_toan_id'];
            $order->phuong_thuc_van_chuyen_id = 9;
            $order->ngay_tao = now()->timezone('Asia/Ho_Chi_Minh');
            $order->tong_tien =  $orderDetails['tong_tien'];
            $order->trang_thai_don_hang = $orderDetails['trang_thai_don_hang'];
            $order->trang_thai_thanh_toan = $orderDetails['trang_thai_thanh_toan'];
            $order->save();


            $cartItemsToDelete = $orderDetails['cart_items']; // Mảng chứa các sản phẩm trong giỏ tuwg hàm add ở trên nhé!

            // Lưu chi tiết đơn hàng từ giỏ hàng
            foreach ($orderDetails['cart_items'] as $item) {
                chi_tiet_don_hang::create([
                    'don_hang_id' => $order->id,
                    'san_pham_id' => $item['san_pham_id'],
                    'size_san_pham_id' => $item['size_id'] ?? null,
                    'color_san_pham_id' => $item['color_id'] ?? null,
                    'so_luong' => $item['quantity'],
                    'gia_tien' => $item['price'],
                    'thanh_tien' => $total,

                ]);


                $sanPham = san_pham::find($item['san_pham_id']);
                $variant = $sanPham->bien_the_san_phams()
                    ->where('color_san_pham_id', $item['color_id'])
                    ->where('size_san_pham_id', $item['size_id'])
                    ->first();


                if ($variant) {
                    // Giảm số lượng của biến thể sản phẩm
                    $variant->so_luong -= $item['quantity'];
                    $variant->save();
                }
                // Trừ số lượng sản phẩm trong kho
                $product = san_pham::find($item['san_pham_id']);
                if ($product) {
                    $product->so_luong -= $item['quantity'];  // Trừ số lượng sản phẩm
                    $product->save();
                }
            }


            // Xóa giỏ hàng
            foreach ($cartItemsToDelete as $item) {
                CartItem::where('san_pham_id', $item['san_pham_id'])
                    ->where('color_san_pham_id', $item['color_id'])
                    ->where('size_san_pham_id', $item['size_id'])
                    ->delete();
            }

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
            ], function ($message) use ($order) {
                $message->to($order->email)
                    ->subject('Đặt hàng thành công');
            });

            return redirect()->route('order.success_nhanhang')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đã được tạo.');
        }

        return redirect()->route('cart.index')->with('error', 'Thanh toán thất bại. Vui lòng thử lại.');
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