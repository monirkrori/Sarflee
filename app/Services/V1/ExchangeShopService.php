<?php

namespace App\Services\V1;

use App\Models\ExchangeShop;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ExchangeShopService
{


    public function getRelevantShops(User $user, float $radiusInKm = 5)
    {
        if ($this->hasValidCoordinates($user)) {
            return $this->getShopsByDistance($user->latitude, $user->longitude, $radiusInKm);
        }

        return $this->getShopsByGovernorate($user->governorate);
    }

    private function hasValidCoordinates(User $user): bool
    {
        return !is_null($user->latitude) && !is_null($user->longitude);
    }



    private function getShopsByDistance(float $lat, float $lng, float $radius)
    {
        return DB::table('exchange_shops')
            ->select(
                'exchange_shops.*',
                DB::raw("(
                6371 * acos(
                    cos(radians($lat)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians($lng)) +
                    sin(radians($lat)) * sin(radians(latitude))
                )
            ) AS distance")
            )
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();
    }    private function getShopsByGovernorate(string $governorate): \Illuminate\Support\Collection
    {
        return ExchangeShop::where('governorate', $governorate)->get();
    }

    public function update(ExchangeShop $shop, array $data): ExchangeShop
    {

        if (!$shop) {
            abort(404, 'Exchange shop not found.');
        }

        $city = null;
        $governorate = null;

        if (!empty($data['address']) && str_contains($data['address'], '-')) {
            [$city, $governorate] = array_map('trim', explode('-', $data['address'], 2));
        }

        $shop->update([
            'shop_name' => $data['shop_name'] ?? $shop->shop_name,
            'price' => $data['price'] ?? $shop->price,
            'phone' => $data['phone'] ?? $shop->phone,
            'crypto_supported' => $data['crypto_supported'] ?? $shop->crypto_supported,
            'address' => $data['address'] ?? $shop->address,
            'latitude' => $data['latitude'] ?? $shop->latitude,
            'longitude' => $data['longitude'] ?? $shop->longitude,
            'city' => $city ?? $shop->city,
            'governorate' => $governorate ?? $shop->governorate,
        ]);

        return $shop;
    }



    public function delete(User $user): bool
    {
        $shop = $user->exchangeShop;

        if (!$shop) {
            abort(404, 'Exchange shop not found.');
        }

        return $shop->delete();
    }

    public function show(User $user): ExchangeShop
    {
        $shop = $user->exchangeShop;

        if (!$shop) {
            abort(404, 'Exchange shop not found.');
        }

        return $shop;
    }

}
