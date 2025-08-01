<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenProducto extends Model
{
    protected $table = 'orders_products';
    protected $fillable = ['order_id', 'product_id', 'cantidad', 'precio_unitario','cotizado'];

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }

    public function opciones()
    {
        return $this->hasMany(OrdenProductoOpcion::class, 'order_product_id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
