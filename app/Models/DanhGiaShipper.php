<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGiaShipper extends Model
{
    use HasFactory;
    protected $fillable = ['shipper_id', 'user_id', 'diem_so', 'binh_luan'];

    // Quan hệ với Shipper
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
