<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Services\V1\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerRegular(RegisterRequest $request)
    {
        return $this->authService->register($request->validated(), 'regular');
    }

    public function registerExchange(RegisterRequest $request)
    {
        return $this->authService->register($request->validated(), 'exchange');
    }

    public function loginRegular(LoginRequest $request)
    {
        return $this->authService->login($request->validated(), 'regular');
    }

    public function loginExchange(LoginRequest $request)
    {
        return $this->authService->login($request->validated(), 'exchange');
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response('logged out', 200);
    }

    public function destroy()
    {
        $user = auth()->user();

        auth()->user()->currentAccessToken()->delete();

        $user->delete();

        return response()->json([
            'message' => 'Account deleted successfully.'
        ], 200);
    }}
