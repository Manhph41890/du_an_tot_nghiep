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
    public function list(Request $request)
    {
        $title = "Cửa hàng";
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


        // Xử lý sắp xếp
        if ($request->has('sort')) {
            switch ($request->sort) {
                case '1':
                    $query->orderBy('created_at', 'DESC'); 
                    break;
                case '2':
                    $query->orderBy('gia_km', 'DESC'); 
                    break;
                case '3':
                    $query->orderBy('gia_km', 'ASC'); 
                    break;
                case '4':
                    $query->orderBy('views', 'DESC'); 
                    break;
            }
        } else {
            $query->orderBy('id', 'DESC'); // Mặc định
        }


        // Lọc theo danh mục
        if ($request->has('danhmuc')) {
            $query->whereIn('danh_muc_id', $request->danhmuc);
        }

        // Lọc theo giá
        if ($request->has('price')) {
            foreach ($request->price as $priceRange) {
                if ($priceRange == '1000000+') {
                    $query->orWhere('gia_km', '>', 1000000);
                } else {
                    list($min, $max) = explode('-', $priceRange);
                    $query->orWhereBetween('gia_km', [(int)$min, (int)$max]);
                }
            }
        }

        // Lọc theo size
        if ($request->has('size') && count($request->size) > 0) {
            $query->whereHas('bien_the_san_phams', function ($q) use ($request) {
                $q->whereIn('size_san_pham_id', $request->size);
            });
        }

        // Lọc theo color
        if ($request->has('color') && count($request->color) > 0) {
            $query->whereHas('bien_the_san_phams', function ($q) use ($request) {
                $q->whereIn('color_san_pham_id', $request->color);
            });
        }


        $soluongsanpham = $query->count();
        $list_sanphams = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color', 'danh_gias'])
            ->orderBy('id', 'DESC')
            ->paginate(9);

        foreach ($list_sanphams as $sanpham) {
            // tính % giảm giá
            $sanpham->phantramgia = round((($sanpham->gia_goc - $sanpham->gia_km) / $sanpham->gia_goc) * 100);

            // Định dạng giá
            $sanpham->gia_goc = number_format($sanpham->gia_goc, (intval($sanpham->gia_goc) == $sanpham->gia_goc ? 0 : 2), ',', '.');
            $sanpham->gia_km = number_format($sanpham->gia_km, (intval($sanpham->gia_km) == $sanpham->gia_km ? 0 : 2), ',', '.');

            // Tính điểm đánh giá
            $sanpham->danh_gia = $sanpham->danh_gias->isNotEmpty() ? $sanpham->danh_gias->pluck('diem_so')->avg() : 0;
        }

        return view('client.sanpham.danhsach', compact('list_sanphams', 'title', 'danhmucs', 'soluongsanpham', 'size_sidebar', 'color_sidebar'));
    }
}