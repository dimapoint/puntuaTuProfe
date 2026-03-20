<?php

namespace App\Listeners;

use App\Events\ReviewCreated;
use Illuminate\Support\Facades\Cache;

class InvalidateTeacherStatsCache
{
    /**
     * Handle the event.
     */
    public function handle(ReviewCreated $event): void
    {
        Cache::forget("teacher_stats_{$event->review->teacher_id}");
    }
}
