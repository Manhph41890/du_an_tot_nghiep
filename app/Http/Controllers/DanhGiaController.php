<?php

namespace App\Http\Controllers;

use App\Models\danh_gia;
use App\Http\Requests\Storedanh_giaRequest;
use App\Http\Requests\Updatedanh_giaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = danh_gia::query();
        $title = "Đánh giá";

        // Lọc điểm số từ 0 đến 5
        if ($request->has('diem_so')) {
            $diem_so = $request->input('diem_so');

            // Kiểm tra xem 'diem_so' có phải là số hợp lệ và nằm trong khoảng 0 đến 10
            if (is_numeric($diem_so) && $diem_so >= 1 && $diem_so <= 5) {
                $query->where('diem_so', $diem_so);
            }
        }

        // Lọc theo tên sản phẩm
        if ($request->has('search_product_name') && !empty($request->input('search_product_name'))) {
            $search_product_name = $request->input('search_product_name');
            $query->whereHas('san_phams', function ($q) use ($search_product_name) {
                $q->where('ten_san_pham', 'like', '%' . $search_product_name . '%');
            });
        }


        // Lấy danh sách đã lọc
        $params = [];
        $params['list'] = $query->get();
        $params['title'] = "Danh sách";
        return view('admin.danhgia.index', $params);
        // $params['list'] = danh_gia::all();
        // return view('admin.danhgia.index', $params);
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

        $request->validate([
            'diem_so' => 'required|integer|min:1|max:5',
            'binh_luan' => 'required|string|max:100',
        ]);
        // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
        $da_danh_gia_sp_id = danh_gia::where('san_pham_id', $request->san_pham_id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($da_danh_gia_sp_id) {
            return redirect()->back()->with('error', 'Bạn chỉ được đánh giá sản phẩm này một lần.');
        }
        $danhGia = new danh_gia();
        $danhGia->san_pham_id = $request->san_pham_id;
        $danhGia->user_id = auth()->user()->id;
        $danhGia->ngay_danh_gia = now();
        $danhGia->diem_so = $request->diem_so;
        $danhGia->binh_luan = $request->binh_luan;
        $danhGia->save();

        return redirect()->back()->with('success', 'Đánh giá thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $danhgia = danh_gia::findOrFail($id);  
       
        return view('admin.danhgia.show', compact('danhgia'));
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
