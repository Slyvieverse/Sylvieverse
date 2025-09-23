<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-[--background-900] to-[--background-800] py-12 px-4 sm:px-6 lg:px-8">
        <header class="text-center mb-12">
            <h1 class="font-heading font-bold text-4xl text-[--text-50] mb-4 animate-fade-in">Create New Auction</h1>
            <p class="font-body text-[--text-300] text-lg max-w-xl mx-auto">List your manhwa or manga for auction. Set your starting price and let the bids roll in!</p>
        </header>

        <div class="max-w-2xl mx-auto bg-[--background-800]/70 backdrop-blur-md border border-[--background-700] rounded-xl p-8 shadow-lg shadow-[--primary-900]/10">
            <form action="{{ route('auctions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Select -->
                <div class="mb-6">
                    <label for="product_id" class="block font-heading text-[--text-50] mb-2">Select Product</label>
                    <select id="product_id" name="product_id" class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Starting Price -->
                <div class="mb-6">
                    <label for="starting_price" class="block font-heading text-[--text-50] mb-2">Starting Price</label>
                    <input type="number" id="starting_price" name="starting_price" step="0.01" class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300" required>
                    @error('starting_price') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Start Time -->
                <div class="mb-6">
                    <label for="start_time" class="block font-heading text-[--text-50] mb-2">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time" class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300" required>
                    @error('start_time') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Planned End Time -->
                <div class="mb-6">
                    <label for="planned_end_time" class="block font-heading text-[--text-50] mb-2">End Time</label>
                    <input type="datetime-local" id="planned_end_time" name="planned_end_time" class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300" required>
                    @error('planned_end_time') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-[--primary-600] to-[--primary-500] hover:from-[--primary-700] hover:to-[--primary-600] text-[--text-50] font-heading font-bold py-4 rounded-lg transition-all duration-300 shadow-md shadow-[--primary-500]/30 hover:shadow-lg hover:shadow-[--primary-500]/50">
                    Create Auction
                </button>
            </form>
        </div>
    </div>

</x-app-layout>