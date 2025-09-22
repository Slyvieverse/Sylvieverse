<x-app-layout>
   
<div class="min-h-screen bg-gradient-to-br from-[#0a0a0e] to-[#1e1e2f] py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-[Poppins] font-bold text-[#f5f5f7] mb-8">Your Orders</h1>

        @if(session('success'))
            <div class="bg-[#5b21b6]/20 text-[#f5f5f7] p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif

        @if($orders->isEmpty())
            <p class="text-[#f5f5f7]/70 font-[Roboto Serif] text-lg">You haven't placed any orders yet.</p>
        @else
            <div class="bg-[#1e1e2f]/70 backdrop-blur-sm border border-[#5b21b6]/50 rounded-xl p-6">
                <div class="grid grid-cols-1 gap-4">
                    @foreach($orders as $order)
                        <div class="bg-[#0a0a0e]/50 border border-[#7c3aed]/30 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <a href="{{ route('user.orders.show', $order) }}" class="text-[#f5f5f7] font-[Poppins] text-xl hover:text-[#f472b6]">
                                    Order #{{ $order->id }}
                                </a>
                                <p class="text-[#f5f5f7]/70 font-[Roboto Serif] text-sm">
                                    {{ $order->created_at->format('M d, Y') }} | 
                                    Total: ${{ number_format($order->total_amount, 2) }} | 
                                    Status: {{ ucfirst($order->status) }}
                                </p>
                            </div>
                            <a href="{{ route('user.orders.show', $order) }}" class="bg-gradient-to-r from-[#5b21b6] to-[#7c3aed] text-[#f5f5f7] font-[Poppins] py-2 px-4 rounded-lg hover:bg-[#7c3aed]">
                                View Details
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $orders->links('partials.pagination') }}
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>