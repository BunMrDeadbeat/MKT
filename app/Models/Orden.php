<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orders';
   protected $fillable = ['user_id', 'producto_id', 'opciones_personalizacion', 'monto'];
    protected $casts = ['opciones_personalizacion' => 'array'];

     public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'producto_id');
    }
}
