<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProductOption extends Model
{
     protected $fillable = ['cart_product_id', 'option_name', 'option_value'];
    protected $table = 'carts_products_options';

    public function cartProduct()
    {
        return $this->belongsTo(CartProduct::class);
    }
}
