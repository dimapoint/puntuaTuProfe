<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\Review;
use App\Models\User;

class ReviewService
{
    /**
     * Create a new review for a teacher.
     */
    public function createReview(Teacher $teacher, User $user, array $data)
    {
        $data['user_id'] = $user->id;
        // Ensure would_take_again is boolean
        $data['would_take_again'] = (bool) $data['would_take_again'];
        
        return $teacher->reviews()->create($data);
    }

    /**
     * Check if a user has already reviewed a teacher.
     */
    public function hasUserReviewedTeacher(Teacher $teacher, ?int $userId)
    {
        if (!$userId) return false;

        return Review::where('teacher_id', $teacher->id)
            ->where('user_id', $userId)
            ->exists();
    }
}
