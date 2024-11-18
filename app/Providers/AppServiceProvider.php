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
        ];


        // Chia sẻ biến notifications đến tất cả các view
        View::share('notifications', $notifications);

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

            // Nếu không có giỏ hàng, số lượng sản phẩm sẽ là 0
            if (!$cart) {
                $cartItemsCount = 0;
            } else {
                // Đếm số lượng sản phẩm khác nhau trong giỏ hàng
                $cartItemsCount = CartItem::where('cart_id', $cart->id)
                    ->distinct('san_pham_id')
                    ->count('san_pham_id');
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
    }
}
