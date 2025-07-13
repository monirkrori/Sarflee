<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeShop extends Model
{
    protected $fillable = [
        'user_id', 'shop_name', 'crypto_supported', 'phone', 'address', 'latitude', 'longitude', 'rating',
        'is_featured','price','city','governorate','distance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}

