<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            User Details: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-8 border border-[--color-primary-700]/30 shadow-2xl animate-fade-in">
                
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-500] mb-8 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Users
                </a>

                <div class="flex flex-col md:flex-row md:items-start md:space-x-8 pb-6 border-b border-[--color-primary-700]/50 mb-8">
                    
                    <div class="flex-shrink-0 mb-6 md:mb-0">
                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                             alt="{{ $user->name }}'s profile picture"
                             class="w-32 h-32 rounded-full object-cover border-4 border-[--color-primary-700] shadow-xl">
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="font-heading text-3xl font-bold text-[--color-text-50] mb-2">{{ $user->name }}</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm mb-6">
                            <div>
                                <span class="text-[--color-text-200] font-medium block">Email:</span>
                                <span class="text-[--color-text-50] break-all">{{ $user->email }}</span>
                            </div>
                            <div>
                                <span class="text-[--color-text-200] font-medium block">Account Created:</span>
                                <span class="text-[--color-text-50]">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="sm:col-span-2">
                                <span class="text-[--color-text-200] font-medium block">Role:</span>
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full mt-1
                                    {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/50' : 'bg-green-500/20 text-green-400 border border-green-500/50' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex space-x-4 mt-4">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="inline-flex items-center px-4 py-2 border border-[--color-primary-600] text-sm font-medium rounded-lg text-[--color-text-50] bg-[--color-primary-700] hover:bg-[--color-primary-600] transition-colors shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit User
                            </a>
                            
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to delete this user? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-red-700 text-sm font-medium rounded-lg text-red-400 bg-red-900/30 hover:bg-red-900/50 transition-colors shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h4 class="font-heading text-xl font-bold text-[--color-text-50] mb-4">Order History ({{ $user->orders->count() }} Orders)</h4>
                    
                    @if ($user->orders->isEmpty())
                        <p class="text-[--color-text-200] italic p-4 bg-[--color-background-700] rounded-lg">This user has not placed any orders yet.</p>
                    @else
                        <div class="overflow-x-auto border border-[--color-primary-700]/30 rounded-lg shadow-inner">
                            <table class="min-w-full divide-y divide-[--color-primary-700]">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Order ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">Created At</th>
                                        <th class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[--color-primary-700]/50">
                                    @foreach ($user->orders as $order)
                                        <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[--color-text-50]">#{{ $order->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200] font-semibold">${{ number_format($order->total, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full capitalize
                                                    {{ $order->status === 'completed' ? 'bg-green-500/20 text-green-400' : 
                                                       ($order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-500] font-medium transition-colors">View Details</a>
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