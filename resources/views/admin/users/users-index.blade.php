<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-text-50 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-background-800/50 backdrop-blur-md rounded-xl p-6 border border-primary-700/30 shadow-lg animate-fade-in">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-heading text-2xl font-bold text-text-50">All Users</h3>
                </div>

                @if ($users->isEmpty())
                    <p class="text-text-200 text-center">No users found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-primary-700">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-200 uppercase tracking-wider">
                                        Profile Picture
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-200 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-200 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-200 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary-700/50">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-background-700 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img
                                                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                                                alt="{{ $user->name }}'s profile picture"
                                                class="w-10 h-10 rounded-full object-cover border border-primary-700/50"
                                            >
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-text-50">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-200">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-200">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400' : 'bg-green-500/20 text-green-400' }}">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="text-primary-400 hover:text-primary-500">
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
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>