<?php

namespace App\Http\Controllers;

use App\Events\KhuyenMaiMoiEvent;
use App\Models\danh_muc;
use App\Models\khuyen_mai;
use App\Http\Requests\Storekhuyen_maiRequest;
use App\Http\Requests\Updatekhuyen_maiRequest;
use App\Policies\KhuyenMaiPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Pusher\Pusher;


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

        // Tự động cập nhật trạng thái dự trên ngày 
        $query->each(function ($promotion) {
            $currentDate = now();
            if ($currentDate->greaterThan($promotion->ngay_ket_thuc)) {
                // Mark promotion as expired if the current date is past 'ngay_ket_thuc'
                $promotion->is_active = 0;
            } elseif ($currentDate->between($promotion->ngay_bat_dau, $promotion->ngay_ket_thuc)) {
                // Mark promotion as active if the current date is between 'ngay_bat_dau' and 'ngay_ket_thuc'
                $promotion->is_active = 1;
            } else {
                // Mark promotion as inactive if current date is before 'ngay_bat_dau'
                $promotion->is_active = 0;
            }
            $promotion->save();
        });

        // Filter by 'is_active'
        if ($request->has('is_active') && $request->get('is_active') !== '') {
            $query->where('is_active', $request->get('is_active'));
        }

        // Search by 'ma_khuyen_mai'
        if ($request->has('search_km') && $request->input('search_km') !== null) {
            $query->where('ma_khuyen_mai', 'LIKE', "%{$request->input('search_km')}%");
        }

        // Lọc theo danh mục
        if ($request->has('danh_muc_id') && $request->get('danh_muc_id') !== '') {
            $query->where('danh_muc_id', $request->get('danh_muc_id'));
        }
        // Paginate results
        $khuyenMais = $query->latest('id')->paginate(5);

        $title = 'Danh sách khuyến mãi';
        $isAdmin = auth()->user()->chuc_vu->ten_chuc_vu === 'admin';

        return view('admin.khuyenmai.index', compact('danhmucs', 'khuyenMais', 'title', 'isAdmin'));
    }

    private function sendNotification($message)
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true
            ]
        );

        $data['message'] = $message;
        $pusher->trigger('promotion-channel', 'promotion-event', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', khuyen_mai::class);
        //
        $title = 'Tạo khuyến mãi';

        return view('admin.khuyenmai.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storekhuyen_maiRequest $request)
    {

        // admin tạo mã khuyến mãi
        $khuyen_mai =  khuyen_mai::create([
            'ten_khuyen_mai' => $request->input('ten_khuyen_mai'),
            // Sinh ngẫu nhiên mã khuyến mãi
            'ma_khuyen_mai' => strtoupper(Str::random(10)),
            'gia_tri_khuyen_mai' => $request->input('gia_tri_khuyen_mai'),
            'so_luong_ma' => $request->input('so_luong_ma'),
            'ngay_bat_dau' => $request->input('ngay_bat_dau'),
            'ngay_ket_thuc' => $request->input('ngay_ket_thuc'),
            'is_active' => $request->input('is_active'),

        ]);
        event(new KhuyenMaiMoiEvent($khuyen_mai));
        //check trong post man 
        $this->sendNotification("Bạn đã tạo thành công khuyến mãi mới: {$khuyen_mai->ten_khuyen_mai}");
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
        // if ($request->isMethod('PUT')) {

        //     $param = $request->except('_token', '_method');

        //     $khuyen_mai = khuyen_mai::findOrFail($id);

        //     $khuyen_mai->update($param);
        // }

        // return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');


        $khuyen_mai = khuyen_mai::findOrFail($id);
        $khuyen_mai->update($request->all());

        event(new KhuyenMaiMoiEvent($khuyen_mai));

        return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(khuyen_mai $khuyen_mai, string $id)
    {
        //

        // $khuyen_mai = khuyen_mai::findOrFail($id);
        // $this->authorize('delete', $khuyen_mai);
        // $khuyen_mai->delete();

        // return redirect()->route('khuyenmais.index')->with('success', 'Cập nhật mã khuyến mãi thành công');

        $khuyen_mai = khuyen_mai::findOrFail($id);
        $khuyen_mai->delete();

        event(new KhuyenMaiMoiEvent($khuyen_mai));

        return redirect()->route('khuyenmais.index')->with('success', 'Xóa mã khuyến mãi thành công');
    }
}
