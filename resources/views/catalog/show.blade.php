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
        // Theme toggle logic
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
            <div class="flex justify-between items-center mb-12">
                <a href="{{ route('catalog') }}" class="text-[--color-primary-400] hover:text-[--color-primary-300] transition-colors font-medium">
                    &larr; Back to Marketplace
                </a>
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] hover:border-[--color-primary-500] transition-all">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-16">
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:shadow-[0_0_20px_0_rgba(128,90,213,0.3)] transition-all duration-300 transform hover:-translate-y-2 relative"
                    style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;"
                >
                    <div class="w-full h-full overflow-hidden rounded-lg">
                        <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
                
                <div style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                        <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent">{{ $product->name }}</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-[--color-text-200] mb-6 max-w-3xl mx-auto">
                        {{ $product->description }}
                    </p>
                    
                    <p class="text-4xl font-heading text-[--color-accent-500] mb-8 font-bold">${{ number_format($product->getDiscountedPrice(), 2) }}</p>
                    
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-col sm:flex-row gap-4 mb-8">
                        @csrf
                        <div class="relative w-full sm:w-28">
                            <label for="quantity" class="sr-only">Quantity</label>
                            <input 
                                type="number" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                max="{{ $product->stock_quantity }}" 
                                class="w-full bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg text-center focus:outline-none focus:border-[--color-primary-500] transition-colors"
                            >
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium text-lg transition-all shadow-lg shadow-[--color-primary-600]/20 hover:shadow-[--color-primary-500]/30">
                            Add to Cart
                        </button>
                    </form>
                    
                    <div class="flex flex-wrap gap-4 mt-8">
                        <span class="px-4 py-2 rounded-full bg-[--color-primary-500]/20 text-[--color-primary-400] text-sm font-medium">Limited Edition</span>
                        <span class="px-4 py-2 rounded-full bg-[--color-accent-500]/20 text-[--color-accent-500] text-sm font-medium">Digital Rights</span>
                    </div>
                </div>
            </div>

            <div class="mt-20 grid md:grid-cols-3 gap-8 text-center" style="animation: page-enter 0.5s ease-out 0.6s forwards; opacity: 0;">
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:border-[--color-primary-500] transition-all">
                    <div class="w-14 h-14 mx-auto rounded-lg bg-gradient-to-br from-[--color-primary-600] to-[--color-primary-400] mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[--color-text-50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[--color-text-50] mb-2">Specifications</h3>
                    <p class="text-[--color-text-200]">Format: Digital EPUB, PDF<br>Pages: 210<br>Release Date: 2024</p>
                </div>
                
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:border-[--color-primary-500] transition-all">
                    <div class="w-14 h-14 mx-auto rounded-lg bg-gradient-to-br from-[--color-accent-500] to-pink-400 mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[--color-text-50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[--color-text-50] mb-2">Digital Ownership</h3>
                    <p class="text-[--color-text-200]">Verified ownership via blockchain token. View your unique token in your collection.</p>
                </div>
                
                <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 hover:border-[--color-primary-500] transition-all">
                    <div class="w-14 h-14 mx-auto rounded-lg bg-gradient-to-br from-purple-500 to-[--color-primary-400] mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[--color-text-50]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[--color-text-50] mb-2">Creator Profile</h3>
                    <p class="text-[--color-text-200]">Art by **Lee Jin-woo**. Story by **Park Min-jun**. Follow them for new releases.</p>
                </div>
            </div>

            <div class="mt-20">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-[--color-text-50] mb-8 text-center" style="animation: page-enter 0.5s ease-out 0.8s forwards; opacity: 0;">
                    Related Items
                </h2>
                @if($relatedProducts->isEmpty())
                    <p class="text-[--color-text-200] text-center">No related items available.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="animation: page-enter 0.5s ease-out 1s forwards; opacity: 0;">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-primary-700]/30 hover:shadow-[0_0_20px_0_rgba(128,90,213,0.3)] transition-all duration-300 transform hover:-translate-y-2 relative">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $relatedProduct->image_url ? asset('storage/' . $relatedProduct->image_url) : asset('images/default-product.png') }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-5">
                                    <h3 class="font-heading font-semibold text-xl text-[--color-text-50] mb-2">{{ $relatedProduct->name }}</h3>
                                    <p class="text-[--color-text-200] text-sm mb-4 line-clamp-2">{{ $relatedProduct->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs text-[--color-text-200]">Price</p>
                                            <p class="font-medium text-[--color-text-50]">${{ number_format($relatedProduct->getDiscountedPrice(), 2) }}</p>
                                        </div>
                                        <a href="{{ route('catalog.show', $relatedProduct) }}" class="px-5 py-2 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium text-base transition-all">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>