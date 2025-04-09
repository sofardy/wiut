<?php
namespace App\Filament\Resources\OfferResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Offer;

/**
 * @property Offer $resource
 */
class OfferTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
