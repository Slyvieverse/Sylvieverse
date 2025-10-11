<x-admin-layout>
    <style>
        /* Inherited Styles for consistency */
        :root {
            --color-primary-400: #805AD5; /* Lavender/Purple Neon */
            --color-primary-500: #6B46C1;
            --color-primary-600: #553C9A;
            --color-primary-700: #44337A;
            --color-accent-400: #ED64A6; /* Pink Neon for emphasis */
            --color-background-700: #1A202C; /* Dark Slate */
            --color-background-800: #2D3748; /* Darker Slate */
            --color-background-900: #171923; /* Deepest Background */
            --color-text-50: #E2E8F0; /* Off-White Text */
            --color-text-200: #A0AEC0; /* Lighter Gray Text */
            --color-text-300: #718096; /* Gray Text */
            --color-error: #F56565; /* Red for errors */
            --color-success: #48BB78; /* Green for success */
        }

        /* Neon focus/hover effect for inputs and table rows */
        .neon-input:focus {
            box-shadow: 0 0 5px var(--color-primary-400), 0 0 8px rgba(128, 90, 213, 0.5);
            border-color: var(--color-primary-400);
            outline: none;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.5s ease-out forwards; opacity: 0; }

        /* Specific styles for dark mode text variables in the admin layout */
        .text-background-900 { color: var(--color-text-50); }
        .dark\:text-background-200 { color: var(--color-text-50); }
    </style>

    <x-slot name="header">
        <h2 class="font-heading text-xl text-background-900 leading-tight">
            Category Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/70 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-2xl shadow-[--color-primary-900]/10 animate-fade-in">
                
                @if (session('success'))
                    <div class="mb-6 p-4 bg-[--color-success]/20 text-[--color-success] rounded-lg border border-[--color-success]/50">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <form method="GET" action="{{ route('admin.categories.index') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <div class="flex-1 mb-4 sm:mb-0">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search by name or description..."
                                   class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-background-900 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600]">
                        </div>
                        <button type="submit" class="sm:w-auto bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] font-semibold rounded-lg px-4 py-2 transition-all duration-300 hover:shadow-[0_0_15px_0_rgba(128,90,213,0.4)]">
                            <i class="fas fa-filter mr-1"></i> Filter Categories
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="mt-4 sm:mt-0 sm:w-auto text-[--color-text-300] hover:text-[--color-accent-400] text-sm text-center">
                            Clear Filters
                        </a>
                    </form>
                </div>

                <div class="flex justify-between items-center mb-6 border-b border-[--color-background-700] pb-3">
                    <h3 class="font-heading text-2xl font-bold text-background-900 ">Active Categories</h3>
                    
                    <a href="{{ route('admin.categories.create') }}"
                       class="bg-gradient-to-r from-[--color-accent-400] to-[--color-primary-400] text-[--color-text-50] font-semibold rounded-lg px-4 py-2 transition-all duration-300 hover:shadow-[0_0_15px_0_rgba(237,100,166,0.5)]">
                        <i class="fas fa-plus-circle mr-1"></i> Create New Category
                    </a>
                </div>

                @if ($categories->isEmpty())
                    <p class="text-background-900 text-center py-8">No categories found matching the criteria. 💀</p>
                @else
                    {{-- THIS WRAPPER IS ADDED BACK TO ALLOW HORIZONTAL SCROLLING --}}
                    <div class="overflow-x-auto"> 
                        <table class="min-w-full divide-y divide-[--color-primary-700]">
                            <thead>
                                <tr class="bg-[--color-background-700]">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 uppercase tracking-wider min-w-[150px]">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 uppercase tracking-wider min-w-[100px]">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 uppercase tracking-wider min-w-[250px]">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 uppercase tracking-wider min-w-[150px]">Discounts</th>
                                    <th class="px-6 py-3 text-center min-w-[120px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--color-primary-700]/50">
                                @foreach($categories as $category)
                                    <tr class="hover:bg-[--color-background-700]/80 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 font-medium">{{ $category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-300]">{{ $category->slug }}</td>
                                        {{-- Removed truncate/max-w-xs to allow full content and necessitate scroll if needed --}}
                                        <td class="px-6 py-4 text-sm text-[--color-text-300]">{{ $category->description ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900">
                                            @forelse($category->discounts as $discount)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $discount->isActive() ? 'bg-[--color-success]/20 text-[--color-success]' : 'bg-yellow-500/20 text-yellow-500' }} mb-1 transition-transform hover:scale-105">
                                                    {{ $discount->percent_off ? $discount->percent_off . '% OFF' : '$' . $discount->fixed_off . ' OFF' }}
                                                </span>
                                            @empty
                                                <span class="text-[--color-text-300]">None</span>
                                            @endforelse
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center justify-center space-x-4">
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-[--color-primary-400] hover:text-[--color-primary-500] transition-colors duration-200" title="Edit Category">
                                                 Edit
                                                </a>

                                                    <a href="{{ route('admin.discounts.create') }}?category_id={{ $category->id }}" class="text-[--color-accent-400] hover:text-[--color-accent-500] transition-colors duration-200" title="Add Discount">
                                                    Discount
                                                </a>

                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to delete the category {{ $category->name }}? This action is irreversible.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-600 transition-colors duration-200" title="Delete Category">
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