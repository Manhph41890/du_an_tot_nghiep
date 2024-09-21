<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Các trường có thể điền được (fillable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ho_ten',
        'anh_dai_dien',
        'email',
        'so_dien_thoai',
        'password',
        'is_active',
        'chuc_vu_id', // Foreign key cho chức vụ
    ];

    /**
     * Các trường cần ẩn khi trả về JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các trường sẽ được cast thành kiểu dữ liệu khác.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10 hỗ trợ hashed password casting
    ];

    /**
     * Định nghĩa quan hệ với model `ChucVu`.
     */
    public function chuc_vu()
    {
        return $this->belongsTo(chuc_vu::class);
    }
    public function khuyen_mai()
{
    return $this->hasOne(khuyen_mai::class);
} 
}
