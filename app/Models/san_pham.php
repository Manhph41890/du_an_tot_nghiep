<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class san_pham extends Model
{
    use HasFactory;
    protected $fillable = [
        'danh_muc_id',
        'ten_san_pham',
        'gia_goc',
        'gia_km',
        'anh_san_pham',
        'so_luong',
        'ma_ta_san_pham',
        'is_active',
    ];

    public function danh_muc()
    {
        return $this->belongsTo(danh_muc::class);
    }
    public function anh_san_phams()
    {
        return $this->hasMany(anh_san_pham::class);
    }
    public function don_hangs()
    {
        return $this->hasMany(don_hang::class, 'san_pham_id');
    }
    public function bien_the_san_phams()
    {
        return $this->hasMany(bien_the_san_pham::class);
    }
    public function danh_gias()
    {
        return $this->hasMany(danh_gia::class);
    }
}