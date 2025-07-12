<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeShopResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'price' =>$this->price,
            'address' => $this->address,
            'city' => $this->city,
            'governorate'=>$this->governorate,
            'phone' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'rating' => $this->rating ?? null,
            'crypto_supported' => (bool) $this->crypto_supported,
            'is_featured'=> (bool) $this->is_featured,
            'distance' => round($this->distance, 2),

        ];
    }
}
