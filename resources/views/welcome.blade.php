<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'puntuaTuProfe') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden">
            
            <!-- Navbar -->
            <header class="absolute top-0 left-0 right-0 p-6 flex justify-between items-center z-10 max-w-7xl mx-auto w-full">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-black text-indigo-600 tracking-tighter">puntuaTuProfe</span>
                </div>
                <nav class="flex gap-4">
                    @auth
                        <a href="{{ url('/teachers') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition underline decoration-2 decoration-indigo-200 underline-offset-4">{{ __('Profesores') }}</a>
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition">{{ __('Inicio') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition">{{ __('Iniciar Sesión') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-sm">{{ __('Registrarse') }}</a>
                        @endif
                    @endauth
                </nav>
            </header>

            <!-- Hero Section -->
            <main class="w-full max-w-4xl px-6 text-center z-10">
                <div class="mb-8 inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 px-4 py-1.5 rounded-full text-indigo-700 text-xs font-bold uppercase tracking-wider">
                    📍 Córdoba, Argentina
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-gray-900 mb-6 tracking-tight">
                    Encontrá a tu <span class="text-indigo-600">mejor profesor</span> en Córdoba.
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                    La plataforma donde los estudiantes de la UNC, UTN y demás facultades comparten sus experiencias para ayudarte a elegir mejor.
                </p>

                <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('teachers.index') }}" class="w-full md:w-auto px-8 py-4 bg-indigo-600 text-white text-lg font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2 group">
                        Buscar Profesores
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <p class="text-sm text-gray-400 font-medium italic">Unite a +500 estudiantes cordobeses.</p>
                </div>

                <!-- Stats -->
                <div class="mt-20 grid grid-cols-2 md:grid-cols-3 gap-8 border-t border-gray-200 pt-10">
                    <div>
                        <div class="text-3xl font-black text-gray-900">+200</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-widest mt-1">Profesores</div>
                    </div>
                    <div>
                        <div class="text-3xl font-black text-gray-900">+1.5k</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-widest mt-1">Opiniones</div>
                    </div>
                    <div class="col-span-2 md:col-span-1 border-t md:border-t-0 border-gray-100 pt-8 md:pt-0">
                        <div class="text-3xl font-black text-gray-900">UNC & UTN</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-widest mt-1">Universidades</div>
                    </div>
                </div>
            </main>

            <!-- Background Decoration -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-100/50 rounded-full blur-3xl -z-10"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-pink-100/30 rounded-full blur-3xl -z-10"></div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-100/30 rounded-full blur-3xl -z-10"></div>
        </div>
    </body>
</html>
