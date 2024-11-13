<?php

namespace App\Http\Controllers;

use App\Models\bai_viet;
use App\Models\bien_the_san_pham;
use App\Models\danh_muc;
use App\Models\khuyen_mai;
use App\Models\san_pham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Sản phẩm Home
    public function index(Request $request)
    {
        // Lấy sản phẩm mới
        $sanPhamMois = san_pham::where('is_active', 1) // Thêm điều kiện lọc
            ->orderByDesc('id')
            ->latest('id')
            ->paginate(10);

        // Tính điểm trung bình cho các sản phẩm mới
        $sanPhamMois->getCollection()->transform(function ($sanPham) {
            if ($sanPham->danh_gias->count() > 0) {
                $sanPham->diem_trung_binh = round($sanPham->danh_gias->avg('diem_so'), 1); // Lấy giá trị trung bình điểm
            } else {
                $sanPham->diem_trung_binh = 0; // Nếu không có đánh giá nào
            }
            return $sanPham;
        });

        // Lấy sản phẩm giảm giá
        $sanPhamGiamGias = san_pham::with('danh_gias')
            ->whereNotNull('gia_km')
            ->where('is_active', 1) // Thêm điều kiện lọc
            ->orderByDesc('id')
            ->paginate(5);

        // Tính phần trăm giảm giá cho sản phẩm giảm giá
        $sanPhamGiamGias->getCollection()->transform(function ($sanPham) {
            if ($sanPham->gia_goc > 0 && $sanPham->gia_km > 0) {
                $sanPham->phan_tram_giam_gia = round((1 - ($sanPham->gia_km / $sanPham->gia_goc)) * 100);
            } else {
                $sanPham->phan_tram_giam_gia = 0;
            }

            // Tính điểm trung bình cho sản phẩm giảm giá
            if ($sanPham->danh_gias->count() > 0) {
                $sanPham->diem_trung_binh = round($sanPham->danh_gias->avg('diem_so'), 1); // Lấy giá trị trung bình điểm
            } else {
                $sanPham->diem_trung_binh = 0; // Nếu không có đánh giá nào
            }
            return $sanPham;
        });

        // Lấy sản phẩm xem nhiều
        $sanPhamView = san_pham::where('is_active', 1) // Thêm điều kiện lọc
            ->orderByDesc('views', 'desc')
            ->paginate(6);
        // Lấy khuyến mãi
        $discounts = khuyen_mai::where('is_active', 1)
            ->where('so_luong_ma', '>', 0) // Thêm điều kiện so_luong_ma > 0
            ->orderBy('created_at', 'desc') // Sắp xếp theo ngày tạo mới nhất
            ->take(4) // Lấy 4 mã giảm giá
            ->get();

        $title = "Trang chủ";
        $baiVietMoi = bai_viet::with('user')->orderBy('ngay_dang', 'desc')->paginate(6);
        $anhDMuc = danh_muc::query()->where('is_active', '1')->get();

        return view('client.home', compact('sanPhamMois', 'discounts', 'sanPhamGiamGias', 'sanPhamView', 'title', 'baiVietMoi', 'anhDMuc'));
    }

    public function showByCategory($danhMucId)
    {
        // Lấy danh mục theo ID
        $danhMuc = danh_muc::find($danhMucId);

        // Kiểm tra nếu không tìm thấy danh mục
        if (!$danhMuc) {
            return redirect()->route('client.cuahang')->with('error', 'Danh mục không tồn tại.');
        }

        // Lấy sản phẩm thuộc danh mục
        $sanPhams = san_pham::where('danh_muc_id', $danhMucId)->get();

        // Trả về view sản phẩm của danh mục
        return view('client.danhmuc_sanpham', compact('danhMuc', 'sanPhams'));
    }


    // Sản phẩm chi tiet
    public function chiTietSanPham($id)
    {
        // Lấy thông tin chi tiết sản phẩm và các mối quan hệ liên quan
        $sanPhamCT = san_pham::with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color', 'danh_gias'])->findOrFail($id);

        // Tính phần trăm giảm giá
        if ($sanPhamCT->gia_goc > 0 && $sanPhamCT->gia_km > 0) {
            $sanPhamCT->phan_tram_giam_gia = round((1 - ($sanPhamCT->gia_km / $sanPhamCT->gia_goc)) * 100);
        } else {
            $sanPhamCT->phan_tram_giam_gia = 0;
        }

        // Tính trung bình điểm đánh giá và số lần đánh giá
        $sanPhamCT->so_lan_danh_gia = $sanPhamCT->danh_gias->count();
        if ($sanPhamCT->so_lan_danh_gia > 0) {
            $sanPhamCT->diem_trung_binh = round($sanPhamCT->danh_gias->avg('diem_so'), 1);
        } else {
            $sanPhamCT->diem_trung_binh = 0;
        }



        // Truyền thông tin màu sắc theo size vào view
        $colorsBySize = [];
        foreach ($sanPhamCT->bien_the_san_phams as $bienThe) {
            $colorsBySize[$bienThe->size->id][] = [
                'id' => $bienThe->color->id,
                'ten_color' => $bienThe->color->ten_color,
                'so_luong' => $bienThe->so_luong // Thêm số lượng vào mảng
            ];
        }
        // Lấy danh sách size và màu sắc
        $sizes = $sanPhamCT->bien_the_san_phams->pluck('size')->unique('id'); // Lấy size duy nhất
        $colors = $sanPhamCT->bien_the_san_phams->pluck('color')->unique('id'); // Lấy màu sắc duy nhất

        // Lấy các sản phẩm liên quan
        $sanLienQuan = san_pham::with('danh_muc')->where('id', '!=', $id)->orderByDesc('id')->get();


        // Tiêu đề trang
        $title = $sanPhamCT->ten_san_pham;

        return view('client.sanpham.sanphamct', compact('sanPhamCT', 'sizes', 'colors', 'title', 'colorsBySize', 'sanLienQuan'));
    }


    // In Data Bai viet
    public function listBaiViet()
    {
        $baiviets = bai_viet::with('user')->latest('id')->paginate(4);
        $baiVietMoi = bai_viet::with('user')->orderBy('ngay_dang', 'desc')->paginate(6);
        $title = "";
        return view('client.baiviet.baiviet', compact('baiviets', 'baiVietMoi', 'title'));
    }
    // In chi tiet bai viet
    public function chiTietBaiViet($id)
    {
        $baiViet = bai_viet::with('user')->findOrFail($id);
        $docThem = bai_viet::with('user')->where('id', '!=', $id)->orderBy('id', 'desc')->limit(3)->get();
        $title = "";
        return view('client.baiviet.baivietchitiet', compact('baiViet', 'docThem', 'title'));
    }
    // app/Http/Controllers/HomeController.php

    public function incrementViews($id)
    {
        // Tìm sản phẩm theo ID
        $sanPham = san_pham::find($id);

        // Nếu sản phẩm tồn tại, tăng lượt xem
        if ($sanPham && auth()->check()) {
            $sanPham->increment('views'); // Tăng lượt xem
        }


        // Chuyển hướng đến trang chi tiết sản phẩm
        return redirect()->route('sanpham.chitiet', $id);
    }


    public function lienhe()
    {
        return view('client.lienhe');
    }
    public function gioithieu()
    {
        return view('client.gioithieu');
    }
}
