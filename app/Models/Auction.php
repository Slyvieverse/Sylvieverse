<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'product_id',
        'seller_id',
        'starting_price',
        'current_bid',
        'bid_count',
        'status',
        'start_time',
        'planned_end_time',
        'actual_end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'planned_end_time' => 'datetime',
        'actual_end_time' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function watchlist()
    {
        return $this->hasMany(Watchlist::class);
    }
}