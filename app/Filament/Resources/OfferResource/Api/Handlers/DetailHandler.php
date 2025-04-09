<?php

namespace App\Filament\Resources\OfferResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\OfferResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\OfferResource\Api\Transformers\OfferTransformer;

class DetailHandler extends Handlers
{
    protected static string $keyName = 'slug';
    public static string | null $uri = '/{slug}';
    public static string | null $resource = OfferResource::class;
    public static bool $public = true;


    /**
     * Show Offer
     *
     * @param Request $request
     * @return OfferTransformer
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

        return new OfferTransformer($query);
    }
}
