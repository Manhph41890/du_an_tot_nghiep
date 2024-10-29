<?php

namespace App\Http\Controllers;

use App\Models\bai_viet;
use App\Models\san_pham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Sản phẩm Home
    public function index()
    {
        $sanPhamMois = san_pham::orderByDesc('id')->latest('id')->paginate(6);
        $sanPhamGiamGias = san_pham::with('danh_gias')->whereNotNull('gia_km')
            ->orderByDesc('id')
            ->paginate(3);

        // Tính phần trăm giảm giá
        $sanPhamGiamGias->getCollection()->transform(function ($sanPham) {
            if ($sanPham->gia_goc > 0 && $sanPham->gia_km > 0) {
                $sanPham->phan_tram_giam_gia = round((1 - ($sanPham->gia_km / $sanPham->gia_goc)) * 100);
            } else {
                $sanPham->phan_tram_giam_gia = 0;
            }

            // Tính trung bình điểm đánh giá
            if ($sanPham->danh_gias->count() > 0) {
                $sanPham->diem_trung_binh = round($sanPham->danh_gias->avg('diem_so'), 1); // Lấy giá trị trung bình điểm
            } else {
                $sanPham->diem_trung_binh = 0; // Nếu không có đánh giá nào
            }

            return $sanPham;
        });
        return view('client.home', compact('sanPhamMois', 'sanPhamGiamGias'));
    }
    // Sản phẩm chi tiet
    public function chiTietSanPham($id)
    {
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



        // Lấy tất cả các size và màu sắc từ biến thể sản phẩm
        $sizes = $sanPhamCT->bien_the_san_phams->pluck('size')->unique('id'); // Lấy size duy nhất
        $colors = $sanPhamCT->bien_the_san_phams->pluck('color')->unique('id'); // Lấy màu sắc duy nhất
        return view('client.sanpham.sanphamct', compact('sanPhamCT', 'sizes', 'colors'));
    }

    // In Data Bai viet
    public function listBaiViet()
    {
        $baiviets = bai_viet::with('user')->latest('id')->paginate(4);

        return view('client.baiviet.baiviet', compact('baiviets'));
    }
    // In chi tiet bai viet
    public function chiTietBaiViet($id)
    {
        $baiViet = bai_viet::with('user')->findOrFail($id);
        $docThem = bai_viet::with('user')->where('id', '!=', $id)->orderBy('id', 'desc')->limit(3)->get();
        return view('client.baiviet.baivietchitiet', compact('baiViet', 'docThem'));
    }

    public function lienhe()
    {
        return view('client.lienhe');
    }
}
