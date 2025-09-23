<x-app-layout>

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-[--background-900] to-[--background-800] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Auction Image & Details -->
            <div class="bg-[--background-800]/70 backdrop-blur-md border border-[--background-700] rounded-xl p-6 shadow-lg shadow-[--primary-900]/10">
                <img src="{{ $auction->product->image_url ?? 'https://placeholder.co/600x400' }}" alt="{{ $auction->product->name }}" class="w-full h-80 object-cover rounded-lg mb-6 transition-all duration-300 hover:scale-105">
                <h1 class="font-heading font-bold text-3xl text-[--text-50] mb-4">{{ $auction->product->name }}</h1>
                <p class="font-body text-[--text-300] mb-6">{{ $auction->product->description }}</p>
                <div class="flex justify-between text-[--text-400] font-body mb-4">
                    <span>Seller: {{ $auction->seller->name }}</span>
                    <span class="text-[--accent-400] animate-pulse">Time Left: {{ $timeLeft }}</span>
                </div>
                <div class="text-center">
                    <p class="font-heading font-bold text-2xl text-[--primary-400] mb-2">Current Bid: ${{ $auction->current_bid ?? $auction->starting_price }}</p>
                    <p class="font-body text-[--text-300]">Bids: {{ $auction->bid_count }}</p>
                </div>
            </div>

            <!-- Bidding Form & History -->
            <div class="bg-[--background-800]/70 backdrop-blur-md border border-[--background-700] rounded-xl p-6 shadow-lg shadow-[--primary-900]/10">
                <h2 class="font-heading font-bold text-2xl text-[--text-50] mb-6">Place Your Bid</h2>
                @if (Auth::check())
                    <form action="{{ route('bids.store', $auction) }}" method="POST"> <!-- Assuming BidController@store -->
                        @csrf
                        <input type="number" name="amount" step="0.01" min="{{ ($auction->current_bid ?? $auction->starting_price) + 0.01 }}" class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg mb-4 focus:border-[--primary-500] transition-all duration-300" placeholder="Enter your bid amount" required>
                        <button type="submit" class="w-full bg-gradient-to-r from-[--primary-600] to-[--primary-500] hover:from-[--primary-700] hover:to-[--primary-600] text-[--text-50] font-heading font-bold py-4 rounded-lg transition-all duration-300 shadow-md shadow-[--primary-500]/30 hover:shadow-lg hover:shadow-[--primary-500]/50">
                            Place Bid
                        </button>
                    </form>
                @else
                    <p class="text-[--accent-500] text-center">Login to place a bid!</p>
                @endif

                <h3 class="font-heading font-bold text-xl text-[--text-50] mt-8 mb-4">Bid History</h3>
                <ul class="space-y-4 max-h-64 overflow-y-auto">
                    @forelse ($auction->bids->sortByDesc('created_at') as $bid)
                        <li class="bg-[--background-700]/50 p-4 rounded-lg transition-all duration-300 hover:bg-[--background-600]/50">
                            <div class="flex justify-between">
                                <span class="font-body text-[--text-50]">{{ $bid->bidder->name }}</span>
                                <span class="font-heading text-[--primary-400]">${{ $bid->amount }}</span>
                            </div>
                            <p class="text-[--text-400] text-sm">{{ $bid->created_at->diffForHumans() }}</p>
                        </li>
                    @empty
                        <p class="text-[--text-300] text-center">No bids yet. Be the first!</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection 
</x-app-layout>