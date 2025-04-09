<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // например: "Производитель", "Модель"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_values')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
