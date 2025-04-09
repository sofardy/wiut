<?php

namespace App\Filament\Resources\ShopResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ShopResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ShopResource\Api\Transformers\ShopTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ShopResource::class;


    /**
     * Show Shop
     *
     * @param Request $request
     * @return ShopTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new ShopTransformer($query);
    }
}
