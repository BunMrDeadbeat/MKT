<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = 'carts_products';
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'unit_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function opciones()
    {
        return $this->hasMany(CartProductOption::class);
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function count(){
        return $this->hasMany(Product::class)->count();
    }
}
