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
            $query->where('trang_thai', $request->status);
        }

        // Lấy danh sách đơn hàng sau khi áp dụng bộ lọc
        $donhangs = $query->get();
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
    public function storet(Storedon_hangRequest $request)
    {
        $title = "Create a new resource";
        return view('admin.donhang.chitiet', compact('title'));
    }

    /**
     * Display the specified resource.
     */
    public function show(don_hang $don_hang, $id)
    {
        $donhang = don_hang::with([
            'user',
            'san_phams',
            'khuyen_mai',
            'phuong_thuc_thanh_toan',
            'phuong_thuc_van_chuyen',
            'chi_tiet_don_hangs',
            'bien_the_san_pham',
            'san_phams.danh_gias'
        ])->findOrFail($id);

        // Trả về view cùng với dữ liệu đơn hàng
        return view('admin.donhang.show', compact('donhang'));
    }
    public function confirmOrder($id)
    {
        $donhang = don_hang::findOrFail($id);

        // Cập nhật trạng thái đơn hàng sang "Đã xác nhận"
        $donhang->trang_thai = 'Đã xác nhận';
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
    public function update(Updatedon_hangRequest $request, don_hang $don_hang, $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $donhang = don_hang::findOrFail($id);

            // Lấy toàn bộ dữ liệu từ form dưới dạng mảng
            $data_don_hang = $request->all();

            // Tạo bản ghi mới trong bảng bai_viet
            $donhang->update($data_don_hang);

            DB::commit();
            return redirect()->route('donhangs.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi thêm bai viet.');
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