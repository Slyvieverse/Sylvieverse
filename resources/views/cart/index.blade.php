<x-app-layout title="Your Cart">
    <style>
        /* 🚀 Unified Neon Blue & 4K-Style Color Palette */
        :root {
            /* Primary Purple */
            --color-primary-400: #7E57C2; /* Lighter Purple */
            --color-primary-500: #673AB7; /* Main Purple */
            --color-primary-600: #512DA8; /* Deeper Purple */
            --color-primary-700: #311B92; /* Darkest Purple */
            
            /* ✨ Unified Accent Color - Neon Blue Glow */
            --color-accent-blue-400: #4DD0E1; /* Lighter Blue */
            --color-accent-blue-500: #00BCD4; /* Main Neon Blue */
            --color-accent-blue-600: #0097A7; /* Deeper Blue */
            
            /* Danger/Removal Color (Neon Red/Pink) */
            --color-danger-500: #D53F8C; /* Pink/Rose */
            --color-danger-400: #ED64A6;
            
            /* Base Dark Theme (Default) */
            --color-background-700: #1C1917; /* Slate Black */
            --color-background-800: #100C09; /* Near Black */
            --color-background-900: #0D0A08; /* Abyss Black */
            --color-text-50: #EFEFEF; /* Bright White */
            --color-text-200: #A0AEC0; /* Slate Gray */
            --color-text-300: #718096;

            /* Shadows & Effects */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500);
            --shadow-accent-blue-glow: 0 0 10px var(--color-accent-blue-500);
            --shadow-tech-box: 0 0 15px rgba(49, 27, 146, 0.6); 
            
            /* Typography */
            --font-heading: 'Exo 2', sans-serif; 
        }

        /* 🌙 Dark Mode Overrides */
        .dark {
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
            --color-text-accent: var(--color-accent-blue-400);
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
            --color-text-accent: var(--color-primary-600);
            /* Shadows */
            --shadow-tech-box: 0 4px 15px rgba(0, 0, 0, 0.1); 
        }

        /* Standard Entrance Animation */
        @keyframes page-enter {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse-glow {
            0% { box-shadow: 0 0 15px rgba(126, 87, 194, 0.2); }
            50% { box-shadow: 0 0 30px rgba(126, 87, 194, 0.4); }
            100% { box-shadow: 0 0 15px rgba(126, 87, 194, 0.2); }
        }

        /* Technical Cart Box Styling */
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

        /* Cart Item Styling */
        .cart-item {
            border-bottom: 1px solid var(--color-primary-700)/30;
            transition: background-color 0.3s ease;
        }
        .cart-item:hover {
            background-color: var(--color-background-700)/20;
        }

        /* Checkout Button Styling (Purple Enhanced) */
        .btn-checkout {
            background-image: linear-gradient(to right, var(--color-primary-600), var(--color-primary-500));
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), 0 0 20px var(--color-primary-500);
            transition: all 0.3s ease-out;
            font-weight: 700;
        }
        .btn-checkout:hover {
            background-image: linear-gradient(to right, var(--color-primary-500), var(--color-primary-400));
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5), 0 0 30px var(--color-primary-400);
            transform: translateY(-2px);
        }
        .light .btn-checkout {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-weight: 600;
        }
        .light .btn-checkout:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }
        
        /* Update/Quantity Input Styling */
        .quantity-input {
            background-color: var(--color-background-700);
            border: 1px solid var(--color-accent-blue-600);
            color: var(--color-text-50);
            text-align: center;
            transition: all 0.3s;
        }
        .quantity-input:focus {
            border-color: var(--color-accent-blue-400);
            box-shadow: 0 0 5px var(--color-accent-blue-500)/50;
        }

        /* Update Button Styling */
        .btn-update {
            color: var(--color-accent-blue-400);
            border: 1px solid var(--color-accent-blue-600);
            transition: all 0.3s;
        }
        .btn-update:hover {
            color: var(--color-text-50);
            background-color: var(--color-accent-blue-600);
            border-color: var(--color-accent-blue-600);
        }

        /* Remove Button Styling */
        .btn-remove {
            color: var(--color-danger-500);
        }
        .btn-remove:hover {
            color: var(--color-danger-400);
            transform: scale(1.05);
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
    
    <div class="min-h-screen relative overflow-hidden bg-[var(--color-background-900)] text-[var(--color-text-50)] py-12 transition-colors duration-500" style="font-family: var(--font-heading);">
        <div class="absolute inset-0 bg-radial-gradient-primary dark:opacity-20 light:opacity-50 dark:animate-[pulse-glow_4s_infinite] transition-opacity duration-500"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex justify-between items-center mb-12" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-4xl font-heading font-extrabold text-[var(--color-text-50)]">
                    <span class="bg-gradient-to-r from-[var(--color-accent-blue-400)] to-[var(--color-primary-400)] bg-clip-text text-transparent">ACCESS MATRIX</span>
                </h1>
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[var(--color-background-800)] border border-[var(--color-primary-700)] hover:border-[var(--color-accent-blue-500)] transition-all shadow-md">
                    <svg class="h-6 w-6 text-[var(--color-text-200)] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg class="h-6 w-6 text-[var(--color-text-200)] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>

            @if(session('success'))
                <div class="bg-[var(--color-accent-blue-600)]/20 text-[var(--color-text-50)] p-4 rounded-lg mb-6 border border-[var(--color-accent-blue-600)] shadow-lg"
                    style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;">
                    <p class="font-medium flex items-center">
                        <svg class="h-5 w-5 mr-2 text-[var(--color-accent-blue-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @if($cart->items->isEmpty())
                <div class="flex flex-col items-center justify-center text-center mt-24 tech-box rounded-xl p-12 max-w-lg mx-auto" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-[var(--color-accent-blue-500)] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9-9h16l-1 9H5L3 4z" />
                    </svg>
                    <p class="text-xl text-[var(--color-text-200)] font-medium mb-6">Your access queue is empty. Initialize primary objective.</p>
                    <a href="{{ route('catalog') }}" class="px-8 py-3 rounded-lg btn-checkout text-[var(--color-text-50)] transition-all">
                        Locate Assets
                    </a>
                </div>
            @else
                <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                    <div class="lg:col-span-2">
                        <div class="tech-box rounded-xl p-6 md:p-8">
                            <h2 class="text-2xl font-heading font-semibold mb-6 text-[var(--color-text-50)] border-b pb-3 border-[var(--color-primary-700)]/50">Items for Acquisition ({{ $cart->items->count() }})</h2>
                            
                            @foreach($cart->items as $item)
                                <div 
                                    class="cart-item flex flex-col sm:flex-row items-start sm:items-center justify-between py-4 last:border-b-0"
                                    style="animation: page-enter 0.5s ease-out forwards; animation-delay: {{ 0.2 + $loop->index * 0.1 }}s; opacity: 0;"
                                >
                                    <div class="flex items-center mb-4 sm:mb-0 w-full sm:w-1/2">
                                        <div class="w-16 h-16 flex-shrink-0 bg-[var(--color-background-700)] rounded-lg mr-4 border border-[var(--color-accent-blue-600)]/30 flex items-center justify-center">
                                            <svg class="h-8 w-8 text-[var(--color-accent-blue-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                                        </div>
                                        <div>
                                            <h3 class="text-[var(--color-text-50)] font-heading font-semibold text-lg">{{ $item->product->name }}</h3>
                                            <p class="text-[var(--color-text-300)] text-sm">Unit Cost: <span class="text-[var(--color-text-accent)]">${{ number_format($item->product->price, 2) }}</span></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4 w-full sm:w-auto justify-end">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                            @csrf @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" class="quantity-input w-16 p-2 rounded-lg focus:outline-none text-sm">
                                            <button type="submit" class="ml-2 px-3 py-2 rounded-lg btn-update transition-colors font-medium text-sm">Update</button>
                                        </form>
                                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-full btn-remove transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.035 21H7.965a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            
                            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center text-[var(--color-text-200)] hover:text-[var(--color-accent-blue-400)] transition-colors text-sm font-medium">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                                Continue Browsing Assets
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-1 mt-8 lg:mt-0">
                        <div class="tech-box rounded-xl p-6 md:p-8" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                            <h2 class="text-2xl font-heading font-semibold mb-6 text-[var(--color-text-50)] border-b pb-3 border-[var(--color-primary-700)]/50">Summary Report</h2>
                            
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-[var(--color-text-200)]">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($cart->subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-[var(--color-text-200)]">
                                    <span>Shipping Estimate (Digital):</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="flex justify-between text-2xl font-heading font-bold pt-4 border-t border-[var(--color-primary-700)]/50">
                                    <span class="text-[var(--color-text-50)]">TOTAL ACQUISITION COST:</span>
                                    <span class="text-[var(--color-accent-blue-400)]">${{ number_format($cart->subtotal, 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="w-full text-center btn-checkout text-[var(--color-text-50)] font-heading font-bold py-4 px-8 rounded-lg transition-all block">
                                Initiate Checkout Protocol
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>