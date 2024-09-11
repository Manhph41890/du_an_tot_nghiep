<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anh_san_pham extends Model
{
    use HasFactory;

    public $fillable = [
        'san_pham_id',
        'anh_san_pham',
    ];
}