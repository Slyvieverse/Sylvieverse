<x-admin-layout>
    {{-- The inline <style> block is removed --}}

    <x-slot name="header">
        <h2 class="font-heading text-2xl text-text-800 dark:text-text-50 uppercase tracking-wider">
            Admin Dashboard 🚀
        </h2>
    </x-slot>

    <div class="p-6 space-y-8 animate-fade-in">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Metric Card Template Refactored --}}
            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg dark:shadow-primary-700/20 hover:shadow-xl hover:dark:shadow-primary-500/30 transition-all duration-300 transform hover:scale-[1.01]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-gray-500 dark:text-text-200 text-sm uppercase tracking-wider">Total Users</h3>
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-gray-800 dark:text-text-50">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg dark:shadow-primary-700/20 hover:shadow-xl hover:dark:shadow-primary-500/30 transition-all duration-300 transform hover:scale-[1.01]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-gray-500 dark:text-text-200 text-sm uppercase tracking-wider">Total Revenue</h3>
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-gray-800 dark:text-text-50">${{ number_format($totalRevenue, 2) }}</p>
            </div>

            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg dark:shadow-primary-700/20 hover:shadow-xl hover:dark:shadow-primary-500/30 transition-all duration-300 transform hover:scale-[1.01]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-gray-500 dark:text-text-200 text-sm uppercase tracking-wider">Total Orders</h3>
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-gray-800 dark:text-text-50">{{ $totalOrders }}</p>
            </div>

            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg dark:shadow-primary-700/20 hover:shadow-xl hover:dark:shadow-primary-500/30 transition-all duration-300 transform hover:scale-[1.01]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-gray-500 dark:text-text-200 text-sm uppercase tracking-wider">Active Auctions</h3>
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-gray-800 dark:text-text-50">{{ $activeAuctions }}</p>
            </div>
        </div>

        <hr class="border-gray-300 dark:border-primary-700/50" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg">
                <h3 class="font-heading text-xl text-text-800 dark:text-text-50 mb-4">📊 Orders by Status</h3>
                <canvas id="ordersByStatusChart" class="w-full h-64"></canvas>
            </div>

            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg">
                <h3 class="font-heading text-xl text-text-800 dark:text-text-50 mb-4">📈 Monthly Revenue</h3>
                <canvas id="monthlyRevenueChart" class="w-full h-64"></canvas>
            </div>
        </div>

        <hr class="border-gray-300 dark:border-primary-700/50" />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg">
                <h3 class="font-heading text-xl text-text-800 dark:text-text-50 mb-4">📦 Recent Orders</h3>
                <div class="space-y-4">
                    @forelse ($recentOrders as $order)
                        {{-- Activity Item: Light/Dark background switch --}}
                        <div class="flex items-center justify-between p-4 bg-gray-100 dark:bg-background-700/50 rounded-lg transition-colors hover:bg-gray-200 dark:hover:bg-background-700">
                            <div>
                                <p class="font-heading text-gray-800 dark:text-text-50">#{{ $order->id }} - {{ $order->user->name }}</p>
                                <p class="font-body text-sm text-gray-500 dark:text-text-200">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            {{-- Status text color change --}}
                            <span class="font-heading text-sm text-primary-600 dark:text-primary-400">{{ $order->status }}</span>
                        </div>
                    @empty
                        <p class="font-body text-gray-500 dark:text-text-200">No recent orders.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white dark:bg-background-800/80 backdrop-blur-md border border-gray-200 dark:border-primary-700/30 rounded-xl p-6 shadow-lg">
                <h3 class="font-heading text-xl text-text-800 dark:text-text-50 mb-4">👤 Recent Users</h3>
                <div class="space-y-4">
                    @forelse ($recentUsers as $user)
                        {{-- Activity Item: Light/Dark background switch --}}
                        <div class="flex items-center justify-between p-4 bg-gray-100 dark:bg-background-700/50 rounded-lg transition-colors hover:bg-gray-200 dark:hover:bg-background-700">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full object-cover border border-primary-500/50">
                                <p class="font-heading text-gray-800 dark:text-text-50">{{ $user->name }}</p>
                            </div>
                            <p class="font-body text-sm text-gray-500 dark:text-text-200">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    @empty
                        <p class="font-body text-gray-500 dark:text-text-200">No recent users.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Theme detection logic (assuming you set 'dark' class on <html> element)
    const isDarkMode = document.documentElement.classList.contains('dark');

    // Chart colors based on theme
    const chartTextColor = isDarkMode ? '#E2E8F0' : '#2D3748'; // dark:text-text-50 vs light:text-background-800
    const chartTooltipBg = isDarkMode ? 'rgba(10, 10, 14, 0.9)' : 'rgba(255, 255, 255, 0.9)'; // Deepest dark vs light white
    const chartTooltipColor = isDarkMode ? '#E2E8F0' : '#1A202C'; // Light text vs dark text

    // Primary and Accent colors for chart data (matching your theme)
    const primaryColorRgba = isDarkMode ? 'rgba(128, 90, 213, 1)' : 'rgba(91, 33, 182, 1)'; // primary-400 vs primary-600
    const primaryColorRgbaTransparent = isDarkMode ? 'rgba(128, 90, 213, 0.2)' : 'rgba(91, 33, 182, 0.2)';

    // Pie Chart Data Colors
    const pieColors = [
        { dark: 'rgba(124, 58, 237, 0.6)', light: 'rgba(91, 33, 182, 0.6)' }, // Primary-400/600 (Pending)
        { dark: 'rgba(109, 40, 217, 0.6)', light: 'rgba(69, 23, 164, 0.6)' }, // Primary-500/700 (Processing)
        { dark: 'rgba(91, 33, 182, 0.6)', light: 'rgba(56, 189, 248, 0.6)' }, // Primary-600/Blue (Completed - subtle change for success)
        { dark: 'rgba(237, 100, 166, 0.6)', light: 'rgba(237, 100, 166, 0.6)' } // Accent-400 (Cancelled)
    ];

    // Orders by Status Pie Chart
    const ordersByStatusCtx = document.getElementById('ordersByStatusChart').getContext('2d');
    new Chart(ordersByStatusCtx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
            datasets: [{
                data: [
                    {{ $ordersByStatus['pending'] ?? 0 }},
                    {{ $ordersByStatus['processing'] ?? 0 }},
                    {{ $ordersByStatus['completed'] ?? 0 }},
                    {{ $ordersByStatus['cancelled'] ?? 0 }}
                ],
                backgroundColor: [
                    isDarkMode ? pieColors[0].dark : pieColors[0].light,
                    isDarkMode ? pieColors[1].dark : pieColors[1].light,
                    isDarkMode ? pieColors[2].dark : pieColors[2].light,
                    isDarkMode ? pieColors[3].dark : pieColors[3].light,
                ],
                borderColor: [
                    isDarkMode ? primaryColorRgba : 'rgba(255, 255, 255, 1)',
                    isDarkMode ? primaryColorRgba : 'rgba(255, 255, 255, 1)',
                    isDarkMode ? primaryColorRgba : 'rgba(255, 255, 255, 1)',
                    isDarkMode ? primaryColorRgba : 'rgba(255, 255, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top', labels: { color: chartTextColor } },
                tooltip: {
                    backgroundColor: chartTooltipBg,
                    titleColor: chartTooltipColor,
                    bodyColor: chartTooltipColor
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            }
        }
    });

    // Monthly Revenue Line Chart
    const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
    new Chart(monthlyRevenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($monthlyRevenue)) !!},
            datasets: [{
                label: 'Revenue ($)',
                data: {!! json_encode(array_values($monthlyRevenue)) !!},
                borderColor: primaryColorRgba,
                backgroundColor: primaryColorRgbaTransparent,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: { color: chartTextColor },
                    grid: { color: isDarkMode ? 'rgba(71, 85, 105, 0.4)' : 'rgba(203, 213, 225, 0.4)' } // Slate-500/Gray-300
                },
                y: {
                    ticks: { color: chartTextColor },
                    grid: { color: isDarkMode ? 'rgba(71, 85, 105, 0.4)' : 'rgba(203, 213, 225, 0.4)' },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: { labels: { color: chartTextColor } },
                tooltip: {
                    backgroundColor: chartTooltipBg,
                    titleColor: chartTooltipColor,
                    bodyColor: chartTooltipColor
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            }
        }
    });
</script>
</x-admin-layout>