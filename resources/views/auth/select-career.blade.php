<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-black text-m3-on-surface tracking-tight">Casi listo...</h2>
        <p class="text-m3-on-surface-variant font-medium mt-2">Necesitamos saber qué carrera estás cursando.</p>
    </div>

    <form method="POST" action="{{ route('careers.store') }}" class="space-y-6">
        @csrf

        <!-- Existing Career -->
        <div>
            <x-input-label for="career_id" value="Seleccioná tu carrera" class="font-black text-xs uppercase tracking-widest text-m3-primary mb-1" />
            <select id="career_id" name="career_id" class="w-full px-4 py-3 bg-m3-surface-variant border-none rounded-m3-medium font-bold focus:ring-2 focus:ring-m3-primary transition-all">
                <option value="">-- Seleccionar --</option>
                @foreach($careers as $career)
                    <option value="{{ $career->id }}" {{ old('career_id') == $career->id ? 'selected' : '' }}>
                        {{ $career->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('career_id')" class="mt-2" />
        </div>

        <div class="relative flex items-center py-2">
            <div class="flex-grow border-t border-m3-outline/30"></div>
            <span class="flex-shrink mx-4 text-xs font-black text-m3-outline uppercase tracking-widest">O agregá una nueva</span>
            <div class="flex-grow border-t border-m3-outline/30"></div>
        </div>

        <!-- New Career -->
        <div>
            <x-input-label for="new_career" value="Nombre de la carrera" class="font-black text-xs uppercase tracking-widest text-m3-primary mb-1" />
            <x-text-input id="new_career" class="block mt-1 w-full" type="text" name="new_career" :value="old('new_career')" placeholder="Ej: Ingeniería en Sistemas" />
            <x-input-error :messages="$errors->get('new_career')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center py-4">
                {{ __('Guardar y Continuar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
