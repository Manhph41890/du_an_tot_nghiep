<?php

namespace App\Http\Controllers;

use App\Models\don_hang;
use App\Models\Shipper;
use Illuminate\Http\Request;

class ShiperrController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query để áp dụng các bộ lọc
        $query = Shipper::with('donHang', 'user');

        // Lọc theo trạng thái đơn hàng từ tab hiện tại
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Lấy danh sách đơn hàng sau khi áp dụng bộ lọc
        $vanchuyens = $query->orderBy('id', 'desc')->paginate(6);
        $title = "Danh sách đơn hàng";

        return view('admin.vanchuyen.index', compact('vanchuyens', 'title'));
    }

    public function show(don_hang $don_hang, $id)
    {
        $donhang = don_hang::with([
            'user',
            'khuyen_mai',
            'phuong_thuc_thanh_toan',
            'phuong_thuc_van_chuyen',
            'chi_tiet_don_hangs.san_pham',
            'chi_tiet_don_hangs.color_san_pham',
            'chi_tiet_don_hangs.size_san_pham',
            'chi_tiet_don_hangs.san_pham.danh_gias.user'
        ])->findOrFail($id);

        $tongGiaSp = $donhang->chi_tiet_don_hangs->sum('thanh_tien');

        // Trả về view cùng với dữ liệu đơn hàng
        return view('admin.vanchuyen.show', compact('donhang', 'tongGiaSp'));
    }
}
