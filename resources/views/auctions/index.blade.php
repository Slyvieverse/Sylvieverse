<x-app-layout>
    <style>
        /* 🚀 Enhanced Neon & 4K-Style Color Palette */
        :root {
            /* Primary Colors - Deep Violet/Electric Purple */
            --color-primary-400: #7E57C2; /* Lighter Purple */
            --color-primary-500: #673AB7; /* Main Purple */
            --color-primary-600: #512DA8; /* Deeper Purple */
            --color-primary-700: #311B92; /* Darkest Purple */
            --color-accent-purple: #7E57C2; /* Mapping for gradient use */
            --color-accent-pink: #EC407A; /* Added for gradient visual */

            /* ✨ NEW Accent Colors - Light Neon Blue/Aqua Glow */
            --color-accent-500: #00BCD4; /* Main Neon Blue */
            --color-accent-400: #4DD0E1; /* Lighter Blue */
            --color-accent-600: #0097A7; /* Deeper Blue */

            /* Backgrounds - Dark Technical Palette */
            --color-background-700: #1C1917; /* Slate Black */
            --color-background-800: #100C09; /* Near Black */
            --color-background-900: #0D0A08; /* Abyss Black */
            --color-bg-main: var(--color-background-900);
            --color-bg-filter: var(--color-background-700);
            --color-bg-card: var(--color-background-700);
            --color-border-card: var(--color-primary-700);

            /* Text - Bright and Technical */
            --color-text-50: #EFEFEF; /* Bright White/Neon */
            --color-text-200: #A0AEC0; /* Slate Gray */
            --color-text-300: #718096; /* Darker Gray */
            --color-text-primary: var(--color-text-50);
            --color-text-secondary: var(--color-text-200);

            /* Status Colors */
            --color-status-live: #00BCD4; /* Accent Blue */
            --color-status-ending: #FF5252; /* Neon Red */

            /* Neon Glow Shadows (for 3D effect) */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
            --color-shadow-card: rgba(126, 87, 194, 0.4);

            /* Typography */
            --font-heading: 'Exo 2', sans-serif;
        }

        /* 🌙 Dark Mode Adjustments (Original dark mode colors) */
        .dark {
            --color-background-700: #0D0A08;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
            --color-bg-main: var(--color-background-900);
            --color-bg-filter: var(--color-background-700);
            --color-bg-card: var(--color-background-700);
            --color-border-card: var(--color-primary-700);
        }

        /* ☀️ Light Mode Adjustments */
        .light {
            --color-background-900: #F7FAFC; /* Near White */
            --color-background-800: #FFFFFF; /* White */
            --color-background-700: #EDF2F7; /* Light Gray */
            --color-bg-main: var(--color-background-900);
            --color-bg-filter: var(--color-background-800);
            --color-bg-card: var(--color-background-800);
            --color-border-card: #CBD5E0; /* Light border */
            --color-primary-500: #5E35B1; /* Main Purple */
            --color-accent-500: #0097A7;
            --color-text-50: #1A202C; /* Darkest Text */
            --color-text-secondary: #4A5568;
            --color-text-primary: var(--color-text-50);
            --color-status-live: #4CAF50; /* Green */
            --color-status-ending: #E65100; /* Orange */
            --shadow-primary-glow: 0 4px 10px rgba(94, 53, 177, 0.2);
            --shadow-accent-glow: 0 4px 10px rgba(0, 188, 212, 0.2);
            --color-shadow-card: rgba(0, 0, 0, 0.1);
        }

        /* 3D and Animation Utilities */

        /* Custom radial gradient background for the glow effect */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%);
        }

        /* Complex background for the hero section, simulating a 3D field */
        .hero-bg-tech {
            background-image: linear-gradient(0deg, var(--color-background-800) 50%, transparent 100%),
                                repeating-linear-gradient(0deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px),
                                repeating-linear-gradient(90deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px);
            background-size: 100% 100%, 100% 100%, 100% 100%;
            perspective: 1000px; /* Setup for 3D transforms */
        }

        /* Utility class for neon/light mode text */
        .text-glow-accent {
            text-shadow: 0 0 8px var(--color-accent-400);
        }

        /* Gradient Text utility */
        .gradient-text-header {
            background-image: linear-gradient(to right, var(--color-primary-400), var(--color-accent-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 15px var(--color-primary-400);
        }

        .gradient-text-bid {
            background-image: linear-gradient(to top, var(--color-accent-400), var(--color-accent-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 5px var(--color-accent-400);
        }

        /* Keyframes for Advanced Animations */
        @keyframes pulse-glow {
            0% { opacity: 0.1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.05); }
            100% { opacity: 0.1; transform: scale(1); }
        }
        @keyframes page-enter {
            from { opacity: 0; transform: translate3d(0, 30px, -50px) scale(0.95); }
            to { opacity: 1; transform: translate3d(0, 0, 0) scale(1); }
        }
        @keyframes ending-fever {
            0%, 100% { border-color: var(--color-status-ending); box-shadow: 0 0 10px var(--color-status-ending); }
            50% { border-color: var(--color-background-700); box-shadow: none; }
        }

        /* Card Hover 3D Tilt Effect */
        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .card-3d:hover {
            transform: scale(1.03) rotateX(2deg) rotateY(-2deg) translateZ(5px);
            box-shadow: var(--shadow-primary-glow);
        }

        /* 3D Button Style */
        .btn-3d {
            transition: all 0.2s ease-out;
            background-image: linear-gradient(to right, var(--color-accent-purple), var(--color-accent-pink));
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 0 10px rgba(126, 87, 194, 0.5); /* Soft outer glow */
        }

        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 0 20px var(--color-primary-400); /* Intense hover glow */
        }

    </style>

    <div class="min-h-screen py-10 px-3 relative overflow-hidden transition-colors duration-500"
         style="background-color: var(--color-bg-main); color: var(--color-text-primary);">

        <div class="absolute inset-0 hero-bg-tech opacity-10 dark:opacity-30"></div>
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:opacity-40 animate-[pulse-glow_8s_infinite] pointer-events-none"></div>

        <div class="container mx-auto max-w-6xl relative z-10 animate-[page-enter_0.8s_ease-out_forwards] [animation-delay:0.1s]">

            <div class="text-center mb-10">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-2" style="font-family: var(--font-heading);">
                    <span class="gradient-text-header animate-pulse">
                        LIVE AUCTIONS
                    </span>
                </h1>
                <p class="text-xl font-light" style="color: var(--color-text-secondary);">Bid now. Win forever.</p>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8 backdrop-blur-sm p-4 rounded-xl shadow-xl transition-all border"
                 style="background-color: var(--color-bg-filter); border-color: var(--color-primary-600);">

                <form method="GET" class="flex flex-wrap gap-3">
                    @php
                        $filterStyle = 'background-color: var(--color-background-800); color: var(--color-text-50); border: 1px solid var(--color-primary-700);';
                    @endphp

                    <select name="category_id" onchange="this.form.submit()"
                            class="px-4 py-2 rounded-lg text-base focus:ring-2 focus:ring-[var(--color-accent-500)] transition-all"
                            style="{{ $filterStyle }}">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sort" onchange="this.form.submit()"
                            class="px-4 py-2 rounded-lg text-base focus:ring-2 focus:ring-[var(--color-accent-500)] transition-all"
                            style="{{ $filterStyle }}">
                        <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="ending_soon" {{ request('sort') === 'ending_soon' ? 'selected' : '' }}>Ending Soon</option>
                        <option value="highest_bid" {{ request('sort') === 'highest_bid' ? 'selected' : '' }}>Highest Bid</option>
                        <option value="most_bids" {{ request('sort') === 'most_bids' ? 'selected' : '' }}>Most Bids</option>
                    </select>
                </form>

                @auth
                    <a href="{{ route('auctions.create') }}"
                       class="font-bold px-6 py-3 rounded-lg text-base shadow-xl transform hover:scale-105 transition-all duration-300 text-white btn-3d">
                        + LAUNCH AUCTION
                    </a>
                @endauth
            </div>


            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($auctions as $auction)
                    @php
                        $borderColor = $auction->status === 'completed' ? 'var(--color-status-live)' : 'var(--color-border-card)';
                        $cardAnimation = $auction->isEndingSoon(10) ? 'animate-[ending-fever_1s_infinite]' : '';
                    @endphp

                    <a href="{{ route('auctions.show', $auction) }}" class="group block relative">
                        <div class="rounded-lg overflow-hidden shadow-lg card-3d border-2 {{ $cardAnimation }}"
                             style="background-color: var(--color-bg-card); border-color: {{ $borderColor }};">

                            @if($auction->status === 'completed' && $auction->winner)
                                <div class="absolute inset-0 bg-green-500/10 dark:bg-green-900/70 z-10 pointer-events-none"></div>
                                <div class="absolute top-3 left-1/2 -translate-x-1/2 z-20 bg-green-600 text-white px-4 py-1.5 rounded-full font-bold text-xs shadow-xl animate-bounce">
                                    SOLD TO {{ Str::limit($auction->winner->name, 10) }}
                                </div>
                            @endif
                            @if($auction->status === 'expired')
                                <div class="absolute inset-0 bg-red-500/10 dark:bg-red-900/80 z-10"></div>
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 bg-black/90 text-red-400 px-4 py-2 rounded-lg font-black text-sm">
                                    NO BIDS
                                </div>
                            @endif

                            <div class="relative overflow-hidden h-48"> <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : asset('images/placeholder.jpg') }}"
                                    alt="{{ $auction->product->name }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <div class="absolute top-2 left-2 flex gap-1 z-10">
                                    <div class="text-white px-2 py-1 rounded-full text-xs font-bold flex items-center gap-1 shadow-md"
                                        style="background-color: var(--color-status-live);">
                                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                        LIVE
                                    </div>
                                    @if($auction->isEndingSoon(10))
                                        <div class="text-white px-2 py-1 rounded-full text-xs font-bold shadow-md bg-red-600">
                                            FEVER
                                        </div>
                                    @endif
                                </div>

                                <div class="absolute top-2 right-2 bg-black/70 text-white px-3 py-1.5 rounded-lg font-mono text-sm font-bold transition-colors duration-300"
                                    style="border: 1px solid var(--color-accent-purple); color: white;">
                                    <span class="countdown" data-end="{{ $auction->planned_end_time->timestamp }}">{{ $auction->planned_end_time->timestamp }}...</span>
                                </div>
                            </div>

                            <div class="p-4 space-y-3"> <h3 class="font-bold text-lg line-clamp-2" style="color: var(--color-text-primary);">
                                    {{ $auction->product->name }}
                                </h3>

                                <div class="flex justify-between text-xs" style="color: var(--color-text-secondary);">
                                    <span class="font-medium">by {{ $auction->seller->name }}</span>
                                    <span class="font-bold">{{ $auction->bid_count }} bids</span>
                                </div>

                                <div class="flex items-end justify-between pt-1">
                                    <div>
                                        <p style="color: var(--color-text-secondary);" class="text-xs font-medium uppercase">Current Bid</p>
                                        <p class="text-2xl font-black gradient-text-bid">
                                            ${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}
                                        </p>
                                    </div>
                                    <div class="px-4 py-2 rounded-lg font-bold text-sm shadow-lg transform group-hover:scale-110 transition-all duration-300 text-white btn-3d"
                                         style="background-image: linear-gradient(to right, var(--color-primary-500), var(--color-accent-500));">
                                        BID
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16 border-2 border-dashed rounded-lg"
                         style="border-color: var(--color-primary-700); background-color: var(--color-bg-card);">
                        <div class="text-5xl mb-4 opacity-30" style="color: var(--color-text-primary);">No Active Auctions</div>
                        <p class="text-xl mb-8" style="color: var(--color-text-secondary);">Be the first to create one!</p>
                        @auth
                            <a href="{{ route('auctions.create') }}"
                               class="inline-block font-black text-lg px-8 py-4 rounded-lg shadow-xl transform hover:scale-105 transition-all duration-500 text-white btn-3d">
                                LAUNCH YOUR AUCTION
                            </a>
                        @endauth
                    </div>
                @endforelse
            </div>

            @if($auctions->hasPages())
                <div class="mt-10 flex justify-center">
                    <div class="backdrop-blur-sm rounded-lg p-1"
                         style="background-color: var(--color-bg-filter); border: 1px solid var(--color-border-card);">
                        {{ $auctions->appends(request()->query())->links('partials.pagination') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countdowns = document.querySelectorAll('.countdown');
            console.log(countdowns);
            const update = () => {
                countdowns.forEach(el => {
                    const end = parseInt(el.dataset.end) * 1000;
                    const diff = end - Date.now();
                    const countdownContainer = el.closest('div');
                    console.log(end, diff)
                    if (diff <= 0) {
                        el.textContent = 'ENDED';
                        countdownContainer.style.backgroundColor = 'var(--color-primary-500)'; // Changed to primary color when ended
                        countdownContainer.style.border = '1px solid var(--color-primary-500)';
                        el.style.color = 'white';
                        return;
                    }

                    const d = Math.floor(diff / 86400000);
                    const h = Math.floor((diff % 86400000) / 3600000);
                    const m = Math.floor((diff % 3600000) / 60000);
                    const s = Math.floor((diff % 60000) / 1000);

                    const format = (v) => v.toString().padStart(2, '0');

                    let text = '';
                    if (d > 0) {
                        text += `${d}d ${format(h)}h`;
                    } else if (h > 0) {
                        text += `${format(h)}h ${format(m)}m`;
                    } else {
                        text += `${format(m)}m ${format(s)}s`;
                    }

                    el.textContent = text;

                    // Apply visual fever effect near the end
                    if (diff < 600000) { // Less than 10 minutes
                        el.style.color = 'var(--color-status-ending)';
                        countdownContainer.style.border = '2px solid var(--color-status-ending)';
                    } else {
                        el.style.color = 'white';
                        countdownContainer.style.border = '1px solid var(--color-accent-purple)';
                    }
                });
            };

            update();
            setInterval(update, 1000);
        });
    </script>
</x-app-layout>
