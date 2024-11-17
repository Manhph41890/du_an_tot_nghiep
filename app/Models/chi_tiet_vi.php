<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chi_tiet_vi extends Model
{
    use HasFactory;

    protected $fillable = [
        'don_hang_id',
        'vi_nguoi_dung_id',
        'tien_hoan',
        'thoi_gian_hoan',
        'trang_thai',
    ];

    /**
     * Quan hệ với DonHang (một chi tiết ví thuộc về một đơn hàng).
     */
    public function don_hang()
    {
        return $this->belongsTo(don_hang::class);
    }

    /**
     * Quan hệ với ViNguoiDung (một chi tiết ví thuộc về một ví người dùng).
     */
    public function vi_nguoi_dung()
    {
        return $this->belongsTo(vi_nguoi_dung::class, 'vi_nguoi_dung_id');
    }
}
