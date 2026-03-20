<?php

namespace App\Listeners;

use App\Events\ReviewCreated;

class LinkTeacherToCourse
{
    /**
     * Handle the event.
     */
    public function handle(ReviewCreated $event): void
    {
        $review = $event->review;

        if ($review->course_id) {
            $review->teacher->courses()->syncWithoutDetaching([$review->course_id]);
        }
    }
}
