<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vishipper extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipper_id',
        'tong_tien',
    ];

    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id');
    }
}