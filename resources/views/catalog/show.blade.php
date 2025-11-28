<x-app-layout>
    <style>
        /* 🚀 Unified Neon Blue & 4K-Style Color Palette */
        :root {
            /* Primary Purple */
            --color-primary-400: #7E57C2;
            --color-primary-500: #673AB7;
            --color-primary-600: #512DA8;
            --color-primary-700: #311B92;
            
            /* Neon Blue Accent */
            --color-accent-blue-500: #00BCD4;
            --color-accent-blue-400: #4DD0E1;
            --color-accent-blue-600: #0097A7;

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
            --shadow-tech-box: 0 0 10px rgba(49, 27, 146, 0.4); /* Dark purple base shadow */

            /* Typography */
            --font-heading: 'Exo 2', sans-serif; 
        }

        /* 🌙 Dark Mode Overrides (Explicitly for clarity, though it matches defaults) */
        .dark {
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
            --shadow-tech-box: 0 0 15px rgba(49, 27, 146, 0.6);
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
            /* Inset for input */
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
            font-weight: 600;
        }
        .light .btn-primary-enhanced:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }


        /* Input/Select Style */
        .input-tech {
            background-color: var(--color-background-800);
            box-shadow: var(--shadow-inset-tech); 
            transition: all 0.3s;
        }
        .input-tech:focus {
            box-shadow: 0 0 0 2px var(--color-accent-blue-500), inset 0 0 10px var(--color-accent-blue-500)/50;
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
            transform: translateY(-2px);
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
            document.documentElement.classList.add('light'); // Default to light if no preference
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
            
            
            <div class="flex justify-between items-center mb-12">
                <a href="{{ route('catalog') }}" class="text-[var(--color-text-200)] hover:text-[var(--color-accent-blue-500)] transition-colors font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Back to Marketplace
                </a>
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[var(--color-background-800)] border border-[var(--color-primary-700)] hover:border-[var(--color-accent-blue-500)] transition-all shadow-md">
                    <svg class="h-6 w-6 text-[var(--color-text-200)] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg class="h-6 w-6 text-[var(--color-text-200)] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 lg:gap-16">
                
                <div class="tech-box rounded-xl p-6 relative"
                    style="animation: page-enter 0.5s ease-out 0.2s forwards; opacity: 0;"
                >
                    <div class="w-full h-full overflow-hidden rounded-lg shadow-xl dark:shadow-[var(--shadow-primary-glow)] light:shadow-[var(--shadow-tech-box)]">
                        <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                
                <div style="animation: page-enter 0.5s ease-out 0.4s forwards; opacity: 0;">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                        <span class="bg-gradient-to-r from-[var(--color-accent-blue-400)] to-[var(--color-accent-blue-500)] bg-clip-text text-transparent dark:text-shadow-[0_0_10px_var(--color-accent-blue-500)]">{{ $product->name }}</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-6 max-w-3xl mx-auto font-light">
                        {{ $product->description }}
                    </p>
                    
                    <p class="text-4xl font-heading text-neon-accent mb-8 font-bold">${{ number_format($product->getDiscountedPrice(), 2) }}</p>
                    
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
                                class="w-full input-tech text-[var(--color-text-50)] p-3 rounded-lg text-center focus:outline-none transition-colors"
                            >
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-8 py-4 rounded-lg btn-primary-enhanced text-[var(--color-text-50)] font-medium text-lg">
                            Add to Cart
                        </button>
                    </form>
                    
                    <div class="flex flex-wrap gap-4 mt-8">
                        <span class="px-4 py-2 rounded-full bg-[var(--color-primary-500)]/20 text-[var(--color-primary-400)] text-sm font-medium">Limited Edition</span>
                        <span class="px-4 py-2 rounded-full bg-[var(--color-accent-blue-500)]/20 text-[var(--color-accent-blue-500)] text-sm font-medium">Digital Rights</span>
                    </div>
                </div>
            </div>

            

            
            
            <div class="mt-12 grid md:grid-cols-3 gap-8 text-center" style="animation: page-enter 0.5s ease-out 0.6s forwards; opacity: 0;">
                
                <div class="tech-box rounded-xl p-6">
                    <div class="w-14 h-14 mx-auto rounded-lg bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] mb-4 flex items-center justify-center shadow-lg dark:shadow-[var(--color-primary-600)]/30 light:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--color-text-50)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[var(--color-text-50)] mb-2">Specifications</h3>
                    <p class="text-[var(--color-text-200)]">Format: Digital EPUB, PDF<br>Pages: 210<br>Release Date: 2024</p>
                </div>
                
                <div class="tech-box rounded-xl p-6">
                    <div class="w-14 h-14 mx-auto rounded-lg bg-gradient-to-br from-[var(--color-accent-blue-500)] to-[var(--color-accent-blue-400)] mb-4 flex items-center justify-center shadow-lg dark:shadow-[var(--color-accent-blue-500)]/30 light:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--color-text-50)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[var(--color-text-50)] mb-2">Digital Ownership</h3>
                    <p class="text-[var(--color-text-200)]">Verified ownership via blockchain token. View your unique token in your collection.</p>
                </div>
                
                <div class="tech-box rounded-xl p-6">
                    <div class="w-14 h-14 mx-auto rounded-lg bg-gradient-to-br from-[var(--color-primary-500)] to-[var(--color-primary-400)] mb-4 flex items-center justify-center shadow-lg dark:shadow-[var(--color-primary-500)]/30 light:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[var(--color-text-50)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-heading font-semibold text-[var(--color-text-50)] mb-2">Creator Profile</h3>
                    <p class="text-[var(--color-text-200)]">Art by **Lee Jin-woo**. Story by **Park Min-jun**. Follow them for new releases.</p>
                </div>
            </div>

        

    
            
            <div class="mt-12">
                @if($relatedProducts->isEmpty())
                    <p class="text-[var(--color-text-200)] text-center">No related items available.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="animation: page-enter 0.5s ease-out 1s forwards; opacity: 0;">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="tech-box rounded-xl overflow-hidden relative">
                                <div class="h-48 overflow-hidden border-b border-[var(--color-primary-700)]/30">
                                    <img src="{{ $relatedProduct->image_url ? asset('storage/' . $relatedProduct->image_url) : asset('images/default-product.png') }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-5">
                                    <h3 class="font-heading font-semibold text-xl text-[var(--color-text-50)] mb-2">{{ $relatedProduct->name }}</h3>
                                    <p class="text-[var(--color-text-200)] text-sm mb-4 line-clamp-2">{{ $relatedProduct->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs text-[var(--color-text-200)]">Price</p>
                                            <p class="font-bold text-2xl text-neon-accent">${{ number_format($relatedProduct->getDiscountedPrice(), 2) }}</p>
                                        </div>
                                        <a href="{{ route('catalog.show', $relatedProduct) }}" class="px-5 py-2 rounded-lg btn-primary-enhanced text-[var(--color-text-50)] font-medium text-base">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <footer class="text-center py-10 border-t border-[var(--color-primary-700)]/50 mt-20">
                <p class="text-[var(--color-text-300)] text-sm">© 2025 SylvieVerse Marketplace. All rights reserved. **A next-generation experience.**</p>
                <div class="flex justify-center space-x-4 mt-4">
                    <a href="#" class="text-[var(--color-accent-blue-400)] hover:text-[var(--color-accent-blue-500)] transition-colors">Privacy Policy</a>
                    <a href="#" class="text-[var(--color-accent-blue-400)] hover:text-[var(--color-accent-blue-500)] transition-colors">Terms of Service</a>
                    <a href="#" class="text-[var(--color-accent-blue-400)] hover:text-[var(--color-accent-blue-500)] transition-colors">Support</a>
                </div>
            </footer>
            
        </div>
    </div>
</x-app-layout>