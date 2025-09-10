<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-3xl text-[--color-text-50] leading-tight">
            Edit Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg shadow-primary-500/10 animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-500] transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Orders
                    </a>
                </div>

                <!-- Status Update Form -->
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Order Status -->
                    <div>
                        <label for="status" class="block text-[--color-text-200] font-heading font-bold text-base mb-2">
                            Order Status
                        </label>
                        <select name="status" id="status" class="w-full bg-[--color-background-700] border border-[--color-background-700] text-[--color-text-50] rounded-lg px-4 py-2 focus:border-[--color-primary-500] focus:shadow-[0_0_10px_0_rgba(186,10,245,0.3)] transition-all duration-200">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-[--color-accent-500] text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Status -->
                    <div>
                        <label for="payment_status" class="block text-[--color-text-200] font-heading font-bold text-base mb-2">
                            Payment Status
                        </label>
                        <select name="payment_status" id="payment_status" class="w-full bg-[--color-background-700] border border-[--color-background-700] text-[--color-text-50] rounded-lg px-4 py-2 focus:border-[--color-primary-500] focus:shadow-[0_0_10px_0_rgba(186,10,245,0.3)] transition-all duration-200">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $order->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                        @error('payment_status')
                            <p class="text-[--color-accent-500] text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] font-heading font-bold py-3 px-6 rounded-lg transition-all duration-200 shadow-md shadow-[--color-primary-500]/30 hover:shadow-[--color-primary-500]/40 hover:from-[--color-primary-700] hover:to-[--color-primary-600]">
                            Update Status
                        </button>
                    </div>
                </form>

                <!-- Delete Form -->
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="mt-6" onsubmit="return confirm('Are you sure you want to delete this order?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-[--color-accent-500] hover:text-[--color-accent-400] font-heading font-bold py-2 px-4 rounded-lg border border-[--color-accent-500]/50 transition-all duration-200">
                        Delete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>