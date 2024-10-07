<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bai_viet extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'tieu_de_bai_viet',
        'noi_dung',
        'user_id',
        'ngay_dang',
        'is_active',
        'anh_bai_viet'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}