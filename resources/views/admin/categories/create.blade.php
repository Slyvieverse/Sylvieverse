<x-admin-layout>
    <style>
        /* CSS Variables - For a consistent Cyberpunk Dark Mode */
        :root {
            --color-primary-400: #805AD5; /* Lavender/Purple Neon */
            --color-primary-500: #6B46C1;
            --color-primary-600: #553C9A;
            --color-primary-700: #44337A;
            --color-accent-400: #ED64A6; /* Pink Neon for emphasis */
            --color-background-700: #1A202C; /* Dark Slate */
            --color-background-800: #2D3748; /* Darker Slate */
            --color-background-900: #171923; /* Deepest Background */
            --color-text-50: #E2E8F0; /* Off-White Text */
            --color-text-200: #A0AEC0; /* Lighter Gray Text */
            --color-text-300: #718096; /* Gray Text */
            --color-error: #F56565; /* Red for errors */
        }
        
        /* Custom Keyframes for Animations */
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.5s ease-out forwards; opacity: 0; }
        
        /* Neon focus/hover effect for inputs */
        .neon-input {
            transition: all 0.3s ease-in-out;
        }

        .neon-input:focus {
            box-shadow: 0 0 5px var(--color-primary-400), 0 0 8px rgba(128, 90, 213, 0.5);
            border-color: var(--color-primary-400);
            outline: none;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight flex items-center">
            <svg class="w-6 h-6 mr-3 text-[--color-accent-400]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-400] bg-clip-text text-transparent">Initiate Category Creation</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="max-w-4xl mx-auto mb-6 p-4 bg-[--color-error]/20 text-[--color-error] border border-[--color-error] rounded-xl shadow-lg animate-fade-in">
                    <h3 class="font-heading font-bold mb-2">Category Data Input Error:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-[--color-background-800]/70 backdrop-blur-md rounded-xl p-8 border border-[--color-primary-700]/30 shadow-2xl shadow-[--color-primary-900]/10 animate-fade-in">
                <form action="{{ url('admin/categories') }}" method="POST">
                    @csrf
                    
                    <h2 class="font-heading text-2xl text-[--color-text-50] mb-6 border-b border-[--color-background-700] pb-3">Category Parameters</h2>

                    <div class="mb-6">
                        <label for="name" class="block font-heading text-[--color-text-50] mb-2 required-label">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="neon-input w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-300] px-4 py-3" required>
                        @error('name') <p class="text-[--color-error] text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="slug" class="block font-heading text-[--color-text-50] mb-2 required-label">Slug (URL Identifier)</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            class="neon-input w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-300] px-4 py-3" required>
                        <p class="text-xs text-[--color-text-300] mt-1">Automatically generated from the name, but can be manually overridden. Must be unique.</p>
                        @error('slug') <p class="text-[--color-error] text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-8">
                        <label for="description" class="block font-heading text-[--color-text-50] mb-2">Description (Optional)</label>
                        <textarea name="description" id="description" rows="4"
                            class="neon-input w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-300] px-4 py-3">{{ old('description') }}</textarea>
                        <p class="text-xs text-[--color-text-300] mt-1">Provide a concise overview of this category.</p>
                        @error('description') <p class="text-[--color-error] text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <button type="button" onclick="window.history.back()" 
                                class="px-6 py-3 rounded-lg bg-[--color-background-700] border border-[--color-text-300] text-[--color-text-200] font-medium transition-colors hover:bg-[--color-background-700]/50 hover:border-[--color-primary-400]">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        
                        <button type="submit"
                            class="px-8 py-3 rounded-lg bg-gradient-to-r from-[--color-primary-500] to-[--color-accent-400] hover:from-[--color-primary-600] hover:to-[--color-accent-400]/90 text-[--color-text-50] font-heading font-bold transition-all duration-300 shadow-xl shadow-[--color-accent-400]/30 hover:shadow-2xl hover:shadow-[--color-accent-400]/50 uppercase tracking-wider">
                            <i class="fas fa-plus-square mr-2"></i> Confirm and Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>