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
<<<<<<< HEAD
=======
        'chuc_vu_id',
>>>>>>> f80c2f82532e34a03f39f4ea1a86616f265aabf4
        'ho_ten',
        'anh_dai_dien',
        'email',
        'so_dien_thoai',
<<<<<<< HEAD
        'password',
        'is_active',
        'chuc_vu_id', // Foreign key cho chức vụ
=======
        'ngay_sinh',
        'dia_chi',
        'gioi_tinh',
        'mat_khau',
        'is_active'
>>>>>>> f80c2f82532e34a03f39f4ea1a86616f265aabf4
    ];
    public function chuc_vus(){
        return $this->belongsTo(chuc_vu::class, 'id');
    }

    /**
     * Các trường cần ẩn khi trả về JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    /**
     * Các trường sẽ được cast thành kiểu dữ liệu khác.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mat_khau' => 'hashed', // Laravel 10 hỗ trợ hashed password casting
    ];

    /**
     * Định nghĩa quan hệ với model `ChucVu`.
     */
    public function chuc_vu()
    {
        return $this->belongsTo(chuc_vu::class);
    }
}
