<?php

namespace App\Listeners;

use App\Events\Login;
use App\Models\vi_nguoi_dung;
use Illuminate\Auth\Events\Login as EventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        // Kiểm tra và tạo ví người dùng nếu chưa tồn tại
        vi_nguoi_dung::firstOrCreate(
            ['user_id' => $user->id],
            ['tong_tien' => 0],
        );
    }
}
