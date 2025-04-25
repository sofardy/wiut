<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages; // Подключаем страницы для работы с ресурсом
use App\Filament\Resources\OfferResource\RelationManagers; // Подключаем менеджеры отношений (если есть)
use App\Models\Offer; // Подключаем модель Offer
use Filament\Forms; // Подключаем компоненты для работы с формами
use Filament\Forms\Form; // Класс для создания форм
use Filament\Resources\Resource; // Базовый класс ресурса Filament
use Filament\Tables; // Подключаем компоненты для работы с таблицами
use Filament\Tables\Table; // Класс для создания таблиц
use Illuminate\Database\Eloquent\Builder; // Класс для построения запросов
use Illuminate\Database\Eloquent\SoftDeletingScope; // Подключаем поддержку мягкого удаления (если нужно)

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class; // Указываем модель, с которой связан ресурс

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Иконка для навигации в панели Filament

    public static function form(Form $form): Form
    {
        // Метод для определения формы создания/редактирования записей
        return $form
            ->schema([
                // Поле для ввода ID продукта
                Forms\Components\TextInput::make('product_id')
                    ->required() // Поле обязательно для заполнения
                    ->numeric(), // Поле принимает только числовые значения

                // Поле для ввода ID магазина
                Forms\Components\TextInput::make('shop_id')
                    ->required() // Поле обязательно для заполнения
                    ->numeric(), // Поле принимает только числовые значения

                // Поле для ввода цены предложения
                Forms\Components\TextInput::make('price')
                    ->required() // Поле обязательно для заполнения
                    ->numeric() // Поле принимает только числовые значения
                    ->prefix('$'), // Добавляем префикс "$" перед значением

                // Поле для выбора даты последнего обновления цены
                Forms\Components\DatePicker::make('updated_at_price')
                    ->required(), // Поле обязательно для заполнения

                // Поле для ввода URL продукта в магазине
                Forms\Components\TextInput::make('shop_product_url')
                    ->maxLength(255), // Максимальная длина строки - 255 символов
            ]);
    }

    public static function table(Table $table): Table
    {
        // Метод для определения таблицы отображения записей
        return $table
            ->columns([
                // Колонка для отображения ID продукта
                Tables\Columns\TextColumn::make('product_id')
                    ->numeric() // Значение отображается как число
                    ->sortable(), // Поле можно сортировать

                // Колонка для отображения ID магазина
                Tables\Columns\TextColumn::make('shop_id')
                    ->numeric() // Значение отображается как число
                    ->sortable(), // Поле можно сортировать

                // Колонка для отображения цены предложения
                Tables\Columns\TextColumn::make('price')
                    ->money() // Форматируем значение как денежное
                    ->sortable(), // Поле можно сортировать

                // Колонка для отображения даты последнего обновления цены
                Tables\Columns\TextColumn::make('updated_at_price')
                    ->date() // Форматируем значение как дату
                    ->sortable(), // Поле можно сортировать

                // Колонка для отображения URL продукта в магазине
                Tables\Columns\TextColumn::make('shop_product_url')
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
            'index' => Pages\ListOffers::route('/'), // Страница списка записей
            'create' => Pages\CreateOffer::route('/create'), // Страница создания записи
            'edit' => Pages\EditOffer::route('/{record}/edit'), // Страница редактирования записи
        ];
    }
}
