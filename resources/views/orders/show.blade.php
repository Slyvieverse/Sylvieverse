<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-[#0a0a0e] to-[#1e1e2f] py-12">
    <div class="container mx-auto px-4">
        <a href="{{ route('user.orders.index') }}" class="text-[#f472b6] font-[Poppins] mb-4 inline-block hover:text-[#f5f5f7]">&larr; Back to Orders</a>
        <h1 class="text-4xl font-[Poppins] font-bold text-[#f5f5f7] mb-8">Order #{{ $order->id }}</h1>

        <div class="bg-[#1e1e2f]/70 backdrop-blur-sm border border-[#5b21b6]/50 rounded-xl p-6">
            <!-- Order Summary -->
            <div class="mb-6">
                <h2 class="text-2xl font-[Poppins] text-[#f5f5f7] mb-4">Order Summary</h2>
                <p class="text-[#f5f5f7]/70 font-[Roboto Serif]">
                    <span class="text-[#f5f5f7]">Date:</span> {{ $order->created_at->format('M d, Y H:i') }}
                </p>
                <p class="text-[#f5f5f7]/70 font-[Roboto Serif]">
                    <span class="text-[#f5f5f7]">Total:</span> ${{ number_format($order->total_amount, 2) }}
                </p>
                <p class="text-[#f5f5f7]/70 font-[Roboto Serif]">
                    <span class="text-[#f5f5f7]">Status:</span> {{ ucfirst($order->status) }}
                </p>
                <p class="text-[#f5f5f7]/70 font-[Roboto Serif]">
                    <span class="text-[#f5f5f7]">Payment:</span> {{ ucfirst($order->payment_status) }} via {{ $order->payment_gateway }}
                </p>
                <p class="text-[#f5f5f7]/70 font-[Roboto Serif]">
                    <span class="text-[#f5f5f7]">Shipping Address:</span> {{ $order->shipping_address }}
                </p>
            </div>

            <!-- Order Items -->
            <div>
                <h2 class="text-2xl font-[Poppins] text-[#f5f5f7] mb-4">Items</h2>
                <div class="grid gap-4">
                    @foreach($order->orderItems as $item)
                        <div class="bg-[#0a0a0e]/50 border border-[#7c3aed]/30 rounded-lg p-4 flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="{{ $item->product->image_url ? asset('storage/' . $item->product->image_url) : asset('images/default-product.png') }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                                <div>
                                    <h3 class="text-[#f5f5f7] font-[Poppins]">{{ $item->product->name }}</h3>
                                    <p class="text-[#f5f5f7]/70 font-[Roboto Serif] text-sm">
                                        Quantity: {{ $item->quantity }} | 
                                        Price: ${{ number_format($item->price_at_purchase, 2) }}
                                    </p>
                                </div>
                            </div>
                            <span class="text-[#f5f5f7] font-[Poppins]">${{ number_format($item->quantity * $item->price_at_purchase, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>