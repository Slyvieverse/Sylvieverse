<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
{
    public function index(Request $request)
    {
        $query = Auction::with(['product', 'seller', 'product.category'])
            ->where('status', 'active')
            ->where('planned_end_time', '>', now());

        // Category filter
        if ($request->filled('category_id')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'ending_soon') {
                $query->orderBy('planned_end_time', 'asc');
            } elseif ($request->sort === 'highest_bid') {
                $query->orderBy('current_bid', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $auctions = $query->paginate(12);
        $categories = Category::all();

        return view('auctions.index', compact('auctions', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('auctions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'starting_price' => ['required', 'numeric', 'min:0'],
            'start_time' => ['required', 'date', 'after_or_equal:now'],
            'planned_end_time' => ['required', 'date', 'after:start_time'],
        ]);

        $productData = $request->only([
            'name', 'description', 'price', 'category_id', 'stock_quantity'
        ]);
        $productData['user_id'] = Auth::id();
        $productData['status'] = 'active';

        if ($request->hasFile('image_url')) {
            $productData['image_url'] = $request->file('image_url')->store('product_images', 'public');
        }

        $product = Product::create($productData);

        Auction::create([
            'product_id' => $product->id,
            'seller_id' => Auth::id(),
            'starting_price' => $request->starting_price,
            'status' => 'active',
            'start_time' => $request->start_time,
            'planned_end_time' => $request->planned_end_time,
        ]);

        return redirect()->route('auctions.index')->with('success', 'Auction & product created successfully!');
    }

    public function show(Auction $auction)
    {
        $auction->load(['product', 'seller', 'bids.bidder']);
        $timeLeft = now()->diffForHumans($auction->planned_end_time, true);
        return view('auctions.show', compact('auction', 'timeLeft'));
    }

    public function edit(Auction $auction)
    {
        if ($auction->seller_id !== Auth::id()) {
            return redirect()->route('auctions.show', $auction)->with('error', 'Unauthorized action.');
        }
        $categories = Category::all();
        return view('auctions.edit', compact('auction', 'categories'));
    }

    public function update(Request $request, Auction $auction)
    {
        if ($auction->seller_id !== Auth::id()) {
            return redirect()->route('auctions.show', $auction)->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'starting_price' => ['required', 'numeric', 'min:0'],
            'start_time' => ['required', 'date', 'after_or_equal:now'],
            'planned_end_time' => ['required', 'date', 'after:start_time'],
        ]);

        $productData = $request->only([
            'name', 'description', 'price', 'category_id', 'stock_quantity'
        ]);

        if ($request->hasFile('image_url')) {
            if ($auction->product->image_url) {
                Storage::disk('public')->delete($auction->product->image_url);
            }
            $productData['image_url'] = $request->file('image_url')->store('product_images', 'public');
        }

        $auction->product->update($productData);

        $auction->update([
            'starting_price' => $request->starting_price,
            'start_time' => $request->start_time,
            'planned_end_time' => $request->planned_end_time,
        ]);

        return redirect()->route('auctions.show', $auction)->with('success', 'Auction updated successfully!');
    }

    public function destroy(Auction $auction)
    {
        if ($auction->seller_id !== Auth::id()) {
            return redirect()->route('auctions.show', $auction)->with('error', 'Unauthorized action.');
        }

        if ($auction->product->image_url) {
            Storage::disk('public')->delete($auction->product->image_url);
        }
        $auction->product->delete();
        $auction->delete();

        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully!');
    }
}