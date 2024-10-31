<?php

namespace App\Providers;

use App\Models\danh_muc;
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
    }
}
