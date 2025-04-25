<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory; // Подключаем трейт для работы с фабриками

    protected $fillable = [
        'product_id',         // ID связанного продукта
        'shop_id',            // ID связанного магазина
        'price',              // Цена предложения
        'updated_at_price',   // Дата последнего обновления цены
        'shop_product_url'    // URL продукта в магазине
    ];

    protected $casts = [
        'updated_at_price' => 'date', // Преобразуем поле updated_at_price в объект даты
    ];

    public function product()
    {
        // Связь "многие к одному" с моделью Product
        return $this->belongsTo(Product::class);
    }

    public function shop()
    {
        // Связь "многие к одному" с моделью Shop
        return $this->belongsTo(Shop::class);
    }

    public function getFormattedPriceAttribute()
    {
        // Форматируем цену в удобный для чтения вид (разделитель тысяч - пробел)
        return number_format($this->price, 0, '.', ' ');
    }

    public static function getTotalSum()
    {
        // Получаем общую сумму всех цен предложений
        return self::sum('price');
    }
}
