<x-admin-layout>
    {{-- The inline <style> block is removed as it contains definitions now handled by tailwind.config.js --}}

    <x-slot name="header">
        <h2 class="font-heading text-xl text-text-800 dark:text-text-50 leading-tight flex items-center">
            {{-- SVG color updated for dual mode --}}
            <svg class="w-6 h-6 mr-3 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            {{-- Text gradient applied using Tailwind color utilities --}}
            <span class="bg-gradient-to-r from-primary-400 to-accent-400 bg-clip-text text-transparent">Initiate Category Creation</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Error Display: Uses standard Tailwind colors for light mode, error colors for dark mode --}}
            @if ($errors->any())
                <div class="max-w-4xl mx-auto mb-6 p-4 bg-red-100 dark:bg-error-500/20 text-red-700 dark:text-error-500 border border-red-400 dark:border-error-500 rounded-xl shadow-lg animate-fade-in">
                    <h3 class="font-heading font-bold mb-2">Category Data Input Error:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Container: Light background default, Dark gradient background for dark mode --}}
            <div class="bg-white dark:bg-background-800/70 backdrop-blur-md rounded-xl p-8 border border-gray-200 dark:border-primary-700/30 shadow-2xl dark:shadow-primary-900/10 animate-fade-in">
                <form action="{{ url('admin/categories') }}" method="POST">
                    @csrf

                    {{-- Section Title: Text color flips --}}
                    <h2 class="font-heading text-2xl text-text-800 dark:text-text-50 mb-6 border-b border-gray-300 dark:border-background-700 pb-3">Category Parameters</h2>

                    {{-- Name Field --}}
                    <div class="mb-6">
                        <label for="name" class="block font-heading text-text-800 dark:text-text-50 mb-2 required-label">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full rounded-md bg-gray-100 dark:bg-background-700 border border-gray-300 dark:border-primary-700 text-gray-800 dark:text-text-50 placeholder-gray-400 dark:placeholder-text-300 px-4 py-3
                                   focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 transition-all duration-300" required>
                        @error('name') <p class="text-red-500 dark:text-error-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    {{-- Slug Field --}}
                    <div class="mb-6">
                        <label for="slug" class="block font-heading text-text-800 dark:text-text-50 mb-2 required-label">Slug (URL Identifier)</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            class="w-full rounded-md bg-gray-100 dark:bg-background-700 border border-gray-300 dark:border-primary-700 text-gray-800 dark:text-text-50 placeholder-gray-400 dark:placeholder-text-300 px-4 py-3
                                   focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 transition-all duration-300" required>
                        <p class="text-xs text-gray-500 dark:text-text-300 mt-1">Automatically generated from the name, but can be manually overridden. Must be unique.</p>
                        @error('slug') <p class="text-red-500 dark:text-error-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description Field --}}
                    <div class="mb-8">
                        <label for="description" class="block font-heading text-text-800 dark:text-text-50 mb-2">Description (Optional)</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full rounded-md bg-gray-100 dark:bg-background-700 border border-gray-300 dark:border-primary-700 text-gray-800 dark:text-text-50 placeholder-gray-400 dark:placeholder-text-300 px-4 py-3
                                   focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-400 dark:focus:border-primary-400 transition-all duration-300">{{ old('description') }}</textarea>
                        <p class="text-xs text-gray-500 dark:text-text-300 mt-1">Provide a concise overview of this category.</p>
                        @error('description') <p class="text-red-500 dark:text-error-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-background-700">
                        {{-- Back Button: Now standard Tailwind for dual mode --}}
                        <button type="button" onclick="window.history.back()"
                                class="px-6 py-3 rounded-lg bg-gray-200 dark:bg-background-700 border border-gray-300 dark:border-text-300 text-gray-600 dark:text-text-200 font-medium transition-colors hover:bg-gray-300 dark:hover:bg-background-700/50 dark:hover:border-primary-400">
                            <i class="fas fa-arrow-left mr-2"></i> Cancel & Back
                        </button>

                        {{-- Submit Button: Neon gradient remains, but uses defined Tailwind colors --}}
                        <button type="submit"
                            class="px-8 py-3 rounded-lg bg-gradient-to-r from-primary-500 to-accent-400 hover:from-primary-600 hover:to-accent-400/90 text-text-50 font-heading font-bold transition-all duration-300 shadow-xl shadow-accent-400/30 hover:shadow-2xl hover:shadow-accent-400/50 uppercase tracking-wider transform hover:scale-[1.02]">
                            <i class="fas fa-plus-square mr-2"></i> Confirm and Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>