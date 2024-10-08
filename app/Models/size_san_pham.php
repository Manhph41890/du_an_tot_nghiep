<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size_san_pham extends Model
{
    use HasFactory;

    protected $table = 'size_san_phams'; // Đảm bảo tên bảng đúng

    protected $fillable = [
        'ten_size'
    ];

    public function bien_the_san_phams()
    {
        return $this->hasMany(bien_the_san_pham::class);
    }
}