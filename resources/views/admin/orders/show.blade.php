
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Order Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.orders.index') }}"
                       class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-500]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Orders
                    </a>
                </div>

                <!-- Order Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Details -->
                    <div>
                        <h3 class="font-heading text-2xl font-bold text-[--color-text-50] mb-4">Order #{{ $order->id }}</h3>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">User:</span>
                            <span class="text-[--color-text-50]">{{ $order->user->name ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Email:</span>
                            <span class="text-[--color-text-50]">{{ $order->user->email ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Total:</span>
                            <span class="text-[--color-text-50]">${{ number_format($order->total, 2) }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Status:</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $order->status === 'completed' ? 'bg-green-500/20 text-green-400' : ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Created At:</span>
                            <span class="text-[--color-text-50]">{{ $order->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Updated At:</span>
                            <span class="text-[--color-text-50]">{{ $order->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="mt-6">
                    <h4 class="font-heading text-lg font-semibold text-[--color-text-200] mb-2">Order Items</h4>
                    @if ($order->OrderItems && !$order->OrderItems->isEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-[--color-primary-700]">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                            Category
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                            Unit Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[--color-primary-700]/50">
                                    @foreach ($order->OrderItems as $item)
                                        <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-50]">
                                                {{ $item->product->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                                {{ $item->product->category->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                                ${{ number_format($item->unit_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                                ${{ number_format($item->quantity * $item->unit_price, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-[--color-text-200]">No items in this order.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
