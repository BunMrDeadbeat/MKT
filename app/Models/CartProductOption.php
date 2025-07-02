<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProductOption extends Model
{
     protected $fillable = ['cart_product_id', 'option_value'];

    public function cartProduct()
    {
        return $this->belongsTo(CartProduct::class);
    }
}
