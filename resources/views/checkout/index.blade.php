<x-app-layout>
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
            --shadow-inset-tech: inset 0 0 5px var(--color-accent-blue-600), inset 0 0 10px var(--color-primary-700);
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
            /* Shadows & Insets */
            --shadow-inset-tech: inset 0 0 3px var(--color-accent-blue-400)/50, inset 0 0 5px var(--color-primary-400)/50;
            --shadow-tech-box: 0 4px 15px rgba(0, 0, 0, 0.1); /* Standard shadow */
        }
        
        /* Neon Blue Accent Text */
        .text-neon-accent {
            color: var(--color-accent-blue-500);
            text-shadow: 0 0 5px var(--color-accent-blue-400);
        }
        .light .text-neon-accent {
            text-shadow: none; /* Remove harsh glow in light mode */
        }

        /* Card/Box Styling */
        .tech-box {
            background-color: var(--color-background-800)/50;
            backdrop-filter: blur(8px);
            box-shadow: var(--shadow-tech-box); 
            transition: all 0.4s ease-in-out;
            border: 1px solid var(--color-background-700); /* Subtle border for light mode visibility */
        }
        .tech-box:hover {
            box-shadow: var(--shadow-accent-blue-glow);
        }
        
        /* Input/Select Style */
        .input-tech {
            background-color: var(--color-background-800);
            box-shadow: var(--shadow-inset-tech); 
            transition: all 0.3s;
            color: var(--color-text-50);
            border-color: transparent !important; /* Override standard border */
            padding: 1rem;
        }
        .input-tech:focus {
            box-shadow: 0 0 0 2px var(--color-accent-blue-500), inset 0 0 10px var(--color-accent-blue-500)/50;
            background-color: var(--color-background-700);
        }
        .light .input-tech {
            background-color: var(--color-background-700);
        }
        .light .input-tech:focus {
            background-color: var(--color-background-800);
        }

        /* Primary Purple Button Enhancement (Attractive Button) */
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
        }
        .light .btn-primary-enhanced:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }
        
        /* Checkout Step Visuals */
        .step-active {
            box-shadow: 0 0 15px var(--color-accent-blue-500);
        }
        .step-active-bg {
             /* Neon Blue gradient for the active step */
            background-image: linear-gradient(to right, var(--color-accent-blue-400), var(--color-accent-blue-500));
        }

        /* Gradient & Animations */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%);
        }
        @keyframes page-enter {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        // Theme initialization and toggling updated to use 'light' class
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'light') {
            document.documentElement.classList.add('light');
        } else if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.add('dark'); // Default to dark for this high-contrast theme
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
                <h1 class="text-4xl font-heading font-bold">
                    <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-blue-500)] bg-clip-text text-transparent">Secure Checkout</span>
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
            
            <div class="flex items-center justify-between max-w-2xl mx-auto mb-16 relative" style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;">
                <div class="flex-1 h-1 rounded-full bg-[var(--color-background-700)] absolute inset-x-0 top-1/2 transform -translate-y-1/2 mx-auto z-0"></div>
                <div class="flex flex-col items-center z-10">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[var(--color-primary-500)] text-white font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.182 1.761.704 1.761H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-sm mt-2 text-[var(--color-text-300)]">Cart</span>
                </div>
                <div class="flex flex-col items-center z-10 transform scale-110">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center step-active-bg text-white font-bold step-active shadow-lg dark:shadow-[var(--color-accent-blue-500)]/40 light:shadow-[0_0_15px_rgba(0,188,212,0.4)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.01 12.01 0 002.944 12c.078 2.372.33 4.717.756 7.042l-1.163-.116a1 1 0 01-.941-1.352L1.8 14.16a1 1 0 01.325-1.026l1.246-1.12c.5-.45.548-1.17.115-1.67a1 1 0 01-.115-1.464L4.8 7.37a1 1 0 011.026-.325l1.12-1.246c.45-.5.17-1.67-.354-2.188A10.95 10.95 0 0012 3z" />
                        </svg>
                    </div>
                    <span class="text-sm mt-2 text-neon-accent font-bold">Checkout</span>
                </div>
                <div class="flex flex-col items-center z-10">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[var(--color-background-700)] text-[var(--color-text-200)] font-bold">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                    </div>
                    <span class="text-sm mt-2 text-[var(--color-text-300)]">Confirmation</span>
                </div>
            </div>

            <div class="max-w-4xl mx-auto" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                <div class="tech-box rounded-xl p-6 md:p-10 mb-8">
                    
                    <div class="mb-8 pb-8 border-b border-[var(--color-primary-700)]/30">
                        <h2 class="text-2xl font-heading font-bold text-[var(--color-text-50)] mb-4">Order Summary</h2>
                        @foreach($cart->items as $item)
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[var(--color-text-200)]">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                <span class="text-[var(--color-text-50)] font-medium">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                        <div class="border-t border-[var(--color-primary-700)]/30 pt-4 mt-4 flex justify-between items-center">
                            <span class="text-xl font-bold font-heading text-[var(--color-text-50)]">Total:</span>
                            <span class="text-3xl font-bold font-heading text-neon-accent">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mb-8 pb-8 border-b border-[var(--color-primary-700)]/30">
                        <h2 class="text-2xl font-heading font-bold text-[var(--color-text-50)] mb-4">Shipping Information</h2>
                        <form id="shipping-form" method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <input type="text" name="name" placeholder="Full Name" class="w-full input-tech rounded-lg mb-4 placeholder-[var(--color-text-300)] focus:outline-none transition-colors">
                            <input type="text" name="address" placeholder="Street Address" class="w-full input-tech rounded-lg mb-4 placeholder-[var(--color-text-300)] focus:outline-none transition-colors">
                            <input type="text" name="city" placeholder="City" class="w-full input-tech rounded-lg mb-4 placeholder-[var(--color-text-300)] focus:outline-none transition-colors">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="state" placeholder="State / Province" class="w-full input-tech rounded-lg mb-4 placeholder-[var(--color-text-300)] focus:outline-none transition-colors">
                                <input type="text" name="zip" placeholder="ZIP Code" class="w-full input-tech rounded-lg mb-4 placeholder-[var(--color-text-300)] focus:outline-none transition-colors">
                            </div>
                        </form>
                    </div>

                    <div>
                         <h2 class="text-2xl font-heading font-bold text-[var(--color-text-50)] mb-4">Payment Method</h2>
                         <div id="payment-element" class="p-4 rounded-lg bg-[var(--color-background-700)] border border-[var(--color-primary-700)] text-[var(--color-text-50)] mb-4 shadow-md"></div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-6 mb-8 text-[var(--color-text-300)]" style="animation: page-enter 0.5s ease-out 0.6s forwards; opacity: 0;">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-neon-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>100% Secure Checkout</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-neon-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>SSL Encryption</span>
                    </div>
                </div>

                <button 
                    id="submit-payment" 
                    class="btn-primary-enhanced text-[var(--color-text-50)] font-heading font-bold py-4 px-8 rounded-lg transition-all w-full md:w-auto mx-auto block text-xl"
                    style="animation: page-enter 0.5s ease-out 0.8s forwards; opacity: 0;"
                >
                    Pay ${{ number_format($total, 2) }}
                </button>
            </div>
        </div>
    </div>

    <script src="http://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        const clientSecret = "{{ $clientSecret ?? '' }}"; 

        const elements = stripe.elements({ clientSecret });
        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");

        const submitBtn = document.getElementById("submit-payment");
        const shippingForm = document.getElementById("shipping-form");

        submitBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            // Collect shipping data from form
            const shippingData = new FormData(shippingForm);
            const shippingAddress = Object.fromEntries(shippingData.entries());

            // Prepare for Stripe confirmation
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
                console.error(error.message);
                alert(error.message);
            }
        });
    </script>
</x-app-layout>