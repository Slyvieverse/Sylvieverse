<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart ?? Cart::create(['user_id' => Auth::id()]);
        $cart->load('items.product');
        return view('cart.index', compact('cart'));
    }
     public function count()
    {
        $cart = Auth::user()->cart;
        $count = $cart ? $cart->items->sum('quantity') : 0;
        return response()->json(['count' => $count]);
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock_quantity],
        ]);

        $cart = Auth::user()->cart ?? Cart::create(['user_id' => Auth::id()]);
        $cartItem = $cart->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity' => $request->quantity]
        );

        return redirect()->route('cart.index')->with('success', 'Added to cart!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$cartItem->product->stock_quantity],
        ]);

        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }
}
