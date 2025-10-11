<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl dark:text-background-200 leading-tight">
            Auction #{{ $auction->id }} Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Container with Dark/Blurred Style --}}
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 text-green-400 rounded-lg animate-pulse-once">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    {{-- Left Side: Title & Back Button --}}
                    <div class="flex items-center space-x-4">
                         {{-- ⬅️ Back Button Added Here --}}
                        <a href="{{ route('admin.auctions.index') }}" 
                           class="flex items-center text-background-900 dark:text-background-400 hover:text-[--color-primary-400] transition-colors duration-200 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to List
                        </a>
                        <h1 class="font-heading text-3xl dark:text-background-200">Auction Details</h1>
                    </div>
                    
                    {{-- Right Side: Action Buttons --}}
                    <div class="space-x-4 flex items-center">
                        
                        <a href="{{ route('admin.auctions.edit', $auction) }}" 
                           class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] dark:text-background-200 font-semibold rounded-lg px-6 py-2 transition-all duration-300 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)]">
                            Edit Auction
                        </a>
                        
                        @if($auction->status === 'active')
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
                    
                    <div class="lg:col-span-2 bg-[--color-background-800] border border-[--color-primary-700]/30 rounded-xl p-6 shadow-xl">
                        
                        {{-- Product Image and Name --}}
                        <img src="{{ $auction->product->image_url ? asset('storage/' . $auction->product->image_url) : 'https://placeholder.co/800x600' }}" 
                             alt="{{ $auction->product->name }}" 
                             class="w-full h-80 object-cover rounded-lg mb-6 border border-[--color-primary-700]/50 transform hover:scale-[1.01] transition-transform duration-300">
                             
                        <h2 class="font-heading text-3xl font-bold dark:text-background-200 mb-2">{{ $auction->product->name }}</h2>
                        <p class="font-body dark:text-background-300 mb-6">{{ $auction->product->description }}</p>

                        {{-- Price and Time Grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 border-t border-[--color-primary-700]/50 pt-6">
                            
                            {{-- Starting Price --}}
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold dark:text-background-400 uppercase tracking-wider">Starting Price</span>
                                <p class="font-extrabold text-2xl text-[--color-primary-400]">${{ number_format($auction->starting_price, 2) }}</p>
                            </div>
                            
                            {{-- Current Bid --}}
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold dark:text-background-400 uppercase tracking-wider">Current Bid</span>
                                <p class="font-extrabold text-2xl text-green-500">${{ number_format($auction->current_bid ?? $auction->starting_price, 2) }}</p>
                            </div>

                            {{-- Status Badge --}}
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold dark:text-background-400 uppercase tracking-wider">Status</span>
                                @php
                                    $status_color = [
                                        'active' => 'bg-green-600 text-white',
                                        'pending' => 'bg-yellow-600 text-white',
                                        'completed' => 'bg-blue-600 text-white',
                                        'cancelled' => 'bg-red-600 text-white',
                                    ][$auction->status] ?? 'bg-gray-600 text-white';
                                @endphp
                                <span class="px-3 py-1 mt-1 inline-flex text-sm leading-5 font-bold rounded-full {{ $status_color }}">
                                    {{ ucfirst($auction->status) }}
                                </span>
                            </div>
                        </div>

                        {{-- Additional Details --}}
                        <div class="mt-6 space-y-3 p-4 bg-[--color-background-700] rounded-lg border border-[--color-primary-700]/20">
                            <div class="flex justify-between border-b border-[--color-primary-700]/20 pb-2">
                                <span class="dark:text-background-300">Category:</span>
                                <span class="font-medium dark:text-background-200">{{ $auction->product->category->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-[--color-primary-700]/20 pb-2">
                                <span class="dark:text-background-300">Stock Quantity:</span>
                                <span class="font-medium dark:text-background-200">{{ $auction->product->stock_quantity }}</span>
                            </div>
                            <div class="flex justify-between border-b border-[--color-primary-700]/20 pb-2">
                                <span class="dark:text-background-300">Start Time:</span>
                                <span class="font-medium dark:text-background-200">{{ $auction->start_time->format('M d, Y H:i A') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="dark:text-background-300">End Time:</span>
                                <span class="font-medium dark:text-background-200">{{ $auction->planned_end_time->format('M d, Y H:i A') }}</span>
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        
                        {{-- Seller Info Card --}}
                        <div class="bg-[--color-background-800] border border-[--color-primary-700]/30 rounded-xl p-6 shadow-lg">
                            <h3 class="font-heading text-xl font-bold dark:text-background-200 mb-4 border-b border-[--color-primary-700]/50 pb-2">Seller Information</h3>
                            <div class="space-y-3">
                                <p class="dark:text-background-200"><strong>Name:</strong> {{ $auction->seller->name }}</p>
                                <p class="dark:text-background-200"><strong>Email:</strong> {{ $auction->seller->email }}</p>
                                <a href="mailto:{{ $auction->seller->email }}" class="text-[--color-primary-400] hover:text-[--color-primary-500] text-sm font-semibold transition-colors duration-200">
                                    <i class="fas fa-envelope mr-1"></i> Contact Seller
                                </a>
                            </div>
                        </div>

                        {{-- Bid History Card --}}
                        <div class="bg-[--color-background-800] border border-[--color-primary-700]/30 rounded-xl p-6 shadow-lg">
                            <h3 class="font-heading text-xl font-bold dark:text-background-200 mb-4 border-b border-[--color-primary-700]/50 pb-2">Bid History ({{ $auction->bids->count() }} bids)</h3>
                            <div class="max-h-96 overflow-y-auto space-y-2 pr-2">
                                @forelse ($auction->bids->sortByDesc('created_at') as $bid)
                                    <div class="flex justify-between items-center bg-[--color-background-700] p-3 rounded-lg border border-[--color-primary-700]/10 hover:bg-[--color-primary-900]/20 transition-all duration-200 cursor-pointer">
                                        <div>
                                            <span class="font-medium dark:text-background-200 block">{{ $bid->bidder->name }}</span>
                                            <span class="dark:text-background-400 text-xs">{{ $bid->created_at->format('M d, H:i') }} ({{ $bid->created_at->diffForHumans() }})</span>
                                        </div>
                                        <span class="font-bold text-lg text-green-500">${{ number_format($bid->amount, 2) }}</span>
                                    </div>
                                @empty
                                    <p class="dark:text-background-400 text-center py-4">No bids have been placed yet.</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>