<?php

namespace App\Http\Controllers;

use App\Models\phuong_thuc_thanh_toan;
use App\Http\Requests\Storephuong_thuc_thanh_toanRequest;
use App\Http\Requests\Updatephuong_thuc_thanh_toanRequest;

class PhuongThucThanhToanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phuongthucthanhtoans = phuong_thuc_thanh_toan::query()->latest('id')->paginate(5);
        $title = "Phương thức thanh toán";
        return view('admin.phuongthucthanhtoan.index', compact('phuongthucthanhtoans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới PT Thanh toán";
        return view('admin.phuongthucthanhtoan.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storephuong_thuc_thanh_toanRequest $request)
    {
        phuong_thuc_thanh_toan::create($request->all());
        
        return redirect()->route('phuongthucthanhtoans.index')->with('success', 'Thêm phương thức thanh toán thành công');
    }

    /**
     * Display the specified resource.
     */
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(phuong_thuc_thanh_toan $phuong_thuc_thanh_toan , $id)
    {
        $title = "Cập nhật phương thức thanh toán";
        $phuong_thuc_thanh_toan = phuong_thuc_thanh_toan::query()->findOrFail($id);
        return view('admin.phuongthucthanhtoan.edit', compact('title', 'phuong_thuc_thanh_toan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatephuong_thuc_thanh_toanRequest $request, phuong_thuc_thanh_toan $phuong_thuc_thanh_toan, $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            $phuong_thuc_thanh_toan = phuong_thuc_thanh_toan::findOrFail($id);
            $phuong_thuc_thanh_toan->update($param);
        }

        return redirect()->route('phuongthucthanhtoans.index')->with('success', 'Cập nhật phương thức thanh toán thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(phuong_thuc_thanh_toan $phuong_thuc_thanh_toan)
    {
        //
    }
}
