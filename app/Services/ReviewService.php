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
        // Ensure booleans
        $data['would_take_again'] = (bool) $data['would_take_again'];
        $data['takes_attendance'] = (bool) $data['takes_attendance'];
        
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

    /**
     * Vote on review helpfulness.
     */
    public function voteHelpfulness(Review $review, int $userId, bool $isHelpful)
    {
        $vote = \App\Models\ReviewHelpfulness::where('review_id', $review->id)
            ->where('user_id', $userId)
            ->first();

        if ($vote) {
            if ($vote->is_helpful === $isHelpful) {
                // If same vote, remove it (toggle off)
                $vote->delete();
                return null;
            }
            // Update vote
            $vote->update(['is_helpful' => $isHelpful]);
            return $vote;
        }

        return \App\Models\ReviewHelpfulness::create([
            'review_id' => $review->id,
            'user_id' => $userId,
            'is_helpful' => $isHelpful,
        ]);
    }
}
