<x-admin-layout>
    <header class="mb-6">
        <h2 class="font-heading text-xl text-background-900 dark:text-background-200 leading-tight">
            Auction Management
        </h2>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-background-500/20 backdrop-blur-md rounded-xl p-6 border border-primary-700/30 shadow-lg animate-fade-in">
                
                <form method="GET" action="{{ route('admin.auctions.index') }}" class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                    <div class="flex-1 mb-4 sm:mb-0">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search by product name or seller..."
                               class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-background-900 dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600]">
                    </div>
                    <div class="w-full sm:w-48 mb-4 sm:mb-0">
                        <select name="status" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-background-900 dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600]">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="mt-4 sm:mt-0 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200 font-semibold rounded-lg px-4 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)]">
                        Filter
                    </button>
                </form>

                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-background-900 dark:text-background-200">All Auctions</h3>
                    <div class="flex items-center space-x-4">
                        {{-- Pagination Stats - Assuming $auctions is a paginator instance --}}
                        @if (isset($auctions) && $auctions->total() > 0)
                            <p class="text-background-900 dark:text-background-200 text-sm">
                                Showing {{ $auctions->firstItem() }} to {{ $auctions->lastItem() }} of {{ $auctions->total() }} auctions
                            </p>
                        @endif
                        <a href="{{ route('admin.auctions.create') }}"
                           class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200 font-semibold rounded-lg px-4 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)]">
                            Create Auction
                        </a>
                    </div>
                </div>

                @if (isset($auctions) && $auctions->isEmpty())
                    <p class="text-background-900 dark:text-background-200 text-center py-8">No auctions found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-primary-700 dark:divide-primary-500">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">Seller</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">Starting Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">Current Bid</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">Bids</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">End Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--color-primary-700]/50">
                                @forelse ($auctions as $auction)
                                    <tr class="hover:bg-secondary-400 dark:hover:bg-secondary-700 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200">{{ $auction->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placeholder.co/50x50' }}"
                                                     alt="{{ $auction->product->name }}"
                                                     class="w-10 h-10 rounded-full object-cover mr-3 border border-[--color-primary-700]/50">
                                                <span class="font-body text-sm text-background-900 dark:text-background-200">{{ $auction->product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200">
                                            {{ $auction->seller->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[--color-primary-400]">${{ number_format($auction->starting_price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-500">${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200">{{ $auction->bid_count }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200">{{ $auction->planned_end_time->format('M d, Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $status_color = [
                                                    'active' => 'bg-green-600 text-white',
                                                    'pending' => 'bg-yellow-600 text-white',
                                                    'completed' => 'bg-blue-600 text-white',
                                                    'cancelled' => 'bg-red-600 text-white',
                                                ][$auction->status] ?? 'bg-gray-600 text-white';
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $status_color }}">
                                                {{ ucfirst($auction->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.auctions.show', $auction) }}" class="text-[--color-primary-400] hover:text-[--color-primary-500]">View</a>
                                                <a href="{{ route('admin.auctions.edit', $auction) }}" class="text-indigo-400 hover:text-indigo-500">Edit</a>
                                                
                                                @if($auction->status === 'active')
                                                    <form action="{{ route('admin.auctions.cancel', $auction) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this auction?');">
                                                        @csrf
                                                        <button type="submit" class="text-red-500 hover:text-red-600">Cancel</button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('admin.auctions.destroy', $auction) }}" method="POST" class="inline" onsubmit="return confirm('Delete auction and product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Handled by the check above, but kept for completeness --}}
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $auctions->links('partials.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>