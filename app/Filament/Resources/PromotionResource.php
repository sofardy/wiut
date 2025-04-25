<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages; // Подключаем страницы для работы с ресурсом
use App\Filament\Resources\PromotionResource\RelationManagers; // Подключаем менеджеры отношений (если есть)
use App\Models\Promotion; // Подключаем модель Promotion
use Filament\Forms; // Подключаем компоненты для работы с формами
use Filament\Forms\Form; // Класс для создания форм
use Filament\Resources\Resource; // Базовый класс ресурса Filament
use Filament\Tables; // Подключаем компоненты для работы с таблицами
use Filament\Tables\Table; // Класс для создания таблиц
use Illuminate\Database\Eloquent\Builder; // Класс для построения запросов
use Illuminate\Database\Eloquent\SoftDeletingScope; // Подключаем поддержку мягкого удаления (если нужно)

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class; // Указываем модель, с которой связан ресурс

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Иконка для навигации в панели Filament

    public static function form(Form $form): Form
    {
        // Метод для определения формы создания/редактирования записей
        return $form
            ->schema([
                // Поле для ввода названия промоакции
                Forms\Components\TextInput::make('title')
                    ->maxLength(255), // Максимальная длина строки - 255 символов

                // Поле для загрузки изображения промоакции
                Forms\Components\FileUpload::make('image')
                    ->directory('promotion') // Указываем директорию для сохранения файлов
                    ->required() // Поле обязательно для заполнения
                    ->image(), // Указываем, что это изображение
            ]);
    }

    public static function table(Table $table): Table
    {
        // Метод для определения таблицы отображения записей
        return $table
            ->columns([
                // Колонка для отображения названия промоакции
                Tables\Columns\TextColumn::make('title')
                    ->searchable(), // Поле можно искать через поиск

                // Колонка для отображения изображения промоакции
                Tables\Columns\ImageColumn::make('image'),

                // Колонка для отображения даты создания записи
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime() // Форматируем как дату и время
                    ->sortable() // Поле можно сортировать
                    ->toggleable(isToggledHiddenByDefault: true), // Колонка скрыта по умолчанию

                // Колонка для отображения даты обновления записи
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime() // Форматируем как дату и время
                    ->sortable() // Поле можно сортировать
                    ->toggleable(isToggledHiddenByDefault: true), // Колонка скрыта по умолчанию
            ])
            ->filters([
                // Здесь можно добавить фильтры для таблицы
            ])
            ->actions([
                // Действие для редактирования записи
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Групповые действия для таблицы
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Групповое удаление записей
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        // Метод для определения отношений ресурса
        return [
            // Здесь можно добавить менеджеры отношений
        ];
    }

    public static function getPages(): array
    {
        // Метод для определения страниц ресурса
        return [
            'index' => Pages\ListPromotions::route('/'), // Страница списка записей
            'create' => Pages\CreatePromotion::route('/create'), // Страница создания записи
            'edit' => Pages\EditPromotion::route('/{record}/edit'), // Страница редактирования записи
        ];
    }
}
