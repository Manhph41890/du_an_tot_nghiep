<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;

    // Các cột được phép gán giá trị hàng loạt
    protected $fillable = ['status', 'don_hang_id', 'chuc_vu_id', 'ly_do_huy'];

    /**
     * Quan hệ với bảng don_hang.
     */
    public function donHang()
    {
        return $this->belongsTo(don_hang::class, 'don_hang_id');
    }

    /**
     * Quan hệ với bảng chuc_vus.
     */
    public function chucVu()
    {
        return $this->belongsTo(chuc_vu::class, 'chuc_vu_id');
    }
    public function profit()
    {
        return $this->hasOne(ShipperProfit::class);
    }
}