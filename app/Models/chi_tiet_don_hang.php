<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chi_tiet_don_hang extends Model
{
    use HasFactory;

    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'color_san_pham_id',
        'size_san_pham_id',
        'so_luong',
        'gia_tien',
        'thanh_tien'
    ];

    public function don_hang()
    {
        return $this->belongsTo(don_hang::class, "don_hang_id");
    }
    public function san_pham()
    {
        return $this->belongsTo(san_pham::class, 'san_pham_id');
    }
    public function bien_the_san_pham()
    {
        return $this->belongsTo(bien_the_san_pham::class,);
    }

    // Quan hệ với bảng color_san_pham
    public function color_san_pham()
    {
        return $this->belongsTo(color_san_pham::class, 'color_san_pham_id');
    }

    // Quan hệ với bảng size_san_pham
    public function size_san_pham()
    {
        return $this->belongsTo(size_san_pham::class, 'size_san_pham_id');
    }
}