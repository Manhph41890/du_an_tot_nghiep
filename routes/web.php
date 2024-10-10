<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaiVietController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\PhuongThucThanhToanController;
use App\Http\Controllers\PhuongThucVanChuyenController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\StaffController;
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


Route::get('/', function () {
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


// login
Route::get('/auth/login', [AuthController::class, 'showFormLogin'])->name('auth.login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// register
Route::get('/auth/register', [AuthController::class, 'showFormRegister'])->name('auth.register');
Route::post('/auth/register', [AuthController::class, 'register']);

//logout
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');


// // forgot password
// Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('auth.forgot_password');
// Route::post('send-email', [ForgotPasswordController::class, 'sendResetLinkEmails'])->name('auth.email');
// // // mã

// // Route::post('verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('auth.verifycode');
// //reset pass
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('auth.reset_password');
// Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('auth.update_password');


// Đường dẫn cho quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('auth.forgot_password');
Route::post('send-email', [ForgotPasswordController::class, 'sendResetLinkEmails'])->name('auth.email');

// Đường dẫn để xác thực mã
Route::post('verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('auth.verifycode');

// Đường dẫn để đặt lại mật khẩu
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('auth.reset_password');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('auth.update_password');

//pham qu
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});


// Route::middleware(['role:nhan_vien'])->group(function () {
//     Route::get('/staff', [StaffController::class, 'index'])->name('admin.dashboard');
// });

Route::middleware(['role:khach_hang'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('client.home');
});
