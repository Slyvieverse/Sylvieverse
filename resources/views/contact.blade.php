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
        }

        /* ☀️ Light Mode */
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

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                max-height: 500px;
                transform: translateY(0);
            }
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

        /* Form Styling */
        .form-input {
            background: var(--color-background-800);
            border: 1px solid var(--color-primary-700);
            color: var(--color-text-50);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--color-accent-500);
            box-shadow: 0 0 0 3px var(--color-accent-500)/20;
            outline: none;
        }

        .form-input::placeholder {
            color: var(--color-text-300);
        }

        /* Contact card hover effects */
        .contact-card {
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-primary-glow);
        }

        /* Floating animation for decorative elements */
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        /* Dropdown Styles */
        .faq-item {
            border-bottom: 1px solid var(--color-primary-700)/30;
        }

        .faq-question {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .faq-question:hover {
            background: var(--color-background-600);
        }

        .faq-answer {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s ease-out;
        }

        .faq-answer.open {
            max-height: 500px;
            opacity: 1;
            animation: slideDown 0.3s ease-out;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-icon.rotated {
            transform: rotate(180deg);
        }
    </style>

    <script>
        // Theme initialization (same as other pages)
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

        // Form submission handler
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contact-form');
            
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Get form data
                    const formData = new FormData(contactForm);
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    
                    // Simulate form submission
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending...
                    `;
                    submitBtn.disabled = true;
                    
                    // Simulate API call
                    setTimeout(() => {
                        // Show success message
                        const successMessage = document.createElement('div');
                        successMessage.className = 'mt-6 p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400 text-center';
                        successMessage.innerHTML = `
                            <strong>Message Sent!</strong> We'll get back to you within 24 hours.
                        `;
                        contactForm.appendChild(successMessage);
                        
                        // Reset form and button
                        contactForm.reset();
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        
                        // Remove success message after 5 seconds
                        setTimeout(() => {
                            successMessage.remove();
                        }, 5000);
                    }, 2000);
                });
            }

            // FAQ Dropdown functionality
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('.faq-icon');
                    
                    // Close all other answers
                    document.querySelectorAll('.faq-answer').forEach(otherAnswer => {
                        if (otherAnswer !== answer) {
                            otherAnswer.classList.remove('open');
                            otherAnswer.previousElementSibling.querySelector('.faq-icon').classList.remove('rotated');
                        }
                    });
                    
                    // Toggle current answer
                    answer.classList.toggle('open');
                    icon.classList.toggle('rotated');
                });
            });
        });
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans">
        
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 dark:animate-[pulse-glow_8s_ease-in-out_infinite] transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <!-- Floating decorative elements -->
        <div class="absolute top-1/4 left-10 w-4 h-4 bg-[var(--color-accent-400)] rounded-full opacity-60 float-animation" style="animation-delay: 0s;"></div>
        <div class="absolute top-1/3 right-20 w-6 h-6 bg-[var(--color-primary-400)] rounded-full opacity-40 float-animation" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/4 w-3 h-3 bg-[var(--color-accent-500)] rounded-full opacity-70 float-animation" style="animation-delay: 4s;"></div>

        <!-- Theme Toggle -->
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

            <!-- Hero Section -->
            <div class="max-w-4xl mx-auto text-center mb-16" style="animation: page-enter 0.5s ease-out forwards; opacity: 0;">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight leading-tight">
                    Get In 
                    <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                        Touch
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-8 max-w-3xl mx-auto font-light">
                    Have questions about **digital collectibles** or need support? Our team is here to help you navigate the SylvieVerse.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="/" class="btn-3d px-8 py-3 rounded-xl bg-gradient-to-r from-[var(--color-primary-600)] to-[var(--color-primary-500)] hover:from-[var(--color-primary-500)] hover:to-[var(--color-primary-400)] text-[var(--color-text-50)] font-semibold text-lg">
                        ← Back to Home
                    </a>
                    <a href="#contact-form" class="btn-3d px-8 py-3 rounded-xl bg-[var(--color-background-700)] dark:hover:bg-[var(--color-background-800)] light:hover:bg-[var(--color-background-700)] border border-[var(--color-accent-500)]/50 text-[var(--color-accent-400)] font-semibold text-lg">
                        Send Message ↓
                    </a>
                </div>
            </div>

            <!-- Contact Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <!-- Support Card -->
                <div class="contact-card bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 text-center border border-[var(--color-primary-700)]/30" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.6s; opacity: 0;">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[var(--color-primary-600)] to-[var(--color-primary-400)] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-50)] mb-4">Technical Support</h3>
                    <p class="text-[var(--color-text-200)] mb-6">Get help with wallet connections, bidding issues, or platform technical questions.</p>
                    <div class="text-[var(--color-accent-400)] font-semibold">
                        support@sylvieverse.com
                    </div>
                    <div class="text-sm text-[var(--color-text-300)] mt-2">Response time: < 4 hours</div>
                </div>

                <!-- Partnerships Card -->
                <div class="contact-card bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 text-center border border-[var(--color-primary-700)]/30" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 0.8s; opacity: 0;">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[var(--color-accent-500)] to-[var(--color-accent-400)] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-50)] mb-4">Partnerships</h3>
                    <p class="text-[var(--color-text-200)] mb-6">Interested in collaborating? Reach out for artist partnerships and business opportunities.</p>
                    <div class="text-[var(--color-accent-400)] font-semibold">
                        partners@sylvieverse.com
                    </div>
                    <div class="text-sm text-[var(--color-text-300)] mt-2">Response time: < 24 hours</div>
                </div>

                <!-- General Card -->
                <div class="contact-card bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 text-center border border-[var(--color-primary-700)]/30" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.0s; opacity: 0;">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-purple-500 to-[var(--color-primary-400)] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[var(--color-text-50)] mb-4">General Inquiries</h3>
                    <p class="text-[var(--color-text-200)] mb-6">Have general questions about our platform or services? We're happy to help.</p>
                    <div class="text-[var(--color-accent-400)] font-semibold">
                        hello@sylvieverse.com
                    </div>
                    <div class="text-sm text-[var(--color-text-300)] mt-2">Response time: < 12 hours</div>
                </div>
            </div>

            <!-- Contact Form & Info Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
                <!-- Contact Form -->
                <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 border border-[var(--color-primary-700)]/40" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.2s; opacity: 0;">
                    <h2 class="text-3xl font-bold text-[var(--color-text-50)] mb-2">Send us a Message</h2>
                    <p class="text-[var(--color-text-200)] mb-8">We'll get back to you as soon as possible</p>
                    
                    <form id="contact-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first-name" class="block text-sm font-medium text-[var(--color-text-200)] mb-2">First Name *</label>
                                <input type="text" id="first-name" name="first_name" required 
                                       class="w-full form-input px-4 py-3 rounded-xl focus:ring-2 focus:ring-[var(--color-accent-500)]">
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-medium text-[var(--color-text-200)] mb-2">Last Name *</label>
                                <input type="text" id="last-name" name="last_name" required 
                                       class="w-full form-input px-4 py-3 rounded-xl focus:ring-2 focus:ring-[var(--color-accent-500)]">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-[var(--color-text-200)] mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full form-input px-4 py-3 rounded-xl focus:ring-2 focus:ring-[var(--color-accent-500)]"
                                   placeholder="your@email.com">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-[var(--color-text-200)] mb-2">Subject *</label>
                            <select id="subject" name="subject" required 
                                    class="w-full form-input px-4 py-3 rounded-xl focus:ring-2 focus:ring-[var(--color-accent-500)]">
                                <option value="">Select a topic</option>
                                <option value="technical">Technical Support</option>
                                <option value="partnership">Partnership Inquiry</option>
                                <option value="general">General Question</option>
                                <option value="billing">Billing Issue</option>
                                <option value="feature">Feature Request</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-[var(--color-text-200)] mb-2">Message *</label>
                            <textarea id="message" name="message" rows="6" required 
                                      class="w-full form-input px-4 py-3 rounded-xl focus:ring-2 focus:ring-[var(--color-accent-500)]"
                                      placeholder="Tell us how we can help you..."></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="w-full btn-3d py-4 rounded-xl bg-gradient-to-r from-[var(--color-accent-600)] to-[var(--color-accent-500)] text-white font-semibold text-lg shadow-md shadow-[var(--color-accent-500)]/30 hover:shadow-[var(--color-accent-500)]/50 transition-all">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information & FAQ -->
                <div class="space-y-8" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.4s; opacity: 0;">
                    <!-- Office Info -->
                    <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 border border-[var(--color-primary-700)]/40">
                        <h3 class="text-2xl font-bold text-[var(--color-text-50)] mb-6">Our Office</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-[var(--color-primary-500)]/20 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--color-primary-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-text-50)]">Headquarters</h4>
                                    <p class="text-[var(--color-text-200)]">123 Blockchain Boulevard<br>Digital District, DV 10101</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-500)]/20 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[var(--color-accent-400)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-text-50)]">Phone</h4>
                                    <p class="text-[var(--color-text-200)]">+1 (555) 123-4567</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[var(--color-text-50)]">Business Hours</h4>
                                    <p class="text-[var(--color-text-200)]">Monday - Friday: 9:00 AM - 6:00 PM<br>Weekend: Emergency Support Only</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Quick Links -->
                    <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 border border-[var(--color-primary-700)]/40">
                        <h3 class="text-2xl font-bold text-[var(--color-text-50)] mb-6">Quick Help</h3>
                        
                        <div class="space-y-2">
                            <!-- FAQ Item 1 -->
                            <div class="faq-item">
                                <div class="faq-question flex items-center justify-between p-4 rounded-xl bg-[var(--color-background-700)] cursor-pointer group">
                                    <span class="text-[var(--color-text-50)] font-medium">How do I connect my wallet?</span>
                                    <svg class="faq-icon h-5 w-5 text-[var(--color-text-300)] group-hover:text-[var(--color-accent-400)] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div class="faq-answer px-4">
                                    <div class="py-4 text-[var(--color-text-200)] border-t border-[var(--color-primary-700)]/30">
                                        <p>To connect your wallet:</p>
                                        <ol class="list-decimal list-inside mt-2 space-y-1">
                                            <li>Click the "Connect Wallet" button in the top right corner</li>
                                            <li>Select your preferred wallet (MetaMask, Coinbase Wallet, etc.)</li>
                                            <li>Approve the connection request in your wallet</li>
                                            <li>Sign the verification message to complete the process</li>
                                        </ol>
                                        <p class="mt-2 text-sm text-[var(--color-accent-400)]">Make sure you're on the correct network (Ethereum Mainnet).</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="faq-item">
                                <div class="faq-question flex items-center justify-between p-4 rounded-xl bg-[var(--color-background-700)] cursor-pointer group">
                                    <span class="text-[var(--color-text-50)] font-medium">Bidding process explained</span>
                                    <svg class="faq-icon h-5 w-5 text-[var(--color-text-300)] group-hover:text-[var(--color-accent-400)] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div class="faq-answer px-4">
                                    <div class="py-4 text-[var(--color-text-200)] border-t border-[var(--color-primary-700)]/30">
                                        <p>Our bidding process is simple and secure:</p>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Browse available auctions and select an item</li>
                                            <li>Place your bid by entering the amount and confirming the transaction</li>
                                            <li>You'll be notified if you're outbid</li>
                                            <li>If you win, the NFT will be transferred to your wallet automatically</li>
                                            <li>All bids are processed through smart contracts for transparency</li>
                                        </ul>
                                        <p class="mt-2 text-sm text-[var(--color-accent-400)]">Bids are binding - make sure you have sufficient funds!</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="faq-item">
                                <div class="faq-question flex items-center justify-between p-4 rounded-xl bg-[var(--color-background-700)] cursor-pointer group">
                                    <span class="text-[var(--color-text-50)] font-medium">NFT authenticity verification</span>
                                    <svg class="faq-icon h-5 w-5 text-[var(--color-text-300)] group-hover:text-[var(--color-accent-400)] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div class="faq-answer px-4">
                                    <div class="py-4 text-[var(--color-text-200)] border-t border-[var(--color-primary-700)]/30">
                                        <p>Every NFT on SylvieVerse undergoes rigorous verification:</p>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li><strong>Smart Contract Audit:</strong> All contracts are professionally audited</li>
                                            <li><strong>Artist Verification:</strong> We verify the identity of all creators</li>
                                            <li><strong>Metadata Integrity:</strong> All asset data is stored on IPFS</li>
                                            <li><strong>Provenance Tracking:</strong> Complete ownership history is recorded on-chain</li>
                                        </ul>
                                        <p class="mt-2 text-sm text-[var(--color-accent-400)]">Look for the "Verified" badge on authentic items.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="faq-item">
                                <div class="faq-question flex items-center justify-between p-4 rounded-xl bg-[var(--color-background-700)] cursor-pointer group">
                                    <span class="text-[var(--color-text-50)] font-medium">Gas fees and transaction costs</span>
                                    <svg class="faq-icon h-5 w-5 text-[var(--color-text-300)] group-hover:text-[var(--color-accent-400)] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div class="faq-answer px-4">
                                    <div class="py-4 text-[var(--color-text-200)] border-t border-[var(--color-primary-700)]/30">
                                        <p>Understanding transaction costs:</p>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li><strong>Gas Fees:</strong> Paid to the network for processing transactions</li>
                                            <li><strong>Platform Fee:</strong> 2.5% on successful sales</li>
                                            <li><strong>Creator Royalty:</strong> 5-10% goes to the original artist on secondary sales</li>
                                        </ul>
                                        <p class="mt-2 text-sm text-[var(--color-accent-400)]">Gas fees vary based on network congestion. We recommend transacting during off-peak hours.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Community Section -->
            <div class="text-center py-12 border-t border-[var(--color-primary-700)]/50" style="animation: page-enter 0.5s ease-out forwards; animation-delay: 1.6s; opacity: 0;">
                <h2 class="text-3xl font-bold text-[var(--color-text-50)] mb-6">Join Our Community</h2>
                <p class="text-lg text-[var(--color-text-200)] mb-8 max-w-2xl mx-auto">
                    Connect with other collectors, get real-time updates, and participate in exclusive community events.
                </p>
                <div class="flex justify-center space-x-6">
                    <a href="#" class="btn-3d px-6 py-3 rounded-xl bg-[var(--color-background-700)] border border-[var(--color-primary-700)] text-[var(--color-text-50)] font-semibold flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.44 2.197c1.767 0 2.973.905 3.336 2.507h.03c.363-1.602 1.569-2.507 3.336-2.507h.03c1.767 0 2.973.905 3.336 2.507h.03c.363-1.602 1.569-2.507 3.336-2.507h.03c1.767 0 2.973.905 3.336 2.507h.03c.363-1.602 1.569-2.507 3.336-2.507h.03c1.767 0 2.973.905 3.336 2.507h.03z"/>
                        </svg>
                        <span>Discord</span>
                    </a>
                    <a href="#" class="btn-3d px-6 py-3 rounded-xl bg-[var(--color-background-700)] border border-[var(--color-primary-700)] text-[var(--color-text-50)] font-semibold flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 6c-1.333.743-2.766 1.246-4.316 1.488 1.532-.914 2.721-2.35 3.275-4.048-1.428.84-3.004 1.455-4.685 1.787-1.346-1.433-3.264-2.327-5.385-2.327-4.06 0-7.35 3.29-7.35 7.35 0 .578.067 1.14.19 1.688C4.54 9.172 2.457 7.086.58 4.965c-.2.34-.316.732-.316 1.155 0 2.548 1.298 4.79 3.275 6.1-1.207-.035-2.348-.367-3.336-.92v.09c0 3.55 2.529 6.505 5.88 7.185-.615.167-1.26.25-1.92.25-.47 0-.93-.045-1.37-.13.93 2.906 3.63 5.035 6.84 5.093-2.43 1.907-5.54 3.05-8.89 3.05-.58 0-1.15-.035-1.71-.102C2.12 21.36 5.89 23 10 23c12 0 18.57-9.93 18.57-18.57 0-.284-.007-.568-.02-.852A13.29 13.29 0 0022 6z"/>
                        </svg>
                        <span>Twitter</span>
                    </a>
                </div>
            </div>
            
        </main>

        <!-- Footer -->
        <footer class="bg-[var(--color-background-800)] border-t border-[var(--color-primary-700)]/50 relative z-10">
            <div class="container mx-auto px-6 py-12">
                <div class="text-center">
                    <h4 class="text-2xl font-bold mb-4 text-glow-accent">SylvieVerse</h4>
                    <p class="text-sm text-[var(--color-text-300)] max-w-2xl mx-auto mb-6">
                        The future of digital collecting, powered by blockchain technology and community passion.
                    </p>
                    <div class="flex justify-center space-x-6 mb-6">
                        <a href="/" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Home</a>
                        <a href="/about" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">About</a>
                        <a href="/contact" class="text-[var(--color-primary-400)] font-semibold">Contact</a>
                        <a href="#" class="text-[var(--color-text-200)] hover:text-[var(--color-primary-400)] transition-colors">Marketplace</a>
                    </div>
                    <p class="text-sm text-[var(--color-text-300)]">&copy; 2025 SylvieVerse. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>