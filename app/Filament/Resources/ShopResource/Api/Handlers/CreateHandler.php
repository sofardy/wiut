<?php
namespace App\Filament\Resources\ShopResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ShopResource;
use App\Filament\Resources\ShopResource\Api\Requests\CreateShopRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ShopResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Shop
     *
     * @param CreateShopRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateShopRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}