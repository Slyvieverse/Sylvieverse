<x-admin-layout>
    {{-- Custom Scrollbar CSS for WebKit (Chrome, Safari) --}}
    <style>
        .styled-scrollbar::-webkit-scrollbar {
            width: 10px;
            height: 10px; /* For horizontal scroll */
        }
        .styled-scrollbar::-webkit-scrollbar-thumb {
            background-color: var(--color-primary-500, #A78BFA); /* Primary color thumb */
            border-radius: 10px;
            border: 3px solid var(--color-background-800, #1F2937); /* Border matches background */
        }
        .styled-scrollbar::-webkit-scrollbar-track {
            background: var(--color-background-700, #374151); /* Dark track */
        }
    </style>
    
    <x-slot name="header">
        <h2 class="font-heading text-xl text-gray-900 dark:text-[--color-text-200] leading-tight font-bold">
            Auction Management 📈
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Main Wrapper Card --}}
            <div class="bg-white dark:bg-[--color-background-800] backdrop-blur-md rounded-xl p-8 border border-gray-200 dark:border-[--color-primary-700]/30 shadow-2xl">
                
                <h1 class="font-heading font-extrabold text-3xl text-gray-900 dark:text-[--color-text-50] mb-6">
                    All Auctions
                </h1>

                {{-- ... Search and Filter Form ... (Unchanged for brevity) ... --}}
                <form method="GET" action="{{ route('admin.auctions.index') }}" class="mb-8 p-4 bg-gray-50 dark:bg-[--color-background-700] rounded-lg border border-gray-200 dark:border-[--color-primary-700]/10 flex flex-col md:flex-row md:items-center md:space-x-4">
                    {{-- Search Input --}}
                    <div class="flex-1 mb-3 md:mb-0">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search by product name or seller..."
                               class="w-full bg-white dark:bg-[--color-background-700] border border-gray-300 dark:border-[--color-primary-700] text-gray-900 dark:text-[--color-text-200] rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 dark:focus:ring-[--color-primary-600] transition-colors shadow-sm">
                    </div>
                    
                    {{-- Status Select --}}
                    <div class="w-full md:w-48 mb-3 md:mb-0">
                        <select name="status" 
                                class="w-full bg-white dark:bg-[--color-background-700] border border-gray-300 dark:border-[--color-primary-700] text-gray-900 dark:text-[--color-text-200] rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 dark:focus:ring-[--color-primary-600] transition-colors shadow-sm">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    {{-- Filter Button --}}
                    <button type="submit" 
                            class="w-full md:w-auto mt-2 md:mt-0 bg-gradient-to-r from-fuchsia-600 to-fuchsia-500 text-white dark:text-gray-900 font-semibold rounded-lg px-6 py-2 transition-all duration-200 shadow-md shadow-fuchsia-500/30 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1 -mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter
                    </button>
                    
                    {{-- Reset Button --}}
                    @if (request()->hasAny(['search', 'status']) && (request('search') != '' || request('status') != ''))
                        <a href="{{ route('admin.auctions.index') }}" class="w-full md:w-auto mt-2 md:mt-0 text-gray-500 dark:text-[--color-text-400] hover:text-red-500 px-3 py-2 text-sm font-medium transition-colors text-center">
                            Reset
                        </a>
                    @endif
                </form>

                {{-- Header & Create Button --}}
                <div class="flex justify-end items-center mb-6 border-b border-gray-200 dark:border-[--color-primary-700]/30 pb-4">
                    <a href="{{ route('admin.auctions.create') }}"
                       class="bg-gradient-to-r from-fuchsia-600 to-fuchsia-500 dark:from-[--color-primary-600] dark:to-[--color-primary-500] text-white dark:text-gray-900 font-semibold rounded-lg px-4 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)] transition-all">
                        + Create New Auction
                    </a>
                </div>

                @if (isset($auctions) && $auctions->isEmpty())
                    <p class="text-gray-600 dark:text-[--color-text-300] text-center py-8 bg-gray-50 dark:bg-[--color-background-700] rounded-lg border border-dashed border-gray-300 dark:border-[--color-primary-700]">
                        No auctions found matching the current criteria. Try adjusting your search or filters.
                    </p>
                @else
                    {{-- ⚠️ ADDED styled-scrollbar class here --}}
                    <div class="overflow-x-auto shadow-xl rounded-lg border border-gray-200 dark:border-[--color-primary-700]/30 styled-scrollbar">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                            {{-- ... Table Content (Unchanged for brevity) ... --}}
                            <thead class="bg-gray-100 dark:bg-[--color-background-700]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Seller</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Starting Price</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Current Bid</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Bids</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Ends</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-[--color-text-200] uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-[--color-background-800] divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                                @forelse ($auctions as $auction)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-[--color-background-700]/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-[--color-text-200]">{{ $auction->id }}</td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placehold.co/50x50/374151/E5E7EB/png?text=No+Img' }}"
                                                     alt="{{ $auction->product->name }}"
                                                     class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-300 dark:border-[--color-primary-700]/50 shadow-sm">
                                                <span class="font-medium text-sm text-gray-900 dark:text-[--color-text-50]">{{ $auction->product->name }}</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-[--color-text-200]">
                                            {{ $auction->seller->name }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right text-gray-500 dark:text-[--color-primary-400]">
                                            ${{ number_format($auction->starting_price, 2) }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-right text-green-600 dark:text-green-400">
                                            ${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-700 dark:text-[--color-text-200]">
                                            {{ $auction->bid_count }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-[--color-text-200]">
                                            {{ $auction->planned_end_time->format('M d, Y H:i') }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $status_info = [
                                                    'active' => ['color' => 'bg-green-500', 'text' => 'text-white'],
                                                    'pending' => ['color' => 'bg-yellow-500', 'text' => 'text-gray-900'],
                                                    'completed' => ['color' => 'bg-blue-500', 'text' => 'text-white'],
                                                    'cancelled' => ['color' => 'bg-red-500', 'text' => 'text-white'],
                                                ][$auction->status] ?? ['color' => 'bg-gray-500', 'text' => 'text-white'];
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $status_info['color'] }} {{ $status_info['text'] }}">
                                                {{ ucfirst($auction->status) }}
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('admin.auctions.show', $auction) }}" class="text-fuchsia-600 dark:text-[--color-primary-400] hover:text-fuchsia-800 dark:hover:text-[--color-primary-500] font-medium">View</a>
                                                <a href="{{ route('admin.auctions.edit', $auction) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-500 font-medium">Edit</a>
                                                
                                                @if($auction->status === 'active')
                                                    <form action="{{ route('admin.auctions.cancel', $auction) }}" method="POST" class="inline" onsubmit="return confirm('⚠️ Are you sure you want to CANCEL this active auction? This action is usually irreversible.');">
                                                        @csrf
                                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-500 font-medium">Cancel</button>
                                                    </form>
                                                @endif
                                                
                                                <form action="{{ route('admin.auctions.destroy', $auction) }}" method="POST" class="inline" onsubmit="return confirm('🚨 WARNING: Are you sure you want to DELETE this auction and its associated product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-500 font-medium">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Empty state is handled by the check above the table --}}
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- 📄 Pagination --}}
                    <div class="mt-8">
                        {{ $auctions->links('partials.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>