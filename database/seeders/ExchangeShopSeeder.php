<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ExchangeShop;

class ExchangeShopSeeder extends Seeder
{
    public function run(): void
    {
        $shops = [
            [
                'email' => 'exchange1@example.com',
                'shop_name' => 'Bab Touma Exchange',
                'price' => 10000,
                'crypto_supported' => true,
                'address' => 'باب توما - دمشق',
                'city' => 'دمشق',
                'governorate' => 'دمشق',
                'latitude' => 33.5120000,
                'longitude' => 36.2921000,
                'phone' => '0991112233',
                'is_featured' => false,
                'rating' => 4.5
            ],
            [
                'email' => 'exchange2@example.com',
                'shop_name' => 'Mazzeh Exchange',
                'price' => 9500,
                'crypto_supported' => false,
                'address' => 'المزة - دمشق',
                'city' => 'دمشق',
                'governorate' => 'دمشق',
                'latitude' => 33.4831000,
                'longitude' => 36.2532000,
                'phone' => '0992223344',
                'is_featured' => true,
                'rating' => 4.2
            ],
            [
                'email' => 'exchange3@example.com',
                'shop_name' => 'Shaalan Exchange',
                'price' => 11000,
                'crypto_supported' => true,
                'address' => 'الشعلان - دمشق',
                'city' => 'دمشق',
                'governorate' => 'دمشق',
                'latitude' => 33.5155000,
                'longitude' => 36.2855000,
                'phone' => '0993334455',
                'is_featured' => false,
                'rating' => 4.7
            ],
            [
                'email' => 'exchange4@example.com',
                'shop_name' => 'Dweilaa Exchange',
                'price' => 9000,
                'crypto_supported' => false,
                'address' => 'دُويلعة - دمشق',
                'city' => 'دمشق',
                'governorate' => 'دمشق',
                'latitude' => 33.4600000,
                'longitude' => 36.2450000,
                'phone' => '0994445566',
                'is_featured' => true,
                'rating' => 4.0
            ],
            [
                'email' => 'exchange5@example.com',
                'shop_name' => 'Zamalka Exchange',
                'price' => 9700,
                'crypto_supported' => true,
                'address' => 'زملكا - دمشق',
                'city' => 'دمشق',
                'governorate' => 'دمشق',
                'latitude' => 33.4200000,
                'longitude' => 36.3000000,
                'phone' => '0995556677',
                'is_featured' => false,
                'rating' => 4.1
            ]
        ];

        foreach ($shops as $shopData) {
            $user = User::where('email', $shopData['email'])->first();

            if (!$user) {
                continue; // Skip if user not found
            }

            ExchangeShop::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'shop_name' => $shopData['shop_name'],
                    'price' => $shopData['price'],
                    'latitude' => $shopData['latitude'],
                    'longitude' => $shopData['longitude'],
                    'address' => $shopData['address'],
                    'city' => $shopData['city'],
                    'governorate' => $shopData['governorate'],
                    'phone' => $shopData['phone'],
                    'crypto_supported' => $shopData['crypto_supported'],
                    'is_featured' => $shopData['is_featured'],
                    'rating' => $shopData['rating'],
                ]
            );
        }
    }
}
