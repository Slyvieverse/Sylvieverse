<x-admin-layout>
  
          <h1 class="font-heading font-bold text-3xl text-[--color-text-50] mb-4">Order Management</h1>
 
<!-- Filter & Search Form -->
<form method="GET" action="{{ route('admin.orders.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
    <!-- Search -->
    <div>
        <label for="search" class="block text-sm font-medium text-[--color-text-200]">Search</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}"
               placeholder="Order ID, User name..."
               class="mt-1 block w-64 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/50 text-[--color-text-50] p-2 focus:ring-[--color-primary-500] focus:border-[--color-primary-500]">
    </div>

    <!-- Order Status -->
    <div>
        <label for="status" class="block text-sm font-medium text-[--color-text-200]">Order Status</label>
        <select name="status" id="status"
                class="mt-1 block w-40 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/50 text-[--color-text-50] p-2 focus:ring-[--color-primary-500] focus:border-[--color-primary-500]">
            <option value="">All</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <!-- Payment Status -->
    <div>
        <label for="payment_status" class="block text-sm font-medium text-[--color-text-200]">Payment</label>
        <select name="payment_status" id="payment_status"
                class="mt-1 block w-40 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/50 text-[--color-text-50] p-2 focus:ring-[--color-primary-500] focus:border-[--color-primary-500]">
            <option value="">All</option>
            <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
        </select>
    </div>

    <!-- Buttons -->
    <div class="flex gap-2">
        <button type="submit"
                class="px-4 py-2 rounded-lg bg-[--color-primary-600] text-white hover:bg-[--color-primary-500]">
            Filter
        </button>
        <a href="{{ route('admin.orders.index') }}"
           class="px-4 py-2 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/50 text-[--color-text-200] hover:text-[--color-text-50]">
            Reset
        </a>
    </div>
</form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-[--color-primary-900]/20 text-[--color-text-50] rounded-lg border border-[--color-primary-700]/50">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Orders Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[--color-primary-700]/50">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-heading font-bold text-[--color-text-200] uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-heading font-bold text-[--color-text-200] uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-heading font-bold text-[--color-text-200] uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-heading font-bold text-[--color-text-200] uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-heading font-bold text-[--color-text-200] uppercase tracking-wider">Payment Status</th>
                                <th class="px-6 py-3 text-left text-xs font-heading font-bold text-[--color-text-200] uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[--color-primary-700]/50">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-50]">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-50]">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-50]">${{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status === 'completed' ? 'bg-green-500/20 text-green-400' : ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-[--color-primary-400] hover:text-[--color-primary-500] mr-2">View</a>
                                        <a href="{{ route('admin.orders.edit', $order) }}" class="text-[--color-primary-400] hover:text-[--color-primary-500] mr-2">Edit</a>
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[--color-accent-500] hover:text-[--color-accent-400]">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-[--color-text-200]">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $orders->links('partials.pagination') }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>