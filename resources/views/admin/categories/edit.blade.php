<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        {{-- Main Container: Light background default, Dark gradient background for dark mode --}}
        <div class="bg-white dark:bg-gradient-to-br dark:from-background-800/80 dark:to-background-900/90 backdrop-blur-md border border-gray-200 dark:border-background-700 rounded-xl p-8 shadow-xl max-w-lg mx-auto animate-fade-in">
            <h1 class="font-heading font-bold text-3xl text-gray-800 dark:text-text-50 mb-8 text-center border-b border-gray-300 dark:border-primary-700 pb-3">
                ✏️ Edit Category: {{ $category->name }}
            </h1>

            @if (session('success'))
                <div class="mb-6 p-4 bg-success-500/20 text-success-500 rounded-lg border border-success-500/50">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <label for="name" class="block font-body text-sm text-gray-600 dark:text-text-500 mb-2 font-medium">Category Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="w-full bg-gray-100 dark:bg-background-800/50 border border-gray-300 dark:border-background-700 text-gray-800 dark:text-text-50 font-body text-base px-4 py-3 rounded-lg
                               focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 dark:focus:border-accent-400 dark:focus:ring-accent-500/40 focus:outline-none transition-all duration-300 shadow-sm"
                    >
                    @error('name')
                        <p class="text-red-500 dark:text-accent-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block font-body text-sm text-gray-600 dark:text-text-500 mb-2 font-medium">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full bg-gray-100 dark:bg-background-800/50 border border-gray-300 dark:border-background-700 text-gray-800 dark:text-text-50 font-body text-base px-4 py-3 rounded-lg
                               focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 dark:focus:border-accent-400 dark:focus:ring-accent-500/40 focus:outline-none transition-all duration-300 shadow-sm"
                    >{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 dark:text-accent-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8 p-3 bg-gray-100 dark:bg-background-700/50 rounded-lg border border-gray-300 dark:border-background-700/70">
                    <label class="block font-body text-sm text-gray-500 dark:text-text-400 mb-1">Slug (Read-only)</label>
                    <p class="text-gray-700 dark:text-text-200 font-mono text-sm break-all">{{ $category->slug }}</p>
                </div>

                <div class="flex justify-between items-center mt-6">
                    {{-- Cancel Button --}}
                    <a href="{{ route('admin.categories.index') }}"
                        class="inline-flex items-center text-sm text-gray-500 dark:text-text-300 hover:text-gray-700 dark:hover:text-text-100 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Categories
                    </a>

                    {{-- Submit Button: Stronger, more interactive gradient --}}
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-primary-600 to-primary-500 text-text-50 font-heading font-bold py-3 px-6 rounded-xl shadow-lg shadow-primary-500/30
                               hover:from-primary-700 hover:to-primary-600 hover:shadow-xl hover:shadow-primary-500/50 transition-all duration-300 transform hover:scale-[1.02]"
                    >
                        Save Changes 
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>