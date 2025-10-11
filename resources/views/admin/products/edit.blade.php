<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="flex items-center text-[--color-text-200] hover:text-[--color-primary-500] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Back to Products
            </a>
            <h2 class="font-heading text-2xl font-semibold text-[--color-text-50] leading-tight">
                Edit Product: {{ $product->name }} ✏️
            </h2>
            <div class="w-[12rem]"></div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800] rounded-2xl p-6 md:p-8 border border-[--color-primary-700]/50 shadow-2xl shadow-[--color-background-900] transform transition-all duration-300 hover:shadow-[--color-primary-900]/50">

                @if (session('success'))
                    <div class="mb-6 p-4 border border-green-600 bg-green-900/40 text-green-300 rounded-lg animate-pulse-once">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 border border-red-600 bg-red-900/40 text-red-300 rounded-lg animate-fade-in">
                        <h4 class="font-semibold mb-2">Please correct the following errors:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>🛑 {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="field-group">
                        <label for="name" class="block text-sm font-medium text-[--color-text-200] mb-2">Product Name <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] focus:border-[--color-primary-500] focus:ring focus:ring-[--color-primary-500]/50 text-[--color-text-50] placeholder-[--color-text-400] px-4 py-2 transition duration-150 ease-in-out"
                            required
                        >
                        @error('name')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="description" class="block text-sm font-medium text-[--color-text-200] mb-2">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] focus:border-[--color-primary-500] focus:ring focus:ring-[--color-primary-500]/50 text-[--color-text-50] placeholder-[--color-text-400] px-4 py-2 transition duration-150 ease-in-out"
                        >{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="field-group">
                            <label for="price" class="block text-sm font-medium text-[--color-text-200] mb-2">Price <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="price"
                                id="price"
                                step="0.01"
                                value="{{ old('price', $product->price) }}"
                                class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] focus:border-[--color-primary-500] focus:ring focus:ring-[--color-primary-500]/50 text-[--color-text-50] placeholder-[--color-text-400] px-4 py-2"
                                required
                            >
                            @error('price')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="stock_quantity" class="block text-sm font-medium text-[--color-text-200] mb-2">Stock Quantity <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="stock_quantity"
                                id="stock_quantity"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] focus:border-[--color-primary-500] focus:ring focus:ring-[--color-primary-500]/50 text-[--color-text-50] placeholder-[--color-text-400] px-4 py-2"
                                required
                            >
                            @error('stock_quantity')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="category_id" class="block text-sm font-medium text-[--color-text-200] mb-2">Category <span class="text-red-500">*</span></label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] focus:border-[--color-primary-500] focus:ring focus:ring-[--color-primary-500]/50 text-[--color-text-50] px-4 py-2 appearance-none pr-8"
                            required
                        >
                            <option value="" class="bg-[--color-background-800]">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="bg-[--color-background-800]" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="field-group">
                            <label for="status" class="block text-sm font-medium text-[--color-text-200] mb-2">Status <span class="text-red-500">*</span></label>
                            <select
                                name="status"
                                id="status"
                                class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] focus:border-[--color-primary-500] focus:ring focus:ring-[--color-primary-500]/50 text-[--color-text-50] px-4 py-2 appearance-none pr-8"
                                required
                            >
                                <option value="active" class="bg-[--color-background-800]" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" class="bg-[--color-background-800]" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-group flex items-end">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    id="is_featured"
                                    value="1"
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                    class="h-5 w-5 rounded bg-[--color-background-700] border-[--color-primary-700] text-[--color-primary-500] focus:ring-[--color-primary-500]"
                                >
                                <label for="is_featured" class="ml-2 text-sm font-medium text-[--color-text-200]">Mark as Featured</label>
                            </div>
                            @error('is_featured')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="image_url" class="block text-sm font-medium text-[--color-text-200] mb-2">Product Image (Leave blank to keep existing)</label>
                        <div class="flex items-center space-x-4">
                            <img
                                id="image-preview"
                                src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png') }}"
                                alt="Current product image"
                                class="w-20 h-20 rounded-xl object-cover border-2 border-[--color-primary-600]/70 p-0.5 shadow-md"
                            >
                            <input
                                type="file"
                                name="image_url"
                                id="image_url"
                                accept="image/*"
                                class="w-full text-sm text-[--color-text-200] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[--color-primary-600] file:text-[--color-text-50] hover:file:bg-[--color-primary-500] transition-colors duration-150"
                            >
                        </div>
                        @error('image_url')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="border-[--color-primary-700]/30 mt-8 mb-4">

                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-8 py-3 rounded-xl bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-bold text-lg transition-all shadow-lg hover:shadow-xl transform hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-[--color-primary-500]/50"
                        >
                            💾 Update Product
                        </button>
                    </div>
                </form>

                <script>
                    document.getElementById('image_url').addEventListener('change', function(event) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('image-preview').src = e.target.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    });
                </script>
            </div>
        </div>
    </div>
</x-admin-layout>