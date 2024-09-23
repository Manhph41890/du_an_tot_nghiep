<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chuc_vu extends Model
{
    use HasFactory;
    protected $fillable = [
        'ten_chuc_vu',
        'mo_ta_chuc_vu',
    ];
}