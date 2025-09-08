<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Product Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.products.index') }}"
                       class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-500]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Products
                    </a>
                </div>

                <!-- Product Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image -->
                    <div>
                        <img
                            src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                            alt="{{ $product->name }}"
                            class="w-full max-w-xs rounded-lg object-cover border border-[--color-primary-700]/50"
                        >
                    </div>

                    <!-- Details -->
                    <div>
                        <h3 class="font-heading text-2xl font-bold text-[--color-text-50] mb-4">{{ $product->name }}</h3>
                        
                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Price:</span>
                            <span class="text-[--color-text-50]">${{ number_format($product->price, 2) }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Category:</span>
                            <span class="text-[--color-text-50]">{{ $product->category->name ?? 'N/A' }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Stock Quantity:</span>
                            <span class="text-[--color-text-50]">{{ $product->stock_quantity }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Featured:</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $product->is_featured ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                {{ $product->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Status:</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $product->status === 'active' ? 'bg-purple-500/20 text-purple-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $product->status }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Reviews:</span>
                            <span class="text-[--color-text-50]">{{ $product->reviews->count() }}</span>
                        </div>

                        <div class="mb-4">
                            <span class="text-[--color-text-200] font-medium">Discounts:</span>
                            <span class="text-[--color-text-50]">{{ $product->discounts->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <h4 class="font-heading text-lg font-semibold text-[--color-text-200] mb-2">Description</h4>
                    <p class="text-[--color-text-50]">
                        {{ $product->description ?? 'No description provided.' }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="px-4 py-2 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium rounded-lg transition-all">
                        Edit Product
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-500/20 text-red-400 hover:bg-red-500/30 rounded-lg transition-all">
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>