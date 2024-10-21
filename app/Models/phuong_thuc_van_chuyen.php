<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phuong_thuc_van_chuyen extends Model
{
    use HasFactory;
    protected $fillable = ['kieu_van_chuyen', 'gia_ship'];
    public function don_hangs()
    {
        return $this->hasMany(don_hang::class, 'phuong_thuc_van_chuyen_id'); // Thay 'phuong_thuc_van_chuyen_id' bằng khóa ngoại thực tế nếu khác
    }
}
