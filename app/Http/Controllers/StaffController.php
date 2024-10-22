<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\don_hang;
use App\Models\san_pham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    //
    public function index()
    {
             
            $title = "Thống kê";

            // Đếm số lượng đơn hàng
            $donhangs = don_hang::count();

            // Đếm tổng số sản phẩm
            $sanphams = san_pham::count();

            // Lấy 5 sản phẩm có lượt xem nhiều nhất
            $views_product = san_pham::orderBy('views', 'desc')->take(5)->get();

            // Đếm tổng số lượng người dùng
            $users = User::count();

            // tổng tiền các tỏng tiền 
            $tong_tien_tat_ca_don_hang = don_hang::sum('tong_tien');
            if ($tong_tien_tat_ca_don_hang == 0) {
                $tong_tien = '0';
            } elseif (intval($tong_tien_tat_ca_don_hang) == $tong_tien_tat_ca_don_hang) {
                // Nếu tổng tiền là số nguyên (không có phần thập phân), hiển thị dạng không có phần thập phân
                $tong_tien = number_format($tong_tien_tat_ca_don_hang, 0, ',', '.');
            } elseif (floor($tong_tien_tat_ca_don_hang) == $tong_tien_tat_ca_don_hang) {
                // Nếu tổng tiền có dạng như 200000.00, hiển thị dạng số nguyên
                $tong_tien = number_format($tong_tien_tat_ca_don_hang, 0, ',', '.');
            } else {
                // Nếu tổng tiền có phần thập phân khác .00, hiển thị đầy đủ 2 chữ số sau dấu phẩy
                $tong_tien = number_format($tong_tien_tat_ca_don_hang, 2, ',', '.');
            }
            return view('admin.thongke.tongquan', compact('sanphams', 'views_product', 'users', 'title', 'donhangs', 'tong_tien'));
        

        return redirect('/client')->withErrors('Bạn không có quyền truy cập vào trang này.');
    }
}
