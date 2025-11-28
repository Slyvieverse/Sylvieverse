<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
            
            {{-- ⬅️ Back Button --}}
            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center text-gray-600 dark:text-[--color-text-200] hover:text-fuchsia-600 dark:hover:text-[--color-primary-400] transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Orders
            </a>

            {{-- 🏷️ Title --}}
            <h2 class="font-heading text-3xl font-bold text-gray-900 dark:text-[--color-text-50] leading-tight flex-1 text-center sm:text-left sm:ml-6">
                Order #{{ $order->id }} Details
            </h2>

            {{-- 🔄 Status Update Form --}}
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center space-x-3 bg-gray-50 dark:bg-[--color-background-700] p-3 rounded-lg border border-gray-200 dark:border-[--color-primary-700]/30 shadow-sm">
                @csrf
                @method('PUT')

                <label for="status" class="text-sm font-medium text-gray-600 dark:text-[--color-text-200] whitespace-nowrap">Update Status:</label>
                <select name="status" id="status" 
                        class="bg-white dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700] text-gray-800 dark:text-[--color-text-50] rounded-lg text-sm px-3 py-2 focus:ring-2 focus:ring-fuchsia-500 dark:focus:ring-[--color-primary-600] transition-colors">
                    @php
                        $statuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];
                    @endphp
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @if($order->status === $status) selected @endif>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" 
                        class="px-4 py-2 rounded-lg bg-fuchsia-600 hover:bg-fuchsia-700 dark:bg-[--color-primary-600] dark:hover:bg-[--color-primary-500] text-white font-medium transition-all shadow-md text-sm">
                    Save
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Main Content Card --}}
            <div class="bg-white dark:bg-[--color-background-800] rounded-2xl p-8 border border-gray-200 dark:border-[--color-primary-700]/30 shadow-2xl">

                {{-- 🟢 Success Message --}}
                @if (session('success'))
                    <div class="mb-6 p-4 border border-green-400 bg-green-100 text-green-800 dark:border-green-600 dark:bg-green-900/40 dark:text-green-300 rounded-lg font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                {{-- Order Summary, Customer, and Shipping Blocks --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                    
                    {{-- 💰 Order Summary Card --}}
                    <div class="p-6 rounded-xl bg-gray-50 dark:bg-[--color-background-700] border border-gray-200 dark:border-[--color-primary-700]/30 shadow-lg">
                        <h3 class="font-heading text-xl font-bold text-fuchsia-600 dark:text-[--color-primary-400] mb-4 border-b border-gray-200 dark:border-[--color-primary-700]/50 pb-3">
                            Order Summary
                        </h3>
                        <div class="space-y-3">
                            <p class="text-gray-700 dark:text-[--color-text-200] flex justify-between">
                                <span class="font-semibold">Order ID:</span> 
                                <span class="text-gray-900 dark:text-[--color-text-50] font-mono">#{{ $order->id }}</span>
                            </p>
                            <p class="text-gray-700 dark:text-[--color-text-200] flex justify-between">
                                <span class="font-semibold">Date Placed:</span> 
                                <span class="text-gray-900 dark:text-[--color-text-50]">{{ $order->created_at->format('M d, Y H:i') }}</span>
                            </p>
                            <p class="text-gray-700 dark:text-[--color-text-200] flex justify-between">
                                <span class="font-semibold">Last Updated:</span> 
                                <span class="text-gray-900 dark:text-[--color-text-50]">{{ $order->updated_at->format('M d, Y H:i') }}</span>
                            </p>
                            
                            <p class="text-gray-700 dark:text-[--color-text-200] flex justify-between pt-3 border-t border-gray-200 dark:border-[--color-primary-800]">
                                <span class="font-bold text-lg">Order Total:</span> 
                                <span class="text-2xl font-extrabold text-green-600 dark:text-green-400">${{ number_format($order->total, 2) }}</span>
                            </p>
                            <p class="text-gray-700 dark:text-[--color-text-200] flex justify-between pt-2">
                                <span class="font-semibold">Current Status:</span> 
                                {{-- Status Badge --}}
                                @php
                                    $statusClasses = match($order->status) {
                                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300',
                                        'shipped' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
                                        'pending', 'processing' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/40 dark:text-gray-300',
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full uppercase tracking-wider {{ $statusClasses }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    {{-- 👤 Customer Info Card --}}
                    <div class="p-6 rounded-xl bg-gray-50 dark:bg-[--color-background-700] border border-gray-200 dark:border-[--color-primary-700]/30 shadow-lg">
                        <h3 class="font-heading text-xl font-bold text-fuchsia-600 dark:text-[--color-primary-400] mb-4 border-b border-gray-200 dark:border-[--color-primary-700]/50 pb-3">
                            Customer Information
                        </h3>
                        <div class="space-y-3 text-gray-900 dark:text-[--color-text-50]">
                            <p>
                                <span class="text-gray-600 dark:text-[--color-text-200] font-semibold">Name:</span> 
                                {{ $order->user->name ?? 'Guest User' }}
                            </p>
                            <p>
                                <span class="text-gray-600 dark:text-[--color-text-200] font-semibold">Email:</span> 
                                <a href="mailto:{{ $order->user->email ?? '' }}" class="text-fuchsia-600 hover:text-fuchsia-800 dark:text-[--color-primary-400] dark:hover:text-[--color-primary-300] transition-colors">
                                    {{ $order->user->email ?? 'N/A' }}
                                </a>
                            </p>
                            <p>
                                <span class="text-gray-600 dark:text-[--color-text-200] font-semibold">User ID:</span> 
                                {{ $order->user_id ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    
                    {{-- 🗺️ Shipping Address Card --}}
                    <div class="p-6 rounded-xl bg-gray-50 dark:bg-[--color-background-700] border border-gray-200 dark:border-[--color-primary-700]/30 shadow-lg">
                        <h3 class="font-heading text-xl font-bold text-fuchsia-600 dark:text-[--color-primary-400] mb-4 border-b border-gray-200 dark:border-[--color-primary-700]/50 pb-3">
                            Shipping Address
                        </h3>
                        <address class="text-gray-900 dark:text-[--color-text-50] space-y-1 not-italic">
                            <p class="font-semibold">{{ $order->shipping_address['name'] ?? 'John Doe' }}</p>
                            <p>{{ $order->shipping_address['street'] ?? '123 Admin Lane' }}</p>
                            <p>{{ $order->shipping_address['city'] ?? 'Cyberville' }}, {{ $order->shipping_address['state'] ?? 'CA' }} {{ $order->shipping_address['zip'] ?? '90210' }}</p>
                            <p class="font-medium text-gray-700 dark:text-[--color-text-200]">{{ $order->shipping_address['country'] ?? 'USA' }}</p>
                        </address>
                    </div>
                </div>

                

                {{-- 📦 Items Purchased Section --}}
                <div class="mt-8 pt-6">
                    <h3 class="font-heading text-2xl font-bold text-gray-900 dark:text-[--color-text-50] mb-6">Items Purchased</h3>
                    
                    @if ($order->OrderItems && !$order->OrderItems->isEmpty())
                        <div class="overflow-x-auto border border-gray-200 dark:border-[--color-primary-700]/30 rounded-xl shadow-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                                <thead class="bg-gray-100 dark:bg-[--color-background-700]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Product</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider hidden sm:table-cell">Category</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Unit Price</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Quantity</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-200] uppercase tracking-wider">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-[--color-background-800] divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                                    @foreach ($order->OrderItems as $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-[--color-background-700]/50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-[--color-text-50]">
                                                {{ $item->product->name ?? 'Product Deleted' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-[--color-text-200] hidden sm:table-cell">
                                                {{ $item->product->category->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-[--color-text-200] text-right">
                                                ${{ number_format($item->price_at_purchase, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-[--color-text-200] text-right">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-fuchsia-600 dark:text-[--color-primary-400] text-right">
                                                ${{ number_format($item->quantity * $item->price_at_purchase, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-6 bg-gray-50 dark:bg-[--color-background-700] rounded-lg border border-gray-200 dark:border-[--color-primary-700]/30">
                            <p class="text-gray-500 dark:text-[--color-text-400] italic text-center">No items were found for this order.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>