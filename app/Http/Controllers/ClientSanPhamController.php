<?php

namespace App\Http\Controllers;

use App\Models\color_san_pham;
use App\Models\san_pham;
use App\Models\danh_muc;
use App\Models\khuyen_mai;
use App\Models\size_san_pham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientSanPhamController extends Controller
{
    //
    public function list(Request $request)
    {
        $title = "Cửa hàng";
        // lấy danh mục có sản phẩm đổ ra sidebar
        $danhmucs = danh_muc::has('san_phams')->with('san_phams')->where('is_active', '1')->get();
        // foreach ($danhmucs as $danhmuc) {
        //     $danhmuc->soluong_sp_dm = $danhmuc->san_phams()->count();
        // }

        // Lấy size biến thể có sản phẩm đổ ra sidebar, chỉ lấy những size có sản phẩm đang hoạt động
        $size_sidebar = size_san_pham::whereHas('bien_the_san_phams.san_pham', function ($query) {
            $query->where('is_active', 1);
        })->with(['bien_the_san_phams.san_pham' => function ($query) {
            $query->where('is_active', 1);
        }])->get();
        // foreach ($size_sidebar as $sl_size_sb) {
        //     $sl_size_sb->sl_size = $sl_size_sb->bien_the_san_phams->filter(function ($bien_the) {
        //         return $bien_the->san_pham && $bien_the->san_pham->is_active == 1;
        //     })->count();
        // }


        // Lấy màu sắc biến thể có sản phẩm đổ ra sidebar
        $color_sidebar = color_san_pham::whereHas('bien_the_san_phams.san_pham', function ($query) {
            $query->where('is_active', 1);
        })->with(['bien_the_san_phams.san_pham' => function ($query) {
            $query->where('is_active', 1);
        }])->get();
        // foreach ($color_sidebar as $sl_color_sb) {
        //     $sl_color_sb->sl_color = $sl_color_sb->bien_the_san_phams->filter(function ($bien_the) {
        //         return $bien_the->san_pham && $bien_the->san_pham->is_active == 1;
        //     })->count();
        // }

        $query = san_pham::query();


        // Xử lý sắp xếp
        if ($request->has('sort')) {
            switch ($request->sort) {
                case '2':
                    $query->orderBy('gia_km', 'DESC');
                    break;
                case '3':
                    $query->orderBy('gia_km', 'ASC');
                    break;
            }
        } else {
            // $query->orderBy('id', 'DESC'); // Mặc định
        }


        // Lọc theo danh mục
        if ($request->has('danhmuc')) {
            $query->whereIn('danh_muc_id', $request->danhmuc);
        }

        // Lọc theo giá
        if ($request->has('price')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->price as $priceRange) {
                    if ($priceRange == '1000000+') {
                        $q->orWhere('gia_km', '>', 1000000);
                    } else {
                        list($min, $max) = explode('-', $priceRange);
                        $q->orWhereBetween('gia_km', [(int)$min, (int)$max]);
                    }
                }
            });
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



        $soluongsanpham = $query->where('is_active', '1')->count();
        $list_sanphams = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color', 'danh_gias'])
            ->where('is_active', '1')
            ->paginate(12);

        foreach ($list_sanphams as $sanpham) {
            // tính % giảm giá
            $sanpham->phantramgia = round((($sanpham->gia_goc - $sanpham->gia_km) / $sanpham->gia_goc) * 100);

            // Định dạng giá
            $sanpham->gia_goc = number_format($sanpham->gia_goc, (intval($sanpham->gia_goc) == $sanpham->gia_goc ? 0 : 2), ',', '.');
            $sanpham->gia_km = number_format($sanpham->gia_km, (intval($sanpham->gia_km) == $sanpham->gia_km ? 0 : 2), ',', '.');

            // Tính điểm đánh giá
            $sanpham->danh_gia = $sanpham->danh_gias->isNotEmpty() ? $sanpham->danh_gias->pluck('diem_so')->avg() : 0;
        }
        // Lấy khuyến mãi
        $discounts = khuyen_mai::where('is_active', 1)
            ->where('so_luong_ma', '>', 0) // Điều kiện so_luong_ma > 0
            ->whereNull('user_id') // Điều kiện user_id = null
            ->where('ngay_ket_thuc', '>', Carbon::now()) // Thêm điều kiện ngày kết thúc <= hiện tại
            ->orderBy('created_at', 'desc') // Sắp xếp theo ngày tạo mới nhất
            ->take(3) // Lấy 3 bản ghi
            ->get();

        return view('client.sanpham.danhsach', compact('list_sanphams', 'discounts', 'title', 'danhmucs', 'soluongsanpham', 'size_sidebar', 'color_sidebar', 'request'));
    }
}
