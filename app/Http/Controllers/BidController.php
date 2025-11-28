<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    public function store(Request $request, Auction $auction)
    {
        if ($auction->status !== 'active' || $auction->planned_end_time <= now()) {
            return back()->with('error', 'Auction has ended.');
        }

        if ($auction->seller_id === Auth::id()) {
            return back()->with('error', 'You cannot bid on your own auction.');
        }

        $minimum = $auction->current_bid ?? $auction->starting_price;

        $request->validate([
            'amount' => "required|numeric|gt:$minimum",
        ]);

        $bid = DB::transaction(function () use ($request, $auction) {
            $locked = Auction::where('id', $auction->id)
                ->where('status', 'active')
                ->where('planned_end_time', '>', now())
                ->lockForUpdate()
                ->firstOrFail();

            $currentMin = $locked->current_bid ?? $locked->starting_price;

            if ($request->amount <= $currentMin) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'amount' => "Outbid! Current highest: $" . number_format($currentMin, 2),
                ]);
            }

            $newBid = Bid::create([
                'auction_id' => $locked->id,
                'bidder_id'  => Auth::id(),
                'amount'     => $request->amount,
            ]);

         

            $locked->update([
                'current_bid' => $request->amount,
                'bid_count'   => $locked->bids()->count(),
                'planned_end_time' => $locked->planned_end_time,
            ]);

            return $newBid;
        });

        return back()->with('success', "You’re winning at $" . number_format($bid->amount, 2) . '!');
    }
}
