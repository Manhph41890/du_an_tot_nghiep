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