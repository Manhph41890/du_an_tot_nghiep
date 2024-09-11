<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phuong_thuc_thanh_toan extends Model
{
    use HasFactory;
    protected $fillable = ['kieu_thanh_toan'];
    protected $casts = [
        'kieu_thanh_toan' => ['Thanh toán online', 'Thanh toán khi nhận hàng']
    ];
    //casts dung cho kieu du lieu booleans vs enums
}
