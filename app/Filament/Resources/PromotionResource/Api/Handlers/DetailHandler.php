<?php

namespace App\Filament\Resources\PromotionResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PromotionResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\PromotionResource\Api\Transformers\PromotionTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{slug}';
    public static string | null $resource = PromotionResource::class;
    public static bool $public = true;


    /**
     * Show Promotion
     *
     * @param Request $request
     * @return PromotionTransformer
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

        return new PromotionTransformer($query);
    }
}
