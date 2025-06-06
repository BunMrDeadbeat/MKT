<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = ['product_id', 'image', 'is_featured'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($gallery) {
            Storage::disk('public')->delete("$gallery->image");
        });
    }
}