<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
{
    public function index(Request $request)
    {
        $query = Auction::with(['product.category', 'seller'])
            ->where('status', 'active')
            ->where('planned_end_time', '>', now());

        if ($request->filled('category_id')) {
            $query->whereHas('product', fn($q) => $q->where('category_id', $request->category_id));
        }

        $sort = $request->get('sort', 'newest');
        $query->when($sort, function ($q, $sort) {
            return match ($sort) {
                'ending_soon' => $q->orderBy('planned_end_time'),
                'highest_bid'  => $q->orderByDesc('current_bid'),
                'most_bids'    => $q->orderByDesc('bid_count'),
                default        => $q->orderByDesc('created_at'),
            };
        });

        return view('auctions.index', [
            'auctions'    => $query->paginate(12)->withQueryString(),
            'categories'  => Category::all(),
            'currentSort' => $sort,
        ]);
    }

    public function create()
    {
        return view('auctions.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'category_id'      => 'required|exists:categories,id',
            'stock_quantity'   => 'required|integer|min:1',
            'image_url'        => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
            'starting_price'   => 'required|numeric|min:0.01',
            'planned_end_time' => 'required|date|after:now+5minutes',
        ]);

        $productData = $request->only(['name', 'description', 'price', 'category_id', 'stock_quantity']);
        $productData['user_id'] = Auth::id();
        $productData['status']  = 'active';

        if ($request->hasFile('image_url')) {
            $productData['image_url'] = $request->file('image_url')->store('products', 'public');
        }

        $product = Product::create($productData);

        Auction::create([
            'product_id'       => $product->id,
            'seller_id'        => Auth::id(),
            'starting_price'   => $validated['starting_price'],
            'current_bid'      => $validated['starting_price'],
            'status'           => 'active',
            'planned_end_time' => $validated['planned_end_time'],
            'bid_count'        => 0,
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction created and live!');
    }

    public function show(Auction $auction)
    {
        $auction->load(['product.category', 'seller', 'bids.bidder' => fn($q) => $q->latest()->limit(50)]);
        return view('auctions.show', compact('auction'));
    }

    public function destroy(Auction $auction)
    {
        if ($auction->seller_id !== Auth::id()) {
            return back()->with('error', 'Not your auction!');
        }

        if ($auction->product->image_url) {
            Storage::disk('public')->delete($auction->product->image_url);
        }

        $auction->product->delete();
        $auction->delete();

        return redirect()->route('auctions.index')->with('success', 'Auction permanently deleted.');
    }// In AuctionController.php
public function payWinningBid(Auction $auction, Request $request)
{
    $pi = $request->query('payment_intent');

    if ($auction->winner_id !== Auth::id()) {
        abort(403);
    }

    return view('auctions.pay-now', compact('auction', 'pi'));
}
// Add this method to your AuctionController
public function myAuctions(Request $request)
{
    $auctions = Auction::with(['product', 'winner'])
        ->where('seller_id', Auth::id())
        ->orWhere('winner_id', Auth::id())
        ->latest()
        ->paginate(12);

    return view('auctions.my-auctions', compact('auctions'));
}
}
