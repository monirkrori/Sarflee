<?php

namespace App\Policies\V1;

use App\Models\ExchangeShop;
use App\Models\User;

class ExchangeShopPolicy
{
    public function view(User $user, ExchangeShop $shop): bool
    {
        return $user->id === $shop->user_id;
    }

    public function update(User $user, ExchangeShop $shop): bool
    {

        return $user->id == $shop->user_id;
    }

    public function delete(User $user, ExchangeShop $shop): bool
    {
        return $user->id === $shop->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function destroy(User $user, ExchangeShop $exchangeShop): bool
    {
        return false;
    }
}
