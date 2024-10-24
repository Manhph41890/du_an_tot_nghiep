<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\don_hang;
use App\Models\san_pham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function thong_ke_chung()
    {

        $title = "Tổng quan chung";

        // Đơn hàng mới
        $donhangs = don_hang::query()->orderBy('id', 'desc')->paginate(5);
        // Đếm số lượng đơn hàng
        $soluong_donhangs = don_hang::query()->count();

        // Số lượng đơn hàng mới
        $soluong_donhangs_new = don_hang::query()->where('trang_thai', 'Chờ xác nhận')->count();
        $tongtien_donhangs_new = don_hang::query()->where('trang_thai', 'Chờ xác nhận')->sum('tong_tien');

        // Số lượng đơn hàng từng trạng thái
        $donhangs_daxacnhan = don_hang::query()->where('trang_thai', 'Đã xác nhận')->count();
        $donhangs_dangchuanbihang = don_hang::query()->where('trang_thai', 'Đang chuẩn bị hàng')->count();
        $donhangs_dangvanchuyen = don_hang::query()->where('trang_thai', 'Đang vận chuyển')->count();
        $donhangs_dagiao = don_hang::query()->where('trang_thai', 'Đã giao')->count();
        $donhangs_thanhcong = don_hang::query()->where('trang_thai', 'Thành công')->count();
        $donhangs_dahuy = don_hang::query()->where('trang_thai', 'Đã hủy')->count();

        // Đếm tổng số sản phẩm
        $sanphams = san_pham::count();

        // Lấy 5 sản phẩm có lượt xem nhiều nhất
        $query = san_pham::query();
        $views_product = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color'])->orderBy('views', 'desc')->paginate(5);


        // tổng tiền các tổng tiền của đơn hàng
        $tong_tien_tat_ca_don_hang = don_hang::sum('tong_tien');


        if (intval($tong_tien_tat_ca_don_hang) == $tong_tien_tat_ca_don_hang || intval($tongtien_donhangs_new) == $tongtien_donhangs_new) {
            // Nếu tổng tiền là số nguyên (không có phần thập phân), hiển thị dạng không có phần thập phân
            $tong_tien = number_format($tong_tien_tat_ca_don_hang, 0, ',', '.');
            $tongtien_donhangs_moi = number_format($tongtien_donhangs_new, 0, ',', '.');
        } elseif (floor($tong_tien_tat_ca_don_hang) == $tong_tien_tat_ca_don_hang || floor($tongtien_donhangs_new) == $tongtien_donhangs_new) {
            // Nếu tổng tiền có dạng như 200000.00, hiển thị dạng số nguyên
            $tong_tien = number_format($tong_tien_tat_ca_don_hang, 0, ',', '.');
            $tongtien_donhangs_moi = number_format($tongtien_donhangs_new, 0, ',', '.');
        } else {
            // Nếu tổng tiền có phần thập phân khác .00, hiển thị đầy đủ 2 chữ số sau dấu phẩy
            $tong_tien = number_format($tong_tien_tat_ca_don_hang, 2, ',', '.');
            $tongtien_donhangs_moi = number_format($tongtien_donhangs_new, 2, ',', '.');
        }


        $isAdmin = auth()->user()->chuc_vu->ten_chuc_vu === 'admin';


        return view('admin.thongke.tongquan', compact('sanphams', 'views_product', 'title', 'donhangs', 'tong_tien', 'isAdmin', 'soluong_donhangs', 'soluong_donhangs_new', 'tongtien_donhangs_moi', 'donhangs_daxacnhan', 'donhangs_dangchuanbihang', 'donhangs_dangvanchuyen', 'donhangs_dagiao', 'donhangs_thanhcong', 'donhangs_dahuy'));
    }
    //

    //
    public function thong_ke_doanh_thu()
    {

        $title = "Thống kê doanh thu";

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


        return view('admin.thongke.doanhthu', compact('sanphams', 'views_product', 'users', 'title', 'donhangs', 'tong_tien'));
    }
    //

}
