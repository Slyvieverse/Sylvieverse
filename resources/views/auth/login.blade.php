<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Card -->
    <div class="w-full max-w-md p-8 bg-[--background-800]/50  rounded-xl shadow-lg border border-[--primary-700]/30 animate-fade-in">
        <h2 class="text-3xl font-heading font-bold text-center text-[--text-50] mb-6">
            Log in to Sylvie<span class="text-[--primary-400]">Verse</span>
        </h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-md bg-[--background-700] border border-[--primary-700] text-[--text-50] placeholder:text-[--text-200] focus:outline-none focus:ring-2 focus:ring-[--primary-400] transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 mb-6">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full px-4 py-3 rounded-md bg-[--background-700] border border-[--primary-700] text-[--text-50] placeholder:text-[--text-200] focus:outline-none focus:ring-2 focus:ring-[--primary-400] transition-all"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-[--background-700] border-[--primary-700] text-[--primary-500] shadow-sm focus:ring-[--primary-500]" name="remember">
                    <span class="ms-2 text-sm text-[--text-200]">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-[--text-200] hover:text-[--primary-400] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[--primary-500] dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3 w-full px-8 py-4 rounded-lg bg-gradient-to-r from-[--primary-600] to-[--primary-500] hover:from-[--primary-500] hover:to-[--primary-400] text-[--text-50] font-medium text-lg transition-all shadow-lg shadow-[--primary-600]/20 hover:shadow-[--primary-500]/30">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
