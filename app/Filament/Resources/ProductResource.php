<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages; // Подключаем страницы для работы с ресурсом
use App\Filament\Resources\ProductResource\RelationManagers; // Подключаем менеджеры отношений
use App\Models\Product; // Подключаем модель Product
use Filament\Forms; // Подключаем компоненты для работы с формами
use Filament\Forms\Form; // Класс для создания форм
use Filament\Resources\Resource; // Базовый класс ресурса Filament
use Filament\Tables; // Подключаем компоненты для работы с таблицами
use Filament\Tables\Table; // Класс для создания таблиц
use Illuminate\Database\Eloquent\Builder; // Класс для построения запросов
use Illuminate\Database\Eloquent\SoftDeletingScope; // Подключаем поддержку мягкого удаления (если нужно)
use Spatie\QueryBuilder\AllowedFilter; // Подключаем фильтры для запросов

class ProductResource extends Resource
{
    protected static ?string $model = Product::class; // Указываем модель, с которой связан ресурс

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; // Иконка для навигации в панели Filament

    public static function form(Form $form): Form
    {
        // Метод для определения формы создания/редактирования записей
        return $form
            ->schema([
                // Поле для ввода названия продукта
                Forms\Components\TextInput::make('title')
                    ->required() // Поле обязательно для заполнения
                    ->maxLength(255), // Максимальная длина строки - 255 символов

                // Поле для отображения slug (только для чтения)
                Forms\Components\TextInput::make('slug')
                    ->disabled(), // Поле отключено для редактирования

                // Поле для ввода описания продукта
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(), // Поле занимает всю ширину формы

                // Поле для загрузки изображения продукта
                Forms\Components\FileUpload::make('image')
                    ->required() // Поле обязательно для заполнения
                    ->preserveFilenames() // Сохранять оригинальное имя файла
                    ->directory('product') // Указываем директорию для сохранения файлов
                    ->visibility('public') // Делаем файл публично доступным
                    ->image(), // Указываем, что это изображение

                // Поле для выбора категории продукта
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name') // Устанавливаем связь с моделью Category
                    ->searchable() // Поле можно искать через поиск
                    ->preload() // Предзагрузка данных для выбора
                    ->required(), // Поле обязательно для заполнения
            ]);
    }

    public static function table(Table $table): Table
    {
        // Метод для определения таблицы отображения записей
        return $table
            ->columns([
                // Колонка для отображения изображения продукта
                Tables\Columns\ImageColumn::make('image'),

                // Колонка для отображения названия продукта
                Tables\Columns\TextColumn::make('title')
                    ->searchable(), // Поле можно искать через поиск

                // Колонка для отображения названия категории продукта
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category') // Устанавливаем заголовок колонки
                    ->sortable() // Поле можно сортировать
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
            // Менеджер отношений для предложений (offers)
            \App\Filament\Resources\ProductResource\RelationManagers\OffersRelationManager::class,

            // Менеджер отношений для атрибутов продукта
            \App\Filament\Resources\ProductResource\RelationManagers\AttributesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        // Метод для определения страниц ресурса
        return [
            'index' => Pages\ListProducts::route('/'), // Страница списка записей
            'create' => Pages\CreateProduct::route('/create'), // Страница создания записи
            'edit' => Pages\EditProduct::route('/{record}/edit'), // Страница редактирования записи
        ];
    }

    public static function allowedFilters(): array
    {
        // Метод для определения разрешенных фильтров
        return [
            AllowedFilter::exact('category_id'), // Фильтр для точного совпадения по category_id
        ];
    }
}
