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

    protected $table = 'vi_shippers';

    public function shipper()
    {
        return $this->belongsTo(User::class, 'shipper_id');
    }

    public function ls_rut_shipper()
    {
        return $this->hasMany(lsrutshipper::class);
    }
}
