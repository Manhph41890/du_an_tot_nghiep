<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class SendMail
{
    use Dispatchable, SerializesModels;

    public $email;
    public $ho_ten;
    public  $verificationCode;

    public function __construct($email, $ho_ten, $verificationCode)
    {
        $this->email = $email;
        $this->ho_ten = $ho_ten;
        $this-> verificationCode =  $verificationCode;
    }
}
