<?php

namespace App\Filament\Resources\OfferResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\OfferResource;
use App\Filament\Resources\OfferResource\Api\Transformers\OfferTransformer;

class PaginationHandler extends Handlers
{
    public static string | null $uri = '/';
    public static string | null $resource = OfferResource::class;
    public static bool $public = true;


    /**
     * List of Offer
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return OfferTransformer::collection($query);
    }
}
