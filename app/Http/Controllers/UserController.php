<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = User::with('chuc_vu'); // Nạp dữ liệu chức vụ cùng với người dùng

        // Lọc trạng thái nếu có
        if ($request->has('search_dm')) {
            $is_active = $request->input('search_dm');
            if ($is_active == '1' || $is_active == '0') {
                $query->where('is_active', $is_active);
            }
        }

        // Lọc theo tên sản phẩm
        if ($request->has('search_product_name') && !empty($request->input('search_product_name'))) {
            $search_product_name = $request->input('search_product_name');
            $query->whereHas('chuc_vu', function ($q) use ($search_product_name) {
                $q->where('ten_chuc_vu', 'like', '%' . $search_product_name . '%');
            });
            $query->orWhere(function ($q) use ($search_product_name) {
                $q->where('ho_ten', 'like', '%' . $search_product_name . '%');
            });
            $query->orWhere(function ($q) use ($search_product_name) {
                $q->where('email', 'like', '%' . $search_product_name . '%');
            });
            $query->orWhere(function ($q) use ($search_product_name) {
                $q->where('so_dien_thoai', 'like', '%' . $search_product_name . '%');
            });
        }


        $params = [];
        $params['list'] = $query->get(); // Lấy danh sách người dùng
        return view('admin.user.index', $params);
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);  // Tìm đánh giá theo id
        // dd($danhgia);

        // Trả về view admin.danhgia.show với dữ liệu đánh giá
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Validate dữ liệu từ form
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng ảnh
            'dia_chi' => 'nullable|string|max:255',
        ]);

        // Ghi log thông tin người dùng và dữ liệu yêu cầu
        Log::info('User data before update:', $user->toArray());
        Log::info('Request data:', $request->all());

        // Cập nhật tên người dùng
        $user->ho_ten = $request->ho_ten;
        $user->dia_chi = $request->dia_chi;

        // Xử lý ảnh đại diện
        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu cần thiết
            if ($user->anh_dai_dien) {
                Storage::delete('public/' . $user->anh_dai_dien); // Xóa ảnh cũ
            }

            // Lưu ảnh mới vào storage/app/public/user
            $imageName = time() . '_' . $request->file('anh_dai_dien')->getClientOriginalName();
            $path = $request->file('anh_dai_dien')->storeAs('public/user', $imageName);

            // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
            $user->anh_dai_dien = 'user/' . $imageName; // Chỉ lưu đường dẫn tương đối
        }

        // Lưu người dùng
        $user->save();

        // Chuyển hướng về trang profile hoặc thông báo thành công
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
