<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phuong_thuc_van_chuyen extends Model
{
    use HasFactory;
    protected $fillable = ['kieu_van_chuyen'];
    protected $casts = [
        'kieu_van_chuyen' => ['Thanh toán online', 'Thanh toán khi nhận hàng']
    ];
}
