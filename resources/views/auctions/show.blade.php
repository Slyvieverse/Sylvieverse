<x-app-layout>
    <style>
        /* CSS Variables - Assuming a Dark Mode for the Cyberpunk Aesthetic */
        :root {
            /* Fallback/Dark Mode */
            --color-primary-400: #805AD5; /* Lavender/Purple Neon */
            --color-primary-500: #6B46C1;
            --color-primary-600: #553C9A;
            --color-primary-700: #44337A;
            --color-accent-400: #ED64A6; /* Pink Neon for emphasis (Time/Highest Bid) */
            --color-background-700: #1A202C; /* Dark Slate */
            --color-background-800: #2D3748; /* Darker Slate */
            --color-background-900: #171923; /* Deepest Background */
            --color-text-50: #E2E8F0; /* Off-White Text */
            --color-text-300: #718096; /* Gray Text */
            --color-error: #F56565; /* Red for errors */
            --color-success: #48BB78; /* Green for success */
        }

        /* Custom Keyframes */
        @keyframes pulse-neon {
            0%, 100% { box-shadow: 0 0 10px var(--color-primary-400), 0 0 20px rgba(128, 90, 213, 0.4); }
            50% { box-shadow: 0 0 15px var(--color-primary-400), 0 0 25px rgba(128, 90, 213, 0.6); }
        }

        @keyframes pulse-time {
            0%, 100% { color: var(--color-accent-400); text-shadow: 0 0 5px var(--color-accent-400); }
            50% { color: white; text-shadow: 0 0 8px var(--color-accent-400); }
        }
        
        @keyframes slide-in-up {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Neon focus/hover effect for inputs */
        .neon-input:focus {
            box-shadow: 0 0 5px var(--color-primary-400), 0 0 8px rgba(128, 90, 213, 0.5);
            border-color: var(--color-primary-400);
        }

        .bid-jumbotron {
            background: linear-gradient(135deg, var(--color-background-700) 0%, var(--color-background-800) 100%);
            border: 2px solid var(--color-primary-600);
            box-shadow: 0 0 15px var(--color-primary-400);
            animation: pulse-neon 4s infinite alternate;
        }
    </style>

    <div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-[--color-background-900] to-[--color-background-800] py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
        <div class="max-w-6xl mx-auto relative z-10">

            <header class="text-center mb-10 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0s;">
                <h1 class="font-heading font-extrabold text-4xl md:text-5xl mb-2">
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-400] bg-clip-text text-transparent">{{ $auction->product->name }}</span>
                </h1>
                <p class="font-body text-[--color-text-300] text-lg max-w-2xl mx-auto">
                    Sold by: **{{ $auction->seller->name }}** | Category: Manhwa/Manga
                </p>
                <div class="w-32 h-1 bg-gradient-to-r from-[--color-primary-500] to-transparent mx-auto mt-4"></div>
            </header>


            @if(session('success') || session('error') || $errors->any())
                <div class="max-w-4xl mx-auto mb-6 p-4 rounded-lg shadow-lg animate-[slide-in-up_0.3s_ease-out]
                    @if(session('success')) bg-[--color-success]/20 text-[--color-success] border border-[--color-success]
                    @else bg-[--color-error]/20 text-[--color-error] border border-[--color-error] @endif">
                    @if(session('success'))
                        {{ session('success') }} 
                    @elseif(session('error'))
                        {{ session('error') }}
                    @else
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.2s;">
                    <div class="bg-[--color-background-800]/70 backdrop-blur-md border border-[--color-background-700] rounded-xl p-6 shadow-xl shadow-[--color-primary-900]/10">
                        <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placeholder.co/1000x600' }}" 
                             alt="{{ $auction->product->name }}" 
                             class="w-full h-96 object-cover rounded-xl mb-6 shadow-2xl shadow-black/50 transition-all duration-500 hover:scale-[1.01] hover:shadow-[0_0_20px_var(--color-primary-400)/50]">
                        
                        <h2 class="font-heading font-bold text-2xl text-[--color-text-50] mb-3 border-b border-[--color-background-700] pb-2">Product Description</h2>
                        <p class="font-body text-[--color-text-300] leading-relaxed">{{ $auction->product->description }}</p>

                        <div class="mt-6 pt-4 border-t border-[--color-background-700] flex justify-between text-sm">
                            <span class="text-[--color-text-400]">Starting Price: <span class="text-[--color-text-50] font-semibold">${{ number_format($auction->starting_price, 2) }}</span></span>
                            <span class="text-[--color-text-400]">Inventory: <span class="text-[--color-accent-400] font-semibold">{{ $auction->product->stock_quantity }} unit(s)</span></span>
                        </div>
                    </div>

                    @if(Auth::check() && $auction->seller_id === Auth::id())
                        <div class="bg-[--color-background-800]/70 backdrop-blur-md border border-[--color-accent-400]/50 rounded-xl p-6 shadow-xl shadow-[--color-accent-400]/10">
                            <h2 class="font-heading font-bold text-2xl text-[--color-accent-400] mb-4">Seller Control Panel</h2>
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                <a href="{{ route('auctions.edit', $auction) }}" class="flex-1 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-700] hover:to-[--color-primary-600] text-[--color-text-50] font-heading font-bold py-3 rounded-lg transition-all duration-300 shadow-md shadow-[--color-primary-500]/30 hover:shadow-lg hover:shadow-[--color-primary-500]/50 text-center uppercase">
                                    <i class="fas fa-edit mr-2"></i> Update Listing
                                </a>
                                <form action="{{ route('auctions.destroy', $auction) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to delete this auction? This action is irreversible.');" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-[--color-text-50] font-heading font-bold py-3 rounded-lg transition-all duration-300 shadow-md shadow-red-500/30 hover:shadow-lg hover:shadow-red-500/50 uppercase">
                                        <i class="fas fa-trash-alt mr-2"></i> Delete Auction
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="lg:col-span-1 space-y-8 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.4s;">
                    
                    <div class="bid-jumbotron rounded-xl p-6 text-center shadow-2xl">
                        <p class="font-body text-[--color-text-300] text-lg mb-2 uppercase tracking-widest">Highest Bid</p>
                        <p class="font-heading font-extrabold text-5xl md:text-6xl text-[--color-accent-400] transition-transform duration-500 hover:scale-[1.05]">
                            ${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}
                        </p>
                        <p class="font-body text-[--color-text-50] mt-2">
                            ({{ $auction->bid_count }} total bids)
                        </p>
                    </div>

                    <div class="bg-[--color-background-800]/70 backdrop-blur-md border border-[--color-background-700] rounded-xl p-5 text-center shadow-lg">
                        <p class="font-body text-[--color-text-300] text-md mb-2 uppercase">Auction Closes In:</p>
                        <div class="font-heading font-bold text-3xl text-[--color-accent-400]" data-timer="{{ $auction->planned_end_time->timestamp }}">
                            <span class="countdown animate-pulse-time">Calculating...</span>
                        </div>
                    </div>
                    
                    @if(Auth::check() && $auction->seller_id !== Auth::id())
                        <div class="bg-[--color-background-800]/70 backdrop-blur-md border border-[--color-background-700] rounded-xl p-6 shadow-lg">
                            <h3 class="font-heading font-bold text-2xl text-[--color-primary-400] mb-4">Submit Cyber-Bid</h3>
                            <form action="{{ route('bids.store', $auction) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="amount" class="block font-body text-[--color-text-50] mb-2">
                                        Minimum Bid: ${{ number_format(($auction->current_bid ?? $auction->starting_price) + 0.01, 2) }}
                                    </label>
                                    <input 
                                        type="number" 
                                        name="amount" 
                                        id="amount"
                                        step="0.01" 
                                        min="{{ ($auction->current_bid ?? $auction->starting_price) + 0.01 }}" 
                                        class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300 placeholder-[--color-text-400]" 
                                        placeholder="Enter amount (e.g., {{ number_format(($auction->current_bid ?? $auction->starting_price) + 1, 2) }})" 
                                        required
                                    >
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-400] hover:from-[--color-primary-500] hover:to-[--color-accent-400] text-[--color-text-50] font-heading font-bold py-3 rounded-lg transition-all duration-300 shadow-lg shadow-[--color-accent-400]/30 hover:shadow-xl hover:shadow-[--color-accent-400]/50 uppercase tracking-widest">
                                    Lock In Bid
                                </button>
                            </form>
                        </div>
                    @elseif(!Auth::check())
                        <div class="bg-[--color-background-800]/70 border border-[--color-accent-400] rounded-xl p-6 text-center">
                            <p class="text-[--color-accent-400] font-body">
                                You must **Login** to participate in the auction.
                            </p>
                        </div>
                    @endif

                    <div class="bg-[--color-background-800]/70 backdrop-blur-md border border-[--color-background-700] rounded-xl p-6 shadow-lg">
                        <h3 class="font-heading font-bold text-xl text-[--color-text-50] mb-4 border-b border-[--color-background-700] pb-2">Transaction Log</h3>
                        <ul class="space-y-3 max-h-72 overflow-y-auto pr-2">
                            @forelse ($auction->bids->sortByDesc('created_at') as $bid)
                                <li class="flex justify-between items-center bg-[--color-background-700]/70 p-3 rounded-md transition-all duration-300 border-l-4 border-[--color-primary-500] hover:border-[--color-primary-400]">
                                    <div class="flex flex-col">
                                        <span class="font-body text-[--color-text-50] font-semibold">
                                            {{ $bid->bidder->name }}
                                            @if($bid->id === optional($auction->bids->sortByDesc('created_at')->first())->id)
                                                <span class="text-xs ml-2 text-[--color-accent-400]">(Highest)</span>
                                            @endif
                                        </span>
                                        <p class="text-[--color-text-400] text-xs mt-0.5">{{ $bid->created_at->diffForHumans() }}</p>
                                    </div>
                                    <span class="font-heading text-lg text-[--color-primary-400] font-bold">${{ number_format($bid->amount, 2) }}</span>
                                </li>
                            @empty
                                <p class="text-[--color-text-300] text-center p-4">The floor is open. Be the first to start the auction!</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const timerElement = document.querySelector('[data-timer]');
            if (!timerElement) return;

            const endTime = parseInt(timerElement.dataset.timer) * 1000;
            const countdownElement = timerElement.querySelector('.countdown');

            function updateTimer() {
                const now = new Date().getTime();
                const timeLeft = endTime - now;

                if (timeLeft <= 0) {
                    countdownElement.textContent = 'AUCTION ENDED';
                    timerElement.classList.remove('animate-pulse');
                    timerElement.classList.add('text-red-500'); 
                    return;
                }

                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                console.log({days, hours, minutes, seconds});
                console.log(timeLeft);
                console.log({timeLeft});
                let timeString = '';

                // Show days, then hours, then minutes/seconds
                if (days > 0) timeString += `${days}D `;
                if (days > 0 || hours > 0) timeString += `${hours.toString().padStart(2, '0')}H `;
                
                // Show minutes/seconds, making them red and bold if under 1 hour
                const minSec = `${minutes.toString().padStart(2, '0')}M ${seconds.toString().padStart(2, '0')}S`;

                if (days === 0 && hours === 0) {
                     // Add a warning class for the last hour
                    countdownElement.innerHTML = `<span class="text-red-500 animate-pulse">${minSec}</span>`;
                } else {
                    countdownElement.textContent = timeString + minSec;
                }
            }

            updateTimer();
            setInterval(updateTimer, 1000);
        });
    </script>
</x-app-layout>