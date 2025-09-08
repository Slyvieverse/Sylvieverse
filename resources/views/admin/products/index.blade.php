<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Product Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 text-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/20 text-red-400 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-[--color-text-50]">All Products</h3>
                    <a href="{{ route('admin.products.create') }}"
                       class="bg-gradient-to-r from-primary-600 to-primary-500 text-text-50 font-heading font-bold py-2 px-4 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all">
                        Create New Product
                    </a>
                </div>

                @if ($products->isEmpty())
                    <p class="text-[--color-text-200] text-center">No products found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[--color-primary-700]">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Featured
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--color-primary-700]/50">
                                @foreach ($products as $product)
                                    <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img
                                                src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                                alt="{{ $product->name }}"
                                                class="w-10 h-10 rounded-full object-cover border border-[--color-primary-700]/50"
                                            >
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[--color-text-50]">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            {{ $product->stock_quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $product->is_featured ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                                {{ $product->is_featured ? 'Yes' : 'No' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $product->status === 'active' ? 'bg-purple-500/20 text-purple-400' : 'bg-red-500/20 text-red-400' }}">
                                                {{ $product->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.products.show', $product) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-500]">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-500]">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-500 hover:text-red-600">
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
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>