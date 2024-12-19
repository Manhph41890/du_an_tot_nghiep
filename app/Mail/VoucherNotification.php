<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoucherNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $voucherCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $voucherCode)
    {
        $this->user = $user;
        $this->voucherCode = $voucherCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Chúc mừng! Bạn đã nhận được voucher khuyến mãi')
            ->view('auth.voucher_notification')
            ->with([
                'user' => $this->user,
                'voucherCode' => $this->voucherCode,
            ]);
    }
}
