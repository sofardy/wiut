<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт для работы с фабриками
use Illuminate\Database\Eloquent\Model; // Подключаем базовый класс модели
use App\Traits\HasSlug; // Подключаем трейт для работы с уникальными slug
use App\Traits\HasImageUrl; // Подключаем трейт для работы с URL изображения

class Shop extends Model
{
    use HasFactory, HasSlug; // Используем трейт для фабрик и генерации slug

    protected $fillable = [
        'name',    // Название магазина
        'logo',    // URL логотипа магазина
        'website', // URL веб-сайта магазина
    ];

    public function offers()
    {
        // Связь "один ко многим" с моделью Offer
        // Один магазин может иметь множество предложений
        return $this->hasMany(Offer::class);
    }
}
