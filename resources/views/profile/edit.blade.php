<x-app-layout>
    <style>
        /* 🚀 Color Definitions (Simplified & Focused on Contrast) */
        :root {
            /* Primary Contrast: Deep Violet/Purple */
            --color-primary-dark: #311B92; /* Darkest Base */
            --color-primary-medium: #512DA8;
            --color-primary-light: #673AB7; 
            
            /* ✨ Accent Color: Neon Blue/Cyan */
            --color-accent-blue: #00BCD4; 
            --color-accent-cyan: #4DD0E1; 
            
            /* Danger/Error */
            --color-danger-dark: #D53F8C; 
            --color-danger-light: #ED64A6;
            
            /* Base Dark Theme */
            --color-background-base: #100C09; /* Near Black */
            --color-background-card: #1C1917; /* Dark Grey/Black for Modules */
            --color-text-light: #EFEFEF; 
            --color-text-subtle: #A0AEC0; 
        }

        /* ------------------- ANIMATIONS & EFFECTS ------------------- */
        
        /* Subtle Color Shift on Active Bids */
        @keyframes subtle-shift {
            0%, 100% { background-color: rgba(0, 188, 212, 0.05); }
            50% { background-color: rgba(0, 188, 212, 0.1); }
        }

        /* ------------------- BASE STYLING ------------------- */
        
        /* Main Dashboard Background/Container */
        .dashboard-container {
            background-color: var(--color-background-base); 
            border: none;
            box-shadow: none;
            border-radius: 0;
        }

        /* Individual cards/modules */
        .holo-module {
            background-color: var(--color-background-card);
            border: 1px solid var(--color-primary-dark);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            position: relative;
            border-radius: 0.5rem; /* rounded-lg */
        }
        
        /* ** NEW: Hover Effect on Cards ** */
        .holo-module:hover {
            border-color: var(--color-accent-blue);
            box-shadow: 0 0 15px var(--color-accent-blue);
            transform: translateY(-4px); /* Lift slightly */
        }
        
        /* Module Headers */
        .holo-header-title {
            color: var(--color-accent-cyan);
            letter-spacing: 0.1em;
            text-shadow: 0 0 8px var(--color-accent-blue);
            font-weight: 800;
        }

        /* Divider Line */
        .holo-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--color-primary-medium), transparent);
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }

        /* Holo Button Styling (Primary Action) */
        .btn-holo-primary {
            background-color: var(--color-primary-medium);
            box-shadow: 0 0 10px var(--color-primary-dark);
            color: var(--color-text-light);
            font-weight: 700;
            transition: all 0.3s ease-in-out;
            text-transform: uppercase;
        }
        /* ** NEW: Button Hover Effect ** */
        .btn-holo-primary:hover {
            background-color: var(--color-primary-light);
            box-shadow: 0 0 20px var(--color-primary-light);
            transform: scale(1.02);
        }

        /* Critical Action Button */
        .btn-holo-danger {
            background-color: var(--color-danger-dark);
            box-shadow: 0 0 10px var(--color-danger-dark);
            color: var(--color-text-light);
            font-weight: 700;
            transition: all 0.3s;
        }
        .btn-holo-danger:hover {
             background-color: var(--color-danger-light);
             box-shadow: 0 0 20px var(--color-danger-light);
             transform: scale(1.02);
        }
        
        /* Input Field styling */
        .tech-input {
            background-color: var(--color-background-card);
            border: 1px solid var(--color-primary-dark);
            color: var(--color-text-light);
            transition: all 0.3s;
            padding: 0.75rem 1rem; /* Added padding for better feel */
        }

        .tech-input:focus {
            border-color: var(--color-accent-blue);
            box-shadow: 0 0 5px var(--color-accent-blue);
        }

    </style>
    
    <x-slot name="header">
        <h2 class="font-heading text-3xl font-extrabold leading-tight text-center relative z-10 text-[var(--color-text-light)]">
            USER <span class="text-[var(--color-accent-cyan)]">PROFILE</span> // SylvieVerse
        </h2>
    </x-slot>
 visual
    <div class="py-12 min-h-screen dashboard-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="holo-module p-6 lg:col-span-1">
                    <h3 class="text-xl font-semibold mb-4 holo-header-title">
                        SYSTEM IDENTIFICATION
                    </h3>
                    <div class="holo-divider"></div>
                    <div class="max-w-xl text-[var(--color-text-subtle)]">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="holo-module p-6 lg:col-span-1">
                    <h3 class="text-xl font-semibold mb-4 holo-header-title">
                        ACCESS KEY RECALIBRATION
                    </h3>
                    <div class="holo-divider"></div>
                    <div class="max-w-xl text-[var(--color-text-subtle)]">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                
                <div class="holo-module p-6 lg:col-span-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold mb-4 holo-header-title">
                            DELIVERY PROTOCOLS
                        </h3>
                        <div class="holo-divider"></div>
                        <div class="max-w-xl space-y-4 text-[var(--color-text-subtle)]">
                            <p class="text-sm">
                                Review and manage all registered delivery coordinates (addresses) for your orders and shipments.
                            </p>
                            <button class="btn-holo-primary w-full py-3 rounded-md">
                                MANAGE ADDRESSES
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4 text-[var(--color-danger-light)]">
                            PROFILE DECOMMISSION
                        </h3>
                        <div class="holo-divider"></div>
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form') 
                        </div>
                    </div>
                </div>
            </div>

            <div class="holo-module p-6">
                <h3 class="text-2xl font-semibold mb-4 holo-header-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2 text-[var(--color-accent-cyan)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l3 9h11l3-9h-10l-3 9H3m14 0a3 3 0 100 6 3 3 0 000-6zM6 21a3 3 11-6 3 3 0 016 0z" /></svg>
                    ORDER & AUCTION HISTORY
                </h3>
                <div class="holo-divider"></div>
                
                <div class="text-sm text-[var(--color-text-subtle)] space-y-4">
                    <p class="mb-4 text-[var(--color-text-subtle)]">
                        Track your purchase history, shipping status, and all records from the SylvieVerse Auction House.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 border border-[var(--color-primary-medium)] rounded-md">
                            <span class="block text-xl font-bold text-[var(--color-accent-cyan)]">05</span>
                            <span class="block text-sm text-[var(--color-text-light)]">Pending Shipments</span>
                        </div>
                        <div class="p-4 border border-[var(--color-primary-medium)] rounded-md">
                            <span class="block text-xl font-bold text-[var(--color-accent-cyan)]">12</span>
                            <span class="block text-sm text-[var(--color-text-light)]">Successful Auction Wins</span>
                        </div>
                        <div class="p-4 border border-[var(--color-primary-medium)] rounded-md">
                            <span class="block text-xl font-bold text-[var(--color-accent-cyan)]">$2,450.00</span>
                            <span class="block text-sm text-[var(--color-text-light)]">Total Lifetime Spend</span>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button class="btn-holo-primary w-full py-3 rounded-md">
                            VIEW DETAILED TRANSACTION LOGS
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>