<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Left: Logo + Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    {{ config('app.name', 'Sylvieverse') }}
                </a>

                <!-- Main Nav Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('catalog') }}" 
                       class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                        Catalog
                    </a>
                    <a href="{{ route('checkout.index') }}" 
                       class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                        Checkout
                    </a>
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center space-x-4">
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400" 
                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m6-9v9" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    @auth
                        @php
                            $cartCount = Auth::user()->cart?->items()->count() ?? 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    @endauth
                </a>

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" 
                        class="p-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    <svg x-show="!darkMode" class="w-5 h-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293a8 8 0 01-11.586-11.586A8 8 0 1017.293 13.293z"/>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 15a5 5 0 100-10 5 5 0 000 10zM10 0v2m0 16v2m10-10h-2M2 10H0m15.364-6.364l-1.414 1.414M4.05 15.95l-1.414 1.414M15.364 15.95l-1.414-1.414M4.05 4.636L2.636 6.05"/>
                    </svg>
                </button>

                <!-- Auth -->
                @guest
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 rounded-md text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 rounded-md bg-primary-600 text-white hover:bg-primary-500 transition">
                        Register
                    </a>
                @endguest

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg py-1 z-20">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
