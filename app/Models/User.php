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
        'chuc_vu_id',
        'ho_ten',
        'anh_dai_dien',
        'email',
        'so_dien_thoai',
        'ngay_sinh',
        'dia_chi',
        'gioi_tinh',
        'password',
        'provider',
        'provider_id',
        'is_active'
    ];

    public function chuc_vus()
    {
        return $this->belongsTo(chuc_vu::class, 'id');
    }

    public function donhangs()
    {
        return $this->hasMany(don_hang::class, "user_id");
    }

    public function chuc_vu()
    {
        return $this->belongsTo(chuc_vu::class, 'chuc_vu_id');
    }
    public function khuyen_mai()
    {
        return $this->hasOne(khuyen_mai::class);
    }
    public function vi_nguoi_dungs()
    {
        return $this->hasOne(vi_nguoi_dung::class, 'user_id', 'id');
    }
    public function vi_shipper()
    {
        return $this->hasOne(Vishipper::class);
    }

    public function shippers()
    {
        return $this->hasMany(Shipper::class, 'shipper_id');
    }

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
}
