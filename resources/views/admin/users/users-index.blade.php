<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg animate-fade-in">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 text-green-400 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-500/20 text-red-400 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Search and Filter Form -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex-1 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <!-- Search Input -->
                        <div class="flex-1 mb-4 sm:mb-0">
                            <label for="search" class="sr-only">Search by name or email</label>
                            <input
                                type="text"
                                name="search"
                                id="search"
                                value="{{ request('search') }}"
                                placeholder="Search by name or email..."
                                class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] focus:border-[--color-primary-600] placeholder-[--color-text-200]"
                            >
                        </div>
                        <!-- Role Filter -->
                        <div class="w-full sm:w-48">
                            <label for="role" class="sr-only">Filter by role</label>
                            <select
                                name="role"
                                id="role"
                                class="w-full bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[--color-primary-600] focus:border-[--color-primary-600]"
                            >
                                <option value="" {{ !request('role') ? 'selected' : '' }}>All Roles</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="mt-4 sm:mt-0 bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] text-[--color-text-50] font-semibold rounded-lg px-4 py-2 hover:shadow-[0_0_15px_0_rgba(124,58,237,0.3)] transition-shadow duration-200"
                        >
                            Search
                        </button>
                    </form>
                </div>

                <!-- Users Table -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-[--color-text-50]">All Users</h3>
                    <p class="text-[--color-text-200] text-sm">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                    </p>
                </div>

                @if ($users->isEmpty())
                    <p class="text-[--color-text-200] text-center">No users found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[--color-primary-700]">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Profile Picture
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[--color-text-200] uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[--color-primary-700]/50">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-[--color-background-700] transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img
                                                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                                                alt="{{ $user->name }}'s profile picture"
                                                class="w-10 h-10 rounded-full object-cover border border-[--color-primary-700]/50"
                                            >
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[--color-text-50]">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[--color-text-200]">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400' : 'bg-green-500/20 text-green-400' }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="text-[--color-primary-400] hover:text-[--color-primary-500]">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-500 hover:text-red-600">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $users->links('partials.pagination') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>