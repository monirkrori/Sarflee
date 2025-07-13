<?php

namespace App\Services\V1;

use App\Models\ExchangeShop;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RatingService
{
    public function createOrUpdateRating($userId, $shopId, $rating, $comment = null)
    {
        $existingRating = Rating::where('user_id',$userId)
            ->where('exchange_shop_id',$shopId)
            ->first();

        if ($existingRating){
            $existingRating->update([
                'rating' => $rating,
                'comment' => $comment
            ]);
}
        else{
            Rating::create([
                'user_id' => $userId,
                'exchange_shop_id' => $shopId,
                'rating' => $rating,
                'comment' => $comment
            ]);
        }

        $this->updateShopRating($shopId);
    }

    public function updateShopRating($shopId)
    {
        $avgRating = Rating::where('exchange_shop_id',$shopId)->avg('rating');

        ExchangeShop::where('id', $shopId)->update(['rating' => $avgRating]);
    }



}
