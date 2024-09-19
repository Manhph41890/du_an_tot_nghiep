<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bien_the_san_pham extends Model
{
    use HasFactory;

    protected $fillable =
    ['san_pham_id', 'size_san_pham_id', 'color_san_pham_id', 'so_luong', 'anh_bien_the'];


    public function sanPham()
    {
        return $this->belongsTo(san_pham::class);
    }
}
