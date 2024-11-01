<?php

use App\Http\Controllers\DonHangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\ClientSanPhamController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KhuyenMaiController;

use App\Http\Controllers\PhuongThucThanhToanController;
use App\Http\Controllers\PhuongThucVanChuyenController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantController;


// Route trang chủ
Route::get('/', [HomeController::class, 'index'])->name('client.home');

// Route cho client
Route::prefix('client')->group(function () {

    Route::get('/sanphamchitiet/{id}', [HomeController::class, 'chiTietSanPham'])->name('sanpham.chitiet');

    // trang cửa hàng
    Route::get('/sanpham', [ClientSanPhamController::class, 'list'])->name('client.cuahang');
    Route::get('/sanpham/{id}', [ClientSanPhamController::class, 'quick_view'])->name('client.quickview');

    Route::get('/baiviet', [HomeController::class, 'listBaiViet']);
    Route::get('/baivietchitiet/{id}', [HomeController::class, 'chiTietBaiViet']);
    Route::view('/taikhoan', 'client.taikhoan.dashboard');
    Route::view('/giohang', 'client.giohang');
    Route::view('/gioithieu', 'client.gioithieu');
    Route::get('/lienhe', [HomeController::class, 'lienhe'])->name('client.lienhe');
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
Route::middleware(['auth', 'role:admin', 'role:nhan-vien'])->group(function () {
    // Thống kê
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'thong_ke_chung'])->name('thong_ke_chung');
        // Route::get('/doanhthu', [AdminController::class, 'thong_ke_doanh_thu'])->name('thong_ke_doanh_thu');
    });

    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');

    // Resource routes cho quản lý
    Route::resource('/danhmucs', DanhMucController::class);
    Route::resource('/chucvus', ChucVuController::class);
    Route::resource('/sanphams', SanPhamController::class);
    Route::resource('/khuyenmais', KhuyenMaiController::class);

    // Quản lý biến thể
    Route::get('variants', [VariantController::class, 'index'])->name('variants.index');
    Route::post('variants/colors', [VariantController::class, 'storeColor'])->name('variants.colors.store');
    Route::post('variants/sizes', [VariantController::class, 'storeSize'])->name('variants.sizes.store');
    Route::get('variants/colors/{id}/edit', [VariantController::class, 'editColor'])->name('variants.colors.edit');
    Route::put('variants/colors/{id}', [VariantController::class, 'updateColor'])->name('variants.colors.update');
    Route::delete('variants/colors/{colorId}', [VariantController::class, 'destroyColor'])->name('variants.colors.destroy');

    Route::get('variants/sizes/{id}/edit', [VariantController::class, 'editSize'])->name('variants.sizes.edit');
    Route::put('variants/sizes/{id}', [VariantController::class, 'updateSize'])->name('variants.sizes.update');
    Route::delete('variants/sizes/{id}', [VariantController::class, 'destroySize'])->name('variants.sizes.destroy');



    Route::resource('/baiviets', BaiVietController::class);
    Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);
    Route::resource('/phuongthucvanchuyens', PhuongThucVanChuyenController::class);
    Route::resource('/donhangs', DonHangController::class);
    Route::post('/donhang/{id}/confirm', [DonHangController::class, 'confirmOrder'])->name('donhangs.confirm');
    Route::get('danhgia', [DanhGiaController::class, 'index'])->name('danhgia.index');
    // Route::get('/danhgia/create', [DanhGiaController::class, 'create'])->name('danhgia.create');
    Route::post('/danhgia', [DanhGiaController::class, 'store'])->name('danhgia.store');
    Route::get('/danhgia/{id}', [DanhGiaController::class, 'show'])->name('danhgia.show');
});

// Route cho người dùng (khách hàng)
Route::middleware(['auth', 'role:khach_hang'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('danhgia', [DanhGiaController::class, 'index'])->name('danhgia.index');
    Route::get('/danhgia/{id}', [DanhGiaController::class, 'show'])->name('danhgia.show');
    Route::get('/sanpham/search', [SanPhamController::class, 'search'])->name('sanpham.search');
    // Route giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    // Route Đơn hàng 
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
});

// Route cho nhân viên (quản lý)
Route::middleware(['auth', 'role:nhan_vien'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('thong_ke');
    // Route::get('/', [StaffController::class, 'index'])->name('thong_ke_chung');
    Route::resource('/danhmucs', DanhMucController::class);
    Route::resource('/chucvus', ChucVuController::class);
    Route::resource('/khuyenmais', KhuyenMaiController::class);
    Route::resource('/baiviets', BaiVietController::class);
    Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);
    Route::resource('/phuongthucvanchuyens', PhuongThucVanChuyenController::class);
});

// Route cho quản lý người dùng
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user{id}', [UserController::class, 'show'])->name('user.show');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::put('/user/{userId}/updatechucvu', [UserController::class, 'updatechucvu'])->name('user.updatechucvu');
// Route chi tiết đơn hàng
Route::get('/ctdonhang', [DonHangController::class, 'store'])->name('donhang.store');