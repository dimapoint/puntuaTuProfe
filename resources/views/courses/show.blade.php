<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $course->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-1 uppercase tracking-wider font-bold">
                    Código: {{ $course->code }}
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Califica a tu profesor') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    Profesores que dictan esta materia
                </h3>

                @if($course->teachers->isEmpty())
                    <div class="p-8 bg-white shadow sm:rounded-lg text-center border border-dashed border-gray-300">
                        <div class="mb-4 text-gray-400">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <p class="text-xl text-gray-600 mb-6">No hay profesores registrados para esta materia.</p>
                        <p class="text-gray-500 mb-8">¡Ayúdanos a crecer calificando a los profesores con los que cursaste esta asignatura!</p>
                        <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-bold text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-lg">
                            ¡Calificar profesor ahora!
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($course->teachers as $teacher)
                            <x-teacher-card :teacher="$teacher" />
                        @endforeach
                    </div>
                @endif
            </div>

            @if($course->reviews->isNotEmpty())
                <div class="mt-12">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        Reseñas recientes en esta materia
                    </h3>
                    <div class="space-y-4">
                        @foreach($course->reviews()->with('user', 'teacher')->latest()->take(5)->get() as $review)
                            <div class="bg-white p-6 shadow sm:rounded-lg border border-gray-100">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-gray-900">{{ $review->user->name }}</span>
                                            <span class="text-xs text-gray-400 font-medium">• {{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-indigo-600 font-semibold mt-1">
                                            Profesor: <a href="{{ route('teachers.show', $review->teacher) }}" class="hover:underline">{{ $review->teacher->name }}</a>
                                        </p>
                                    </div>
                                    <div class="bg-indigo-50 px-3 py-1 rounded-full text-indigo-700 font-bold text-sm">
                                        {{ $review->quality }}/5
                                    </div>
                                </div>
                                <div class="mt-3 text-gray-600 italic">
                                    "{{ $review->comment }}"
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>