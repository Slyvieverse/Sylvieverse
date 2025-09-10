<x-admin-layout>
       <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-8 shadow-lg animate-fade-in">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-heading text-3xl font-bold text-[--color-text-50]">{{ $product->name }}</h2>
                <a href="{{ route('admin.products.index') }}"
                   class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-300] font-heading transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Products
                </a>
            </div>

            <!-- Product Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Image -->
                <div class="flex justify-center">
                    <img
                        src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                        alt="{{ $product->name }}"
                        class="w-full max-w-sm rounded-lg object-cover border border-[--color-primary-700]/50 shadow-md"
                    >
                </div>

                <!-- Details -->
                <div class="space-y-4">
                    <div>
                        <span class="text-[--color-text-200] font-heading font-medium">Price:</span>
                        <span class="text-[--color-text-50] ml-2">${{ number_format($product->price, 2) }}</span>
                        @if ($product->activeDiscount())
                            <span class="text-[--color-accent-400] ml-2">(Discounted: ${{ number_format($product->getDiscountedPrice(), 2) }})</span>
                        @endif
                    </div>
                    <div>
                        <span class="text-[--color-text-200] font-heading font-medium">Category:</span>
                        <span class="text-[--color-text-50] ml-2">{{ $product->category->name ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-[--color-text-200] font-heading font-medium">Stock Quantity:</span>
                        <span class="text-[--color-text-50] ml-2">{{ $product->stock_quantity }}</span>
                    </div>
                    <div>
                        <span class="text-[--color-text-200] font-heading font-medium">Featured:</span>
                        <span class="px-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $product->is_featured ? 'bg-[--color-accent-500]/20 text-[--color-accent-400]' : 'bg-[--color-background-700]/50 text-[--color-text-500]' }}">
                            {{ $product->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-[--color-text-200] font-heading font-medium">Status:</span>
                        <span class="px-2 ml-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $product->status === 'active' ? 'bg-[--color-primary-500]/20 text-[--color-primary-400]' : 'bg-[--color-accent-500]/20 text-[--color-accent-400]' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                    <div>
                        <span class="text-[--color-text-200] font-heading font-medium">Reviews:</span>
                        <span class="text-[--color-text-50] ml-2">{{ $product->reviews->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-8">
                <h3 class="font-heading text-xl font-semibold text-[--color-text-200] mb-3">Description</h3>
                <p class="text-[--color-text-50] leading-relaxed">
                    {{ $product->description ?? 'No description provided.' }}
                </p>
            </div>

            <!-- Discounts -->
            <div class="mt-8">
                <h3 class="font-heading text-xl font-semibold text-[--color-text-200] mb-3">Discounts</h3>
                @forelse ($product->discounts as $discount)
                    <div class="bg-[--color-background-700]/50 p-4 rounded-lg mb-3 border border-[--color-primary-700]/20">
                        <p class="text-[--color-text-50] font-heading">
                            {{ $discount->percent_off ? $discount->percent_off . '% off' : '$' . number_format($discount->fixed_off, 2) . ' off' }}
                            <span class="text-[--color-text-200] text-sm">
                                ({{ $discount->isActive() ? 'Active' : 'Inactive' }})
                            </span>
                        </p>
                        <p class="text-[--color-text-200] text-sm">
                            From: {{ $discount->start_date ? $discount->start_date->format('Y-m-d H:i') : 'N/A' }} |
                            To: {{ $discount->end_date ? $discount->end_date->format('Y-m-d H:i') : 'N/A' }}
                        </p>
                    </div>
                @empty
                    <p class="text-[--color-text-200] italic">No discounts applied.</p>
                @endforelse
                <a href="{{ route('admin.discounts.create') }}?product_id={{ $product->id }}"
                   class="inline-block mt-4 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] px-4 py-2 rounded-lg font-heading hover:from-[--color-primary-700] hover:to-[--color-primary-600] transition-all">
                    Add Discount
                </a>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <a href="{{ route('admin.products.edit', $product) }}"
                   class="flex-1 text-center px-4 py-3 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-700] hover:to-[--color-primary-600] text-[--color-text-50] font-heading font-medium rounded-lg transition-all">
                    Edit Product
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-3 bg-[--color-accent-500]/20 text-[--color-accent-400] hover:bg-[--color-accent-500]/30 font-heading font-medium rounded-lg transition-all">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>