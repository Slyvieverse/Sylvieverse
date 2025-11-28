<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- ⬅️ Back Button (Light/Dark Text Support) --}}
            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center text-gray-700 dark:text-[--color-text-200] hover:text-fuchsia-600 dark:hover:text-[--color-primary-500] transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Orders List
            </a>

            {{-- 🏷️ Title (Light/Dark Text Support) --}}
            <h2 class="font-heading text-2xl text-gray-900 dark:text-[--color-text-50] leading-tight font-extrabold">
                Manage Order #{{ $order->id }}
            </h2>

            {{-- Placeholder to align title in the middle --}}
            <div class="w-12 h-6"></div> 
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Main Wrapper Card --}}
            <div class="bg-white dark:bg-[--color-background-800] rounded-2xl p-8 border border-gray-200 dark:border-[--color-primary-700]/30 shadow-2xl">
                
                {{-- Page Header --}}
                <h1 class="font-heading font-extrabold text-3xl text-gray-900 dark:text-[--color-text-50] mb-8 border-b border-gray-200 dark:border-[--color-primary-700]/30 pb-4">
                    Order Details & Status Update 📝
                </h1>

                {{-- Messages --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 dark:bg-green-500/20 dark:border-green-600/50 dark:text-green-400 rounded-lg font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 dark:bg-red-900/40 dark:border-red-600/50 dark:text-red-300 rounded-lg">
                        <p class="font-bold mb-2">There were errors with your submission:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- Left Column: Order Information & Items --}}
                    <div class="lg:col-span-2 space-y-8">
                        
                        {{-- ℹ️ Quick Info Cards --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            {{-- Customer Name --}}
                            <div class="bg-gray-50 dark:bg-[--color-background-700] p-4 rounded-lg border border-gray-200 dark:border-[--color-primary-700]/10 shadow-sm">
                                <p class="text-sm font-medium text-gray-500 dark:text-[--color-text-400]">Customer Name</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-[--color-text-50]">{{ $order->user->name ?? 'Guest User' }}</p>
                                <a href="mailto:{{ $order->user->email ?? '' }}" class="text-xs text-fuchsia-600 dark:text-[--color-primary-400] hover:underline">{{ $order->user->email ?? 'N/A' }}</a>
                            </div>
                            
                            {{-- Order Total (Fuchsia/Accent) --}}
                            <div class="bg-gray-50 dark:bg-[--color-background-700] p-4 rounded-lg border border-gray-200 dark:border-[--color-primary-700]/10 shadow-sm">
                                <p class="text-sm font-medium text-gray-500 dark:text-[--color-text-400]">Order Total</p>
                                <p class="text-2xl font-extrabold text-fuchsia-600 dark:text-[--color-primary-400]">${{ number_format($order->total_amount, 2) }}</p>
                            </div>

                            {{-- Placed On --}}
                            <div class="bg-gray-50 dark:bg-[--color-background-700] p-4 rounded-lg border border-gray-200 dark:border-[--color-primary-700]/10 shadow-sm">
                                <p class="text-sm font-medium text-gray-500 dark:text-[--color-text-400]">Placed On</p>
                                <p class="text-lg font-medium text-gray-900 dark:text-[--color-text-50]">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') }}</p>
                            </div>

                            {{-- Shipping Address --}}
                            <div class="bg-gray-50 dark:bg-[--color-background-700] p-4 rounded-lg border border-gray-200 dark:border-[--color-primary-700]/10 shadow-sm">
                                <p class="text-sm font-medium text-gray-500 dark:text-[--color-text-400]">Shipping Address</p>
                                <address class="text-sm text-gray-900 dark:text-[--color-text-50] not-italic leading-relaxed">
                                    {{ $order->shipping_address['name'] ?? 'Not provided' }}<br>
                                    {{ $order->shipping_address['street'] ?? '' }}
                                </address>
                            </div>
                        </div>

                        {{-- 📦 Items Ordered Table --}}
                        <div class="mt-6">
                            <h3 class="font-heading font-semibold text-xl text-gray-900 dark:text-[--color-text-50] mb-4 border-b border-gray-200 dark:border-[--color-primary-700]/30 pb-2">Items Ordered</h3>
                            
                            @if ($order->orderItems && $order->orderItems->count())
                                <div class="overflow-x-auto border border-gray-200 dark:border-[--color-primary-700]/30 rounded-lg shadow-lg">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                                        <thead class="bg-gray-100 dark:bg-[--color-background-700]">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Product</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Price</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Qty</th>
                                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                                            @foreach ($order->orderItems as $item)
                                                <tr class="bg-white dark:bg-[--color-background-800] hover:bg-gray-50 dark:hover:bg-[--color-background-700]/50 transition-colors">
                                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-[--color-text-50]">
                                                        {{ $item->product->name ?? 'Product Deleted' }}
                                                    </td>
                                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-[--color-text-200] text-right">
                                                        ${{ number_format($item->price_at_purchase, 2) }}
                                                    </td>
                                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-[--color-text-200] text-right">
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-semibold text-fuchsia-600 dark:text-[--color-primary-400] text-right">
                                                        ${{ number_format($item->quantity * $item->price_at_purchase, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-4 bg-gray-50 dark:bg-[--color-background-700] rounded-lg border border-gray-200 dark:border-[--color-primary-700]/10">
                                    <p class="text-gray-500 dark:text-[--color-text-400] italic text-center">No items were found for this order.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right Column: Order Management & Danger Zone --}}
                    <div class="lg:col-span-1 space-y-8">
                        
                        {{-- 🛠️ Status Update Form --}}
                        <div class="rounded-xl bg-gray-50 dark:bg-[--color-background-700] border border-gray-200 dark:border-[--color-primary-700]/30 shadow-lg p-6">
                            <h2 class="font-heading font-semibold text-xl text-fuchsia-600 dark:text-[--color-primary-400] mb-4">Update Order Status</h2>
                            
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-5">
                                @csrf
                                @method('PUT')

                                {{-- Order Status --}}
                                <div>
                                    <label for="status" class="block text-gray-700 dark:text-[--color-text-200] font-heading font-medium text-sm mb-2">
                                        <span class="text-lg">📦</span> Order Status
                                    </label>
                                    <select name="status" id="status" 
                                            class="w-full bg-white dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700] text-gray-900 dark:text-[--color-text-50] rounded-lg px-4 py-2 focus:border-fuchsia-500 focus:ring-fuchsia-500 dark:focus:border-[--color-primary-500] dark:focus:ring-[--color-primary-500] transition-all">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 dark:text-[--color-accent-500] text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Payment Status --}}
                                <div>
                                    <label for="payment_status" class="block text-gray-700 dark:text-[--color-text-200] font-heading font-medium text-sm mb-2">
                                        <span class="text-lg">💳</span> Payment Status
                                    </label>
                                    <select name="payment_status" id="payment_status" 
                                            class="w-full bg-white dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700] text-gray-900 dark:text-[--color-text-50] rounded-lg px-4 py-2 focus:border-fuchsia-500 focus:ring-fuchsia-500 dark:focus:border-[--color-primary-500] dark:focus:ring-[--color-primary-500] transition-all">
                                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    </select>
                                    @error('payment_status')
                                        <p class="text-red-500 dark:text-[--color-accent-500] text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-2">
                                    <button type="submit" 
                                            class="w-full bg-gradient-to-r from-fuchsia-600 to-fuchsia-500 dark:from-[--color-primary-600] dark:to-[--color-primary-500] text-white dark:text-gray-900 font-heading font-bold py-3 rounded-lg transition-all duration-200 shadow-md shadow-fuchsia-500/30 dark:shadow-[--color-primary-500]/30 hover:shadow-lg">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- ⚠️ Danger Zone --}}
                        <div class="mt-8 pt-4 border-t border-gray-200 dark:border-[--color-primary-700]/30">
                            <h3 class="font-heading text-lg font-semibold text-red-600 dark:text-red-400 mb-3">Danger Zone</h3>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('⚠️ WARNING: Are you sure you want to PERMANENTLY delete this order (ID: {{ $order->id }})? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full text-red-600 dark:text-red-400 hover:text-white dark:hover:text-red-300 font-heading font-bold py-3 px-4 rounded-lg border border-red-500/50 hover:bg-red-700 dark:hover:bg-red-900/20 transition-all duration-200">
                                    Permanently Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>