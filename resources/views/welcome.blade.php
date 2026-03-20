<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'puntuaTuProfe') }} - La guía de los estudiantes de Córdoba</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Fonts (M3 Expressive uses Google Fonts like Instrument Sans or Inter) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-m3-surface text-m3-on-surface font-sans antialiased selection:bg-m3-primary-container selection:text-m3-on-primary-container">
        
        <!-- M3 Expressive Background Decoration -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute -top-[5%] -right-[5%] w-[45%] h-[45%] bg-m3-primary-container/40 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute top-[35%] -left-[10%] w-[35%] h-[35%] bg-m3-tertiary-container/30 rounded-full blur-[100px]"></div>
        </div>

        <div class="relative min-h-screen flex flex-col">
            
            <!-- M3 Navigation Bar -->
            <header class="w-full max-w-7xl mx-auto px-6 py-8 flex justify-between items-center z-50">
                <div class="flex items-center gap-3 group cursor-default">
                    <div class="w-12 h-12 bg-m3-primary text-m3-on-primary rounded-m3-xl flex items-center justify-center shadow-m3-2 transform group-hover:rotate-6 transition-all duration-500">
                        <span class="font-black text-2xl">P</span>
                    </div>
                    <span class="text-2xl font-black text-m3-on-surface tracking-tighter">puntuaTuProfe</span>
                </div>
                
                <nav class="hidden md:flex items-center gap-2 bg-m3-surface-variant/50 backdrop-blur-md px-2 py-2 rounded-m3-full border border-m3-outline">
                    <a href="{{ route('teachers.index') }}" class="px-6 py-2.5 text-sm font-bold text-m3-on-surface-variant hover:text-m3-primary transition-all rounded-m3-full hover:bg-m3-primary/5">Explorar</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-m3-primary text-m3-on-primary text-sm font-bold rounded-m3-full shadow-m3-1 hover:shadow-m3-2 transition-all">Mi Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-m3-on-surface-variant hover:text-m3-primary transition-all rounded-m3-full">Ingresar</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-m3-primary text-m3-on-primary text-sm font-bold rounded-m3-full shadow-m3-1 hover:shadow-m3-2 transition-all">Comenzar</a>
                    @endauth
                </nav>

                <button class="md:hidden p-3 bg-m3-surface-variant rounded-m3-large text-m3-on-surface-variant">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </header>

            <!-- M3 Expressive Hero Section -->
            <main class="flex-grow flex flex-col items-center justify-center px-6 pt-16 pb-32 text-center">
                <div class="mb-8 inline-flex items-center gap-3 bg-m3-tertiary-container/50 border border-m3-tertiary/20 px-6 py-2.5 rounded-m3-full shadow-m3-1">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-m3-tertiary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-m3-tertiary"></span>
                    </span>
                    <span class="text-xs font-black text-m3-on-tertiary-container uppercase tracking-widest">Ya disponible para la UNC y UTN</span>
                </div>

                <h1 class="text-6xl md:text-9xl font-black text-m3-on-surface mb-10 tracking-tight leading-[0.9] max-w-5xl">
                    Elegí a tu profesor <br/> <span class="text-m3-primary underline decoration-m3-tertiary/30 decoration-8 underline-offset-8">con inteligencia.</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-m3-on-surface-variant mb-14 leading-relaxed max-w-2xl mx-auto font-medium">
                    La comunidad más grande de Córdoba para compartir experiencias académicas reales y honestas.
                </p>

                <!-- M3 Expressive Search Box -->
                <div class="w-full max-w-3xl relative group mb-24">
                    <form action="{{ route('teachers.index') }}" method="GET" class="relative">
                        <input 
                            type="text" 
                            name="search"
                            placeholder="Buscá un profesor o una materia..." 
                            class="w-full px-10 py-8 bg-m3-surface-variant border-none rounded-m3-xl text-xl font-bold shadow-m3-3 focus:ring-4 focus:ring-m3-primary/10 transition-all outline-none"
                        >
                        <button type="submit" class="absolute right-5 top-1/2 -translate-y-1/2 p-4 bg-m3-primary text-m3-on-primary rounded-m3-large hover:scale-105 transition-all shadow-m3-2 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- M3 Expressive Feature Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-6xl">
                    <div class="m3-card-elevated p-10 text-left bg-m3-primary-container/20 group hover:bg-m3-primary-container/40 transition-all">
                        <div class="w-16 h-16 bg-m3-primary text-m3-on-primary rounded-m3-large flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500 shadow-m3-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-m3-on-surface mb-4 tracking-tight">Transparente</h3>
                        <p class="text-m3-on-surface-variant font-medium leading-relaxed">Opiniones reales de estudiantes que ya cursaron las materias que estás por elegir.</p>
                    </div>

                    <div class="m3-card-elevated p-10 text-left bg-m3-secondary-container/20 group hover:bg-m3-secondary-container/40 transition-all">
                        <div class="w-16 h-16 bg-m3-secondary text-m3-on-secondary rounded-m3-large flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500 shadow-m3-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-m3-on-surface mb-4 tracking-tight">Anónimo</h3>
                        <p class="text-m3-on-surface-variant font-medium leading-relaxed">Tu identidad está protegida. Podés compartir tus experiencias con total libertad y seguridad.</p>
                    </div>

                    <div class="m3-card-elevated p-10 text-left bg-m3-tertiary-container/20 group hover:bg-m3-tertiary-container/40 transition-all">
                        <div class="w-16 h-16 bg-m3-tertiary text-m3-on-tertiary rounded-m3-large flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500 shadow-m3-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-m3-on-surface mb-4 tracking-tight">Comunitario</h3>
                        <p class="text-m3-on-surface-variant font-medium leading-relaxed">Ayudá a otros estudiantes a navegar su carrera con mejores herramientas y menos sorpresas.</p>
                    </div>
                </div>
            </main>

            <!-- M3 Footer -->
            <footer class="w-full max-w-7xl mx-auto px-6 py-16 border-t border-m3-outline mt-20">
                <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-3 opacity-60 hover:opacity-100 transition-opacity duration-500">
                        <div class="w-8 h-8 bg-m3-on-surface rounded-m3-medium flex items-center justify-center">
                            <span class="text-m3-surface font-black text-xs">P</span>
                        </div>
                        <span class="text-sm font-black text-m3-on-surface tracking-tighter uppercase">puntuaTuProfe</span>
                    </div>
                    <p class="text-sm font-bold text-m3-on-surface-variant italic">© {{ date('Y') }} — Hecho por y para estudiantes.</p>
                    <div class="flex gap-8">
                        <a href="#" class="text-m3-on-surface-variant hover:text-m3-primary transition-all font-bold text-sm">Privacidad</a>
                        <a href="#" class="text-m3-on-surface-variant hover:text-m3-primary transition-all font-bold text-sm">Contacto</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
