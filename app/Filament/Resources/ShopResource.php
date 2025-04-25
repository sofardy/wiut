<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopResource\Pages; // Подключаем страницы для работы с ресурсом
use App\Filament\Resources\ShopResource\RelationManagers; // Подключаем менеджеры отношений (если есть)
use App\Models\Shop; // Подключаем модель Shop
use Filament\Forms; // Подключаем компоненты для работы с формами
use Filament\Forms\Form; // Класс для создания форм
use Filament\Resources\Resource; // Базовый класс ресурса Filament
use Filament\Tables; // Подключаем компоненты для работы с таблицами
use Filament\Tables\Table; // Класс для создания таблиц
use Illuminate\Database\Eloquent\Builder; // Класс для построения запросов
use Illuminate\Database\Eloquent\SoftDeletingScope; // Подключаем поддержку мягкого удаления (если нужно)

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class; // Указываем модель, с которой связан ресурс

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Иконка для навигации в панели Filament

    public static function form(Form $form): Form
    {
        // Метод для определения формы создания/редактирования записей
        return $form
            ->schema([
                // Поле для ввода названия магазина
                Forms\Components\TextInput::make('name')
                    ->required() // Поле обязательно для заполнения
                    ->maxLength(255), // Максимальная длина строки - 255 символов

                // Поле для отображения slug (только для чтения)
                Forms\Components\TextInput::make('slug')
                    ->disabled(), // Поле отключено для редактирования

                // Поле для загрузки логотипа магазина
                Forms\Components\FileUpload::make('logo')
                    ->required() // Поле обязательно для заполнения
                    ->preserveFilenames() // Сохранять оригинальное имя файла
                    ->directory('shop') // Указываем директорию для сохранения файлов
                    ->visibility('public') // Делаем файл публично доступным
                    ->image(), // Указываем, что это изображение

                // Поле для ввода URL веб-сайта магазина
                Forms\Components\TextInput::make('website')
                    ->maxLength(255), // Максимальная длина строки - 255 символов
            ]);
    }

    public static function table(Table $table): Table
    {
        // Метод для определения таблицы отображения записей
        return $table
            ->columns([
                // Колонка для отображения названия магазина
                Tables\Columns\TextColumn::make('name')
                    ->searchable(), // Поле можно искать через поиск

                // Колонка для отображения логотипа магазина
                Tables\Columns\ImageColumn::make('logo'),

                // Колонка для отображения URL веб-сайта магазина
                Tables\Columns\TextColumn::make('website')
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
            'index' => Pages\ListShops::route('/'), // Страница списка записей
            'create' => Pages\CreateShop::route('/create'), // Страница создания записи
            'edit' => Pages\EditShop::route('/{record}/edit'), // Страница редактирования записи
        ];
    }
}
