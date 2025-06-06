<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

     use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'type', 'price',
        'category_id', 'status', 'image'];

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_option')
                    ->withPivot('required', 'values')->withTimestamps();;
    }
      public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getFeaturedImageAttribute()
    {
        $gallery = $this->galleries->firstWhere('is_featured', true);
        return $gallery ? $gallery->image : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            // carga todas las galerías relacionadas al producto que estas eliminando pedazo de babozo y elimina sus imágenes
            $product->galleries()->chunkById(200, function ($galleries) {
                foreach ($galleries as $gallery) {
                    Storage::disk('public')->delete("$gallery->image");
                }
            });
        });
    }
}
