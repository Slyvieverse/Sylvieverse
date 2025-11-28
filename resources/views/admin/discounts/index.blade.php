<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- ⬅️ Back to Dashboard Button --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center text-gray-500 hover:text-indigo-600 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Back to Dashboard</span>
            </a>

            {{-- 🏷️ Page Title --}}
            <h2 class="font-heading text-2xl text-gray-900 leading-tight font-extrabold dark:text-[--color-text-50]">
                Discount Management
            </h2>

            <div></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 🚀 Action Header (New Position for Create Button) --}}
            <div class="flex justify-between items-center mb-6 p-4 bg-white dark:bg-[--color-background-800] rounded-xl shadow-md border border-gray-200 dark:border-[--color-primary-700]/30">
                <h1 class="font-heading text-3xl font-extrabold text-gray-900 dark:text-[--color-text-50]">
                    Active Offers
                </h1>

                {{-- ✨ Create New Discount Button --}}
                <a href="{{ route('admin.discounts.create') }}"
                    class="inline-flex items-center px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-bold shadow-lg hover:shadow-[0_4px_15px_-5px_#10b981] transition-all transform hover:scale-[1.02] text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    New Discount
                </a>
            </div>
            
            <div class="bg-white dark:bg-[--color-background-800] rounded-2xl p-8 border border-gray-200 dark:border-[--color-primary-700]/30 shadow-xl">

                {{-- 🟢 Success Message --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-600/50 text-emerald-700 dark:text-emerald-400 rounded-lg font-medium shadow-md">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                {{-- 🔎 Search/Filter Form (Light Mode Optimized) --}}
                <div class="mb-8 p-6 bg-gray-50 dark:bg-[--color-background-700] rounded-xl border border-gray-200 dark:border-[--color-primary-700]/10 shadow-inner">
                    <form method="GET" action="{{ route('admin.discounts.index') }}"
                        class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative">
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Search by value (e.g., 20% or $5.00)..."
                                    class="w-full bg-white dark:bg-[--color-background-800] border border-gray-300 dark:border-[--color-primary-700]/50 text-gray-800 dark:text-[--color-text-50] rounded-lg pl-10 pr-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent placeholder:text-gray-400 dark:placeholder:text-[--color-text-400] transition-colors shadow-sm">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400 dark:text-[--color-text-400]"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full md:w-auto bg-indigo-600 text-white font-bold rounded-xl px-6 py-3 shadow-md hover:bg-indigo-700 transition-colors transform hover:scale-[1.01]">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5 4a1 1 0 00-2 0v2.586a1 1 0 00.293.707l6 6a1 1 0 001.414 0l6-6A1 1 0 0017 6.586V4a1 1 0 00-1-1H5z" />
                                </svg>
                                Search
                            </span>
                        </button>
                    </form>
                </div>

                {{-- List Header and Item Count --}}
                <div class="flex justify-between items-end mb-4">
                    <h3 class="font-heading text-xl font-bold text-gray-800 dark:text-[--color-text-50]">Discount List</h3>

                    @if (isset($discounts) && method_exists($discounts, 'total'))
                        <p class="text-gray-500 dark:text-[--color-text-400] text-sm">
                            Showing <span class="font-semibold text-gray-700 dark:text-[--color-text-200]">{{ $discounts->firstItem() }}</span> to <span
                                class="font-semibold text-gray-700 dark:text-[--color-text-200]">{{ $discounts->lastItem() }}</span> of <span
                                class="font-semibold text-gray-700 dark:text-[--color-text-200]">{{ $discounts->total() }}</span> results
                        </p>
                    @endif
                </div>

                @if (isset($discounts) && $discounts->isEmpty())
                    <div class="text-gray-600 dark:text-[--color-text-200] text-center py-12 italic bg-gray-50 dark:bg-[--color-background-700] rounded-xl border border-gray-200 dark:border-[--color-primary-700]/10 shadow-inner">
                        <p class="text-xl mb-2">🤷‍♂️ No Discounts Found</p>
                        <p>No discounts match your current criteria. Click **New Discount** above to get started!</p>
                    </div>
                @else
                    {{-- 📜 Discounts Table --}}
                    <div class="overflow-x-auto border border-gray-200 dark:border-[--color-primary-700]/30 rounded-xl shadow-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-[--color-primary-700]/50">
                            <thead class="bg-gray-100 dark:bg-[--color-background-700]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">Applied To</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">Value</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">Start Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">End Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-[--color-text-400] uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-[--color-primary-700]/30">
                                @forelse($discounts as $discount)
                                    <tr
                                        class="bg-white dark:bg-[--color-background-800] hover:bg-gray-50 dark:hover:bg-[--color-background-700]/70 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-[--color-text-200] font-mono">{{ $discount->id }}</td>

                                        {{-- Applied To Column (Enhanced Tags) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800 dark:text-[--color-text-50]">
                                            @if ($discount->product_id)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700 ring-1 ring-indigo-300 dark:bg-indigo-600/20 dark:text-indigo-300 dark:ring-indigo-500/30">
                                                    📦 Product
                                                </span> <span class="ml-1">{{ $discount->product->name }}</span>
                                            @elseif ($discount->category_id)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-fuchsia-100 text-fuchsia-700 ring-1 ring-fuchsia-300 dark:bg-fuchsia-600/20 dark:text-fuchsia-300 dark:ring-fuchsia-500/30">
                                                    📂 Category
                                                </span> <span class="ml-1">{{ $discount->category->name }}</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 ring-1 ring-yellow-300 dark:bg-yellow-600/20 dark:text-yellow-300 dark:ring-yellow-500/30">
                                                    🌍 Site-Wide
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Discount Value Column (Updated Accent Color for Light Mode) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-lg font-extrabold text-emerald-600 dark:text-[--color-accent-400]">
                                            {{ $discount->percent_off ? $discount->percent_off . '%' : '$' . number_format($discount->fixed_off, 2) }}
                                            <span class="text-xs font-medium text-gray-500 dark:text-[--color-text-400]">OFF</span>
                                        </td>

                                        {{-- Date Columns --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-[--color-text-200]">
                                            {{ $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-[--color-text-200]">
                                            {{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('M d, Y') : 'N/A' }}
                                        </td>

                                        {{-- Status Column (Vibrant and Light/Dark optimized) --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-bold uppercase rounded-full tracking-wider
                                                @if ($discount->isActive())
                                                    bg-emerald-100 text-emerald-700 ring-1 ring-emerald-300 dark:bg-emerald-500/20 dark:text-emerald-400 dark:ring-emerald-500/30">
                                                    ✨ Active
                                                @else
                                                    bg-rose-100 text-rose-700 ring-1 ring-rose-300 dark:bg-rose-500/20 dark:text-rose-400 dark:ring-rose-500/30">
                                                    💤 Expired
                                                @endif
                                                </span>
                                        </td>

                                        {{-- Actions Column --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center justify-end space-x-4">
                                                <a href="{{ route('admin.discounts.edit', $discount) }}"
                                                    class="text-indigo-600 hover:text-indigo-800 dark:text-[--color-primary-400] dark:hover:text-[--color-primary-300] font-semibold transition-colors flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-7.5 7.5a1 1 0 00-.287.707v3.5l3.5-.287a1 1 0 00.707-.287l7.071-7.071-2.828-2.828-7.071 7.071z" />
                                                    </svg>
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST"
                                                    onsubmit="return confirm('⚠️ Are you absolutely sure you want to delete this discount (ID: {{ $discount->id }})? This action cannot be undone.');"
                                                    class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="text-rose-600 hover:text-rose-800 dark:text-rose-500 dark:hover:text-rose-400 font-semibold transition-colors flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 100 2v6a1 1 0 100-2V8z" clip-rule="evenodd" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Unreachable, but left for logical consistency --}}
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- 📄 Pagination --}}
                    <div class="mt-8">
                        @if (isset($discounts) && method_exists($discounts, 'links'))
                            {{ $discounts->links('partials.pagination') }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>