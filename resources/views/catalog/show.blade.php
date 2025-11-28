{{-- resources/views/catalog/show.blade.php --}}
<x-app-layout>
    <style>
        /* 🚀 Enhanced Neon & 4K-Style Color Palette */
        :root {
            --color-primary-400: #7E57C2;
            --color-primary-500: #673AB7;
            --color-primary-600: #512DA8;
            --color-primary-700: #311B92;
            --color-accent-500: #00BCD4;
            --color-accent-400: #4DD0E1;
            --color-accent-600: #0097A7;
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0D0A08;
            --color-text-50: #EFEFEF;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
            --font-heading: 'Exo 2', sans-serif;
        }

        .dark {
            --color-primary-400: #9373D2;
            --color-primary-500: #7E57C2;
            --color-primary-600: #673AB7;
            --color-accent-500: #00BCD4;
            --color-accent-400: #4DD0E1;
            --color-background-700: #0D0A08;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
            --color-text-50: #F0F0F0;
        }

        .light {
            --color-background-900: #F7FAFC;
            --color-background-800: #FFFFFF;
            --color-background-700: #EDF2F7;
            --color-primary-500: #5E35B1;
            --color-primary-400: #7E57C2;
            --color-primary-600: #4527A0;
            --color-primary-700: #261765;
            --color-accent-500: #0097A7;
            --color-accent-400: #00BCD4;
            --color-accent-600: #006064;
            --color-text-50: #1A202C;
            --color-text-200: #4A5568;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 4px 10px rgba(94, 53, 177, 0.2);
            --shadow-accent-glow: 0 4px 10px rgba(0, 188, 212, 0.2);
        }

        /* 3D and Animation Utilities */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%);
        }

        .hero-bg-tech {
            background-image: linear-gradient(0deg, var(--color-background-800) 50%, transparent 100%),
                              repeating-linear-gradient(0deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px),
                              repeating-linear-gradient(90deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px);
            background-size: 100% 100%, 100% 100%, 100% 100%;
            perspective: 1000px;
        }

        .text-glow-accent {
            text-shadow: 0 0 8px var(--color-accent-400);
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
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -2px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 10px rgba(126, 87, 194, 0.5);
        }

        .light .btn-3d {
             box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow:
                0 10px 15px -3px rgba(0, 0, 0, 0.3),
                0 4px 6px -4px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                0 0 20px var(--color-primary-400);
        }

        /* Pulsing Glow */
        @keyframes pulse-glow {
            0% {
                opacity: 0.1;
                transform: scale(1);
            }
            50% {
                opacity: 0.35;
                transform: scale(1.05);
            }
            100% {
                opacity: 0.1;
                transform: scale(1);
            }
        }

        /* Staggered Entrance */
        @keyframes page-enter {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, -50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
            }
        }

        /* Gradient Border Animation */
        .gradient-border {
            position: relative;
            background: var(--color-background-800);
            border-radius: 1.5rem;
            padding: 1px;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(45deg, var(--color-primary-500), var(--color-accent-500), var(--color-primary-500));
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            animation: border-rotate 3s linear infinite;
        }

        @keyframes border-rotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>

    <script>
        // Theme initialization and toggling
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

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans" style="font-family: var(--font-heading);">

        <!-- Background Elements -->
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <div class="container mx-auto px-6 py-12 relative z-10">

            <!-- Header Navigation -->
            <div class="flex justify-between items-center mb-16" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
                <a href="{{ route('catalog') }}" class="flex items-center gap-3 text-[--color-text-200] hover:text-[--color-accent-500] transition-all duration-300 font-medium group btn-3d px-6 py-3 rounded-xl bg-[--color-background-800]/80 backdrop-blur-sm border border-[--color-primary-700]/30">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Catalog
                </a>

                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] dark:hover:border-[--color-accent-500] light:hover:border-[--color-accent-500] transition-all btn-3d" title="Toggle Theme">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:block light:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:hidden light:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            @php $activeDiscount = $product->activeDiscount(); @endphp

            <!-- Main Product Section -->
            <div class="grid lg:grid-cols-2 gap-16 xl:gap-24 items-start mb-20">

                <!-- Product Image with Enhanced Effects -->
                <div class="relative group" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.3s; opacity: 0;">
                    <div class="gradient-border rounded-3xl overflow-hidden">
                        <div class="rounded-3xl overflow-hidden bg-[--color-background-800] p-2">
                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                 alt="{{ $product->name }}"
                                 class="w-full aspect-[4/5] object-cover transition-transform duration-700 group-hover:scale-105 rounded-2xl">
                        </div>
                    </div>

                    <!-- Watchlist Heart -->
                    <div class="absolute top-8 right-8 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <x-watchlist-button :product="$product" />
                    </div>

                    <!-- Discount Badge -->
                    @if($activeDiscount)
                        <div class="absolute top-8 left-8 bg-gradient-to-r from-[--color-accent-600] to-[--color-accent-500] text-white px-6 py-3 rounded-full font-bold text-lg shadow-xl animate-pulse backdrop-blur-sm border border-white/20">
                            -{{ $activeDiscount->percent_off }}% OFF
                        </div>
                    @endif

                    <!-- Stock Indicator -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="bg-[--color-background-800]/90 backdrop-blur-md rounded-xl p-4 border border-[--color-primary-700]/30">
                            <div class="flex justify-between items-center text-sm text-[--color-text-200] mb-2">
                                <span>Stock Available</span>
                                <span class="text-[--color-accent-400] font-bold">{{ $product->stock_quantity }} units</span>
                            </div>
                            <div class="w-full bg-[--color-primary-700]/30 rounded-full h-2">
                                <div class="bg-gradient-to-r from-[--color-accent-500] to-[--color-primary-500] h-2 rounded-full transition-all duration-1000"
                                     style="width: {{ min(100, ($product->stock_quantity / 50) * 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="space-y-8" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
                    <!-- Title & Description -->
                    <div>
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                            <span class="bg-gradient-to-r from-[--color-accent-400] to-[--color-primary-400] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                                {{ $product->name }}
                            </span>
                        </h1>
                        <p class="text-xl text-[--color-text-200] leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Price Section -->
                    <div class="space-y-4">
                        @if($activeDiscount)
                            <div class="flex items-baseline gap-6">
                                <span class="text-6xl font-bold text-[--color-accent-400] text-glow-accent">
                                    ${{ number_format($product->getDiscountedPrice(), 2) }}
                                </span>
                                <span class="text-3xl text-[--color-text-300] line-through opacity-70">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>
                            <p class="text-[--color-accent-400] font-medium text-lg">
                                💰 You save ${{ number_format($product->price - $product->getDiscountedPrice(), 2) }}!
                            </p>
                        @else
                            <div class="text-6xl font-bold text-[--color-accent-500] text-glow-accent">
                                ${{ number_format($product->price, 2) }}
                            </div>
                        @endif
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-col sm:flex-row gap-6 items-start">
                        @csrf
                        <div class="relative">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                                   class="w-32 px-6 py-4 bg-[--color-background-800] border border-[--color-primary-700] rounded-xl text-center text-[--color-text-50] focus:border-[--color-accent-500] focus:outline-none transition-all backdrop-blur-sm">
                        </div>
                        <button type="submit" class="flex-1 sm:flex-initial px-12 py-5 rounded-xl bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-white text-xl font-bold uppercase tracking-wider transition-all duration-300 btn-3d flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add to Collection
                        </button>
                    </form>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-4">
                        <span class="px-6 py-3 rounded-full bg-[--color-primary-600]/20 text-[--color-primary-400] font-medium border border-[--color-primary-600]/50 backdrop-blur-sm">
                            ⭐ Limited Edition
                        </span>
                        <span class="px-6 py-3 rounded-full bg-[--color-accent-600]/20 text-[--color-accent-400] font-medium border border-[--color-accent-600]/50 backdrop-blur-sm">
                            🔗 Blockchain Verified
                        </span>
                        <span class="px-6 py-3 rounded-full bg-purple-600/20 text-purple-300 font-medium border border-purple-600/50 backdrop-blur-sm">
                            📚 {{ $product->category->name ?? 'Digital Asset' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Enhanced Info Cards -->
            <div class="grid md:grid-cols-3 gap-8 mb-20">
                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl p-8 border border-[--color-primary-700]/30 transition-all duration-500" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.7s; opacity: 0;">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] flex items-center justify-center shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-center text-[--color-text-50]">Digital Format</h3>
                    <p class="text-[--color-text-200] text-center">EPUB • PDF • 4K Resolution • DRM-Free</p>
                </div>

                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl p-8 border border-[--color-primary-700]/30 transition-all duration-500" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.9s; opacity: 0;">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-[--color-accent-600] to-[--color-accent-400] flex items-center justify-center shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-center text-[--color-text-50]">Secure Ownership</h3>
                    <p class="text-[--color-text-200] text-center">NFT-backed certificate • Blockchain verified • Transferable rights</p>
                </div>

                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl p-8 border border-[--color-primary-700]/30 transition-all duration-500" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.1s; opacity: 0;">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-purple-600 to-[--color-primary-400] flex items-center justify-center shadow-xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-center text-[--color-text-50]">Creator Verified</h3>
                    <p class="text-[--color-text-200] text-center">Official release • Artist signed • Royalty supported</p>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count())
                <div class="mt-20" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.3s; opacity: 0;">
                    <h2 class="text-4xl font-bold text-center mb-16">
                        <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent" style="text-shadow: 0 0 8px var(--color-primary-400);">
                            You Might Also Like
                        </span>
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
                        @foreach($relatedProducts->take(8) as $related)
                            <a href="{{ route('catalog.show', $related) }}" class="group block">
                                <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-md rounded-2xl overflow-hidden border border-[--color-primary-700]/30 transition-all duration-500">
                                    <div class="relative overflow-hidden">
                                        <img src="{{ $related->image_url ? asset('storage/' . $related->image_url) : asset('images/default-product.png') }}"
                                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <div class="p-5">
                                        <h3 class="font-bold text-lg line-clamp-2 mb-2 group-hover:text-[--color-accent-400] transition-colors duration-300">
                                            {{ $related->name }}
                                        </h3>
                                        <p class="text-2xl font-bold text-[--color-accent-500] text-glow-accent">
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
