<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $teacher->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Teacher Info -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $teacher->name }}</h3>
                    <p class="text-lg text-indigo-600 font-semibold">{{ $teacher->courses->pluck('name')->join(', ') }}</p>
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ $teacher->bio }}</p>
                </div>

                <div class="flex gap-8 items-center bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <div class="text-center">
                        <div class="text-5xl font-black {{ $avgQuality >= 4 ? 'text-green-600' : ($avgQuality >= 2.5 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ number_format($avgQuality ?? 0, 1) }}
                        </div>
                        <div class="text-xs uppercase tracking-wider font-bold text-gray-500 mt-1">Calidad</div>
                    </div>

                    <div class="h-12 w-px bg-gray-200"></div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">
                            {{ $wouldTakeAgainPercent }}%
                        </div>
                        <div class="text-xs uppercase tracking-wider font-bold text-gray-500 mt-1">Volvería</div>
                    </div>

                    <div class="h-12 w-px bg-gray-200"></div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">
                            {{ number_format($avgDifficulty ?? 0, 1) }}
                        </div>
                        <div class="text-xs uppercase tracking-wider font-bold text-gray-500 mt-1">Dificultad</div>
                    </div>

                    <div class="h-12 w-px bg-gray-200"></div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">
                            {{ number_format($avgPunctuality ?? 0, 1) }}
                        </div>
                        <div class="text-xs uppercase tracking-wider font-bold text-gray-500 mt-1">Puntualidad</div>
                    </div>

                    <div class="h-12 w-px bg-gray-200"></div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">
                            {{ $attendancePercent }}%
                        </div>
                        <div class="text-xs uppercase tracking-wider font-bold text-gray-500 mt-1">Asistencia</div>
                    </div>

                    <div class="h-12 w-px bg-gray-200"></div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">
                            {{ number_format($avgOrganization ?? 0, 1) }}
                        </div>
                        <div class="text-xs uppercase tracking-wider font-bold text-gray-500 mt-1">Organización</div>
                    </div>
                </div>
            </div>

            <!-- Review Form Section -->
            @auth
                @if($hasReviewed)
                    <div class="p-4 sm:p-8 bg-indigo-50 shadow sm:rounded-lg border border-indigo-100">
                        <p class="text-indigo-700 text-center font-medium">
                            <i class="fas fa-check-circle mr-2"></i> Ya has calificado a este profesor. ¡Gracias por tu aporte!
                        </p>
                    </div>
                @else
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Califica a este Profesor</h2>
                            <p class="mt-1 text-sm text-gray-600">Tu reseña ayudará a otros estudiantes a tomar mejores decisiones.</p>
                        </header>

                        <form method="post" action="{{ route('reviews.store', $teacher) }}" class="mt-6 space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="course_id" value="Materia" />
                                    <select id="course_id" name="course_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecciona una materia</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->code }} - {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('course_id')" />
                                </div>

                                <div>
                                    <x-input-label for="teacher_role" value="Tipo de Profesor" />
                                    <select id="teacher_role" name="teacher_role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="general" {{ old('teacher_role') == 'general' ? 'selected' : '' }}>General</option>
                                        <option value="theory" {{ old('teacher_role') == 'theory' ? 'selected' : '' }}>Teórico</option>
                                        <option value="practice" {{ old('teacher_role') == 'practice' ? 'selected' : '' }}>Práctico</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('teacher_role')" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="would_take_again" value="¿Volverías a cursar con este profesor?" />
                                    <select id="would_take_again" name="would_take_again" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecciona una opción</option>
                                        <option value="1" {{ old('would_take_again') == '1' ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ old('would_take_again') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('would_take_again')" />
                                </div>

                                <div class="flex items-center mt-6">
                                    <label for="takes_attendance" class="inline-flex items-center cursor-pointer">
                                        <input id="takes_attendance" type="checkbox" name="takes_attendance" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('takes_attendance') ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-700 font-medium">¿Le importa y toma asistencia?</span>
                                    </label>
                                    <x-input-error class="mt-2" :messages="$errors->get('takes_attendance')" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div>
                                    <x-input-label for="quality" value="Calidad (1-5)" />
                                    <select id="quality" name="quality" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecciona calidad</option>
                                        @foreach(range(5, 1) as $value)
                                            <option value="{{ $value }}" {{ old('quality') == $value ? 'selected' : '' }}>
                                                {{ $value }} - {{ match($value) { 5=>'Excelente', 4=>'Buena', 3=>'Promedio', 2=>'Mala', 1=>'Pésima' } }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('quality')" />
                                </div>

                                <div>
                                    <x-input-label for="difficulty" value="Dificultad (1-5)" />
                                    <select id="difficulty" name="difficulty" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecciona dificultad</option>
                                        @foreach(range(1, 5) as $value)
                                            <option value="{{ $value }}" {{ old('difficulty') == $value ? 'selected' : '' }}>
                                                {{ $value }} - {{ match($value) { 1=>'Muy fácil', 2=>'Fácil', 3=>'Promedio', 4=>'Difícil', 5=>'Muy difícil' } }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('difficulty')" />
                                </div>

                                <div>
                                    <x-input-label for="punctuality" value="Puntualidad (1-5)" />
                                    <select id="punctuality" name="punctuality" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecciona puntualidad</option>
                                        @foreach(range(5, 1) as $value)
                                            <option value="{{ $value }}" {{ old('punctuality') == $value ? 'selected' : '' }}>
                                                {{ $value }} - {{ match($value) { 5=>'Siempre puntual', 4=>'Casi siempre', 3=>'A veces tarde', 2=>'Frecuentemente tarde', 1=>'Siempre tarde' } }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('punctuality')" />
                                </div>

                                <div>
                                    <x-input-label for="organization" value="Organización (1-5)" />
                                    <select id="organization" name="organization" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="">Selecciona organización</option>
                                        @foreach(range(5, 1) as $value)
                                            <option value="{{ $value }}" {{ old('organization') == $value ? 'selected' : '' }}>
                                                {{ $value }} - {{ match($value) { 5=>'Muy organizado', 4=>'Organizado', 3=>'Promedio', 2=>'Desorganizado', 1=>'Muy desorganizado' } }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('organization')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="comment" value="Comentario" />
                                <textarea id="comment" name="comment" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" placeholder="¿Qué debería saber otro estudiante sobre este profesor? (Mínimo 10 caracteres)"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>Enviar Reseña</x-primary-button>
                            </div>
                        </form>
                    </div>
                @endif
            @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <p class="text-gray-600 text-center">Por favor, <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">inicia sesión</a> para calificar a este profesor.</p>
                </div>
            @endauth

            <!-- Reviews List -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Reseñas de Estudiantes ({{ $teacher->reviews->count() }})</h3>
                <div class="space-y-8">
                    @forelse($teacher->reviews as $review)
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div class="flex gap-4">
                                    <div class="bg-white p-3 rounded shadow-sm text-center min-w-[80px]">
                                        <div class="text-xs uppercase text-gray-500 font-bold">Calidad</div>
                                        <div class="text-2xl font-black text-indigo-600">{{ $review->quality }}</div>
                                    </div>
                                    <div class="bg-white p-3 rounded shadow-sm text-center min-w-[80px]">
                                        <div class="text-xs uppercase text-gray-500 font-bold">Dificultad</div>
                                        <div class="text-2xl font-black text-gray-700">{{ $review->difficulty }}</div>
                                    </div>
                                    <div class="bg-white p-3 rounded shadow-sm text-center min-w-[80px]">
                                        <div class="text-xs uppercase text-gray-500 font-bold">Puntualidad</div>
                                        <div class="text-2xl font-black text-gray-700">{{ $review->punctuality }}</div>
                                    </div>
                                    <div class="bg-white p-3 rounded shadow-sm text-center min-w-[80px]">
                                        <div class="text-xs uppercase text-gray-500 font-bold">Org.</div>
                                        <div class="text-2xl font-black text-gray-700">{{ $review->organization }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-bold text-gray-900">{{ $review->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                                    <div class="mt-1 flex gap-1 justify-end">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold {{ $review->teacher_role == 'theory' ? 'bg-blue-100 text-blue-800' : ($review->teacher_role == 'practice' ? 'bg-orange-100 text-orange-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ match($review->teacher_role) { 'theory' => 'TEÓRICO', 'practice' => 'PRÁCTICO', 'general' => 'GENERAL' } }}
                                        </span>
                                        @if($review->course)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-indigo-100 text-indigo-800">
                                                {{ $review->course->code }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-gray-700 italic">
                                "{{ $review->comment }}"
                            </div>
                            <div class="mt-4 flex flex-wrap gap-4 items-center">
                                @if($review->would_take_again !== null)
                                    <div class="text-sm font-semibold {{ $review->would_take_again ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $review->would_take_again ? '✓ Volvería a cursar' : '✗ No volvería a cursar' }}
                                    </div>
                                @endif
                                <div class="text-sm font-semibold {{ $review->takes_attendance ? 'text-amber-600' : 'text-gray-500' }}">
                                    <i class="fas {{ $review->takes_attendance ? 'fa-clipboard-check' : 'fa-user-slash' }} mr-1"></i>
                                    {{ $review->takes_attendance ? 'Toma asistencia' : 'No toma asistencia' }}
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs text-gray-500 uppercase tracking-wider font-bold">¿Te fue útil esta reseña?</span>
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('helpfulness.store', $review) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="is_helpful" value="1">
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium border {{ $review->helpfulnessVotes()->where('user_id', auth()->id())->where('is_helpful', true)->exists() ? 'bg-green-100 border-green-200 text-green-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }} transition-colors">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span>{{ $review->helpful_count }}</span>
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('helpfulness.store', $review) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="is_helpful" value="0">
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium border {{ $review->helpfulnessVotes()->where('user_id', auth()->id())->where('is_helpful', false)->exists() ? 'bg-red-100 border-red-200 text-red-700' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }} transition-colors">
                                            <i class="fas fa-thumbs-down"></i>
                                            <span>{{ $review->not_helpful_count }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Aún no hay reseñas. ¡Sé el primero en calificar!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
