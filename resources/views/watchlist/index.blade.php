{{-- resources/views/watchlist/index.blade.php --}}
<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-[#0a0a0e] via-[#0f0f1e] to-[#1e1e2f] py-16">
    <div class="container mx-auto px-4 max-w-7xl">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-[Poppins] font-bold text-[#f5f5f7] tracking-tight">
                My <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f472b6] to-[#c084fc]">Watchlist</span>
            </h1>
            <p class="text-[#f5f5f7]/60 font-[Roboto Serif] text-lg mt-4">
                {{ Auth::user()->watchlists()->count() }} item{{ Auth::user()->watchlists()->count() !== 1 ? 's' : '' }} saved
            </p>
        </div>

        @if(Auth::user()->watchlists()->exists())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach(Auth::user()->watchlists()->with(['product', 'auction.product'])->latest()->get() as $item)
                    @if($item->product)
                        <!-- Regular Shop Product -->
                        <div class="group bg-[#1e1e2f]/70 backdrop-blur-xl border border-[#5b21b6]/30 rounded-2xl overflow-hidden hover:border-[#c084fc]/60 transition-all duration-500 hover:shadow-2xl hover:shadow-[#7c3aed]/20">
                            <a href="{{ route('catalog', $item->product) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $item->product->image_url ?? asset('images/placeholder.jpg') }}"
                                         class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110"
                                         alt="{{ $item->product->name }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0e]/80 via-transparent to-transparent"></div>
                                    @if($item->product->hasDiscount())
                                        <span class="absolute top-4 left-4 bg-gradient-to-r from-[#ec4899] to-[#f472b6] text-white text-xs font-bold px-3 py-1 rounded-full">
                                            -{{ $item->product->discount_percent }}% OFF
                                        </span>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="font-[Poppins] text-[#f5f5f7] font-semibold text-lg line-clamp-2">
                                        {{ $item->product->name }}
                                    </h3>
                                    <div class="mt-3 flex items-center justify-between">
                                        <div>
                                            <p class="text-2xl font-bold text-[#c084fc]">
                                                ${{ number_format($item->product->final_price, 2) }}
                                            </p>
                                            @if($item->product->hasDiscount())
                                                <p class="text-sm text-[#f5f5f7]/50 line-through">
                                                    ${{ number_format($item->product->price, 2) }}
                                                </p>
                                            @endif
                                        </div>
                                        <form action="{{ route('watchlist.remove', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-3 bg-[#7c3aed]/20 hover:bg-red-500/30 text-[#f472b6] rounded-xl transition-all duration-300">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @elseif($item->auction)
                        @php $auction = $item->auction; @endphp
                        <!-- Auction Item -->
                        <div class="group bg-[#1e1e2f]/70 backdrop-blur-xl border {{ $auction->isEndingSoon() ? 'border-pink-500/60' : 'border-[#5b21b6]/30' }} rounded-2xl overflow-hidden hover:border-[#c084fc]/60 transition-all duration-500 hover:shadow-2xl hover:shadow-[#7c3aed]/20">
                            <a href="{{ route('auctions.show', $auction) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $auction->product->image_url ?? asset('images/placeholder.jpg') }}"
                                         class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110"
                                         alt="{{ $auction->product->name }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0e]/90 via-transparent to-transparent"></div>

                                    @if($auction->isEndingSoon())
                                        <div class="absolute top-4 left-4 bg-red-500/80 text-white text-xs font-bold px-4 py-2 rounded-full animate-pulse">
                                            Ending Soon!
                                        </div>
                                    @endif

                                    <div class="absolute bottom-4 left-4 right-4">
                                        <div class="bg-[#0a0a0e]/80 backdrop-blur-md rounded-xl p-3 border border-[#f472b6]/40">
                                            <p class="text-[#f472b6] text-xs font-bold uppercase tracking-wider">Current Bid</p>
                                            <p class="text-2xl font-bold text-white">
                                                ${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}
                                            </p>
                                            <p class="text-[#f5f5f7]/70 text-xs mt-1">
                                                {{ $auction->bid_count }} bid{{ $auction->bid_count !== 1 ? 's' : '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="font-[Poppins] text-[#f5f5f7] font-semibold text-lg line-clamp-2">
                                        {{ $auction->product->name }}
                                    </h3>
                                    <p class="text-[#f5f5f7]/60 text-sm mt-2">
                                        Ends {{ $auction->planned_end_time->diffForHumans() }}
                                    </p>
                                    <div class="mt-4 flex justify-between items-center">
                                        <span class="text-[#ec4899] font-bold">Live Auction</span>
                                        <form action="{{ route('watchlist.remove', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-3 bg-[#7c3aed]/20 hover:bg-red-500/30 text-[#f472b6] rounded-xl transition-all duration-300">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-32 h-32 mx-auto mb-8 rounded-3xl bg-[#1e1e2f]/50 border-2 border-dashed border-[#5b21b6]/40 flex items-center justify-center">
                    <svg class="w-16 h-16 text-[#7c3aed]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-4xl font-[Poppins] font-bold text-[#f5f5f7] mb-4">Your watchlist is empty</h3>
                <p class="text-[#f5f5f7]/70 text-lg font-[Roboto Serif] max-w-md mx-auto mb-10">
                    Save items you're interested in and they'll appear here for quick access.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="{{ route('catalog') }}"
                       class="bg-gradient-to-r from-[#5b21b6] to-[#7c3aed] hover:from-[#7c3aed] hover:to-[#a78bfa] text-white font-bold px-10 py-5 rounded-2xl text-lg shadow-2xl shadow-purple-500/30 hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300">
                        Browse Marketplace
                    </a>
                    <a href="{{ route('auctions.index') }}"
                       class="bg-gradient-to-r from-[#ec4899] to-[#f472b6] hover:from-[#f472b6] hover:to-[#f9a8d4] text-white font-bold px-10 py-5 rounded-2xl text-lg shadow-2xl shadow-pink-500/30 hover:shadow-pink-500/50 transform hover:-translate-y-1 transition-all duration-300">
                        View Live Auctions
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
</x-app-layout>
