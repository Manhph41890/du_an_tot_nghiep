<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\SanPhamController;

use App\Http\Controllers\VariantController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\HuyDonHangController;
use App\Http\Controllers\ClientSanPhamController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PhuongThucThanhToanController;
use App\Http\Controllers\PhuongThucVanChuyenController;
use App\Http\Controllers\RutTienController;
use App\Http\Controllers\Shipper\Controller\ShipperController;
use App\Models\ShipperProfit;

// Route trang chủ
Route::get('/', [HomeController::class, 'index'])->name('client.home');
// tìm kiếm toàn trang 
Route::get('/timkiem', [SearchController::class, 'search'])->name('global.search');


// Route cho client
Route::prefix('client')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::get('/sanphamchitiet/{id}', [HomeController::class, 'chiTietSanPham'])->name('sanpham.chitiet');

    // trang cửa hàng
    Route::get('/sanpham', [ClientSanPhamController::class, 'list'])->name('client.cuahang');
    // Route::get('/sanpham/{id}', [ClientSanPhamController::class, 'quick_view'])->name('client.quickview');

    Route::get('/baiviet', [HomeController::class, 'listBaiViet']);
    Route::get('/baivietchitiet/{id}', [HomeController::class, 'chiTietBaiViet']);
    //tam thoi 
    Route::get('/taikhoan', [TaiKhoanController::class, 'showAccountDetails'])->name('taikhoan.dashboard');

    Route::post('/taikhoan/update-thong-tin', [TaiKhoanController::class, 'updateThongtin'])->name('update_thongtin');
    Route::post('/taikhoan/update-avatar', [TaiKhoanController::class, 'updateAvatar'])->name('taikhoan.dashboard.avatar');

    Route::get('/taikhoan/myorder/{id}', [TaiKhoanController::class, 'showMyOrder'])->name('taikhoan.myorder');
    Route::get('/taikhoan/vinguoidung', [TaiKhoanController::class, 'viNguoiDung'])->name('taikhoan.vinguoidung');

    //Hủy đặt hàng
    Route::post('/taikhoan/cancel/{id}', [TaiKhoanController::class, 'cancel'])->name('taikhoan.cancel');
    Route::post('/huy-don-hang', [HuyDonHangController::class, 'store'])->name('huydonhang.store');
    Route::get('/huy-don-hang/{id}', [HuyDonHangController::class, 'showhuy'])->name('huydonhang.showhuy');
    // Route xác nhận hủy đơn hàng
    Route::post('/huydonhang/{id}/confirm', [HuyDonHangController::class, 'confirmCancel'])->name('huydonhang.confirm');
    // Route từ chối hủy đơn hàng
    Route::post('/huydonhang/{id}/reject', [HuyDonHangController::class, 'rejectCancel'])->name('huydonhang.reject');

    Route::post('/donhang/success/{id}', [TaiKhoanController::class, 'successOrder'])->name('donhangs.success');

    Route::get('/taikhoan/lichsugd/{id}', [TaiKhoanController::class, 'history'])->name('taikhoan.lichsugd');
    // Route::post('/taikhoan/avatar', [TaiKhoanController::class, 'updateAvatar'])->name('taikhoan.dashboard');

    Route::post('/withdraw', [RutTienController::class, 'withdraw'])->name('withdraw');
    Route::get('/rut-tien', [RutTienController::class, 'rut'])->name('taikhoan.rut-tien');

    Route::post('/loaded', [RutTienController::class, 'loaded'])->name('loaded');
    Route::get('/nap-tien', [RutTienController::class, 'nap'])->name('taikhoan.nap-tien');

    //danh mục
    Route::get('/danh-muc/{danhMucId}', [HomeController::class, 'showByCategory'])->name('client.showByCategory');

    Route::view('/giohang', 'client.giohang');
    Route::get('/gioithieu', [HomeController::class, 'gioithieu'])->name('client.gioithieu');
    Route::get('/lienhe', [HomeController::class, 'lienhe'])->name('client.lienhe');
    Route::get('/huongdanmuahang', [HomeController::class, 'hdmuahang'])->name('client.hdmuahang');
});

