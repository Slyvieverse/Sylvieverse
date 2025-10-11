<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl dark:text-background-200 leading-tight">
            Edit Auction #{{ $auction->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Container with Dark/Blurred Style --}}
            <div class="bg-[--color-background-800]/50 backdrop-blur-md dark:bg-background-700 rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                
                {{-- Success/Error Messages --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 text-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Add error validation handling here if using Laravel errors --}}
                {{-- @if ($errors->any()) ... @endif --}}

                <div class="mb-6 flex justify-between items-center border-b border-[--color-primary-700]/50 pb-4">
                    <h1 class="font-heading text-3xl font-bold dark:text-background-200">
                        Editing: {{ $auction->product->name }}
                    </h1>
                    <a href="{{ route('admin.auctions.show', $auction) }}" 
                       class="text-[--color-primary-400] hover:text-[--color-primary-500] transition-colors duration-200 text-sm font-semibold">
                        &larr; Back to Details
                    </a>
                </div>

                <form method="POST" action="{{ route('admin.auctions.update', $auction) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <div class="lg:col-span-1 bg-[--color-background-800] border border-[--color-primary-700]/30 rounded-xl p-6 shadow-xl h-fit">
                            <h3 class="font-heading text-xl font-bold dark:text-background-200 mb-4 border-b border-[--color-primary-700]/50 pb-2">
                                Auction Schedule & Pricing
                            </h3>

                            {{-- Starting Price --}}
                            <div class="mb-4">
                                <x-input-label for="starting_price" value="Starting Price ($)" class="dark:text-background-300" />
                                <input type="number" step="0.01" id="starting_price" name="starting_price" 
                                       value="{{ old('starting_price', $auction->starting_price) }}" 
                                       class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required />
                                <x-input-error :messages="$errors->get('starting_price')" class="mt-2" />
                            </div>

                            {{-- Start Time --}}
                            <div class="mb-4">
                                <x-input-label for="start_time" value="Start Time" class="dark:text-background-300" />
                                <input type="datetime-local" id="start_time" name="start_time" 
                                       value="{{ old('start_time', $auction->start_time->format('Y-m-d\TH:i')) }}" 
                                       class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required />
                                <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                            </div>

                            {{-- Planned End Time --}}
                            <div class="mb-4">
                                <x-input-label for="planned_end_time" value="Planned End Time" class="dark:text-background-300" />
                                <input type="datetime-local" id="planned_end_time" name="planned_end_time" 
                                       value="{{ old('planned_end_time', $auction->planned_end_time->format('Y-m-d\TH:i')) }}" 
                                       class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required />
                                <x-input-error :messages="$errors->get('planned_end_time')" class="mt-2" />
                            </div>
                            
                            {{-- Status Select --}}
                            <div class="mb-4">
                                <x-input-label for="status" value="Status" class="dark:text-background-300" />
                                <select id="status" name="status" 
                                        class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1">
                                    @php
                                        $statuses = ['pending', 'active', 'completed', 'cancelled'];
                                    @endphp
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ old('status', $auction->status) == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="lg:col-span-2 bg-[--color-background-800] border border-[--color-primary-700]/30 rounded-xl p-6 shadow-xl">
                            <h3 class="font-heading text-xl font-bold dark:text-background-200 mb-4 border-b border-[--color-primary-700]/50 pb-2">
                                Product Details
                            </h3>

                            {{-- Product Name --}}
                            <div class="mb-4">
                                <x-input-label for="product_name" value="Product Name" class="dark:text-background-300" />
                                <input type="text" id="product_name" name="product_name" 
                                       value="{{ old('product_name', $auction->product->name) }}" 
                                       class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required />
                                <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                            </div>

                            {{-- Product Description --}}
                            <div class="mb-4">
                                <x-input-label for="product_description" value="Product Description" class="dark:text-background-300" />
                                <textarea id="product_description" name="product_description" rows="4"
                                          class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required>{{ old('product_description', $auction->product->description) }}</textarea>
                                <x-input-error :messages="$errors->get('product_description')" class="mt-2" />
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Category Select (Assumes $categories is passed to the view) --}}
                                <div class="mb-4">
                                    <x-input-label for="category_id" value="Category" class="dark:text-background-300" />
                                    <select id="category_id" name="category_id" 
                                            class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $auction->product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                {{-- Stock Quantity --}}
                                <div class="mb-4">
                                    <x-input-label for="stock_quantity" value="Stock Quantity" class="dark:text-background-300" />
                                    <input type="number" id="stock_quantity" name="stock_quantity" 
                                           value="{{ old('stock_quantity', $auction->product->stock_quantity) }}" 
                                           class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1" required />
                                    <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Product Image --}}
                            <div class="mb-6 border-t border-[--color-primary-700]/50 pt-4">
                                <x-input-label for="image" value="Product Image (Optional)" class="dark:text-background-300" />
                                <input type="file" id="image" name="image" 
                                       class="w-full bg-[--color-background-700] border border-[--color-primary-700] dark:text-background-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[--color-primary-600] file:text-white hover:file:bg-[--color-primary-500]"/>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                
                                @if ($auction->product->image_url)
                                    <div class="mt-4">
                                        <p class="text-sm dark:text-background-400 mb-2">Current Image:</p>
                                        <img src="{{ asset('storage/' . $auction->product->image_url) }}" alt="Current Product Image" class="w-20 h-20 object-cover rounded-lg border border-[--color-primary-700]/50">
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end">
                        <button type="submit" 
                            class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] dark:text-background-200 font-semibold rounded-lg px-8 py-3 transition-all duration-300 hover:shadow-[0_0_20px_0_rgba(124,58,237,0.5)] transform hover:scale-[1.02]">
                            Update Auction
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-admin-layout>