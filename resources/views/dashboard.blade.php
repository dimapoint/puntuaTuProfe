<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Estadísticas rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ __('Total Teachers') }}</div>
                    <div class="text-3xl font-bold mt-1">{{ $teacherCount }}</div>
                    <div class="mt-4">
                        <a href="{{ route('teachers.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-semibold">
                            {{ __('View all teachers') }} &rarr;
                        </a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ __('Total Courses') }}</div>
                    <div class="text-3xl font-bold mt-1">{{ $courseCount }}</div>
                    <div class="mt-4">
                        <span class="text-gray-400 text-sm">{{ __('Ready to rate') }}</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ __('Total Reviews') }}</div>
                    <div class="text-3xl font-bold mt-1">{{ $reviewCount }}</div>
                    <div class="mt-4 text-sm text-gray-500 italic">
                        {{ __('Community growing!') }}
                    </div>
                </div>
            </div>

            <!-- Últimas reseñas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">{{ __('Latest Reviews') }}</h3>
                    
                    @if($latestReviews->isEmpty())
                        <p class="text-gray-500 py-4">{{ __('No reviews yet. Be the first to rate!') }}</p>
                    @else
                        <div class="space-y-4">
                            @foreach($latestReviews as $review)
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                    <div>
                                        <div class="font-medium text-indigo-700">
                                            <a href="{{ route('teachers.show', $review->teacher) }}" class="hover:underline">
                                                {{ $review->teacher->name }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $review->course->name }} • {{ __('por') }} Alumno Anónimo
                                        </div>
                                        <div class="mt-1 text-gray-500 text-sm line-clamp-1">
                                            "{{ $review->comment }}"
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:mt-0 flex items-center bg-indigo-50 px-3 py-1 rounded-full">
                                        <span class="text-indigo-700 font-bold text-lg">{{ $review->quality ?? '-' }}</span>
                                        @if($review->quality)
                                            <span class="text-indigo-300 mx-1">/</span>
                                            <span class="text-indigo-400 text-sm">5</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-lg">
                    {{ __('Find a Professor to Rate') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
