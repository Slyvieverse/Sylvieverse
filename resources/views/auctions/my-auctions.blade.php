<x-app-layout>
    <style>
        /*
        |--------------------------------------------------------------------------
        | Theme-Aware CSS Variables
        |--------------------------------------------------------------------------
        */

        :root {
            /* Light Mode Colors */
            --color-bg-main: #fcfcfc;
            --color-bg-card: #ffffff;
            --color-bg-card-hover: #f9fafb;
            --color-border: #e5e7eb;
            --color-text-title: #1f2937;
            --color-text-muted: #6b7280;
            --color-accent-purple: #9F7AEA; /* Your purple */
            --color-accent-pink: #F687B3; /* Your pink */
            --color-shadow: rgba(0, 0, 0, 0.05);

            /* Status Colors (Light Mode) */
            --status-sold: #059669; /* Green */
            --status-live: #DC2626; /* Red */
            --status-ended: #9CA3AF; /* Gray */
        }

        .dark {
            /* Dark Mode Overrides (Your original aesthetic) */
            --color-bg-main: #0a0a0e;
            --color-bg-card: #1e1e2f;
            --color-bg-card-hover: #161625;
            --color-border: #374151;
            --color-text-title: #f5f5f7;
            --color-text-muted: #9ca3af;
            --color-accent-purple: #a78bfa; /* Lighter for dark contrast */
            --color-accent-pink: #f472b6; /* Lighter for dark contrast */
            --color-shadow: rgba(159, 122, 234, 0.1);

            /* Status Colors (Dark Mode) */
            --status-sold: #34d399; /* Light Green */
            --status-live: #f87171; /* Light Red */
            --status-ended: #6b7280; /* Muted Gray */
        }

        /* Custom Styles (Theme-Aware) */
        .card-glow-border {
            border: 2px solid transparent;
            background-clip: padding-box, border-box;
            background-origin: padding-box, border-box;
            background-image: linear-gradient(to bottom right, var(--color-bg-card), var(--color-bg-card)),
                              linear-gradient(to bottom right, var(--color-accent-purple) 20%, var(--color-accent-pink) 80%);
        }

        .card-glow-border:hover {
            border: 2px solid transparent; /* Ensure border is drawn by background-image, not default CSS */
            box-shadow: 0 0 15px var(--color-shadow), 0 0 40px var(--color-accent-purple, 0.4); /* Stronger glow */
            transform: translateY(-3px) scale(1.01);
        }

        /* Status Badge Gradients (Using your original, theme-independent approach for badges) */
        .status-badge {
            font-weight: bold;
            color: var(--color-bg-main); /* Ensure text contrasts with badge gradient */
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        .status-sold-gradient { background: linear-gradient(135deg, #10B981, #059669); }
        .status-live-gradient { background: linear-gradient(135deg, #F97316, #EA580C); animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .status-ended-gradient { background: linear-gradient(135deg, #6B7280, #4B5563); }
        .status-win-gradient { background: linear-gradient(135deg, #34d399, #065f46); }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>

    <div class="min-h-screen py-16 px-4 sm:px-6 lg:px-8"
         style="background-color: var(--color-bg-main); color: var(--color-text-title);">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-7xl font-black tracking-tighter"
                    style="background-image: linear-gradient(to right, var(--color-accent-purple), var(--color-accent-pink)); background-clip: text; color: transparent;">
                    MY AUCTIONS
                </h1>
                <p class="text-xl mt-4" style="color: var(--color-text-muted);">Your listings • Your wins • Your progress</p>
            </div>

            <div class="mb-10 flex flex-wrap justify-center gap-4">
                @php
                    $filters = ['all', 'active', 'sold', 'won'];
                    $currentFilter = request('filter', 'all');
                @endphp
                @foreach($filters as $filter)
                    @php
                        $isActive = $currentFilter === $filter;
                    @endphp
                    <a href="{{ route('auctions.my', ['filter' => $filter]) }}"
                       class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300
                              {{ $isActive ? 'text-white shadow-lg' : 'bg-[var(--color-bg-card-hover)] text-[var(--color-text-title)] hover:text-[var(--color-accent-purple)]' }}"
                       style="{{ $isActive ? 'background: linear-gradient(to right, var(--color-accent-purple), var(--color-accent-pink));' : 'border: 1px solid var(--color-border);' }}">
                        {{ strtoupper($filter) }}
                    </a>
                @endforeach
            </div>

            @if($auctions->isEmpty())
                <div class="text-center py-24 bg-[var(--color-bg-card)] rounded-2xl border-2 border-dashed border-[var(--color-border)]">
                    <svg class="w-16 h-16 mx-auto mb-6" style="color: var(--color-accent-purple);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-3xl font-bold mb-8" style="color: var(--color-text-title);">No {{ $currentFilter }} auctions found.</div>
                    <a href="{{ route('auctions.create') }}"
                       class="inline-block px-12 py-4 rounded-xl text-lg font-bold transition transform hover:scale-[1.05]"
                       style="color: var(--color-text-title); background: linear-gradient(to right, var(--color-accent-purple), var(--color-accent-pink)); color: white; box-shadow: 0 10px 15px var(--color-shadow);">
                        CREATE YOUR FIRST AUCTION
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($auctions as $auction)
                        @php
                            $statusClass = '';
                            $statusText = '';
                            if ($auction->status === 'completed') {
                                if ($auction->winner_id === Auth::id()) {
                                    $statusClass = 'status-win-gradient';
                                    $statusText = 'YOU WON';
                                } else {
                                    $statusClass = 'status-sold-gradient';
                                    $statusText = 'SOLD';
                                }
                            } elseif ($auction->status === 'active') {
                                $statusClass = 'status-live-gradient';
                                $statusText = 'LIVE';
                            } else {
                                $statusClass = 'status-ended-gradient';
                                $statusText = 'ENDED';
                            }
                        @endphp

                        <div class="bg-[var(--color-bg-card)] rounded-xl overflow-hidden shadow-xl card-glow-border transition-all duration-500">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : asset('images/placeholder.jpg') }}"
                                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">

                                <div class="absolute top-4 left-4 px-4 py-1.5 rounded-full text-xs status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </div>

                                @if($auction->status === 'active')
                                    <div class="absolute bottom-4 right-4 bg-black/80 text-white px-4 py-2 rounded-lg text-sm font-mono tracking-wider">
                                        <span class="countdown" data-end="{{ $auction->planned_end_time->timestamp }}"></span>
                                    </div>
                                @elseif($auction->winner)
                                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-green-600/90 backdrop-blur-sm text-white px-6 py-2 rounded-full font-bold text-lg">
                                        ${{ number_format($auction->current_bid, 2) }}
                                    </div>
                                @endif
                            </div>

                            <div class="p-6 space-y-3">
                                <h3 class="text-xl font-extrabold line-clamp-2" style="color: var(--color-accent-purple);">
                                    {{ Str::limit($auction->product->name, 40) }}
                                </h3>

                                <div class="flex justify-between text-sm pt-1" style="color: var(--color-text-muted);">
                                    <span class="font-medium">Bids: <span style="color: var(--color-text-title);">{{ $auction->bid_count }}</span></span>
                                    <span class="font-medium">Current: <span style="color: var(--color-text-title);">${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}</span></span>
                                </div>

                                <div class="flex gap-3 pt-4">
                                    <a href="{{ route('auctions.show', $auction) }}"
                                       class="flex-1 text-center py-3 rounded-xl font-bold transition bg-[var(--color-bg-card-hover)] hover:bg-[var(--color-accent-purple)] hover:text-white"
                                       style="color: var(--color-text-title); border: 1px solid var(--color-border);">
                                        VIEW
                                    </a>

                                    @if($auction->seller_id === Auth::id() && $auction->status === 'active')
                                        <button onclick="document.getElementById('delete-form-{{ $auction->id }}').submit()"
                                                class="px-6 py-3 rounded-xl font-bold transition bg-red-600/10 text-red-500 hover:bg-red-600 hover:text-white">
                                            END
                                        </button>
                                        <form id="delete-form-{{ $auction->id }}" action="{{ route('auctions.destroy', $auction) }}" method="POST" class="hidden">
                                            @csrf @method('DELETE')
                                        </form>
                                    @endif

                                    @if($auction->winner_id === Auth::id() && $auction->status === 'completed' && !$auction->order()->exists())
                                        <a href="{{ route('auction.pay', $auction) }}"
                                           class="px-8 py-3 rounded-xl font-bold animate-pulse text-white shadow-lg hover:shadow-xl"
                                           style="background: linear-gradient(to right, #10B981, #059669);">
                                            PAY NOW
                                        </a>
                                    @elseif($auction->winner_id === Auth::id() && $auction->order()->exists())
                                        <div class="px-8 py-3 rounded-xl font-bold text-white bg-green-600/70">
                                            PAID
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $auctions->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Real-time countdown
        setInterval(() => {
            document.querySelectorAll('.countdown').forEach(el => {
                const end = parseInt(el.dataset.end) * 1000;
                const diff = end - Date.now();
                if (diff <= 0) return el.textContent = 'ENDED';

                const totalSeconds = Math.floor(diff / 1000);
                const d = Math.floor(totalSeconds / (3600 * 24));
                const h = Math.floor((totalSeconds % (3600 * 24)) / 3600);
                const m = Math.floor((totalSeconds % 3600) / 60);
                const s = Math.floor(totalSeconds % 60);

                const formatTime = (value) => value.toString().padStart(2, '0');

                // Check if days are present, otherwise show only H/M/S
                if (d > 0) {
                    el.textContent = `${d}d ${formatTime(h)}h ${formatTime(m)}m`;
                } else {
                    el.textContent = `${formatTime(h)}h ${formatTime(m)}m ${formatTime(s)}s`;
                }
            });
        }, 1000);
    </script>
</x-app-layout>
