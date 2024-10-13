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
<<<<<<< HEAD
=======

>>>>>>> 96daa95f178df5793f2a729748ec7a9625f9645a
    public function users()
    {
        return $this->hasMany(User::class, 'chuc_vu_id');
    }
}