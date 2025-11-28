<?php

namespace App\Models;

use App\Mail\AuctionSoldToSeller;
use App\Mail\AuctionWonPayNow;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentIntent;
use Stripe\Stripe;

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
        'winner_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'planned_end_time' => 'datetime',
        'actual_end_time' => 'datetime',
    ];
   public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
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
    /**
     * Check if the auction is ending soon (default: within 10 minutes)
     * You can override the threshold: $auction->isEndingSoon(120) for 2 minutes
     */
    public function isEndingSoon(int $minutes = 10): bool
    {
        if ($this->status !== 'active' || !$this->planned_end_time) {
            return false;
        }

        return $this->planned_end_time->diffInMinutes(now()) <= $minutes;
    }

    /**
     * Optional: Get remaining time as human-readable string
     */
    public function timeLeft(): string
    {
        if (!$this->planned_end_time) {
            return 'Unknown';
        }

        if ($this->planned_end_time->isPast()) {
            return 'Ended';
        }

        return $this->planned_end_time->diffForHumans(['parts' => 2, 'short' => true]);
    }
  public function closeAuction()
{
    if ($this->status !== 'active') return;

    $this->status = 'completed';
    $this->actual_end_time = now();

    $winningBid = $this->bids()->orderByDesc('amount')->first();

    if ($winningBid) {
        $this->winner_id = $winningBid->bidder_id;
        $winningBid->is_winner = true;
        $winningBid->save();



        $paymentIntent = PaymentIntent::create([
            'amount' => $winningBid->amount * 100,
            'currency' => 'usd',
            'metadata' => [
                'auction_id' => $this->id,
                'type' => 'auction_win',
                'user_id' => $winningBid->bidder_id,
            ],
            'automatic_payment_methods' => ['enabled' => true],
        ]);

        $payUrl = route('auction.pay', [
            'auction' => $this->id,
            'payment_intent' => $paymentIntent->id
        ]);

        // Send emails
        Mail::to($winningBid->bidder)->send(new AuctionWonPayNow($this, $payUrl));
        Mail::to($this->seller)->send(new AuctionSoldToSeller($this));

        // DO NOT create order yet — only after payment
        // Stock stays reserved
    } else {
        $this->status = 'expired';
    }

    $this->save();
}
    /**
     * Optional: Scope for querying ending soon auctions
     */
    public function scopeEndingSoon($query, int $minutes = 10)
    {
        return $query->where('status', 'active')
                     ->where('planned_end_time', '>', now())
                     ->where('planned_end_time', '<=', now()->addMinutes($minutes));
    }
    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}
