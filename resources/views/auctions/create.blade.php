    <x-app-layout>
        <style>
            /* CSS Variables - Assuming a Dark Mode for the Cyberpunk Aesthetic */
            :root {
                /* Fallback/Dark Mode */
                --color-primary-400: #805AD5; /* Lavender/Purple Neon */
                --color-primary-500: #6B46C1;
                --color-primary-600: #553C9A;
                --color-primary-700: #44337A;
                --color-accent-400: #ED64A6; /* Pink Neon for emphasis */
                --color-background-700: #1A202C; /* Dark Slate */
                --color-background-800: #2D3748; /* Darker Slate */
                --color-background-900: #171923; /* Deepest Background */
                --color-text-50: #E2E8F0; /* Off-White Text */
                --color-text-300: #718096; /* Gray Text */
                --color-error: #F56565; /* Red for errors */
                --color-success: #48BB78; /* Green for success */
            }

            /* Custom Keyframes for Animations */
            @keyframes fade-in {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes slide-in-up {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Neon focus/hover effect for inputs */
            .neon-input:focus {
                box-shadow: 0 0 5px var(--color-primary-400), 0 0 8px rgba(128, 90, 213, 0.5);
                border-color: var(--color-primary-400);
            }

            /* Scrollbar styling for a futuristic touch (optional, but clean) */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-thumb { background: var(--color-primary-600); border-radius: 4px; }
            ::-webkit-scrollbar-track { background: var(--color-background-800); }
        </style>

        <div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-[--color-background-900] to-[--color-background-800] py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: linear-gradient(to right, var(--color-background-700) 1px, transparent 1px), linear-gradient(to bottom, var(--color-background-700) 1px, transparent 1px); background-size: 40px 40px;"></div>

            <div class="container mx-auto relative z-10">
                <header class="text-center mb-12 animate-[fade-in_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0s;">
                    <h1 class="font-heading font-extrabold text-5xl mb-4">
                        <span class="bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-400] bg-clip-text text-transparent">Create New Auction</span>
                    </h1>
                    <p class="font-body text-[--color-text-300] text-lg max-w-xl mx-auto">
                        List your rare collectible. Complete the form, set your auction terms, and prepare for the bidding war.
                    </p>
                    <div class="w-20 h-1 bg-gradient-to-r from-[--color-accent-400] to-transparent mx-auto mt-4"></div>
                </header>

                {{-- Flash Messages & Validation --}}
                @if(session('success'))
                    <div class="max-w-3xl mx-auto mb-6 p-4 bg-[--color-success]/20 text-[--color-success] border border-[--color-success] rounded-lg shadow-lg animate-[slide-in-up_0.3s_ease-out]">
                        {{ session('success') }} 🚀
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div class="max-w-3xl mx-auto mb-6 p-4 bg-[--color-error]/20 text-[--color-error] border border-[--color-error] rounded-lg shadow-lg animate-[slide-in-up_0.3s_ease-out]">
                        <h3 class="font-heading font-bold mb-2">Error Detected!</h3>
                        <ul class="list-disc list-inside space-y-1">
                            @if(session('error'))
                                <li>{{ session('error') }}</li>
                            @endif
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="max-w-3xl mx-auto bg-[--color-background-800]/90 backdrop-blur-lg border border-[--color-background-700] rounded-xl p-8 shadow-2xl shadow-[--color-primary-900]/20 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.2s;">
                    <form action="{{ route('auctions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h2 class="font-heading text-2xl text-[--color-primary-400] mb-6 border-b border-[--color-background-700] pb-3 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Collectible Specs
                        </h2>

                        <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.3s;">
                            <label for="name" class="block font-heading text-[--color-text-50] mb-2">Product Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300"
                                required>
                        </div>

                        <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.4s;">
                            <label for="description" class="block font-heading text-[--color-text-50] mb-2">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.5s;">
                                <label for="category_id" class="block font-heading text-[--color-text-50] mb-2">Category</label>
                                <select name="category_id" id="category_id" required
                                    class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300">
                                    <option value="" class="text-[--color-text-300]">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.6s;">
                                <label for="stock_quantity" class="block font-heading text-[--color-text-50] mb-2">Stock Quantity</label>
                                <input type="number" id="stock_quantity" name="stock_quantity" min="1" value="{{ old('stock_quantity', 1) }}"
                                    class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300"
                                    required>
                            </div>
                        </div>

                        <div class="mb-8 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.7s;">
                            <label for="image_url" class="block font-heading text-[--color-text-50] mb-2">Product Image (Max 5MB)</label>
                            <input type="file" id="image_url" name="image_url"
                                class="w-full text-[--color-text-50] font-body bg-[--color-background-700] border border-[--color-primary-700] py-3 px-4 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[--color-primary-600] file:text-[--color-text-50] hover:file:bg-[--color-primary-500] transition-all duration-300 cursor-pointer"
                                accept="image/*">
                        </div>

                        <h2 class="font-heading text-2xl text-[--color-primary-400] mb-6 border-b border-[--color-background-700] pb-3 flex items-center animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.8s;">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Pricing & Schedule
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 0.9s;">
                                <label for="starting_price" class="block font-heading text-[--color-text-50] mb-2">Starting Price ($)</label>
                                <input type="number" id="starting_price" name="starting_price" step="0.01" value="{{ old('starting_price') }}"
                                    class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300"
                                    required>
                            </div>
                            <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.0s;">
                                <label for="price" class="block font-heading text-[--color-text-50] mb-2">Retail/Base Value ($)</label>
                                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}"
                                    class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300"
                                    required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.1s;">
                                <label for="start_time" class="block font-heading text-[--color-text-50] mb-2">Auction Start Time</label>
                                <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}"
                                    class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300"
                                    required>
                            </div>

                            <div class="mb-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.2s;">
                                <label for="planned_end_time" class="block font-heading text-[--color-text-50] mb-2">Planned End Time</label>
                                <input type="datetime-local" id="planned_end_time" name="planned_end_time" value="{{ old('planned_end_time') }}"
                                    class="neon-input w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] font-body py-3 px-4 rounded-lg focus:outline-none focus:border-[--color-primary-500] transition-all duration-300"
                                    required>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[--color-primary-400] to-[--color-accent-400] hover:from-[--color-primary-500] hover:to-[--color-accent-400] text-[--color-text-50] font-heading font-extrabold text-lg py-4 rounded-lg transition-all duration-300 shadow-xl shadow-[--color-accent-400]/30 hover:shadow-2xl hover:shadow-[--color-accent-400]/50 uppercase tracking-wider mt-6 animate-[slide-in-up_0.5s_ease-out_forwards] opacity-0" style="animation-delay: 1.3s;">
                            Launch Auction Signal 🚀
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
