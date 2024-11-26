<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipperProfit extends Model
{
    use HasFactory;

    protected $fillable = ['shipper_id', 'total_profit'];

    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }
    public function donHang()
    {
        return $this->hasOneThrough(
            don_hang::class,
            Shipper::class,
            'id',
            'id',
            'shipper_id',
            'don_hang_id'
        );
    }
}
