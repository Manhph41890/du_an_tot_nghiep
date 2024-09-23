<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DanhMucController;

use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\StaffController;

use App\Http\Controllers\PhuongThucThanhToanController;
use App\Models\phuong_thuc_thanh_toan;




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
//check
// Route::get('/admin', function () {return view('admin.home');})->name('admin.home');
// Route::get('/khachhang', function () {return view('welcome');})->name('khach_hang.home');



Route::resource('/danhmucs', DanhMucController::class);
Route::resource('/sanphams', SanPhamController::class);


Route::get('/', function () {
    return view('admin.home');
});

Route::resource('/danhmucs', DanhMucController::class);
Route::resource('/sanphams', SanPhamController::class);

Route::resource('/chucvus', ChucVuController::class);
Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);

Route::resource('/khuyenmais', KhuyenMaiController::class);


// Route::resource('/auth', AuthController::class);


// login
Route::get('/auth/login', [AuthController::class, 'showFormLogin'])->name('auth.login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

// register
Route::get('/auth/register', [AuthController::class, 'showFormRegister'])->name('auth.register');
Route::post('/auth/register', [AuthController::class, 'register']);
 
// forgot password
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('auth.forgot_password');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('auth.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('auth.reset_password');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('auth.update_password');
//mail 
Route::get('verify-code', [AuthController::class, 'showVerifyCodeForm'])->name('auth.verify_code');
Route::post('verify-code', [AuthController::class, 'verifyCode'])->name('auth.verifycode');

//pham qu
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
});


// Route::middleware(['role:nhan_vien'])->group(function () {
//     Route::get('/staff', [StaffController::class, 'index'])->name('admin.home');
// });

Route::middleware(['role:khach_hang'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('welcome');
});



