<x-app-layout title="Checkout Success">
<div class="min-h-screen bg-gradient-to-br from-background-900 to-background-800 flex items-center justify-center">
    <div class="bg-background-800/70 backdrop-blur-sm border border-primary-700 rounded-xl p-8 text-center max-w-md">
        <h1 class="text-3xl font-heading text-text-50 mb-4">Payment Successful!</h1>
        <p class="text-text-300 mb-4">Order #{{ $order->id }} confirmed. Total: ${{ number_format($order->total_amount, 2) }}</p>
        <a href="{{ route('checkout.index') }}" class="bg-primary-600 text-text-50 px-6 py-3 rounded-lg">View Orders</a>

    </div>
</div>
</x-app-layout><x-app-layout title="Payment Success">
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
        
        /* Keyframe for the success icon */
        @keyframes success-icon {
            0% { transform: scale(0.5); opacity: 0; filter: drop-shadow(0 0 0 rgba(0, 255, 0, 0)); }
            80% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); filter: drop-shadow(0 0 10px rgba(0, 255, 0, 0.5)); }
        }
    </style>
    
    <script>
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
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

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] py-12 transition-colors duration-300 flex items-center justify-center">
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-30 animate-[pulse-glow_4s_infinite] transition-opacity duration-300"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex justify-end mb-8 absolute top-6 right-6">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] hover:border-[--color-primary-500] transition-all">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
            
            <div class="flex justify-center items-center h-full">
                <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-8 md:p-12 text-center max-w-xl w-full"
                    style="animation: page-enter 0.5s ease-out forwards; opacity: 0;"
                >
                    <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full bg-gradient-to-br from-green-400 to-green-600 shadow-lg"
                        style="animation: success-icon 0.6s ease-out 0.4s forwards; opacity: 0;"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-[--color-text-50] mb-4"
                        style="animation: page-enter 0.5s ease-out 0.8s forwards; opacity: 0;"
                    >
                        <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent">Payment Successful!</span>
                    </h1>

                    <p class="text-[--color-text-200] text-lg mb-6"
                        style="animation: page-enter 0.5s ease-out 1s forwards; opacity: 0;"
                    >
                        Thank you for your purchase. Your order has been confirmed and is now ready.
                    </p>

                    <div class="mb-8"
                        style="animation: page-enter 0.5s ease-out 1.2s forwards; opacity: 0;"
                    >
                        <div class="bg-[--color-background-700] rounded-lg p-4 mb-4 border border-[--color-primary-700]/30">
                            <h2 class="text-xl font-heading text-[--color-text-50] font-bold mb-2">Order #{{ $order->id }}</h2>
                            <p class="text-[--color-text-300] mb-2">Total Paid: <span class="text-[--color-text-50] font-medium">${{ number_format($order->total_amount, 2) }}</span></p>
                            
                            <hr class="border-t border-[--color-primary-700]/30 my-4">
                            
                            <h3 class="text-lg font-heading text-[--color-text-50] font-bold mb-2">Items Purchased:</h3>
                            <ul class="list-disc list-inside text-left text-[--color-text-200]">
                                @foreach($order->orderItems as $item)
                                    <li>{{ $item->product->name }} (x{{ $item->quantity }}) - ${{ $item->price_at_purchase }} each</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4"
                        style="animation: page-enter 0.5s ease-out 1.4s forwards; opacity: 0;"
                    >
                        <a href="{{ route('checkout.index') }}" class="px-8 py-4 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-bold text-lg transition-all shadow-lg shadow-[--color-primary-600]/20 hover:shadow-[--color-primary-500]/30">
                            Download Your Items
                        </a>
                        <a href="{{ route('catalog') }}" class="px-8 py-4 rounded-lg bg-[--color-background-700] hover:bg-[--color-background-800] border border-[--color-primary-700] text-[--color-text-50] font-medium text-lg transition-all">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>