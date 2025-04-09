<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use App\Traits\HasImageUrl;

class Product extends Model
{
    use HasFactory, HasSlug, HasImageUrl;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'category_id',
    ];

    public static $allowedFilters = ['category_id', 'title']; // Разрешаем фильтрацию


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_values')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function getFormattedMinPriceAttribute()
    {
        $minPrice = $this->offers()->min('price');
        return $minPrice ? number_format($minPrice, 0, '.', ' ') : null;
    }
}
