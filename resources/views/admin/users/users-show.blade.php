<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            User Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-500] mb-6">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Users
                </a>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-heading text-2xl font-bold text-[--color-text-50] mb-4">{{ $user->name }}</h3>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Email:</span>
                            <span class="text-[--color-text-50]">{{ $user->email }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Role:</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400' : 'bg-green-500/20 text-green-400' }}">
                                {{ $user->role }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Profile Picture:</span>
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                                 alt="{{ $user->name }}'s profile picture"
                                 class="w-20 h-20 rounded-full object-cover border border-[--color-primary-700]/50">
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="font-heading text-lg font-semibold text-[--color-text-200] mb-2">User Orders</h4>
                    @if ($user->orders->isEmpty())
                        <p class="text-[--color-text-200]">No orders found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-[--color-primary-700]">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Order ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Created At</th>
                                        <th class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[--color-primary-700]/50">
                                    @foreach ($user->orders as $order)
                                        <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-50]">{{ $order->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">${{ number_format($order->total, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $order->status === 'completed' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-500]">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>