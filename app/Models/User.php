<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Подключаем трейт для работы с фабриками
use Illuminate\Foundation\Auth\User as Authenticatable; // Базовый класс для аутентификации пользователей
use Illuminate\Notifications\Notifiable; // Подключаем трейт для работы с уведомлениями
use Filament\Models\Contracts\FilamentUser; // Интерфейс для проверки доступа к панели Filament
use Filament\Panel; // Класс панели Filament
use Laravel\Sanctum\HasApiTokens; // Трейт для поддержки Sanctum API токенов

class User extends Authenticatable implements FilamentUser
{
    /** 
     * Используем трейт HasFactory для генерации фабрик.
     * @use HasFactory<\Database\Factories\UserFactory> 
     */
    use HasApiTokens, HasFactory, Notifiable; // HasApiTokens для Sanctum, HasFactory для фабрик, Notifiable для уведомлений

    /**
     * Поля, разрешенные для массового заполнения (mass assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',     // Имя пользователя
        'email',    // Электронная почта пользователя
        'phone',    // Телефон пользователя
        'password', // Пароль пользователя
    ];

    /**
     * Поля, которые должны быть скрыты при сериализации.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Пароль скрыт для безопасности
        'remember_token',  // Токен для "запомнить меня" скрыт
    ];

    /**
     * Преобразование полей в их нативные типы.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Поле email_verified_at преобразуется в объект даты
            'password' => 'hashed',           // Пароль автоматически хэшируется
        ];
    }

    /**
     * Проверяет, может ли пользователь получить доступ к панели Filament.
     *
     * @param Panel $panel Экземпляр панели Filament
     * @return bool Возвращает true, если пользователь имеет доступ
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Проверяем, заканчивается ли email пользователя на '@test.dev'
        // Это условие используется для ограничения доступа к панели
        return str_ends_with($this->email, '@test.dev');
    }
}
