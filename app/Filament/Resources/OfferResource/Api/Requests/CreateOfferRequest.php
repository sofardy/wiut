<?php

namespace App\Filament\Resources\OfferResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'product_id' => 'required',
			'shop_id' => 'required',
			'price' => 'required|numeric',
			'updated_at_price' => 'required|date',
			'shop_product_url' => 'required'
		];
    }
}
