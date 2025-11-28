<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- ⬅️ Back to Discounts Button --}}
            <a href="{{ route('admin.discounts.index') }}"
                class="flex items-center text-gray-500 dark:text-gray-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Back to Discounts</span>
            </a>

            {{-- 🏷️ Page Title (High Contrast Gradient) --}}
            <h2 class="font-heading text-xl text-gray-900 dark:text-gray-50 leading-tight font-extrabold">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-cyan-500">Create New</span> Discount
            </h2>

            {{-- Empty div for alignment with the index page header --}}
            <div class="w-5 h-5 mr-2"></div> {{-- Added div with dimensions for alignment --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800/95 rounded-2xl p-8 border border-gray-200 dark:border-fuchsia-700/30 shadow-2xl">

                <h1 class="font-heading font-extrabold text-3xl text-gray-900 dark:text-gray-50 mb-8 border-b border-gray-200 dark:border-fuchsia-700/20 pb-4">
                    Define New Discount Offer
                </h1>

                {{-- ❌ Validation Errors --}}
                @if ($errors->any())
                    <div class="bg-red-100 dark:bg-red-900/40 border border-red-400 dark:border-red-600/50 text-red-800 dark:text-red-300 p-4 rounded-xl mb-6 shadow-md">
                        <p class="font-bold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Input Validation Errors
                        </p>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.discounts.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        {{-- 🎯 Scope Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-fuchsia-700/10 shadow-inner">
                            <h2 class="col-span-full font-semibold text-fuchsia-600 dark:text-fuchsia-400 text-lg mb-2 border-b border-gray-300 dark:border-fuchsia-700/20 pb-2">1. Define Scope (Apply To)</h2>
                            
                            {{-- Product Dropdown --}}
                            <div class="space-y-1">
                                <label for="product_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Product (Optional)</label>
                                <select name="product_id" id="product_id"
                                    class="form-select bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 w-full p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors shadow-sm">
                                    <option value="" {{ !isset($product_id) || !$product_id ? 'selected' : '' }}>None (Site-Wide or Category)</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ (isset($product_id) && $product_id == $product->id) || old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Category Dropdown --}}
                            <div class="space-y-1">
                                <label for="category_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Category (Optional)</label>
                                <select name="category_id" id="category_id"
                                    class="form-select bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 w-full p-3 rounded-lg focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-colors shadow-sm">
                                    <option value="" {{ !isset($category_id) || !$category_id ? 'selected' : '' }}>None (Site-Wide or Product)</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (isset($category_id) && $category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <p class="col-span-full text-xs text-gray-500 dark:text-gray-400 mt-2 italic">
                                * Leave both fields empty for a **Site-Wide** discount. Choosing both a Product and a Category is generally ignored/discouraged (Product takes precedence).
                            </p>
                        </div>
                        
                        {{-- 💰 Value Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-fuchsia-700/10 shadow-inner">
                            <h2 class="col-span-full font-semibold text-fuchsia-600 dark:text-fuchsia-400 text-lg mb-2 border-b border-gray-300 dark:border-fuchsia-700/20 pb-2">2. Define Value (Choose One)</h2>

                            {{-- Percent Off Input --}}
                            <div class="space-y-1">
                                <label for="percent_off" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Percentage Off (%)</label>
                                <div class="relative">
                                    <input type="number" name="percent_off" id="percent_off" value="{{ old('percent_off') }}"
                                        step="0.01" min="0" max="100"
                                        class="form-input bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 w-full p-3 rounded-lg pl-10 focus:ring-2 focus:ring-emerald-500 focus:border-transparent placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-colors shadow-sm"
                                        placeholder="e.g., 20">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-emerald-500 dark:text-emerald-400 font-bold">%</span>
                                </div>
                                @error('percent_off') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Fixed Amount Off Input --}}
                            <div class="space-y-1">
                                <label for="fixed_off" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Fixed Amount Off ($)</label>
                                <div class="relative">
                                    <input type="number" name="fixed_off" id="fixed_off" value="{{ old('fixed_off') }}"
                                        step="0.01" min="0"
                                        class="form-input bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 w-full p-3 rounded-lg pl-10 focus:ring-2 focus:ring-emerald-500 focus:border-transparent placeholder:text-gray-400 dark:placeholder:text-gray-600 transition-colors shadow-sm"
                                        placeholder="e.g., 5.00">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-emerald-500 dark:text-emerald-400 font-bold">$</span>
                                </div>
                                @error('fixed_off') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <p class="col-span-full text-xs text-yellow-800 dark:text-yellow-400 mt-2 italic bg-yellow-100 dark:bg-yellow-900/20 p-2 rounded-lg border border-yellow-400 dark:border-yellow-700/50">
                                ⚠️ **Important:** Only one discount value field (Percent Off or Fixed Amount Off) should be filled. If both are filled, the system might use the percentage value.
                            </p>
                        </div>

                        {{-- 📅 Duration Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-fuchsia-700/10 shadow-inner">
                            <h2 class="col-span-full font-semibold text-fuchsia-600 dark:text-fuchsia-400 text-lg mb-2 border-b border-gray-300 dark:border-fuchsia-700/20 pb-2">3. Set Duration</h2>
                            
                            {{-- Start Date Input --}}
                            <div class="space-y-1">
                                <label for="start_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300">Start Date (Optional)</label>
                                <input type="datetime-local" name="start_date" id="start_date"
                                    value="{{ old('start_date') }}"
                                    class="form-input bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 w-full p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors shadow-sm">
                                @error('start_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- End Date Input --}}
                            <div class="space-y-1">
                                <label for="end_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300">End Date (Optional)</label>
                                <input type="datetime-local" name="end_date" id="end_date"
                                    value="{{ old('end_date') }}"
                                    class="form-input bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 w-full p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors shadow-sm">
                                @error('end_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <p class="col-span-full text-xs text-gray-500 dark:text-gray-400 mt-2 italic">
                                * Leaving the Start Date blank means the discount is active immediately. Leaving the End Date blank means the discount never expires.
                            </p>
                        </div>
                    </div>

                    {{-- ➕ Submit Button (Gradient and Shadow) --}}
                    <div class="mt-8 pt-6 border-t border-gray-300 dark:border-fuchsia-700/30">
                        <button type="submit"
                            class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-fuchsia-600 to-fuchsia-500 text-white font-extrabold shadow-lg shadow-fuchsia-500/50 hover:shadow-xl transition-all transform hover:scale-[1.01]">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Create Discount Offer
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>