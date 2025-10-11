<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminAuctionController extends Controller
{
    /**
     * Display a listing of auctions.
     */
    public function index(Request $request)
    {
        $query = Auction::with(['product', 'seller']);

        // Search by product name or seller name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($subQ) use ($search) {
                    $subQ->where('name', 'like', "%{$search}%");
                })->orWhereHas('seller', function ($subQ) use ($search) {
                    $subQ->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $auctions = $query->paginate(15);
        return view('admin.auctions.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new auction.
     */
    public function create()
    {
        // Note: Creation might be user-driven; admin creation could be implemented if needed
        $categories = Category::all();
        return view('admin.auctions.create', compact('categories'));
    }

    /**
     * Store a newly created auction.
     */
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
        return redirect()->route('admin.auctions.index')->with('success', 'Auction created successfully.');
    }

    /**
     * Display the specified auction.
     */
    public function show(Auction $auction)
    {
        $auction->load(['product.category', 'seller', 'bids.bidder']);
        return view('admin.auctions.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified auction.
     */
    public function edit(Auction $auction)
    {
        $categories = Category::all();
        return view('admin.auctions.edit', compact('auction', 'categories'));
    }

    /**
     * Update the specified auction.
     */
    public function update(Request $request, Auction $auction)
    {
        $request->validate([
            'status' => ['required', 'in:active,pending,completed,cancelled'],
            'starting_price' => ['required', 'numeric', 'min:0'],
            'planned_end_time' => ['required', 'date', 'after:start_time'],
        ]);

        $auction->update([
            'status' => $request->status,
            'starting_price' => $request->starting_price,
            'planned_end_time' => $request->planned_end_time,
        ]);

        return redirect()->route('admin.auctions.show', $auction)->with('success', 'Auction updated successfully.');
    }

    /**
     * Cancel the specified auction.
     */
    public function cancel(Auction $auction)
    {
        $auction->update(['status' => 'cancelled']);
        return redirect()->route('admin.auctions.index')->with('success', 'Auction cancelled successfully.');
    }

    /**
     * Close the specified auction manually.
     */
    public function close(Auction $auction)
    {
        $auction->update(['status' => 'closed']);
        return redirect()->route('admin.auctions.show', $auction)->with('success', 'Auction closed successfully.');
    }

    /**
     * Remove the specified auction from storage.
     */
    public function destroy(Auction $auction)
    {
        // Delete associated product image if exists
        if ($auction->product->image_url) {
            Storage::disk('public')->delete($auction->product->image_url);
        }

        // Delete product and auction
        $auction->product->delete();
        $auction->delete();

        return redirect()->route('admin.auctions.index')->with('success', 'Auction and product deleted successfully.');
    }
}