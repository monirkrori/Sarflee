<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // مستخدم عادي في جرمانا
        User::create([
            'name' => 'Regular User',
            'email' => 'regular@example.com',
            'password' => Hash::make('password'),
            'phone' => '0999999999',
            'latitude' => 33.4856,
            'longitude' => 36.3615,
            'address' => 'جرمانا - ريف دمشق',
            'city' => 'جرمانا',
            'governorate' => 'ريف دمشق',
        ])->assignRole('regular');

        // صرافين
        $exchanges = [
            ['Exchange One', 'exchange1@example.com', 33.5102, 36.2921, 'باب توما', 10000],
            ['Exchange Two', 'exchange2@example.com', 33.4831, 36.2532, 'المزة', 9500],
            ['Exchange Three', 'exchange3@example.com', 33.5155, 36.2855, 'الشعلان', 11000],
            ['Exchange Four', 'exchange4@example.com', 33.4600, 36.2450, 'دويلعة', 9000],
            ['Exchange Five', 'exchange5@example.com', 33.4200, 36.3000, 'زملكا', 9700],
        ];

        foreach ($exchanges as [$name, $email, $lat, $lng, $city, $price]) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'phone' => '0991112233',
                'latitude' => $lat,
                'longitude' => $lng,
                'address' => $city . ' - دمشق',
                'city' => $city,
                'governorate' => 'دمشق',
            ])->assignRole('exchange');
        }
    }
}
