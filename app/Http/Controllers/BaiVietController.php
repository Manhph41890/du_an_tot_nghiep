<?php

namespace App\Http\Controllers;

use App\Models\bai_viet;
use App\Http\Requests\Storebai_vietRequest;
use App\Http\Requests\Updatebai_vietRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        if($startDate && $endDate){
            $baiviets= bai_viet::whereBetween('ngay_dang',[$startDate , $endDate])->paginate(5);

        }else{
            $baiviets= bai_viet::paginate(5);
        }


        $title = "Danh sách bài viết";

        return view('admin.baiviet.index', compact('user', 'baiviets', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $title = "Thêm mới bài viết";
        return view('admin.baiviet.create', compact('user', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storebai_vietRequest $request)
    {
        DB::beginTransaction();
        try {
            // Lấy toàn bộ dữ liệu từ form dưới dạng mảng
            $data_bai_viet = $request->all();

            // Gán user_id từ người dùng đang đăng nhập

            $data_bai_viet['user_id'] = auth()->id(); // Lấy ID của người hiện tại

            // Lấy ngày hiện tại để điền vào trường "Ngày Đăng"
            $data_bai_viet['ngay_dang'] = $request->input('ngay_dang', now());

            // Xử lý upload file hình ảnh bài viết
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
    public function show(bai_viet $bai_viet, $id)
    {
        $post = bai_viet::findOrFail($id);
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $title = "Chi tiết bai viet";
        return view('admin.baiviet.show', compact('post', 'user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bai_viet $bai_viet, $id)
    {
        //Tim bai viet theo id
        $post = bai_viet::findOrFail($id);
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $title = "Sửa mới sản phẩm";
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