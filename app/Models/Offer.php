<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'shop_id',
        'price',
        'updated_at_price',
        'shop_product_url'
    ];

    protected $casts = [
        'updated_at_price' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, '.', ' ');
    }

    public static function getTotalSum()
    {
        return self::sum('price');
    }
}
