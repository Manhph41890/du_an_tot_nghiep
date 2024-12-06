<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViController extends Controller
{
    public function indexBank()
    {
        $user = Auth::user();
        $bank = Bank::with('user')->get();
        return view('client.taikhoan.vi-tien', compact('user', 'bank'));
    }

    public function bank(Request $request) {}
}