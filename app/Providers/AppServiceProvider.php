<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\danh_muc;
use App\Models\don_hang;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // / Lấy số lượng đơn hàng mới và yêu cầu hủy
        $newOrdersCount = DB::table('don_hangs')->where('trang_thai_don_hang', 'Chờ xác nhận')->count();
        $cancelRequestsCount = DB::table('huy_don_hangs')->where('trang_thai', 'Chờ xác nhận hủy')->count();
        $duyet_rut_user = DB::table('ls_rut_vis')->where('trang_thai', 'Chờ duyệt')->count();
        $duyet_rut_shipper = DB::table('ls_rut_shippers')->where('trang_thai', 'Chờ xử lý')->count();
        $tongDonHang = DB::table('don_hangs')
            ->where('trang_thai_don_hang', 'Chờ xác nhận')
            ->where('user_id', Auth::id()) // Lọc theo ID người dùng hiện tại
            ->count();
        // Tạo biến notifications
        $notifications = [
            'donHangMoi' => $tongDonHang,
            'newOrdersCount' => $newOrdersCount,
            'cancelRequestsCount' => $cancelRequestsCount,
            'totalNotifications' => $newOrdersCount + $cancelRequestsCount,
            'duyet_rut_user' => $duyet_rut_user,
            'duyet_rut_shipper' => $duyet_rut_shipper,
            'duyet_rut_shipper_user' => $duyet_rut_shipper +  $duyet_rut_user
        ];

        // Chia sẻ biến notifications đến tất cả các view
        View::share('notifications', $notifications);
        //
        $viewMoney = DB::table('ls_rut_vis')->where('trang_thai', 'Chờ Duyệt')->count();
        View::share('viewMoney', $viewMoney);
        Paginator::useBootstrapFive();
        // Lấy dữ liệu từ database
        $danhmucs = danh_muc::query()->get();

        // Chia sẻ nhiều biến cùng lúc với tất cả các view
        view()->share([
            'danhmucs' => $danhmucs,
        ]);

        //
        View::composer('*', function ($view) {
            $view->with('globalSearchQuery', request()->query('search', ''));
        });

        // Chia sẻ biến cartItemsCount với tất cả các view
        View::composer('*', function ($view) {
            $userId = auth()->id();

            // Lấy cart của người dùng hiện tại
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                $cartItemsCount = 0;
            } else {
                // Lấy tất cả các mục trong giỏ hàng
                $cartItems = CartItem::where('cart_id', $cart->id)->get();

                // Đếm số lượng các mục khác nhau dựa trên san_pham_id, color_san_pham_id và size_san_pham_id
                $uniqueCartItems = $cartItems->groupBy(function ($item) {
                    return $item->san_pham_id . '-' . $item->color_san_pham_id . '-' . $item->size_san_pham_id;
                });

                // Số lượng các mục khác nhau
                $cartItemsCount = $uniqueCartItems->count();
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
        
    }
}
