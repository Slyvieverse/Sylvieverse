<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-gray-900 dark:text-gray-100 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Wrapper: Light BG with Shadow, Dark BG on Dark Mode --}}
            <div class="bg-white dark:bg-gray-800/80 backdrop-blur-md rounded-xl p-6 border border-indigo-200/50 dark:border-indigo-700/30 shadow-xl dark:shadow-2xl animate-fade-in">

                @if (session('success'))
                    {{-- Success Alert: Green for both modes --}}
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-800/30 text-green-700 dark:text-green-400 rounded-lg border border-green-200 dark:border-green-700">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    {{-- Error Alert: Red for both modes --}}
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-800/30 text-red-700 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Search and Filter Form --}}
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex-1 flex flex-col sm:flex-row sm:items-center sm:space-x-4">
                        <div class="flex-1 mb-4 sm:mb-0">
                            <label for="search" class="sr-only">Search by name or email</label>
                            <input
                                type="text"
                                name="search"
                                id="search"
                                value="{{ request('search') }}"
                                placeholder="Search by name or email..."
                                {{-- Form Input Styling --}}
                                class="w-full bg-gray-100 dark:bg-gray-700 border border-indigo-300 dark:border-indigo-700 text-gray-900 dark:text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:placeholder-gray-400 placeholder-gray-500"
                            >
                        </div>
                        <div class="w-full sm:w-48">
                            <label for="role" class="sr-only">Filter by role</label>
                            <select
                                name="role"
                                id="role"
                                {{-- Form Select Styling --}}
                                class="w-full bg-gray-100 dark:bg-gray-700 border border-indigo-300 dark:border-indigo-700 text-gray-900 dark:text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="" {{ !request('role') ? 'selected' : '' }} class="dark:bg-gray-700">All Roles</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }} class="dark:bg-gray-700">Admin</option>
                                <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }} class="dark:bg-gray-700">Customer</option>
                            </select>
                        </div>
                        {{-- Search Button Styling: Indigo Gradient --}}
                        <button
                            type="submit"
                            class="mt-4 sm:mt-0 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white font-semibold rounded-lg px-4 py-2 hover:from-indigo-700 hover:to-indigo-600 transition-all duration-200 shadow-md hover:shadow-lg dark:hover:shadow-[0_0_15px_0_rgba(99,102,241,0.5)]"
                        >
                            Search
                        </button>
                    </form>
                </div>

                {{-- User Count and Title --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-gray-900 dark:text-white">All Users</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                    </p>
                </div>

                @if ($users->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">No users found.</p>
                @else
                    {{-- Users Table --}}
                    <div class="overflow-x-auto shadow-inner rounded-lg border border-gray-200 dark:border-gray-700/50">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-indigo-700">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Profile Picture
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-indigo-700/50">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img
                                                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                                                alt="{{ $user->name }}'s profile picture"
                                                class="w-10 h-10 rounded-full object-cover border border-indigo-400 dark:border-indigo-700/50"
                                            >
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{-- Role Badge Styling --}}
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $user->role === 'admin' 
                                                    ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-400' 
                                                    : 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('admin.users.show', $user->id) }}"
                                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500 transition-colors">
                                                     View
                                                </a>
                                                
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-500 transition-colors">
                                                     Edit
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                      class="inline-block">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="submit"
                                                             class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-500 transition-colors">
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

                    {{-- Pagination Links (Partial must support Tailwind dark mode classes) --}}
                    <div class="mt-6">
                        {{ $users->links('partials.pagination') }} 
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>