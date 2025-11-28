{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-[#0a0a0e] via-[#0f0f1e] to-[#1e1e2f] py-16">
    <div class="container mx-auto px-4 max-w-7xl">

        <!-- Welcome Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-[Poppins] font-bold text-[#f5f5f7] tracking-tight">
                Welcome back, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f472b6] to-[#c084fc]">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-[#f5f5f7]/60 font-[Roboto Serif] text-lg mt-4">Here's what's happening with your account today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- My Orders -->
            <div class="bg-[#1e1e2f]/70 backdrop-blur-xl border border-[#5b21b6]/30 rounded-2xl p-6 hover:border-[#c084fc]/60 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[#f5f5f7]/80 font-[Poppins] text-sm uppercase tracking-wider">My Orders</h3>
                    <div class="p-3 rounded-xl bg-gradient-to-br from-[#5b21b6]/20 to-[#7c3aed]/10">
                        <svg class="w-6 h-6 text-[#c084fc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-[#f5f5f7] font-[Poppins]">{{ Auth::user()->orders()->count() }}</p>
                <p class="text-[#f5f5f7]/60 text-sm mt-2">Total purchases</p>
            </div>

            <!-- Watchlist -->
            <div class="bg-[#1e1e2f]/70 backdrop-blur-xl border border-[#5b21b6]/30 rounded-2xl p-6 hover:border-[#c084fc]/60 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[#f5f5f7]/80 font-[Poppins] text-sm uppercase tracking-wider">Watchlist</h3>
                    <div class="p-3 rounded-xl bg-gradient-to-br from-[#ec4899]/20 to-[#f472b6]/10">
                        <svg class="w-6 h-6 text-[#f472b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-[#f5f5f7] font-[Poppins]">{{ Auth::user()->watchlists()->count() }}</p>
                <p class="text-[#f5f5f7]/60 text-sm mt-2">Saved items</p>
            </div>

            <!-- Active Bids -->
            <div class="bg-[#1e1e2f]/70 backdrop-blur-xl border border-[#5b21b6]/30 rounded-2xl p-6 hover:border-[#c084fc]/60 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[#f5f5f7]/80 font-[Poppins] text-sm uppercase tracking-wider">Active Bids</h3>
                    <div class="p-3 rounded-xl bg-gradient-to-br from-[#8b5cf6]/20 to-[#a78bfa]/10">
                        <svg class="w-6 h-6 text-[#a78bfa]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-[#f5f5f7] font-[Poppins]">
                    {{ Auth::user()->bids()->whereHas('auction', fn($q) => $q->where('status', 'active'))->count() }}
                </p>
                <p class="text-[#f5f5f7]/60 text-sm mt-2">Currently bidding</p>
            </div>

            <!-- Wallet -->
            <div class="bg-gradient-to-br from-[#5b21b6]/40 to-[#7c3aed]/20 backdrop-blur-xl border border-[#c084fc]/50 rounded-2xl p-6 hover:shadow-2xl hover:shadow-[#7c3aed]/30 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[#f5f5f7] font-[Poppins] text-sm uppercase tracking-wider">Wallet Balance</h3>
                    <div class="p-3 rounded-xl bg-[#f5f5f7]/10">
                        <svg class="w-6 h-6 text-[#f5f5f7]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl font-bold text-[#f5f5f7] font-[Poppins]">$0.00</p>
                <p class="text-[#c084fc] text-sm mt-2 font-medium">Add funds →</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

            <!-- Recent Orders -->
            <div class="bg-[#1e1e2f]/70 backdrop-blur-xl border border-[#5b21b6]/40 rounded-2xl p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-[Poppins] font-bold text-[#f5f5f7]">Recent Orders</h2>
                    <a href="{{ route('user.orders.index') }}" class="text-[#c084fc] hover:text-[#f472b6] text-sm font-medium transition">View all →</a>
                </div>

                @if(Auth::user()->orders()->exists())
                    <div class="space-y-4">
                        @foreach(Auth::user()->orders()->latest()->take(5)->get() as $order)
                            <div class="bg-[#0a0a0e]/50 border border-[#7c3aed]/20 rounded-xl p-5 flex justify-between items-center hover:border-[#c084fc]/50 transition">
                                <div>
                                    <p class="text-[#f5f5f7] font-[Poppins] font-semibold">#{{ $order->id }} • {{ $order->created_at->format('M d, Y') }}</p>
                                    <p class="text-[#f5f5f7]/70 text-sm mt-1">
                                        {{ $order->orderItems->count() }} items • ${{ number_format($order->total_amount, 2) }}
                                    </p>
                                </div>
                                <span class="px-4 py-2 rounded-full text-xs font-bold
                                    {{ $order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-300' :
                                       ($order->status === 'processing' ? 'bg-purple-500/20 text-purple-300' : 'bg-yellow-500/20 text-yellow-300') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-[#0a0a0e]/50 border-2 border-dashed border-[#5b21b6]/30 flex items-center justify-center">
                            <svg class="w-10 h-10 text-[#7c3aed]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <p class="text-[#f5f5f7]/80 text-lg font-[Roboto Serif]">No orders yet</p>
                        <a href="{{ route('catalog') }}" class="text-[#c084fc] hover:text-[#f472b6] mt-4 inline-block">Start Shopping →</a>
                    </div>
                @endif
            </div>

            <!-- Active Bids -->
            <div class="bg-[#1e1e2f]/70 backdrop-blur-xl border border-[#5b21b6]/40 rounded-2xl p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-[Poppins] font-bold text-[#f5f5f7]">Active Bids</h2>
                    <a href="{{ route('auctions.index') }}" class="text-[#c084fc] hover:text-[#f472b6] text-sm font-medium transition">View all →</a>
                </div>

                @if(Auth::user()->bids()->whereHas('auction', fn($q) => $q->where('status', 'active'))->exists())
                    <div class="space-y-4">
                        @foreach(Auth::user()->bids()->with('auction.product')->whereHas('auction', fn($q) => $q->where('status', 'active'))->latest()->take(5)->get() as $bid)
                            @php $auction = $bid->auction; @endphp
                            <div class="bg-[#0a0a0e]/50 border border-[#7c3aed]/20 rounded-xl p-5 flex items-center gap-5 hover:border-[#c084fc]/50 transition">
                                <img src="{{ $auction->product->image_url ?? asset('images/placeholder.jpg') }}"
                                     class="w-16 h-16 object-cover rounded-lg shadow-lg" alt="{{ $auction->product->name }}">
                                <div class="flex-1">
                                    <p class="text-[#f5f5f7] font-[Poppins] font-medium line-clamp-1">{{ $auction->product->name }}</p>
                                    <p class="text-[#c084fc] text-sm font-bold">Your bid: ${{ number_format($bid->amount, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[#f5f5f7]/60 text-xs">Ends</p>
                                    <p class="text-[#f472b6] font-bold text-sm">{{ $auction->planned_end_time->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-[#0a0a0e]/50 border-2 border-dashed border-[#5b21b6]/30 flex items-center justify-center">
                            <svg class="w-10 h-10 text-[#7c3aed]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-[#f5f5f7]/80 text-lg font-[Roboto Serif]">No active bids</p>
                        <a href="{{ route('auctions.index') }}" class="text-[#c084fc] hover:text-[#f472b6] mt-4 inline-block">Browse Auctions →</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="flex flex-wrap gap-6 justify-center">
            <a href="{{ route('catalog') }}"
               class="bg-gradient-to-r from-[#5b21b6] to-[#7c3aed] hover:from-[#7c3aed] hover:to-[#a78bfa] text-[#f5f5f7] font-[Poppins] font-bold px-10 py-5 rounded-2xl shadow-2xl shadow-purple-500/30 hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300 text-lg">
                Browse Marketplace
            </a>
            <a href="{{ route('auctions.index') }}"
               class="bg-gradient-to-r from-[#ec4899] to-[#f472b6] hover:from-[#f472b6] hover:to-[#f9a8d4] text-[#f5f5f7] font-[Poppins] font-bold px-10 py-5 rounded-2xl shadow-2xl shadow-pink-500/30 hover:shadow-pink-500/50 transform hover:-translate-y-1 transition-all duration-300 text-lg">
                Live Auctions
            </a>
        </div>

        <!-- First Time Welcome -->
        @if(Auth::user()->orders()->count() === 0 && Auth::user()->watchlists()->count() === 0 && Auth::user()->bids()->count() === 0)
            <div class="text-center mt-20">
                <h2 class="text-5xl md:text-7xl font-[Poppins] font-bold text-[#f5f5f7] mb-6">
                    Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f472b6] via-[#c084fc] to-[#a78bfa]">SylvieVerse</span>
                </h2>
                <p class="text-[#f5f5f7]/70 text-xl font-[Roboto Serif] max-w-3xl mx-auto mb-10">
                    Discover rare collectibles, bid in real-time auctions, and build your dream collection in the neon-lit world of comics.
                </p>
                <a href="{{ route('catalog') }}" class="text-2xl text-[#c084fc] hover:text-[#f472b6] font-medium">
                    Start Your Journey →
                </a>
            </div>
        @endif

    </div>
</div>
</x-app-layout>
