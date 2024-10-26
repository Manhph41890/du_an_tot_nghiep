<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\don_hang;
use App\Models\san_pham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    }
    public function thong_ke_chung(Request $request)
    {

        $title = "Tổng quan chung";

        // Validate ngày bắt đầu, ngày kết thúc
        $request->validate([
            'ngay_bat_dau' => 'nullable|before_or_equal:ngay_ket_thuc',
            'ngay_ket_thuc' => 'nullable|after_or_equal:ngay_bat_dau',
        ], [
            'ngay_bat_dau.before_or_equal' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu.',
        ]);


        // Đếm số lượng và tổng tiền theo ngày bắt đầu tới ngày kết thúc
        if ($request->isMethod('get') && $request->input('ngay_bat_dau') && $request->input('ngay_ket_thuc')) {

            // Số lượng đơn hàng
            $soluong_donhangs = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->count();

            // tổng tiền các tổng tiền của đơn hàng
            $tong_tien_tat_ca_don_hang = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->sum('tong_tien');

            // Số lượng đơn hàng từng trạng thái
            $donhangs_daxacnhan = don_hang::query()->whereBetween('ngay_tao', [
                $request->input('ngay_bat_dau'),
                $request->input('ngay_ket_thuc')
            ])
                ->where('trang_thai', 'Đã xác nhận')
                ->count();
            $donhangs_dangchuanbihang = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Đang chuẩn bị hàng')
                ->count();
            $donhangs_dangvanchuyen = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Đang vận chuyển')
                ->count();
            $donhangs_dagiao = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Đã giao')
                ->count();
            $donhangs_thanhcong = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Thành công')
                ->count();
            $donhangs_dahuy = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Đã hủy')
                ->count();

            // Số lượng đơn hàng mới
            $soluong_donhangs_new = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Chờ xác nhận')
                ->count();
            $tongtien_donhangs_new = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai', 'Chờ xác nhận')
                ->sum('tong_tien');
        } else if ($request->isMethod('get') && $request->input('loc_ngay_thang_quy_nam')) {

            switch ($request->input('loc_ngay_thang_quy_nam')) {
                case 'today':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::whereDate('ngay_tao', Carbon::today())->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereDate('ngay_tao', Carbon::today())->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->sum('tong_tien');

                    break;
                case 'last_7_days':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->sum('tong_tien');


                    break;
                case 'month':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::query()->whereMonth('ngay_tao', Carbon::now()->month)->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereMonth('ngay_tao', Carbon::now()->month)->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->sum('tong_tien');

                    break;
                case 'year':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::query()->whereYear('ngay_tao', Carbon::now()->year)->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereYear('ngay_tao', Carbon::now()->year)->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai', 'Chờ xác nhận')
                        ->sum('tong_tien');

                    break;
                default:
                    break;
            }
        } else {

            // Số lượng tất cả đơn hàng
            $soluong_donhangs = don_hang::query()->count();

            // Số lượng đơn hàng từng trạng thái
            $donhangs_daxacnhan = don_hang::query()->where('trang_thai', 'Đã xác nhận')->count();
            $donhangs_dangchuanbihang = don_hang::query()->where('trang_thai', 'Đang chuẩn bị hàng')->count();
            $donhangs_dangvanchuyen = don_hang::query()->where('trang_thai', 'Đang vận chuyển')->count();
            $donhangs_dagiao = don_hang::query()->where('trang_thai', 'Đã giao')->count();
            $donhangs_thanhcong = don_hang::query()->where('trang_thai', 'Thành công')->count();
            $donhangs_dahuy = don_hang::query()->where('trang_thai', 'Đã hủy')->count();

            // Số lượng đơn hàng mới
            $soluong_donhangs_new = don_hang::query()->where('trang_thai', 'Chờ xác nhận')->count();
            $tongtien_donhangs_new = don_hang::query()->where('trang_thai', 'Chờ xác nhận')->sum('tong_tien');

            // tổng tiền các tổng tiền của đơn hàng
            $tong_tien_tat_ca_don_hang = don_hang::sum('tong_tien');
        }


        //-------------------------- BIỂU ĐỒ -----------------------------
        // Tạo tên cho các tháng
        $labels = [
            'Tháng 1',
            'Tháng 2',
            'Tháng 3',
            'Tháng 4',
            'Tháng 5',
            'Tháng 6',
            'Tháng 7',
            'Tháng 8',
            'Tháng 9',
            'Tháng 10',
            'Tháng 11',
            'Tháng 12'
        ];
        // Tạo tên trạng thái biểu đồ %
        $labels_phantram = [
            'Chờ xác nhận',
            'Đã xác nhận',
            'Đang chuẩn bị hàng',
            'Đang vận chuyển',
            'Thành công',
            'Đã giao',
            'Đã hủy',
        ];
        if ($request->isMethod('get') && $request->input('ngay_bat_dau_bieudo') && $request->input('ngay_ket_thuc_bieudo')) {
        } else if ($request->isMethod('get') && $request->input('loc_ngay_thang_quy_nam_bieudo')) {

            switch ($request->input('loc_ngay_thang_quy_nam')) {
                case 'today':

                    break;
                case 'last_7_days':

                    break;
                case 'month':

                    break;
                case 'year':

                    break;
                default:
                    break;
            }
        } else {

            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            // Duyệt qua 12 tháng
            for ($thang = 1; $thang <= 12; $thang++) {
                // Lấy tổng tiền cho từng tháng
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
                    ->sum('tong_tien');

                // Lưu dữ liệu vào mảng
                $tongTienThang[] = $tongTien;
            }


            // Biểu đồ tỉ lệ % ĐƠN HÀNG------------
            $phantramdonhang = [];
            // số đơn hàng theo từng trạng thái 
            foreach ($labels_phantram as $trang_thai) {
                $count = don_hang::where('trang_thai', $trang_thai)->count();
                $phantramdonhang[$trang_thai] = $count;
            }
        }


        // Đơn hàng mới
        $donhangs = don_hang::query()->orderBy('id', 'desc')->paginate(5);
        // Sản phẩm sắp hết hàng
        $sanphams_saphet = san_pham::query()->where('so_luong', '<', '10')->get();
        // Lấy 5 sản phẩm có lượt xem nhiều nhất
        $query = san_pham::query();
        $views_product = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color'])->orderBy('views', 'desc')->paginate(5);

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


        return view('admin.thongke.tongquan', compact('labels_phantram', 'phantramdonhang', 'labels', 'tongTienThang', 'sanphams_saphet', 'views_product', 'title', 'donhangs', 'tong_tien', 'isAdmin', 'soluong_donhangs', 'soluong_donhangs_new', 'tongtien_donhangs_moi', 'donhangs_daxacnhan', 'donhangs_dangchuanbihang', 'donhangs_dangvanchuyen', 'donhangs_dagiao', 'donhangs_thanhcong', 'donhangs_dahuy'));
    }
}
