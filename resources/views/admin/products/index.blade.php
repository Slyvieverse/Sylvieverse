<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-gray-900 dark:text-gray-200 leading-tight">
            Product Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/95 backdrop-blur-md rounded-xl p-6 border border-gray-300 dark:border-indigo-700/30 shadow-lg animate-fade-in">
                
                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-400 rounded-lg border border-green-400 dark:border-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Search and Filter Form --}}
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="flex-1 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <div class="flex-1 mb-4 sm:mb-0">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search by name or description..."
                                class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-indigo-600 text-gray-900 dark:text-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 transition duration-150 ease-in-out">
                        </div>
                        <div class="w-full sm:w-48">
                            <select name="category" class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-indigo-600 text-gray-900 dark:text-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 transition duration-150 ease-in-out">
                                <option value="" {{ !request('category') ? 'selected' : '' }}>All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="mt-4 sm:mt-0 bg-gradient-to-r from-indigo-600 to-fuchsia-500 text-white font-semibold rounded-lg px-4 py-2 hover:shadow-lg hover:shadow-indigo-500/50 transition duration-200">
                            Search
                        </button>
                    </form>
                </div>

                {{-- Header and Create Button --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-gray-900 dark:text-gray-200">All Products</h3>
                    <div class="flex items-center space-x-4">
                        <p class="text-gray-600 dark:text-gray-400 text-sm hidden sm:block">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
                        </p>
                        <a href="{{ route('admin.products.create') }}"
                           class="bg-gradient-to-r from-indigo-600 to-fuchsia-500 text-white font-semibold rounded-lg px-4 py-2 hover:shadow-lg hover:shadow-indigo-500/50 transition duration-200 flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create Product
                        </a>
                    </div>
                </div>

                @if ($products->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400 text-center py-10">No products found matching your criteria.</p>
                @else
                    {{-- Products Table --}}
                    <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-3 text-right">Actions</th> </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700/50">
                                @foreach ($products as $product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                                alt="{{ $product->name }}"
                                                class="w-10 h-10 rounded-full object-cover border border-gray-300 dark:border-indigo-700/50">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">{{ $product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $product->category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">${{ number_format($product->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $product->stock_quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('admin.products.show', $product->id) }}"
                                                   class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-500 font-medium">View</a>
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                   class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-500 font-medium">Edit</a>
                                                
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-500 font-medium">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- Pagination Links --}}
                    <div class="mt-6">
                        {{-- Assuming 'partials.pagination' renders standard Tailwind pagination links --}}
                        {{ $products->links('partials.pagination') }} 
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>