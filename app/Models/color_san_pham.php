<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color_san_pham extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_color',
    ];

    public function bien_the_san_phams()
    {
        return $this->hasMany(bien_the_san_pham::class);
    }
}