<x-app-layout title="Order Confirmation">
    <style>
        /* 🚀 Unified Neon Blue & 4K-Style Color Palette */
        :root {
            /* Primary Purple */
            --color-primary-400: #7E57C2; /* Lighter Purple */
            --color-primary-500: #673AB7; /* Main Purple */
            --color-primary-600: #512DA8; /* Deeper Purple */
            --color-primary-700: #311B92; /* Darkest Purple */

            /* ✨ Unified Accent Color - Neon Blue Glow */
            --color-accent-blue-500: #00BCD4; /* Main Neon Blue */
            --color-accent-blue-400: #4DD0E1; /* Lighter Blue */
            --color-accent-blue-600: #0097A7; /* Deeper Blue */

            /* Success Color */
            --color-success-400: #68D391; /* Light Green */
            --color-success-500: #48BB78; /* Main Green */

            /* Base Dark Theme (Default) */
            --color-background-700: #1C1917; /* Slate Black */
            --color-background-800: #100C09; /* Near Black */
            --color-background-900: #0D0A08; /* Abyss Black */
            --color-text-50: #EFEFEF; /* Bright White */
            --color-text-200: #A0AEC0; /* Slate Gray */
            --color-text-300: #718096;

            /* Shadows & Effects */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-blue-glow: 0 0 10px var(--color-accent-blue-500), 0 0 20px var(--color-accent-blue-400);
            --shadow-success-glow: 0 0 10px var(--color-success-500), 0 0 20px var(--color-success-400);
            --shadow-tech-box: 0 0 15px rgba(49, 27, 146, 0.6); /* Dark purple base shadow */

            /* Typography */
            --font-heading: 'Exo 2', sans-serif;
        }

        /* 🌙 Dark Mode Overrides */
        .dark {
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
        }

        /* ☀️ Light Mode Overrides */
        .light {
            /* Backgrounds */
            --color-background-900: #F7FAFC; /* Near White */
            --color-background-800: #FFFFFF; /* White */
            --color-background-700: #EDF2F7; /* Light Gray */
            /* Text */
            --color-text-50: #1A202C; /* Dark text */
            --color-text-200: #4A5568;
            --color-text-300: #718096;
            /* Shadows */
            --shadow-tech-box: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Success Icon Animation (Green glow retained for clarity) */
        @keyframes success-icon {
            0% { transform: scale(0.5) rotate(-30deg); opacity: 0; box-shadow: 0 0 0 var(--color-success-500); }
            60% { transform: scale(1.1) rotate(0deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); box-shadow: var(--shadow-success-glow); }
        }

        /* Standard Entrance Animation */
        @keyframes page-enter {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Card/Box Styling */
        .tech-box {
            background-color: var(--color-background-800)/50;
            backdrop-filter: blur(8px);
            box-shadow: var(--shadow-tech-box);
            transition: all 0.4s ease-in-out;
            border: 1px solid var(--color-primary-700);
        }
        .light .tech-box {
             border: 1px solid var(--color-background-700);
        }

        /* Primary Purple Button Enhancement */
        .btn-primary-enhanced {
            background-image: linear-gradient(to right, var(--color-primary-600), var(--color-primary-500));
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), 0 0 20px var(--color-primary-500);
            transition: all 0.3s ease-out;
            font-weight: 700;
        }
        .btn-primary-enhanced:hover {
            background-image: linear-gradient(to right, var(--color-primary-500), var(--color-primary-400));
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5), 0 0 30px var(--color-primary-400);
            transform: translateY(-2px);
        }
        .light .btn-primary-enhanced {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }
        .light .btn-primary-enhanced:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        /* Secondary Button Style */
        .btn-secondary-tech {
            background-color: var(--color-background-700);
            border: 1px solid var(--color-accent-blue-600);
            box-shadow: 0 0 10px var(--color-accent-blue-600)/20;
        }
        .light .btn-secondary-tech {
            background-color: var(--color-background-800);
            border: 1px solid var(--color-accent-blue-400);
        }
        .btn-secondary-tech:hover {
            border-color: var(--color-accent-blue-400);
            transform: translateY(-1px);
        }

    </style>

    <script>
        // Theme logic retained for consistency
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'light') {
            document.documentElement.classList.add('light');
        } else if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.add('dark'); // Default to dark
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
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

    <div class="min-h-screen relative overflow-hidden bg-[var(--color-background-900)] text-[var(--color-text-50)] py-12 transition-colors duration-500 flex items-center justify-center" style="font-family: var(--font-heading);">
        <div class="absolute inset-0 bg-radial-gradient-primary dark:opacity-20 light:opacity-50 dark:animate-[pulse-glow_4s_infinite] transition-opacity duration-500"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex justify-end mb-8 absolute top-6 right-6">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[var(--color-background-800)] border border-[var(--color-primary-700)] hover:border-[var(--color-accent-blue-500)] transition-all shadow-md">
                    <svg class="h-6 w-6 text-[var(--color-text-200)] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg class="h-6 w-6 text-[var(--color-text-200)] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>

            <div class="flex justify-center items-center">
                <div class="tech-box rounded-xl p-8 md:p-12 text-center max-w-xl w-full"
                    style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;"
                >
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full bg-gradient-to-br from-[var(--color-success-400)] to-[var(--color-success-500)]"
                        style="animation: success-icon 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.4s forwards; opacity: 0;"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-[var(--color-text-50)] mb-4"
                        style="animation: page-enter 0.5s ease-out 0.8s forwards; opacity: 0;"
                    >
                        <span class="bg-gradient-to-r from-[var(--color-accent-blue-400)] to-[var(--color-accent-blue-500)] bg-clip-text text-transparent">ORDER CONFIRMED</span>
                    </h1>

                    <p class="text-[var(--color-text-200)] text-lg mb-6"
                        style="animation: page-enter 0.5s ease-out 1s forwards; opacity: 0;"
                    >
                        Thank you for securing your digital assets. Your transaction is verified on the network.
                    </p>

                    <div class="mb-8"
                        style="animation: page-enter 0.5s ease-out 1.2s forwards; opacity: 0;"
                    >
                        <div class="bg-[var(--color-background-700)] rounded-lg p-4 mb-4 border border-[var(--color-accent-blue-600)]/30 text-left shadow-inner dark:shadow-none">
                            <div class="flex justify-between items-center mb-2">
                                <h2 class="text-xl font-heading text-[var(--color-text-50)] font-bold">Order ID:</h2>
                                <span class="text-xl font-medium text-neon-accent">#{{ $order->id }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-4 border-b border-[var(--color-primary-700)]/30 pb-2">
                                <p class="text-[var(--color-text-300)]">Total Paid:</p>
                                <span class="text-3xl font-bold text-neon-accent">${{ number_format($order->total_amount, 2) }}</span>
                            </div>

                            <h3 class="text-lg font-heading text-[var(--color-text-50)] font-bold mb-2">Assets Purchased:</h3>
                            <ul class="text-[var(--color-text-200)] space-y-1 text-sm">
                                @foreach($order->orderItems as $item)
                                    <li class="flex justify-between">
                                        <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span class="font-mono text-xs text-[var(--color-text-300)]">@ ${{ number_format($item->price_at_purchase, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center gap-4"
                        style="animation: page-enter 0.5s ease-out 1.4s forwards; opacity: 0;"
                    >
                        <a href="{{ route('user.orders.index') }}" class="px-8 py-4 rounded-lg btn-primary-enhanced text-[var(--color-text-50)] font-bold text-lg">
                            Access Your Orders
                        </a>
                        <a href="{{ route('catalog') }}" class="px-8 py-4 rounded-lg btn-secondary-tech text-[var(--color-text-50)] font-medium text-lg transition-all">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
