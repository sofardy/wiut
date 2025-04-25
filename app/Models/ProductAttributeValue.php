<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт для работы с фабриками
use Illuminate\Database\Eloquent\Model; // Подключаем базовый класс модели

class ProductAttributeValue extends Model
{
    use HasFactory; // Используем трейт для фабрик

    /**
     * Поля, разрешенные для массового заполнения (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'product_id',            // ID связанного продукта
        'product_attribute_id',  // ID связанного атрибута продукта
        'value',                 // Значение атрибута, например: "Samsung", "Galaxy S21"
    ];

    /**
     * Преобразование полей в их нативные типы.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'integer',            // Преобразуем поле product_id в целое число
        'product_attribute_id' => 'integer', // Преобразуем поле product_attribute_id в целое число
    ];

    public function product()
    {
        // Связь "многие к одному" с моделью Product
        // Каждое значение атрибута связано с одним продуктом
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        // Связь "многие к одному" с моделью ProductAttribute
        // Каждое значение атрибута связано с одним атрибутом
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
}
