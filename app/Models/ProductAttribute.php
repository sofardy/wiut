<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт для работы с фабриками
use Illuminate\Database\Eloquent\Model; // Подключаем базовый класс модели

class ProductAttribute extends Model
{
    use HasFactory; // Используем трейт для фабрик

    protected $fillable = [
        'name', // Поле name разрешено для массового заполнения (mass assignment)
        // Пример значения: "Производитель", "Модель", "Цвет" и т.д.
    ];

    public function products()
    {
        // Связь "многие ко многим" с моделью Product через таблицу product_attribute_values
        // withPivot('value') добавляет поле value из промежуточной таблицы
        // withTimestamps() добавляет временные метки created_at и updated_at
        return $this->belongsToMany(Product::class, 'product_attribute_values')
            ->withPivot('value') // Поле value хранит значение атрибута для конкретного продукта
            ->withTimestamps(); // Автоматическое управление временными метками
    }

    public function values()
    {
        // Связь "один ко многим" с моделью ProductAttributeValue
        // Одна запись атрибута может иметь множество значений
        return $this->hasMany(ProductAttributeValue::class);
    }
}
