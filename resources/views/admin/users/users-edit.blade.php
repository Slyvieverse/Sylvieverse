<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-8 border border-[--color-primary-700]/30 shadow-2xl animate-fade-in">
                
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center text-[--color-primary-400] hover:text-[--color-primary-500] mb-8 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Users
                </a>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/20 text-red-400 rounded-lg border border-red-500/50">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h3 class="font-heading text-xl font-semibold text-[--color-text-50] mb-6 border-b border-[--color-primary-700]/50 pb-2">User Information</h3>

                    <div class="mb-8 flex flex-col items-center">
                        <label class="block text-sm font-medium text-[--color-text-200] mb-4">Profile Picture</label>
                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.png') }}"
                             alt="Current Profile Picture"
                             class="w-32 h-32 rounded-full object-cover border-4 border-[--color-primary-700] mb-4 shadow-xl">

                        <input type="file" name="profile_picture" id="profile_picture" 
                               class="block w-full text-sm text-[--color-text-200]
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-[--color-primary-600] file:text-[--color-text-50]
                                      hover:file:bg-[--color-primary-500] cursor-pointer
                                      mt-2"
                               accept="image/*">
                        @error('profile_picture')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-[--color-text-200] mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                               class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-3 focus:ring-2 focus:ring-[--color-primary-600] transition-colors" required>
                        @error('name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-[--color-text-200] mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                               class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-3 focus:ring-2 focus:ring-[--color-primary-600] transition-colors" required>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="role" class="block text-sm font-medium text-[--color-text-200] mb-2">Role</label>
                        <select name="role" id="role" 
                                class="w-full rounded-lg bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] px-4 py-3 focus:ring-2 focus:ring-[--color-primary-600] transition-colors" required>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" 
                                class="px-8 py-3 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] 
                                       hover:from-[--color-primary-500] hover:to-[--color-primary-400] 
                                       text-[--color-text-50] font-semibold transition-all shadow-lg 
                                       hover:shadow-[0_0_20px_0_rgba(124,58,237,0.5)]">
                            Update User Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>