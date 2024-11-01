<?php

namespace App\Http\Controllers;

use App\Models\color_san_pham;
use App\Models\san_pham;
use App\Models\danh_muc;
use App\Models\size_san_pham;
use Illuminate\Http\Request;

class ClientSanPhamController extends Controller
{
    //
    public function list()
    {
        $title = "Shop";

        // lấy danh mục có sản phẩm đổ ra sidebar
        $danhmucs = danh_muc::has('san_phams')->with('san_phams')->get();
        foreach ($danhmucs as $danhmuc) {
            $danhmuc->soluong_sp_dm = $danhmuc->san_phams()->count();
        }

        // Lấy size biến thể có sản phẩm đổ ra sidebar
        $size_sidebar = size_san_pham::has('bien_the_san_phams')->with('bien_the_san_phams')->get();
        foreach ($size_sidebar as $sl_size_sb) {
            $sl_size_sb->sl_size = $sl_size_sb->bien_the_san_phams->count();
        }

        // Lấy màu sắc biến thể có sản phẩm đổ ra sidebar
        $color_sidebar = color_san_pham::has('bien_the_san_phams')->with('bien_the_san_phams')->get();
        foreach ($color_sidebar as $sl_color_sb) {
            $sl_color_sb->sl_color = $sl_color_sb->bien_the_san_phams->count();
        }

        $query = san_pham::query();
        $soluongsanpham = $query->count();
        $list_sanphams = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color', 'danh_gias'])->orderBy('id', 'DESC')->paginate(9);
        foreach ($list_sanphams as $sanpham) {
            // tính % giảm giá
            $sanpham->phantramgia = (($sanpham->gia_goc - $sanpham->gia_km) / $sanpham->gia_goc) * 100;
            if (intval($sanpham->gia_goc) == $sanpham->gia_goc || intval($sanpham->gia_km) == $sanpham->gia_km) {
                // Nếu tổng tiền là số nguyên (không có phần thập phân), hiển thị dạng không có phần thập phân
                $sanpham->gia_goc =   number_format($sanpham->gia_goc, 0, ',', '.');
                $sanpham->gia_km =   number_format($sanpham->gia_km, 0, ',', '.');
            } elseif (floor($sanpham->gia_goc) == $sanpham->gia_goc || floor($sanpham->gia_km) == $sanpham->gia_km) {
                // Nếu tổng tiền có dạng như 200000.00, hiển thị dạng số nguyên
                $sanpham->gia_goc =   number_format($sanpham->gia_goc, 0, ',', '.');
                $sanpham->gia_km =   number_format($sanpham->gia_km, 0, ',', '.');
            } else {
                // Nếu tổng tiền có phần thập phân khác .00, hiển thị đầy đủ 2 chữ số sau dấu phẩy
                $sanpham->gia_goc =  number_format($sanpham->gia_goc, 2, ',', '.');
                $sanpham->gia_km =   number_format($sanpham->gia_km, 2, ',', '.');
            }
            if ($sanpham->danh_gias->isNotEmpty()) {
                $diemSoList = $sanpham->danh_gias->pluck('diem_so');
                $sanpham->danh_gia = $diemSoList->avg();
            } else {
                $sanpham->danh_gia = 0;
            }
        }

        return view('client.sanpham.danhsach', compact('list_sanphams', 'title', 'danhmucs', 'soluongsanpham', 'size_sidebar', 'color_sidebar'));
    }

    public function quick_view($id)
    {

        $quick_view = san_pham::with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color', 'danh_gias'])->findOrFail($id);

        // Tính phần trăm giảm giá
        if ($quick_view->gia_goc > 0 && $quick_view->gia_km > 0) {
            $quick_view->phan_tram_giam_gia = round((1 - ($quick_view->gia_km / $quick_view->gia_goc)) * 100);
        } else {
            $quick_view->phan_tram_giam_gia = 0;
        }

        // Tính trung bình điểm đánh giá và số lần đánh giá
        $quick_view->so_lan_danh_gia = $quick_view->danh_gias->count();
        if ($quick_view->so_lan_danh_gia > 0) {
            $quick_view->diem_trung_binh = round($quick_view->danh_gias->avg('diem_so'), 1);
        } else {
            $quick_view->diem_trung_binh = 0;
        }

        // Lấy tất cả các size và màu sắc từ biến thể sản phẩm
        $sizes = $quick_view->bien_the_san_phams->pluck('size')->unique('id'); // Lấy size duy nhất
        $colors = $quick_view->bien_the_san_phams->pluck('color')->unique('id'); // Lấy màu sắc duy nhất
        return view('client.sanpham.quickview', compact('quick_view', 'sizes', 'colors'));
    }
}