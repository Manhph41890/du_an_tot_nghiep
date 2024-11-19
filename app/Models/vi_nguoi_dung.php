<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vi_nguoi_dung extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tong_tien',
    ];


    /**
     * Quan hệ với User (một ví thuộc về một người dùng).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Quan hệ với ChiTietVi (một ví có nhiều chi tiết).
     */
    public function chi_tiet_vis()
    {
        return $this->hasMany(chi_tiet_vi::class, 'vi_nguoi_dung_id');
    }
}