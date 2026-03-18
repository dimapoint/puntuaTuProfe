<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'puntuaTuProfe') }} - La guía de los estudiantes de Córdoba</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-900 font-sans antialiased selection:bg-indigo-100 selection:text-indigo-900">
        
        <!-- Decoration -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute -top-[10%] -right-[10%] w-[40%] h-[40%] bg-indigo-50 rounded-full blur-3xl opacity-50 animate-pulse"></div>
            <div class="absolute top-[40%] -left-[5%] w-[30%] h-[30%] bg-blue-50 rounded-full blur-3xl opacity-40"></div>
            <div class="absolute -bottom-[5%] right-[20%] w-[25%] h-[25%] bg-pink-50 rounded-full blur-3xl opacity-30"></div>
        </div>

        <div class="relative min-h-screen flex flex-col">
            
            <!-- Navbar -->
            <header class="w-full max-w-7xl mx-auto px-6 py-8 flex justify-between items-center z-50">
                <div class="flex items-center gap-2 group cursor-default">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 transform group-hover:rotate-6 transition">
                        <span class="text-white font-black text-xl">P</span>
                    </div>
                    <span class="text-2xl font-black text-gray-900 tracking-tighter">puntuaTuProfe</span>
                </div>
                
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('teachers.index') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition tracking-tight">Explorar Profesores</a>
                    <div class="h-4 w-px bg-gray-200"></div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transition tracking-tight">Mi Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition tracking-tight">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-full hover:bg-gray-800 transition-all shadow-sm active:scale-95">Comenzar</a>
                    @endauth
                </nav>

                <!-- Mobile Menu Button (simplified) -->
                <button class="md:hidden p-2 text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </header>

            <!-- Hero Section -->
            <main class="flex-grow flex flex-col items-center justify-center px-6 pt-12 pb-24 text-center">
                <div class="mb-6 inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm border border-gray-100 px-4 py-2 rounded-full shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-xs font-bold text-gray-700 uppercase tracking-widest">Ya disponible para la UNC y UTN</span>
                </div>

                <h1 class="text-5xl md:text-8xl font-black text-gray-900 mb-8 tracking-tight leading-[0.95] max-w-5xl">
                    Elegí a tu profesor <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">con inteligencia.</span>
                </h1>
                
                <p class="text-lg md:text-2xl text-gray-600 mb-12 leading-relaxed max-w-2xl mx-auto font-medium">
                    La comunidad más grande de Córdoba para compartir experiencias académicas reales y honestas.
                </p>

                <!-- Search Mockup/Direct Link -->
                <div class="w-full max-w-2xl relative group mb-16">
                    <form action="{{ route('teachers.index') }}" method="GET" class="relative">
                        <input 
                            type="text" 
                            name="search"
                            placeholder="Buscá un profesor o una materia..." 
                            class="w-full px-8 py-6 bg-white border-2 border-gray-100 rounded-2xl text-lg font-medium shadow-2xl shadow-indigo-100/50 focus:outline-none focus:border-indigo-500/30 focus:ring-4 focus:ring-indigo-500/5 transition-all"
                        >
                        <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 p-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Features/Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mt-12">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition group text-left">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 italic tracking-tight">Transparente</h3>
                        <p class="text-gray-500 font-medium">Opiniones reales de estudiantes que ya cursaron las materias que estás por elegir.</p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition group text-left">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 italic tracking-tight">Anónimo</h3>
                        <p class="text-gray-500 font-medium">Tu identidad está protegida. Podés compartir tus experiencias con total libertad y seguridad.</p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition group text-left">
                        <div class="w-12 h-12 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 italic tracking-tight">Comunitario</h3>
                        <p class="text-gray-500 font-medium">Ayudá a otros estudiantes a navegar su carrera con mejores herramientas y menos sorpresas.</p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="w-full max-w-7xl mx-auto px-6 py-12 border-t border-gray-100 mt-20">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition duration-500">
                        <div class="w-6 h-6 bg-gray-900 rounded flex items-center justify-center">
                            <span class="text-white font-black text-[10px]">P</span>
                        </div>
                        <span class="text-sm font-black text-gray-900 tracking-tighter uppercase">puntuaTuProfe</span>
                    </div>
                    <p class="text-sm font-medium text-gray-400 italic">© {{ date('Y') }} — Hecho por y para estudiantes.</p>
                    <div class="flex gap-6">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition underline underline-offset-4 decoration-1 decoration-gray-200 font-medium text-sm italic">Privacidad</a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition underline underline-offset-4 decoration-1 decoration-gray-200 font-medium text-sm italic">Contacto</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
