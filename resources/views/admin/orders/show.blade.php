<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.orders.index') }}" class="flex items-center text-[--color-text-200] hover:text-[--color-primary-500] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Orders
            </a>

            <h2 class="font-heading text-2xl font-semibold text-[--color-text-50] leading-tight">
                Order #{{ $order->id }} Details 📦
            </h2>

            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center space-x-3">
                @csrf
                @method('PUT')

                <label for="status" class="text-[--color-text-200] text-sm hidden sm:block">Update Status:</label>
                <select name="status" id="status" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] rounded-lg text-sm px-3 py-2 focus:ring-2 focus:ring-[--color-primary-600]">
                    @php
                        $statuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];
                    @endphp
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @if($order->status === $status) selected @endif>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 text-white font-medium transition-all shadow-lg text-sm">
                    Save
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800] rounded-2xl p-8 border border-[--color-primary-700]/50 shadow-2xl shadow-[--color-background-900]">

                @if (session('success'))
                    <div class="mb-6 p-4 border border-green-600 bg-green-900/40 text-green-300 rounded-lg">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="p-4 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/30">
                        <h3 class="font-heading text-lg font-bold text-[--color-primary-400] mb-3">Order Summary</h3>
                        <div class="space-y-2">
                            <p class="text-[--color-text-200] flex justify-between">
                                <span class="font-medium">Order ID:</span> 
                                <span class="text-[--color-text-50]">#{{ $order->id }}</span>
                            </p>
                            <p class="text-[--color-text-200] flex justify-between">
                                <span class="font-medium">Date Placed:</span> 
                                <span class="text-[--color-text-50]">{{ $order->created_at->format('M d, Y H:i') }}</span>
                            </p>
                            <p class="text-[--color-text-200] flex justify-between">
                                <span class="font-medium">Last Updated:</span> 
                                <span class="text-[--color-text-50]">{{ $order->updated_at->format('M d, Y H:i') }}</span>
                            </p>
                            <p class="text-[--color-text-200] flex justify-between">
                                <span class="font-medium">Order Total:</span> 
                                <span class="text-xl font-bold text-green-400">${{ number_format($order->total, 2) }}</span>
                            </p>
                            <p class="text-[--color-text-200] flex justify-between pt-2 border-t border-[--color-primary-800]">
                                <span class="font-medium">Current Status:</span> 
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                    @if($order->status === 'completed') bg-green-900/40 text-green-300
                                    @elseif($order->status === 'pending' || $order->status === 'processing') bg-yellow-900/40 text-yellow-300
                                    @else bg-red-900/40 text-red-300
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="p-4 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/30">
                        <h3 class="font-heading text-lg font-bold text-[--color-primary-400] mb-3">Customer Information</h3>
                        <div class="space-y-2 text-[--color-text-50]">
                            <p><span class="text-[--color-text-200] font-medium">Name:</span> {{ $order->user->name ?? 'Guest User' }}</p>
                            <p><span class="text-[--color-text-200] font-medium">Email:</span> <a href="mailto:{{ $order->user->email ?? '' }}" class="hover:text-[--color-primary-400]">{{ $order->user->email ?? 'N/A' }}</a></p>
                            <p><span class="text-[--color-text-200] font-medium">User ID:</span> {{ $order->user_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="p-4 rounded-lg bg-[--color-background-700] border border-[--color-primary-700]/30">
                        <h3 class="font-heading text-lg font-bold text-[--color-primary-400] mb-3">Shipping Address</h3>
                        <address class="text-[--color-text-50] space-y-1 not-italic">
                            <p>{{ $order->shipping_address['name'] ?? 'John Doe' }}</p>
                            <p>{{ $order->shipping_address['street'] ?? '123 Admin Lane' }}</p>
                            <p>{{ $order->shipping_address['city'] ?? 'Cyberville' }}, {{ $order->shipping_address['state'] ?? 'CA' }} {{ $order->shipping_address['zip'] ?? '90210' }}</p>
                            <p>{{ $order->shipping_address['country'] ?? 'USA' }}</p>
                        </address>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-[--color-primary-800]">
                    <h3 class="font-heading text-xl font-bold text-[--color-text-50] mb-4">Items Purchased</h3>
                    
                    @if ($order->OrderItems && !$order->OrderItems->isEmpty())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-[--color-primary-700]/50">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Product</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Category</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Unit Price</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Quantity</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[--color-primary-700]/50">
                                    @foreach ($order->OrderItems as $item)
                                        <tr class="hover:bg-[--color-background-700]/50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[--color-text-50]">
                                                {{ $item->product->name ?? 'Product Deleted' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                                {{ $item->product->category->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200] text-right">
                                                ${{ number_format($item->price_at_purchase, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200] text-right">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[--color-primary-400] text-right">
                                                ${{ number_format($item->quantity * $item->price_at_purchase, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-[--color-text-400] italic">No items were found for this order.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>