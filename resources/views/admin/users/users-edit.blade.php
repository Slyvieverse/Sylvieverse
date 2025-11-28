<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-gray-900 dark:text-white leading-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Wrapper --}}
            <div class="bg-white dark:bg-gray-800/80 backdrop-blur-md rounded-xl p-8 border border-indigo-200/50 dark:border-indigo-700/30 shadow-2xl animate-fade-in">
                
                {{-- Back Link --}}
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-500 mb-8 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Users
                </a>

                @if ($errors->any())
                    {{-- Validation Errors --}}
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg border border-red-300 dark:border-red-700/50">
                        <p class="font-semibold mb-2">There were {{ $errors->count() }} errors with your submission:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h3 class="font-heading text-xl font-semibold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-indigo-700/50 pb-2">User Information</h3>

                    {{-- Profile Picture Upload --}}
                    <div class="mb-8 flex flex-col items-center">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Profile Picture</label>
                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                             alt="Current Profile Picture"
                             class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 dark:border-indigo-700 mb-4 shadow-xl">

                        <input type="file" name="profile_picture" id="profile_picture" 
                                class="block w-full max-w-sm text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-indigo-600 file:text-white
                                    hover:file:bg-indigo-700 dark:file:bg-indigo-700 dark:hover:file:bg-indigo-600 cursor-pointer
                                    mt-2"
                                accept="image/*">
                        @error('profile_picture')
                            <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Name Input --}}
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-indigo-300 dark:border-indigo-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition-colors" required>
                        @error('name')
                            <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Input --}}
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-indigo-300 dark:border-indigo-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition-colors" required>
                        @error('email')
                            <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role Select --}}
                    <div class="mb-8">
                        <label for="role" class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Role</label>
                        <select name="role" id="role" 
                                class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-indigo-300 dark:border-indigo-700 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition-colors" required>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }} class="dark:bg-gray-700">Customer</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} class="dark:bg-gray-700">Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        {{-- Update Button Styling: Prominent Indigo Gradient --}}
                        <button type="submit" 
                                class="px-8 py-3 rounded-lg bg-gradient-to-r from-indigo-600 to-indigo-500 
                                     hover:from-indigo-700 hover:to-indigo-600 
                                     text-white font-semibold transition-all shadow-lg 
                                     dark:shadow-xl dark:shadow-indigo-900/30 hover:shadow-indigo-500/50">
                            Update User Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>