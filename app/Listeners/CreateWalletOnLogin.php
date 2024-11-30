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
            if (Shipper::where('id', $user->id)->exists()) {
                $Vishipper = Vishipper::firstOrCreate(
                    ['shipper_id' => $user->id],
                    ['tong_tien' => 0]
                );
                if (is_null($Vishipper)) {
                    Log::error('Tạo ví shipper thất bại', ['userId' => $user->id]);
                } else {
                    $Vishipper->tong_tien = 0;
                }
            } else {
                Log::error('Shipper ID không tồn tại', ['userId' => $user->id]);

            }
        }
        // Kiểm tra và tạo ví người dùng nếu chưa tồn tại
        vi_nguoi_dung::firstOrCreate(
            ['user_id' => $user->id],
            ['tong_tien' => 0],
        );
    }
}
