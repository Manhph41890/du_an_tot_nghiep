<?php

namespace App\Http\Controllers;

use App\Models\san_pham;
use Illuminate\Http\Request;

class ClientSanPhamController extends Controller
{
    //
    public function list()
    {
        $query = san_pham::query();
        $data = $query->with(['danh_muc', 'bien_the_san_phams.size', 'bien_the_san_phams.color'])->paginate(10);
        return view('client.sanpham.danhsach', compact('data'));
    }
}
