<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
