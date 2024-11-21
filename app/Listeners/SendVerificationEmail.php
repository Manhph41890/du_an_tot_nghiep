<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\don_hang;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail
{
    /**
     * Create the event listener.
     */
    public function handle(SendMail $event)
    {
        $email = $event->email;
        $ho_ten = $event->ho_ten;
        $orderId = $event->orderId;
        $verificationCode = $event->verificationCode;

        // Send email
        Mail::send('auth.verify_code', ['ho_ten' => $ho_ten, 'token' => $verificationCode], function ($message) use ($email) {
            $message->to($email)
                ->subject('Mã xác thực để đặt lại mật khẩu');
        });


        // Lấy thông tin đơn hàng nếu cần
        $order = don_hang::find($orderId);

        // Gửi email
        Mail::send('auth.success_order', ['ho_ten' => $ho_ten, 'order' => $order], function ($message) use ($email) {
            $message->to($email)
                ->subject('Đặt hàng thành công');
        });
    }
}

//     public function handle(SendMail $event)
//     {
//         $email = $event->email;
//         $ho_ten = $event->ho_ten;
//         $verificationCode = $event->verificationCode;

//         try {
//             Mail::send('auth.verify_code', ['ho_ten' => $ho_ten, 'token' => $verificationCode], function ($message) use ($email) {
//                 $message->to($email)
//                     ->subject('Mã xác thực để đặt lại mật khẩu');
//             });
//         } catch (\Exception $e) {
//             Log::error('Error sending email: ' . $e->getMessage());
//         }
//     }
// } 


/**
 * Create the event listener.
 */
        // public function handle(SendMail $event)
        // {
        //     $email = $event->email;
        //     $ho_ten = $event->ho_ten;
        //     $verificationCode = $event->verificationCode;
    
        //     // Gửi email với mã OTP
        //     Mail::raw('Mã xác thực của bạn là: ' . $verificationCode, function ($message) use ($email) {
        //         $message->to($email)->subject('Mã xác thực để đặt lại mật khẩu');
        //     });
    
        //     Log::info('Email gửi mã xác thực đã được gửi tới: ' . $email);
        // }