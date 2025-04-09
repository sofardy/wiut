<?php

namespace App\Filament\Resources\ProductResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

/**
 * @property Product $resource
 */
class ProductTransformer extends JsonResource
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
            'slug' => $this->resource->slug,
            'description' => $this->resource->description,
            'image' => $this->resource->image_url,
            'price' => $this->resource->formatted_min_price,
            'category' => [
                'id' => $this->resource->category->id ?? null,
                'name' => $this->resource->category->name ?? null,
            ],
            'offers' => $this->resource->offers->map(function ($offer) {
                return [
                    'id' => $offer->id,
                    'price' => $offer->formatted_price,
                    'updated_at_price' => $offer->updated_at_price,
                    'shop' => $offer->shop->name ?? null,
                    'shop_product_url' => $offer->shop_product_url,
                ];
            }),
            'attributes' => $this->resource->attributes->map(function ($attribute) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'value' => $attribute->pivot->value,
                ];
            }),
        ];
    }
}
