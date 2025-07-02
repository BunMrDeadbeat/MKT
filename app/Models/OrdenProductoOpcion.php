<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenProductoOpcion extends Model
{
    protected $fillable = ['orden_producto_id', 'valor_opcion'];

    public function ordenProducto()
    {
        return $this->belongsTo(OrdenProducto::class);
    }
}

