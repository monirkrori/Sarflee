<?php

namespace App\Services\V1;

use App\Http\Resources\V1\Auth\UserResource;
use App\Http\Resources\V1\ExchangeShopResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data, string $role)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'governorate' => $role == 'regular'? ($data['governorate']??null) : null,
        ]);

        $user->assignRole($role);

        if ($role === 'exchange') {
            $user->exchangeShop()->create([
                'shop_name' => $data['shop_name'],
                'crypto_supported' => $data['crypto_supported'] ?? false,
                'phone' => $data['phone'],
                'address' => $data['address'] ?? null,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token,
                'shop' => $user->hasRole('exchange') ? new ExchangeShopResource($user->exchangeShop) : null,
            ]
        ], 201);
    }

    public function login(array $credentials, string $expectedRole)
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        $user = Auth::user();

        if (!$user->hasRole($expectedRole)) {
            Auth::logout();
            return response()->json(['message' => 'Unauthorized role'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'user' => new UserResource($user),
                'token' => $token,
                'shop' => $user->hasRole('exchange') ? new ExchangeShopResource($user->exchangeShop) : null,
            ]
        ]);
    }
}
