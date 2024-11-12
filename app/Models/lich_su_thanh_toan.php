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
        return $this->belongsTo(don_hang::class, 'don_hang_id');
    }
}
