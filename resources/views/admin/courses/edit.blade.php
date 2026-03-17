<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}: {{ $course->code }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="code" :value="__('Course Code')" />
                        <x-text-input id="code" name="code" type="text" class="mt-1 block w-full" :value="old('code', $course->code)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('code')" />
                    </div>

                    <div>
                        <x-input-label for="name" :value="__('Course Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $course->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="department" :value="__('Department')" />
                        <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', $course->department)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('department')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                        <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
