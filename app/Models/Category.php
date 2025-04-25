<?php

namespace App\Models;

use App\Traits\HasSlug; // Подключаем трейт для работы с уникальными slug
use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт для работы с фабриками
use Illuminate\Database\Eloquent\Model; // Подключаем базовый класс модели

class Category extends Model
{
    use HasFactory, HasSlug; // Используем трейты для фабрик и генерации slug

    protected $fillable = [
        'name' // Поле name разрешено для массового заполнения (mass assignment)
    ];

    public function products()
    {
        // Связь "один ко многим" с моделью Product
        // Одна категория может содержать множество продуктов
        return $this->hasMany(Product::class);
    }
}
