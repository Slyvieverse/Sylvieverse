<x-app-layout>
    <style>
        :root {
            /* Light Mode Colors */
            --color-primary-400: #6B46C1;
            --color-primary-500: #553C9A;
            --color-primary-600: #44337A;
            --color-primary-700: #322659;
            --color-accent-500: #D53F8C;
            --color-background-700: #E2E8F0;
            --color-background-800: #F7FAFC;
            --color-background-900: #FFFFFF;
            --color-text-50: #1A202C;
            --color-text-200: #2D3748;
            --color-text-300: #4A5568;
            --color-text-400: #718096;
        }

        /* Dark Mode */
        .dark {
            --color-primary-400: #805AD5;
            --color-primary-500: #6B46C1;
            --color-primary-600: #553C9A;
            --color-primary-700: #44337A;
            --color-accent-500: #ED64A6;
            --color-background-700: #1A202C;
            --color-background-800: #2D3748;
            --color-background-900: #171923;
            --color-text-50: #E2E8F0;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --color-text-400: #4A5568;
        }

        /* Custom radial gradient background for the glow effect */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle, var(--color-primary-400) 0%, transparent 60%);
        }

        /* Keyframe for a soft pulse animation */
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 15px rgba(128, 90, 213, 0.2); }
            50% { box-shadow: 0 0 30px rgba(128, 90, 213, 0.4); }
            100% { box-shadow: 0 0 15px rgba(128, 90, 213, 0.2); }
        }

        /* Keyframe for staggered element entrance */
        @keyframes page-enter {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('light');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-300">
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-30 animate-[pulse-glow_4s_infinite] transition-opacity duration-300"></div>

        <main class="container mx-auto px-6 py-16 md:py-24 relative z-10">
            <div class="absolute top-8 right-6" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] hover:border-[--color-primary-500] transition-all">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
            
            <div class="max-w-4xl mx-auto text-center mb-16" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-[--color-text-50] mb-6">
                    Welcome to <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent">SylvieVerse</span>
                </h1>
                <p class="text-xl md:text-2xl text-[--color-text-200] mb-10 max-w-3xl mx-auto">
                    The Neon Frontier of Manhwa & Manga Auctions. Discover rare digital treasures, bid in real-time auctions, and build your collection.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#" class="px-8 py-4 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium text-lg transition-all shadow-lg shadow-[--color-primary-600]/20 hover:shadow-[--color-primary-500]/30">
                        Browse Marketplace
                    </a>
                    <a href="#" class="px-8 py-4 rounded-lg bg-[--color-background-700] hover:bg-[--color-background-800] border border-[--color-primary-700] text-[--color-text-50] font-medium text-lg transition-all">
                        Join the Auction
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:border-[--color-primary-500] transition-all duration-300 hover:scale-[1.03] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.2s;">
                    <div class="w-14 h-14 rounded-lg bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[--color-text-50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[--color-text-50] mb-2">Rare Collections</h3>
                    <p class="text-[--color-text-200]">Discover limited edition manhwa and manga from acclaimed artists and publishers.</p>
                </div>
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:border-[--color-primary-500] transition-all duration-300 hover:scale-[1.03] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.4s;">
                    <div class="w-14 h-14 rounded-lg bg-gradient-to-br from-[--color-accent-500] to-pink-400 mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[--color-text-50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[--color-text-50] mb-2">Digital Ownership</h3>
                    <p class="text-[--color-text-200]">Own verified digital editions with blockchain-backed authenticity certificates.</p>
                </div>
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:border-[--color-primary-500] transition-all duration-300 hover:scale-[1.03] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.6s;">
                    <div class="w-14 h-14 rounded-lg bg-gradient-to-br from-purple-500 to-[--color-primary-400] mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[--color-text-50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[--color-text-50] mb-2">Live Auctions</h3>
                    <p class="text-[--color-text-200]">Participate in real-time bidding wars for the most sought-after collectibles.</p>
                </div>
            </div>

            <div class="text-center mb-20" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.8s; opacity: 0;">
                <p class="text-lg text-[--color-text-200] mb-4">Join our community of passionate collectors</p>
                <div class="flex justify-center items-center space-x-2">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] border-2 border-[--color-background-800]"></div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[--color-accent-500] to-pink-400 border-2 border-[--color-background-800]"></div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-[--color-primary-400] border-2 border-[--color-background-800]"></div>
                    </div>
                    <span class="text-[--color-text-50] font-medium">10,000+ Collectors</span>
                </div>
            </div>

            <div class="mb-20">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-[--color-text-50] mb-8 text-center animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.0s;">Featured Auctions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-primary-700]/30 hover:shadow-lg hover:shadow-[--color-primary-500]/10 transition-all duration-300 hover:scale-[1.02] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.2s;">
                        <div class="h-48 bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] opacity-80"></div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-heading font-semibold text-[--color-text-50]">Solo Leveling #1</h3>
                                <span class="px-2 py-1 bg-[--color-primary-500]/20 text-[--color-primary-400] text-xs rounded">RARE</span>
                            </div>
                            <p class="text-[--color-text-200] text-sm mb-4">First edition digital copy with exclusive artwork</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-[--color-text-200]">Current Bid</p>
                                    <p class="font-medium text-[--color-text-50]">0.75 ETH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-[--color-text-200]">Ending In</p>
                                    <p class="font-medium text-[--color-accent-500]">12h 43m</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-primary-700]/30 hover:shadow-lg hover:shadow-[--color-primary-500]/10 transition-all duration-300 hover:scale-[1.02] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.4s;">
                        <div class="h-48 bg-gradient-to-br from-[--color-accent-500] to-pink-400 opacity-80"></div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-heading font-semibold text-[--color-text-50]">Tower of God Set</h3>
                                <span class="px-2 py-1 bg-[--color-accent-500]/20 text-[--color-accent-500] text-xs rounded">NEW</span>
                            </div>
                            <p class="text-[--color-text-200] text-sm mb-4">Complete season 1 collection with author signatures</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-[--color-text-200]">Current Bid</p>
                                    <p class="font-medium text-[--color-text-50]">2.25 ETH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-[--color-text-200]">Ending In</p>
                                    <p class="font-medium text-[--color-accent-500]">1d 08h</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-primary-700]/30 hover:shadow-lg hover:shadow-[--color-primary-500]/10 transition-all duration-300 hover:scale-[1.02] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.6s;">
                        <div class="h-48 bg-gradient-to-br from-purple-600 to-[--color-primary-400] opacity-80"></div>
                        <div class="p-5">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="font-heading font-semibold text-[--color-text-50]">The Breaker: Omnibus</h3>
                                <span class="px-2 py-1 bg-purple-500/20 text-purple-400 text-xs rounded">LIMITED</span>
                            </div>
                            <p class="text-[--color-text-200] text-sm mb-4">Complete series with animated cover and bonus content</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-[--color-text-200]">Current Bid</p>
                                    <p class="font-medium text-[--color-text-50]">1.89 ETH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-[--color-text-200]">Ending In</p>
                                    <p class="font-medium text-[--color-accent-500]">3d 14h</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>