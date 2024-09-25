<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\PhuongThucThanhToanController;
use App\Models\phuong_thuc_thanh_toan;

use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\PhuongThucVanChuyenController;
use App\Http\Controllers\SanPhamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.home');
});
Route::resource('/danhmucs', DanhMucController::class);
Route::resource('/chucvus', ChucVuController::class);
Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);
Route::resource('/phuongthucvanchuyens', PhuongThucVanChuyenController::class);

Route::resource('/khuyenmais', KhuyenMaiController::class);
