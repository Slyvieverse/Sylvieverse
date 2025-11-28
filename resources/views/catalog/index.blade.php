{{-- resources/views/catalog/index.blade.php --}}
<x-app-layout>
    <style>
        /* 🚀 Enhanced Neon & 4K-Style Color Palette */
        :root {
            /* Primary Colors - Deep Violet/Electric Purple */
            --color-primary-400: #7E57C2; /* Lighter Purple */
            --color-primary-500: #673AB7; /* Main Purple */
            --color-primary-600: #512DA8; /* Deeper Purple */
            --color-primary-700: #311B92; /* Darkest Purple */

            /* ✨ NEW Accent Colors - Light Neon Blue/Aqua Glow */
            --color-accent-500: #00BCD4; /* Main Neon Blue */
            --color-accent-400: #4DD0E1; /* Lighter Blue */
            --color-accent-600: #0097A7; /* Deeper Blue */

            /* Backgrounds - Dark Technical Palette */
            --color-background-700: #1C1917; /* Slate Black */
            --color-background-800: #100C09; /* Near Black */
            --color-background-900: #0D0A08; /* Abyss Black */

            /* Text - Bright and Technical */
            --color-text-50: #EFEFEF; /* Bright White/Neon */
            --color-text-200: #A0AEC0; /* Slate Gray */
            --color-text-300: #718096; /* Darker Gray */
            --color-text-400: #4A5568; /* Deepest Text Gray */

            /* Neon Glow Shadows (for 3D effect) */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);

            /* Typography - Assume a modern font like 'Exo 2' or 'Orbitron' is imported */
            --font-heading: 'Exo 2', sans-serif;
        }

        /* 🌙 Dark Mode - Slightly adjusted for richer contrast */
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

        /* ☀️ Light Mode - Introducing a contrasting palette for the light theme */
        .light {
            /* Backgrounds */
            --color-background-900: #F7FAFC; /* Near White */
            --color-background-800: #FFFFFF; /* White */
            --color-background-700: #EDF2F7; /* Light Gray */
            /* Primary Colors - Tone down for light background */
            --color-primary-500: #5E35B1; /* Main Purple */
            --color-primary-400: #7E57C2;
            --color-primary-600: #4527A0;
            --color-primary-700: #261765;
            /* Accent Colors */
            --color-accent-500: #0097A7; /* Main Neon Blue */
            --color-accent-400: #00BCD4;
            --color-accent-600: #006064;
            /* Text - Dark text for light background */
            --color-text-50: #1A202C; /* Darkest Text */
            --color-text-200: #4A5568;
            --color-text-300: #718096;
            --color-text-400: #A0AEC0;
            /* Shadows - More standard shadow for light mode */
            --shadow-primary-glow: 0 4px 10px rgba(94, 53, 177, 0.2);
            --shadow-accent-glow: 0 4px 10px rgba(0, 188, 212, 0.2);
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

        /* 💡 Keyframes for Advanced Animations */

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

        /* Staggered Entrance - Modified for a slight 3D lift */
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

        /* 3D Rotating Cube/Visual (Mock 3D Element) */
        @keyframes rotate-3d-visual {
            0% { transform: rotateY(0deg) rotateX(0deg); }
            100% { transform: rotateY(360deg) rotateX(360deg); }
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
                inset 0 1px 0 rgba(255, 255, 255, 0.1), /* Light source */
                0 0 10px rgba(126, 87, 194, 0.5); /* Soft outer glow */
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
                0 0 20px var(--color-primary-400); /* Intense hover glow */
        }
    </style>

    <script>
        // Theme initialization and toggling is updated for a "light" class.
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light'); // Default to light if no preference/system preference is light
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

        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <main class="container mx-auto px-6 py-16 relative z-10">

            <!-- Theme Toggle Button -->
            <div class="absolute top-8 right-6 z-20" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] dark:hover:border-[--color-accent-500] light:hover:border-[--color-accent-500] transition-all btn-3d" title="Toggle Theme">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:block light:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:hidden light:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            <!-- Enhanced Header -->
            <div class="max-w-5xl mx-auto text-center mb-16" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight leading-tight">
                    <span class="inline-block relative">
                        <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                            Digital Catalog
                        </span>
                        <span class="absolute top-0 left-0 w-full h-full text-[var(--color-primary-700)] opacity-30 -translate-x-1 -translate-y-1 z-[-1]" aria-hidden="true">
                            Digital Catalog
                        </span>
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-12 max-w-4xl mx-auto font-light">
                    Discover rare manhwa, manga & webtoon collectibles — all verified and ready to own.
                </p>
            </div>

            <!-- Enhanced Search & Filters -->
            <div class="mb-16">
                <form method="GET" class="backdrop-blur-xl bg-[--color-background-800]/80 border border-[--color-primary-700]/50 rounded-3xl p-8 shadow-2xl shadow-[--color-primary-700]/20 hover:shadow-[--color-primary-700]/30 transition-all duration-500 card-3d">
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-end">
                        <!-- Search Input -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-[--color-text-200] mb-3">Search Collection</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-[--color-text-400]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Search titles, authors, series..."
                                       class="w-full bg-[--color-background-700] border border-[--color-primary-700]/30 text-[--color-text-50] placeholder-[--color-text-400] pl-12 pr-4 py-4 rounded-xl focus:border-[--color-primary-500] focus:ring-2 focus:ring-[--color-primary-500]/20 focus:outline-none transition-all duration-300">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-[--color-text-200] mb-3">Category</label>
                            <select name="category" class="w-full bg-[--color-background-700] border border-[--color-primary-700]/30 text-[--color-text-50] px-4 py-4 rounded-xl focus:border-[--color-primary-500] focus:ring-2 focus:ring-[--color-primary-500]/20 focus:outline-none transition-all duration-300">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-semibold py-4 px-6 rounded-xl shadow-lg shadow-[--color-primary-600]/30 hover:shadow-[--color-primary-500]/50 transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2 btn-3d">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search
                            </button>
                            <a href="{{ route('catalog') }}" class="p-4 bg-[--color-background-700] border border-[--color-primary-700]/30 hover:bg-[--color-background-600] text-[--color-text-200] hover:text-[--color-text-50] rounded-xl transition-all duration-300 flex items-center justify-center btn-3d">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

        

            <!-- Enhanced Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                @forelse($products as $product)
                    <div class="card-3d group bg-[--color-background-800]/70 backdrop-blur-xl border border-[--color-primary-700]/30 rounded-2xl overflow-hidden hover:border-[--color-primary-500]/60 transition-all duration-500 hover:shadow-2xl hover:shadow-[--color-primary-500]/20 transform hover:-translate-y-2">
                        <a href="{{ route('catalog.show', $product) }}" class="block">
                            <div class="relative overflow-hidden">
                                <!-- Product Image -->
                                <div class="aspect-w-4 aspect-h-3 bg-gray-800">
                                    <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                         class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110"
                                         alt="{{ $product->name }}">
                                </div>

                                <!-- Category Badge -->
                                <span class="absolute top-4 left-4 px-3 py-1 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-white text-xs font-bold rounded-full shadow-lg backdrop-blur-sm">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>

                                <!-- Discount Badge -->
                             <!-- Discount Badge – FIXED -->
