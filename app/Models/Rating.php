<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'exchange_shop_id', 'rating', 'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exchangeShop()
    {
        return $this->belongsTo(ExchangeShop::class);
    }
}
