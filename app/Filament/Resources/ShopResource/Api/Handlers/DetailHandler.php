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
    protected static string $keyName = 'slug';
    public static string | null $uri = '/{slug}';
    public static string | null $resource = ShopResource::class;
    public static bool $public = true;


    /**
     * Show Shop
     *
     * @param Request $request
     * @return ShopTransformer
     */
    public function handler(Request $request)
    {
        $slug = $request->route('slug');

        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $slug)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new ShopTransformer($query);
    }
}
