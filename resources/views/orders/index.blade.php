<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#0a0a0e] to-[#1e1e2f] py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-[Poppins] font-bold text-[#f5f5f7]">Your Orders</h1>
                <div class="text-[#f5f5f7]/70 font-[Roboto Serif]">
                    {{ $orders->total() }} order(s) total
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-[#f5f5f7] p-4 rounded-lg mb-6 backdrop-blur-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500/50 text-[#f5f5f7] p-4 rounded-lg mb-6 backdrop-blur-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if($orders->isEmpty())
                <div class="text-center py-12">
                    <div class="text-[#f5f5f7]/50 text-6xl mb-4">📦</div>
                    <p class="text-[#f5f5f7]/70 font-[Roboto Serif] text-lg mb-4">You haven't placed any orders yet.</p>
                    <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-[#5b21b6] to-[#7c3aed] text-[#f5f5f7] font-[Poppins] py-3 px-6 rounded-lg hover:from-[#7c3aed] hover:to-[#5b21b6] transition-all duration-300">
                        Start Shopping
                    </a>
                </div>
            @else
                <!-- Filters and Sorting -->
                <div class="bg-[#1e1e2f]/70 backdrop-blur-sm border border-[#5b21b6]/50 rounded-xl p-6 mb-6">
                    <div class="flex flex-wrap gap-4 items-center">
                        <div>
                            <label class="text-[#f5f5f7] font-[Poppins] text-sm mb-2 block">Filter by Status</label>
                            <select class="bg-[#0a0a0e] border border-[#5b21b6]/30 text-[#f5f5f7] rounded-lg px-3 py-2 focus:outline-none focus:border-[#7c3aed]">
                                <option value="">All Orders</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[#f5f5f7] font-[Poppins] text-sm mb-2 block">Sort by</label>
                            <select class="bg-[#0a0a0e] border border-[#5b21b6]/30 text-[#f5f5f7] rounded-lg px-3 py-2 focus:outline-none focus:border-[#7c3aed]">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="price_high">Total: High to Low</option>
                                <option value="price_low">Total: Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="bg-[#1e1e2f]/70 backdrop-blur-sm border border-[#5b21b6]/50 rounded-xl p-6">
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($orders as $order)
                            <div class="bg-[#0a0a0e]/50 border border-[#7c3aed]/30 rounded-lg p-6 hover:border-[#f472b6]/50 transition-all duration-300">
                                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <a href="{{ route('user.orders.show', $order) }}" class="text-[#f5f5f7] font-[Poppins] text-xl hover:text-[#f472b6] transition-colors">
                                                Order #{{ $order->id }}
                                            </a>
                                            <span class="px-2 py-1 text-xs rounded-full
                                                @if($order->status === 'completed') bg-green-500/20 text-green-400 border border-green-500/30
                                                @elseif($order->status === 'processing') bg-blue-500/20 text-blue-400 border border-blue-500/30
                                                @elseif($order->status === 'pending') bg-yellow-500/20 text-yellow-400 border border-yellow-500/30
                                                @else bg-red-500/20 text-red-400 border border-red-500/30
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-sm text-[#f5f5f7]/70 font-[Roboto Serif]">
                                            <div>
                                                <span class="text-[#f5f5f7]/50">Date:</span>
                                                {{ $order->created_at->format('M d, Y') }}
                                            </div>
                                            <div>
                                                <span class="text-[#f5f5f7]/50">Items:</span>
                                                {{ $order->items_count ?? $order->orderItems->count() }}
                                            </div>
                                            <div>
                                                <span class="text-[#f5f5f7]/50">Total:</span>
                                                ${{ number_format($order->total_amount, 2) }}
                                            </div>
                                        </div>

                                        @if($order->orderItems->count() > 0)
                                            <div class="mt-3 flex items-center gap-2">
                                                <div class="flex -space-x-2">
                                                    @foreach($order->orderItems->take(3) as $item)
                                                        <div class="w-8 h-8 bg-[#5b21b6] rounded-full border-2 border-[#1e1e2f] flex items-center justify-center text-xs text-white">
                                                            {{ substr($item->product->name, 0, 1) }}
                                                        </div>
                                                    @endforeach
                                                    @if($order->orderItems->count() > 3)
                                                        <div class="w-8 h-8 bg-[#7c3aed] rounded-full border-2 border-[#1e1e2f] flex items-center justify-center text-xs text-white">
                                                            +{{ $order->orderItems->count() - 3 }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="text-[#f5f5f7]/50 text-sm">
                                                    {{ $order->orderItems->pluck('product.name')->implode(', ') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <a href="{{ route('user.orders.show', $order) }}" class="bg-gradient-to-r from-[#5b21b6] to-[#7c3aed] text-[#f5f5f7] font-[Poppins] py-2 px-4 rounded-lg hover:from-[#7c3aed] hover:to-[#5b21b6] transition-all duration-300 text-center">
                                            View Details
                                        </a>
                                        @if($order->status === 'pending' || $order->status === 'processing')
                                            <button class="border border-[#5b21b6] text-[#f5f5f7] font-[Poppins] py-2 px-4 rounded-lg hover:bg-[#5b21b6]/20 transition-all duration-300">
                                                Cancel Order
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $orders->links('partials.pagination') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Add filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.querySelector('select[value="status"]');
            const sortFilter = document.querySelector('select[value="sort"]');

            if (statusFilter) {
                statusFilter.addEventListener('change', function() {
                    // Add filter logic here
                    console.log('Filter by:', this.value);
                });
            }

            if (sortFilter) {
                sortFilter.addEventListener('change', function() {
                    // Add sort logic here
                    console.log('Sort by:', this.value);
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
