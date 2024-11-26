<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ls_nap_vi extends Model
{
    use HasFactory;

    protected $fillable = [
        'vi_nguoi_dung_id',
        'thoi_gian_nap',
        'tien_nap',
        'trang_thai',
        'bank_id',
    ];

    public function vi_nguoi_dung()
    {
        return $this->belongsTo(vi_nguoi_dung::class, 'vi_nguoi_dung_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
