<x-guest-layout>
    <style>
        /* 🚀 Color Definitions (For consistency with the 4K Theme) */
        :root {
            /* Primary Purple */
            --color-primary-400: #7E57C2; 
            --color-primary-500: #673AB7; 
            --color-primary-600: #512DA8; 
            --color-primary-700: #311B92; 
            
            /* ✨ Accent Color - Neon Blue Glow */
            --color-accent-blue-400: #4DD0E1; 
            --color-accent-blue-500: #00BCD4; 
            --color-accent-blue-600: #0097A7;
            
            /* Error/Danger State (Neon Red/Pink) */
            --color-danger-500: #D53F8C; 
            --color-danger-400: #ED64A6;
            
            /* Base Dark Theme */
            --color-background-700: #1C1917; 
            --color-background-800: #100C09; 
            --color-text-50: #EFEFEF; 
            --color-text-200: #A0AEC0; 
            --color-text-300: #718096;

            /* Shadows & Effects */
            --shadow-primary-glow: 0 0 10px var(--color-primary-500), 0 0 20px var(--color-primary-400);
            --shadow-card-3d: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 20px rgba(126, 87, 194, 0.8);
        }

        /* ------------------- ANIMATIONS ------------------- */
        
        /* Subtle Floating for 3D effect */
        @keyframes float3d {
            0%, 100% {
                transform: translateY(0) rotateX(2deg) rotateY(-2deg);
            }
            50% {
                transform: translateY(-8px) rotateX(1deg) rotateY(-1deg);
            }
        }

        /* Holographic Noise/Static Effect */
        @keyframes noise {
            0%, 100% { clip-path: inset(0 0 99% 0); }
            10% { clip-path: inset(0 0 0 100%); }
            40% { clip-path: inset(100% 0 0 0); }
            70% { clip-path: inset(0 100% 0 0); }
        }

        /* Loading Button Animation */
        @keyframes loading-pulse {
            0%, 100% { background-color: var(--color-primary-500); }
            50% { background-color: var(--color-accent-blue-500); }
        }

        /* ------------------- STYLING ------------------- */
        
        .holographic-card {
            background-color: var(--color-background-800); 
            backdrop-filter: blur(8px);
            border: 2px solid var(--color-primary-700);
            box-shadow: var(--shadow-card-3d);
            transform-style: preserve-3d;
            animation: float3d 6s ease-in-out infinite;
            perspective: 1000px;
        }

        .holographic-border {
            position: absolute; inset: -2px; border-radius: 14px; z-index: 0; opacity: 0.8; pointer-events: none;
        }

        /* Creates the flickering neon blue edge glow */
        .holographic-border::before {
            content: '';
            position: absolute; inset: 0; border-radius: 12px;
            box-shadow: 0 0 10px var(--color-accent-blue-500), 0 0 20px var(--color-accent-blue-400);
            filter: blur(2px);
            opacity: 0.7;
            animation: noise 0.5s infinite alternate;
            background: repeating-linear-gradient(
                -45deg,
                rgba(0, 188, 212, 0.1),
                rgba(0, 188, 212, 0.05) 1px,
                transparent 2px,
                transparent 5px
            );
        }

        /* Input field styles with dynamic focus and error states */
        .tech-input {
            background-color: var(--color-background-700);
            border: 1px solid var(--color-primary-700);
            color: var(--color-text-50);
            transition: all 0.3s;
        }

        .tech-input:focus {
            border-color: var(--color-accent-blue-500);
            box-shadow: 0 0 10px var(--color-accent-blue-500)/50; /* Added focus glow */
        }
        
        .tech-input.is-invalid {
            border-color: var(--color-danger-500);
            box-shadow: 0 0 8px var(--color-danger-500)/50;
        }

        /* Registration Button (Enhanced Primary Purple) */
        .btn-register-3d {
            background-image: linear-gradient(to right, var(--color-primary-600), var(--color-primary-500));
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3), var(--shadow-primary-glow);
            transition: all 0.3s ease-out;
            font-weight: 700;
        }
        .btn-register-3d:hover {
            background-image: linear-gradient(to right, var(--color-primary-500), var(--color-primary-400));
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5), 0 0 40px var(--color-primary-400);
            transform: scale(1.01);
        }
        .btn-register-3d[disabled] {
            cursor: not-allowed;
            opacity: 0.6;
            animation: loading-pulse 1s infinite;
        }
        
        /* Secondary Login Link Styling */
        .btn-secondary-link {
            transition: color 0.3s, text-shadow 0.3s;
            text-shadow: 0 0 5px rgba(0, 188, 212, 0.5);
        }
        .btn-secondary-link:hover {
            color: var(--color-accent-blue-400);
            text-shadow: 0 0 10px var(--color-accent-blue-400);
        }

    </style>

    <script>
        // Placeholder JavaScript for simulating form submission and loading state
        function handleRegister(event) {
            const button = event.target.querySelector('.btn-register-3d');
            const originalText = button.innerHTML;
            
            // Prevent immediate form submission
            event.preventDefault(); 

            // Simulate loading state
            button.setAttribute('disabled', 'disabled');
            button.innerHTML = '<svg class="animate-spin h-5 w-5 mr-3 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> VALIDATING DATA...';

            // Simulate form processing delay
            setTimeout(() => {
                // If successful, proceed with original form submission
                event.target.submit();
            }, 1800);
        }
    </script>
    
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black-900 bg-[url('images/holographic-background.svg')] bg-cover">

        <div class="holographic-card w-full max-w-md p-8 rounded-xl relative">
            <div class="holographic-border"></div>
            
            <h2 class="text-3xl font-heading font-extrabold text-center text-[var(--color-text-50)] relative z-10">
                Join <span class="text-[var(--color-accent-blue-400)]">SylvieVerse</span>
            </h2>
            <p class="text-xs text-center text-[var(--color-text-300)] mb-8 relative z-10 uppercase tracking-widest">
                Create Account / Access Key Generation
            </p>
            
            <form method="POST" action="{{ route('register') }}" class="relative z-10" onsubmit="handleRegister(event)">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm text-[var(--color-text-200)] mb-1">
                        {{ __('Name') }}
                    </label>
                    <input id="name" 
                        class="block mt-1 w-full px-4 py-3 rounded-md tech-input @error('name') is-invalid @enderror" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required autofocus autocomplete="name" 
                        placeholder="Enter your full name or username"
                    />
                    @error('name')
                        <p class="mt-2 text-sm text-[var(--color-danger-400)]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-[var(--color-text-200)] mb-1">
                        {{ __('Email Address') }}
                    </label>
                    <input id="email" 
                        class="block mt-1 w-full px-4 py-3 rounded-md tech-input @error('email') is-invalid @enderror" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autocomplete="username" 
                        placeholder="your@email.com"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-[var(--color-danger-400)]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4 mb-4">
                    <label for="password" class="block font-medium text-sm text-[var(--color-text-200)] mb-1">
                        {{ __('Password') }}
                    </label>
                    <input id="password" 
                        class="block mt-1 w-full px-4 py-3 rounded-md tech-input @error('password') is-invalid @enderror"
                        type="password"
                        name="password"
                        required autocomplete="new-password"
                        placeholder="Establish a strong password"
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-[var(--color-danger-400)]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4 mb-6">
                    <label for="password_confirmation" class="block font-medium text-sm text-[var(--color-text-200)] mb-1">
                        {{ __('Confirm Password') }}
                    </label>
                    <input id="password_confirmation" 
                        class="block mt-1 w-full px-4 py-3 rounded-md tech-input @error('password_confirmation') is-invalid @enderror"
                        type="password"
                        name="password_confirmation" 
                        required autocomplete="new-password"
                        placeholder="Confirm your password"
                    />
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-[var(--color-danger-400)]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="btn-secondary-link underline text-sm text-[var(--color-text-200)] hover:text-[var(--color-accent-blue-400)] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-accent-blue-500)] transition-colors" href="{{ route('login') }}">
                        {{ __('Already Registered?') }}
                    </a>

                    <button type="submit" class="w-full sm:w-auto ms-3 px-8 py-4 rounded-lg btn-register-3d text-[var(--color-text-50)] font-heading text-lg transition-all flex items-center justify-center">
                        {{ __('CREATE ACCOUNT') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>