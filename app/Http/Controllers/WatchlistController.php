<?php

namespace App\Http\Controllers;

use  Illuminate\Support\Facades\Auth;
use  App\Models\Watchlist;

use Illuminate\Http\Request;

class WatchlistController extends Controller
{
   // app/Http/Controllers/WatchlistController.php
public function index()
{
    $watchlists = Auth::user()->watchlists()->with(['product', 'auction.product'])->latest()->get();
    return view('watchlist.index', compact('watchlists'));
}
// app/Http/Controllers/WatchlistController.php
public function store(Request $request)
{
    $request->validate([
        'product_id' => 'nullable|exists:products,id',
        'auction_id' => 'nullable|exists:auctions,id',
    ], ['You can only watch one item at a time.']);

    // Prevent watching both at once
    if ($request->product_id && $request->auction_id) {
        return back()->with('error', 'Invalid request.');
    }

    Watchlist::firstOrCreate([
        'user_id'     => Auth::id(),
        'product_id'  => $request->product_id,
        'auction_id'  => $request->auction_id,
    ]);

    return back()->with('success', 'Added to watchlist!');
}
public function destroy(Watchlist $watchlist)
{

        // Simple check: Only the owner can delete their own watchlist item
        if ($watchlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $watchlist->delete();
        return back()->with('success', 'Removed from watchlist!');
    }
}

