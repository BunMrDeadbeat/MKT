<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['name', 'description', 'is_active'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option')
                    ->withPivot('required', 'values')->withTimestamps();
    }
}
