<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
public function index()
{
    $cart = Auth::user()->cart;
    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $total = $cart->items->sum(fn($item) => $item->quantity * $item->product->final_price);

    $paymentIntent = PaymentIntent::create([
        'amount' => $total * 100,
        'currency' => 'usd',
        'metadata' => ['user_id' => Auth::id()],
        'automatic_payment_methods' => ['enabled' => true],
    ]);

    return view('checkout.index', [
        'cart' => $cart,
        'total' => $total,
        'clientSecret' => $paymentIntent->client_secret,
    ]);
}

public function store(Request $request)
{
    $cart = Auth::user()->cart;
    $total = $cart->items->sum(fn($item) => $item->quantity * $item->product->final_price);

    $paymentIntent = PaymentIntent::create([
        'amount' => $total * 100,
        'currency' => 'usd',
        'metadata' => ['user_id' => Auth::id()],
    ]);

    return response()->json([
        'client_secret' => $paymentIntent->client_secret,
    ]);
}

public function success(Request $request)
{
    $cart = Auth::user()->cart;
    $total = $cart->items->sum(fn($item) => $item->quantity * $item->product->final_price);

    $order = Order::create([
        'user_id' => Auth::id(),
        'total_amount' => $total,
        'status' => 'completed',
        'payment_status' => 'paid',
        'payment_gateway' => 'stripe',
        'transaction_id' => $request->input('payment_intent'),
        'shipping_address' => 'Digital Delivery',
    ]);

    foreach ($cart->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price_at_purchase' => $item->product->final_price,
            'original_price' => $item->product->price,
        ]);

        $item->product->decrement('stock_quantity', $item->quantity);
    }

    $cart->items()->delete();

    return view('checkout.success', compact('order', 'total'));
}

}
