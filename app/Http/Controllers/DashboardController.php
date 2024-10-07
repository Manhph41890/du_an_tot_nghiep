<?php

namespace App\Http\Controllers;

use App\Models\danh_muc;
use App\Models\san_pham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Đếm tổng số sản phẩm
        $totalProducts = san_pham::sum('so_luong');

        // Lấy sản phẩm có nhiều views nhất
        $mostViewedProduct = san_pham::orderBy('views', 'desc')->first(); // Lấy sản phẩm có nhiều lượt xem nhất

        // Lấy 5 sản phẩm mới nhất
        $latestProducts = san_pham::orderBy('created_at', 'desc')->take(5)->get();

        // Đếm tổng số lượng người dùng
        $totalUsers = User::count();


        return view('admin.dashboard', compact('totalProducts', 'mostViewedProduct', 'latestProducts', 'totalUsers'));
    }
}
