<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- ⬅️ Back to Discounts Button (Consistent Style) --}}
            <a href="{{ route('admin.discounts.index') }}"
                class="flex items-center text-[--color-text-400] hover:text-[--color-primary-500] transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Back to Discounts</span>
            </a>

            {{-- ✏️ Page Title (Vibrant) --}}
            <h2 class="font-heading text-xl text-[--color-text-50] leading-tight font-extrabold">
                Editing Discount #<span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-cyan-500">{{ $discount->id }}</span>
            </h2>

            <div></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-[--color-background-800] rounded-2xl p-8 border border-[--color-primary-700]/30 shadow-2xl shadow-[--color-primary-700]/10">

                <h1 class="font-heading font-extrabold text-3xl text-[--color-text-50] mb-8 border-b border-[--color-primary-700]/20 pb-4">
                    Update Discount Details
                </h1>

                {{-- ❌ Validation Errors (Consistent Style) --}}
                @if ($errors->any())
                    <div class="bg-rose-900/40 border border-rose-600/50 text-rose-300 p-4 rounded-xl mb-6 shadow-md">
                        <p class="font-bold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Input Validation Errors
                        </p>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.discounts.update', $discount) }}" method="POST">
                    @csrf @method('PATCH')

                    <div class="space-y-6">
                        {{-- 🎯 Scope Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-[--color-background-700] rounded-xl border border-[--color-primary-700]/10 shadow-inner">
                            <h2 class="col-span-full font-semibold text-[--color-primary-500] text-lg mb-2 border-b border-[--color-primary-700]/20 pb-2">1. Define Scope (Apply To)</h2>

                            {{-- Product Dropdown --}}
                            <div class="space-y-1">
                                <label for="product_id" class="block text-sm font-bold text-[--color-text-200]">Product (Optional)</label>
                                <select name="product_id" id="product_id"
                                    class="bg-[--color-background-800] border border-[--color-primary-700]/50 text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors shadow-sm">
                                    <option value="" {{ !$discount->product_id ? 'selected' : '' }}>None (Site-Wide or Category)</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('product_id', $discount->product_id) == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Category Dropdown --}}
                            <div class="space-y-1">
                                <label for="category_id" class="block text-sm font-bold text-[--color-text-200]">Category (Optional)</label>
                                <select name="category_id" id="category_id"
                                    class="bg-[--color-background-800] border border-[--color-primary-700]/50 text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-fuchsia-500 focus:border-transparent transition-colors shadow-sm">
                                    <option value="" {{ !$discount->category_id ? 'selected' : '' }}>None (Site-Wide or Product)</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $discount->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <p class="col-span-full text-xs text-[--color-text-400] mt-2 italic">
                                * Leave both fields empty for a **Site-Wide** discount. Choosing both is generally discouraged.
                            </p>
                        </div>

                        {{-- 💰 Value Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-[--color-background-700] rounded-xl border border-[--color-primary-700]/10 shadow-inner">
                            <h2 class="col-span-full font-semibold text-[--color-primary-500] text-lg mb-2 border-b border-[--color-primary-700]/20 pb-2">2. Define Value (Choose One)</h2>

                            {{-- Percent Off Input --}}
                            <div class="space-y-1">
                                <label for="percent_off" class="block text-sm font-bold text-[--color-text-200]">Percentage Off (%)</label>
                                <div class="relative">
                                    <input type="number" name="percent_off" id="percent_off"
                                        value="{{ old('percent_off', $discount->percent_off) }}" step="0.01" min="0" max="100"
                                        class="bg-[--color-background-800] border border-[--color-primary-700]/50 text-[--color-text-50] w-full p-3 rounded-lg pl-10 focus:ring-2 focus:ring-emerald-500 focus:border-transparent placeholder:text-[--color-text-400] transition-colors shadow-sm"
                                        placeholder="e.g., 20">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-emerald-400 font-bold">%</span>
                                </div>
                                @error('percent_off') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Fixed Amount Off Input --}}
                            <div class="space-y-1">
                                <label for="fixed_off" class="block text-sm font-bold text-[--color-text-200]">Fixed Amount Off ($)</label>
                                <div class="relative">
                                    <input type="number" name="fixed_off" id="fixed_off"
                                        value="{{ old('fixed_off', $discount->fixed_off) }}" step="0.01" min="0"
                                        class="bg-[--color-background-800] border border-[--color-primary-700]/50 text-[--color-text-50] w-full p-3 rounded-lg pl-10 focus:ring-2 focus:ring-emerald-500 focus:border-transparent placeholder:text-[--color-text-400] transition-colors shadow-sm"
                                        placeholder="e.g., 5.00">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-emerald-400 font-bold">$</span>
                                </div>
                                @error('fixed_off') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <p class="col-span-full text-xs text-yellow-400 mt-2 italic bg-yellow-900/20 p-2 rounded-lg border border-yellow-700/50">
                                ⚠️ **Important:** Only one discount value field (Percent Off or Fixed Amount Off) should be filled.
                            </p>
                        </div>

                        {{-- 📅 Duration Section --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-[--color-background-700] rounded-xl border border-[--color-primary-700]/10 shadow-inner">
                            <h2 class="col-span-full font-semibold text-[--color-primary-500] text-lg mb-2 border-b border-[--color-primary-700]/20 pb-2">3. Set Duration</h2>

                            {{-- Start Date Input --}}
                            <div class="space-y-1">
                                <label for="start_date" class="block text-sm font-bold text-[--color-text-200]">Start Date (Optional)</label>
                                {{-- The 'Y-m-d\TH:i' format is required for HTML datetime-local input --}}
                                @php
                                    $start_value = $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d\TH:i') : '';
                                @endphp
                                <input type="datetime-local" name="start_date" id="start_date"
                                    value="{{ old('start_date', $start_value) }}"
                                    class="bg-[--color-background-800] border border-[--color-primary-700]/50 text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors shadow-sm">
                                @error('start_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- End Date Input --}}
                            <div class="space-y-1">
                                <label for="end_date" class="block text-sm font-bold text-[--color-text-200]">End Date (Optional)</label>
                                @php
                                    $end_value = $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d\TH:i') : '';
                                @endphp
                                <input type="datetime-local" name="end_date" id="end_date"
                                    value="{{ old('end_date', $end_value) }}"
                                    class="bg-[--color-background-800] border border-[--color-primary-700]/50 text-[--color-text-50] w-full p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors shadow-sm">
                                @error('end_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <p class="col-span-full text-xs text-[--color-text-400] mt-2 italic">
                                * The discount status depends on the current date relative to the Start and End dates.
                            </p>
                        </div>
                    </div>

                    {{-- ✅ Submit Button (Updated Gradient and Icon) --}}
                    <div class="mt-8 pt-6 border-t border-[--color-primary-700]/30">
                        <button type="submit"
                            class="w-full px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-extrabold shadow-xl hover:shadow-[0_4px_20px_-5px_var(--color-primary-500)] transition-all transform hover:scale-[1.01]">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Save Changes
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>