@php
    $activeDiscount = $product->activeDiscount();
@endphp

@if($activeDiscount)
    <span class="absolute top-4 right-4 bg-gradient-to-r from-red-600 to-pink-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg backdrop-blur-sm animate-pulse">
        -{{ $activeDiscount->percent_off }}% OFF
    </span>
@endif

                                <!-- Watchlist Heart Button -->
                                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <x-watchlist-button :product="$product" />
                                </div>

                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="p-6">
                                <h3 class="font-bold text-lg text-[--color-text-50] line-clamp-2 mb-3 group-hover:text-[--color-primary-400] transition-colors duration-300">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-[--color-text-200] text-sm line-clamp-2 mb-4 leading-relaxed">
                                    {{ Str::limit($product->description, 80) }}
                                </p>

                                <div class="flex justify-between items-end">
                                    <div class="space-y-1">
                                        @if($product->discounts())
                                            <p class="text-2xl font-bold text-[--color-accent-400]">
                                                ${{ number_format($product->final_price, 2) }}
                                            </p>
                                            <p class="text-sm text-[--color-text-400] line-through">
                                                ${{ number_format($product->price, 2) }}
                                            </p>
                                        @else
                                            <p class="text-2xl font-bold text-[--color-primary-400]">
                                                ${{ number_format($product->price, 2) }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg hover:shadow-[--color-primary-500]/50 transition-all duration-300 transform group-hover:scale-105 flex items-center gap-2 btn-3d">
                                        <span>View</span>
                                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="w-32 h-32 mx-auto mb-6 rounded-full bg-[--color-background-700] border-2 border-dashed border-[--color-primary-500]/40 flex items-center justify-center">
                            <svg class="w-16 h-16 text-[--color-primary-500]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-3.5m-9 0H4"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-[--color-text-50] mb-4">No items found</h3>
                        <p class="text-[--color-text-200] text-lg mb-8">Try adjusting your filters or search term.</p>
                        <a href="{{ route('catalog') }}" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-accent-600] text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg hover:shadow-[--color-primary-500]/30 transition-all duration-300 btn-3d">
                            Clear Filters
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            @if($products->hasPages())
                <div class="mt-16 flex justify-center">
                    <div class="backdrop-blur-xl bg-[--color-background-800]/80 border border-[--color-primary-700]/30 rounded-2xl p-2">
                        {{ $products->appends(request()->query())->links('partials.pagination') }}
                    </div>
                </div>
            @endif
        </main>
    </div>
</x-app-layout>
