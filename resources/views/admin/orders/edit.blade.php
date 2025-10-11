<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.orders.index') }}" class="flex items-center text-background-900 dark:text-background-200 hover:text-[--color-primary-500] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Orders List
            </a>

            <h2 class="font-heading text-xl text-background-900 dark:text-background-200 leading-tight font-bold">
                Manage Order #{{ $order->id }}
            </h2>

            <div></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-8 border border-[--color-primary-700]/30 shadow-2xl animate-fade-in">
                
                <h1 class="font-heading font-extrabold text-3xl text-[--color-text-50] mb-8 border-b border-[--color-primary-700]/30 pb-4">
                    Order Details & Status Update
                </h1>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 border border-green-600/50 text-green-400 rounded-lg font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-900/40 border border-red-600/50 text-red-300 rounded-lg">
                        <p class="font-bold mb-2">There were errors with your submission:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <h2 class="font-heading font-semibold text-xl text-[--color-text-50]">Order Information</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <div class="bg-[--color-background-700] p-4 rounded-lg border border-[--color-primary-700]/10">
                                <p class="text-sm font-medium text-[--color-text-400]">Customer Name</p>
                                <p class="text-lg font-bold text-[--color-text-50]">{{ $order->user->name ?? 'Guest User' }}</p>
                            </div>
                            
                            <div class="bg-[--color-background-700] p-4 rounded-lg border border-[--color-primary-700]/10">
                                <p class="text-sm font-medium text-[--color-text-400]">Order Total</p>
                                <p class="text-lg font-bold text-[--color-accent-400]">${{ number_format($order->total_amount, 2) }}</p>
                            </div>

                            <div class="bg-[--color-background-700] p-4 rounded-lg border border-[--color-primary-700]/10">
                                <p class="text-sm font-medium text-[--color-text-400]">Placed On</p>
                                <p class="text-lg font-medium text-[--color-text-50]">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') }}</p>
                            </div>

                            <div class="bg-[--color-background-700] p-4 rounded-lg border border-[--color-primary-700]/10">
                                <p class="text-sm font-medium text-[--color-text-400]">Shipping Address</p>
                                <p class="text-sm text-[--color-text-50]">
                                    {{ $order->shipping_address ?? 'Not provided' }}
                                </p>
                            </div>

                        </div>

                        <div class="mt-6">
                            <h3 class="font-heading font-semibold text-lg text-[--color-text-50] mb-3">Items Ordered</h3>
                            <div class="bg-[--color-background-700] p-4 rounded-lg border border-[--color-primary-700]/10 h-40 overflow-y-auto">
                                <p class="text-[--color-text-200] italic">
                                    Product list would go here (e.g., using a simple table or list).
                                </p>
                                </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <h2 class="font-heading font-semibold text-xl text-[--color-text-50]">Order Management</h2>
                        
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="bg-[--color-background-700] p-5 rounded-lg border border-[--color-primary-700]/10 space-y-5">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="status" class="block text-[--color-text-200] font-heading font-bold text-sm mb-2">
                                    <span class="text-lg">📦</span> Order Status
                                </label>
                                <select name="status" id="status" class="w-full bg-[--color-background-800] border border-[--color-primary-700] text-[--color-text-50] rounded-lg px-4 py-2 focus:border-[--color-primary-500] focus:ring-[--color-primary-500] transition-all">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped (New Option)</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <p class="text-[--color-accent-500] text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_status" class="block text-[--color-text-200] font-heading font-bold text-sm mb-2">
                                    <span class="text-lg">💳</span> Payment Status
                                </label>
                                <select name="payment_status" id="payment_status" class="w-full bg-[--color-background-800] border border-[--color-primary-700] text-[--color-text-50] rounded-lg px-4 py-2 focus:border-[--color-primary-500] focus:ring-[--color-primary-500] transition-all">
                                    <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                @error('payment_status')
                                    <p class="text-[--color-accent-500] text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 font-heading font-bold py-3 rounded-lg transition-all duration-200 shadow-md shadow-[--color-primary-500]/30 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.5)]">
                                    Save Changes
                                </button>
                            </div>
                        </form>

                        <div class="mt-8 pt-4 border-t border-[--color-primary-700]/30">
                            <h3 class="font-heading text-lg font-semibold text-red-400 mb-3">Danger Zone</h3>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to PERMANENTLY delete this order? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-red-400 hover:text-red-300 font-heading font-bold py-3 px-4 rounded-lg border border-red-500/50 hover:bg-red-900/20 transition-all duration-200">
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