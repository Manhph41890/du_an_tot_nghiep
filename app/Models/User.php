<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
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
        'is_active'
    ];
    public function chuc_vus()
    {
        return $this->belongsTo(chuc_vu::class, 'id');
    }
    public function chuc_vu()
    {
        return $this->belongsTo(chuc_vu::class,'chuc_vu_id');
    }
    public function khuyen_mai()
    {
        return $this->hasOne(khuyen_mai::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
