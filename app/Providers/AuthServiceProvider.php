<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\chuc_vu;
use App\Models\danh_gia;
use App\Models\danh_muc;
use App\Models\khuyen_mai;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use App\Models\san_pham;
use App\Models\User;
use App\Policies\ChucVuPolicy;
use App\Policies\DanhGiaPolicy;
use App\Policies\DanhMucPolicy;
use App\Policies\KhuyenMaiPolicy;
use App\Policies\PhuongThucThanhToanPolicy;
use App\Policies\PhuongThucVanChuyenPolicy;
use App\Policies\SanPhamPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        danh_muc::class => DanhMucPolicy::class,
        san_pham::class => SanPhamPolicy::class,
        chuc_vu::class =>ChucVuPolicy::class,
        khuyen_mai::class => KhuyenMaiPolicy::class,
        danh_gia::class => DanhGiaPolicy::class,
        phuong_thuc_thanh_toan::class => PhuongThucThanhToanPolicy::class,
        phuong_thuc_van_chuyen::class => PhuongThucVanChuyenPolicy::class,
        User::class => UserPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
}
