<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $fillable = ['carrito_id', 'product_id', 'cantidad'];

    public function carrito()
    {
        return $this->belongsTo(Cart::class);
    }

    public function opciones()
    {
        return $this->hasMany(CartProductOption::class);
    }

    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}
