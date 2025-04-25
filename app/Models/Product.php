<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use App\Traits\HasImageUrl;

class Product extends Model
{
    use HasFactory, HasSlug, HasImageUrl; // Подключаем трейты для фабрики, генерации slug и работы с URL изображения

    protected $fillable = [
        'title',        // Название продукта
        'slug',         // Уникальный идентификатор продукта в URL
        'description',  // Описание продукта
        'image',        // URL изображения продукта
        'category_id',  // ID категории, к которой относится продукт
    ];

    public static $allowedFilters = ['category_id', 'title']; // Разрешенные поля для фильтрации

    public function category()
    {
        // Связь "многие к одному" с моделью Category
        return $this->belongsTo(Category::class);
    }

    public function offers()
    {
        // Связь "один ко многим" с моделью Offer
        return $this->hasMany(Offer::class);
    }

    public function attributes()
    {
        // Связь "многие ко многим" с моделью ProductAttribute через таблицу product_attribute_values
        // withPivot('value') добавляет поле value из промежуточной таблицы
        // withTimestamps() добавляет временные метки created_at и updated_at
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_values')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function attributeValues()
    {
        // Связь "один ко многим" с моделью ProductAttributeValue
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function getFormattedMinPriceAttribute()
    {
        // Получаем минимальную цену из связанных предложений (offers)
        $minPrice = $this->offers()->min('price');
        // Форматируем минимальную цену в удобный для чтения вид (разделитель тысяч - пробел)
        // Используется для удобства получения минимальной цены, чтобы вывести её по API
        return $minPrice ? number_format($minPrice, 0, '.', ' ') : null;
    }
}
