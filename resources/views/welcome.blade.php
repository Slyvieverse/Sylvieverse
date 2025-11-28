{{-- resources/views/welcome.blade.php --}}
<x-app-layout>
    <style>
        :root {
            --color-primary-400: #7E57C2;
            --color-primary-500: #673AB7;
            --color-primary-600: #512DA8;
            --color-primary-700: #311B92;
            --color-accent-500: #00BCD4;
            --color-accent-400: #4DD0E1;
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0D0A08;
            --color-text-50: #EFEFEF;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 0 15px #7E57C2, 0 0 35px #9373D2;
            --shadow-accent-glow: 0 0 10px #00BCD4, 0 0 20px #4DD0E1;
            --font-heading: 'Exo 2', sans-serif;
        }

        .dark {
            --color-primary-400: #9373D2;
            --color-primary-500: #7E57C2;
            --color-background-900: #0A0807;
            --color-text-50: #F0F0F0;
        }

        .light {
            --color-background-900: #F7FAFC;
            --color-background-800: #FFFFFF;
            --color-background-700: #EDF2F7;
            --color-primary-500: #5E35B1;
            --color-accent-500: #0097A7;
            --color-text-50: #1A202C;
            --color-text-200: #4A5568;
            --shadow-primary-glow: 0 4px 15px rgba(94,53,177,.25);
        }

        .bg-radial-gradient-primary { background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%); }
        .text-glow-accent { text-shadow: 0 0 10px var(--color-accent-400); }

        @keyframes pulse-glow { 0%,100%{opacity:.1} 50%{opacity:.35; transform:scale(1.05)} }
        @keyframes page-enter { from{opacity:0; transform:translate3d(0,30px,-50px) scale(.95)} to{opacity:1; transform:none} }
        @keyframes rotate-3d-visual { to { transform: rotateY(360deg) rotateX(360deg) } }

        .card-3d { transform-style: preserve-3d; transition: all .4s cubic-bezier(.165,.84,.44,1); }
        .card-3d:hover { transform: scale(1.03) rotateX(2deg) rotateY(-2deg) translateZ(10px); box-shadow: var(--shadow-primary-glow); }

        .btn-3d {
            transition: all .25s ease;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,.1), inset 0 1px 0 rgba(255,255,255,.1), 0 0 12px rgba(126,87,194,.4);
        }
        .btn-3d:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -5px rgba(0,0,0,.4), 0 0 25px var(--color-primary-400);
        }
    </style>

    <script>
        // Theme toggle (dark/light)
        const stored = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (stored === 'dark' || (!stored && prefersDark)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            document.documentElement.classList.toggle('light');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[var(--color-background-900)] text-[var(--color-text-50)]" style="font-family:var(--font-heading)">
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite]"></div>

        <main class="container mx-auto px-6 py-16 md:py-24 relative z-10">

            <!-- Theme Toggle -->
            <button onclick="toggleTheme()" class="fixed top-8 right-6 z-50 p-3 rounded-full bg-[var(--color-background-800)] border border-[var(--color-primary-700)] hover:border-[var(--color-accent-500)] btn-3d">
                <svg class="h-6 w-6 block dark:block light:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <svg class="h-6 w-6 hidden dark:hidden light:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>

            <!-- Hero -->
            <div class="text-center mb-20 md:mb-32">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6">
                    Welcome to <span class="inline-block relative">
                        <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent" style="text-shadow:0 0 20px var(--color-accent-500)">SylvieVerse</span>
                        <span class="absolute inset-0 text-[var(--color-primary-700)] opacity-30 -translate-x-1 -translate-y-1">SylvieVerse</span>
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-12 max-w-4xl mx-auto">
                    The <strong>Neon Frontier</strong> of Manhwa & Manga Auctions.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ route('catalog') }}" class="btn-3d px-10 py-4 rounded-xl bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-primary-500)] text-white font-bold text-xl">Browse Marketplace</a>
                    <a href="{{ route('auctions.index') }}" class="btn-3d px-10 py-4 rounded-xl bg-[var(--color-background-700)] border border-[var(--color-accent-500]/50 text-[var(--color-accent-400)] font-bold text-xl">Join the Auction</a>
                </div>
            </div>

            <!-- Live Activity + 3D Preview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-20">
                <div class="lg:col-span-2 h-96 bg-[var(--color-background-800)] rounded-2xl border border-[var(--color-primary-600)]/50 shadow-2xl flex items-center justify-center relative overflow-hidden">
                    <h2 class="absolute top-6 left-8 text-2xl font-bold z-10">3D Asset Projection</h2>
                    <div class="w-64 h-64 bg-gradient-to-br from-[var(--color-primary-400)] to-[var(--color-accent-500)] rounded-3xl shadow-2xl animate-[rotate-3d-visual_20s_linear_infinite]" style="transform-style:preserve-3d; transform:rotateY(30deg) rotateX(15deg)"></div>
                </div>

                <!-- Live Activity Feed (REAL DATA) -->
                <div class="bg-[var(--color-background-800)] rounded-2xl border border-[var(--color-accent-600)]/50 shadow-xl overflow-hidden">
                    <h3 class="p-4 bg-[var(--color-accent-500)]/20 font-bold text-lg text-[var(--color-accent-400)] border-b border-[var(--color-accent-600)]">Live Activity</h3>
                    <ul class="h-80 overflow-y-auto divide-y divide-[var(--color-primary-700)]/30">
                        @forelse($recentActivity as $act)
                            <li class="p-4 hover:bg-white/5 transition">
                                <span class="text-xs text-[var(--color-text-300)]">{{ $act['time'] }}</span>
                                <p class="text-sm">
                                    <strong class="text-[var(--color-primary-400)]">{{ $act['user'] }}</strong>
                                    {{ $act['action'] }}
                                    <strong class="text-white">{{ $act['product'] }}</strong>
                                    <span class="text-[var(--color-accent-500)] font-bold">{{ $act['amount'] }}</span>
                                </p>
                            </li>
                        @empty
                            <li class="p-8 text-center text-[var(--color-text-300)]">No activity yet — be the first!</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Featured Auctions (REAL DATA) -->
            <section class="mb-20">
                <h2 class="text-4xl font-bold text-center mb-12 text-glow-accent">Featured Auctions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($featuredAuctions as $auction)
                        <div class="card-3d bg-[var(--color-background-800)]/80 backdrop-blur rounded-2xl overflow-hidden border border-[var(--color-primary-700)]/40">
                            <div class="relative h-64">
                                <img src="{{ $auction->product->image_url ? asset('storage/'.$auction->product->image_url) : asset('images/placeholder.jpg') }}"
                                     class="w-full h-full object-cover transition-transform duration-1000 hover:scale-110" alt="{{ $auction->product->name }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute top-4 left-4 bg-black/50 backdrop-blur px-4 py-2 rounded-lg border border-white/20">
                                    <p class="text-2xl font-bold text-white">{{ number_format($auction->current_bid ?? $auction->starting_price, 2) }} ETH</p>
                                    <p class="text-xs text-white/70">{{ $auction->bids_count ?? 0 }} bids</p>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 line-clamp-1">{{ $auction->product->name }}</h3>
                                <p class="text-[var(--color-text-300)] text-sm mb-4 line-clamp-2">{{ $auction->product->description }}</p>
                                <a href="{{ route('auctions.show', $auction) }}" class="block w-full text-center py-3 rounded-lg btn-3d bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-accent-500)] text-white font-bold">
                                    PLACE BID
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-20 text-3xl text-[var(--color-text-300)]">
                            No auctions live yet — check back soon!
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- Community Counter -->
            <div class="text-center py-16 border-t border-[var(--color-primary-700)]/30">
                <p class="text-2xl mb-6">Join our growing community</p>
                <div class="flex justify-center items-center gap-6">
                    <div class="flex -space-x-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 border-4 border-[var(--color-background-900)]"></div>
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-cyan-500 to-blue-500 border-4 border-[var(--color-background-900)]"></div>
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-green-500 to-teal-500 border-4 border-[var(--color-background-900)]"></div>
                    </div>
                    <span class="text-3xl font-bold text-glow-accent">{{ number_format($totalCollectors ?? 0) }}+ Collectors</span>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>