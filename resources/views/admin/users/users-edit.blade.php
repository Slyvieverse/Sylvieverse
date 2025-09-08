<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-heading text-xl text-[--color-text-50] leading-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[--color-background-800]/50 backdrop-blur-md rounded-xl p-6 border border-[--color-primary-700]/30 shadow-lg">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-[--color-text-200] mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-[--color-text-200] mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] placeholder-[--color-text-200] px-4 py-2" required>
                    </div>

                    <!-- Role Field -->
                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-[--color-text-200] mb-2">Role</label>
                        <select name="role" id="role" class="w-full rounded-md bg-[--color-background-700] border border-[--color-primary-700] text-[--color-text-50] px-4 py-2" required>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="px-6 py-3 rounded-lg bg-gradient-to-r from-[--color-primary-600] to-[--color-primary-500] hover:from-[--color-primary-500] hover:to-[--color-primary-400] text-[--color-text-50] font-medium transition-all shadow-lg">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
