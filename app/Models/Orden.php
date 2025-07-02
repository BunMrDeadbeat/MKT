<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'status', 'pagado', 'metodo_pago'];

     public function product()
    {
        return $this->hasMany(OrdenProducto::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}
