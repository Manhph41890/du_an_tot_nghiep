<?php

use App\Http\Controllers\BaiVietController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\PhuongThucThanhToanController;
use App\Http\Controllers\PhuongThucVanChuyenController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('/danhmucs', DanhMucController::class);
Route::resource('/chucvus', ChucVuController::class);
Route::resource('/sanphams', SanPhamController::class);
Route::resource('/chucvus', ChucVuController::class);
Route::resource('/sanphams', SanPhamController::class);
Route::resource('/khuyenmais', KhuyenMaiController::class);
Route::resource('/baiviets', BaiVietController::class);
Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);
Route::resource('/phuongthucvanchuyens', PhuongThucVanChuyenController::class);
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('danhgia', [DanhGiaController::class, 'index'])->name('danhgia.index');


Route::get('/client', function () {
    return view('client.home');
});
Route::get('/client/sanpham', function () {
    return view('client.sanpham.danhsach');
});
Route::get('/client/sanphamchitiet', function () {
    return view('client.sanpham.sanphamct');
});
Route::get('/client/baiviet', function () {
    return view('client.baiviet.baiviet');
});
Route::get('/client/baivietchitiet', function () {
    return view('client.baiviet.baivietchitiet');
});

Route::get('/client/taikhoan', function () {
    return view('client.taikhoan.dashboard');
});
Route::get('/client/giohang', function () {

    return view('client.giohang');
});
Route::get('/client/gioithieu', function () {
    return view('client.gioithieu');
});
Route::get('/client/lienhe', function () {
    return view('client.lienhe');
});
Route::get('/client/thanhtoan', function () {
    return view('client.thanhtoan');
});
