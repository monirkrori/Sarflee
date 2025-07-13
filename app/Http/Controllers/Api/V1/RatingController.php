<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Rating\RatingRequest;
use App\Services\v1\RatingService;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }


    public function rateShop(RatingRequest $request, $shopId)
    {
        $user = auth()->user();

        $rating = $request->validated()['rating'];
        $comment = $request->validated()['comment'] ?? null;

        $this->ratingService->createOrUpdateRating($user->id, $shopId, $rating, $comment);

        return response()->json([
            'message' => 'Rating submitted successfully.'
        ]);
    }}
