<x-admin-layout>
    <h1 class="font-heading font-bold text-3xl text-text-50 mb-4">Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-primary-600 to-primary-500 text-text-50 font-heading font-bold py-2 px-4 rounded-lg mb-4 inline-block">Create New Category</a>
    <table class="w-full bg-background-800/50 border border-background-700 rounded-xl">
        <thead>
            <tr>
                <th class="p-4 text-left">Name</th>
                <th class="p-4 text-left">Slug</th>
                <th class="p-4 text-left">Description</th>
                <th class="p-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td class="p-4">{{ $category->name }}</td>
                    <td class="p-4">{{ $category->slug }}</td>
                    <td class="p-4">{{ $category->description ?? 'N/A' }}</td>
                    <td class="p-4">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary-400 hover:text-primary-300">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-accent-500 hover:text-accent-400">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-text-500">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>