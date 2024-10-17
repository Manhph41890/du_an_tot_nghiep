<?php

use App\Http\Controllers\DonhangController;
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


// Route trang chủ
Route::get('/', fn() => view('client.home'));

// Route cho client
Route::prefix('client')->group(function () {
    Route::view('/sanpham', 'client.sanpham.danhsach');
    Route::view('/sanphamchitiet', 'client.sanpham.sanphamct');
    Route::view('/baiviet', 'client.baiviet.baiviet');
    Route::view('/baivietchitiet', 'client.baiviet.baivietchitiet');
    Route::view('/taikhoan', 'client.taikhoan.dashboard');
    Route::view('/giohang', 'client.giohang');
    Route::view('/gioithieu', 'client.gioithieu');
    Route::view('/lienhe', 'client.lienhe');
    Route::view('/thanhtoan', 'client.thanhtoan');
});

// Route đăng nhập
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showFormLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showFormRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Route quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('auth.forgot_password');
Route::post('send-email', [ForgotPasswordController::class, 'sendResetLinkEmails'])->name('auth.email');
Route::post('verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('auth.verifycode');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('auth.reset_password');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('auth.update_password');

// Route cho các chức năng quản lý (admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Thống kê
    Route::prefix('dashboard')->group(function () {
        Route::get('/donhang', [AdminController::class, 'thong_ke_don_hang'])->name('thong_ke_don_hang');
        Route::get('/doanhthu', [AdminController::class, 'thong_ke_doanh_thu'])->name('thong_ke_doanh_thu');
        Route::get('/taikhoan', [AdminController::class, 'thong_ke_tai_khoan'])->name('thong_ke_tai_khoan');
        Route::get('/sanpham', [AdminController::class, 'thong_ke_san_pham'])->name('thong_ke_san_pham');
    });
    // profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile'); // Thêm route này

    // Resource routes cho quản lý
    Route::resource('/danhmucs', DanhMucController::class);
    Route::resource('/chucvus', ChucVuController::class);
    Route::resource('/sanphams', SanPhamController::class);
    Route::resource('/khuyenmais', KhuyenMaiController::class);
    Route::resource('/baiviets', BaiVietController::class);
    Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);
    Route::resource('/phuongthucvanchuyens', PhuongThucVanChuyenController::class);
    Route::resource('/donhangs', DonhangController::class);
});

// Route cho người dùng (khách hàng)
Route::middleware(['auth', 'role:khach_hang'])->group(function () {
    Route::get('/customer', fn() => view('client.home'));
    Route::get('danhgia', [DanhGiaController::class, 'index'])->name('danhgia.index');
    Route::get('/danhgia/{id}', [DanhGiaController::class, 'show'])->name('danhgia.show');
});

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user{id}', [UserController::class, 'show'])->name('user.show');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
