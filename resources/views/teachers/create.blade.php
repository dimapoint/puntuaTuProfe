<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Nuevo Profesor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <header class="mb-8">
                        <h3 class="text-2xl font-black text-gray-900">¿No encontraste a tu profesor?</h3>
                        <p class="mt-2 text-gray-600 font-medium">Agregalo vos mismo para que otros estudiantes puedan conocer tu experiencia.</p>
                    </header>

                    <form method="POST" action="{{ route('teachers.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Nombre Completo del Profesor" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus placeholder="Ej: Juan Perez" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Course -->
                        <div>
                            <x-input-label for="course_id" value="Materia en la que dicta" />
                            <select id="course_id" name="course_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="">Seleccioná una materia</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->code }} - {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('course_id')" />
                            <p class="mt-2 text-sm text-gray-500 italic">Podrás agregar más materias después desde su perfil.</p>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4">
                            <a href="{{ route('teachers.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-bold uppercase tracking-widest">Cancelar</a>
                            <x-primary-button>
                                {{ __('Crear Profesor') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-8 p-6 bg-indigo-50 rounded-2xl border border-indigo-100 flex items-start gap-4">
                <div class="p-2 bg-indigo-600 text-white rounded-lg shadow-lg shadow-indigo-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="font-black text-indigo-900 uppercase tracking-tight text-sm">Próximo paso</h4>
                    <p class="text-indigo-700 text-sm mt-1 font-medium leading-relaxed">
                        Una vez que crees al profesor, serás redirigido a su perfil donde podrás dejar tu primera reseña y especificar si es de teoría, práctico o general.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
