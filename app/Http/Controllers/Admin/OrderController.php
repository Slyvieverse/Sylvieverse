<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
 public function index(Request $request)
{
    $query = Order::with('user');

    // Search (ID, User name)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('id', $search) // exact ID match
              ->orWhereHas('user', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              })
              ->orWhere('status', 'like', "%{$search}%");
        });
    }

    // Filter by order status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by payment status
    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    $orders = $query->paginate(10)->appends($request->query());

    return view('admin.orders.index', compact('orders'));
}

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product.category']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        $users = User::all();
        $products = Product::where('status', 'active')->get();
        return view('admin.orders.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'payment_status' => ['required', 'in:pending,paid,failed,refunded'],
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
