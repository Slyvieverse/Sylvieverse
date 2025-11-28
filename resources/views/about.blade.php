<x-app-layout>
    <style>
        /* 🚀 Enhanced Neon & 4K-Style Color Palette - Matching Homepage */
        :root {
            /* Primary Colors - Deep Violet/Electric Purple */
            --color-primary-400: #7E57C2; /* Lighter Purple */
            --color-primary-500: #673AB7; /* Main Purple */
            --color-primary-600: #512DA8; /* Deeper Purple */
            --color-primary-700: #311B92; /* Darkest Purple */
            
            /* ✨ Accent Colors - Light Neon Blue/Aqua Glow */
            --color-accent-500: #00BCD4; /* Main Neon Blue */
            --color-accent-400: #4DD0E1; /* Lighter Blue */
            --color-accent-600: #0097A7; /* Deeper Blue */

            /* Backgrounds - Dark Technical Palette */
            --color-background-700: #1C1917; /* Slate Black */
            --color-background-800: #100C09; /* Near Black */
            --color-background-900: #0D0A08; /* Abyss Black */
            
            /* Text - Bright and Technical */
            --color-text-50: #EFEFEF; /* Bright White/Neon */
            --color-text-200: #A0AEC0; /* Slate Gray */
            --color-text-300: #718096; /* Darker Gray */
            --color-text-400: #4A5568; /* Deepest Text Gray */

            /* Neon Glow Shadows */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
            --shadow-card-subtle: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        /* 🌙 Dark Mode */
        .dark {
            --color-primary-400: #9373D2;
            --color-primary-500: #7E57C2;
            --color-primary-600: #673AB7;
            --color-accent-500: #00BCD4; 
            --color-accent-400: #4DD0E1; 
            --color-background-700: #0D0A08;
            --color-background-800: #100C09;
            --color-background-900: #0A0807;
            --color-text-50: #F0F0F0;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            /* Added glow for light mode in the original template, adjusted dark mode here for consistency */
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
        }

        /* ☀️ Light Mode - (Kept original light mode variables for theme functionality) */
        .light {
            --color-background-900: #F7FAFC;
            --color-background-800: #FFFFFF;
            --color-background-700: #EDF2F7;
            --color-primary-500: #5E35B1;
            --color-primary-400: #7E57C2;
            --color-primary-600: #4527A0;
            --color-accent-500: #0097A7;
            --color-accent-400: #00BCD4;
            --color-text-50: #1A202C;
            --color-text-200: #4A5568;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 4px 10px rgba(94, 53, 177, 0.2);
            --shadow-accent-glow: 0 4px 10px rgba(0, 188, 212, 0.2);
        }

        /* Custom radial gradient background */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%);
        }

        /* Tech grid background */
        .hero-bg-tech {
            background-image: linear-gradient(0deg, var(--color-background-800) 50%, transparent 100%), 
                                repeating-linear-gradient(0deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px),
                                repeating-linear-gradient(90deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px);
            background-size: 100% 100%, 100% 100%, 100% 100%;
        }

        /* Animations */
        @keyframes page-enter {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, -50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
            }
        }

        @keyframes pulse-glow {
            0% { opacity: 0.1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.05); }
            100% { opacity: 0.1; transform: scale(1); }
        }

        /* 3D Card Effects */
        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card-3d:hover {
            transform: scale(1.03) rotateX(2deg) rotateY(-2deg) translateZ(5px);
            box-shadow: var(--shadow-primary-glow);
        }

        .btn-3d {
            transition: all 0.2s ease-out;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                        0 2px 4px -2px rgba(0, 0, 0, 0.1),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 
                        0 4px 6px -4px rgba(0, 0, 0, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.2),
                        0 0 20px var(--color-primary-400);
        }

        /* Team member hover effects */
        .team-member {
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-primary-glow);
        }

        /* Timeline styling */
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -20px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--color-accent-500);
            box-shadow: 0 0 10px var(--color-accent-400);
        }
        
        /* ** NEW: Feature Grid Hover ** */
        .feature-box {
            background-color: var(--color-background-700);
            border: 1px solid var(--color-primary-700);
            transition: all 0.4s;
            transform-style: preserve-3d;
        }
        .feature-box:hover {
            border-color: var(--color-accent-400);
            box-shadow: var(--shadow-accent-glow);
            transform: translateZ(10px) rotateX(-2deg); /* Added a slight 3D rotate on hover */
        }
        
        /* ** NEW: Roadmap Indicator Glow ** */
        .roadmap-glow {
            box-shadow: 0 0 10px var(--color-primary-400);
            animation: pulse-glow 3s ease-in-out infinite alternate;
        }
    </style>

    <script>
        // Theme initialization (same as homepage)
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans">
        
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <div class="absolute top-8 right-6 z-20" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.1s; opacity: 0;">
            <button onclick="toggleTheme()" class="p-3 rounded-full bg-[--color-background-800] border border-[--color-primary-700] dark:hover:border-[--color-accent-500] light:hover:border-[--color-accent-500] transition-all btn-3d" title="Toggle Theme">
                <svg class="h-6 w-6 text-[--color-text-200] block dark:block light:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg class="h-6 w-6 text-[--color-text-200] hidden dark:hidden light:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>

        <main class="container mx-auto px-6 py-16 md:py-24 relative z-10">

            <div class="max-w-4xl mx-auto text-center mb-20" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight leading-tight">
                    About 
                    <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                        SylvieVerse
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-8 max-w-3xl mx-auto font-light">
                    We're **revolutionizing digital collectibles** through blockchain technology, creating the premier destination for manga and manhwa enthusiasts.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="/" class="btn-3d px-8 py-3 rounded-xl bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-primary-500)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-primary-400)] text-[var(--color-text-50)] font-semibold text-lg">
                        ← Back to Home
                    </a>
                    <a href="#mission" class="btn-3d px-8 py-3 rounded-xl bg-[var(--color-background-700)] dark:hover:bg-[var(--color-background-800)] light:hover:bg-[var(--color-background-700)] border border-[var(--color-accent-500)]/50 text-[var(--color-accent-400)] font-semibold text-lg">
                        Our Mission ↓
                    </a>
                </div>
            </div>

            <div id="mission" class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20 items-center">
                <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 border border-[var(--color-primary-700)]/40" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.6s; opacity: 0;">
                    <h2 class="text-3xl md:text-4xl font-bold text-[var(--color-text-50)] mb-6">
                        Our <span class="text-[var(--color-accent-400)]">Mission</span>
                    </h2>
                    <p class="text-lg text-[var(--color-text-200)] mb-6 leading-relaxed">
                        To create the **most immersive and secure digital marketplace** for manga and manhwa collectors, bridging the gap between traditional collecting and Web3 innovation.
                    </p>
                    <p class="text-lg text-[var(--color-text-200)] mb-8 leading-relaxed">
                        We believe every collector deserves **authentic, verified digital ownership** of their favorite series, with the same thrill of discovery and community that made physical collecting magical.
                    </p>
                    <div class="grid grid-cols-2 gap-6 text-center">
                        <div class="p-4 bg-[var(--color-primary-500)]/20 rounded-xl border border-[var(--color-primary-500)]/30">
                            <div class="text-2xl font-bold text-[var(--color-primary-400)] mb-1">10K+</div>
                            <div class="text-sm text-[var(--color-text-200)]">Collectors</div>
                        </div>
                        <div class="p-4 bg-[var(--color-accent-500)]/20 rounded-xl border border-[var(--color-accent-500)]/30">
                            <div class="text-2xl font-bold text-[var(--color-accent-400)] mb-1">500+</div>
                            <div class="text-sm text-[var(--color-text-200)]">Digital Assets</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative h-80 lg:h-96 bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-accent-500)] rounded-2xl flex items-center justify-center" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.8s; opacity: 0;">
                    <div class="text-center p-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white mb-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-white mb-2">Blockchain Secured</h3>
                        <p class="text-white/80">Every transaction verified on-chain</p>
                    </div>
                </div>
            </div>
            
            <div id="pillars" class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-[var(--color-text-50)] mb-12 text-center" style="text-shadow: 0 0 8px var(--color-primary-400);">
                    Our <span class="text-[var(--color-accent-400)]">Key Pillars</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <div class="feature-box card-3d rounded-xl p-6 text-center" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.9s; opacity: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-[var(--color-primary-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.832 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.832 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.168 18 16.5 18s-3.332.477-4.5 1.253" /></svg>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Digital Manga</h3>
                        <p class="text-[var(--color-text-300)] text-sm">A vast collection of Japanese series, instantly accessible and verified.</p>
                    </div>

                    <div class="feature-box card-3d rounded-xl p-6 text-center" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.1s; opacity: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-[var(--color-accent-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Manhwa Focus</h3>
                        <p class="text-[var(--color-text-300)] text-sm">Exclusive vertical-scroll Webtoon collections from top Korean studios.</p>
                    </div>

                    <div class="feature-box card-3d rounded-xl p-6 text-center" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.3s; opacity: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-[var(--color-primary-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2v5h.01M12 8V6a3 3 0 00-3-3M15 10a5 5 0 01-5 5H4a5 5 0 01-5-5V4a5 5 0 015-5h6a5 5 0 015 5v1" /></svg>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Digital Auction</h3>
                        <p class="text-[var(--color-text-300)] text-sm">A dedicated marketplace for rarity grading and high-value limited editions.</p>
                    </div>

                    <div class="feature-box card-3d rounded-xl p-6 text-center" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.5s; opacity: 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-3 text-[var(--color-accent-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">True Ownership</h3>
                        <p class="text-[var(--color-text-300)] text-sm">NFT-backed assets grant collectors verifiable, tradable rights.</p>
                    </div>
                </div>
            </div>

            <div id="roadmap" class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-[var(--color-text-50)] mb-12 text-center" style="text-shadow: 0 0 8px var(--color-primary-400);">
                    <span class="text-[var(--color-accent-400)]">Operational</span> Timeline & Roadmap
                </h2>
                
                <div class="max-w-4xl mx-auto relative">
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[var(--color-primary-500)] to-[var(--color-accent-500)]"></div>
                    
                    <div class="space-y-12 relative">
                        <div class="timeline-item relative pl-16" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.7s; opacity: 0;">
                            <div class="card-3d bg-[var(--color-background-800)]/50 backdrop-blur-sm rounded-xl p-6 border border-[var(--color-primary-700)]/30">
                                <div class="text-sm text-[var(--color-accent-400)] font-semibold mb-2">Q1 2023: Foundation</div>
                                <p class="text-[var(--color-text-200)]">SylvieVerse was born from a passion for manga and blockchain technology. Our founding team of 5 visionaries began development.</p>
                            </div>
                        </div>

                        <div class="timeline-item relative pl-16" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.9s; opacity: 0;">
                            <div class="card-3d bg-[var(--color-background-800)]/50 backdrop-blur-sm rounded-xl p-6 border border-[var(--color-primary-700)]/30">
                                <div class="text-sm text-[var(--color-accent-400)] font-semibold mb-2">Q1 2024: Platform Launch</div>
                                <p class="text-[var(--color-text-200)]">Successfully launched our MVP with 50+ digital collectibles and real-time auction functionality.</p>
                            </div>
                        </div>

                        <div class="relative pl-16 pt-6">
                            <h3 class="text-2xl font-bold text-[var(--color-text-50)] mb-4 ml-[-1rem] text-left">
                                <span class="text-[var(--color-primary-400)] roadmap-glow p-2 rounded-lg inline-block">Future Transmission</span>
                            </h3>
                            
                            <div class="timeline-item relative pl-0 mb-8" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 2.1s; opacity: 0;">
                                <div class="card-3d bg-[var(--color-background-700)] rounded-xl p-6 border border-[var(--color-primary-500)]/50">
                                    <div class="text-sm text-[var(--color-primary-400)] font-semibold mb-2">Q2 2024 Target: Animated Assets</div>
                                    <h4 class="text-xl font-bold text-[var(--color-text-50)] mb-1">Manga-Motion Integration</h4>
                                    <p class="text-[var(--color-text-200)]">Introducing **high-fidelity animated NFT panels** and fully-rigged character collectibles.</p>
                                </div>
                            </div>
                            
                            <div class="timeline-item relative pl-0 mb-8" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 2.3s; opacity: 0;">
                                <div class="card-3d bg-[var(--color-background-700)] rounded-xl p-6 border border-[var(--color-primary-500)]/50">
                                    <div class="text-sm text-[var(--color-primary-400)] font-semibold mb-2">Q4 2024 Target: Cross-Chain Deployment</div>
                                    <h4 class="text-xl font-bold text-[var(--color-text-50)] mb-1">Ecosystem Expansion</h4>
                                    <p class="text-[var(--color-text-200)]">Integration with **two new major blockchain protocols** to reduce gas fees and expand collector access.</p>
                                </div>
                            </div>

                            <div class="timeline-item relative pl-0" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 2.5s; opacity: 0;">
                                <div class="card-3d bg-[var(--color-background-700)] rounded-xl p-6 border border-[var(--color-primary-500)]/50">
                                    <div class="text-sm text-[var(--color-primary-400)] font-semibold mb-2">Q2 2025 Target: VR/AR Viewer</div>
                                    <h4 class="text-xl font-bold text-[var(--color-text-50)] mb-1">Metaverse Gateway</h4>
                                    <p class="text-[var(--color-text-200)]">Launch of an **immersive 3D viewer** allowing users to interact with their digital assets in VR/AR environments.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-[var(--color-text-50)] mb-12 text-center" style="text-shadow: 0 0 8px var(--color-primary-400);">
                    Meet Our <span class="text-[var(--color-accent-400)]">Team</span>
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="team-member bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-6 text-center border border-[var(--color-primary-700)]/30 transition-all duration-300" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 2.7s; opacity: 0;">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] flex items-center justify-center text-white text-2xl font-bold">
                            SK
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Sylvie Kim</h3>
                        <p class="text-[var(--color-accent-400)] text-sm font-semibold mb-3">CEO & Founder</p>
                        <p class="text-[var(--color-text-200)] text-sm">Former blockchain architect with a passion for manga and digital art preservation.</p>
                    </div>

                    <div class="team-member bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-6 text-center border border-[var(--color-primary-700)]/30 transition-all duration-300" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 2.9s; opacity: 0;">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-[var(--color-accent-500)] to-[var(--color-accent-400)] flex items-center justify-center text-white text-2xl font-bold">
                            TJ
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Takashi Jin</h3>
                        <p class="text-[var(--color-accent-400)] text-sm font-semibold mb-3">CTO</p>
                        <p class="text-[var(--color-text-200)] text-sm">Smart contract expert and full-stack developer with 8+ years in Web3.</p>
                    </div>

                    <div class="team-member bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-6 text-center border border-[var(--color-primary-700)]/30 transition-all duration-300" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 3.1s; opacity: 0;">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-purple-500 to-[var(--color-primary-400)] flex items-center justify-center text-white text-2xl font-bold">
                            LM
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Luna Moon</h3>
                        <p class="text-[var(--color-accent-400)] text-sm font-semibold mb-3">Creative Director</p>
                        <p class="text-[var(--color-text-200)] text-sm">Digital artist and manga enthusiast with expertise in NFT curation.</p>
                    </div>

                    <div class="team-member bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-6 text-center border border-[var(--color-primary-700)]/30 transition-all duration-300" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 3.3s; opacity: 0;">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-accent-500)] flex items-center justify-center text-white text-2xl font-bold">
                            RK
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-2">Ren Kuro</h3>
                        <p class="text-[var(--color-accent-400)] text-sm font-semibold mb-3">Community Manager</p>
                        <p class="text-[var(--color-text-200)] text-sm">Building and nurturing our global community of collectors and artists.</p>
                    </div>
                </div>
            </div>

            <div class="bg-[var(--color-background-800)]/50 backdrop-blur-md rounded-2xl p-8 border border-[var(--color-primary-700)]/40 mb-20" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 3.5s; opacity: 0;">
                <h2 class="text-3xl md:text-4xl font-bold text-[var(--color-text-50)] mb-12 text-center">
                    Our <span class="text-[var(--color-accent-400)]">Values</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-3">Security First</h3>
                        <p class="text-[var(--color-text-200)]">Every asset is blockchain-verified with smart contract audits and secure wallet integration.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gradient-to-br from-[var(--color-accent-500)] to-[var(--color-accent-400)] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-3">Community Driven</h3>
                        <p class="text-[var(--color-text-200)]">Our platform grows with our community's feedback and collective passion for digital art.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-gradient-to-br from-purple-500 to-[var(--color-primary-400)] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-3">Innovation</h3>
                        <p class="text-[var(--color-text-200)]">Pushing the boundaries of what's possible with digital collectibles and Web3 technology.</p>
                    </div>
                </div>
            </div>

        </main>

        <footer class="bg-[var(--color-background-800)] border-t border-[var(--color-primary-700)]/50 relative z-10">
            <div class="container mx-auto px-6 py-12">
                <div class="text-center">
                    <h4 class="text-2xl font-bold mb-4 text-glow-accent">SylvieVerse</h4>
                    <p class="text-sm text-[var(--color-text-300)] max-w-2xl mx-auto mb-6">
                        The future of digital collecting, powered by blockchain technology and community passion.
                    </p>
                    <div class="flex justify-center space-x-6 mb-6">
                        <a href="/" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Home</a>
                        <a href="/about" class="text-[var(--color-primary-400)] font-semibold">About</a>
                        <a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Marketplace</a>
                        <a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Contact</a>
                    </div>
                    <p class="text-sm text-[var(--color-text-300)]">&copy; 2025 SylvieVerse. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>