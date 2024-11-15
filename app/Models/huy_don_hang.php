<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class huy_don_hang extends Model
{
    use HasFactory;

    protected $fillable = [
        'don_hang_id',
        'ly_do_huy',
        'thoi_gian_huy',
        'trang_thai',
    ];

    public function don_hang()
    {
        return $this->belongsTo(don_hang::class, 'don_hang_id', 'id');
    }
}
