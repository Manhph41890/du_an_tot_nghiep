<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon_usage extends Model
{
    use HasFactory;

    public $fillable =
    [
        'id',
        'user_id',
        'coupon_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function khuyen_mai()
    {
        return $this->belongsTo(khuyen_mai::class, 'coupon_id');
    }
}
