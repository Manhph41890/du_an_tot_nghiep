<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class don_hang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'san_pham_id',
        'khuyen_mai_id',
        'phuong_thuc_thanh_toan_id',
        'phuong_thuc_van_chuyen_id',
        'ho_ten',
        'email',
        'dia_chi',
        'so_dien_thoai',
        'ngay_tao',
        'tong_tien',
        'trang_thai',
        'bien_the_san_pham_id',
    ];
    protected $casts = [
        'trang_thai' => 'string', // Chuyển đổi thành chuỗi
    ];


    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    // public function san_phams()
    // {
    //     return $this->belongsTo(san_pham::class, "san_pham_id");
    // }
    // Lấy thông tin sản phẩm thông qua mối quan hệ bắc cầu qua biến thể sản phẩm
    public function san_phams()
    {
        return $this->hasOneThrough(san_pham::class, bien_the_san_pham::class, 'id', 'id', 'bien_the_san_pham_id', 'san_pham_id');
    }
    public function khuyen_mai()
    {
        return $this->belongsTo(khuyen_mai::class);
    }
    public function phuong_thuc_thanh_toan()
    {
        return $this->belongsTo(phuong_thuc_thanh_toan::class);
    }
    public function phuong_thuc_van_chuyen()
    {
        return $this->belongsTo(phuong_thuc_van_chuyen::class);
    }
    public function chi_tiet_don_hangs()
    {
        return $this->hasMany(chi_tiet_don_hang::class, "don_hang_id");
    }
    public function bien_the_san_pham()
    {
        return $this->belongsTo(bien_the_san_pham::class, "bien_the_san_pham_id");
    }
    public function getMaDonHangAttribute()
    {
        return 'DH-' . strtoupper(substr(md5($this->id), 0, 8)) . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
