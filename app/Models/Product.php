<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'category_id',
    ];

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
}
