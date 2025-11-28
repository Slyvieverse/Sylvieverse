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
            --color-success-500: #48BB78;
            --color-success-400: #68D391;
            --color-warning-500: #ED8936;
            --color-warning-400: #F6AD55;
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0D0A08;
            --color-text-50: #EFEFEF;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
            --shadow-success-glow: 0 0 10px var(--color-success-500), 0 0 20px var(--color-success-400);
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

        /* Status Badge Animations */
        @keyframes status-pulse {
            0%, 100% {
                box-shadow: 0 0 10px currentColor;
            }
            50% {
                box-shadow: 0 0 20px currentColor;
            }
        }

        .status-completed {
            color: var(--color-success-400);
            animation: status-pulse 2s ease-in-out infinite;
        }

        .status-processing {
            color: var(--color-accent-400);
            animation: status-pulse 1.5s ease-in-out infinite;
        }

        .status-pending {
            color: var(--color-warning-400);
            animation: status-pulse 2s ease-in-out infinite;
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

            <!-- Theme Toggle -->
            <div class="absolute top-8 right-6 z-20" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] dark:hover:border-[--color-accent-500] light:hover:border-[--color-accent-500] transition-all" title="Toggle Theme">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:block light:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:hidden light:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <div class="mb-8" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.2s; opacity: 0;">
                <a href="{{ route('user.orders.index') }}" class="inline-flex items-center gap-2 text-[--color-text-200] hover:text-[--color-accent-400] transition-colors duration-300 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Orders
                </a>
            </div>

            <!-- Enhanced Header -->
            <div class="max-w-6xl mx-auto text-center mb-12" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.3s; opacity: 0;">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight leading-tight">
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                        Order Details
                    </span>
                </h1>
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700]/30 inline-block">
                    <p class="text-2xl font-bold text-[--color-text-50]">
                        Order #<span class="text-[--color-accent-400]">{{ $order->id }}</span>
                    </p>
                </div>
            </div>

            <div class="max-w-6xl mx-auto grid lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Order Status Card -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.4s; opacity: 0;">
                        <h2 class="text-2xl font-bold text-[--color-text-50] mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Order Status
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-[--color-text-200]">Order Status</span>
                                    <span class="font-bold status-{{ $order->status }} px-3 py-1 rounded-full text-sm">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[--color-text-200]">Payment Status</span>
                                    <span class="font-bold text-[--color-success-400] px-3 py-1 rounded-full text-sm">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[--color-text-200]">Payment Method</span>
                                    <span class="font-bold text-[--color-text-50]">{{ ucfirst($order->payment_gateway) }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-[--color-text-200]">Order Date</span>
                                    <span class="font-bold text-[--color-text-50]">{{ $order->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[--color-text-200]">Total Amount</span>
                                    <span class="text-2xl font-bold text-[--color-accent-400] text-glow-accent">${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.5s; opacity: 0;">
                        <h2 class="text-2xl font-bold text-[--color-text-50] mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Order Items
                        </h2>

                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <div class="bg-[--color-background-700]/50 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700]/20 transition-all duration-300 hover:border-[--color-accent-500]/30">
                                    <div class="flex flex-col md:flex-row gap-6 items-start">
                                        <!-- Product Image -->
                                        <div class="w-20 h-20 flex-shrink-0 rounded-xl bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] flex items-center justify-center shadow-lg">
                                            <img src="{{ $item->product->image_url ? asset('storage/' . $item->product->image_url) : asset('images/default-product.png') }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="w-16 h-16 object-cover rounded-lg">
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-xl font-bold text-[--color-text-50] mb-2">{{ $item->product->name }}</h3>
                                            <p class="text-[--color-text-200] text-sm mb-4">
                                                {{ $item->product->category->name ?? 'Digital Collectible' }}
                                            </p>

                                            <div class="flex flex-wrap gap-6 items-center">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[--color-text-200] text-sm">Quantity:</span>
                                                    <span class="font-bold text-[--color-text-50]">{{ $item->quantity }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[--color-text-200] text-sm">Unit Price:</span>
                                                    <span class="font-bold text-[--color-accent-400]">${{ number_format($item->price_at_purchase, 2) }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[--color-text-200] text-sm">Total:</span>
                                                    <span class="text-lg font-bold text-[--color-success-400]">${{ number_format($item->quantity * $item->price_at_purchase, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Information Sidebar -->
                <div class="space-y-8">
                    <!-- Shipping Information -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30 sticky top-8" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.6s; opacity: 0;">
                        <h3 class="text-2xl font-bold text-[--color-text-50] mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Shipping Information
                        </h3>

                        <div class="space-y-4">
                            <div class="p-4 bg-[--color-background-700]/30 rounded-xl border border-[--color-primary-700]/20">
                                <p class="text-[--color-text-50] font-medium">{{ $order->shipping_address }}</p>
                            </div>

                            <!-- Tracking Information (if available) -->
                            <div class="mt-6 p-4 bg-[--color-accent-600]/10 rounded-xl border border-[--color-accent-600]/30">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.01 12.01 0 002.944 12c.078 2.372.33 4.717.756 7.042l-1.163-.116a1 1 0 01-.941-1.352L1.8 14.16a1 1 0 01.325-1.026l1.246-1.12c.5-.45.548-1.17.115-1.67a1 1 0 01-.115-1.464L4.8 7.37a1 1 0 011.026-.325l1.12-1.246c.45-.5.17-1.67-.354-2.188A10.95 10.95 0 0012 3z" />
                                    </svg>
                                    <span class="text-[--color-accent-400] text-sm font-medium">Digital Delivery</span>
                                </div>
                                <p class="text-[--color-text-200] text-sm mt-2">Your digital assets are available for immediate download.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.7s; opacity: 0;">
                        <h3 class="text-2xl font-bold text-[--color-text-50] mb-6">Quick Actions</h3>

                        <div class="space-y-4">
                            <button class="w-full bg-[--color-accent-600] hover:bg-[--color-accent-500] text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download Invoice
                            </button>

                            <button class="w-full bg-[--color-primary-600] hover:bg-[--color-primary-500] text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Contact Support
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
