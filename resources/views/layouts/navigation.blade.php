<nav x-data="nav" class="relative bg-[var(--color-background-800)]/80 backdrop-blur-xl border-b border-[var(--color-primary-700)]/30 shadow-2xl shadow-[var(--color-primary-700)]/10 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex items-center space-x-12">
                <a href="{{ route('home') }}" class="group relative py-2">
                    <div class="text-2xl font-extrabold tracking-wider bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent transition-all duration-500 group-hover:scale-[1.03] group-hover:text-3xl">
                        SylvieVerse
                    </div>
                    <div class="absolute -inset-2 bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] rounded-lg opacity-0 group-hover:opacity-20 blur-md transition-opacity duration-500"></div>
                </a>

                <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                    @php
                        $navItems = [
                            ['route' => 'catalog', 'label' => 'Catalog'],
                            ['route' => 'auctions.index', 'label' => 'Live Auctions'],
                        ];
                        if (Auth::check()) {
                            $navItems[] = ['route' => 'user.orders.index', 'label' => 'My Orders'];
                            $navItems2[] = ['route' => 'auctions.my', 'label' => 'My Auctions'];
                        }
                    @endphp

                    @foreach($navItems as $item)
                        @php
                            // Simulating a basic way to determine the active link (requires a path checking function in a real app)
                            $isActive = request()->routeIs($item['route']) || (strpos(url()->current(), route($item['route'])) !== false);
                            $activeClass = $isActive ? 'text-[var(--color-accent-400)] font-bold' : 'text-[var(--color-text-200)] hover:text-[var(--color-text-50)]';
                            $activeUnderline = $isActive ? 'opacity-100 scale-x-100' : 'opacity-0 scale-x-0';
                        @endphp
                        <a href="{{ route($item['route']) }}"
                           class="relative px-2 py-2 {{ $activeClass }} transition-all duration-300 font-semibold group">
                            <span class="relative z-10">{{ $item['label'] }}</span>
                            <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-400)] rounded-full transition-all duration-300 group-hover:scale-x-100 group-hover:opacity-100 {{ $activeUnderline }}"></div>
                        </a>
                    @endforeach
                    @foreach($navItems2 as $item)
                        @php
                            // Simulating a basic way to determine the active link (requires a path checking function in a real app)
                            $isActive = request()->routeIs($item['route']) || (strpos(url()->current(), route($item['route'])) !== false);
                            $activeClass = $isActive ? 'text-[var(--color-accent-400)] font-bold' : 'text-[var(--color-text-200)] hover:text-[var(--color-text-50)]';
                            $activeUnderline = $isActive ? 'opacity-100 scale-x-100' : 'opacity-0 scale-x-0';
                        @endphp
                        <a href="{{ route($item['route']) }}"
                           class="relative px-2 py-2 {{ $activeClass }} transition-all duration-300 font-semibold group">
                            <span class="relative z-10">{{ $item['label'] }}</span>
                            <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-400)] rounded-full transition-all duration-300 group-hover:scale-x-100 group-hover:opacity-100 {{ $activeUnderline }}"></div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center space-x-4 sm:space-x-6">
                @auth
                <a href="{{ route('auctions.create') }}"
                   class="hidden md:flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-accent-600)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-accent-500)] text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-xl hover:shadow-[var(--color-accent-500)]/40 text-sm xl:text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Create Auction</span>
                </a>
                @endauth

                <a href="{{ route('cart.index') }}" class="relative group p-3 rounded-xl bg-[var(--color-background-700)]/50 border border-transparent hover:border-[var(--color-accent-400)]/50 transition-all duration-300">
                    <svg class="w-6 h-6 text-[var(--color-text-200)] group-hover:text-[var(--color-accent-400)] transition-colors duration-300"
                         fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                    </svg>
                    @auth
                        @php
                            $cartCount = Auth::user()->cart?->items()->count() ?? 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-gradient-to-br from-[var(--color-accent-600)] to-[var(--color-primary-500)] text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center transform group-hover:scale-125 transition-transform duration-300 shadow-md shadow-[var(--color-accent-500)]/30">
                                {{ $cartCount > 9 ? '9+' : $cartCount }}
                            </span>
                        @endif
                    @endauth
                </a>

                <a href="{{ route('watchlist.index') }}" class="hidden sm:block group p-3 rounded-xl bg-[var(--color-background-700)]/50 border border-transparent hover:border-[var(--color-accent-400)]/50 transition-all duration-300">
                    <svg class="w-6 h-6 text-[var(--color-text-200)] group-hover:text-[var(--color-accent-400)] transition-colors duration-300"
                         fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                    </svg>
                </a>

                <button onclick="toggleTheme()"
                        class="p-3 rounded-xl bg-[var(--color-background-700)]/50 hover:bg-[var(--color-background-700)] border border-[var(--color-primary-700)]/30 hover:border-[var(--color-accent-500)] transition-all duration-300 group">
                    <svg class="w-5 h-5 text-[var(--color-text-200)] group-hover:text-[var(--color-accent-400)] hidden dark:block"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg class="w-5 h-5 text-[var(--color-text-200)] group-hover:text-[var(--color-accent-400)] block dark:hidden"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                @guest
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                           class="px-5 py-2.5 text-[var(--color-text-200)] hover:text-[var(--color-accent-400)] font-semibold transition-colors duration-300 border border-transparent hover:border-[var(--color-primary-600)] rounded-xl">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-6 py-3 bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-accent-600)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-accent-500)] text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-[var(--color-accent-500)]/40">
                            Join SylvieVerse
                        </a>
                    </div>
                @endguest

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                @click.away="open = false"
                                class="flex items-center space-x-3 p-2 rounded-xl bg-[var(--color-background-700)]/50 hover:bg-[var(--color-background-700)] border border-[var(--color-primary-700)]/30 hover:border-[var(--color-accent-500)] transition-all duration-300 group focus:outline-none focus:ring-2 focus:ring-[var(--color-accent-500)] focus:ring-opacity-50">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[var(--color-primary-500)] to-[var(--color-accent-500)] flex items-center justify-center text-white font-semibold text-sm ring-2 ring-transparent group-hover:ring-[var(--color-accent-400)] transition-all duration-300">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-[var(--color-text-200)] group-hover:text-[var(--color-text-50)] font-medium hidden xl:block">
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-[var(--color-text-300)] transform transition-transform duration-300 hidden lg:block"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute right-0 mt-3 w-64 bg-[var(--color-background-800)] border border-[var(--color-primary-700)]/50 rounded-2xl shadow-2xl shadow-[var(--color-primary-700)]/30 backdrop-blur-xl z-50 overflow-hidden ring-1 ring-[var(--color-accent-500)]/20">

                            <div class="p-4 border-b border-[var(--color-primary-700)]/30">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[var(--color-primary-500)] to-[var(--color-accent-500)] flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="truncate">
                                        <p class="text-[var(--color-text-50)] font-semibold truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-[var(--color-text-300)] text-sm truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-2 space-y-1">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center space-x-3 px-4 py-2.5 text-[var(--color-text-200)] hover:text-[var(--color-accent-400)] hover:bg-[var(--color-background-700)] rounded-xl transition-all duration-300 group">
                                    <svg class="w-5 h-5 text-[var(--color-text-300)] group-hover:text-[var(--color-accent-400)]"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>Profile Settings</span>
                                </a>

                                @foreach([
                                    ['route' => 'user.orders.index', 'label' => 'My Orders', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>'],
                                    ['route' => 'watchlist.index', 'label' => 'Watchlist', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>'],
                                ] as $item)
                                <a href="{{ route($item['route']) }}"
                                   class="flex items-center space-x-3 px-4 py-2.5 text-[var(--color-text-200)] hover:text-[var(--color-text-50)] hover:bg-[var(--color-background-700)] rounded-xl transition-all duration-300 group">
                                    <svg class="w-5 h-5 text-[var(--color-text-300)] group-hover:text-[var(--color-accent-400)]"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $item['icon'] !!}
                                    </svg>
                                    <span>{{ $item['label'] }}</span>
                                </a>
                                @endforeach
                            </div>

                            <div class="p-2 border-t border-[var(--color-primary-700)]/30">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center space-x-3 px-4 py-2.5 text-[var(--color-text-200)] hover:text-red-400 hover:bg-red-900/10 rounded-xl transition-all duration-300 group">
                                        <svg class="w-5 h-5 text-[var(--color-text-300)] group-hover:text-red-400"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <div class="lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="p-3 rounded-xl bg-[var(--color-background-700)]/50 border border-[var(--color-primary-700)]/30 hover:border-[var(--color-accent-500)] transition-all duration-300 group">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6 text-[var(--color-text-200)] group-hover:text-[var(--color-accent-400)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6 text-[var(--color-text-200)] group-hover:text-[var(--color-accent-400)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden border-t border-[var(--color-primary-700)]/30 bg-[var(--color-background-800)]/95 backdrop-blur-xl absolute w-full rounded-b-2xl shadow-xl">
        <div class="px-4 sm:px-6 py-4 space-y-1">
            <a href="{{ route('catalog') }}" class="block px-4 py-3 text-[var(--color-text-200)] hover:text-[var(--color-accent-400)] hover:bg-[var(--color-background-700)] rounded-xl transition-colors font-medium">
                Catalog
            </a>
            <a href="{{ route('auctions.index') }}" class="block px-4 py-3 text-[var(--color-text-200)] hover:text-[var(--color-accent-400)] hover:bg-[var(--color-background-700)] rounded-xl transition-colors font-medium">
                Live Auctions
            </a>
            @auth
            <a href="{{ route('user.orders.index') }}" class="block px-4 py-3 text-[var(--color-text-200)] hover:text-[var(--color-accent-400)] hover:bg-[var(--color-background-700)] rounded-xl transition-colors font-medium">
                My Orders
            </a>
            <div class="pt-2">
                <a href="{{ route('auctions.create') }}"
                   class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-accent-600)] text-white font-bold rounded-xl transition-all duration-300 shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Create Auction</span>
                </a>
            </div>
            @endauth
        </div>
        @guest
        <div class="p-4 border-t border-[var(--color-primary-700)]/30 flex space-x-3">
            <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-3 text-[var(--color-text-200)] hover:text-[var(--color-accent-400)] font-semibold rounded-xl transition-colors border border-[var(--color-background-700)] hover:border-[var(--color-primary-600)]">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="flex-1 text-center px-4 py-3 bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-accent-600)] text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.01] shadow-md">
                Join
            </a>
        </div>
        @endguest
    </div>
</nav>

<script>
    // Theme toggle function (kept as is)
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

    // Initialize Alpine.js for mobile menu (Moved outside document.addEventListener for better practice)
    document.addEventListener('alpine:init', () => {
        Alpine.data('nav', () => ({
            mobileMenuOpen: false
        }));
    });
</script>
