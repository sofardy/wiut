<?php
namespace App\Filament\Resources\OfferResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\OfferResource;
use Illuminate\Routing\Router;


class OfferApiService extends ApiService
{
    protected static string | null $resource = OfferResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
