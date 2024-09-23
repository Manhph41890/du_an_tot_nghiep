<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bai_viet extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'tieu_de_bai_viet',
        'anh_bai_viet',
        'ngay_dang',
        'noi_dung'
    ];
}