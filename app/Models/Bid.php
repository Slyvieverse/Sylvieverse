<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
   protected $fillable = [
        'auction_id',
        'bidder_id',
        'amount',
        'is_winner',
    ];

    protected $casts = [
        'is_winner' => 'boolean',
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function bidder()
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }
}
