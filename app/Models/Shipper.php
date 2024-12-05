<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipper_id',
        'don_hang_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function donHang()
    {
        return $this->belongsTo(don_hang::class, 'don_hang_id');
    }
    public function vi_shipper()
    {
        return $this->hasOne(Vishipper::class, 'shipper_id');
    }
}