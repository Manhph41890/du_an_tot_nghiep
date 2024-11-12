<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lich_su_thanh_toan extends Model
{
    use HasFactory;
    protected $fillable = [
        'don_hang_id',
        'vnp_TxnRef_id',
        'vnp_ngay_tao',
        'vnp_tong_tien',
        'trang_thai',
    ];

    public function don_hang()
    {
        return $this->belongsTo(don_hang::class, 'don_hang_id', 'id');
    }

    public function getMaGiaoDichAttribute()
    {
        return 'GD-' . strtoupper(substr(md5($this->vnp_TxnRef_id), 0, 4)) . '-' . str_pad($this->vnp_TxnRef_id, 6, '0', STR_PAD_LEFT);
    }
}
