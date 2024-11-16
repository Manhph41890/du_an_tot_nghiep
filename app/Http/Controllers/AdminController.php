<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\don_hang;
use App\Models\san_pham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function thong_ke_chung(Request $request)
    {
        
        $title = "Tổng quan chung";

        // Validate ngày bắt đầu, ngày kết thúc
        $request->validate([
            'ngay_bat_dau' => 'nullable|before_or_equal:ngay_ket_thuc',
            'ngay_ket_thuc' => 'nullable|after_or_equal:ngay_bat_dau',
            'ngay_bat_dau_bieudo' => 'nullable|before_or_equal:ngay_ket_thuc_bieudo',
            'ngay_ket_thuc_bieudo' => 'nullable|after_or_equal:ngay_bat_dau_bieudo',

        ], [
            'ngay_bat_dau.before_or_equal' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu.',
            'ngay_bat_dau_bieudo.before_or_equal' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.',
            'ngay_ket_thuc_bieudo.after_or_equal' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu.',
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
                ->where('trang_thai_don_hang', 'Đã xác nhận')
                ->count();
            $donhangs_dangchuanbihang = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Đang chuẩn bị hàng')
                ->count();
            $donhangs_dangvanchuyen = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Đang vận chuyển')
                ->count();
            $donhangs_dagiao = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Đã giao')
                ->count();
            $donhangs_thanhcong = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Thành công')
                ->count();
            $donhangs_dahuy = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Đã hủy')
                ->count();

            // Số lượng đơn hàng mới
            $soluong_donhangs_new = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Chờ xác nhận')
                ->count();
            $tongtien_donhangs_new = don_hang::query()
                ->whereBetween('ngay_tao', [
                    $request->input('ngay_bat_dau'),
                    $request->input('ngay_ket_thuc')
                ])
                ->where('trang_thai_don_hang', 'Chờ xác nhận')
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
                        ->where('trang_thai_don_hang', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::whereDate('ngay_tao', Carbon::today())
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->sum('tong_tien');

                    break;
                case 'last_7_days':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->sum('tong_tien');


                    break;
                case 'month':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::query()->whereMonth('ngay_tao', Carbon::now()->month)->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereMonth('ngay_tao', Carbon::now()->month)->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::whereMonth('ngay_tao', Carbon::now()->month)
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->sum('tong_tien');

                    break;
                case 'year':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::query()->whereYear('ngay_tao', Carbon::now()->year)->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereYear('ngay_tao', Carbon::now()->year)->sum('tong_tien');

                    // Số lượng đơn hàng từng trạng thái
                    $donhangs_daxacnhan = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Đã xác nhận')
                        ->count();
                    $donhangs_dangchuanbihang = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Đang chuẩn bị hàng')
                        ->count();
                    $donhangs_dangvanchuyen = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Đang vận chuyển')
                        ->count();
                    $donhangs_dagiao = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Đã giao')
                        ->count();
                    $donhangs_thanhcong = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Thành công')
                        ->count();
                    $donhangs_dahuy = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Đã hủy')
                        ->count();

                    // Số lượng đơn hàng mới
                    $soluong_donhangs_new = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->count();
                    $tongtien_donhangs_new = don_hang::whereYear('ngay_tao', Carbon::now()->year)
                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                        ->sum('tong_tien');

                    break;
                default:
                    break;
            }
        } else {

            // Số lượng tất cả đơn hàng
            $soluong_donhangs = don_hang::query()->count();

            // Số lượng đơn hàng từng trạng thái
            $donhangs_daxacnhan = don_hang::query()->where('trang_thai_don_hang', 'Đã xác nhận')->count();
            $donhangs_dangchuanbihang = don_hang::query()->where('trang_thai_don_hang', 'Đang chuẩn bị hàng')->count();
            $donhangs_dangvanchuyen = don_hang::query()->where('trang_thai_don_hang', 'Đang vận chuyển')->count();
            $donhangs_dagiao = don_hang::query()->where('trang_thai_don_hang', 'Đã giao')->count();
            $donhangs_thanhcong = don_hang::query()->where('trang_thai_don_hang', 'Thành công')->count();
            $donhangs_dahuy = don_hang::query()->where('trang_thai_don_hang', 'Đã hủy')->count();

            // Số lượng đơn hàng mới
            $soluong_donhangs_new = don_hang::query()->where('trang_thai_don_hang', 'Chờ xác nhận')->count();
            $tongtien_donhangs_new = don_hang::query()->where('trang_thai_don_hang', 'Chờ xác nhận')->sum('tong_tien');

            // tổng tiền các tổng tiền của đơn hàng
            $tong_tien_tat_ca_don_hang = don_hang::sum('tong_tien');
        }


        //-------------------------- BIỂU ĐỒ -----------------------------
        // Tạo tên cho các tháng
        $labels = [
            'T1',
            'T2',
            'T3',
            'T4',
            'T5',
            'T6',
            'T7',
            'T8',
            'T9',
            'T10',
            'T11',
            'T12'
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
            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
                    ->whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->sum('tong_tien');
                $tongTienThang[$thang] = $tongTien ?: 0;
            }

            // Biểu đồ tỉ lệ % ĐƠN HÀNG------------ 
            $phantramdonhang = [];
            foreach ($labels_phantram as $trang_thai_don_hang) {
                $count = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->where('trang_thai_don_hang', $trang_thai_don_hang)
                    ->count();
                $phantramdonhang[$trang_thai_don_hang] = $count;
            }

            $loi_nhuan_theo_thang = [];

            for ($thang = 1; $thang <= 12; $thang++) {
                // Tính tổng tiền của các đơn hàng thành công theo tháng trong khoảng thời gian đã chọn
                $tt_dh_tang = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->sum('tong_tien');

                // Tính tổng giá nhập và phí vận chuyển cho đơn hàng thành công theo tháng và khoảng thời gian
                $tong_gia_nhap_tang = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
                    ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
                    ->join('phuong_thuc_van_chuyens', 'don_hangs.phuong_thuc_van_chuyen_id', '=', 'phuong_thuc_van_chuyens.id')
                    ->selectRaw('
                        SUM(san_phams.gia_nhap * chi_tiet_don_hangs.so_luong) AS tong_gia_nhap,
                        SUM(phuong_thuc_van_chuyens.gia_ship) AS tong_gia_ship
                    ')
                    ->first();

                // Tính lợi nhuận theo tháng: tổng tiền của đơn hàng - tổng giá nhập - tổng chi phí vận chuyển
                $loi_nhuan_theo_thang[$thang] = $tt_dh_tang - $tong_gia_nhap_tang->tong_gia_nhap - $tong_gia_nhap_tang->tong_gia_ship;
            }
        } else if ($request->isMethod('get') && $request->input('loc_ngay_thang_quy_nam_bieudo')) {

            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->sum('tong_tien');
                $tongTienThang[] = $tongTien;
            }

            // Biểu đồ tỉ lệ % ĐƠN HÀNG------------
            if ($request->input('loc_ngay_thang_quy_nam_bieudo')) {
                list($year, $month) = explode('-', $request->input('loc_ngay_thang_quy_nam_bieudo'));
            } else {
                $year = Carbon::now()->year;
                $month = Carbon::now()->month;
            }
            $phantramdonhang = [];
            foreach ($labels_phantram as $trang_thai_don_hang) {
                $count = don_hang::whereMonth('ngay_tao', $month)
                    ->whereYear('ngay_tao', $year)
                    ->where('trang_thai_don_hang', $trang_thai_don_hang)
                    ->count();
                $phantramdonhang[$trang_thai_don_hang] = $count;
            }

            // Biểu đồ LỢI NHUẬN-------------------
            $loi_nhuan_theo_thang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                // Tính tổng tiền của các đơn hàng thành công trong tháng
                $tt_dh_tang = don_hang::whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->sum('tong_tien');

                // Tính tổng giá nhập của các sản phẩm trong đơn hàng thành công trong tháng
                $tong_gia_nhap = don_hang::whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
                    ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
                    ->sum(DB::raw('san_phams.gia_nhap * chi_tiet_don_hangs.so_luong'));

                // Tính tổng phí vận chuyển, chỉ tính một lần cho mỗi đơn hàng thành công trong tháng
                $tong_gia_ship = don_hang::whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->join('phuong_thuc_van_chuyens', 'don_hangs.phuong_thuc_van_chuyen_id', '=', 'phuong_thuc_van_chuyens.id')
                    ->sum('phuong_thuc_van_chuyens.gia_ship');

                // Tính lợi nhuận theo tháng: tổng tiền của đơn hàng - tổng giá nhập - tổng chi phí vận chuyển
                $loi_nhuan_theo_thang[$thang] = $tt_dh_tang - $tong_gia_nhap - $tong_gia_ship;
            }
        } else {
            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->sum('tong_tien');
                $tongTienThang[] = $tongTien;
            }

            // Biểu đồ tỉ lệ % ĐƠN HÀNG------------
            $phantramdonhang = [];
            foreach ($labels_phantram as $trang_thai_don_hang) {
                $count = don_hang::where('trang_thai_don_hang', $trang_thai_don_hang)->count();
                $phantramdonhang[$trang_thai_don_hang] = $count;
            }

            // Biểu đồ LỢI NHUẬN-------------------
            $loi_nhuan_theo_thang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                // Tính tổng tiền của các đơn hàng thành công trong tháng
                $tt_dh_tang = don_hang::whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->sum('tong_tien');

                // Tính tổng giá nhập của các sản phẩm trong đơn hàng thành công trong tháng
                $tong_gia_nhap = don_hang::whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->join('chi_tiet_don_hangs', 'don_hangs.id', '=', 'chi_tiet_don_hangs.don_hang_id')
                    ->join('san_phams', 'chi_tiet_don_hangs.san_pham_id', '=', 'san_phams.id')
                    ->sum(DB::raw('san_phams.gia_nhap * chi_tiet_don_hangs.so_luong'));

                // Tính tổng phí vận chuyển, chỉ tính một lần cho mỗi đơn hàng thành công trong tháng
                $tong_gia_ship = don_hang::whereMonth('ngay_tao', $thang)
                    ->where('trang_thai_don_hang', 'Thành công')
                    ->join('phuong_thuc_van_chuyens', 'don_hangs.phuong_thuc_van_chuyen_id', '=', 'phuong_thuc_van_chuyens.id')
                    ->sum('phuong_thuc_van_chuyens.gia_ship');

                // Tính lợi nhuận theo tháng: tổng tiền của đơn hàng - tổng giá nhập - tổng chi phí vận chuyển
                $loi_nhuan_theo_thang[$thang] = $tt_dh_tang - $tong_gia_nhap - $tong_gia_ship;
            }
        }


        // Đơn hàng mới
        $donhangs = don_hang::query()
            ->whereDate('ngay_tao', Carbon::today())
            ->orderBy('id', 'desc')
            ->paginate(4);
        foreach ($donhangs as $item) {
            $item->ngay_tao = Carbon::parse($item->ngay_tao)->format('d-m-Y');
            $item->tong_tien = number_format($item->tong_tien, 0, ',', '.');
        }

        // Sản phẩm sắp hết hàng
        $sanphams_saphet = san_pham::query()->where('so_luong', '<', '10')->paginate(4);
        // Lấy 5 sản phẩm có lượt xem nhiều nhất
        $query = san_pham::query();
        $views_product = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color'])->orderBy('views', 'desc')->paginate(4);

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


        return view('admin.thongke.tongquan', compact('loi_nhuan_theo_thang', 'labels_phantram', 'phantramdonhang', 'labels', 'tongTienThang', 'sanphams_saphet', 'views_product', 'title', 'donhangs', 'tong_tien', 'isAdmin', 'soluong_donhangs', 'soluong_donhangs_new', 'tongtien_donhangs_moi', 'donhangs_daxacnhan', 'donhangs_dangchuanbihang', 'donhangs_dangvanchuyen', 'donhangs_dagiao', 'donhangs_thanhcong', 'donhangs_dahuy'));
    }
    //

}
