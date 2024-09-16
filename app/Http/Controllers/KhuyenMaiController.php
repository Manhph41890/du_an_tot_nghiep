<?php

namespace App\Http\Controllers;

use App\Models\khuyen_mai;
use App\Http\Requests\Storekhuyen_maiRequest;
use App\Http\Requests\Updatekhuyen_maiRequest;
use App\Policies\KhuyenMaiPolicy;
use Illuminate\Support\Str;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $khuyenMais = khuyen_mai::all();
        return view('admin.khuyenmai.index', compact('khuyenMais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('admin.khuyenmai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storekhuyen_maiRequest $request)
    {
        // admin tạo mã khuyến mãi 
          khuyen_mai::create([
            'ten_khuyen_mai' =>$request ->input('ten_khuyen_mai'),
            // Sinh ngẫu nhiên mã khuyến mãi
            'ma_khuyen_mai' => strtoupper(Str::random(10)), 
            // Giá trị khuyến mãi admin nhập
            'gia_tri_khuyen_mai' => $request ->input('gia_tri_khuyen_mai'), 
            // Số lần sử dụng admin nhập
            'so_luong_ma' => $request ->input('so_luong_ma'), 
            'ngay_bat_dau' => $request ->input('ngay_bat_dau'),
            'ngay_ket_thuc' => $request ->input('ngay_ket_thuc'),
            'is_active' => $request ->input('is_active'),
            
        ]);
      
        





        return redirect()->route('khuyenmais.index')->with('success', 'Tạo mã khuyến mãi thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(khuyen_mai $khuyen_mai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(khuyen_mai $khuyen_mai ,string $id)
    {
        //
        $khuyenmais= khuyen_mai::findorfail($id);

        return view('admin.khuyenmai.edit',compact('khuyenmais'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatekhuyen_maiRequest $request, khuyen_mai $khuyen_mai ,string $id)
    {
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            $khuyen_mai = khuyen_mai::findOrFail($id);
            
            $khuyen_mai->update($param);
        }

     
       

        return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(khuyen_mai $khuyen_mai , string $id )
    {
        //
            $khuyen_mai = khuyen_mai::findOrFail($id);
            $khuyen_mai->delete();
            return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');
    }
}
