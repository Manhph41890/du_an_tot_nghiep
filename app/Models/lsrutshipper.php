<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lsrutshipper extends Model
{
    use HasFactory;

    protected $table = 'ls_rut_shippers';

    protected $fillable = [
        'vishipper_id',
        'bank_id',
        'thoi_gian_rut',
        'tien_rut',
        'noi_dung_tu_choi',
        'trang_thai'
    ];

    public function vishipper()
    {
        return $this->belongsTo(vishipper::class, 'vishipper_id');
    }
    public function banks()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}