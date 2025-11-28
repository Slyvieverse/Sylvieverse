<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-gray-900 dark:text-gray-50 leading-tight font-bold">
            Auction #{{ $auction->id }} Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Main Wrapper Card (High Contrast Dark Mode) --}}
            <div class="bg-white dark:bg-gray-800/95 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:border-fuchsia-700/30 shadow-2xl">

                @if(session('success'))
                    {{-- Adjusted colors for success message --}}
                    <div class="mb-6 p-4 bg-green-500/20 text-green-700 dark:text-green-400 rounded-lg border border-green-500/30 animate-pulse-once">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Header, Title & Action Buttons --}}
                <div class="flex justify-between items-center mb-8 border-b border-gray-200 dark:border-fuchsia-700/50 pb-4">
                    
                    {{-- Left Side: Title & Back Button --}}
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.auctions.index') }}" 
                           class="flex items-center text-gray-700 dark:text-gray-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors duration-200 font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to List
                        </a>
                        <h1 class="font-heading text-3xl font-extrabold text-gray-900 dark:text-gray-50">Auction Details</h1>
                    </div>
                    
                    {{-- Right Side: Action Buttons --}}
                    <div class="space-x-4 flex items-center">
                        
                        {{-- Edit Button (Fuchsia Primary Style) --}}
                        <a href="{{ route('admin.auctions.edit', $auction) }}" 
                           class="bg-gradient-to-r from-fuchsia-600 to-fuchsia-500 text-white font-semibold rounded-lg px-6 py-2 transition-all duration-300 shadow-md hover:shadow-lg hover:scale-[1.02]">
                            Edit Auction
                        </a>
                        
                        @if($auction->status === 'active')
                            {{-- Close Button (Red Danger Style) --}}
                            <form action="{{ route('admin.auctions.close', $auction) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to manually close this active auction?')"
                                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300 shadow-md">
                                    Close Auction
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- COLUMN 1: Product & Pricing Details --}}
                    <div class="lg:col-span-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-fuchsia-700/30 rounded-xl p-6 shadow-xl">
                        
                        {{-- Product Image --}}
                        <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placeholder.co/800x600' }}" 
                             alt="{{ $auction->product->name }}" 
                             class="w-full h-80 object-cover rounded-lg mb-6 border border-gray-300 dark:border-fuchsia-700/50 transform hover:scale-[1.01] transition-transform duration-300 shadow-lg">
                             
                        <h2 class="font-heading text-3xl font-bold text-gray-900 dark:text-gray-50 mb-2">{{ $auction->product->name }}</h2>
                        <p class="font-body text-gray-700 dark:text-gray-300 mb-6">{{ $auction->product->description }}</p>

                        {{-- Price and Status Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 border-t border-gray-300 dark:border-fuchsia-700/50 pt-6">
                            
                            {{-- Starting Price --}}
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Starting Price</span>
                                <p class="font-extrabold text-2xl text-fuchsia-600 dark:text-fuchsia-400">${{ number_format($auction->starting_price, 2) }}</p>
                            </div>
                            
                            {{-- Current Bid --}}
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Current Bid</span>
                                <p class="font-extrabold text-2xl text-green-600 dark:text-green-500">${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}</p>
                            </div>

                            {{-- Status Badge --}}
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</span>
                                @php
                                    $status_color = [
                                        'active' => 'bg-green-600 text-white',
                                        'pending' => 'bg-yellow-500 text-gray-900',
                                        'completed' => 'bg-blue-600 text-white',
                                        'cancelled' => 'bg-red-600 text-white',
                                    ][$auction->status] ?? 'bg-gray-500 text-white';
                                @endphp
                                <span class="px-3 py-1 mt-1 inline-flex text-sm leading-5 font-bold rounded-full {{ $status_color }}">
                                    {{ ucfirst($auction->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- Additional Details Box --}}
                        <div class="mt-6 space-y-3 p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-fuchsia-700/20 shadow-inner">
                            <div class="flex justify-between border-b border-gray-200 dark:border-fuchsia-700/20 pb-2">
                                <span class="text-gray-500 dark:text-gray-300">Category:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-50">{{ $auction->product->category->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 dark:border-fuchsia-700/20 pb-2">
                                <span class="text-gray-500 dark:text-gray-300">Stock Quantity:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-50">{{ $auction->product->stock_quantity }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-200 dark:border-fuchsia-700/20 pb-2">
                                <span class="text-gray-500 dark:text-gray-300">Start Time:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-50">{{ $auction->start_time->format('M d, Y H:i A') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-300">End Time:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-50">{{ $auction->planned_end_time->format('M d, Y H:i A') }}</span>
                            </div>
                        </div>

                    </div>

                    {{-- COLUMN 2: Seller & Bid History --}}
                    <div class="lg:col-span-1 space-y-6">
                        
                        {{-- Seller Info Card --}}
                        <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-fuchsia-700/30 rounded-xl p-6 shadow-lg">
                            <h3 class="font-heading text-xl font-bold text-gray-800 dark:text-gray-50 mb-4 border-b border-gray-300 dark:border-fuchsia-700/50 pb-2">Seller Information</h3>
                            <div class="space-y-3">
                                <p class="text-gray-900 dark:text-gray-50"><strong>Name:</strong> {{ $auction->seller->name }}</p>
                                <p class="text-gray-900 dark:text-gray-50"><strong>Email:</strong> {{ $auction->seller->email }}</p>
                                <a href="mailto:{{ $auction->seller->email }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:text-fuchsia-700 dark:hover:text-fuchsia-500 text-sm font-semibold transition-colors duration-200">
                                    <i class="fas fa-envelope mr-1"></i> Contact Seller
                                </a>
                            </div>
                        </div>

                        {{-- Bid History Card --}}
                        <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-fuchsia-700/30 rounded-xl p-6 shadow-lg">
                            <h3 class="font-heading text-xl font-bold text-gray-800 dark:text-gray-50 mb-4 border-b border-gray-300 dark:border-fuchsia-700/50 pb-2">Bid History ({{ $auction->bids->count() }} bids)</h3>
                            
                            {{-- Bid List Container (High Contrast Background) --}}
                            <div class="max-h-96 overflow-y-auto space-y-2 pr-2">
                                @forelse ($auction->bids->sortByDesc('created_at') as $bid)
                                    <div class="flex justify-between items-center bg-white dark:bg-gray-900 p-3 rounded-lg border border-gray-200 dark:border-fuchsia-700/10 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 cursor-pointer">
                                        <div>
                                            <span class="font-medium text-gray-900 dark:text-gray-50 block">{{ $bid->bidder->name }}</span>
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">{{ $bid->created_at->format('M d, H:i') }} ({{ $bid->created_at->diffForHumans() }})</span>
                                        </div>
                                        <span class="font-bold text-lg text-green-600 dark:text-green-500">${{ number_format($bid->amount, 2) }}</span>
                                    </div>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">No bids have been placed yet.</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>