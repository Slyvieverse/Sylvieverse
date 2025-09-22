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

        /* Keyframe for staggered card entrance */
        @keyframes card-enter {
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
            <div class="flex justify-end mb-8">
                <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] hover:border-[--color-primary-500] transition-all">
                    <svg class="h-6 w-6 text-[--color-text-200] block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg class="h-6 w-6 text-[--color-text-200] hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
            </div>
            
            <div class="max-w-4xl mx-auto text-center mb-16">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-[--color-text-50] mb-6">
                    <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-500] bg-clip-text text-transparent">Marketplace</span>
                </h1>
                <p class="text-xl md:text-2xl text-[--color-text-200] mb-10 max-w-3xl mx-auto">
                    Explore our curated collection of digital manhwa and manga.
                </p>
            </div>

            <form method="GET" class="mb-8 flex flex-wrap gap-4 items-center justify-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="flex-1 min-w-[200px] bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-colors">
                <select name="category" class="flex-1 min-w-[150px] bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700] text-[--color-text-50] p-3 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-colors">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-8 py-4 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium text-lg transition-all shadow-lg shadow-[--color-primary-600]/20 hover:shadow-[--color-primary-500]/30">
                    Filter
                </button>
                <a href="{{ route('catalog') }}" class="px-8 py-4 rounded-lg bg-[--color-background-700] hover:bg-[--color-background-800] border border-[--color-primary-700] text-[--color-text-50] font-medium text-lg transition-all">
                    Clear
                </a>
            </form>
            
            <hr class="border-t border-[--color-primary-700]/30 my-10">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div 
                        class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl overflow-hidden border border-[--color-primary-700]/30 hover:shadow-[0_0_20px_0_rgba(128,90,213,0.3)] transition-all duration-300 transform hover:-translate-y-2 relative"
                        style="animation: card-enter 0.5s ease-out forwards; animation-delay: {{ $loop->index * 0.1 }}s; opacity: 0;"
                    >
                        <div class="h-48 overflow-hidden">
                             <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-5">
                            <h3 class="font-heading font-semibold text-xl text-[--color-text-50] mb-2">{{ $product->name }}</h3>
                            <p class="text-[--color-text-200] text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-[--color-text-200]">Price</p>
                                    <p class="font-medium text-[--color-text-50]">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <a href="{{ route('catalog.show', $product) }}" class="px-5 py-2 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium text-base transition-all">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-[--color-text-300] text-lg text-center col-span-full">No products found. 😔</p>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center">
                {{ $products->links('partials.pagination') }}
            </div>
        </div>
    </div>
</x-app-layout>