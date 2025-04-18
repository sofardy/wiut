<?php

namespace App\Filament\Resources\ProductResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ProductResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ProductResource\Api\Transformers\ProductTransformer;

class DetailHandler extends Handlers
{
    protected static string $keyName = 'slug';
    public static string | null $uri = '/{slug}';
    public static string | null $resource = ProductResource::class;
    public static bool $public = true;

    /**
     * Show Product
     *
     * @param Request $request
     * @return ProductTransformer
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

        return new ProductTransformer($query);
    }
}
