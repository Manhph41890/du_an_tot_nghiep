<?php

namespace App\Http\Controllers;

use App\Models\phuong_thuc_van_chuyen;
use App\Http\Requests\Storephuong_thuc_van_chuyenRequest;
use App\Http\Requests\Updatephuong_thuc_van_chuyenRequest;

class PhuongThucVanChuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phuongthucvanchuyens = phuong_thuc_van_chuyen::query()->latest('id')->paginate(5);
        $title = "Phương thức vận chuyển";
        return view('admin.phuongthucvanchuyen.index', compact('phuongthucvanchuyens', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới PT Vận Chuyển";
        return view('admin.phuongthucvanchuyen.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storephuong_thuc_van_chuyenRequest $request)
    {
        // 
        $gia_ship = 0;

        switch ($request->kieu_van_chuyen) {
            case 'Giao hàng hỏa tốc':
                $gia_ship = 50000; // Giá ship cho Giao hàng hỏa tốc
                break;
            case 'Giao hàng thường':
                $gia_ship = 25000; // Giá ship cho Giao hàng thường
                break;
        }

        phuong_thuc_van_chuyen::create([
            'kieu_van_chuyen' => $request->kieu_van_chuyen,
            'gia_ship' => $gia_ship
        ]);

        return redirect()->route('phuongthucvanchuyens.index')
            ->with('success', 'Thêm phương thức vận chuyển thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(phuong_thuc_van_chuyen $phuong_thuc_van_chuyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(phuong_thuc_van_chuyen $phuong_thuc_van_chuyen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatephuong_thuc_van_chuyenRequest $request, phuong_thuc_van_chuyen $phuong_thuc_van_chuyen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(phuong_thuc_van_chuyen $phuong_thuc_van_chuyen, $id)
    {

        $phuongThucVanChuyen = $phuong_thuc_van_chuyen::findOrFail($id);
        $phuongThucVanChuyen->delete();

        return redirect()->route('phuongthucvanchuyens.index')
            ->with('success', 'Xóa phương thức vận chuyển thành công');
    }
}