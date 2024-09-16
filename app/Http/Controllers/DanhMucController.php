<?php

namespace App\Http\Controllers;

use App\Models\danh_muc;
use App\Http\Requests\Storedanh_mucRequest;
use App\Http\Requests\Updatedanh_mucRequest;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.danhmuc.index', compact('danhmucs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $title = "Thêm mới danh mục";
        return view('admin.danhmuc.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storedanh_mucRequest $request)
    {

        //
        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            if ($request->hasFile('anh_danh_muc')) {
                $filepath = $request->file('anh_danh_muc')->store('uploads/danhmucs', 'public');
            } else {
                $filepath = null;
            }
            $param['anh_danh_muc'] = $filepath;
            $param['is_active'] = $request->input('is_active', 0);
            danh_muc::create($param);
        }

        return redirect()->route('danhmucs.index')->with('success', 'Thêm danh mục thành công');
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
    public function edit(danh_muc $danh_muc, string $id)
    {
        //
        $title = "Cập nhật danh mục";
        $danhmuc = danh_muc::query()->findOrFail($id);
        return view('admin.danhmuc.edit', compact('danhmuc', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatedanh_mucRequest $request, string $id)
    {
        //
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            $danhMuc = danh_muc::findOrFail($id);
            if ($request->hasFile('anh_danh_muc')) {
                if ($danhMuc->anh_danh_muc && Storage::disk('public')->exists($danhMuc->anh_danh_muc)) {
                    Storage::disk('public')->delete($danhMuc->anh_danh_muc);
                }
                $filepath = $request->file('anh_danh_muc')->store('uploads/danhmuc', 'public');
            } else {
                $filepath = $danhMuc->anh_danh_muc;
            }
            $param['anh_danh_muc'] = $filepath;
            $param['is_active'] = $request->input('is_active', $danhMuc->is_active);

            // dd($param);
            $danhMuc->update($param);
        }

        return redirect()->route('danhmucs.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(danh_muc $danh_muc, string $id)
    {
        //
        $danhMuc = danh_muc::findOrFail($id);
        if ($danhMuc->anh_danh_muc) {
            Storage::disk('public')->delete($danhMuc->anh_danh_muc);
        }
        $danhMuc->delete();
        return redirect()->route('danhmucs.index')->with('success', 'Xóa danh mục thành công');
    }
}
