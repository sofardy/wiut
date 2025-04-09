<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'attributes';
    protected static ?string $recordTitleAttribute = 'name';
    protected bool $allowsDuplicates = true;

    public function form(Form $form): Form
    {
        // НЕ нужно ничего тут. Вся магия будет в AttachAction
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Атрибут'),
                Tables\Columns\TextColumn::make('pivot.value')->label('Значение'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn(\Filament\Tables\Actions\AttachAction $action) => [
                        $action->getRecordSelect()->label('Атрибут'),
                        Forms\Components\TextInput::make('value')
                            ->label('Значение')
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        Forms\Components\TextInput::make('pivot.value')
                            ->label('Значение')
                            ->required(),
                    ]),
                Tables\Actions\DetachAction::make(),
            ]);
    }
}
