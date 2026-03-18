<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Teacher') }}: {{ $teacher->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $teacher->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="bio" :value="__('Bio')" />
                        <textarea id="bio" name="bio" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="4">{{ old('bio', $teacher->bio) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                    </div>

                    <div>
                        <x-input-label for="courses" :value="__('Courses')" />
                        <select id="courses" name="courses[]" multiple class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full h-32">
                            @foreach(\App\Models\Course::orderBy('name')->get() as $course)
                                <option value="{{ $course->id }}" {{ in_array($course->id, old('courses', $teacher->courses->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $course->code }} - {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Hold Ctrl (Windows) or Command (Mac) to select multiple courses.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('courses')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                        <a href="{{ route('admin.teachers.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
