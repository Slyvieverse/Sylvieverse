<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="flex items-center text-gray-500 dark:text-gray-300 hover:text-purple-500 transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Products
            </a>
            <h2 class="font-heading text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                Edit Product: {{ $product->name }}
            </h2>
            {{-- Placeholder to balance the header layout --}}
            <div class="w-[12rem] hidden sm:block"></div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800/95 rounded-2xl p-6 md:p-8 border border-gray-200 dark:border-violet-700/50 shadow-2xl transition-all duration-300 hover:shadow-purple-900/50">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-6 p-4 border border-green-500 bg-green-500/10 text-green-300 rounded-lg">
                        ✅ <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 p-4 border border-red-500 bg-red-500/10 text-red-300 rounded-lg">
                        <h4 class="font-bold mb-2 text-lg">Please correct the following errors:</h4>
                        <ul class="list-disc list-inside space-y-1 ml-4 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>🛑 {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    {{-- Product Name Field --}}
                    <div class="field-group">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-purple-600 focus:border-purple-500 focus:ring-purple-500 dark:focus:ring-purple-500/50 text-gray-900 dark:text-white placeholder-gray-400 px-4 py-2 transition duration-150 ease-in-out shadow-inner"
                            required
                        >
                        @error('name')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description Field --}}
                    <div class="field-group">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-purple-600 focus:border-purple-500 focus:ring-purple-500 dark:focus:ring-purple-500/50 text-gray-900 dark:text-white placeholder-gray-400 px-4 py-2 transition duration-150 ease-in-out shadow-inner"
                        >{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price and Stock Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="field-group">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="price"
                                id="price"
                                step="0.01"
                                value="{{ old('price', $product->price) }}"
                                class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-purple-600 focus:border-purple-500 focus:ring-purple-500 dark:focus:ring-purple-500/50 text-gray-900 dark:text-white placeholder-gray-400 px-4 py-2 shadow-inner"
                                required
                            >
                            @error('price')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock Quantity <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="stock_quantity"
                                id="stock_quantity"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-purple-600 focus:border-purple-500 focus:ring-purple-500 dark:focus:ring-purple-500/50 text-gray-900 dark:text-white placeholder-gray-400 px-4 py-2 shadow-inner"
                                required
                            >
                            @error('stock_quantity')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Category Select --}}
                    <div class="field-group">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select
                                name="category_id"
                                id="category_id"
                                class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-purple-600 focus:border-purple-500 focus:ring-purple-500 dark:focus:ring-purple-500/50 text-gray-900 dark:text-white px-4 py-2 appearance-none pr-10 shadow-inner"
                                required
                            >
                                <option value="" class="bg-gray-200 dark:bg-gray-800">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="bg-white dark:bg-gray-800" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Custom arrow: use absolute positioning to show a chevron/down arrow --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status and Featured Grid --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div class="field-group">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select
                                    name="status"
                                    id="status"
                                    class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-purple-600 focus:border-purple-500 focus:ring-purple-500 dark:focus:ring-purple-500/50 text-gray-900 dark:text-white px-4 py-2 appearance-none pr-10 shadow-inner"
                                    required
                                >
                                    <option value="active" class="bg-white dark:bg-gray-800" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" class="bg-white dark:bg-gray-800" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                {{-- Custom arrow --}}
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            @error('status')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-group flex items-center md:items-end pt-8 md:pt-0">
                            <div class="flex items-center space-x-2">
                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    id="is_featured"
                                    value="1"
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                    class="h-5 w-5 rounded bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-purple-600 text-purple-600 focus:ring-purple-500"
                                >
                                <label for="is_featured" class="text-sm font-medium text-gray-700 dark:text-gray-300">Mark as Featured</label>
                            </div>
                            @error('is_featured')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Image Upload Field --}}
                    <div class="field-group pt-4">
                        <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Image (Leave blank to keep existing)</label>
                        <div class="flex items-center space-x-4 p-4 border border-dashed border-gray-400 dark:border-violet-800 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                            <img
                                id="image-preview"
                                src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                alt="Current product image"
                                class="w-20 h-20 rounded-xl object-cover border-2 border-purple-600 p-0.5 shadow-md flex-shrink-0"
                            >
                            <input
                                type="file"
                                name="image_url"
                                id="image_url"
                                accept="image/*"
                                class="w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700 transition-colors duration-150 cursor-pointer"
                            >
                        </div>
                        @error('image_url')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="border-gray-300 dark:border-violet-700/30 mt-8 mb-4">

                    {{-- Submit Button --}}
                    <div class="flex justify-end pt-4">
                        <button
                            type="submit"
                            class="px-8 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-violet-500 hover:from-purple-700 hover:to-violet-600 text-white font-bold text-lg transition-all shadow-lg shadow-purple-500/50 hover:shadow-xl transform hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-purple-500/50"
                        >
                            💾 Update Product
                        </button>
                    </div>
                </form>

                <script>
                    document.getElementById('image_url').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('image-preview').src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-admin-layout>