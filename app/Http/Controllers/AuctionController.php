<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    /**
     * Display a listing of active auctions (customer-facing).
     */
    public function index(Request $request)
    {
        // Fetch active auctions with related product and seller
        $query = Auction::with(['product', 'seller'])
            ->where('status', 'active')
            ->where('planned_end_time', '>', now());

        // Optional: Sort by ending soon, highest bid, etc.
        if ($request->filled('sort')) {
            if ($request->sort === 'ending_soon') {
                $query->orderBy('planned_end_time', 'asc');
            } elseif ($request->sort === 'highest_bid') {
                $query->orderBy('current_bid', 'desc');
            } else {
                $query->orderBy('created_at', 'desc'); // Default: newest first
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $auctions = $query->paginate(12); // Paginate for performance, 12 per page for grid

        return view('auctions.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new auction.
     */
    public function create()
    {
        // Fetch user's products that can be auctioned (e.g., active, in stock)
        $products = Product::where('user_id', Auth::id()) // Assuming products have user_id if user-owned
            ->where('status', 'active')
            ->where('stock_quantity', '>', 0)
            ->get();

        return view('auctions.create', compact('products'));
    }

    /**
     * Store a newly created auction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'starting_price' => ['required', 'numeric', 'min:0'],
            'start_time' => ['required', 'date', 'after:now'],
            'planned_end_time' => ['required', 'date', 'after:start_time'],
        ]);

        $auction = Auction::create([
            'product_id' => $request->product_id,
            'seller_id' => Auth::id(),
            'starting_price' => $request->starting_price,
            'status' => 'active',
            'start_time' => $request->start_time,
            'planned_end_time' => $request->planned_end_time,
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    /**
     * Display the specified auction.
     */
    public function show(Auction $auction)
    {
        $auction->load(['product', 'seller', 'bids.bidder']);

        // Fetch time left (for display)
        $timeLeft = now()->diffForHumans($auction->planned_end_time, true);

        return view('auctions.show', compact('auction', 'timeLeft'));
    }

    // Additional methods can be added later, e.g., for bidding (placeBid in BidController)
}