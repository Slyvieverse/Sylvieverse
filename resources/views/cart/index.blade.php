<x-app-layout title="Your Cart">
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
    
    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] py-12 transition-colors duration-300">
        <!-- Glowing background effect -->
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-30 animate-[pulse-glow_4s_infinite] transition-opacity duration-300"></div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Header and Theme Toggle -->
            <div class="flex justify-between items-center mb-12" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-4xl font-heading font-bold text-[--color-text-50]">
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent">Your Cart</span>
                </h1>
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] hover:border-[--color-primary-500] transition-all">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            @if(session('success'))
                <div class="bg-[--color-primary-600]/20 text-[--color-text-50] p-4 rounded-lg mb-6 border border-[--color-primary-700]/50 shadow-md"
                    style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;">
                    {{ session('success') }}
                </div>
            @endif

            @if($cart->items->isEmpty())
                <div class="flex flex-col items-center justify-center text-center mt-24" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-[--color-text-300] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.182 1.761.704 1.761H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-xl text-[--color-text-300] font-medium">Your cart is empty.</p>
                    <a href="{{ route('catalog') }}" class="mt-6 px-8 py-4 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium text-lg transition-all shadow-lg shadow-[--color-primary-600]/20 hover:shadow-[--color-primary-500]/30">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 md:p-8"
                    style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                    @foreach($cart->items as $item)
                        <div 
                            class="flex flex-col sm:flex-row items-start sm:items-center justify-between py-4 border-b border-[--color-primary-700]/30 last:border-b-0"
                            style="animation: page-enter 0.5s ease-out forwards; animation-delay: {{ $loop->index * 0.1 }}s; opacity: 0;"
                        >
                            <div class="flex items-center mb-4 sm:mb-0">
                                <img src="{{ $item->product->image_url ? asset('storage/' . $item->product->image_url) : asset('images/default-product.png') }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg mr-4 border border-[--color-primary-700]/30 shadow-md">
                                <div>
                                    <h3 class="text-[--color-text-50] font-heading font-semibold text-lg">{{ $item->product->name }}</h3>
                                    <p class="text-[--color-text-300]">${{ number_format($item->product->price, 2) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-16 p-2 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-colors">
                                    <button type="submit" class="ml-2 px-4 py-2 rounded-lg text-[--color-primary-400] border border-[--color-primary-700] hover:border-[--color-primary-500] hover:text-[--color-primary-500] transition-colors font-medium">Update</button>
                                </form>
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-[--color-accent-500] hover:text-[--color-primary-600] transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.035 21H7.965a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-between">
                        <span class="text-2xl font-heading font-bold text-[--color-text-50] mb-4 sm:mb-0">Total: ${{ number_format($cart->subtotal, 2) }}</span>
                        <a href="{{ route('checkout.index') }}" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-heading font-bold py-4 px-8 rounded-lg shadow-md shadow-[--color-primary-500]/30 hover:shadow-lg transition-all">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>