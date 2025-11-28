<x-app-layout>
    <style>
        /* 🚀 Unified Neon Blue & 4K-Style Color Palette */
        :root {
            /* Primary Colors - Deep Violet/Electric Purple */
            --color-primary-400: #7E57C2; /* Lighter Purple */
            --color-primary-500: #673AB7; /* Main Purple */
            --color-primary-600: #512DA8; /* Deeper Purple */
            --color-primary-700: #311B92; /* Darkest Purple */
            
            /* ✨ Unified Accent Color - Neon Blue Glow */
            --color-accent-blue-500: #00BCD4; /* Main Neon Blue */
            --color-accent-blue-400: #4DD0E1; /* Lighter Blue */
            --color-accent-blue-600: #0097A7; /* Deeper Blue */

            /* Backgrounds - Dark Technical Palette */
            --color-background-700: #1C1917; /* Slate Black */
            --color-background-800: #100C09; /* Near Black */
            --color-background-900: #0D0A08; /* Abyss Black */
            
            /* Text - Bright and Technical */
            --color-text-50: #EFEFEF; /* Bright White/Neon */
            --color-text-200: #A0AEC0; /* Slate Gray */
            --color-text-300: #718096; /* Darker Gray */
            --color-text-400: #4A5568; /* Deepest Text Gray */

            /* Neon Glow Shadows */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-blue-glow: 0 0 10px var(--color-accent-blue-500), 0 0 20px var(--color-accent-blue-400);

            /* Typography */
            --font-heading: 'Exo 2', sans-serif; 
        }

        /* Dark Mode (Updated for consistency) */
        .dark {
            --color-primary-400: #9373D2;
            --color-primary-500: #7E57C2;
            --color-primary-600: #673AB7;
            --color-primary-700: #512DA8;

            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
            
            --color-text-50: #F0F0F0;
            --color-text-200: #A0AEC0;
        }

        /* Light Mode (Updated for consistency) */
        .light {
            /* Backgrounds */
            --color-background-900: #F7FAFC; /* Near White */
            --color-background-800: #FFFFFF; /* White */
            --color-background-700: #EDF2F7; /* Light Gray */
            /* Primary Colors - Tone down for light background */
            --color-primary-500: #5E35B1; 
            --color-primary-400: #7E57C2;
            --color-primary-600: #4527A0;
            --color-primary-700: #261765;
            /* Text - Dark text for light background */
            --color-text-50: #1A202C; 
            --color-text-200: #4A5568; 
            --color-text-300: #718096;
            --color-text-400: #A0AEC0;
            /* Shadows - More standard shadow for light mode */
            --shadow-primary-glow: 0 4px 10px rgba(94, 53, 177, 0.2);
            --shadow-accent-blue-glow: 0 4px 10px rgba(0, 188, 212, 0.2);
        }

        /* Custom radial gradient background for the glow effect */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%);
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
        @keyframes card-enter {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, -5px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
            }
        }

        /* 3D Card Hover Effect */
        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            box-shadow: 0 0 5px var(--color-primary-700);
        }

        .card-3d:hover {
            transform: scale(1.03) rotateX(2deg) rotateY(-2deg) translateZ(5px);
            box-shadow: var(--shadow-primary-glow);
            z-index: 10; /* Bring hovered card to front */
        }
        
        /* Neon Button Style */
        .btn-neon-blue {
            transition: all 0.3s ease-out;
            box-shadow: 0 0 5px var(--color-accent-blue-500), 0 0 10px var(--color-accent-blue-400);
            border: 1px solid var(--color-accent-blue-600);
        }
        .btn-neon-blue:hover {
            box-shadow: 0 0 15px var(--color-accent-blue-500), 0 0 25px var(--color-accent-blue-400);
            transform: translateY(-1px);
        }

        /* Unified Neon Blue for Callout/Price */
        .text-neon-accent { /* Renamed from text-neon-pink */
            color: var(--color-accent-blue-500);
            text-shadow: 0 0 5px var(--color-accent-blue-400);
        }

        /* Input/Select Style - Glassmorphic/Technical */
        .input-tech {
            background-color: var(--color-background-800)/70;
            border: 1px solid var(--color-primary-700);
            box-shadow: inset 0 0 5px var(--color-primary-700)/50;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .input-tech:focus {
            border-color: var(--color-primary-500);
            box-shadow: 0 0 0 2px var(--color-primary-500)/50, inset 0 0 5px var(--color-primary-500)/50;
        }

        /* Auction Timer Visual */
        .timer-glow {
            box-shadow: 0 0 10px var(--color-accent-blue-500); /* Changed to blue */
            animation: pulse-blue-glow 1s infinite alternate; /* Changed to blue */
        }

        @keyframes pulse-blue-glow { /* New keyframe for blue pulse */
            0% { box-shadow: 0 0 5px var(--color-accent-blue-500), 0 0 10px var(--color-accent-blue-400); }
            100% { box-shadow: 0 0 15px var(--color-accent-blue-500), 0 0 25px var(--color-accent-blue-400); }
        }
        
    </style>

    <script>
        // Theme initialization and toggling updated to use 'light' class
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

        // Countdown Timer Logic
        document.addEventListener('DOMContentLoaded', () => {
            const countdownEl = document.getElementById('auction-countdown');
            if (countdownEl) {
                // Set the auction end time (e.g., 24 hours from now)
                const endTime = new Date(Date.now() + 24 * 60 * 60 * 1000).getTime();

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    if (distance < 0) {
                        clearInterval(interval);
                        countdownEl.innerHTML = "Auction Ended";
                        return;
                    }

                    countdownEl.innerHTML = `
                        <span class="text-3xl font-bold">${String(hours).padStart(2, '0')}</span><span class="text-lg text-[var(--color-text-300)] mx-1">:</span>
                        <span class="text-3xl font-bold">${String(minutes).padStart(2, '0')}</span><span class="text-lg text-[var(--color-text-300)] mx-1">:</span>
                        <span class="text-3xl font-bold">${String(seconds).padStart(2, '0')}</span>
                        <span class="text-xs text-[var(--color-text-300)] block mt-1">HRS MIN SEC</span>
                    `;
                }

                const interval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Initial call to display immediately
            }
        });
    </script>
    
    <div class="min-h-screen relative overflow-hidden bg-[var(--color-background-900)] text-[var(--color-text-50)] py-12 transition-colors duration-500" style="font-family: var(--font-heading);">
        
        <div class="absolute inset-0 bg-radial-gradient-primary dark:opacity-20 light:opacity-10 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex justify-end mb-8">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[var(--color-background-800)] border border-[var(--color-primary-700)] dark:hover:border-[var(--color-accent-blue-500)] light:hover:border-[var(--color-accent-blue-500)] transition-all">
                    <svg class="h-6 w-6 text-[var(--color-text-200)] block dark:block light:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[var(--color-text-200)] hidden dark:hidden light:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
            
            <div class="max-w-4xl mx-auto text-center mb-16">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-[var(--color-text-50)] mb-6">
                    <span class="bg-gradient-to-r from-[var(--color-accent-blue-400)] to-[var(--color-accent-blue-500)] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-blue-500);">
                        The Digital Catalog
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-10 max-w-3xl mx-auto font-light">
                    Explore our curated collection of **verified digital manhwa and manga assets**. Use the filters to find your next masterpiece.
                </p>
            </div>

            <form method="GET" class="mb-12 flex flex-wrap gap-4 items-center justify-center p-6 rounded-xl bg-[var(--color-background-700)]/50 border border-[var(--color-primary-700)]/50 shadow-lg dark:shadow-xl shadow-[var(--color-primary-700)]/30">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search titles, artists, or keywords..." class="flex-1 min-w-[200px] input-tech text-[var(--color-text-50)] p-3 rounded-lg focus:outline-none transition-all">
                <select name="category" class="flex-1 min-w-[150px] input-tech text-[var(--color-text-50)] p-3 rounded-lg focus:outline-none transition-all">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-8 py-3 rounded-lg bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-primary-500)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-primary-400)] text-[var(--color-text-50)] font-medium text-lg transition-all shadow-lg shadow-[var(--color-primary-600)]/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707v3.414l6 6v-3.414a1 1 0 00-.293-.707l-6.414-6.414a1 1 0 01-.293-.707V7.586a1 1 0 01.293-.707l6.414-6.414a1 1 0 011-1z" /></svg>
                    Apply Filters
                </button>
                <a href="{{ route('catalog') }}" class="px-6 py-3 rounded-lg btn-neon-blue bg-[var(--color-background-700)] hover:bg-[var(--color-background-800)] text-[var(--color-accent-blue-400)] font-medium text-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    Clear
                </a>
            </form>
            
            <hr class="border-t border-[var(--color-accent-blue-500)]/30 my-10 dark:shadow-[0_0_5px_var(--color-accent-blue-500)]">

            <div class="mb-16 grid grid-cols-1 lg:grid-cols-3 gap-8 p-8 bg-[var(--color-background-700)] rounded-2xl border border-[var(--color-accent-blue-600)]/50 shadow-2xl dark:shadow-[0_0_40px_rgba(0,188,212,0.3)]"
                style="animation: card-enter 0.5s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
                
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold text-neon-accent mb-2">⚡ LIVE AUCTION: The Breaker - First Edition</h2>
                    <p class="text-[var(--color-text-200)] mb-4">A high-grade, verified digital copy of one of the most iconic action Manhwa assets. **Bidding ends soon!**</p>
                    <div class="flex items-center space-x-6">
                        <div class="text-center p-3 rounded-lg bg-[var(--color-background-800)]/50 border border-[var(--color-accent-blue-600)] timer-glow">
                            <div id="auction-countdown" class="text-neon-accent">
                                </div>
                        </div>
                        <div class="text-left">
                             <p class="text-sm text-[var(--color-text-300)]">Current Bid</p>
                             <p class="font-bold text-2xl text-neon-accent">2.54 ETH</p>
                        </div>
                    </div>
                    <a href="#" class="mt-5 inline-block px-8 py-3 rounded-lg bg-[var(--color-accent-blue-500)] hover:bg-[var(--color-accent-blue-600)] text-[var(--color-text-50)] font-medium text-lg transition-all shadow-md shadow-[var(--color-accent-blue-600)]/40">
                        Place Bid Now!
                    </a>
                </div>
                <div class="lg:col-span-1 h-full min-h-[200px] rounded-lg overflow-hidden border border-[var(--color-primary-700)]">
                    <img src="https://via.placeholder.com/400x300/00BCD4/FFFFFF?text=Featured+Auction" alt="Featured Auction Item" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <div 
                        class="card-3d bg-[var(--color-background-800)]/50 backdrop-blur-md rounded-xl overflow-hidden border border-[var(--color-primary-700)]/30 transition-all duration-500 relative"
                        style="animation: card-enter 0.5s ease-out forwards; animation-delay: {{ 0.4 + $loop->index * 0.1 }}s; opacity: 0;"
                    >
                        <div class="h-48 overflow-hidden border-b border-[var(--color-primary-700)]/30">
                             <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                             <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-[var(--color-accent-blue-500)] to-[var(--color-accent-blue-400)] text-[var(--color-text-50)] shadow-md shadow-[var(--color-accent-blue-500)]/50">
                                {{ $product->category->name ?? 'Digital' }}
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="font-heading font-semibold text-xl text-[var(--color-text-50)] mb-2">{{ $product->name }}</h3>
                            <p class="text-[var(--color-text-300)] text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex justify-between items-center pt-2 border-t border-[var(--color-primary-700)]/30">
                                <div>
                                    <p class="text-xs text-[var(--color-text-200)]">Starting Price</p>
                                    <p class="font-bold text-2xl text-neon-accent">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <a href="{{ route('catalog.show', $product) }}" class="px-5 py-2 rounded-lg bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-primary-500)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-primary-400)] text-[var(--color-text-50)] font-medium text-base transition-all shadow-md shadow-[var(--color-primary-600)]/30">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-[var(--color-text-300)] text-lg text-center col-span-full py-10">No digital assets match your criteria. Try widening your search! 😔</p>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $products->links('partials.pagination') }}
            </div>
            
            <footer class="text-center py-10 border-t border-[var(--color-primary-700)]/50 mt-20">
                <p class="text-[var(--color-text-300)] text-sm">© 2025 SylvieVerse Marketplace. All rights reserved. **A next-generation experience.**</p>
                <div class="flex justify-center space-x-4 mt-4">
                    <a href="#" class="text-[var(--color-accent-blue-400)] hover:text-[var(--color-accent-blue-500)] transition-colors">Privacy Policy</a>
                    <a href="#" class="text-[var(--color-accent-blue-400)] hover:text-[var(--color-accent-blue-500)] transition-colors">Terms of Service</a>
                    <a href="#" class="text-[var(--color-accent-blue-400)] hover:text-[var(--color-accent-blue-500)] transition-colors">Support</a>
                </div>
            </footer>
        </div>
    </div>
</x-app-layout>