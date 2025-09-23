<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Store a new bid for an auction.
     */
    public function store(Request $request, Auction $auction)
    {
        // Validate the bid
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:' . (($auction->current_bid ?? $auction->starting_price) + 0.01),
            ],
        ]);

        // Check if auction is active and not expired
        if ($auction->status !== 'active' || $auction->planned_end_time <= now()) {
            return back()->withErrors(['amount' => 'This auction is no longer active.']);
        }

        // Prevent seller from bidding on their own auction
        if ($auction->seller_id === Auth::id()) {
            return back()->withErrors(['amount' => 'You cannot bid on your own auction.']);
        }

        // Create the bid
        $bid = Bid::create([
            'auction_id' => $auction->id,
            'bidder_id' => Auth::id(),
            'amount' => $request->amount,
        ]);

        // Update auction's current bid and bid count
        $auction->update([
            'current_bid' => $request->amount,
            'bid_count' => $auction->bids()->count(),
        ]);

        // TODO: Trigger real-time update with Pusher for bid history

        return redirect()->route('auctions.show', $auction)->with('success', 'Bid placed successfully!');
    }
}