<x-admin-layout>

    <x-slot name="header">
        <h2 class="font-heading text-xl text-text-800 dark:text-text-50 leading-tight">
            Category Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--
                The background is set to use 'background-50' (light) / 'background-800' (dark)
                The border/shadow colors are replaced with your configured primary/secondary colors.
            --}}
            <div class="bg-background-50 dark:bg-background-800/70 backdrop-blur-md rounded-xl p-6 border border-primary-300 dark:border-primary-700/30 shadow-2xl dark:shadow-primary-900/10 animate-fade-in">

                @if (session('success'))
                    <div class="mb-6 p-4 bg-success-500/20 text-success-500 rounded-lg border border-success-500/50">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <form method="GET" action="{{ route('admin.categories.index') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <div class="flex-1 mb-4 sm:mb-0">
                            {{-- Input using standard Tailwind colors for border/background/text and a custom 'focus' effect --}}
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search by name or description..."
                                   class="w-full bg-background-100 dark:bg-background-700 border border-primary-300 dark:border-primary-700 text-text-700 dark:text-text-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary-600 focus:border-primary-600 transition-colors duration-300">
                        </div>
                        <button type="submit" class="sm:w-auto bg-gradient-to-r from-primary-600 to-primary-500 text-text-50 font-semibold rounded-lg px-4 py-2 transition-all duration-300 hover:shadow-lg hover:shadow-primary-400/50">
                            <i class="fas fa-filter mr-1"></i> Filter Categories
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="mt-4 sm:mt-0 sm:w-auto text-text-500 dark:text-text-300 hover:text-accent-400 text-sm text-center">
                            Clear Filters
                        </a>
                    </form>
                </div>

                <div class="flex justify-between items-center mb-6 border-b border-background-700 dark:border-background-700 pb-3">
                    {{-- Title text flips color based on theme --}}
                    <h3 class="font-heading text-2xl font-bold text-text-800 dark:text-text-50">Active Categories</h3>

                    <a href="{{ route('admin.categories.create') }}"
                       class="bg-gradient-to-r from-accent-400 to-primary-400 text-text-50 font-semibold rounded-lg px-4 py-2 transition-all duration-300 hover:shadow-lg hover:shadow-accent-400/50">
                        <i class="fas fa-plus-circle mr-1"></i> Create New Category
                    </a>
                </div>

                @if ($categories->isEmpty())
                    <p class="text-text-500 dark:text-text-200 text-center py-8">No categories found matching the criteria. 💀</p>
                @else
                    {{-- Table for categories --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-primary-300 dark:divide-primary-700">
                            <thead>
                                {{-- Header Row Background/Text --}}
                                <tr class="bg-background-200 dark:bg-background-700">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-text-600 dark:text-text-200 uppercase tracking-wider min-w-[150px]">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-text-600 dark:text-text-200 uppercase tracking-wider min-w-[100px]">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-text-600 dark:text-text-200 uppercase tracking-wider min-w-[250px]">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-text-600 dark:text-text-200 uppercase tracking-wider min-w-[150px]">Discounts</th>
                                    <th class="px-6 py-3 text-center min-w-[120px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary-300 dark:divide-primary-700/50">
                                @foreach($categories as $category)
                                    {{-- Row background changes on hover --}}
                                    <tr class="bg-background-50 dark:bg-transparent hover:bg-background-200 dark:hover:bg-background-700/80 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-800 dark:text-text-50 font-medium">{{ $category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-500 dark:text-text-300">{{ $category->slug }}</td>
                                        <td class="px-6 py-4 text-sm text-text-500 dark:text-text-300">{{ $category->description ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-800 dark:text-text-50">
                                            @forelse($category->discounts as $discount)
                                                {{-- Success/Warning colors are preserved --}}
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $discount->isActive() ? 'bg-success-500/20 text-success-500' : 'bg-yellow-500/20 text-yellow-500' }} mb-1 transition-transform hover:scale-105">
                                                    {{ $discount->percent_off ? $discount->percent_off . '% OFF' : '$' . $discount->fixed_off . ' OFF' }}
                                                </span>
                                            @empty
                                                <span class="text-text-500 dark:text-text-300">None</span>
                                            @endforelse
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center justify-center space-x-4">
                                                {{-- Primary color for Edit --}}
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-500 transition-colors duration-200" title="Edit Category">
                                                   Edit
                                                </a>

                                                {{-- Accent color for Discount --}}
                                                <a href="{{ route('admin.discounts.create') }}?category_id={{ $category->id }}" class="text-accent-600 dark:text-accent-400 hover:text-accent-700 dark:hover:text-accent-500 transition-colors duration-200" title="Add Discount">
                                                    Discount
                                                </a>

                                                {{-- Error color for Delete (kept standard for clear signaling) --}}
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to delete the category {{ $category->name }}? This action is irreversible.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-500 hover:text-red-700 dark:hover:text-red-600 transition-colors duration-200" title="Delete Category">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        {{ $categories->appends(request()->query())->links('partials.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>