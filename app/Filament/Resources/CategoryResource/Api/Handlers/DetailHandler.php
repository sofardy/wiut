<?php

namespace App\Filament\Resources\CategoryResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\CategoryResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\CategoryResource\Api\Transformers\CategoryTransformer;

class DetailHandler extends Handlers
{
    protected static string $keyName = 'slug';
    public static string | null $uri = '/{slug}';
    public static string | null $resource = CategoryResource::class;
    public static bool $public = true;


    /**
     * Show Category
     *
     * @param Request $request
     * @return CategoryTransformer
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

        return new CategoryTransformer($query);
    }
}
