<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product', 'orderItems.product.category']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Not implemented: Orders are typically created by users or auction processes
        return redirect()->route('admin.orders.index')->with('error', 'Order creation is not available in the admin panel.');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Not implemented: Orders are typically created by users or auction processes
        return redirect()->route('admin.orders.index')->with('error', 'Order creation is not available in the admin panel.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        // Not implemented: Orders are typically not edited by admins to maintain integrity
        return redirect()->route('admin.orders.index')->with('error', 'Order editing is not available in the admin panel.');
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        // Not implemented: Orders are typically not edited by admins to maintain integrity
        return redirect()->route('admin.orders.index')->with('error', 'Order editing is not available in the admin panel.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        // Not implemented: Orders are typically not deleted by admins to maintain records
        return redirect()->route('admin.orders.index')->with('error', 'Order deletion is not available in the admin panel.');
    }
}
