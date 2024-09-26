<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danh_gia extends Model
{
    use HasFactory;
    protected $fillable = [
        'san_pham_id',
        'user_id',
        'ngay_danh_gia',
        'diem_so',
        'binh_luan'
    ];
    public function san_phams(){
        return $this->belongsTo(san_pham::class, 'san_pham_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
