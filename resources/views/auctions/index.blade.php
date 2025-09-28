<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[--background-900] to-[--background-800] py-12 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="font-heading font-bold text-5xl text-[--text-50] mb-4 animate-fade-in">SylvieVerse Auctions</h1>
            <p class="font-body text-[--text-300] text-xl max-w-2xl mx-auto">Dive into the cyberpunk marketplace. Bid on rare manhwa, manga, and collectibles in real-time. Time is ticking—don't miss out!</p>
        </header>

        <!-- Sort/Filter Bar -->
        <form class="flex flex-col sm:flex-row justify-end mb-6 space-y-4 sm:space-y-0 sm:space-x-4">
            <select name="category_id" onchange="this.form.submit()" class="bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-2 px-4 rounded-lg focus:outline-none focus:border-[--primary-500] transition-all duration-300">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <select name="sort" onchange="this.form.submit()" class="bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-2 px-4 rounded-lg focus:outline-none focus:border-[--primary-500] transition-all duration-300">
                <option value="">Sort By: Newest</option>
                <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>Ending Soon</option>
                <option value="highest_bid" {{ request('sort') == 'highest_bid' ? 'selected' : '' }}>Highest Bid</option>
            </select>
        </form>

        <!-- Auction Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($auctions as $auction)
                <div class="group relative bg-gradient-to-br from-[--background-800]/70 to-[--background-900]/80 backdrop-blur-md border border-[--background-700] rounded-xl overflow-hidden shadow-lg shadow-[--primary-900]/10 transition-all duration-500 hover:shadow-[--primary-500]/30 hover:-translate-y-2 hover:scale-105 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <!-- Glowing Neon Border Effect -->
                    <div class="absolute inset-0 border-2 border-transparent rounded-xl group-hover:border-[--primary-500] transition-all duration-300 opacity-0 group-hover:opacity-100"></div>

                    <!-- Image Container with Hover Zoom -->
                    <div class="overflow-hidden">
                        <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placeholder.co/400x300' }}" alt="{{ $auction->product->name }}" class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110 group-hover:rotate-1">
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="font-heading font-bold text-2xl text-[--text-50] mb-2 line-clamp-1 group-hover:text-[--primary-300] transition-colors duration-300">{{ $auction->product->name }}</h3>

                        <!-- Seller & Time Left -->
                        <div class="flex justify-between text-[--text-400] font-body text-sm mb-4">
                            <span>By: {{ $auction->seller->name }}</span>
                            <span class="text-[--accent-400] animate-pulse" data-timer="{{ $auction->planned_end_time->timestamp }}" data-auction-id="{{ $auction->id }}">Ends in: <span class="countdown">Calculating...</span></span>
                        </div>

                        <!-- Bid Info -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="font-body text-[--text-300] text-sm">Current Bid</p>
                                <p class="font-heading font-bold text-xl text-[--primary-400]">${{ $auction->current_bid ?? $auction->starting_price }}</p>
                            </div>
                            <div>
                                <p class="font-body text-[--text-300] text-sm">Bids</p>
                                <p class="font-heading font-bold text-xl text-[--accent-400]">{{ $auction->bid_count }}</p>
                            </div>
                        </div>

                        <!-- CTA Button with Glow -->
                        <a href="{{ route('auctions.show', $auction) }}" class="block bg-gradient-to-r from-[--primary-600] to-[--primary-500] hover:from-[--primary-700] hover:to-[--primary-600] text-[--text-50] font-heading font-bold text-sm px-6 py-3 rounded-lg transition-all duration-300 shadow-md shadow-[--primary-500]/30 hover:shadow-lg hover:shadow-[--primary-500]/50 text-center">
                            View Auction
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-[--text-300] font-body text-xl col-span-full">No active auctions found. Check back soon!</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $auctions->links() }}
        </div>
    </div>

    <!-- JavaScript for Countdown Timer -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const timers = document.querySelectorAll('[data-timer]');
            timers.forEach(timer => {
                const endTime = parseInt(timer.dataset.timer) * 1000; // Convert to milliseconds
                const auctionId = timer.dataset.auctionId;
                const countdownElement = timer.querySelector('.countdown');

                function updateTimer() {
                    const now = new Date().getTime();
                    const timeLeft = endTime - now;

                    if (timeLeft <= 0) {
                        countdownElement.textContent = 'Ended';
                        return;
                    }

                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    countdownElement.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                }

                updateTimer();
                setInterval(updateTimer, 1000);
            });
        });
    </script>
</x-app-layout>