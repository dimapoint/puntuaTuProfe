<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teachers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('teachers.index') }}" method="GET" class="flex gap-2">
                    <x-text-input
                        name="search"
                        placeholder="{{ __('Search by name or course...') }}"
                        class="w-full"
                        value="{{ request('search') }}"
                    />
                    <x-primary-button>{{ __('Search') }}</x-primary-button>
                    @if(request('search'))
                        <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Clear') }}
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($teachers->isEmpty())
                        <p class="text-center text-gray-500 py-8">{{ __('No teachers found matching your search.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($teachers as $teacher)
                                <x-teacher-card :teacher="$teacher" />
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $teachers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
