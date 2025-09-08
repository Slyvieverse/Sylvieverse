<!-- resources/views/admin/categories-create.blade.php -->

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Create New Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg">
                <form action="{{ url('admin/categories') }}" method="POST">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-[--color-text-200] mb-2">Category Name</label>
                        <input type="text" name="name" id="name" class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2" required>
                    </div>

                    <!-- Slug Field -->
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-[--color-text-200] mb-2">Slug</label>
                        <input type="text" name="slug" id="slug" class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2" required>
                        <p class="text-xs text-[--color-text-200] mt-1">This will be used in URLs (e.g., manhwa-series).</p>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-[--color-text-200] mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="px-6 py-3 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium transition-all shadow-lg">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
