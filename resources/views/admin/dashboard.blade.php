<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Profesores -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Teachers') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ $stats['teachers'] }}</div>
                        <a href="{{ route('admin.teachers.index') }}" class="mt-2 text-xs text-indigo-600 hover:text-indigo-900 font-bold inline-flex items-center gap-1">
                            {{ __('Manage') }} <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Reseñas -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-green-50 rounded-lg text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Student Reviews') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ $stats['reviews'] }}</div>
                        <div class="mt-2 text-xs text-gray-400 font-medium italic">{{ __('Rating') }}</div>
                    </div>
                </div>

                <!-- Materias -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-yellow-50 rounded-lg text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.082.477 4 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4 1.253"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Manage Courses') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ $stats['courses'] }}</div>
                        <a href="{{ route('admin.courses.index') }}" class="mt-2 text-xs text-indigo-600 hover:text-indigo-900 font-bold inline-flex items-center gap-1">
                            {{ __('Manage') }} <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Usuarios -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-red-50 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Total Users') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ $stats['users'] }}</div>
                        <div class="mt-2 text-xs text-gray-400 font-medium italic">{{ __('Register') }}</div>
                    </div>
                </div>
            </div>

            <!-- Second Row of Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Google Users -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-2.21 5.39-7.84 5.39-4.84 0-8.79-4.01-8.79-8.94s3.95-8.94 8.79-8.94c2.75 0 4.59 1.17 5.65 2.18l2.58-2.48C19.06 1.45 15.93 0 12.48 0 5.86 0 .5 5.37.5 12s5.36 12 11.98 12c6.91 0 11.51-4.86 11.51-11.72 0-.78-.08-1.38-.18-1.97H12.48z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Google Users') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ $stats['google_users'] }}</div>
                        <div class="mt-2 text-xs text-blue-400 font-medium italic">OAuth Enabled</div>
                    </div>
                </div>

                <!-- Helpful Votes -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-indigo-50 rounded-lg text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.757c1.246 0 2.254 1.008 2.254 2.254 0 .456-.14.88-.38 1.233l-3.342 4.96c-.235.35-.615.553-1.018.553h-3.271v2a2 2 0 01-2 2h-1a2 2 0 01-2-2v-9a2 2 0 012-2h3zM7 10V9a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2h1a2 2 0 002-2v-7"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Helpful Votes') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ $stats['helpfulness_votes'] }}</div>
                        <div class="mt-2 text-xs text-indigo-400 font-medium italic">Review Engagement</div>
                    </div>
                </div>

                <!-- Avg Punctuality -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Punctuality') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ number_format($stats['avg_punctuality'], 1) }}</div>
                        <div class="mt-2 text-xs text-orange-400 font-medium italic">Global Avg.</div>
                    </div>
                </div>

                <!-- Avg Organization -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-purple-50 rounded-lg text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Organization') }}</div>
                        <div class="text-3xl font-black text-gray-900">{{ number_format($stats['avg_organization'], 1) }}</div>
                        <div class="mt-2 text-xs text-purple-400 font-medium italic">Global Avg.</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Reviews -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-black text-gray-900 uppercase tracking-tight">{{ __('Latest Reviews') }}</h3>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600">{{ __('Search') }}</span>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($latest_reviews as $review)
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-black text-sm">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-gray-900">{{ $review->teacher->name }}</div>
                                        <div class="text-xs text-gray-500 font-medium">{{ __('por') }} Alumno Anónimo</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="inline-flex items-center px-2 py-1 rounded-md bg-indigo-50 text-xs font-black text-indigo-700 border border-indigo-100 mb-1">
                                        {{ $review->quality ?? '-' }}@if($review->quality) / 5 @endif
                                    </div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Rated Teachers -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-black text-gray-900 uppercase tracking-tight">{{ __('Top Rated Teachers') }}</h3>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">Top 10</span>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($top_teachers as $teacher)
                            <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-gray-900">{{ $teacher->name }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-black {{ $teacher->reviews_avg_quality >= 4 ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ number_format($teacher->reviews_avg_quality, 1) }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase">{{ __('Rating') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
