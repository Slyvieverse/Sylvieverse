<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SylvieVerse Admin') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto+Serif:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS animation block removed --}}
</head>
<body class="min-h-screen flex flex-col bg-violet-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-500 font-poppins">

    {{-- Background Effect (Original Vibrant Colors, Static) --}}
    <div class="fixed inset-0 -z-10 overflow-hidden transition-colors duration-500">
        <div class="absolute inset-0 bg-violet-50 dark:bg-gray-900 transition-colors"></div>

        {{-- Light Mode Dynamic Blooms (No animation classes) --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-fuchsia-200 rounded-full blur-[100px] opacity-30 dark:hidden"></div>
        <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-teal-200 rounded-full blur-[80px] opacity-30 dark:hidden"></div>

        {{-- Dark Mode Dynamic Blooms (No animation classes) --}}
        <div class="hidden dark:block absolute top-1/4 left-1/4 w-96 h-96 bg-fuchsia-700 rounded-full blur-[100px] opacity-20"></div>
        <div class="hidden dark:block absolute bottom-1/3 right-1/4 w-80 h-80 bg-teal-600 rounded-full blur-[80px] opacity-20"></div>
    </div>

    {{-- Fixed Header (Navbar) --}}
    <nav class="fixed top-0 left-0 right-0 h-16 
                bg-indigo-300/90 dark:bg-violet-900/90 backdrop-blur-md 
                border-b border-violet-300 dark:border-violet-700 
                px-6 flex justify-between items-center shadow-lg transition-colors duration-300 z-30">
        <div class="flex items-center">
            <button id="mobileMenuButton" class="md:hidden mr-4 text-gray-700 dark:text-gray-400 p-1 rounded-md hover:bg-violet-300 dark:hover:bg-violet-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <a href="/" class="font-heading text-xl font-bold text-fuchsia-600 dark:text-fuchsia-400 transition duration-300 hover:scale-[1.05]">
                SylvieVerse Admin
            </a>
        </div>

        <div class="flex items-center space-x-4">
            {{-- Theme Toggle --}}
            <button id="themeToggle" class="p-2 rounded-full bg-violet-200 dark:bg-violet-700 hover:bg-fuchsia-300 dark:hover:bg-fuchsia-800 text-gray-700 dark:text-gray-200 transition duration-300 transform hover:scale-110">
                <svg id="sunIcon" class="hidden w-5 h-5 text-yellow-400 transition" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 01-2 0V3a1 1 0 011-1zM4 10a1 1 0 100-2H3a1 1 0 000 2h1zm12 0a1 1 0 100-2h1a1 1 0 100 2h-1zM10 18a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                <svg id="moonIcon" class="w-5 h-5 text-gray-800 dark:text-gray-100 transition" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
            </button>

            {{-- User Menu --}}
            <div class="relative">
                <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none bg-violet-200/50 dark:bg-violet-800/50 hover:bg-violet-300 dark:hover:bg-violet-700 px-3 py-1 rounded-lg transition duration-300">
                    <div class="w-8 h-8 rounded-full bg-fuchsia-500 flex items-center justify-center text-white text-sm font-medium transition duration-300">
                        {{ strtoupper(Auth::user()->name[0] ?? 'A') }}
                    </div>
                    <span class="hidden md:inline text-sm font-medium text-gray-800 dark:text-gray-200 transition duration-300">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 dark:text-gray-300 transition duration-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-xl py-1 z-40 border border-fuchsia-300 dark:border-fuchsia-700 transform origin-top-right transition duration-300 scale-95 opacity-0">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 transition duration-200">Profile</a>
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-teal-600 dark:text-teal-400 hover:bg-teal-50 dark:hover:bg-teal-900 transition duration-200">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <div class="flex flex-1 pt-16">
        
        {{-- Fixed Sidebar --}}
        <aside id="sidebar" class="fixed top-16 left-0 bottom-0 w-64 
                                    bg-indigo-200/90 dark:bg-violet-900/90 backdrop-blur-sm 
                                    border-r border-violet-300 dark:border-violet-700 
                                    p-6 pt-4 hidden md:block transition-colors duration-300 z-20 overflow-y-auto">
            <nav class="space-y-2">
                @php
                    $navItems = [
                        ['route' => '/admin/dashboard', 'name' => 'Dashboard'],
                        ['route' => '/admin/users', 'name' => 'User Management'],
                        ['route' => '/admin/categories', 'name' => 'Category Management'],
                        ['route' => '/admin/products', 'name' => 'Product Catalog'],
                        ['route' => '/admin/discounts', 'name' => 'Discount Management'],
                        ['route' => '/admin/orders', 'name' => 'Order Management'],
                        ['route' => '/admin/auctions', 'name' => 'Auction Management'],
                    ];
                    // Dynamic Active class logic (simplified for example)
                    $currentPath = Request::path();
                @endphp

                @foreach ($navItems as $item)
                    @php
                        // Note: For actual production, use proper route checks like Request::routeIs('admin.auctions.*')
                        $isActive = str_contains($currentPath, str_replace('/admin/', '', $item['route'])) || ($item['route'] == '/admin/dashboard' && $currentPath == 'admin/dashboard');
                        $activeClasses = $isActive 
                            ? 'bg-fuchsia-600 text-white shadow-lg shadow-fuchsia-500/50 transform translate-x-1 border border-fuchsia-700' 
                            : 'text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400';
                    @endphp
                    <a href="{{ $item['route'] }}" 
                       class="block px-3 py-2 rounded-lg font-medium transition-all duration-300 {{ $activeClasses }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- Main Content Slot (Scrollable) --}}
        <main class="flex-1 transition-colors md:ml-64 p-6 overflow-y-auto max-h-[calc(100vh-4rem)]">
            {{ $slot }}
        </main>
    </div>

    <script>
        // Theme toggle
        const html = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');

        const updateThemeIcons = (isDark) => {
            if (isDark) {
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        };

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            updateThemeIcons(isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });

        // Load saved theme (Defaulting to dark for the vibrant aesthetic)
        const savedTheme = localStorage.getItem('theme');
        const isDark = savedTheme === 'dark';
        if (savedTheme) {
            html.classList.toggle('dark', isDark);
        } else {
            html.classList.add('dark');
        }
        updateThemeIcons(html.classList.contains('dark'));


        // Mobile sidebar toggle
        document.getElementById('mobileMenuButton').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('hidden');
        });

        // User dropdown with transition classes
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');

        userMenuButton.addEventListener('click', () => {
            const isHidden = userDropdown.classList.contains('hidden');
            
            if (isHidden) {
                userDropdown.classList.remove('hidden');
                setTimeout(() => {
                    userDropdown.classList.remove('scale-95', 'opacity-0');
                    userDropdown.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                userDropdown.classList.add('scale-95', 'opacity-0');
                userDropdown.classList.remove('scale-100', 'opacity-100');
                setTimeout(() => {
                    userDropdown.classList.add('hidden');
                }, 300);
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add('scale-95', 'opacity-0');
                userDropdown.classList.remove('scale-100', 'opacity-100');
                setTimeout(() => {
                    userDropdown.classList.add('hidden');
                }, 300);
            }
        });
    </script>
</body>
</html>