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
        'trang_thai'
    ];
    protected $casts = [
        'trang_thai' => ['Đặt hàng thành công ', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao']
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function san_phams()
    {
        return $this->belongsTo(san_pham::class);
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
    public function chi_tiet_don_hang()
    {
        return $this->belongsTo(chi_tiet_don_hang::class);
    }
}