// Route đăng nhập
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showFormLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showFormRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Login gg fb
Route::get('auth/google', [SocialController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);
Route::post('auth/logout', [SocialController::class, 'logout'])->name('auth.logout');

// Route quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('auth.forgot_password');
Route::post('send-email', [ForgotPasswordController::class, 'sendResetLinkEmails'])->name('auth.email');
Route::post('verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('auth.verifycode');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('auth.reset_password');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('auth.update_password');


// Route cho các chức năng quản lý (admin)
Route::middleware(['auth', 'role:admin,nhan_vien'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'thong_ke_chung'])->name('thong_ke_chung');
    });

    Route::get('/staff', [StaffController::class, 'index'])->name('thong_ke');
    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');

    // Duyệt rút tiền admin
    Route::get('/ruttien', [RutTienController::class, 'duyetruttienAdmin'])->name('duyetruttienAdmin');
    Route::put('/duyetrut/{id}', [RutTienController::class, 'duyetRutAdmin'])->name('duyetRutAdmin');
    Route::put('/huyrut/{id}', [RutTienController::class, 'HuyRutAdmin'])->name('HuyRutAdmin');


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
    // quản lý người dùng 
    // Route cho quản lý người dùng
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/{userId}/updatechucvu', [UserController::class, 'updatechucvu'])->name('user.updatechucvu');

    Route::resource('/baiviets', BaiVietController::class);
    Route::resource('/phuongthucthanhtoans', PhuongThucThanhToanController::class);
    Route::resource('/phuongthucvanchuyens', PhuongThucVanChuyenController::class);
    Route::resource('/donhangs', DonHangController::class);
    Route::post('/donhang/{id}/confirm', [DonHangController::class, 'confirmOrder'])->name('donhangs.confirm');
    //
    Route::get('/xacnhanhuys', [HuyDonHangController::class, 'index'])->name('xacnhanhuy.index');
    // đánh giá
    Route::get('danhgia', [DanhGiaController::class, 'index'])->name('danhgia.index'); 

});

// Route cho người dùng (khách hàng)
Route::middleware(['auth', 'role:khach_hang,admin,nhan_vien'])->group(function () {
    Route::get('/danhgia/{id}', [DanhGiaController::class, 'show'])->name('danhgia.show');
    Route::get('/sanpham/search', [SanPhamController::class, 'search'])->name('sanpham.search');
    // Route giỏ hàng
    Route::get('/cart/backup', [CartController::class, 'backup'])->name('cart.backup');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/removeFromCart/{id}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
    Route::post('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.updateMultiple');
    Route::post('cart/remove-multiple', [CartController::class, 'removeMultiple'])->name('cart.removeMultiple');
    Route::post('/cart/update-price', [CartController::class, 'updatePrice'])->name('cart.updatePrice');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/order/add', [OrderController::class, 'add'])->name('order.add');
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/success_nhanhang', [OrderController::class, 'success_nhanhang'])->name('order.success_nhanhang');
    Route::get('/order/success_vi', [OrderController::class, 'success_vi'])->name('order.success_vi');
    Route::get('/cart/variant-price/{id}', [CartController::class, 'getVariantPrice']);

    Route::post('/apply-coupon', [OrderController::class, 'applyCoupon'])->name('apply.coupon');
    // 
    Route::get('/api/products/{categoryId}', [SanPhamController::class, 'getProductsByCategory']);
    Route::get('/danhgia/{id}', [DanhGiaController::class, 'show'])->name('danhgia.show');
    Route::post('/danhgia/{sanPhamid}/store', [DanhGiaController::class, 'store'])->name('danhgia.store');
});
// Shipper
Route::middleware(['auth', 'role:shipper'])->group(function () {
    Route::get('/shipper', [ShipperController::class, 'index'])->name('shipper.index');
    Route::post('shipper/xac-nhan-lay-don/{donHang}', [ShipperController::class, 'xacNhanLayDon'])->name('shipper.xac-nhan-lay-don');
    Route::get('shipper/show', [ShipperController::class, 'show'])->name('shipper.show');
    Route::post('shipper/update-status/{id}', [ShipperController::class, 'updateStatus'])->name('shipper.update-status');
    Route::get('/shipper/profits', [ShipperController::class, 'showProfits'])->name('shipper.profits');
    Route::get('/shipper/policy', [ShipperController::class, 'policy'])->name('shipper.policy');
    Route::post('/danhgia/shipper/{shipperId}', [ShipperController::class, 'storeShipperReview'])->name('danhgia.shipper.store');
});

// Route chi tiết đơn hàng
Route::get('/ctdonhang', [DonHangController::class, 'store'])->name('donhang.store');
// Tăng view sản phẩm(khi click vào sản phẩm)
Route::get('/san-phams/increment-views/{id}', [HomeController::class, 'incrementViews'])->name('san-phams.incrementViews');
