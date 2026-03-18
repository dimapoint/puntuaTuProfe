@props(['teacher'])

<a href="{{ route('teachers.show', $teacher) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 transition duration-150 ease-in-out">
    <div class="flex justify-between items-start">
        <div>
            <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900">{{ $teacher->name }}</h5>
            <p class="font-normal text-sm text-gray-600">{{ $teacher->courses->pluck('name')->join(', ') }}</p>
        </div>
        <div class="flex items-center bg-indigo-50 px-2 py-1 rounded text-indigo-700 font-bold">
            {{ number_format($teacher->reviews_avg_quality ?? $teacher->reviews()->avg('quality') ?? 0, 1) }}
            <svg class="w-4 h-4 ml-1 text-yellow-400 fill-current" viewBox="0 0 20 20">
                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
            </svg>
        </div>
    </div>
    <div class="mt-4 flex items-center text-xs text-gray-500">
        <span>{{ $teacher->reviews()->count() }} {{ __('Reviews') }}</span>
    </div>
</a>
