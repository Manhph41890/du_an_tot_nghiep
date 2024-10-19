<?php

namespace App\Http\Controllers;

use App\Models\don_hang;
use App\Http\Requests\Storedon_hangRequest;
use App\Http\Requests\Updatedon_hangRequest;
use App\Models\User;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donhangs = don_hang::with('user')->get();

        $title = "Danh sách đơn hàng";
        // dd($donhangs);
        // dump($donhangs);
        return view('admin.donhang.index', compact('donhangs', 'title'));
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
    public function store(Storedon_hangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(don_hang $don_hang, $id)
    {
        $donhang = don_hang::firstOrFail($id);
        $user = User::query()->pluck('ho_ten', 'id')->all();
        $title = "Chi tiết đơn hàng";
        return view('admin.donhang.show', compact('donhang', 'user', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(don_hang $don_hang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatedon_hangRequest $request, don_hang $don_hang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(don_hang $don_hang)
    {
        //
    }
}