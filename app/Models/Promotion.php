<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт для работы с фабриками
use Illuminate\Database\Eloquent\Model; // Подключаем базовый класс модели
use App\Traits\HasImageUrl; // Подключаем трейт для работы с URL изображения

class Promotion extends Model
{
    /** 
     * Используем трейт HasFactory для генерации фабрик.
     * @use HasFactory<\Database\Factories\PromotionFactory> 
     */
    use HasFactory, HasImageUrl; // HasImageUrl добавляет функционал для работы с изображениями

    protected $fillable = [
        'title', // Название промоакции
        'image', // URL изображения, связанного с промоакцией
    ];
}
