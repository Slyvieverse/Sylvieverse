<x-app-layout>
    <style>
        /* 🚀 CORE NEON & 4K-STYLE COLOR PALETTE (UNCHANGED) */
        :root {
            --color-primary-400: #7E57C2; /* Purple/Violet */
            --color-primary-500: #673AB7;
            --color-primary-600: #512DA8;
            --color-primary-700: #311B92;
            --color-accent-500: #00BCD4; /* Cyan/Aqua */
            --color-accent-400: #4DD0E1;
            --color-accent-600: #0097A7;
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0D0A08; /* Deepest background */
            --color-text-50: #EFEFEF;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 0 10px var(--color-primary-500), 0 0 25px var(--color-primary-400); /* Reduced intensity */
            --shadow-accent-glow: 0 0 8px var(--color-accent-500), 0 0 15px var(--color-accent-400); /* Reduced intensity */
            --font-heading: 'Exo 2', sans-serif;
        }

        /* Dark/Light Mode Variables */
        .dark {
            --color-background-900: #0D0A08;
            --color-background-800: #100C09;
            --color-background-700: #1C1917;
        }
        .light {
            --color-background-900: #F7FAFC;
            --color-background-800: #FFFFFF;
            --color-background-700: #EDF2F7;
            --color-text-50: #1A202C;
            --shadow-primary-glow: 0 4px 10px rgba(94, 53, 177, 0.2);
            --shadow-accent-glow: 0 4px 10px rgba(0, 188, 212, 0.2);
        }

        /* ------------------ */
        /* 🎨 ENHANCED CUSTOM STYLES (Scaled Down) */
        /* ------------------ */

        /* Enhanced Background Grid */
        .hero-bg-tech {
            background-image: linear-gradient(0deg, var(--color-background-800) 50%, transparent 100%),
                              repeating-linear-gradient(0deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px),
                              repeating-linear-gradient(90deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px);
            background-size: 100% 100%, 100% 100%, 100% 100%;
            perspective: 1000px;
        }

        /* Text Glow */
        .text-glow-accent {
            text-shadow: 0 0 8px var(--color-accent-400), 0 0 12px var(--color-accent-500); /* Reduced intensity */
        }

        .text-glow-primary {
            text-shadow: 0 0 8px var(--color-primary-400), 0 0 12px var(--color-primary-500); /* Reduced intensity */
        }

        /* Card Hover 3D Tilt Effect */
        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 0 5px rgba(126, 87, 194, 0.1);
        }

        .card-3d:hover {
            transform: scale(1.02) rotateX(0.5deg) rotateY(-0.5deg) translateZ(5px); /* Reduced tilt/scale */
            box-shadow: var(--shadow-primary-glow);
            z-index: 10;
        }

        /* 3D Button Style - Reduced Lift */
        .btn-3d {
            transition: all 0.3s ease-out;
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.15),
                0 3px 6px rgba(0, 0, 0, 0.4), /* Subtler outer shadow */
                0 0 8px rgba(0, 188, 212, 0.2); 
        }

        .light .btn-3d {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-3d:hover {
            transform: translateY(-2px); /* Reduced vertical lift */
            box-shadow:
                0 10px 15px -3px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                0 0 20px var(--color-primary-400); 
        }

        /* Gradient Border Animation - Smaller radius/padding */
        .gradient-border {
            position: relative;
            background: var(--color-background-800);
            border-radius: 1.5rem; /* Smaller radius */
            padding: 1px;
            overflow: visible;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: -1px; 
            left: -1px;
            right: -1px;
            bottom: -1px;
            border-radius: 1.5rem; /* Smaller radius */
            background: linear-gradient(45deg, var(--color-primary-500), var(--color-accent-500), var(--color-primary-500));
            background-size: 200% 200%;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            animation: border-rotate 5s linear infinite;
            z-index: -1;
            opacity: 0.7;
            filter: drop-shadow(0 0 4px var(--color-primary-400));
        }

        @keyframes border-rotate {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        /* Entrance Animation */
        @keyframes page-enter {
            from {
                opacity: 0;
                transform: translate3d(0, 15px, 0); /* Reduced lift */
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
    </style>

    <script>
        // Theme initialization and toggling (unchanged)
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans text-sm" style="font-family: var(--font-heading);">

        <div class="absolute inset-0 bg-radial-gradient-primary opacity-10 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <div class="container mx-auto px-4 sm:px-6 py-8 lg:py-12 relative z-10">

            <div class="flex justify-between items-center mb-10 lg:mb-12" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
                <a href="{{ route('catalog') }}" class="flex items-center gap-2 text-[--color-text-200] hover:text-[--color-accent-400] transition-all duration-300 font-medium btn-3d px-4 py-2 rounded-full bg-[--color-background-800]/80 backdrop-blur-md border border-[--color-primary-700]/30 hover:border-[--color-accent-500]">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Back to Catalog</span>
                </a>

                <button onclick="toggleTheme()" class="p-2 rounded-full bg-[--color-background-800]/80 border border-[--color-primary-700] hover:border-[--color-primary-400] transition-all btn-3d" title="Toggle Theme">
                    <svg class="h-5 w-5 text-[--color-text-200] block dark:block light:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-5 w-5 text-[--color-text-200] hidden dark:hidden light:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            @php $activeDiscount = $product->activeDiscount(); @endphp

            <div class="grid lg:grid-cols-2 gap-8 xl:gap-12 items-start mb-16">

                <div class="relative group" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.3s; opacity: 0;">
                    <div class="gradient-border rounded-2xl overflow-hidden">
                        <div class="bg-[--color-background-800] p-3 rounded-2xl shadow-xl shadow-black/50">
                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                 alt="{{ $product->name }}"
                                 class="w-full aspect-[4/5] object-cover transition-transform duration-700 group-hover:scale-[1.03] rounded-xl border border-[--color-background-700]">
                        </div>
                    </div>

                    <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                        <x-watchlist-button :product="$product" />
                    </div>

                    @if($activeDiscount)
                        <div class="absolute top-6 left-6 bg-gradient-to-r from-[--color-accent-600] to-[--color-accent-500] text-white px-4 py-2 rounded-full font-extrabold text-base shadow-lg shadow-[var(--color-accent-500)]/40 animate-pulse border-2 border-white/50 backdrop-blur-sm">
                            -{{ $activeDiscount->percent_off }}% OFF
                        </div>
                    @endif

                    <div class="absolute bottom-4 left-4 right-4">
                        <div class="bg-[--color-background-700]/95 backdrop-blur-lg rounded-xl p-3 border border-[--color-primary-700]/50 shadow-lg shadow-black/40">
                            <div class="flex justify-between items-center text-xs text-[--color-text-200] mb-1.5">
                                <span>Stock Availability</span>
                                <span class="text-[--color-accent-400] font-bold text-sm">{{ $product->stock_quantity }} units</span>
                            </div>
                            <div class="w-full bg-[--color-primary-700]/30 rounded-full h-2">
                                @php $stockPercentage = min(100, ($product->stock_quantity / 50) * 100); @endphp
                                <div class="bg-gradient-to-r from-[--color-accent-500] to-[--color-primary-500] h-2 rounded-full transition-all duration-1000 shadow-md shadow-[var(--color-primary-400)]/30"
                                     style="width: {{ $stockPercentage }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
                    <div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-4">
                            <span class="bg-gradient-to-r from-[--color-accent-400] to-[--color-primary-400] bg-clip-text text-transparent text-glow-primary">
                                {{ $product->name }}
                            </span>
                        </h1>
                        <p class="text-base lg:text-lg text-[--color-text-200] leading-relaxed border-l-3 border-[--color-accent-500] pl-4 py-1 bg-[--color-background-800]/50 rounded-r-lg">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-[--color-primary-700]">
                        <h2 class="text-xl text-[--color-text-50] font-semibold">Current Value</h2>
                        @if($activeDiscount)
                            <div class="flex items-baseline gap-4">
                                <span class="text-5xl font-extrabold text-[--color-accent-400] text-glow-accent">
                                    ${{ number_format($product->getDiscountedPrice(), 2) }}
                                </span>
                                <span class="text-2xl text-[--color-text-300] line-through opacity-70">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>
                            <p class="text-[--color-accent-400] font-bold text-base flex items-center gap-1">
                                💰 <span class="text-glow-accent">You save ${{ number_format($product->price - $product->getDiscountedPrice(), 2) }}!</span>
                            </p>
                        @else
                            <div class="text-5xl font-extrabold text-[--color-accent-500] text-glow-accent">
                                ${{ number_format($product->price, 2) }}
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-col sm:flex-row gap-4 items-center sm:items-start pt-4">
                        @csrf
                        <div class="relative w-full sm:w-auto">
                            <label for="quantity" class="sr-only">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                                   class="w-full sm:w-28 px-4 py-3 bg-[--color-background-800] border-2 border-[--color-primary-600] rounded-lg text-center text-xl font-bold text-[--color-text-50] focus:border-[--color-accent-500] focus:ring-2 focus:ring-[var(--color-accent-500)]/20 focus:outline-none transition-all shadow-inner shadow-black/50"
                                   placeholder="Qty">
                        </div>
                        <button type="submit" class="flex-1 w-full sm:flex-initial px-8 py-3.5 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-white text-lg font-extrabold uppercase tracking-wide transition-all duration-300 btn-3d flex items-center justify-center gap-2 disabled:opacity-50 disabled:pointer-events-none"
                                {{ $product->stock_quantity < 1 ? 'disabled' : '' }}>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            {{ $product->stock_quantity < 1 ? 'Out of Stock' : 'Add to Collection' }}
                        </button>
                    </form>

                    <div class="flex flex-wrap gap-3 pt-3 border-t border-[--color-primary-700]/50">
                        <span class="px-4 py-1.5 rounded-full bg-[--color-primary-600]/20 text-[--color-primary-400] text-sm font-semibold border border-[--color-primary-600]/50 backdrop-blur-sm shadow-md shadow-black/20">
                            ⭐ Limited Edition
                        </span>
                        <span class="px-4 py-1.5 rounded-full bg-[--color-accent-600]/20 text-[--color-accent-400] text-sm font-semibold border border-[--color-accent-600]/50 backdrop-blur-sm shadow-md shadow-black/20">
                            🔗 Blockchain Verified
                        </span>
                        <span class="px-4 py-1.5 rounded-full bg-purple-600/20 text-purple-300 text-sm font-semibold border border-purple-600/50 backdrop-blur-sm shadow-md shadow-black/20">
                            📚 {{ $product->category->name ?? 'Digital Asset' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-16">
                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700]/30 transition-all duration-500" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.7s; opacity: 0;">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] flex items-center justify-center shadow-xl shadow-[var(--color-primary-400)]/40">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-1 text-center text-[--color-text-50] text-glow-primary">Digital Format</h3>
                    <p class="text-[--color-text-200] text-center text-xs">EPUB • PDF • 4K Resolution • DRM-Free</p>
                </div>

                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700]/30 transition-all duration-500" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.9s; opacity: 0;">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-[--color-accent-600] to-[--color-accent-400] flex items-center justify-center shadow-xl shadow-[var(--color-accent-400)]/40">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-1 text-center text-[--color-text-50] text-glow-accent">Secure Ownership</h3>
                    <p class="text-[--color-text-200] text-center text-xs">NFT-backed certificate • Blockchain verified • Transferable rights</p>
                </div>

                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700]/30 transition-all duration-500" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.1s; opacity: 0;">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-purple-600 to-[--color-primary-400] flex items-center justify-center shadow-xl shadow-purple-400/40">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-1 text-center text-[--color-text-50] text-glow-primary">Creator Verified</h3>
                    <p class="text-[--color-text-200] text-center text-xs">Official release • Artist signed • Royalty supported</p>
                </div>
            </div>

            @if($relatedProducts->count())
                <div class="mt-16" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.3s; opacity: 0;">
                    <h2 class="text-3xl font-extrabold text-center mb-10">
                        <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent text-glow-primary">
                            Discover Related Assets
                        </span>
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts->take(8) as $related)
                            <a href="{{ route('catalog.show', $related) }}" class="group block">
                                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-primary-700]/30 transition-all duration-500">
                                    <div class="relative overflow-hidden">
                                        <img src="{{ $related->image_url ? asset('storage/' . $related->image_url) : asset('images/default-product.png') }}"
                                             class="w-full h-52 object-cover group-hover:scale-[1.05] transition-transform duration-500 shadow-inner shadow-black/20">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        
                                        @if($related->activeDiscount())
                                            <span class="absolute top-2 right-2 bg-[--color-accent-500] text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-lg">-{{ $related->activeDiscount()->percent_off }}%</span>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <p class="text-xs text-[--color-text-300] mb-0.5">{{ $related->category->name ?? 'Digital Asset' }}</p>
                                        <h3 class="font-extrabold text-base line-clamp-2 mb-2 group-hover:text-[--color-accent-400] transition-colors duration-300">
                                            {{ $related->name }}
                                        </h3>
                                        <p class="text-xl font-extrabold text-[--color-accent-500] text-glow-accent">
                                            ${{ number_format($related->getDiscountedPrice(), 2) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>