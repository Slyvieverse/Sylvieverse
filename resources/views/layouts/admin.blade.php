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
    @vite(['resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="min-h-screen flex flex-col bg-violet-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-500 font-poppins">

    <div class="fixed inset-0 -z-10 overflow-hidden transition-colors duration-500">
        <div class="absolute inset-0 bg-violet-50 dark:bg-gray-900 transition-colors"></div>

        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-fuchsia-200 rounded-full blur-[100px] opacity-30 dark:hidden"></div>
        <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-teal-200 rounded-full blur-[80px] opacity-30 dark:hidden"></div>

        <div class="hidden dark:block absolute top-1/4 left-1/4 w-96 h-96 bg-fuchsia-700 rounded-full blur-[100px] opacity-20"></div>
        <div class="hidden dark:block absolute bottom-1/3 right-1/4 w-80 h-80 bg-teal-600 rounded-full blur-[80px] opacity-20"></div>
    </div>

    <nav class="bg-indigo-300/80 dark:bg-violet-900/80 backdrop-blur-md border-b border-violet-300 dark:border-violet-700 py-3 px-6 flex justify-between items-center shadow-sm transition-colors z-10">
        <div class="flex items-center">
            <button id="mobileMenuButton" class="md:hidden mr-4 text-gray-600 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <a href="/" class="font-heading text-xl font-bold text-fuchsia-600 dark:text-fuchsia-400">
                SylvieVerse Admin
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <button id="themeToggle" class="p-2 rounded-full bg-violet-200 dark:bg-violet-700 hover:bg-fuchsia-200 dark:hover:bg-fuchsia-800 text-gray-700 dark:text-gray-200 transition">
                <svg id="sunIcon" class="hidden w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 01-2 0V3a1 1 0 011-1zM4 10a1 1 0 100-2H3a1 1 0 000 2h1zm12 0a1 1 0 100-2h1a1 1 0 100 2h-1zM10 18a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                <svg id="moonIcon" class="w-5 h-5 text-gray-800 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
            </button>

            <div class="relative">
                <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none hover:bg-violet-200 dark:hover:bg-violet-700 px-3 py-1 rounded-lg transition">
                    <div class="w-8 h-8 rounded-full bg-fuchsia-500 flex items-center justify-center text-white text-sm font-medium">
                        {{ strtoupper(Auth::user()->name[0] ?? 'A') }}
                    </div>
                    <span class="hidden md:inline text-sm font-medium">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-20 border border-gray-200 dark:border-gray-700">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900">Profile</a>
                    {{-- <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900">Settings</a> --}}
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-teal-600 dark:text-teal-400 hover:bg-teal-50 dark:hover:bg-teal-900">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">
        <aside id="sidebar" class="w-64 bg-indigo-200/80 dark:bg-violet-900/80 backdrop-blur-md border-r border-violet-200 dark:border-violet-700 p-6 pt-10 hidden md:block transition-colors z-10">
            <nav class="space-y-2">
                <a href="/admin/dashboard" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Dashboard</a>
                <a href="/admin/users" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">User Management</a>
                <a href="/admin/categories" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Category Management</a>
                <a href="/admin/products" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Product Catalog</a>
                <a href="/admin/discounts" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Discount Management</a>
                <a href="/admin/orders" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Order Management</a>
                <a href="/admin/analytics" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Analytics</a>
                <a href="/admin/settings" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900 hover:text-fuchsia-600 dark:hover:text-fuchsia-400">Settings</a>
            </nav>
        </aside>

        <main class="flex-1 p-6 overflow-auto transition-colors">
           {{ $slot }}
        </main>
    </div>

    <script>
        // Mobile sidebar toggle
        document.getElementById('mobileMenuButton').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('hidden');
        });

        // Theme toggle
        const html = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            if (html.classList.contains('dark')) {
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });

        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            html.classList.add('dark');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            html.classList.remove('dark');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }

        // User dropdown
        document.getElementById('userMenuButton').addEventListener('click', () => {
            document.getElementById('userDropdown').classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('userDropdown');
            const button = document.getElementById('userMenuButton');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>