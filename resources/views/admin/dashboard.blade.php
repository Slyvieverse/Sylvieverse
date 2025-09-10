<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-2xl text-[--color-text-50] uppercase tracking-wider">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="p-6 space-y-8 animate-fade-in">
        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 shadow-md shadow-[--color-primary-700]/20 hover:shadow-[--color-primary-500]/30 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-[--color-text-200] text-sm uppercase tracking-wider">Total Users</h3>
                    <svg class="w-6 h-6 text-[--color-primary-500]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-[--color-text-50]">{{ $totalUsers }}</p>
            </div>

            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 shadow-md shadow-[--color-primary-700]/20 hover:shadow-[--color-primary-500]/30 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-[--color-text-200] text-sm uppercase tracking-wider">Total Revenue</h3>
                    <svg class="w-6 h-6 text-[--color-primary-500]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-[--color-text-50]">${{ number_format($totalRevenue, 2) }}</p>
            </div>

            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 shadow-md shadow-[--color-primary-700]/20 hover:shadow-[--color-primary-500]/30 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-[--color-text-200] text-sm uppercase tracking-wider">Total Orders</h3>
                    <svg class="w-6 h-6 text-[--color-primary-500]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-[--color-text-50]">{{ $totalOrders }}</p>
            </div>

            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 shadow-md shadow-[--color-primary-700]/20 hover:shadow-[--color-primary-500]/30 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-heading text-[--color-text-200] text-sm uppercase tracking-wider">Active Auctions</h3>
                    <svg class="w-6 h-6 text-[--color-primary-500]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <p class="font-heading text-3xl text-[--color-text-50]">{{ $activeAuctions }}</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Orders by Status (Pie Chart) -->
            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6">
                <h3 class="font-heading text-xl text-[--color-text-50] mb-4">Orders by Status</h3>
                <canvas id="ordersByStatusChart" class="w-full h-64"></canvas>
            </div>

            <!-- Monthly Revenue (Line Chart) -->
            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6">
                <h3 class="font-heading text-xl text-[--color-text-50] mb-4">Monthly Revenue</h3>
                <canvas id="monthlyRevenueChart" class="w-full h-64"></canvas>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Orders -->
            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6">
                <h3 class="font-heading text-xl text-[--color-text-50] mb-4">Recent Orders</h3>
                <div class="space-y-4">
                    @forelse ($recentOrders as $order)
                        <div class="flex items-center justify-between p-4 bg-[--color-background-700]/50 rounded-lg">
                            <div>
                                <p class="font-heading text-[--color-text-50]">#{{ $order->id }} - {{ $order->user->name }}</p>
                                <p class="font-body text-sm text-[--color-text-200]">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <span class="font-heading text-sm text-[--color-primary-400]">{{ $order->status }}</span>
                        </div>
                    @empty
                        <p class="font-body text-[--color-text-200]">No recent orders.</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6">
                <h3 class="font-heading text-xl text-[--color-text-50] mb-4">Recent Users</h3>
                <div class="space-y-4">
                    @forelse ($recentUsers as $user)
                        <div class="flex items-center justify-between p-4 bg-[--color-background-700]/50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full object-cover">
                                <p class="font-heading text-[--color-text-50]">{{ $user->name }}</p>
                            </div>
                            <p class="font-body text-sm text-[--color-text-200]">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    @empty
                        <p class="font-body text-[--color-text-200]">No recent users.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart.js Scripts -->
    @vite(['resources/js/app.js'])
    <script>
        
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
                        'rgba(124, 58, 237, 0.6)', // --color-primary-400
                        'rgba(109, 40, 217, 0.6)', // --color-primary-500
                        'rgba(91, 33, 182, 0.6)',  // --color-primary-600
                        'rgba(244, 114, 182, 0.6)' // --color-accent-500
                    ],
                    borderColor: [
                        'rgba(124, 58, 237, 1)',
                        'rgba(109, 40, 217, 1)',
                        'rgba(91, 33, 182, 1)',
                        'rgba(244, 114, 182, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top', labels: { color: '#f5f5f7' } },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 14, 0.8)', // --color-background-900
                        titleColor: '#f5f5f7',
                        bodyColor: '#f5f5f7'
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
                    borderColor: 'rgba(124, 58, 237, 1)', // --color-primary-400
                    backgroundColor: 'rgba(124, 58, 237, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { ticks: { color: '#f5f5f7' } },
                    y: { ticks: { color: '#f5f5f7' }, beginAtZero: true }
                },
                plugins: {
                    legend: { labels: { color: '#f5f5f7' } },
                    tooltip: {
                        backgroundColor: 'rgba(10, 10, 14, 0.8)', // --color-background-900
                        titleColor: '#f5f5f7',
                        bodyColor: '#f5f5f7'
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