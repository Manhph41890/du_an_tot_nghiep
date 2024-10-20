<?php

namespace App\Http\Controllers;

use App\Models\don_hang;
use App\Http\Requests\Storedon_hangRequest;
use App\Http\Requests\Updatedon_hangRequest;
use App\Models\khuyen_mai;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donhangs = don_hang::with('user')->get();
        $title = "Danh sách đơn hàng";

        $choXacNhan = don_hang::where('trang_thai', 'Chờ xác nhận')->get();
        $daXacNhan = don_hang::where('trang_thai', 'Đã xác nhận')->get();
        $dangChuanBi = don_hang::where('trang_thai', 'Đang chuẩn bị hàng')->get();
        $dangVanChuyen = don_hang::where('trang_thai', 'Đang vận chuyển')->get();
        $daGiao = don_hang::where('trang_thai', 'Đã giao')->get();
        $thanhCong = don_hang::where('trang_thai', 'Thành công')->get();
        $daHuy = don_hang::where('trang_thai', 'Đã hủy')->get();

        // dd($donhangs);
        // dump($donhangs);
        return view('admin.donhang.index', compact(
            'donhangs',
            'title',
            'choXacNhan',
            'daXacNhan',
            'dangChuanBi',
            'dangVanChuyen',
            'daGiao',
            'thanhCong',
            'daHuy'
        ));
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
        $donhang = don_hang::findOrFail($id);
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $khuyenmai = khuyen_mai::query()->pluck('ten_khuyen_mai', 'id')->all();
        $pttt = phuong_thuc_thanh_toan::query()->pluck('kieu_thanh_toan', 'id')->all();
        $ptvc = phuong_thuc_van_chuyen::query()->pluck('kieu_van_chuyen', 'id')->all();

        $title = "Chi tiết đơn hàng";
        return view('admin.donhang.show', compact('donhang', 'user', 'title', 'khuyenmai', 'pttt', 'ptvc'));
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
            return redirect()->route('donhangs.index')->with('success', 'Bai viet đã được cập nhật thành công.');
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
