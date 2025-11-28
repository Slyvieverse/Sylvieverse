<x-app-layout title="Your Cart">
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
            --color-danger-500: #D53F8C;
            --color-danger-400: #ED64A6;
            --color-success-500: #48BB78;
            --color-success-400: #68D391;
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0D0A08;
            --color-text-50: #EFEFEF;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
            --shadow-danger-glow: 0 0 10px var(--color-danger-500), 0 0 20px var(--color-danger-400);
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

        /* Success Animation */
        @keyframes success-pulse {
            0%, 100% {
                background: linear-gradient(135deg, var(--color-success-500), var(--color-success-400));
                box-shadow: 0 0 15px var(--color-success-400);
            }
            50% {
                background: linear-gradient(135deg, var(--color-success-400), var(--color-success-500));
                box-shadow: 0 0 25px var(--color-success-500);
            }
        }

        .success-badge {
            animation: success-pulse 2s ease-in-out infinite;
        }

        /* Discount Badge Animation */
        @keyframes discount-pulse {
            0%, 100% {
                background: linear-gradient(135deg, var(--color-danger-500), var(--color-danger-400));
                box-shadow: 0 0 10px var(--color-danger-400);
            }
            50% {
                background: linear-gradient(135deg, var(--color-danger-400), var(--color-danger-500));
                box-shadow: 0 0 20px var(--color-danger-500);
            }
        }

        .discount-badge {
            animation: discount-pulse 1.5s ease-in-out infinite;
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

        // Quantity update handlers
        function updateQuantity(itemId, change) {
            const input = document.getElementById(`quantity-${itemId}`);
            const currentValue = parseInt(input.value);
            const newValue = currentValue + change;
            const maxQuantity = parseInt(input.getAttribute('max'));

            if (newValue >= 1 && newValue <= maxQuantity) {
                input.value = newValue;
                // Auto-submit the form
                input.closest('form').submit();
            }
        }
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans" style="font-family: var(--font-heading);">

        <!-- Background Elements -->
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <div class="container mx-auto px-6 py-12 relative z-10">

            <!-- Theme Toggle -->
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
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                        Your Collection
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[--color-text-200] mb-12 max-w-4xl mx-auto font-light">
                    Manage your digital treasures and prepare for acquisition in the SylvieVerse marketplace.
                </p>
            </div>

            @if(session('success'))
                <div class="max-w-4xl mx-auto mb-8 success-badge text-white p-6 rounded-2xl border border-[--color-success-400] backdrop-blur-md"
                    style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;">
                    <p class="font-medium flex items-center justify-center gap-3 text-lg">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @if($cart->items->isEmpty())
                <!-- Enhanced Empty State -->
                <div class="max-w-2xl mx-auto text-center" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-12 border border-[--color-primary-700]/30">
                        <div class="w-32 h-32 mx-auto mb-8 rounded-full bg-gradient-to-br from-[--color-primary-600] to-[--color-accent-500] flex items-center justify-center shadow-2xl">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-3.5m-9 0H4" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-[--color-text-50] mb-4">Your Collection is Empty</h3>
                        <p class="text-[--color-text-200] text-lg mb-8">Begin your journey by exploring rare digital collectibles in the SylvieVerse marketplace.</p>
                        <a href="{{ route('catalog') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-white font-bold px-10 py-4 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 btn-3d">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Explore Digital Treasures
                        </a>
                    </div>
                </div>
            @else
                <div class="grid lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-3xl font-bold text-[--color-text-50]">
                                    Collection Items
                                    <span class="text-[--color-accent-400] ml-3">({{ $cart->items->count() }})</span>
                                </h2>
                                <div class="bg-[--color-accent-600]/20 text-[--color-accent-400] px-4 py-2 rounded-xl border border-[--color-accent-600]/50">
                                    Active Items
                                </div>
                            </div>

                            <div class="space-y-6">
                                @foreach($cart->items as $item)
                                    <div class="card-3d bg-[--color-background-700]/50 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700]/20 transition-all duration-500 hover:border-[--color-accent-500]/30"
                                         style="animation: page-enter 0.5s ease-out forwards; animation-delay: {{ 0.3 + $loop->index * 0.1 }}s; opacity: 0;">
                                        <div class="flex flex-col md:flex-row gap-6 items-start">
                                            <!-- Product Image -->
                                            <div class="w-24 h-24 flex-shrink-0 rounded-xl bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] flex items-center justify-center shadow-lg relative">
                                                @if($item->product->has_discount)
                                                    <div class="absolute -top-2 -right-2 discount-badge text-white px-2 py-1 rounded-full text-xs font-bold">
                                                        -{{ $item->product->discount_percent }}%
                                                    </div>
                                                @endif
                                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                </svg>
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-xl font-bold text-[--color-text-50] mb-2 line-clamp-2">
                                                    {{ $item->product->name }}
                                                </h3>
                                                <p class="text-[--color-text-200] text-sm mb-4">
                                                    {{ $item->product->category->name ?? 'Digital Collectible' }}
                                                </p>

                                                <!-- Price Display -->
                                                <div class="flex items-center gap-4 mb-4">
                                                    @if($item->product->has_discount)
                                                        <div class="flex items-center gap-3">
                                                            <span class="text-2xl font-bold text-[--color-success-400] text-glow-accent">
                                                                ${{ number_format($item->product->final_price * $item->quantity, 2) }}
                                                            </span>
                                                            <span class="text-lg text-[--color-text-300] line-through">
                                                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <span class="text-2xl font-bold text-[--color-accent-400] text-glow-accent">
                                                            ${{ number_format($item->product->price * $item->quantity, 2) }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- Quantity Controls -->
                                                <div class="flex items-center gap-4">
                                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-3">
                                                        @csrf @method('PATCH')
                                                        <label class="text-[--color-text-200] text-sm font-medium">Quantity:</label>
                                                        <div class="flex items-center gap-2">
                                                            <button type="button" onclick="updateQuantity({{ $item->id }}, -1)" class="w-8 h-8 bg-[--color-background-800] border border-[--color-accent-600] text-[--color-accent-400] rounded-lg flex items-center justify-center hover:bg-[--color-accent-600] hover:text-white transition-all">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                                </svg>
                                                            </button>
                                                            <input type="number" id="quantity-{{ $item->id }}" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}"
                                                                   class="w-16 bg-[--color-background-800] border border-[--color-accent-600] text-[--color-text-50] px-3 py-2 rounded-lg text-center focus:border-[--color-accent-400] focus:outline-none transition-all">
                                                            <button type="button" onclick="updateQuantity({{ $item->id }}, 1)" class="w-8 h-8 bg-[--color-background-800] border border-[--color-accent-600] text-[--color-accent-400] rounded-lg flex items-center justify-center hover:bg-[--color-accent-600] hover:text-white transition-all">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <button type="submit" class="bg-[--color-accent-600] hover:bg-[--color-accent-500] text-white px-4 py-2 rounded-lg transition-all duration-300 btn-3d text-sm font-medium hidden">
                                                            Update
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-3 bg-[--color-danger-500]/20 hover:bg-[--color-danger-500]/30 text-[--color-danger-400] rounded-xl transition-all duration-300 border border-[--color-danger-500]/30 hover:border-[--color-danger-400] btn-3d" title="Remove from collection">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.035 21H7.965a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Continue Shopping -->
                            <div class="mt-8 pt-6 border-t border-[--color-primary-700]/30">
                                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 text-[--color-text-200] hover:text-[--color-accent-400] transition-colors duration-300 font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Continue Exploring Digital Treasures
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30 sticky top-8">
                            <h3 class="text-2xl font-bold text-[--color-text-50] mb-6">Order Summary</h3>

                            @php
                                $subtotal = $cart->items->sum(fn($i) => $i->quantity * $i->product->final_price);
                                $totalSaved = $cart->items->sum(fn($i) => $i->quantity * $i->product->discount_amount);
                            @endphp

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-[--color-text-200]">Subtotal</span>
                                    <span class="text-xl font-bold text-[--color-text-50]">${{ number_format($subtotal, 2) }}</span>
                                </div>

                                @if($totalSaved > 0)
                                    <div class="flex justify-between items-center">
                                        <span class="text-[--color-success-400]">Total Saved</span>
                                        <span class="text-xl font-bold text-[--color-success-400]">-${{ number_format($totalSaved, 2) }}</span>
                                    </div>
                                @endif

                                <div class="border-t border-[--color-primary-700]/30 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-bold text-[--color-text-50]">Total</span>
                                        <span class="text-2xl font-bold text-[--color-accent-400] text-glow-accent">${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <form action="{{ route('checkout.index') }}" method="GET">
                                <button type="submit" class="w-full bg-gradient-to-r from-[--color-primary-600] to-[--color-accent-600] hover:from-[--color-primary-500] hover:to-[--color-accent-500] text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 btn-3d flex items-center justify-center gap-3 text-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Proceed to Checkout
                                </button>
                            </form>

                            <!-- Security Badge -->
                            <div class="mt-6 p-4 bg-[--color-accent-600]/10 rounded-xl border border-[--color-accent-600]/30 text-center">
                                <div class="flex items-center justify-center gap-2 text-[--color-accent-400] text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Secure Blockchain Transaction
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-submit form when quantity changes
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('input[name="quantity"]');

            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            });
        });
    </script>
</x-app-layout>
