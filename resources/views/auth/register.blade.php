<x-guest-layout>
    <!-- Registration Card -->
    <div class="w-full max-w-md p-8 bg-[--background-800]/50 backdrop-blur-md rounded-xl shadow-lg border border-[--primary-700]/30 animate-fade-in">
        <h2 class="text-3xl font-heading font-bold text-center text-[--text-50] mb-6">
            Create an Account
        </h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full px-4 py-3 rounded-md bg-[--background-700] border border-[--primary-700] text-[--text-50] placeholder:text-[--text-200] focus:outline-none focus:ring-2 focus:ring-[--primary-400] transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-md bg-[--background-700] border border-[--primary-700] text-[--text-50] placeholder:text-[--text-200] focus:outline-none focus:ring-2 focus:ring-[--primary-400] transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full px-4 py-3 rounded-md bg-[--background-700] border border-[--primary-700] text-[--text-50] placeholder:text-[--text-200] focus:outline-none focus:ring-2 focus:ring-[--primary-400] transition-all"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-3 rounded-md bg-[--background-700] border border-[--primary-700] text-[--text-50] placeholder:text-[--text-200] focus:outline-none focus:ring-2 focus:ring-[--primary-400] transition-all"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-[--text-200] hover:text-[--primary-400] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[--primary-500] dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-3 w-full px-8 py-4 rounded-lg bg-gradient-to-r from-[--primary-600] to-[--primary-500] hover:from-[--primary-500] hover:to-[--primary-400] text-[--text-50] font-medium text-lg transition-all shadow-lg shadow-[--primary-600]/20 hover:shadow-[--primary-500]/30">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
