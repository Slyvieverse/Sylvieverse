<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto+Serif:opsz,wght@8..144,400;8..144,500;8..144,600&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Define a vibrant, cyberpunk color scheme */
            --color-background-900: #0a0814;
            --color-background-800: #12101f;
            --color-background-700: #1c1a2e;
            --color-primary-900: #4a00e0;
            --color-primary-800: #6a00f0;
            --color-primary-700: #8b00ff;
            --color-primary-600: #a820ff;
            --color-primary-500: #c542ff;
            --color-primary-400: #e263ff;
            --color-accent-500: #00fff0;
            --color-text-50: #ffffff;
            --color-text-100: #f5f5f5;
            --color-text-200: #d4d4d4;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-heading {
            font-family: 'Roboto Serif', serif;
        }

        /* Custom cyberpunk grid pattern for the background */
        .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(200, 200, 200, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(200, 200, 200, 0.05) 1px, transparent 1px);
            background-size: 25px 25px;
        }

        /* Keyframe for the card fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-[--color-background-900] font-body text-[--color-text-100] min-h-screen flex items-center justify-center relative overflow-x-hidden">
    <!-- Cyberpunk background elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[--color-background-900]"></div>
        <!-- Grid overlay -->
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <!-- Glowing elements -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[--color-primary-500] rounded-full filter blur-[100px] opacity-10 animate-pulse"></div>
        <div class="absolute bottom-1/3 right-1/4 w-80 h-80 bg-[--color-accent-500] rounded-full filter blur-[80px] opacity-10 animate-pulse delay-1000"></div>
    </div>
    
    <!-- Render the content from the child view -->
    {{ $slot }}
</body>
</html>
