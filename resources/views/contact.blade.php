<x-app-layout>
    <style>
        /* 🚀 Enhanced Neon & 4K-Style Color Palette - Matching Homepage */
        :root {
            --color-primary-400: #7E57C2;
            --color-primary-500: #673AB7;
            --color-primary-600: #512DA8;
            --color-primary-700: #311B92;
            --color-accent-500: #00BCD4;
            --color-accent-400: #4DD0E1;
            --color-accent-600: #0097A7;
            --color-success-500: #48BB78;
            --color-success-400: #68D391;
            --color-warning-500: #ED8936;
            --color-warning-400: #F6AD55;
            --color-background-700: #1C1917;
            --color-background-800: #100C09;
            --color-background-900: #0D0A08;
            --color-text-50: #EFEFEF;
            --color-text-200: #A0AEC0;
            --color-text-300: #718096;
            --shadow-primary-glow: 0 0 15px var(--color-primary-500), 0 0 35px var(--color-primary-400);
            --shadow-accent-glow: 0 0 10px var(--color-accent-500), 0 0 20px var(--color-accent-400);
        }

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

        /* 3D and Animation Utilities */
        .bg-radial-gradient-primary {
            background-image: radial-gradient(circle at 50% 150%, var(--color-primary-500) 0%, transparent 70%);
        }

        .hero-bg-tech {
            background-image: linear-gradient(0deg, var(--color-background-800) 50%, transparent 100%),
                              repeating-linear-gradient(0deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px),
                              repeating-linear-gradient(90deg, var(--color-primary-700) 0, var(--color-primary-700) 1px, transparent 1px, transparent 100px);
            background-size: 100% 100%, 100% 100%, 100% 100%;
        }

        .text-glow-accent {
            text-shadow: 0 0 8px var(--color-accent-400);
        }

        /* Card Hover 3D Tilt Effect */
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

        /* Status Messages */
        .status-success {
            background: var(--color-success-500)/20;
            border: 1px solid var(--color-success-500)/50;
            color: var(--color-success-400);
        }

        .status-error {
            background: var(--color-warning-500)/20;
            border: 1px solid var(--color-warning-500)/50;
            color: var(--color-warning-400);
        }

        /* Loading Animation */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>

    <script>
        // Theme initialization
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

        // Contact Form Handler with External Service Integration
        class ContactFormHandler {
            constructor() {
                this.form = document.getElementById('contact-form');
                this.statusElement = document.getElementById('form-status');
                this.submitBtn = document.querySelector('#contact-form button[type="submit"]');
                this.originalBtnText = this.submitBtn.innerHTML;

                this.init();
            }

            init() {
                if (this.form) {
                    this.form.addEventListener('submit', (e) => this.handleSubmit(e));
                }
            }

            async handleSubmit(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(this.form);
                const data = Object.fromEntries(formData);

                // Validate form
                if (!this.validateForm(data)) {
                    return;
                }

                // Show loading state
                this.setLoadingState(true);

                try {
                    // Choose your preferred service:
                    // Option 1: EmailJS
                    await this.sendViaEmailJS(data);

                    // Option 2: Formspree (uncomment to use)
                    // await this.sendViaFormspree(data);

                    // Option 3: Custom API (uncomment to use)
                    // await this.sendViaCustomAPI(data);

                    this.showSuccess('Message sent successfully! We\'ll get back to you within 24 hours.');
                    this.form.reset();

                } catch (error) {
                    console.error('Form submission error:', error);
                    this.showError('Failed to send message. Please try again or email us directly.');
                } finally {
                    this.setLoadingState(false);
                }
            }

            validateForm(data) {
                const { first_name, last_name, email, subject, message } = data;

                if (!first_name || !last_name || !email || !subject || !message) {
                    this.showError('Please fill in all required fields.');
                    return false;
                }

                if (!this.isValidEmail(email)) {
                    this.showError('Please enter a valid email address.');
                    return false;
                }

                return true;
            }

            isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Option 1: EmailJS Integration
            async sendViaEmailJS(data) {
                // Initialize EmailJS (make sure to include EmailJS SDK in your layout)
                if (typeof emailjs === 'undefined') {
                    throw new Error('EmailJS not loaded');
                }

                // Replace with your EmailJS service ID and template ID
                const serviceID = '{{ config("services.emailjs.service_id") }}';
                const templateID = '{{ config("services.emailjs.template_id") }}';
                const publicKey = '{{ config("services.emailjs.public_key") }}';

                const templateParams = {
                    from_name: `${data.first_name} ${data.last_name}`,
                    from_email: data.email,
                    subject: data.subject,
                    message: data.message,
                    to_email: 'support@sylvieverse.com'
                };

                await emailjs.send(serviceID, templateID, templateParams, publicKey);
            }

            // Option 2: Formspree Integration
            async sendViaFormspree(data) {
                const formspreeEndpoint = 'https://formspree.io/f/your-form-id-here';

                const response = await fetch(formspreeEndpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    throw new Error('Formspree submission failed');
                }
            }

            // Option 3: Custom API Integration
            async sendViaCustomAPI(data) {
                const response = await fetch('/api/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    throw new Error('API submission failed');
                }
            }

            setLoadingState(loading) {
                if (loading) {
                    this.submitBtn.disabled = true;
                    this.submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending Message...
                    `;
                } else {
                    this.submitBtn.disabled = false;
                    this.submitBtn.innerHTML = this.originalBtnText;
                }
            }

            showSuccess(message) {
                this.showStatus(message, 'success');
            }

            showError(message) {
                this.showStatus(message, 'error');
            }

            showStatus(message, type) {
                this.statusElement.className = `mt-4 p-4 rounded-xl text-center ${type === 'success' ? 'status-success' : 'status-error'}`;
                this.statusElement.innerHTML = `
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            ${type === 'success' ?
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />' :
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'
                            }
                        </svg>
                        <span>${message}</span>
                    </div>
                `;
                this.statusElement.style.display = 'block';

                // Auto-hide success messages after 5 seconds
                if (type === 'success') {
                    setTimeout(() => {
                        this.statusElement.style.display = 'none';
                    }, 5000);
                }
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new ContactFormHandler();

            // FAQ functionality
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

    <!-- Add EmailJS SDK (remove if using other services) -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        // Initialize EmailJS with your public key
        (function() {
            emailjs.init("{{ config('services.emailjs.public_key') }}");
        })();
    </script>

    <div class="min-h-screen relative overflow-hidden bg-[--color-background-900] text-[--color-text-50] transition-colors duration-500 font-sans">

        <!-- Background Elements -->
        <div class="absolute inset-0 bg-radial-gradient-primary opacity-20 transition-opacity duration-500"></div>
        <div class="absolute inset-0 opacity-10 dark:hero-bg-tech"></div>

        <!-- Theme Toggle -->
        <div class="absolute top-8 right-6 z-20">
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
            <div class="max-w-4xl mx-auto text-center mb-16">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tight leading-tight">
                    Get In
                    <span class="bg-gradient-to-r from-[var(--color-primary-400)] to-[var(--color-accent-500)] bg-clip-text text-transparent" style="text-shadow: 0 0 15px var(--color-accent-500);">
                        Touch
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-[var(--color-text-200)] mb-8 max-w-3xl mx-auto font-light">
                    Have questions about **digital collectibles** or need support? Our team is here to help you navigate the SylvieVerse.
                </p>
            </div>

            <!-- Contact Form Section -->
            <div class="max-w-4xl mx-auto">
                <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-8 border border-[--color-primary-700)]/40">
                    <h2 class="text-3xl font-bold text-[var(--color-text-50)] mb-2">Send us a Message</h2>
                    <p class="text-[var(--color-text-200)] mb-8">We'll get back to you as soon as possible</p>

                    <form id="contact-form" class="space-y-6">
                        <!-- Status Messages -->
                        <div id="form-status" class="hidden"></div>

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
            </div>

            <!-- Alternative Contact Methods -->
            <div class="max-w-4xl mx-auto mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Direct Email -->
                <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700)]/40">
                    <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-4">Prefer Direct Email?</h3>
                    <p class="text-[var(--color-text-200)] mb-4">You can also reach us directly at:</p>
                    <div class="space-y-2">
                        <a href="mailto:support@sylvieverse.com" class="block text-[var(--color-accent-400)] hover:text-[var(--color-accent-300)] transition-colors">
                            📧 support@sylvieverse.com
                        </a>
                        <a href="mailto:partners@sylvieverse.com" class="block text-[var(--color-accent-400)] hover:text-[var(--color-accent-300)] transition-colors">
                            🤝 partners@sylvieverse.com
                        </a>
                    </div>
                </div>

                <!-- Service Status -->
                <div class="card-3d bg-[var(--color-background-800)]/70 backdrop-blur-md rounded-2xl p-6 border border-[--color-primary-700)]/40">
                    <h3 class="text-xl font-bold text-[var(--color-text-50)] mb-4">Service Status</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[var(--color-text-200)]">Form Service</span>
                            <span class="px-2 py-1 bg-[var(--color-success-500)]/20 text-[var(--color-success-400)] rounded text-sm">
                                Operational
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[var(--color-text-200)]">Response Time</span>
                            <span class="text-[var(--color-text-50)] font-medium">< 24 hours</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
