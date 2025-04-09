<?php
namespace App\Filament\Resources\ShopResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ShopResource;
use Illuminate\Routing\Router;


class ShopApiService extends ApiService
{
    protected static string | null $resource = ShopResource::class;

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
