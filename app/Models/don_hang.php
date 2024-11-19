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
        'trang_thai_don_hang',
        'trang_thai_thanh_toan'
    ];

    protected $casts = [
        'trang_thai_don_hang' => 'string', // Chuyển đổi thành chuỗi
    ];

    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với bảng san_pham
    public function san_pham()
    {
        return $this->belongsTo(san_pham::class, 'san_pham_id');
    }

    // Quan hệ với bảng khuyen_mai
    public function khuyen_mai()
    {
        return $this->belongsTo(khuyen_mai::class, 'khuyen_mai_id');
    }

    // Quan hệ với bảng phuong_thuc_thanh_toan
    public function phuong_thuc_thanh_toan()
    {
        return $this->belongsTo(phuong_thuc_thanh_toan::class, 'phuong_thuc_thanh_toan_id');
    }

    // Quan hệ với bảng phuong_thuc_van_chuyen
    public function phuong_thuc_van_chuyen()
    {
        return $this->belongsTo(phuong_thuc_van_chuyen::class, 'phuong_thuc_van_chuyen_id');
    }

    // Quan hệ với bảng chi_tiet_don_hang
    public function chi_tiet_don_hangs()
    {
        return $this->hasMany(chi_tiet_don_hang::class, 'don_hang_id');
    }

    public function lich_su_thanh_toans()
    {
        return $this->hasMany(lich_su_thanh_toan::class, 'don_hang_id', 'id');
    }

    public function huy_don_hang()
    {
        return $this->hasOne(huy_don_hang::class, 'don_hang_id', 'id');
    }
    public function chi_tiet_vi()
    {
        return $this->hasMany(chi_tiet_vi::class, 'don_hang_id', 'id');
    }

    public function ls_rut_vi()
    {
        return $this->hasMany(ls_rut_vi::class, 'don_hang_id', 'id');
    }

    public function ls_thanh_toan_vi()
    {
        return $this->hasMany(ls_thanh_toan_vi::class, 'don_hang_id', 'id');
    }

    // Tạo mã đơn hàng từ id
    public function getMaDonHangAttribute()
    {
        return 'DH-' . strtoupper(substr(md5($this->id), 0, 8)) . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
