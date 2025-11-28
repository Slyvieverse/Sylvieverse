<x-admin-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 🏷️ Page Title & Header --}}
            <h1 class="font-heading font-extrabold text-4xl text-gray-900 dark:text-[--color-text-50] mb-8">
                Order Management
            </h1>

            {{-- 🔎 Filter & Search Form (Purple Accents) --}}
            <form method="GET" action="{{ route('admin.orders.index') }}"
                class="mb-8 p-6 bg-white dark:bg-[--color-background-700] rounded-xl border border-gray-200 dark:border-[--color-primary-700]/10 shadow-md flex flex-wrap gap-6 items-end">

                {{-- Search --}}
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-sm font-medium text-gray-600 dark:text-[--color-text-200] mb-1">
                        Search
                    </label>
                    <div class="relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Order ID, User name..."
                            class="w-full rounded-lg bg-gray-50 dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700]/50 text-gray-800 dark:text-[--color-text-50] p-2 pl-10 focus:ring-[--color-primary-500] focus:border-[--color-primary-500] transition-colors shadow-sm">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400 dark:text-[--color-text-400]"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Order Status --}}
                <div class="min-w-[150px]">
                    <label for="status" class="block text-sm font-medium text-gray-600 dark:text-[--color-text-200] mb-1">
                        Order Status
                    </label>
                    <select name="status" id="status"
                        class="w-full rounded-lg bg-gray-50 dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700]/50 text-gray-800 dark:text-[--color-text-50] p-2 focus:ring-[--color-primary-500] focus:border-[--color-primary-500] shadow-sm">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                {{-- Payment Status --}}
                <div class="min-w-[150px]">
                    <label for="payment_status" class="block text-sm font-medium text-gray-600 dark:text-[--color-text-200] mb-1">
                        Payment
                    </label>
                    <select name="payment_status" id="payment_status"
                        class="w-full rounded-lg bg-gray-50 dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700]/50 text-gray-800 dark:text-[--color-text-50] p-2 focus:ring-[--color-primary-500] focus:border-[--color-primary-500] shadow-sm">
                        <option value="">All Payments</option>
                        <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>

                {{-- Buttons (Primary Color) --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-[--color-primary-600] text-gray-800 dark:text-white font-semibold hover:bg-[--color-primary-500] transition-colors shadow-md">
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path></svg>
                            Filter
                        </span>
                    </button>
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-5 py-2.5 rounded-lg bg-gray-100 dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700]/50 text-gray-700 dark:text-[--color-text-200] font-medium hover:bg-gray-200 dark:hover:bg-[--color-background-700] transition-colors shadow-md">
                        Reset
                    </a>
                </div>
            </form>

            <div class="bg-white dark:bg-[--color-background-800] rounded-2xl p-8 border border-gray-200 dark:border-[--color-primary-700]/30 shadow-2xl">
                
                {{-- 🟢 Success Message --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/10 text-green-700 dark:bg-[--color-primary-900]/20 dark:text-[--color-text-50] rounded-lg border border-green-500/50 dark:border-[--color-primary-700]/50 font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <h2 class="font-heading text-2xl font-bold text-gray-800 dark:text-[--color-text-50] mb-4 border-b border-gray-200 dark:border-[--color-primary-700]/30 pb-3">
                    Recent Orders
                </h2>

                {{-- 📜 Orders Table --}}
                <div class="overflow-x-auto border border-gray-200 dark:border-[--color-primary-700]/30 rounded-xl shadow-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                        <thead class="bg-gray-100 dark:bg-[--color-background-700]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Payment Status</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                            @forelse ($orders as $order)
                                <tr class="bg-white dark:bg-[--color-background-800] hover:bg-gray-50 dark:hover:bg-[--color-background-700] transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-[--color-text-50] font-mono">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-[--color-text-50]">{{ $order->user->name ?? 'Guest User' }}</td>
                                    {{-- Total (Primary Color) --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-fuchsia-600 dark:text-[--color-text-50]">${{ number_format($order->total_amount, 2) }}</td>

                                    {{-- Order Status Tag (Completed = Green, Pending = Yellow, Cancelled = Red) --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusClasses = [
                                                'completed' => 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400',
                                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400',
                                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400',
                                            ];
                                            $currentStatusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-500/20 dark:text-gray-400';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full uppercase tracking-wider {{ $currentStatusClass }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>

                                    {{-- Payment Status Tag (Paid = Purple, Unpaid = Red) --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            // Using Fuchsia for 'Paid' status as a primary/accent color
                                            $paymentClasses = $order->payment_status === 'paid'
                                                ? 'bg-fuchsia-100 text-fuchsia-800 dark:bg-fuchsia-500/20 dark:text-fuchsia-400'
                                                : 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full uppercase tracking-wider {{ $paymentClasses }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </td>

                                    {{-- Actions (Primary Color) --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                        <div class="flex justify-end space-x-4">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="text-purple-600 hover:text-purple-800 dark:text-[--color-primary-400] dark:hover:text-[--color-primary-300] font-medium transition-colors">
                                                View
                                            </a>
                                            <a href="{{ route('admin.orders.edit', $order) }}"
                                                class="text-fuchsia-600 hover:text-fuchsia-800 dark:text-fuchsia-400 dark:hover:text-fuchsia-300 font-medium transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('⚠️ WARNING: Are you sure you want to delete this order (ID: {{ $order->id }})? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 font-medium transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-lg text-gray-500 dark:text-[--color-text-200] italic bg-gray-50 dark:bg-[--color-background-700] rounded-b-xl">
                                        <p class="mb-2">📦 No orders match your current filters.</p>
                                        <p>Try resetting the filters or check your database.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 📄 Pagination --}}
                <div class="mt-8">
                    @isset($orders)
                        {{ $orders->links('partials.pagination') }}
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>