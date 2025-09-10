<x-admin-layout>
    <div class="bg-[--color-background-800]/50 backdrop-blur-md border border-[--color-primary-700]/30 rounded-xl p-6 animate-fade-in">
        <h1 class="font-heading font-bold text-3xl text-[--color-text-50] mb-4">Discounts</h1>
        @if (session('success'))
            <div class="bg-[--color-primary-900]/20 text-[--color-text-50] p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('admin.discounts.create') }}" class="bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] font-heading font-bold py-2 px-4 rounded-lg mb-4 inline-block">Create New Discount</a>
        <div class="overflow-x-auto">
            <table class="w-full text-[--color-text-200]">
                <thead>
                    <tr class="bg-[--color-background-700]">
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Type</th>
                        <th class="p-4 text-left">Discount</th>
                        <th class="p-4 text-left">Start Date</th>
                        <th class="p-4 text-left">End Date</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($discounts as $discount)
                        <tr class="hover:bg-[--color-background-700]">
                            <td class="p-4">{{ $discount->id }}</td>
                            <td class="p-4">
                                @if ($discount->product_id)
                                    Product: {{ $discount->product->name }}
                                @elseif ($discount->category_id)
                                    Category: {{ $discount->category->name }}
                                @else
                                    Site-Wide
                                @endif
                            </td>
                            <td class="p-4">
                                {{ $discount->percent_off ? $discount->percent_off . '% off' : '$' . $discount->fixed_off . ' off' }}
                            </td>
                            <td class="p-4">{{ $discount->start_date ?? 'N/A' }}</td>
                            <td class="p-4">{{ $discount->end_date ?? 'N/A' }}</td>
                            <td class="p-4">{{ $discount->isActive() ? 'Active' : 'Inactive' }}</td>
                            <td class="p-4 flex space-x-2">
                                <a href="{{ route('admin.discounts.edit', $discount) }}" class="text-[--color-primary-400] hover:text-[--color-primary-300]">Edit</a>
                                <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-[--color-accent-500] hover:text-[--color-accent-400]">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-[--color-text-500]">No discounts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $discounts->links('partials.pagination') }}
    </div>
</x-admin-layout>