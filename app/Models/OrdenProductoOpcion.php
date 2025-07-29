<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenProductoOpcion extends Model
{
    protected $table = 'orders_products_options';
    protected $fillable = ['order_product_id', 'option_name', 'option_value'];

    public function ordenProducto()
    {
        return $this->belongsTo(OrdenProducto::class);
    }
}

