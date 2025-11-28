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

        /* Step Animation */
        @keyframes step-pulse {
            0%, 100% {
                background: linear-gradient(135deg, var(--color-accent-500), var(--color-accent-400));
                box-shadow: 0 0 15px var(--color-accent-400);
            }
            50% {
                background: linear-gradient(135deg, var(--color-accent-400), var(--color-accent-500));
                box-shadow: 0 0 25px var(--color-accent-500);
            }
        }

        .step-active {
            animation: step-pulse 2s ease-in-out infinite;
        }

        /* Input Field Styling */
        .input-tech {
            background: var(--color-background-800);
            border: 1px solid var(--color-primary-700);
            transition: all 0.3s ease;
            color: var(--color-text-50);
        }

        .input-tech:focus {
            border-color: var(--color-accent-500);
            box-shadow: 0 0 0 3px var(--color-accent-500)/20, 0 0 15px var(--color-accent-500)/30;
            background: var(--color-background-700);
        }

        /* Loading Animation */
        @keyframes loading-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-spinner {
            animation: loading-spin 1s linear infinite;
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
                        Secure Checkout
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[--color-text-200] mb-12 max-w-4xl mx-auto font-light">
                    Complete your acquisition with blockchain-secured payment in the SylvieVerse marketplace.
                </p>
            </div>

            <!-- Enhanced Progress Steps -->
            <div class="max-w-3xl mx-auto mb-16" style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;">
                <div class="flex items-center justify-between relative">
                    <!-- Progress Line -->
                    <div class="absolute top-1/2 left-0 right-0 h-1 bg-[--color-background-700] transform -translate-y-1/2 -z-10"></div>
                    <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-[--color-accent-500] to-[--color-primary-500] transform -translate-y-1/2 -z-10" style="width: 50%;"></div>

                    <!-- Step 1: Cart -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full bg-[--color-primary-500] text-white flex items-center justify-center shadow-lg mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.182 1.761.704 1.761H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-sm text-[--color-text-300]">Cart</span>
                    </div>

                    <!-- Step 2: Checkout (Active) -->
                    <div class="flex flex-col items-center transform scale-110">
                        <div class="w-14 h-14 rounded-full step-active text-white flex items-center justify-center shadow-2xl mb-3">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.01 12.01 0 002.944 12c.078 2.372.33 4.717.756 7.042l-1.163-.116a1 1 0 01-.941-1.352L1.8 14.16a1 1 0 01.325-1.026l1.246-1.12c.5-.45.548-1.17.115-1.67a1 1 0 01-.115-1.464L4.8 7.37a1 1 0 011.026-.325l1.12-1.246c.45-.5.17-1.67-.354-2.188A10.95 10.95 0 0012 3z" />
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-[--color-accent-400] text-glow-accent">Checkout</span>
                    </div>

                    <!-- Step 3: Confirmation -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full bg-[--color-background-700] text-[--color-text-300] flex items-center justify-center shadow-lg mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm text-[--color-text-300]">Confirmation</span>
                    </div>
                </div>
            </div>

            <!-- Main Checkout Content -->
            <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-8" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">

                <!-- Left Column: Order & Shipping -->
                <div class="space-y-8">
                    <!-- Order Summary -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30">
                        <h2 class="text-2xl font-bold text-[--color-text-50] mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Order Summary
                        </h2>

                        <div class="space-y-4 mb-6">
                            @foreach($cart->items as $item)
                                <div class="flex justify-between items-center py-3 border-b border-[--color-primary-700]/20">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-[--color-text-50]">{{ $item->product->name }}</p>
                                            <p class="text-sm text-[--color-text-300]">Qty: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-[--color-accent-400]">${{ number_format($item->product->final_price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-[--color-primary-700]/30 pt-4">
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span class="text-[--color-text-50]">Total Amount</span>
                                <span class="text-2xl text-[--color-accent-400] text-glow-accent">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30">
                        <h2 class="text-2xl font-bold text-[--color-text-50] mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Shipping Information
                        </h2>

                        <form id="shipping-form" method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
                            @csrf
                            <input type="text" name="name" placeholder="Full Name" required
                                   class="w-full input-tech rounded-xl px-4 py-3 placeholder-[--color-text-300] focus:outline-none transition-all">
                            <input type="text" name="address" placeholder="Street Address" required
                                   class="w-full input-tech rounded-xl px-4 py-3 placeholder-[--color-text-300] focus:outline-none transition-all">
                            <input type="text" name="city" placeholder="City" required
                                   class="w-full input-tech rounded-xl px-4 py-3 placeholder-[--color-text-300] focus:outline-none transition-all">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="state" placeholder="State / Province" required
                                       class="w-full input-tech rounded-xl px-4 py-3 placeholder-[--color-text-300] focus:outline-none transition-all">
                                <input type="text" name="zip" placeholder="ZIP Code" required
                                       class="w-full input-tech rounded-xl px-4 py-3 placeholder-[--color-text-300] focus:outline-none transition-all">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Payment -->
                <div class="space-y-8">
                    <!-- Payment Method -->
                    <div class="card-3d bg-[--color-background-800]/70 backdrop-blur-xl rounded-3xl p-8 border border-[--color-primary-700]/30">
                        <h2 class="text-2xl font-bold text-[--color-text-50] mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Payment Method
                        </h2>

                        <div id="payment-element" class="p-6 rounded-xl bg-[--color-background-700] border border-[--color-primary-700] mb-6">
                            <!-- Stripe Payment Element will be mounted here -->
                        </div>

                        <!-- Security Badges -->
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="p-3 bg-[--color-success-500]/10 rounded-xl border border-[--color-success-500]/30">
                                <div class="flex items-center justify-center gap-2 text-[--color-success-400] text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    100% Secure
                                </div>
                            </div>
                            <div class="p-3 bg-[--color-accent-500]/10 rounded-xl border border-[--color-accent-500]/30">
                                <div class="flex items-center justify-center gap-2 text-[--color-accent-400] text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    SSL Encrypted
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <button
                        id="submit-payment"
                        class="w-full bg-gradient-to-r from-[--color-primary-600] to-[--color-accent-600] hover:from-[--color-primary-500] hover:to-[--color-accent-500] text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 btn-3d flex items-center justify-center gap-3 text-lg"
                        style="animation: page-enter 0.5s ease-out 0.8s forwards; opacity: 0;"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Pay ${{ number_format($total, 2) }}
                    </button>

                    <!-- Loading Spinner (Hidden by default) -->
                    <div id="loading-spinner" class="hidden items-center justify-center gap-3 text-[--color-accent-400]">
                        <svg class="w-6 h-6 loading-spinner" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m0 12v4m8-10h-4M6 12H2m16.364-6.364l-2.828 2.828M8.464 8.464L5.636 5.636m12.728 12.728l-2.828-2.828M8.464 15.536L5.636 18.364" />
                        </svg>
                        Processing your secure payment...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const clientSecret = "{{ $clientSecret ?? '' }}";

        const elements = stripe.elements({
            clientSecret,
            appearance: {
                theme: 'night',
                variables: {
                    colorPrimary: '#00BCD4',
                    colorBackground: '#0D0A08',
                    colorText: '#EFEFEF',
                    colorDanger: '#D53F8C',
                    fontFamily: '"Exo 2", sans-serif',
                }
            }
        });

        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");

        const submitBtn = document.getElementById("submit-payment");
        const loadingSpinner = document.getElementById("loading-spinner");
        const shippingForm = document.getElementById("shipping-form");

        submitBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50');
            loadingSpinner.classList.remove('hidden');

            // Collect shipping data from form
            const shippingData = new FormData(shippingForm);
            const shippingAddress = Object.fromEntries(shippingData.entries());

            try {
                const { error } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: "{{ route('checkout.success') }}",
                        payment_method_data: {
                            billing_details: {
                                name: shippingAddress.name,
                                address: {
                                    line1: shippingAddress.address,
                                    city: shippingAddress.city,
                                    state: shippingAddress.state,
                                    postal_code: shippingAddress.zip,
                                }
                            }
                        }
                    },
                });

                if (error) {
                    console.error('Payment error:', error);
                    alert('Payment failed: ' + error.message);

                    // Reset loading state
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50');
                    loadingSpinner.classList.add('hidden');
                }
            } catch (err) {
                console.error('Unexpected error:', err);
                alert('An unexpected error occurred. Please try again.');

                // Reset loading state
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50');
                loadingSpinner.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
