<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[--background-900] to-[--background-800] py-12 px-4 sm:px-6 lg:px-8">
        <header class="text-center mb-12">
            <h1 class="font-heading font-bold text-4xl text-[--text-50] mb-4 animate-fade-in">Edit Auction</h1>
            <p class="font-body text-[--text-300] text-lg max-w-xl mx-auto">
                Update your auction details and product information.
            </p>
        </header>

        @if(session('success'))
            <div class="max-w-3xl mx-auto mb-6 p-4 bg-green-600 text-white rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-3xl mx-auto mb-6 p-4 bg-red-600 text-white rounded-lg shadow">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="max-w-3xl mx-auto bg-[--background-800]/70 backdrop-blur-md border border-[--background-700] rounded-xl p-8 shadow-lg shadow-[--primary-900]/10">
            <form action="{{ route('auctions.update', $auction) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Details -->
                <h2 class="font-heading text-2xl text-[--text-50] mb-6 border-b border-[--background-700] pb-2">Product Information</h2>

                <div class="mb-6">
                    <label for="name" class="block font-heading text-[--text-50] mb-2">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $auction->product->name) }}"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        required>
                    @error('name') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block font-heading text-[--text-50] mb-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300">{{ old('description', $auction->product->description) }}</textarea>
                    @error('description') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id" class="block font-heading text-[--text-50] mb-2">Category</label>
                    <select id="category_id" name="category_id" class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $auction->product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="price" class="block font-heading text-[--text-50] mb-2">Base Price</label>
                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $auction->product->price) }}"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        required>
                    @error('price') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="stock_quantity" class="block font-heading text-[--text-50] mb-2">Stock Quantity</label>
                    <input type="number" id="stock_quantity" name="stock_quantity" min="1" value="{{ old('stock_quantity', $auction->product->stock_quantity) }}"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        required>
                    @error('stock_quantity') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="image_url" class="block font-heading text-[--text-50] mb-2">Product Image</label>
                    <input type="file" id="image_url" name="image_url"
                        class="w-full text-[--text-50] font-body bg-[--background-700] border border-[--primary-700] py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        accept="image/*">
                    @if($auction->product->image_url)
                        <p class="text-[--text-300] text-sm mt-2">Current image: <img src="{{ asset('storage/' . $auction->product->image_url) }}" alt="Current Image" class="w-32 h-32 object-cover mt-2"></p>
                    @endif
                    @error('image_url') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Auction Details -->
                <h2 class="font-heading text-2xl text-[--text-50] mb-6 border-b border-[--background-700] pb-2">Auction Information</h2>

                <div class="mb-6">
                    <label for="starting_price" class="block font-heading text-[--text-50] mb-2">Starting Price</label>
                    <input type="number" id="starting_price" name="starting_price" step="0.01" value="{{ old('starting_price', $auction->starting_price) }}"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        required>
                    @error('starting_price') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="start_time" class="block font-heading text-[--text-50] mb-2">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time', $auction->start_time->format('Y-m-d\TH:i')) }}"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        required>
                    @error('start_time') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="planned_end_time" class="block font-heading text-[--text-50] mb-2">End Time</label>
                    <input type="datetime-local" id="planned_end_time" name="planned_end_time" value="{{ old('planned_end_time', $auction->planned_end_time->format('Y-m-d\TH:i')) }}"
                        class="w-full bg-[--background-700] border border-[--primary-700] text-[--text-50] font-body py-3 px-4 rounded-lg focus:border-[--primary-500] transition-all duration-300"
                        required>
                    @error('planned_end_time') <p class="text-[--accent-500] text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-[--primary-600] to-[--primary-500] hover:from-[--primary-700] hover:to-[--primary-600] text-[--text-50] font-heading font-bold py-4 rounded-lg transition-all duration-300 shadow-md shadow-[--primary-500]/30 hover:shadow-lg hover:shadow-[--primary-500]/50">
                    Update Auction
                </button>
            </form>
        </div>
    </div>
</x-app-layout>