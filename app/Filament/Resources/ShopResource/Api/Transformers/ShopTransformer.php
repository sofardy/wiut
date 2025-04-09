<?php

namespace App\Filament\Resources\ShopResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Shop;

/**
 * @property Shop $resource
 */
class ShopTransformer extends JsonResource
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
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'logo' => $this->resource->logo ? url('storage/' . $this->resource->logo) : null,
            'website' => $this->resource->website,
        ];
    }
}
