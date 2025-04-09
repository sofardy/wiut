<?php
namespace App\Filament\Resources\OfferResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\OfferResource;
use App\Filament\Resources\OfferResource\Api\Requests\CreateOfferRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = OfferResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Offer
     *
     * @param CreateOfferRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateOfferRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}