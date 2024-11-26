<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileShipper extends Model
{
    use HasFactory;
    protected $table = 'profile_shippers'; 
    protected $fillable = [
        'name', 'phone', 'email', 'ngay_sinh', 'gioi_tinh', 'dia_chi', 'cccd', 'bang_lai_xe', 'is_active', 'chuc_vu_id'
    ];

    // Mối quan hệ với bảng shipper_profits
    public function shipperProfit()
    {
        return $this->hasOne(ShipperProfit::class, 'shipper_id');
    }
}
