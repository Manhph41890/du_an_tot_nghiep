<?php

namespace App\Http\Controllers;

use App\Models\san_pham;
use App\Http\Requests\Storesan_phamRequest;
use App\Http\Requests\Updatesan_phamRequest;
use App\Models\color_san_pham;
use App\Models\danh_muc;
use App\Models\size_san_pham;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = san_pham::query()->with('danh_muc')->latest('id')->paginate(5);
        // dd($data);
        $title = 'Danh Sách Sản Phẩm';
        return view('admin.sanpham.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $danh_mucs = danh_muc::query()->pluck('ten_danh_muc', 'id')->all();
        $colors = color_san_pham::query()->pluck('ten_color', 'id')->all();
        $sizes = size_san_pham::whereNotNull('ten_size')->whereNotNull('id')->pluck('ten_size', 'id')->all();
        $title = "Thêm mới sản phẩm";

        return view('admin.sanpham.create', compact('danh_mucs', 'colors', 'sizes', 'title'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Storesan_phamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(san_pham $san_pham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(san_pham $san_pham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesan_phamRequest $request, san_pham $san_pham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(san_pham $san_pham)
    {
        //
    }
}
