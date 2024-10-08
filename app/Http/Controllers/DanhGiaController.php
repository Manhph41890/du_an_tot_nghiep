<?php

namespace App\Http\Controllers;

use App\Models\danh_gia;
use App\Http\Requests\Storedanh_giaRequest;
use App\Http\Requests\Updatedanh_giaRequest;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    
        $query = danh_gia::query();

        // Lọc điểm số từ 0 đến 10
        if ($request->has('diem_so')) {
            $diem_so = $request->input('diem_so');

            // Kiểm tra xem 'diem_so' có phải là số hợp lệ và nằm trong khoảng 0 đến 10
            if (is_numeric($diem_so) && $diem_so >= 0 && $diem_so <= 10) {
                $query->where('diem_so', $diem_so);
            }
        }

        // Lọc theo tên sản phẩm
        if ($request->has('search_product_name') && !empty($request->input('search_product_name'))) {
            $search_product_name = $request->input('search_product_name');
            $query->whereHas('users', function ($q) use ($search_product_name) {
                $q->where('ho_ten', 'like', '%' . $search_product_name . '%');
            });
        }

        // Lấy danh sách đã lọc
        $params = [];
        $params['list'] = $query->get(); // Execute the query to get results
        return view('admin.danhgia.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storedanh_giaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(danh_gia $danh_gia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(danh_gia $danh_gia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatedanh_giaRequest $request, danh_gia $danh_gia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(danh_gia $danh_gia)
    {
        //
    }
}
