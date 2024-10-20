<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khuyen_mai extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_khuyen_mai',
        'ma_khuyen_mai',
        'gia_tri_khuyen_mai',
        'so_luong_ma',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'user_id',
        'is_active',
    ];

    public function don_hangs()
    {
        return $this->hasMany(don_hang::class);
    }
    public function khachhang_new()
    {
        return $this->belongsTo(User::class);
    }
    {
        return $this->belongsTo(User::class);
    }
}