<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-4xl font-black text-m3-on-surface tracking-tighter leading-none mb-2">
                    {{ __('Teachers') }}
                </h2>
                <p class="text-m3-on-surface-variant font-medium italic">Encontrá y calificá a tus profesores de la UCC.</p>
            </div>
            
            <a href="{{ route('teachers.create') }}" class="m3-btn-filled gap-2 shadow-m3-2 group">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                <span>{{ __('Agregar Profesor') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Search Section -->
            <div class="m3-card-elevated p-8 bg-m3-primary-container/10 border border-m3-primary/5">
                <form action="{{ route('teachers.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-grow group">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-m3-on-surface-variant group-focus-within:text-m3-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Buscá por nombre o materia..." 
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-4 bg-m3-surface border-2 border-m3-outline rounded-m3-xl focus:border-m3-primary focus:ring-4 focus:ring-m3-primary/5 transition-all outline-none font-bold text-m3-on-surface"
                        >
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="m3-btn-filled !px-8">
                            {{ __('Search') }}
                        </button>
                        @if(request('search'))
                            <a href="{{ route('teachers.index') }}" class="m3-btn-tonal !px-6 border border-m3-outline">
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Content Area -->
            <div class="space-y-8">
                <!-- Courses Results -->
                @if(isset($courses) && count($courses) > 0)
                    <div class="animate-in fade-in slide-in-from-bottom-4 duration-500">
                        <div class="flex items-center gap-4 mb-6">
                            <h3 class="text-2xl font-black text-m3-on-surface tracking-tight">Materias</h3>
                            <div class="h-px flex-grow bg-m3-outline/50"></div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($courses as $course)
                                <a href="{{ route('courses.show', $course) }}" class="m3-card p-5 border-l-4 border-l-m3-primary hover:bg-m3-primary/5 group">
                                    <span class="block text-[10px] font-black text-m3-primary uppercase tracking-widest mb-1">{{ $course->code }}</span>
                                    <span class="block text-sm font-black text-m3-on-surface group-hover:text-m3-primary transition-colors leading-tight">{{ $course->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Teachers Results -->
                <div class="animate-in fade-in slide-in-from-bottom-8 duration-700">
                    <div class="flex items-center gap-4 mb-6">
                        <h3 class="text-2xl font-black text-m3-on-surface tracking-tight">
                            @if(request('search'))
                                Profesores encontrados
                            @else
                                Todos los profesores
                            @endif
                        </h3>
                        <div class="h-px flex-grow bg-m3-outline/50"></div>
                    </div>

                    @if($teachers->isEmpty())
                        <div class="m3-card p-16 text-center bg-m3-surface-variant/30 border-dashed border-2">
                            <div class="w-20 h-20 bg-m3-surface rounded-full flex items-center justify-center mx-auto mb-6 shadow-m3-1">
                                <svg class="w-10 h-10 text-m3-on-surface-variant" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <p class="text-xl font-black text-m3-on-surface mb-2">{{ __('No teachers found matching your search.') }}</p>
                            <p class="text-m3-on-surface-variant font-medium mb-8">Probá con otros términos o agregá vos al profesor.</p>
                            <a href="{{ route('teachers.create') }}" class="m3-btn-filled">
                                {{ __('Agregar Profesor') }}
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($teachers as $teacher)
                                <x-teacher-card :teacher="$teacher" />
                            @endforeach
                        </div>
                        <div class="mt-12">
                            {{ $teachers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
