<?php

namespace App\Filament\Resources\PromotionResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Promotion;

/**
 * @property Promotion $resource
 */
class PromotionTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'image' => $this->resource->image_url
        ];
    }
}
