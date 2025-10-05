<x-app-layout>
    <style>
        /* CSS Variables - Define the colors for both themes */
        :root {
            /* Light Mode Colors (Placeholder - Use your actual defined light mode colors) */
            --color-primary-400: #6B46C1;
            --color-primary-500: #553C9A;
            --color-primary-600: #44337A;
            --color-primary-700: #322659;
            --color-accent-400: #D53F8C; /* Used for timers/bids */
            --color-background-700: #E2E8F0;
            --color-background-800: #F7FAFC;
            --color-background-900: #FFFFFF;
            --color-text-50: #1A202C;
            --color-text-300: #4A5568;
            --color-text-400: #718096;
        }

        /* Dark Mode */
        .dark {
            --color-primary-400: #805AD5;
            --color-primary-500: #6B46C1;
            --color-primary-600: #553C9A;
            --color-primary-700: #44337A;
            --color-accent-400: #ED64A6;
            --color-background-700: #1A202C;
            --color-background-800: #2D3748;
            --color-background-900: #171923;
            --color-text-50: #E2E8F0;
            --color-text-300: #718096;
            --color-text-400: #4A5568;
        }

        /* Custom Keyframes */
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 15px rgba(128, 90, 213, 0.2); }
            50% { box-shadow: 0 0 30px rgba(128, 90, 213, 0.4); }
            100% { box-shadow: 0 0 15px rgba(128, 90, 213, 0.2); }
        }

        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Styling for Neon Border */
        .neon-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 0.75rem; /* Matches rounded-xl */
            border: 2px solid transparent;
            transition: all 0.5s ease-out;
            pointer-events: none;
        }

        .group:hover .neon-border::before {
            border-color: var(--color-primary-400);
            box-shadow: 0 0 10px var(--color-primary-400), 0 0 15px var(--color-primary-400);
        }
    </style>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-30 animate-[pulse-glow_4s_infinite] transition-opacity duration-300"></div>
        <div class="container mx-auto relative z-10">
            <header class="text-center mb-12">
                <h1 class="font-heading font-extrabold text-5xl md:text-6xl mb-4 animate-[fade-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0s;">
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-400] bg-clip-text text-transparent">SylvieVerse Auctions</span>
                </h1>
                <p class="font-body text-[--color-text-300] text-xl max-w-3xl mx-auto animate-[fade-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.1s;">
                    Dive into the cyberpunk marketplace. Bid on rare digital collectibles in **real-time**. Time is ticking—don't miss out!
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-[--color-primary-500] to-transparent mx-auto mt-6"></div>
            </header>

            <div class="sticky top-0 z-20 bg-[--color-background-900]/70 backdrop-blur-sm pt-4 pb-6 transition-all duration-300 border-b border-[--color-background-700]">
                <form class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 animate-[fade-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.2s;">
                    <select name="category_id" onchange="this.form.submit()" class="bg-[--color-background-700] border border-[--color-primary-700]/50 text-[--color-text-50] font-body py-2 px-4 rounded-lg focus:ring-2 focus:ring-[--color-primary-500] transition-all duration-300 shadow-inner">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select name="sort" onchange="this.form.submit()" class="bg-[--color-background-700] border border-[--color-primary-700]/50 text-[--color-text-50] font-body py-2 px-4 rounded-lg focus:ring-2 focus:ring-[--color-primary-500] transition-all duration-300 shadow-inner">
                        <option value="">Sort By: Newest</option>
                        <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>Ending Soon</option>
                        <option value="highest_bid" {{ request('sort') == 'highest_bid' ? 'selected' : '' }}>Highest Bid</option>
                    </select>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 pt-4">
                @forelse ($auctions as $auction)
                    <div class="group relative bg-[--color-background-800]/70 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-background-700] shadow-xl shadow-[--color-primary-900]/10 transition-all duration-500 hover:shadow-[--color-primary-500]/30 hover:-translate-y-1 hover:scale-[1.02] animate-[fade-in-up_0.5s_ease-out_forwards] opacity-0 neon-border" style="animation-delay: {{ 0.3 + $loop->index * 0.1 }}s;">
                        
                        <div class="overflow-hidden">
                            <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placeholder.co/400x300' }}" alt="{{ $auction->product->name }}" class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105 group-hover:brightness-110">
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-heading font-bold text-xl text-[--color-text-50] line-clamp-1 group-hover:text-[--color-primary-400] transition-colors duration-300">{{ $auction->product->name }}</h3>
                                @if ($auction->is_new)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-[--color-accent-400]/20 text-[--color-accent-400]">NEW</span>
                                @endif
                            </div>

                            <div class="flex flex-col sm:flex-row justify-between text-[--color-text-400] font-body text-sm mb-4">
                                <span class="truncate">By: {{ $auction->seller->name }}</span>
                                <span class="font-bold text-[--color-accent-400] animate-pulse" data-timer="{{ $auction->planned_end_time->timestamp }}" data-auction-id="{{ $auction->id }}">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="countdown">Calculating...</span>
                                </span>
                            </div>

                            <div class="flex items-center justify-between mb-5 border-t border-[--color-background-700] pt-4">
                                <div>
                                    <p class="font-body text-[--color-text-300] text-sm">Current Bid</p>
                                    <p class="font-heading font-extrabold text-2xl text-[--color-primary-400] transition-colors duration-300">${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-body text-[--color-text-300] text-sm">Total Bids</p>
                                    <p class="font-heading font-extrabold text-2xl text-[--color-text-50]">{{ $auction->bid_count }}</p>
                                </div>
                            </div>

                            <a href="{{ route('auctions.show', $auction) }}" class="block bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-700] hover:to-[--color-primary-600] text-[--color-text-50] font-heading font-bold text-lg py-3 rounded-lg transition-all duration-300 shadow-lg shadow-[--color-primary-500]/30 hover:shadow-xl hover:shadow-[--color-primary-500]/50 text-center uppercase tracking-wider">
                                Place Bid
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-[--color-text-300] font-body text-xl col-span-full py-12">
                        <svg class="w-12 h-12 text-[--color-text-400] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        No active auctions found. The market is quiet, check back soon!
                    </p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $auctions->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const timers = document.querySelectorAll('[data-timer]');
            timers.forEach(timer => {
                const endTime = parseInt(timer.dataset.timer) * 1000; // Convert to milliseconds
                const countdownElement = timer.querySelector('.countdown');

                function updateTimer() {
                    const now = new Date().getTime();
                    const timeLeft = endTime - now;

                    if (timeLeft <= 0) {
                        countdownElement.textContent = 'Ended';
                        timer.classList.remove('animate-pulse'); // Stop pulsing when ended
                        return;
                    }

                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                    // Conditional formatting to make it look cleaner
                    let timeString = '';
                    if (days > 0) timeString += `${days}d `;
                    if (days > 0 || hours > 0) timeString += `${hours}h `;
                    timeString += `${minutes}m ${seconds}s`;

                    countdownElement.textContent = timeString.trim();
                }

                updateTimer();
                setInterval(updateTimer, 1000);
            });
        });
    </script>
</x-app-layout>