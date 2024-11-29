<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lien_he extends Model
{
    use HasFactory;
    protected $table = 'lien_hes';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'contact_message',
        'trang_thai'
    ];
}
