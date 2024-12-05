<?php

namespace App\Listeners;

use App\Events\Login;
use App\Models\Shipper;
use App\Models\vi_nguoi_dung;
use App\Models\Vishipper;
use Illuminate\Auth\Events\Login as EventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateWalletOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsLogin $event): void
    {
        $user = $event->user; // Người dùng vừa đăng nhập

        if ($user->chuc_vu_id == 5) {
            try {
                // Tạo hoặc lấy ví Shipper
                Vishipper::firstOrCreate(['shipper_id' => $user->id], ['tong_tien' => 0]);
                Log::info('Đã tạo ví or ví đã tồn tại', ['shipper_id' => $user->id]);
            } catch (\Exception $e) {
                Log::error('Tạo ví shipper thất bại', [
                    'userId' => $user->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        try {
            // Kiểm tra và tạo ví người dùng nếu chưa tồn tại
            vi_nguoi_dung::firstOrCreate(['user_id' => $user->id], ['tong_tien' => 0]);
            Log::info('Đã tồn tại ví ngươi dùng', ['user_id' => $user->id]);
        } catch (\Exception $e) {
            Log::error('Tạo ví người dùng thất bại', [
                'userId' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}