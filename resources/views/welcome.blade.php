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

        // Simulating Live Feed data for the new section
        document.addEventListener('DOMContentLoaded', () => {
            const feedData = [
                { time: '3 min ago', user: 'CryptoManga', action: 'placed a **bid**', item: 'The Breaker', amount: '1.92 ETH', color: 'primary' },
                { time: '8 min ago', user: 'NeonCollector', action: 'listed a **Rare**', item: 'Solo Leveling #1', amount: '0.75 ETH', color: 'accent' },
                { time: '15 min ago', user: 'SylvieFan', action: 'outbid on', item: 'Tower of God', amount: '2.28 ETH', color: 'primary' },
            ];
            const feedContainer = document.getElementById('activity-feed');
            
            feedData.forEach((item, index) => {
                const colorClass = item.color === 'primary' ? 'text-[var(--color-primary-400)]' : 'text-[var(--color-accent-500)]';
                const html = `
                    <li class="p-3 border-b border-[--color-primary-700]/30 last:border-b-0 opacity-0 animate-[page-enter_0.5s_ease-out_forwards]" style="animation-delay: ${2.0 + index * 0.1}s;">
                        <span class="text-xs text-[--color-text-300]">${item.time}</span>
                        <p class="text-[--color-text-50] text-sm md:text-base">
                            <strong class="${colorClass}">${item.user}</strong> ${item.action} on 
                            <span class="font-semibold text-white dark:text-[--color-text-50] light:text-[--color-text-50]">${item.item}</span> for 
                            <span class="font-bold ${colorClass}">${item.amount}</span>
                        </p>
                    </li>
                `;
                feedContainer.innerHTML += html;
            });
        });
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans" style="font-family: var(--font-heading);">
        
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <main class="container mx-auto px-6 py-16 md:py-24 relative z-10">

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
            
            <div class="max-w-5xl mx-auto text-center mb-20 md:mb-32" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 tracking-tight leading-tight">
                    Welcome to 
                    <span class="inline-block relative">
                        <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                            SylvieVerse
                        </span>
                        <span class="absolute top-0 left-0 w-full h-full text-[var(--color-primary-700)] opacity-30 -translate-x-1 -translate-y-1 z-[-1]" aria-hidden="true">
                            SylvieVerse
                        </span>
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-12 max-w-4xl mx-auto font-light">
                    The **Neon Frontier** of Manhwa & Manga Auctions. Discover **verified digital treasures**, bid in real-time auctions, and build your blockchain-backed collection.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="#" class="btn-3d px-10 py-4 rounded-xl bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-primary-500)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-primary-400)] text-[var(--color-text-50)] font-semibold text-xl shadow-lg shadow-[var(--color-primary-600)]/30">
                        Browse Marketplace
                    </a>
                    <a href="#" class="btn-3d px-10 py-4 rounded-xl bg-[var(--color-background-700)] dark:hover:bg-[var(--color-background-800)] light:hover:bg-[var(--color-background-700)] border border-[var(--color-accent-500)]/50 text-[var(--color-accent-400)] font-semibold text-xl transition-all shadow-md shadow-[var(--color-accent-500)]/10">
                        Join the Auction
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-20">
                <div class="lg:col-span-2 relative h-96 bg-[var(--color-background-800)] rounded-2xl p-6 flex items-center justify-center border border-[var(--color-primary-600)]/50 shadow-2xl shadow-[var(--color-primary-700)]/50" 
                    style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.8s; opacity: 0;">
                    
                    <h2 class="absolute top-4 left-6 text-xl font-bold text-[var(--color-text-50)] z-20">3D Asset Projection</h2>
                    <div class="relative w-48 h-48">
                        <div class="w-full h-full rounded-3xl bg-gradient-to-br from-[var(--color-primary-400)] to-[var(--color-accent-500)] opacity-80"
                            style="box-shadow: 0 0 30px var(--color-accent-500); animation: rotate-3d-visual 15s linear infinite; transform-style: preserve-3d; transform: rotateY(30deg) rotateX(10deg);">
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white text-glow-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="absolute bottom-6 right-6 text-sm text-[var(--color-text-300)]">Real-time rendering of NFT collectible</p>
                </div>

                <div class="bg-[var(--color-background-800)] rounded-2xl border border-[var(--color-accent-600)]/50 shadow-xl dark:shadow-[var(--color-accent-700)]/50 overflow-hidden" 
                    style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.0s; opacity: 0;">
                    <h3 class="p-4 bg-[var(--color-accent-500)]/20 font-bold text-lg text-[var(--color-accent-400)] border-b border-[var(--color-accent-600)]">🔥 Live Auction Activity</h3>
                    <ul id="activity-feed" class="divide-y divide-[var(--color-primary-700)]/30 h-80 overflow-y-auto">
                    </ul>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <div class="card-3d bg-[var(--color-background-800)]/50 backdrop-blur-sm rounded-xl p-8 border border-[var(--color-primary-700)]/50 transition-all duration-500 ease-out hover:shadow-primary-glow" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.2s; opacity: 0;">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] mb-6 flex items-center justify-center shadow-md shadow-[var(--color-primary-500)]/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[var(--color-text-50)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-[var(--color-text-50)] mb-3 border-b border-[var(--color-primary-700)]/20 pb-2">Rare Collections</h3>
                    <p class="text-[var(--color-text-200)] text-lg">Discover **limited edition** manhwa and manga from acclaimed artists. Each item is vaulted and graded for quality.</p>
                </div>

                <div class="card-3d bg-[var(--color-background-800)]/50 backdrop-blur-sm rounded-xl p-8 border border-[var(--color-primary-700)]/50 transition-all duration-500 ease-out hover:shadow-primary-glow" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.4s; opacity: 0;">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-[var(--color-accent-500)] to-[var(--color-accent-400)] mb-6 flex items-center justify-center shadow-md shadow-[var(--color-accent-500)]/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[var(--color-text-50)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-[var(--color-text-50)] mb-3 border-b border-[var(--color-primary-700)]/20 pb-2">Digital Ownership</h3>
                    <p class="text-[var(--color-text-200)] text-lg">Own verified digital editions with **blockchain-backed** authenticity certificates and secure wallet integration.</p>
                </div>

                <div class="card-3d bg-[var(--color-background-800)]/50 backdrop-blur-sm rounded-xl p-8 border border-[var(--color-primary-700)]/50 transition-all duration-500 ease-out hover:shadow-primary-glow" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.6s; opacity: 0;">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-purple-500 to-[var(--color-primary-400)] mb-6 flex items-center justify-center shadow-md shadow-[var(--color-primary-500)]/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[var(--color-text-50)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-[var(--color-text-50)] mb-3 border-b border-[var(--color-primary-700)]/20 pb-2">Live Auctions</h3>
                    <p class="text-[var(--color-text-200)] text-lg">Participate in **real-time bidding wars** with secure, immutable smart contracts for fairness and transparency.</p>
                </div>
            </div>

            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-[var(--color-text-50)] mb-10 text-center animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.8s; text-shadow: 0 0 8px var(--color-primary-400);">Featured Auctions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl overflow-hidden border border-[var(--color-primary-700)]/40 transition-all duration-500 ease-out shadow-lg hover:shadow-[--shadow-primary-glow] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 2.0s;">
                        <div class="h-56 relative bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] opacity-90 p-4 flex items-end">
                            
                            <span class="z-10 px-3 py-1 bg-[var(--color-primary-500)] text-[var(--color-text-50)] text-xs font-bold rounded-full border border-white/50" style="box-shadow: 0 0 8px var(--color-primary-400);">
                                #1/50 EDITION
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-[var(--color-text-50)]">Solo Leveling #1 (Arc 1)</h3>
                                <span class="px-3 py-1 bg-[var(--color-primary-500)]/30 text-[var(--color-primary-400)] text-xs rounded-full font-bold border border-[var(--color-primary-500)]">
                                    🔥 RARE VAULT
                                </span>
                            </div>
                            <p class="text-[var(--color-text-200)] text-sm mb-5">First edition digital copy with exclusive 4K concept art and a verified certificate.</p>
                            <div class="grid grid-cols-2 gap-4 border-t border-[var(--color-primary-700)] pt-4">
                                <div>
                                    <p class="text-xs text-[var(--color-text-300)]">Current High Bid</p>
                                    <p class="font-bold text-xl text-[var(--color-text-50)] mt-1 text-glow-accent">0.75 ETH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-[var(--color-text-300)]">Auction Ending In</p>
                                    <p class="font-bold text-xl text-[var(--color-accent-500)] mt-1 text-glow-accent">12h 43m 15s</p>
                                </div>
                            </div>
                            <button class="w-full mt-5 py-3 btn-3d rounded-lg bg-gradient-to-r from-[var(--color-accent-600)] to-[var(--color-accent-500)] text-white font-semibold shadow-md shadow-[var(--color-accent-500)]/30">
                                Place Bid
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl overflow-hidden border border-[var(--color-primary-700)]/40 transition-all duration-500 ease-out hover:shadow-lg hover:shadow-[--shadow-primary-glow] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 2.2s;">
                           <div class="h-56 relative bg-gradient-to-br from-[var(--color-accent-500)] to-[var(--color-accent-400)] opacity-90 p-4 flex items-end">
                            
                            <span class="z-10 px-3 py-1 bg-[var(--color-accent-500)] text-[var(--color-text-50)] text-xs font-bold rounded-full border border-white/50" style="box-shadow: 0 0 8px var(--color-accent-400);">
                                SERIES BUNDLE
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-[var(--color-text-50)]">Tower of God: Set S1-S3</h3>
                                <span class="px-3 py-1 bg-[var(--color-accent-500)]/30 text-[var(--color-accent-500)] text-xs rounded-full font-bold border border-[var(--color-accent-500)]">
                                    ⭐ LEGENDARY
                                </span>
                            </div>
                            <p class="text-[var(--color-text-200)] text-sm mb-5">Complete season 1-3 collection with exclusive author's notes and original sketches.</p>
                            <div class="grid grid-cols-2 gap-4 border-t border-[var(--color-primary-700)] pt-4">
                                <div>
                                    <p class="text-xs text-[var(--color-text-300)]">Current High Bid</p>
                                    <p class="font-bold text-xl text-[var(--color-text-50)] mt-1 text-glow-accent">2.25 ETH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-[var(--color-text-300)]">Auction Ending In</p>
                                    <p class="font-bold text-xl text-[var(--color-accent-500)] mt-1 text-glow-accent">1d 08h 22m</p>
                                </div>
                            </div>
                              <button class="w-full mt-5 py-3 btn-3d rounded-lg bg-gradient-to-r from-[var(--color-accent-600)] to-[var(--color-accent-500)] text-white font-semibold shadow-md shadow-[var(--color-accent-500)]/30">
                                Place Bid
                            </button>
                        </div>
                    </div>

                    <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl overflow-hidden border border-[var(--color-primary-700)]/40 transition-all duration-500 ease-out hover:shadow-lg hover:shadow-[--shadow-primary-glow] animate-[page-enter_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 2.4s;">
                           <div class="h-56 relative bg-gradient-to-br from-purple-600 to-[var(--color-primary-400)] opacity-90 p-4 flex items-end">
                            
                            <span class="z-10 px-3 py-1 bg-purple-500 text-[var(--color-text-50)] text-xs font-bold rounded-full border border-white/50" style="box-shadow: 0 0 8px var(--color-primary-400);">
                                ANIMATED COVER
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-semibold text-[var(--color-text-50)]">The Breaker: Omnibus</h3>
                                <span class="px-3 py-1 bg-purple-500/30 text-purple-400 text-xs rounded-full font-bold border border-purple-500">
                                    ⚙️ HYBRID NFT
                                </span>
                            </div>
                            <p class="text-[var(--color-text-200)] text-sm mb-5">Complete original series with a dynamic, animated cover NFT and bonus side-story content.</p>
                            <div class="grid grid-cols-2 gap-4 border-t border-[var(--color-primary-700)] pt-4">
                                <div>
                                    <p class="text-xs text-[var(--color-text-300)]">Current High Bid</p>
                                    <p class="font-bold text-xl text-[var(--color-text-50)] mt-1 text-glow-accent">1.89 ETH</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-[var(--color-text-300)]">Auction Ending In</p>
                                    <p class="font-bold text-xl text-[var(--color-accent-500)] mt-1 text-glow-accent">3d 14h 05m</p>
                                </div>
                            </div>
                              <button class="w-full mt-5 py-3 btn-3d rounded-lg bg-gradient-to-r from-[var(--color-accent-600)] to-[var(--color-accent-500)] text-white font-semibold shadow-md shadow-[var(--color-accent-500)]/30">
                                Place Bid
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center py-12 border-t border-[var(--color-primary-700)]/50" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 2.6s; opacity: 0;">
                <p class="text-lg text-[var(--color-text-200)] mb-6">Join our **10,000+ strong** community of passionate collectors and investors</p>
                <div class="flex justify-center items-center space-x-4">
                    <div class="flex -space-x-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] border-4 border-[var(--color-background-900)]" title="Collector 1"></div>
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-accent-500)] to-[var(--color-accent-400)] border-4 border-[var(--color-background-900)]" title="Collector 2"></div>
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-[var(--color-primary-400)] border-4 border-[var(--color-background-900)]" title="Collector 3"></div>
                    </div>
                    <span class="text-[var(--color-text-50)] font-bold text-xl text-glow-accent">10,000+ Collectors</span>
                </div>
            </div>
            
        </main>

        <footer class="bg-[var(--color-background-800)] border-t border-[var(--color-primary-700)]/50 relative z-10">
            <div class="container mx-auto px-6 py-12">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 text-center md:text-left">
                    
                    <div class="col-span-2 lg:col-span-2">
                        <h4 class="text-3xl font-bold mb-3 text-glow-accent">
                            SylvieVerse
                        </h4>
                        <p class="text-sm text-[var(--color-text-300)] max-w-xs mx-auto md:mx-0">
                            The future of digital collecting, powered by the blockchain.
                        </p>
                        <div class="flex mt-4 space-x-4 justify-center md:justify-start">
                            <a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-accent-500)] transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M7.44 2.197c1.767 0 2.973.905 3.336 2.507h.03c.363-1.602 1.569-2.507 3.336-2.507h.03c1.767 0 2.973.905 3.336 2.507h.03c.363-1.602 1.569-2.507 3.336-2.507h.03c1.767 0 2.973.905 3.336 2.507h.03c.363-1.602 1.569-2.507 3.336-2.507h.03c1.767 0 2.973.905 3.336 2.507h.03z"/></svg></a>
                            <a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-accent-500)] transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 6c-1.333.743-2.766 1.246-4.316 1.488 1.532-.914 2.721-2.35 3.275-4.048-1.428.84-3.004 1.455-4.685 1.787-1.346-1.433-3.264-2.327-5.385-2.327-4.06 0-7.35 3.29-7.35 7.35 0 .578.067 1.14.19 1.688C4.54 9.172 2.457 7.086.58 4.965c-.2.34-.316.732-.316 1.155 0 2.548 1.298 4.79 3.275 6.1-1.207-.035-2.348-.367-3.336-.92v.09c0 3.55 2.529 6.505 5.88 7.185-.615.167-1.26.25-1.92.25-.47 0-.93-.045-1.37-.13.93 2.906 3.63 5.035 6.84 5.093-2.43 1.907-5.54 3.05-8.89 3.05-.58 0-1.15-.035-1.71-.102C2.12 21.36 5.89 23 10 23c12 0 18.57-9.93 18.57-18.57 0-.284-.007-.568-.02-.852A13.29 13.29 0 0022 6z"/></svg></a>
                            <a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-accent-500)] transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.323 16.323a.9.9 0 01-.9.9h-1.64c-.496 0-.898-.403-.898-.9v-3.323c0-.496.402-.898.898-.898h1.64c.496 0 .898.402.898.898v3.323zM12 8.323c-1.85 0-3.336 1.486-3.336 3.336s1.486 3.336 3.336 3.336 3.336-1.486 3.336-3.336-1.486-3.336-3.336-3.336z"/></svg></a>
                        </div>
                    </div>

                    <div>
                        <h5 class="text-lg font-semibold text-[var(--color-text-50)] mb-4 border-b border-[var(--color-primary-700)]/20 pb-2">Marketplace</h5>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">All NFTs</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">New Drops</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Top Bids</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Vaulted Editions</a></li>
                        </ul>
                    </div>

                    <div>
                        <h5 class="text-lg font-semibold text-[var(--color-text-50)] mb-4 border-b border-[var(--color-primary-700)]/20 pb-2">Resources</h5>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Help Center</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Smart Contract Audit</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">API Docs</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Whitepaper</a></li>
                        </ul>
                    </div>

                    <div>
                        <h5 class="text-lg font-semibold text-[var(--color-text-50)] mb-4 border-b border-[var(--color-primary-700)]/20 pb-2">Company</h5>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">About Us</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Careers</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-[var(--color-primary-700)]/30 text-center">
                    <p class="text-sm text-[var(--color-text-300)]">&copy; 2025 SylvieVerse. All rights reserved. Blockchain secured.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>