<?php

namespace App\Http\Controllers;

use App\Models\bai_viet;
use App\Http\Requests\Storebai_vietRequest;
use App\Http\Requests\Updatebai_vietRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $user = User::query()->get();
        $query = bai_viet::query();

        // search theo trạng thái
        if ($request->has('search_bv')) {
            $is_active = $request->input('search_bv');
            if ($is_active == '1' || $is_active == '0') {
                $query->where('is_active', $is_active);
            }
        }

        // search theo tac gia
        if ($request->has('search_bv_tg')) {
            $tg = $request->input('search_bv_tg');
            if ($tg) {
                $query->where('user_id', $tg);
            }
        }

        // search form input
        if ($request->has('search_bv_td')) {
            $query->where('tieu_de_bai_viet', 'LIKE', "%{$request->input('search_bv_td')}%");
        }

        $baiviets = $query->with('user')->latest('id')->paginate(5);

        $title = "Danh sách bài viết";

        return view('admin.baiviet.index', compact('user', 'baiviets', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $title = "Thêm mới sản phẩm";
        return view('admin.baiviet.create', compact('user', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storebai_vietRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            // Lấy toàn bộ dữ liệu từ form dưới dạng mảng
            $data_bai_viet = $request->all();

            // Xử lý upload file hình ảnh bài viếts
            if ($request->hasFile('anh_bai_viet')) {
                $file = $request->file('anh_bai_viet');
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $data_bai_viet['anh_bai_viet'] = $file->storeAs('baiviets', $filename, 'public');
                } else {
                    return back()->withErrors(['anh_bai_viet' => 'File không hợp lệ']);
                }
            }

            // Tạo bản ghi mới trong bảng bai_viet
            bai_viet::create($data_bai_viet);

            DB::commit();
            return redirect()->route('baiviets.index')->with('success', 'Bai viet đã được thêm thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi thêm bai viet.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(bai_viet $bai_viet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bai_viet $bai_viet, $id)
    {
        //Tim bai viet theo id
        $post = bai_viet::findOrFail($id);
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $title = "Sua mới sản phẩm";
        return view('admin.baiviet.edit', compact('post', 'user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatebai_vietRequest $request, $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $post = bai_viet::findOrFail($id);

            // Lấy toàn bộ dữ liệu từ form dưới dạng mảng
            $data_bai_viet = $request->all();

            // Xử lý upload file hình ảnh bài viếts
            if ($request->hasFile('anh_bai_viet')) {
                $file = $request->file('anh_bai_viet');
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $data_bai_viet['anh_bai_viet'] = $file->storeAs('baiviets', $filename, 'public');
                } else {
                    return back()->withErrors(['anh_bai_viet' => 'File không hợp lệ']);
                }
            }

            // Tạo bản ghi mới trong bảng bai_viet
            $post->update($data_bai_viet);

            DB::commit();
            return redirect()->route('baiviets.index')->with('success', 'Bai viet đã được cập nhật thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Đã xảy ra lỗi khi thêm bai viet.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $post = bai_viet::findOrFail($id);

            if ($post->anh_bai_viet) {
                Storage::disk('public')->delete($post->anh_bai_viet);
            }

            $post->delete();

            DB::commit();
            return redirect()->route('baiviets.index')->with('success', 'Bài viết đã được xóa thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->withErrors('Đã xảy ra loi khi xóa bài viết.');
        }
    }
}
