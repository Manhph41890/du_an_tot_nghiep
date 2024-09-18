<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chi_tiet_don_hang extends Model
{
    use HasFactory;
    protected $fillable = ['don_hang_id', 'so_luong', 'gia_tien', 'thanh_tien'];

    public function don_hang()
    {
        return $this->hasOne(don_hang::class);
    }
}