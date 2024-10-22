<?php

namespace App\Http\Controllers;

use App\Models\danh_muc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Storedanh_mucRequest;
use App\Http\Requests\Updatedanh_mucRequest;

class DanhMucController extends Controller
{

    public function index(Request $request)
    {

        $this->authorize('viewAny', danh_muc::class);
        $query = danh_muc::query();

        // lọc trạng thái
        if ($request->has('search_dm')) {
            $is_active = $request->input('search_dm');
            if ($is_active == '1' || $is_active == '0') {
                $query->where('is_active', $is_active);
            }
        }

        // lọc tên danh mục
        if ($request->has('search_ten_danh_muc') && !empty($request->input('search_ten_danh_muc'))) {
            $search_ten_danh_muc = $request->input('search_ten_danh_muc');
            $query->where('ten_danh_muc', 'like', '%' . $search_ten_danh_muc . '%');
        }

        $danhmucs = $query->latest('id')->paginate(5);

        $title = "Danh sách danh mục";
         $isAdmin = auth()->user()->chuc_vu->ten_chuc_vu === 'admin';
        return view('admin.danhmuc.index', compact('danhmucs', 'title','isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', danh_muc::class);
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
        }
        danh_muc::create($param);



        return redirect()->route('danhmucs.index')->with('success', 'Thêm danh mục thành công!');
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
        $this->authorize('update', $danh_muc);
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
            if ($param['is_active']) {
                $param['is_active'] = $request->input('is_active');
            } else {
                $param['is_active'] = $danhMuc->is_active;
            }

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
        if ($danhMuc->san_phams()->count() > 0) {
            return redirect()->back()->with('error', 'Không xóa danh mục vì có sản phẩm thuộc danh mục này.');
        } else {
            if ($danhMuc->anh_danh_muc) {
                Storage::disk('public')->delete($danhMuc->anh_danh_muc);
            }
            $danhMuc->delete();
            return redirect()->route('danhmucs.index')->with('success', 'Xóa danh mục thành công');
        }
    }
}
