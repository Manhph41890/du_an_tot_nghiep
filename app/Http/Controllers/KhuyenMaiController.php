<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\danh_muc;
use App\Models\khuyen_mai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Policies\KhuyenMaiPolicy;
use App\Http\Requests\Storekhuyen_maiRequest;
use App\Http\Requests\Updatekhuyen_maiRequest;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', khuyen_mai::class);
        $danhmucs = danh_muc::all();
        $query = khuyen_mai::query();

        $searchKM = $request->input('search_km');
        $isActive = $request->input('trang_thai');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if($searchKM){
            $khuyenMais=$query->where('ma_khuyen_mai', 'LIKE', "%{$searchKM}%")->paginate(10);
        } 
        if($startDate && $endDate){
            $khuyenMais= $query->whereBetween('ngay_bat_dau',[$startDate , $endDate])->paginate(10);

        }
        if ($isActive !== null && $isActive !== '') {
            $khuyenMais = $query->where('is_active', $isActive)->paginate(10);
        }

        $khuyenMais = $query->latest('id')->paginate(10);
        foreach ($khuyenMais as $item) {
            $item->ngay_bat_dau = Carbon::parse($item->ngay_bat_dau)->format('d-m-Y');
            $item->	ngay_ket_thuc = Carbon::parse($item->ngay_ket_thuc)->format('d-m-Y');
        }

        $title = 'Danh sách khuyến mãi';
        $isAdmin = auth()->user()->chuc_vu->ten_chuc_vu === 'admin';
        return view('admin.khuyenmai.index', compact('danhmucs', 'khuyenMais', 'title', 'isAdmin', 'searchKM', 'isActive', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', khuyen_mai::class);
        //
        $title = 'Tạo khuyến mãi mới';

        return view('admin.khuyenmai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storekhuyen_maiRequest $request)
    {
        // admin tạo mã khuyến mãi
        khuyen_mai::create([
            'ten_khuyen_mai' => $request->input('ten_khuyen_mai'),
            // Sinh ngẫu nhiên mã khuyến mãi
            'ma_khuyen_mai' => strtoupper(Str::random(10)),
            'gia_tri_khuyen_mai' => $request->input('gia_tri_khuyen_mai'),
            'so_luong_ma' => $request->input('so_luong_ma'),
            'ngay_bat_dau' => $request->input('ngay_bat_dau'),
            'ngay_ket_thuc' => $request->input('ngay_ket_thuc'),
            'is_active' => $request->input('is_active'),
        ]);

        return redirect()->route('khuyenmais.index')->with('success', 'Tạo mã khuyến mãi thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(khuyen_mai $khuyen_mai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(khuyen_mai $khuyen_mai, string $id)
    {
        //
        $khuyenmais = khuyen_mai::findorfail($id);
        $this->authorize('update', $khuyen_mai);
        $title = 'Cập nhật khuyến mãi';

        return view('admin.khuyenmai.edit', compact('khuyenmais', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatekhuyen_maiRequest $request, khuyen_mai $khuyen_mai, string $id)
    {
        if ($request->isMethod('PUT')) {

            $param = $request->except('_token', '_method');

            $khuyen_mai = khuyen_mai::findOrFail($id);

            $khuyen_mai->update($param);
        }

        return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(khuyen_mai $khuyen_mai, string $id)
    {
        //

        $khuyen_mai = khuyen_mai::findOrFail($id);
        $this->authorize('delete', $khuyen_mai);
        $khuyen_mai->delete();

        return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');
    }
}
