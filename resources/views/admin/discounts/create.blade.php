<x-admin-layout>
    <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 animate-fade-in">
        <h1 class="font-heading font-bold text-3xl text-[--color-text-50] mb-4">Create Discount</h1>
        @if ($errors->any())
            <div class="bg-[--color-accent-900]/20 text-[--color-accent-500] p-4 rounded-lg mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('admin.discounts.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="product_id" class="block text-[--color-text-200] font-heading">Product (Optional)</label>
                <select name="product_id" id="product_id" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-2 rounded-lg">
                    <option value="" {{ !$product_id ? 'selected' : '' }}>None (Site-Wide or Category)</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id') <p class="text-[--color-accent-500] text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-[--color-text-200] font-heading">Category (Optional)</label>
                <select name="category_id" id="category_id" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-2 rounded-lg">
                    <option value="" {{ !$category_id ? 'selected' : '' }}>None (Site-Wide or Product)</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-[--color-accent-500] text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="percent_off" class="block text-[--color-text-200] font-heading">Percent Off (%)</label>
                <input type="number" name="percent_off" id="percent_off" step="0.01" min="0" max="100" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-2 rounded-lg" placeholder="e.g., 20">
                @error('percent_off') <p class="text-[--color-accent-500] text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="fixed_off" class="block text-[--color-text-200] font-heading">Fixed Amount Off ($)</label>
                <input type="number" name="fixed_off" id="fixed_off" step="0.01" min="0" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-2 rounded-lg" placeholder="e.g., 5.00">
                @error('fixed_off') <p class="text-[--color-accent-500] text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="start_date" class="block text-[--color-text-200] font-heading">Start Date (Optional)</label>
                <input type="datetime-local" name="start_date" id="start_date" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-2 rounded-lg">
                @error('start_date') <p class="text-[--color-accent-500] text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="end_date" class="block text-[--color-text-200] font-heading">End Date (Optional)</label>
                <input type="datetime-local" name="end_date" id="end_date" class="bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] w-full p-2 rounded-lg">
                @error('end_date') <p class="text-[--color-accent-500] text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] px-6 py-3 rounded-lg font-heading hover:from-[--color-primary-700] hover:to-[--color-primary-600] transition-all">Create Discount</button>
        </form>
    </div>
</x-admin-layout>