<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductAttributeResource\Pages; // Подключаем страницы для работы с ресурсом
use App\Filament\Resources\ProductAttributeResource\RelationManagers; // Подключаем менеджеры отношений (если есть)
use App\Models\ProductAttribute; // Подключаем модель ProductAttribute
use Filament\Forms; // Подключаем компоненты для работы с формами
use Filament\Forms\Form; // Класс для создания форм
use Filament\Resources\Resource; // Базовый класс ресурса Filament
use Filament\Tables; // Подключаем компоненты для работы с таблицами
use Filament\Tables\Table; // Класс для создания таблиц
use Illuminate\Database\Eloquent\Builder; // Класс для построения запросов
use Illuminate\Database\Eloquent\SoftDeletingScope; // Подключаем поддержку мягкого удаления (если нужно)

class ProductAttributeResource extends Resource
{
    protected static ?string $model = ProductAttribute::class; // Указываем модель, с которой связан ресурс

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Иконка для навигации в панели Filament

    public static function form(Form $form): Form
    {
        // Метод для определения формы создания/редактирования записей
        return $form
            ->schema([
                // Поле для ввода названия атрибута продукта
                Forms\Components\TextInput::make('name')
                    ->required() // Поле обязательно для заполнения
                    ->maxLength(255), // Максимальная длина строки - 255 символов
            ]);
    }

    public static function table(Table $table): Table
    {
        // Метод для определения таблицы отображения записей
        return $table
            ->columns([
                // Колонка для отображения названия атрибута продукта
                Tables\Columns\TextColumn::make('name')
                    ->searchable(), // Поле можно искать через поиск

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
            'index' => Pages\ListProductAttributes::route('/'), // Страница списка записей
            'create' => Pages\CreateProductAttribute::route('/create'), // Страница создания записи
            'edit' => Pages\EditProductAttribute::route('/{record}/edit'), // Страница редактирования записи
        ];
    }
}
