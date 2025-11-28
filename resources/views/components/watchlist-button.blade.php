{{-- resources/views/components/watchlist-button.blade.php --}}
@props(['product' => null, 'auction' => null])

@php
    $isWatched = false;
    $watchlistId = null;

    if ($product) {
        $isWatched = auth()->check() && auth()->user()->watchlists()->where('product_id', $product->id)->exists();
        $watchlistId = auth()->user()?->watchlists()->where('product_id', $product->id)->first()?->id;
    } elseif ($auction) {
        $isWatched = auth()->check() && auth()->user()->watchlists()->where('auction_id', $auction->id)->exists();
        $watchlistId = auth()->user()?->watchlists()->where('auction_id', $auction->id)->first()?->id;
    }
@endphp

<div class="relative">
    @auth
        @if($isWatched)
            <!-- REMOVE FROM WATCHLIST -->
            <form action="{{ route('watchlist.remove', $watchlistId) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit"
                    class="p-4 bg-gradient-to-r from-pink-600/30 to-purple-600/30 backdrop-blur-xl border border-pink-500/60 rounded-full hover:border-red-500/80 hover:bg-red-500/20 transition-all duration-300 hover:scale-110">
                    <svg class="w-7 h-7 text-pink-400 drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </button>
            </form>
        @else
            <!-- ADD TO WATCHLIST -->
            <form action="{{ route('watchlist.add') }}" method="POST" class="inline">
                @csrf
                @if($product)
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                @elseif($auction)
                    <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                @endif
                <button type="submit"
                    class="p-4 bg-[#1e1e2f]/80 backdrop-blur-xl border border-[#7c3aed]/50 rounded-full hover:border-[#f472b6] hover:bg-[#f472b6]/10 transition-all duration-300 hover:scale-110">
                    <svg class="w-7 h-7 text-[#c084fc] hover:text-[#f472b6] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </button>
            </form>
        @endif
    @else
        <!-- Not logged in → show login prompt on hover -->
        <a href="{{ route('login') }}"
           class="p-4 bg-[#1e1e2f]/80 backdrop-blur-xl border border-[#7c3aed]/40 rounded-full hover:border-[#f472b6] transition-all duration-300 hover:scale-110 inline-block"
           title="Log in to save to watchlist">
            <svg class="w-7 h-7 text-[#c084fc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </a>
    @endauth

    <!-- Tooltip -->
    <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-[#0a0a0e]/95 text-[#f5f5f7] text-xs px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity whitespace-nowrap z-10">
        {{ $isWatched ? 'Remove from Watchlist' : 'Add to Watchlist' }}
    </span>
</div>
