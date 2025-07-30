<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Orden extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'status', 'pagado', 'metodo_pago', 'folio'];
      protected static function booted()
    {
        static::created(function ($order) {
            $order->folio = "#{$order->id}D{$order->created_at->format('ymd')}MKT{$order->user_id}";
            $order->save();
        });
    }

     public function product()
    {
         return $this->hasMany(OrdenProducto::class, 'order_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
}
