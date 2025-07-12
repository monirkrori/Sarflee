<?php

namespace App\Http\Requests\V1\Exchange;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExchangeShopRequest extends FormRequest
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
            'shop_name' => 'sometimes|string|max:255',
            'crypto_supported' => 'sometimes|boolean',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'price' => 'sometimes|numeric|min:0|max:1000000',
            'city' => 'nullable|string|max:100',
            'governorate' => 'nullable|string|max:100',
            'is_featured' => 'sometimes|boolean',
            'rating' => 'nullable|numeric|min:1|max:5',
        ];
    }

}
