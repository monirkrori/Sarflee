<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Exchange\UpdateExchangeShopRequest;
use App\Http\Resources\V1\ExchangeShopResource;
use App\Services\V1\ExchangeShopService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ExchangeShopController extends Controller
{

    protected ExchangeShopService $exchangeShopService;

    public function __construct(ExchangeShopService $exchangeShopService)
    {
        $this->exchangeShopService = $exchangeShopService;
    }

    public function index(): JsonResponse
    {
        $user = Auth::user();

        $shops = $this->exchangeShopService->getRelevantShops($user);

        return response()->json([
            'shops' => ExchangeShopResource::collection($shops),

        ]);
    }

    public function show(): JsonResponse
    {
        $shop = $this->exchangeShopService->show(Auth::user());

        $this->authorize('view', $shop);

        return response()->json([
            'shop' => new ExchangeShopResource($shop)
        ]);
    }

    public function update(UpdateExchangeShopRequest $request): JsonResponse
    {
        $shop = Auth::user()->exchangeShop;


        if (!$shop) {
            abort(404, 'Shop not found.');
        }

        $updated = $this->exchangeShopService->update($shop, $request->validated());

        return response()->json([
            'message' => 'Shop updated successfully.',
            'shop' => new ExchangeShopResource($updated)
        ]);
    }

    public function destroy(): JsonResponse
    {
       $shop = $this->exchangeShopService->delete(Auth::user());
        $this->authorize('update', $shop);

        return response()->json([
            'message' => 'Shop deleted successfully.'
        ]);
    }
}
