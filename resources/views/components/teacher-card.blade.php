@props(['teacher'])

<a href="{{ route('teachers.show', $teacher) }}" class="m3-card p-6 flex flex-col justify-between h-full hover:border-m3-primary/30 group">
    <div class="flex justify-between items-start mb-4">
        <div class="flex-1">
            <h5 class="text-xl font-black text-m3-on-surface tracking-tight group-hover:text-m3-primary transition-colors">
                {{ $teacher->name }}
            </h5>
            <div class="flex flex-wrap gap-1 mt-2">
                @foreach($teacher->courses->take(2) as $course)
                    <span class="px-2 py-0.5 bg-m3-secondary-container/50 text-[10px] font-black text-m3-on-secondary-container rounded-m3-small uppercase tracking-wider">
                        {{ $course->code }}
                    </span>
                @endforeach
                @if($teacher->courses->count() > 2)
                    <span class="px-2 py-0.5 bg-m3-surface-variant text-[10px] font-black text-m3-on-surface-variant rounded-m3-small uppercase tracking-wider">
                        +{{ $teacher->courses->count() - 2 }}
                    </span>
                @endif
            </div>
        </div>
        
        <div class="flex items-center gap-1.5 bg-m3-tertiary-container/30 px-3 py-1.5 rounded-m3-large text-m3-tertiary shadow-m3-1">
            <span class="text-lg font-black">{{ number_format($teacher->reviews_avg_quality ?? $teacher->reviews()->avg('quality') ?? 0, 1) }}</span>
            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
            </svg>
        </div>
    </div>

    <div class="mt-auto pt-4 border-t border-m3-outline/50 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="flex -space-x-2">
                @for($i = 0; $i < min(3, $teacher->reviews()->count()); $i++)
                    <div class="w-6 h-6 rounded-full border-2 border-m3-surface bg-m3-primary/10 flex items-center justify-center text-[8px] font-black text-m3-primary">
                        U
                    </div>
                @endfor
            </div>
            <span class="text-xs font-bold text-m3-on-surface-variant italic">
                {{ $teacher->reviews()->count() }} {{ __('Reviews') }}
            </span>
        </div>
        
        <div class="w-8 h-8 rounded-m3-full bg-m3-primary/5 flex items-center justify-center text-m3-primary group-hover:bg-m3-primary group-hover:text-m3-on-primary transition-all shadow-m3-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </div>
</a>
