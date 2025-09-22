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

    $total = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

    $paymentIntent = PaymentIntent::create([
        'amount' => $total * 100, // in cents
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
        $total = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

        // Create PaymentIntent on server
        $paymentIntent = PaymentIntent::create([
            'amount' => $total * 100, // Stripe uses cents
            'currency' => 'usd',
            'metadata' => ['user_id' => Auth::id()],
        ]);

        // For now, return client secret for frontend confirmation
        return response()->json([
            'client_secret' => $paymentIntent->client_secret,
        ]);
    }

    public function success(Request $request)
    {
        // Verify payment (use $request->session() for real impl)
        // Create Order from cart, clear cart
        $cart = Auth::user()->cart;
     $total = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

$order = Order::create([
    'user_id' => Auth::id(),
    'total_amount' => $total,  // ✅ not null anymore
    'status' => 'completed',
    'payment_status' => 'paid',
    'payment_gateway' => 'stripe',
    'transaction_id' => $request->input('payment_intent'),
    'shipping_address' => $request->input('shipping_address', 'Default Address'),
]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_at_purchase' => $item->product->price,
            ]);
        }

        $cart->items->each->delete(); // Clear cart

        return view('checkout.success', compact('order' , 'total'));
    }
}