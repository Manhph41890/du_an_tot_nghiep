<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_number', 'account_holder', 'pin', 'balance'];

    public function ls_rut_vi()
    {
        return $this->hasMany(ls_rut_vi::class);
    }
    public function ls_nap_vi()
    {
        return $this->hasMany(ls_nap_vi::class);
    }
}
