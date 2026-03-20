<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 bg-m3-primary text-m3-on-primary rounded-m3-xl flex items-center justify-center text-4xl font-black shadow-m3-2">
                    {{ substr($teacher->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-4xl font-black text-m3-on-surface tracking-tighter leading-tight">
                        {{ $teacher->name }}
                    </h2>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($teacher->courses as $course)
                            <a href="{{ route('courses.show', $course) }}" class="px-3 py-1 bg-m3-primary-container text-m3-on-primary-container text-xs font-black rounded-m3-full hover:brightness-95 transition-all">
                                {{ $course->code }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3">
                <a href="#rate-section" class="m3-btn-filled shadow-m3-2">
                    {{ __('Calificar') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            @if (session('success'))
                <div class="m3-card p-4 bg-green-50 border-green-200 text-green-800 flex items-center gap-3 animate-in fade-in zoom-in duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- M3 Stats Dashboard -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="m3-card-elevated p-6 text-center bg-m3-primary-container/20">
                    <div class="text-4xl font-black {{ $avgQuality >= 4 ? 'text-green-600' : ($avgQuality >= 2.5 ? 'text-m3-primary' : 'text-red-600') }}">
                        {{ number_format($avgQuality ?? 0, 1) }}
                    </div>
                    <div class="text-[10px] uppercase font-black text-m3-on-surface-variant mt-2 tracking-widest">Calidad</div>
                </div>

                <div class="m3-card-elevated p-6 text-center">
                    <div class="text-3xl font-black text-m3-on-surface">
                        {{ $wouldTakeAgainPercent }}%
                    </div>
                    <div class="text-[10px] uppercase font-black text-m3-on-surface-variant mt-2 tracking-widest">Volvería</div>
                </div>

                <div class="m3-card-elevated p-6 text-center">
                    <div class="text-3xl font-black text-m3-on-surface">
                        {{ number_format($avgDifficulty ?? 0, 1) }}
                    </div>
                    <div class="text-[10px] uppercase font-black text-m3-on-surface-variant mt-2 tracking-widest">Dificultad</div>
                </div>

                <div class="m3-card-elevated p-6 text-center">
                    <div class="text-3xl font-black text-m3-on-surface">
                        {{ number_format($avgPunctuality ?? 0, 1) }}
                    </div>
                    <div class="text-[10px] uppercase font-black text-m3-on-surface-variant mt-2 tracking-widest">Puntualidad</div>
                </div>

                <div class="m3-card-elevated p-6 text-center">
                    <div class="text-3xl font-black text-m3-on-surface">
                        {{ $attendancePercent }}%
                    </div>
                    <div class="text-[10px] uppercase font-black text-m3-on-surface-variant mt-2 tracking-widest">Asistencia</div>
                </div>

                <div class="m3-card-elevated p-6 text-center">
                    <div class="text-3xl font-black text-m3-on-surface">
                        {{ number_format($avgOrganization ?? 0, 1) }}
                    </div>
                    <div class="text-[10px] uppercase font-black text-m3-on-surface-variant mt-2 tracking-widest">Org.</div>
                </div>
            </div>

            <!-- Bio -->
            @if($teacher->bio)
                <div class="m3-card p-8 bg-m3-surface-variant/20 border-none italic text-m3-on-surface-variant font-medium text-lg leading-relaxed">
                    "{{ $teacher->bio }}"
                </div>
            @endif

            <div id="rate-section" class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Review Form -->
                <div class="lg:col-span-5 sticky top-28">
                    @auth
                        @if($hasReviewed)
                            <div class="m3-card-elevated p-10 bg-m3-primary text-m3-on-primary text-center">
                                <div class="w-16 h-16 bg-m3-on-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <h3 class="text-2xl font-black mb-2">¡Gracias por tu aporte!</h3>
                                <p class="font-medium opacity-80">Ya has calificado a este profesor. Tus opiniones ayudan a que la comunidad crezca.</p>
                            </div>
                        @else
                            <div class="m3-card-elevated p-8 bg-m3-surface border-t-8 border-t-m3-primary">
                                <header class="mb-8">
                                    <h3 class="text-2xl font-black text-m3-on-surface tracking-tight">{{ __('Rate this Professor') }}</h3>
                                    <p class="text-m3-on-surface-variant font-medium">Compartí tu experiencia real y honesta.</p>
                                </header>

                                <form method="post" action="{{ route('reviews.store', $teacher) }}" class="space-y-6">
                                    @csrf

                                    <div class="space-y-4">
                                        <div>
                                            <x-input-label for="course_id" value="Materia" class="font-black text-xs uppercase tracking-widest text-m3-primary mb-1" />
                                            <select id="course_id" name="course_id" class="w-full px-4 py-3 bg-m3-surface-variant border-none rounded-m3-medium font-bold focus:ring-2 focus:ring-m3-primary transition-all" required>
                                                <option value="">Seleccioná materia</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                        {{ $course->code }} - {{ $course->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <x-input-label for="teacher_role" value="Tu rol con él" class="font-black text-xs uppercase tracking-widest text-m3-primary mb-1" />
                                            <div class="grid grid-cols-3 gap-2">
                                                @foreach(['general' => 'Gral', 'theory' => 'Teo', 'practice' => 'Prac'] as $val => $label)
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="teacher_role" value="{{ $val }}" class="peer hidden" {{ old('teacher_role', 'general') == $val ? 'checked' : '' }}>
                                                        <div class="py-2 text-center rounded-m3-medium border-2 border-m3-outline font-black text-xs uppercase peer-checked:bg-m3-primary peer-checked:border-m3-primary peer-checked:text-m3-on-primary transition-all hover:bg-m3-primary/5">
                                                            {{ $label }}
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        @foreach(['quality' => 'Calidad', 'difficulty' => 'Dificultad', 'punctuality' => 'Puntualidad', 'organization' => 'Org'] as $field => $label)
                                            <div>
                                                <x-input-label for="{{ $field }}" value="{{ $label }}" class="font-black text-[10px] uppercase tracking-widest text-m3-on-surface-variant mb-1" />
                                                <select name="{{ $field }}" class="w-full bg-m3-surface-variant border-none rounded-m3-small font-black text-sm py-2">
                                                    @for($i=5; $i>=1; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="flex items-center gap-4 py-2">
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" name="takes_attendance" value="1" class="w-5 h-5 rounded-m3-small border-m3-outline text-m3-primary focus:ring-m3-primary/20">
                                            <span class="text-sm font-bold text-m3-on-surface group-hover:text-m3-primary transition-colors">¿Toma asistencia?</span>
                                        </label>
                                        
                                        <div class="h-4 w-px bg-m3-outline"></div>

                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <input type="checkbox" name="would_take_again" value="1" checked class="w-5 h-5 rounded-m3-small border-m3-outline text-m3-primary focus:ring-m3-primary/20">
                                            <span class="text-sm font-bold text-m3-on-surface group-hover:text-m3-primary transition-colors">¿Volverías?</span>
                                        </label>
                                    </div>

                                    <div>
                                        <x-input-label for="comment" value="Tu comentario" class="font-black text-xs uppercase tracking-widest text-m3-primary mb-1" />
                                        <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-3 bg-m3-surface-variant border-none rounded-m3-medium font-medium focus:ring-2 focus:ring-m3-primary transition-all placeholder:italic" placeholder="¿Qué debería saber otro alumno?"></textarea>
                                    </div>

                                    <button type="submit" class="m3-btn-filled w-full shadow-m3-2 py-4 text-lg">
                                        Publicar Calificación
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div class="m3-card-elevated p-10 text-center bg-m3-surface-variant/30">
                            <p class="text-lg font-black text-m3-on-surface mb-6">Iniciá sesión para calificar a este profesor.</p>
                            <a href="{{ route('login') }}" class="m3-btn-tonal w-full">Ingresar</a>
                        </div>
                    @endauth
                </div>

                <!-- Reviews List -->
                <div class="lg:col-span-7 space-y-8">
                    <div class="flex items-center gap-4 mb-8">
                        <h3 class="text-3xl font-black text-m3-on-surface tracking-tight">Experiencias</h3>
                        <div class="h-px flex-grow bg-m3-outline/50"></div>
                        <span class="px-4 py-1 bg-m3-surface-variant rounded-m3-full text-xs font-black text-m3-on-surface-variant uppercase tracking-widest">
                            {{ $teacher->reviews->count() }} Reseñas
                        </span>
                    </div>

                    @forelse($teacher->reviews as $review)
                        <div class="m3-card p-8 group hover:border-m3-primary/20 transition-all duration-500 relative">
                            <!-- Floating Quality Badge -->
                            <div class="absolute -top-4 -right-4 w-12 h-12 bg-m3-primary text-m3-on-primary rounded-m3-large flex items-center justify-center font-black text-xl shadow-m3-2 transform group-hover:scale-110 transition-transform">
                                {{ $review->quality }}
                            </div>

                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-m3-secondary-container rounded-full flex items-center justify-center text-m3-on-secondary-container font-black">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-m3-on-surface">{{ $review->user->name }}</div>
                                        <div class="text-[10px] font-bold text-m3-on-surface-variant uppercase tracking-widest opacity-60">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    @if($review->course)
                                        <span class="px-2 py-0.5 bg-m3-primary-container text-[10px] font-black text-m3-on-primary-container rounded-m3-small uppercase">
                                            {{ $review->course->code }}
                                        </span>
                                    @endif
                                    <span class="text-[10px] font-black px-2 py-0.5 rounded-m3-small uppercase {{ $review->teacher_role == 'theory' ? 'bg-blue-100 text-blue-800' : ($review->teacher_role == 'practice' ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $review->teacher_role }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-lg text-m3-on-surface-variant leading-relaxed mb-8 font-medium italic border-l-4 border-m3-outline pl-6">
                                "{{ $review->comment }}"
                            </div>

                            <div class="flex flex-wrap gap-6 items-center">
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-black uppercase text-m3-on-surface-variant opacity-50">Dificultad</span>
                                    <div class="flex gap-1">
                                        @for($i=1; $i<=5; $i++)
                                            <div class="w-2 h-2 rounded-full {{ $i <= $review->difficulty ? 'bg-m3-on-surface' : 'bg-m3-outline' }}"></div>
                                        @endfor
                                    </div>
                                </div>
                                
                                <div class="flex gap-3">
                                    @if($review->would_take_again)
                                        <span class="text-[10px] font-black text-green-600 uppercase bg-green-50 px-2 py-1 rounded-m3-small">✓ Volvería</span>
                                    @else
                                        <span class="text-[10px] font-black text-red-600 uppercase bg-red-50 px-2 py-1 rounded-m3-small">✗ No volvería</span>
                                    @endif

                                    @if($review->takes_attendance)
                                        <span class="text-[10px] font-black text-m3-primary uppercase bg-m3-primary/5 px-2 py-1 rounded-m3-small">Toma Asistencia</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Helpful Votes -->
                            <div class="mt-8 pt-6 border-t border-m3-outline/30 flex items-center justify-between">
                                <span class="text-[10px] font-black text-m3-on-surface-variant uppercase tracking-widest">¿Te ayudó esta reseña?</span>
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('helpfulness.store', $review) }}">
                                        @csrf
                                        <input type="hidden" name="is_helpful" value="1">
                                        <button class="flex items-center gap-2 px-4 py-1.5 rounded-m3-full border-2 border-m3-outline hover:border-m3-primary transition-all text-xs font-black {{ $review->helpfulnessVotes()->where('user_id', auth()->id())->where('is_helpful', true)->exists() ? 'bg-m3-primary text-m3-on-primary border-m3-primary' : '' }}">
                                            <span>Útil</span>
                                            <span class="opacity-60">{{ $review->helpful_count }}</span>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('helpfulness.store', $review) }}">
                                        @csrf
                                        <input type="hidden" name="is_helpful" value="0">
                                        <button class="flex items-center gap-2 px-4 py-1.5 rounded-m3-full border-2 border-m3-outline hover:border-red-400 transition-all text-xs font-black {{ $review->helpfulnessVotes()->where('user_id', auth()->id())->where('is_helpful', false)->exists() ? 'bg-red-500 text-white border-red-500' : '' }}">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="m3-card p-12 text-center bg-m3-surface-variant/10 border-dashed">
                            <p class="font-bold text-m3-on-surface-variant italic">Aún no hay opiniones. ¡Sé el primero!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
