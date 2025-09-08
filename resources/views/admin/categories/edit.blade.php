<!-- resources/views/admin/categories/edit.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gradient-to-br from-background-800/70 to-background-900/80 backdrop-blur-sm border border-background-700 rounded-xl p-8 shadow-lg shadow-primary-900/10 max-w-lg mx-auto animate-fade-in">
            <!-- Page Title -->
            <h1 class="font-heading font-bold text-3xl text-text-50 mb-6 text-center">Edit Category</h1>

            <!-- Category Edit Form -->
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="block font-body text-sm text-text-500 mb-2">Category Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="w-full bg-background-800/50 border border-background-700 text-text-50 font-body text-base px-4 py-3 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all duration-200"
                    >
                    @error('name')
                        <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-6">
                    <label for="description" class="block font-body text-sm text-text-500 mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full bg-background-800/50 border border-background-700 text-text-50 font-body text-base px-4 py-3 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 focus:outline-none transition-all duration-200"
                    >{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-accent-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug Display (Read-only) -->
                <div class="mb-6">
                    <label class="block font-body text-sm text-text-500 mb-2">Slug (Auto-generated)</label>
                    <p class="text-text-400 font-body text-base">{{ $category->slug }}</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-primary-600 to-primary-500 text-text-50 font-heading font-bold py-3 px-6 rounded-lg shadow-md shadow-primary-500/30 hover:from-primary-700 hover:to-primary-600 hover:shadow-lg hover:shadow-primary-500/40 transition-all duration-200"
                    >
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>