<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khuyen_mai extends Model
{
    use HasFactory; 
    protected $table ='khuyen_mais';


    protected $fillable = [
        'ten_khuyen_mai',
        'ma_khuyen_mai',
        'gia_tri_khuyen_mai',
        'so_luong_ma',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'user_id',
        'is_active',
        'danh_muc_id',
    ];

    public function don_hangs()
    {
        return $this->hasMany(don_hang::class);
    }
    // register điều kiện 1 số điện thoại đc 1 mã
    public function khachhang_new()
    {
        return $this->belongsTo(User::class);
    }

    // khuyến mãi danh mục
    public function danh_muc()
    {
        return $this->belongsTo(danh_muc::class, 'danh_muc_id');
    }
    


}
