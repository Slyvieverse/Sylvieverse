<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-gray-900 dark:text-gray-50 leading-tight font-bold">
            Create New Auction
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Main Wrapper Card (High Contrast Dark Mode) --}}
            <div class="bg-white dark:bg-gray-800/95 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:border-fuchsia-700/30 shadow-2xl">
                
                {{-- Success/Error Messages --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 text-green-700 dark:text-green-400 rounded-lg border border-green-500/30">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/20 text-red-700 dark:text-red-400 rounded-lg border border-red-500/30">
                        <h4 class="font-bold mb-2">Please correct the following errors:</h4>
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Header & Back Button --}}
                <div class="mb-8 flex justify-between items-center border-b border-gray-200 dark:border-fuchsia-700/50 pb-4">
                    <h1 class="font-heading text-3xl font-extrabold text-gray-900 dark:text-gray-50">
                        New Auction Entry 🏷️
                    </h1>
                    <a href="{{ route('admin.auctions.index') }}" 
                        class="flex items-center text-fuchsia-600 dark:text-fuchsia-400 hover:text-fuchsia-800 dark:hover:text-fuchsia-500 transition-colors duration-200 text-sm font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Auctions List
                    </a>
                </div>

                <form method="POST" action="{{ route('admin.auctions.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        {{-- 📅 Column 1: Schedule & Pricing --}}
                        <div class="lg:col-span-1 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-fuchsia-700/30 rounded-xl p-6 shadow-md h-fit">
                            <h3 class="font-heading text-xl font-bold text-gray-800 dark:text-gray-50 mb-4 border-b border-gray-300 dark:border-fuchsia-700/50 pb-2">
                                Auction Schedule & Pricing
                            </h3>

                            {{-- Starting Price --}}
                            <div class="mb-4">
                                <x-input-label for="starting_price" value="Starting Price ($)" class="text-gray-700 dark:text-gray-300" />
                                <input type="number" step="0.01" id="starting_price" name="starting_price" 
                                        value="{{ old('starting_price') }}" 
                                        class="form-input w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" placeholder="e.g., 50.00" required />
                                <x-input-error :messages="$errors->get('starting_price')" class="mt-2" />
                            </div>

                            {{-- Start Time --}}
                            <div class="mb-4">
                                <x-input-label for="start_time" value="Start Time" class="text-gray-700 dark:text-gray-300" />
                                <input type="datetime-local" id="start_time" name="start_time" 
                                        value="{{ old('start_time', now()->format('Y-m-d\TH:i')) }}" 
                                        class="form-input w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" required />
                                <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                            </div>

                            {{-- Planned End Time --}}
                            <div class="mb-4">
                                <x-input-label for="planned_end_time" value="Planned End Time" class="text-gray-700 dark:text-gray-300" />
                                <input type="datetime-local" id="planned_end_time" name="planned_end_time" 
                                        value="{{ old('planned_end_time', now()->addDays(7)->format('Y-m-d\TH:i')) }}" 
                                        class="form-input w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" required />
                                <x-input-error :messages="$errors->get('planned_end_time')" class="mt-2" />
                            </div>
                        </div>

                        {{-- 📦 Column 2: Product Details --}}
                        <div class="lg:col-span-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-fuchsia-700/30 rounded-xl p-6 shadow-md">
                            <h3 class="font-heading text-xl font-bold text-gray-800 dark:text-gray-50 mb-4 border-b border-gray-300 dark:border-fuchsia-700/50 pb-2">
                                New Product Details
                            </h3>

                            {{-- Product Name --}}
                            <div class="mb-4">
                                <x-input-label for="product_name" value="Product Name" class="text-gray-700 dark:text-gray-300" />
                                <input type="text" id="product_name" name="product_name" 
                                        value="{{ old('product_name') }}" 
                                        class="form-input w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" placeholder="e.g., Rare Comic Book #1" required />
                                <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                            </div>

                            {{-- Product Description --}}
                            <div class="mb-4">
                                <x-input-label for="product_description" value="Product Description" class="text-gray-700 dark:text-gray-300" />
                                <textarea id="product_description" name="product_description" rows="4"
                                            class="form-textarea w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" placeholder="A detailed description of the item being auctioned." required>{{ old('product_description') }}</textarea>
                                <x-input-error :messages="$errors->get('product_description')" class="mt-2" />
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Category Select (Assumes $categories is passed to the view) --}}
                                <div class="mb-4">
                                    <x-input-label for="category_id" value="Category" class="text-gray-700 dark:text-gray-300" />
                                    <select id="category_id" name="category_id" 
                                            class="form-select w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" required>
                                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a Category</option>
                                        {{-- Dummy Categories for illustration. Replace with actual loop: --}}
                                        @php
                                            $categories = [
                                                (object)['id' => 1, 'name' => 'Electronics'],
                                                (object)['id' => 2, 'name' => 'Art & Collectibles'],
                                                (object)['id' => 3, 'name' => 'Sports Memorabilia'],
                                            ];
                                        @endphp
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                {{-- Stock Quantity --}}
                                <div class="mb-4">
                                    <x-input-label for="stock_quantity" value="Stock Quantity (for product creation)" class="text-gray-700 dark:text-gray-300" />
                                    <input type="number" id="stock_quantity" name="stock_quantity" 
                                            value="{{ old('stock_quantity', 1) }}" min="1"
                                            class="form-input w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1 shadow-sm" required />
                                    <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Product Image --}}
                            <div class="mb-6 border-t border-gray-300 dark:border-fuchsia-700/50 pt-4">
                                <x-input-label for="image" value="Product Image (Upload File)" class="text-gray-700 dark:text-gray-300" />
                                <input type="file" id="image" name="image" 
                                        class="form-input w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-fuchsia-700 text-gray-900 dark:text-gray-50 rounded-lg px-4 py-2 focus:ring-2 focus:ring-fuchsia-500 mt-1
                                               file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold 
                                               file:bg-fuchsia-600 dark:file:bg-fuchsia-600 file:text-white 
                                               hover:file:bg-fuchsia-700 dark:hover:file:bg-fuchsia-500 cursor-pointer" 
                                        required/>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maximum file size: 2MB. Accepted formats: JPG, PNG.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end">
                        <button type="submit" 
                            class="bg-gradient-to-r from-fuchsia-600 to-fuchsia-500 text-white dark:text-gray-900 font-semibold rounded-lg px-10 py-3 transition-all duration-300 shadow-lg shadow-fuchsia-500/50 hover:shadow-xl hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2 -mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create Auction
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-admin-layout>