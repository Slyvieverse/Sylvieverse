
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-background-900 dark:text-background-200 leading-tight">
            Product Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 text-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="flex-1 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <div class="flex-1 mb-4 sm:mb-0">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search by name or description..."
                                   class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-background-900 dark:text-background-200  rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600]">
                        </div>
                        <div class="w-full sm:w-48">
                            <select name="category" class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-background-900 dark:text-background-200  rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600]">
                                <option value="" {{ !request('category') ? 'selected' : '' }}>All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="mt-4 sm:mt-0 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200  font-semibold rounded-lg px-4 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)]">
                            Search
                        </button>
                    </form>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-background-900 dark:text-background-200 ">All Products</h3>
                    <div class="flex items-center space-x-4">
                        <p class="text-background-900 dark:text-background-200  text-sm">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
                        </p>
                        <a href="{{ route('admin.products.create') }}"
                           class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200  font-semibold rounded-lg px-4 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)]">
                            Create Product
                        </a>
                    </div>
                </div>

                @if ($products->isEmpty())
                    <p class="text-background-900 dark:text-background-200  text-center">No products found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[--color-primary-700]">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200  uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200  uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200  uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200  uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-background-900 dark:text-background-200  uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--color-primary-700]/50">
                                @foreach ($products as $product)
                                    <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-10 h-10 rounded-full object-cover border border-[--color-primary-700]/50">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200 ">{{ $product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200 ">{{ $product->category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200 ">${{ number_format($product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-background-900 dark:text-background-200 ">{{ $product->stock_quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-500]">Edit</a>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $products->links('partials.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
