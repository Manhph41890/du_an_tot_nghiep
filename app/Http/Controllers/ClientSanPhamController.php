<?php

namespace App\Http\Controllers;

use App\Models\san_pham;
use App\Models\danh_muc;
use Illuminate\Http\Request;

class ClientSanPhamController extends Controller
{
    //
    public function list()
    {
        $title = "Shop";
        $danhmucs = danh_muc::all();
        foreach ($danhmucs as $danhmuc) {
            $danhmuc->soluong_sp_dm = $danhmuc->san_phams()->count();
        }

        $query = san_pham::query();
        $soluongsanpham = $query->count();
        $list_sanphams = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color', 'danh_gias'])->orderBy('id','DESC')->paginate(9);
        foreach ($list_sanphams as $sanpham) {
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

        return view('client.sanpham.danhsach', compact('list_sanphams', 'title', 'danhmucs', 'soluongsanpham'));
    }
}
