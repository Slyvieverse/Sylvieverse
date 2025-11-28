<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="flex items-center text-gray-700 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Products
            </a>

            <h2 class="font-heading text-xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                Product Details
            </h2>
            
            <a href="{{ route('admin.products.edit', $product) }}"
               class="text-indigo-500 dark:text-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-300 text-sm font-semibold transition-colors">
               Edit Details
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/95 backdrop-blur-md border border-gray-200 dark:border-indigo-700/50 rounded-xl p-8 shadow-2xl">

                {{-- Product Header --}}
                <div class="mb-8 border-b border-gray-200 dark:border-indigo-700/50 pb-4">
                    <h1 class="font-heading text-4xl font-extrabold text-gray-900 dark:text-white">{{ $product->name }}</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 text-lg">{{ $product->category->name ?? 'Uncategorized' }}</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    
                    {{-- Product Image --}}
                    <div class="lg:col-span-1">
                        <div class="p-3 border border-gray-300 dark:border-indigo-700/50 rounded-lg bg-gray-50 dark:bg-gray-700 shadow-md">
                            <img
                                src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                alt="{{ $product->name }}"
                                class="w-full h-auto rounded object-cover shadow-xl transition-all duration-300 hover:shadow-2xl"
                            >
                        </div>
                    </div>

                    {{-- Product Details --}}
                    <div class="lg:col-span-2 space-y-8">
                        
                        {{-- Stats Grid --}}
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 border-b border-gray-200 dark:border-indigo-700/30 pb-6">
                            
                            <div class="flex flex-col p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-indigo-600/30">
                                <span class="text-sm font-semibold uppercase text-gray-500 dark:text-gray-400">Price</span>
                                @if ($product->activeDiscount())
                                    <span class="text-lg font-bold text-red-500 dark:text-red-400 line-through">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-xl font-extrabold text-indigo-600 dark:text-teal-400 leading-tight">${{ number_format($product->getDiscountedPrice(), 2) }}</span>
                                @else
                                    <span class="text-xl font-extrabold text-gray-900 dark:text-white leading-tight">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>

                            <div class="flex flex-col p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-indigo-600/30">
                                <span class="text-sm font-semibold uppercase text-gray-500 dark:text-gray-400">Stock</span>
                                <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $product->stock_quantity }}</span>
                            </div>

                            <div class="flex flex-col p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-indigo-600/30">
                                <span class="text-sm font-semibold uppercase text-gray-500 dark:text-gray-400">Status</span>
                                <span class="text-lg font-bold">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $product->status === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </span>
                            </div>

                            <div class="flex flex-col p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-indigo-600/30">
                                <span class="text-sm font-semibold uppercase text-gray-500 dark:text-gray-400">Featured</span>
                                <span class="text-lg font-bold">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $product->is_featured ? 'bg-indigo-500/20 text-indigo-400' : 'bg-gray-600/50 text-gray-400' }}">
                                        {{ $product->is_featured ? 'Yes' : 'No' }}
                                    </span>
                                </span>
                            </div>

                            <div class="flex flex-col p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border dark:border-indigo-600/30">
                                <span class="text-sm font-semibold uppercase text-gray-500 dark:text-gray-400">Reviews</span>
                                <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $product->reviews->count() }}</span>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div>
                            <h3 class="font-heading text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3 border-l-4 border-indigo-500 pl-3">Description</h3>
                            <div class="text-gray-700 dark:text-gray-300 leading-relaxed p-4 rounded-lg bg-gray-100 dark:bg-gray-700/50 border border-gray-200 dark:border-indigo-700/10 shadow-inner">
                                {{ $product->description ?? 'No description provided.' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Applied Discounts Section --}}
                <div class="mt-10 pt-6 border-t border-gray-200 dark:border-indigo-700/30">
                    <h3 class="font-heading text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 border-l-4 border-indigo-500 pl-3">🏷️ Applied Discounts</h3>
                    
                    <div class="space-y-3">
                        @forelse ($product->discounts as $discount)
                            <div class="flex justify-between items-center bg-gray-100 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-300 dark:border-indigo-700/20 transition-all hover:shadow-md">
                                <div>
                                    <p class="text-gray-900 dark:text-white font-heading font-semibold text-lg">
                                        {{ $discount->percent_off ? $discount->percent_off . '% Off' : '$' . number_format($discount->fixed_off, 2) . ' Fixed Off' }}
                                        <span class="ml-2 px-2 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full
                                            {{ $discount->isActive() ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                            {{ $discount->isActive() ? 'Active' : 'Expired' }}
                                        </span>
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                                        From: {{ $discount->start_date ? $discount->start_date->format('M j, Y h:i A') : 'N/A' }} 
                                        &bull; To: {{ $discount->end_date ? $discount->end_date->format('M j, Y h:i A') : 'N/A' }}
                                    </p>
                                </div>
                                <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="text-indigo-500 hover:text-indigo-400 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium">
                                    Edit
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 italic p-4 rounded-lg bg-gray-100 dark:bg-gray-700/30 border border-dashed border-gray-300 dark:border-gray-600">No product-specific discounts are currently applied.</p>
                        @endforelse
                    </div>

                    <a href="{{ route('admin.discounts.create') }}?product_id={{ $product->id }}"
                        class="inline-flex items-center justify-center mt-6 bg-gradient-to-r from-indigo-600 to-purple-500 text-white px-6 py-3 rounded-lg font-heading font-semibold hover:from-indigo-700 hover:to-purple-600 transition-all shadow-lg hover:shadow-indigo-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Discount
                    </a>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-10 pt-6 border-t border-gray-200 dark:border-indigo-700/30 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                    <a href="{{ route('admin.products.edit', $product) }}"
                        class="flex-1 text-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-500 hover:from-indigo-700 hover:to-purple-600 text-white font-heading font-medium rounded-lg transition-all shadow-lg hover:shadow-indigo-500/50">
                        <span class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                            Edit Product Details
                        </span>
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you sure you want to delete the product: {{ $product->name }}? This action is permanent.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-3 bg-red-600 dark:bg-red-500/20 text-white dark:text-red-400 hover:bg-red-700 dark:hover:bg-red-500/30 font-heading font-medium rounded-lg transition-all shadow-lg hover:shadow-red-500/50 dark:hover:shadow-red-500/50">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete Product
                            </span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>