<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center text-background-900 dark:text-background-200 hover:text-[--color-primary-500] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>

            <h2 class="font-heading text-xl text-background-900 dark:text-background-200 leading-tight font-bold">
                Discount Management
            </h2>

            <a href="{{ route('admin.discounts.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200 font-semibold shadow-lg hover:from-[--color-primary-700] hover:to-[--color-primary-600] transition-all transform hover:scale-[1.02] text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create New Discount
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-8 border border-[--color-primary-700]/30 shadow-2xl animate-fade-in">
                
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 border border-green-600/50 text-green-400 rounded-lg font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                
                <h1 class="font-heading text-3xl font-bold text-[--color-text-50] mb-6">Discount Offers</h1>

                <div class="mb-8 p-4 bg-[--color-background-700]/50 rounded-lg border border-[--color-primary-700]/10">
                    <form method="GET" action="{{ route('admin.discounts.index') }}" class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative">
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Search by discount value (e.g., 20% or $5.00)..."
                                    class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] placeholder:text-[--color-text-400]">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-[--color-text-400]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200 font-semibold rounded-lg px-6 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)] transition-all">
                            Filter
                        </button>
                    </form>
                </div>


                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-xl font-semibold text-[--color-text-200]">All Discounts</h3>
                    
                    @if(isset($discounts) && method_exists($discounts, 'total'))
                        <p class="text-[--color-text-400] text-sm">
                            Showing <span class="font-semibold">{{ $discounts->firstItem() }}</span> to <span class="font-semibold">{{ $discounts->lastItem() }}</span> of <span class="font-semibold">{{ $discounts->total() }}</span> results
                        </p>
                    @endif
                </div>

                @if (isset($discounts) && $discounts->isEmpty())
                    <p class="text-[--color-text-200] text-center py-10 italic">No discounts match your criteria. Click "Create New Discount" to get started!</p>
                @else
                    <div class="overflow-x-auto border border-[--color-primary-700]/30 rounded-lg shadow-lg">
                        <table class="min-w-full divide-y divide-[--color-primary-700]/50">
                            <thead class="bg-[--color-background-700]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-400] uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-400] uppercase tracking-wider">Applied To</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-400] uppercase tracking-wider">Discount Value</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-400] uppercase tracking-wider">Start Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-400] uppercase tracking-wider">End Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-[--color-text-400] uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-[--color-text-400] uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--color-primary-700]/50">
                                @forelse($discounts as $discount)
                                    <tr class="bg-[--color-background-800]/70 hover:bg-[--color-background-700] transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">{{ $discount->id }}</td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[--color-text-50]">
                                            @if ($discount->product_id)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-500/20 text-indigo-300">
                                                    Product
                                                </span> {{ $discount->product->name }}
                                            @elseif ($discount->category_id)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-500/20 text-purple-300">
                                                    Category
                                                </span> {{ $discount->category->name }}
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-500/20 text-yellow-300">
                                                    Site-Wide
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[--color-accent-400]">
                                            {{ $discount->percent_off ? $discount->percent_off . '% OFF' : '$' . number_format($discount->fixed_off, 2) . ' OFF' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            {{ $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            {{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($discount->isActive())
                                                    bg-green-500/20 text-green-400
                                                @else
                                                    bg-red-500/20 text-red-400
                                                @endif">
                                                {{ $discount->isActive() ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center justify-end space-x-4">
                                                <a href="{{ route('admin.discounts.edit', $discount) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-300] font-medium transition-colors">Edit</a>
                                                
                                                <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this discount (ID: {{ $discount->id }})?');" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-400 font-medium transition-colors">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        @if(isset($discounts) && method_exists($discounts, 'links'))
                            {{ $discounts->links('partials.pagination') }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>