<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.discounts.index') }}" class="flex items-center text-background-900 dark:text-background-200 hover:text-[--color-primary-500] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Discounts
            </a>

            <h2 class="font-heading text-xl text-background-900 dark:text-background-200 leading-tight">
                Create New Discount
            </h2>
            
            <div></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                
                <h1 class="font-heading font-bold text-3xl text-[--color-text-50] mb-6">Define New Discount Offer</h1>

                @if ($errors->any())
                    <div class="bg-red-900/40 border border-red-600/50 text-red-300 p-4 rounded-lg mb-6">
                        <p class="font-bold mb-2">Please correct the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.discounts.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="space-y-1">
                            <label for="product_id" class="block text-sm font-medium text-[--color-text-200]">Product (Optional)</label>
                            <select name="product_id" id="product_id" 
                                class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-[--color-primary-600] transition-colors">
                                <option value="" {{ !isset($product_id) || !$product_id ? 'selected' : '' }}>None (Site-Wide or Category)</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ (isset($product_id) && $product_id == $product->id) || old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="category_id" class="block text-sm font-medium text-[--color-text-200]">Category (Optional)</label>
                            <select name="category_id" id="category_id" 
                                class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-[--color-primary-600] transition-colors">
                                <option value="" {{ !isset($category_id) || !$category_id ? 'selected' : '' }}>None (Site-Wide or Product)</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (isset($category_id) && $category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="percent_off" class="block text-sm font-medium text-[--color-text-200]">Percent Off (%)</label>
                            <input type="number" name="percent_off" id="percent_off" value="{{ old('percent_off') }}" step="0.01" min="0" max="100" 
                                class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-[--color-primary-600] placeholder:text-[--color-text-400]" 
                                placeholder="e.g., 20">
                            @error('percent_off') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="fixed_off" class="block text-sm font-medium text-[--color-text-200]">Fixed Amount Off ($)</label>
                            <input type="number" name="fixed_off" id="fixed_off" value="{{ old('fixed_off') }}" step="0.01" min="0" 
                                class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-[--color-primary-600] placeholder:text-[--color-text-400]" 
                                placeholder="e.g., 5.00">
                            @error('fixed_off') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="space-y-1">
                            <label for="start_date" class="block text-sm font-medium text-[--color-text-200]">Start Date (Optional)</label>
                            <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}" 
                                class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-[--color-primary-600] transition-colors">
                            @error('start_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="end_date" class="block text-sm font-medium text-[--color-text-200]">End Date (Optional)</label>
                            <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                                class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-[--color-primary-600] transition-colors">
                            @error('end_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-[--color-primary-700]/30">
                        <button type="submit" class="w-full md:w-auto px-6 py-3 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-background-900 dark:text-background-200 font-semibold shadow-lg hover:shadow-[0_0_15px_0_rgba(124,58,237,0.5)] transition-all transform hover:scale-[1.01]">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Create Discount
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>