
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Create New Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
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

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-[--color-text-200] mb-2">Product Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2"
                            required
                        >
                        @error('name')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-[--color-text-200] mb-2">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Field -->
                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-[--color-text-200] mb-2">Price</label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            step="0.01"
                            value="{{ old('price') }}"
                            class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2"
                            required
                        >
                        @error('price')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-medium text-[--color-text-200] mb-2">Category</label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] px-4 py-2"
                            required
                        >
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock Quantity Field -->
                    <div class="mb-6">
                        <label for="stock_quantity" class="block text-sm font-medium text-[--color-text-200] mb-2">Stock Quantity</label>
                        <input
                            type="number"
                            name="stock_quantity"
                            id="stock_quantity"
                            value="{{ old('stock_quantity') }}"
                            class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2"
                            required
                        >
                        @error('stock_quantity')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Field -->
                    <div class="mb-6">
                        <label for="is_featured" class="block text-sm font-medium text-[--color-text-200] mb-2">Featured</label>
                        <input
                            type="checkbox"
                            name="is_featured"
                            id="is_featured"
                            value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="rounded bg-[--color-background-700] border-[--color-primary-700] text-[--color-primary-500] focus:ring-[--color-primary-500]"
                        >
                        @error('is_featured')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-[--color-text-200] mb-2">Status</label>
                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] px-4 py-2"
                            required
                        >
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="mb-6">
                        <label for="image_url" class="block text-sm font-medium text-[--color-text-200] mb-2">Product Image</label>
                        <input
                            type="file"
                            name="image_url"
                            id="image_url"
                            accept="image/*"
                            class="w-full text-sm text-[--color-text-200] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[--color-primary-700] file:text-[--color-text-50] hover:file:bg-[--color-primary-600]"
                        >
                        @error('image_url')
                            <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="px-6 py-3 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium transition-all shadow-lg"
                        >
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>