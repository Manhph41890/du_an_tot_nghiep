<?php

namespace App\Http\Controllers;

use App\Models\bai_viet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    // In Data Bai viet
    public function listBaiViet()
    {
        $baiviets = bai_viet::with('user')->latest('id')->paginate(4);

        return view('client.baiviet.baiviet', compact('baiviets'));
    }
    // In chi tiet bai viet
    public function chiTietBaiViet($id)
    {
        $baiViet = bai_viet::with('user')->findOrFail($id);
        $docThem = bai_viet::with('user')->orderBy('id', 'desc')->limit(3)->get();
        return view('client.baiviet.baivietchitiet', compact('baiViet', 'docThem'));
    }
}