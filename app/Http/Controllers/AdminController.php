<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\don_hang;
use App\Models\san_pham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
                    ->whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->sum('tong_tien');
                $tongTienThang[$thang] = $tongTien ?: 0;
            }

            // Biểu đồ tỉ lệ % ĐƠN HÀNG------------ 
            $phantramdonhang = [];
            foreach ($labels_phantram as $trang_thai) {
                $count = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->where('trang_thai', $trang_thai)
                    ->count();
                $phantramdonhang[$trang_thai] = $count;
            }

            // Biểu đồ LỢI NHUẬN-------------------
            $loi_nhuan_theo_thang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                // Tính tổng tiền của đơn hàng theo tháng
                $tt_dh_tang = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->whereMonth('ngay_tao', $thang)->sum('tong_tien');

                // Lấy chi phí từ giá nhập
                $tong_gia_nhap_tang = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->whereMonth('ngay_tao', $thang)
                    ->join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                    ->sum('san_phams.gia_nhap');
                $loi_nhuan_theo_thang[$thang] = $tt_dh_tang - $tong_gia_nhap_tang;
            }
            $gianhap_sp = san_pham::query()->pluck('gia_nhap', 'id')->all();
            $don_hang_sp = don_hang::query()
                ->whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                ->pluck('san_pham_id', 'id')->all();

            // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
            $tong_gia_tri_sp_chua_chua = [];

            // Lặp qua các sản phẩm
            foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                // Lấy số lượng đơn hàng chưa chứa sản phẩm này
                $so_luong_chua_chua = don_hang::whereBetween('ngay_tao', [$request->input('ngay_bat_dau_bieudo'), $request->input('ngay_ket_thuc_bieudo')])
                    ->whereDoesntHave('san_phams', function ($query) use ($san_pham_id) {
                        $query->where('id', $san_pham_id);
                    })->count();

                // Tính tổng giá trị cho sản phẩm này
                $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
            }
        } else if ($request->isMethod('get') && $request->input('loc_ngay_thang_quy_nam_bieudo')) {

            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
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
            foreach ($labels_phantram as $trang_thai) {
                $count = don_hang::whereMonth('ngay_tao', $month)
                    ->whereYear('ngay_tao', $year)
                    ->where('trang_thai', $trang_thai)
                    ->count();
                $phantramdonhang[$trang_thai] = $count;
            }

            // Biểu đồ LỢI NHUẬN-------------------
            $loi_nhuan_theo_thang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                // Tính tổng tiền của đơn hàng theo tháng
                $tt_dh_tang = don_hang::whereMonth('ngay_tao', $thang)->sum('tong_tien');

                // lấy chi phí từ giá nhập
                $tong_gia_nhap_tang = don_hang::whereMonth('ngay_tao', $thang)
                    ->join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                    ->sum('san_phams.gia_nhap');

                $loi_nhuan_theo_thang[$thang] = $tt_dh_tang - $tong_gia_nhap_tang;
            }

            $gianhap_sp = san_pham::query()->pluck('gia_nhap', 'id')->all();
            $don_hang_sp = don_hang::query()->pluck('san_pham_id', 'id')->all();

            // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
            $tong_gia_tri_sp_chua_chua = [];

            // Lặp qua các sản phẩm
            foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                // Lấy số lượng đơn hàng chưa chứa sản phẩm này
                $so_luong_chua_chua = don_hang::whereDoesntHave('san_phams', function ($query) use ($san_pham_id) {
                    $query->where('id', $san_pham_id);
                })->count();

                // Tính tổng giá trị cho sản phẩm này
                $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
            }
        } else {
            // Biểu đồ DOANH THU-------------------
            $tongTienThang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                $tongTien = don_hang::whereMonth('ngay_tao', $thang)
                    ->whereYear('ngay_tao', Carbon::now()->year)
                    ->sum('tong_tien');
                $tongTienThang[] = $tongTien;
            }

            // Biểu đồ tỉ lệ % ĐƠN HÀNG------------
            $phantramdonhang = [];
            foreach ($labels_phantram as $trang_thai) {
                $count = don_hang::where('trang_thai', $trang_thai)->count();
                $phantramdonhang[$trang_thai] = $count;
            }

            // Biểu đồ LỢI NHUẬN-------------------
            $loi_nhuan_theo_thang = [];
            for ($thang = 1; $thang <= 12; $thang++) {
                // Tính tổng tiền của đơn hàng theo tháng
                $tt_dh_tang = don_hang::whereMonth('ngay_tao', $thang)->sum('tong_tien');

                // lấy chi phí từ giá nhập
                $tong_gia_nhap_tang = don_hang::whereMonth('ngay_tao', $thang)
                    ->join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                    ->sum('san_phams.gia_nhap');

                $loi_nhuan_theo_thang[$thang] = $tt_dh_tang - $tong_gia_nhap_tang;
            }

            $gianhap_sp = san_pham::query()->pluck('gia_nhap', 'id')->all();
            $don_hang_sp = don_hang::query()->pluck('san_pham_id', 'id')->all();

            // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
            $tong_gia_tri_sp_chua_chua = [];

            // Lặp qua các sản phẩm
            foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                // Lấy số lượng đơn hàng chưa chứa sản phẩm này
                $so_luong_chua_chua = don_hang::whereDoesntHave('san_phams', function ($query) use ($san_pham_id) {
                    $query->where('id', $san_pham_id);
                })->count();

                // Tính tổng giá trị cho sản phẩm này
                $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
            }
            // dd($loi_nhuan_theo_thang);
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


        return view('admin.thongke.tongquan', compact('loi_nhuan_theo_thang', 'labels_phantram', 'phantramdonhang', 'labels', 'tongTienThang', 'sanphams_saphet', 'views_product', 'title', 'donhangs', 'tong_tien', 'isAdmin', 'soluong_donhangs', 'soluong_donhangs_new', 'tongtien_donhangs_moi', 'donhangs_daxacnhan', 'donhangs_dangchuanbihang', 'donhangs_dangvanchuyen', 'donhangs_dagiao', 'donhangs_thanhcong', 'donhangs_dahuy'));
    }
    //

    //
    public function thong_ke_doanh_thu(Request $request)
    {
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

        $title = "Thống kê doanh thu";


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
        } else if ($request->isMethod('get') && $request->input('loc_ngay_thang_quy_nam')) {

            switch ($request->input('loc_ngay_thang_quy_nam')) {
                case 'today':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::whereDate('ngay_tao', Carbon::today())->count();
                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereDate('ngay_tao', Carbon::today())->sum('tong_tien');


                    // LỢI NHUẬN
                    $tt_dh_tang = don_hang::whereDate('ngay_tao', Carbon::today())->sum('tong_tien');
                    $tong_gia_nhap_tang = don_hang::join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                        ->whereDate('ngay_tao', Carbon::today())
                        ->sum('san_phams.gia_nhap');
                    // Tính tổng lợi nhuận
                    $loi_nhuan_tong = $tt_dh_tang - $tong_gia_nhap_tang;
                    // Lấy giá nhập của sản phẩm
                    $gianhap_sp = san_pham::pluck('gia_nhap', 'id');
                    // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
                    $tong_gia_tri_sp_chua_chua = [];
                    // Lặp qua các sản phẩm
                    foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                        $so_luong_chua_chua = san_pham::where('id', $san_pham_id)
                            ->whereDoesntHave('don_hangs', function ($query) {
                                $query->whereDate('ngay_tao', Carbon::today());
                            })->count();
                        $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
                    }


                    break;
                case 'last_7_days':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->sum('tong_tien');


                    // LỢI NHUẬN
                    $tt_dh_tang = don_hang::where('ngay_tao', '>=', Carbon::today()->subDays(6))->sum('tong_tien');
                    $tong_gia_nhap_tang = don_hang::join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                        ->where('ngay_tao', '>=', Carbon::today()->subDays(6))
                        ->sum('san_phams.gia_nhap');
                    // Tính tổng lợi nhuận
                    $loi_nhuan_tong = $tt_dh_tang - $tong_gia_nhap_tang;
                    // Lấy giá nhập của sản phẩm
                    $gianhap_sp = san_pham::pluck('gia_nhap', 'id');
                    // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
                    $tong_gia_tri_sp_chua_chua = [];
                    // Lặp qua các sản phẩm
                    foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                        $so_luong_chua_chua = san_pham::where('id', $san_pham_id)
                            ->whereDoesntHave('don_hangs', function ($query) {
                                $query->where('ngay_tao', '>=', Carbon::today()->subDays(6));
                            })->count();

                        $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
                    }


                    break;
                case 'month':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::query()->whereMonth('ngay_tao', Carbon::now()->month)->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereMonth('ngay_tao', Carbon::now()->month)->sum('tong_tien');

                    // LỢI NHUẬN
                    $tt_dh_tang = don_hang::whereMonth('ngay_tao', Carbon::now()->month)->sum('tong_tien');
                    $tong_gia_nhap_tang = don_hang::join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                        ->whereMonth('ngay_tao', Carbon::now()->month)
                        ->sum('san_phams.gia_nhap');
                    // Tính tổng lợi nhuận
                    $loi_nhuan_tong = $tt_dh_tang - $tong_gia_nhap_tang;
                    // Lấy giá nhập của sản phẩm
                    $gianhap_sp = san_pham::pluck('gia_nhap', 'id');
                    // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
                    $tong_gia_tri_sp_chua_chua = [];
                    // Lặp qua các sản phẩm
                    foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                        $so_luong_chua_chua = san_pham::where('id', $san_pham_id)
                            ->whereDoesntHave('don_hangs', function ($query) {
                                $query->whereMonth('ngay_tao', Carbon::now()->month);
                            })->count();
                        $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
                    }


                    break;
                case 'year':

                    // Số lượng đơn hàng
                    $soluong_donhangs = don_hang::query()->whereYear('ngay_tao', Carbon::now()->year)->count();

                    // Tổng tiền các đơn hàng
                    $tong_tien_tat_ca_don_hang = don_hang::whereYear('ngay_tao', Carbon::now()->year)->sum('tong_tien');

                    // LỢI NHUẬN
                    $tt_dh_tang = don_hang::whereYear('ngay_tao', Carbon::now()->year)->sum('tong_tien');
                    $tong_gia_nhap_tang = don_hang::join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                        ->whereYear('ngay_tao', Carbon::now()->year)
                        ->sum('san_phams.gia_nhap');
                    // Tính tổng lợi nhuận
                    $loi_nhuan_tong = $tt_dh_tang - $tong_gia_nhap_tang;
                    // Lấy giá nhập của sản phẩm
                    $gianhap_sp = san_pham::pluck('gia_nhap', 'id');
                    // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
                    $tong_gia_tri_sp_chua_chua = [];
                    // Lặp qua các sản phẩm
                    foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                        $so_luong_chua_chua = san_pham::where('id', $san_pham_id)
                            ->whereDoesntHave('don_hangs', function ($query) {
                                $query->whereYear('ngay_tao', Carbon::now()->year);
                            })->count();
                        $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
                    }

                    break;
                default:
                    break;
            }
        } else {
            // Số lượng tất cả đơn hàng
            $soluong_donhangs = don_hang::query()->count();

            // tổng tiền các tổng tiền của đơn hàng
            $tong_tien_tat_ca_don_hang = don_hang::sum('tong_tien');

            // LỢI NHUẬN-------------------
            $tt_dh_tang = don_hang::sum('tong_tien');
            $tong_gia_nhap_tang = don_hang::join('san_phams', 'don_hangs.san_pham_id', '=', 'san_phams.id')
                ->sum('san_phams.gia_nhap');
            // Tính tổng lợi nhuận
            $loi_nhuan_tong = $tt_dh_tang - $tong_gia_nhap_tang;
            // Lấy giá nhập của sản phẩm
            $gianhap_sp = san_pham::query()->pluck('gia_nhap', 'id')->all();
            $don_hang_sp = don_hang::query()->pluck('san_pham_id', 'id')->all();
            // Khởi tạo mảng để lưu trữ giá trị tổng cho sản phẩm chưa được chứa trong đơn hàng
            $tong_gia_tri_sp_chua_chua = [];
            // Lặp qua các sản phẩm
            foreach ($gianhap_sp as $san_pham_id => $gia_nhap) {
                $so_luong_chua_chua = don_hang::whereDoesntHave('san_phams', function ($query) use ($san_pham_id) {
                    $query->where('id', $san_pham_id);
                })->count();
                $tong_gia_tri_sp_chua_chua[$san_pham_id] = $gia_nhap * $so_luong_chua_chua;
            }
        }


        if (intval($tong_tien_tat_ca_don_hang) == $tong_tien_tat_ca_don_hang || intval($loi_nhuan_tong) == $loi_nhuan_tong) {
            // Nếu tổng tiền là số nguyên (không có phần thập phân), hiển thị dạng không có phần thập phân
            $tong_tien = number_format($tong_tien_tat_ca_don_hang, 0, ',', '.');
            $loi_nhuan_tong = number_format($loi_nhuan_tong, 0, ',', '.');
        } elseif (floor($tong_tien_tat_ca_don_hang) == $tong_tien_tat_ca_don_hang || floor($loi_nhuan_tong) == $loi_nhuan_tong) {
            // Nếu tổng tiền có dạng như 200000.00, hiển thị dạng số nguyên
            $tong_tien = number_format($tong_tien_tat_ca_don_hang, 0, ',', '.');
            $loi_nhuan_tong = number_format($loi_nhuan_tong, 0, ',', '.');
        } else {
            // Nếu tổng tiền có phần thập phân khác .00, hiển thị đầy đủ 2 chữ số sau dấu phẩy
            $tong_tien = number_format($tong_tien_tat_ca_don_hang, 2, ',', '.');
            $loi_nhuan_tong = number_format($loi_nhuan_tong, 2, ',', '.');
        }


        return view('admin.thongke.doanhthu', compact('title', 'tong_tien', 'soluong_donhangs', 'loi_nhuan_tong'));
    }
    //

}
