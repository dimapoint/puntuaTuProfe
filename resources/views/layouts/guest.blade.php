<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'puntuaTuProfe') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-m3-surface text-m3-on-surface font-sans antialiased">
        <!-- Decoration -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute -bottom-[10%] -left-[10%] w-[50%] h-[50%] bg-m3-primary-container/30 rounded-full blur-[120px]"></div>
            <div class="absolute top-[10%] -right-[5%] w-[40%] h-[40%] bg-m3-tertiary-container/20 rounded-full blur-[100px]"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-6">
            <div class="mb-12">
                <a href="/" class="flex flex-col items-center gap-4 group">
                    <div class="w-20 h-20 bg-m3-primary text-m3-on-primary rounded-m3-xl flex items-center justify-center shadow-m3-3 transform group-hover:rotate-12 transition-all duration-700">
                        <span class="font-black text-4xl">P</span>
                    </div>
                    <span class="text-3xl font-black text-m3-on-surface tracking-tighter">puntuaTuProfe</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 p-10 bg-m3-surface m3-card-elevated border-t-8 border-t-m3-primary animate-in fade-in zoom-in duration-500">
                {{ $slot }}
            </div>
            
            <div class="mt-12">
                <p class="text-xs font-black text-m3-on-surface-variant uppercase tracking-[0.2em] opacity-40">UCC • Córdoba • Argentina</p>
            </div>
        </div>
    </body>
</html>
