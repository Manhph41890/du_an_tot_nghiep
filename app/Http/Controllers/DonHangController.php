<?php

namespace App\Http\Controllers;

use App\Models\chi_tiet_don_hang;
use App\Models\don_hang;
use App\Http\Requests\Storedon_hangRequest;
use App\Http\Requests\Updatedon_hangRequest;
use App\Models\khuyen_mai;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use App\Models\san_pham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Khởi tạo query để áp dụng các bộ lọc
        $query = don_hang::with('user');

        // Lọc theo khoảng ngày tạo đơn hàng
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('ngay_tao', [$request->start_date, $request->end_date]);
        }

        // Lọc theo tên người đặt hàng
        if ($request->has('user_name') && !empty($request->user_name)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('ho_ten', 'like', '%' . $request->user_name . '%');
            });
        }

        // Lọc theo trạng thái đơn hàng từ tab hiện tại
        if ($request->has('status') && !empty($request->status)) {
            $query->where('trang_thai_don_hang', $request->status);
        }

        // Lấy danh sách đơn hàng sau khi áp dụng bộ lọc
        $donhangs = $query->latest('id')->paginate(6);
        $title = "Danh sách đơn hàng";

        return view('admin.donhang.index', compact('donhangs', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storedon_hangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
        $donhang->tong_tien = $donhang->chi_tiet_don_hangs->sum('thanh_tien');
        // Trả về view cùng với dữ liệu đơn hàng
        return view('admin.donhang.show', compact('donhang'));
    }
    public function confirmOrder($id)
    {
        $donhang = don_hang::findOrFail($id);

        // Cập nhật trạng thái đơn hàng sang "Đã xác nhận"
        $donhang->trang_thai_don_hang = 'Đã xác nhận';
        $donhang->save();

        return redirect()->route('donhangs.index')->with('success', 'Đơn hàng đã được xác nhận thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(don_hang $don_hang, $id)
    {
        $donhang = don_hang::findOrFail($id);
        $title = "Cập nhật đơn hàng";


        return view('admin.donhang.edit', compact('donhang', 'title'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $donhang = don_hang::findOrFail($id);

            // Cập nhật trạng thái đơn hàng
            $donhang->update(['trang_thai_don_hang' => $request->input('trang_thai_don_hang')]);


            // Xác định trạng thái tiếp theo (giả sử các trạng thái được liệt kê theo thứ tự)
            $statuses = [
                'Chờ xác nhận',
                'Đã xác nhận',
                'Đang chuẩn bị hàng',
                'Đang vận chuyển',
                'Đã giao',
                'Thành công',
                'Đã hủy'
            ];

            $currentStatus = $donhang->trang_thai_don_hang;  // Lấy trạng thái hiện tại từ đơn hàng
            $currentStatusIndex = array_search($currentStatus, $statuses);
            $nextStatus = '';

            // Tính toán trạng thái tiếp theo, tránh lỗi ngoài mảng
            if ($currentStatusIndex !== false && isset($statuses[$currentStatusIndex + 1])) {
                $nextStatus = $statuses[$currentStatusIndex];  // Lấy trạng thái tiếp theo
            }

            // Nếu có trạng thái tiếp theo, chuyển hướng đến trạng thái đó
            DB::commit();

            // Redirect đến trang danh sách đơn hàng với trạng thái tiếp theo
            return redirect()->route('donhangs.index', ['status' => $nextStatus])
                ->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(don_hang $don_hang)
    {
        //
    }
}
