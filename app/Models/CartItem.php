<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'san_pham_id', 'color_san_pham_id', 'size_san_pham_id', 'quantity', 'price'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
    public function san_pham()
    {
        return $this->belongsTo(san_pham::class, 'san_pham_id');
    }
    public function color()
    {
        return $this->belongsTo(color_san_pham::class, 'color_san_pham_id');
    }

    public function size()
    {
        return $this->belongsTo(size_san_pham::class, 'size_san_pham_id');
    }
    // Model CartItem
    public function bien_the_san_pham()
    {
        return $this->belongsTo(bien_the_san_pham::class, 'bien_the_san_pham_id');
    }
}
