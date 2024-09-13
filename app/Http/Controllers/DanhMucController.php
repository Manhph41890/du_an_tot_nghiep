<?php

namespace App\Http\Controllers;

use App\Models\danh_muc;
use App\Http\Requests\Storedanh_mucRequest;
use App\Http\Requests\Updatedanh_mucRequest;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $danhmucs = danh_muc::query()->latest('id')->paginate(5);
        $title = "Danh sách danh mục";
        return view('admin.danhmuc.index', compact('danhmucs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.danhmuc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storedanh_mucRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(danh_muc $danh_muc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(danh_muc $danh_muc)
    {
        //
        return view('admin.danhmuc.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatedanh_mucRequest $request, danh_muc $danh_muc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(danh_muc $danh_muc)
    {
        //
    }
}
