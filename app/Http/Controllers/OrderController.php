<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $title = "Đơn hàng";
        return view('client.order.index', compact('title'));
    }
}