<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Product extends Model
{

    use HasFactory;
    /**
     * The dynamic rich text attributes.
     *
     * @var array<int|string, string>
     */
    protected $fillable = ['name', 'slug', 'description', 'type', 'price',
        'category_id', 'status', 'image'];

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_option')
                    ->withPivot('required', 'values')->withTimestamps()->orderBy('options.id', 'asc');
    }
      public function category()
    {
        return $this->belongsTo(Category::class);
    }

     public function cartsProducts()
    {
        return $this->hasMany(CartProduct::class, 'product_id');
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
  public function featuredImage()
    {
        return $this->hasOne(Gallery::class)->where('is_featured', true);
    }
    public function getFeaturedImageAttribute()
    {
        $gallery = $this->galleries->firstWhere('is_featured', true);
        return $gallery ? $gallery->image : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($product) {
            $product->galleries()->chunkById(200, function ($galleries) {
                foreach ($galleries as $gallery) {
                    Storage::disk('public')->delete("$gallery->image");
                }
            });
        });
    }
}
