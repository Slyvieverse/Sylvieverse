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
    
    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] py-12 transition-colors duration-300">
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-30 animate-[pulse-glow_4s_infinite] transition-opacity duration-300"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex justify-between items-center mb-12" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-4xl font-heading font-bold text-[--color-text-50]">
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent">Secure Checkout</span>
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
            
            <div class="flex items-center justify-between max-w-2xl mx-auto mb-16 relative" style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;">
                <div class="flex-1 h-1 rounded-full bg-[--color-background-700] absolute inset-x-0 top-1/2 transform -translate-y-1/2 mx-auto z-0"></div>
                <div class="flex flex-col items-center z-10">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[--color-primary-500] text-white font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.182 1.761.704 1.761H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-sm mt-2 text-[--color-text-200]">Cart</span>
                </div>
                <div class="flex flex-col items-center z-10 transform scale-110">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] text-white font-bold shadow-lg shadow-[--color-primary-400]/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.01 12.01 0 002.944 12c.078 2.372.33 4.717.756 7.042l-1.163-.116a1 1 0 01-.941-1.352L1.8 14.16a1 1 0 01.325-1.026l1.246-1.12c.5-.45.548-1.17.115-1.67a1 1 0 01-.115-1.464L4.8 7.37a1 1 0 011.026-.325l1.12-1.246c.45-.5.17-1.67-.354-2.188A10.95 10.95 0 0012 3z" />
                        </svg>
                    </div>
                    <span class="text-sm mt-2 text-[--color-text-50] font-medium">Checkout</span>
                </div>
                <div class="flex flex-col items-center z-10">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-[--color-background-700] text-[--color-text-200] font-bold">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm mt-2 text-[--color-text-200]">Confirmation</span>
                </div>
            </div>

            <div class="max-w-4xl mx-auto" style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 md:p-10 mb-8">
                    <div class="mb-8 pb-8 border-b border-[--color-primary-700]/30">
                        <h2 class="text-2xl font-heading font-bold text-[--color-text-50] mb-4">Order Summary</h2>
                        @foreach($cart->items as $item)
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[--color-text-200]">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                <span class="text-[--color-text-50] font-medium">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                        <div class="border-t border-[--color-primary-700]/30 pt-4 mt-4 flex justify-between items-center">
                            <span class="text-xl font-bold font-heading text-[--color-text-50]">Total:</span>
                            <span class="text-2xl font-bold font-heading text-[--color-accent-500]">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="mb-8 pb-8 border-b border-[--color-primary-700]/30">
                        <h2 class="text-2xl font-heading font-bold text-[--color-text-50] mb-4">Shipping Information</h2>
                        <form id="shipping-form" method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <input type="text" name="name" placeholder="Full Name" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg mb-4 placeholder-[--color-text-300] focus:outline-none focus:border-[--color-primary-500] transition-colors">
                            <input type="text" name="address" placeholder="Street Address" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg mb-4 placeholder-[--color-text-300] focus:outline-none focus:border-[--color-primary-500] transition-colors">
                            <input type="text" name="city" placeholder="City" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg mb-4 placeholder-[--color-text-300] focus:outline-none focus:border-[--color-primary-500] transition-colors">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="state" placeholder="State / Province" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg mb-4 placeholder-[--color-text-300] focus:outline-none focus:border-[--color-primary-500] transition-colors">
                                <input type="text" name="zip" placeholder="ZIP Code" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg mb-4 placeholder-[--color-text-300] focus:outline-none focus:border-[--color-primary-500] transition-colors">
                            </div>
                        </form>
                    </div>

                    <div>
                         <h2 class="text-2xl font-heading font-bold text-[--color-text-50] mb-4">Payment Method</h2>
                         <div id="payment-element" class="p-4 rounded-lg bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] mb-4"></div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-6 mb-8 text-[--color-text-300]" style="animation: page-enter 0.5s ease-out 0.6s forwards; opacity: 0;">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 1 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>100% Secure Checkout</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>SSL Encryption</span>
                    </div>
                </div>

                <button 
                    id="submit-payment" 
                    class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-heading font-bold py-4 px-8 rounded-lg shadow-lg shadow-[--color-primary-600]/20 hover:shadow-[--color-primary-500]/30 transition-all w-full md:w-auto mx-auto block"
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