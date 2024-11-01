<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\danh_muc;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
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
        //
        Paginator::useBootstrapFive();
        // Lấy dữ liệu từ database
        $danhmucs = danh_muc::query()->get();

        // Chia sẻ nhiều biến cùng lúc với tất cả các view
        view()->share([
            'danhmucs' => $danhmucs,
        ]);

        // 
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