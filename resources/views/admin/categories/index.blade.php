<x-admin-layout>
    <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 animate-fade-in">
        <h1 class="font-heading font-bold text-3xl text-[--color-text-50] mb-4">Categories</h1>

        @if (session('success'))
            <div class="bg-[--color-primary-900]/20 text-[--color-text-50] p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Form (without status filter) -->
        <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-6 flex flex-col md:flex-row gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or description" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] p-2 rounded-lg w-full md:w-1/3">
            <button type="submit" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] px-4 py-2 rounded-lg font-heading">Filter</button>
            <a href="{{ route('admin.categories.index') }}" class="text-[--color-text-200] px-4 py-2">Clear</a>
        </form>

        <!-- Button to Create New Category -->
        <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] font-heading font-bold py-2 px-4 rounded-lg mb-4 inline-block">Create New Category</a>

        <!-- Categories Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-[--color-text-200]">
                <thead>
                    <tr class="bg-[--color-background-700]">
                        <th class="p-4 text-left">Name</th>
                        <th class="p-4 text-left">Slug</th>
                        <th class="p-4 text-left">Description</th>
                        <th class="p-4 text-left">Discounts</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="hover:bg-[--color-background-700]">
                            <td class="p-4">{{ $category->name }}</td>
                            <td class="p-4">{{ $category->slug }}</td>
                            <td class="p-4">{{ $category->description ?? 'N/A' }}</td>
                            <td class="p-4">
                                @forelse($category->discounts as $discount)
                                    <div class="mb-1">
                                        {{ $discount->percent_off ? $discount->percent_off . '% off' : '$' . $discount->fixed_off . ' off' }}
                                        ({{ $discount->isActive() ? 'Active' : 'Inactive' }})
                                    </div>
                                @empty
                                    None
                                @endforelse
                            </td>
                            <td class="p-4 flex space-x-2">
                                <!-- Edit Link -->
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-[--color-primary-400] hover:text-[--color-primary-300]">Edit</a>

                                <!-- Add Discount Link -->
                                <a href="{{ route('admin.discounts.create') }}?category_id={{ $category->id }}" class="text-[--color-primary-400] hover:text-[--color-primary-300]">Add Discount</a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[--color-accent-500] hover:text-[--color-accent-400]">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-[--color-text-500]">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $categories->appends(request()->query())->links('partials.pagination') }}
        </div>
    </div>
</x-admin-layout>
