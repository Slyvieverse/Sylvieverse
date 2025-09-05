<x-guest-layout>
  <div class="min-h-screen flex flex-col lg:flex-row bg-background-50 dark:bg-background-950 transition-colors duration-500">
      
      <!-- Left Side -->
      <div class="hidden lg:flex lg:w-1/2 items-center justify-center 
                  bg-gradient-to-br from-primary-500/90 to-primary-700/90 
                  dark:from-primary-600 dark:to-primary-800 
                  p-12 relative overflow-hidden backdrop-blur-xl">
          
          <!-- Floating Shapes -->
          <div class="absolute -top-20 -left-20 w-96 h-96 bg-primary-400/30 rounded-full blur-3xl animate-pulse"></div>
          <div class="absolute bottom-0 right-0 w-80 h-80 bg-accent-500/20 rounded-full blur-3xl animate-spin-slow"></div>

          <img src="/images/Gemini_Generated_Image_u2dm7cu2dm7cu2dm.png" alt="Register" 
               class="relative z-10 max-w-md w-full animate-fade-in-up drop-shadow-lg">
      </div>

      <!-- Right Side -->
      <div class="flex-1 flex items-center justify-center p-8 lg:p-16">
          <div class="w-full max-w-md space-y-8 animate-fade-in">
              
              <!-- Card -->
              <div class="bg-background-50 dark:bg-background-900 rounded-2xl shadow-xl p-8 space-y-6">
                  
                  <!-- Heading -->
                  <div class="text-center">
                      <h1 class="text-3xl font-bold tracking-tight text-primary-500 dark:text-primary-400">
                          Create Account
                      </h1>
                      <p class="mt-2 text-text-600 dark:text-text-400 font-serif">
                          Join the future today 🚀
                      </p>
                  </div>

                  <!-- Form -->
                  <form method="POST" action="{{ route('register') }}" class="space-y-5">
                      @csrf

                      <!-- Name -->
                      <div>
                          <x-input-label for="name" :value="__('Name')" />
                          <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus 
                              placeholder="John Doe"
                              class="mt-2 block w-full rounded-xl border border-background-300 dark:border-background-600 
                                     bg-background-100 dark:bg-background-800 
                                     py-3 px-4 text-text-900 dark:text-text-100 
                                     placeholder-text-400 focus:border-primary-400 focus:ring-2 focus:ring-primary-400" />
                          <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                      </div>

                      <!-- Email -->
                      <div>
                          <x-input-label for="email" :value="__('Email')" />
                          <x-text-input id="email" type="email" name="email" :value="old('email')" required 
                              placeholder="example@email.com"
                              class="mt-2 block w-full rounded-xl border border-background-300 dark:border-background-600 
                                     bg-background-100 dark:bg-background-800 
                                     py-3 px-4 text-text-900 dark:text-text-100 
                                     placeholder-text-400 focus:border-primary-400 focus:ring-2 focus:ring-primary-400" />
                          <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                      </div>

                      <!-- Password -->
                      <div>
                          <x-input-label for="password" :value="__('Password')" />
                          <x-text-input id="password" type="password" name="password" required 
                              placeholder="••••••••"
                              class="mt-2 block w-full rounded-xl border border-background-300 dark:border-background-600 
                                     bg-background-100 dark:bg-background-800 
                                     py-3 px-4 text-text-900 dark:text-text-100 
                                     placeholder-text-400 focus:border-primary-400 focus:ring-2 focus:ring-primary-400" />
                          <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                      </div>

                      <!-- Confirm Password -->
                      <div>
                          <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                          <x-text-input id="password_confirmation" type="password" name="password_confirmation" required 
                              placeholder="••••••••"
                              class="mt-2 block w-full rounded-xl border border-background-300 dark:border-background-600 
                                     bg-background-100 dark:bg-background-800 
                                     py-3 px-4 text-text-900 dark:text-text-100 
                                     placeholder-text-400 focus:border-primary-400 focus:ring-2 focus:ring-primary-400" />
                          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                      </div>

                      <!-- Actions -->
                      <div class="flex flex-col space-y-4">
                          <x-primary-button class="w-full py-3 rounded-xl bg-primary-500 hover:bg-primary-600 
                                                text-white font-semibold shadow-lg transition transform hover:scale-[1.02]">
                              {{ __('Register') }}
                          </x-primary-button>

                          <a href="{{ route('login') }}" 
                             class="text-sm text-center text-text-600 dark:text-text-400 hover:text-primary-500 transition">
                              Already have an account? <span class="font-semibold">Log in</span>
                          </a>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</x-guest-layout>
