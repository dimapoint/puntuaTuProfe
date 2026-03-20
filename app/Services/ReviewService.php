<?php

namespace App\Services;

use App\Events\ReviewCreated;
use App\Models\Review;
use App\Models\ReviewHelpfulness;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;

class ReviewService
{
    /**
     * Create a new review for a teacher.
     */
    public function createReview(Teacher $teacher, User $user, array $data): Review
    {
        $data['user_id'] = $user->id;
        $data['would_take_again'] = (bool) ($data['would_take_again'] ?? false);
        $data['takes_attendance'] = (bool) ($data['takes_attendance'] ?? false);

        $review = $teacher->reviews()->create($data);

        // Notify that a review was created (side effects handled by listeners)
        ReviewCreated::dispatch($review);

        return $review;
    }

    /**
     * Check if a user has already reviewed a teacher for a specific course.
     */
    public function hasUserReviewedTeacherForCourse(Teacher $teacher, ?int $userId, int $courseId): bool
    {
        if (! $userId) {
            return false;
        }

        return Review::where('teacher_id', $teacher->id)
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();
    }

    /**
     * Vote on review helpfulness.
     */
    public function voteHelpfulness(Review $review, int $userId, bool $isHelpful): ?ReviewHelpfulness
    {
        try {
            $vote = ReviewHelpfulness::where('review_id', $review->id)
                ->where('user_id', $userId)
                ->first();

            if ($vote) {
                if ($vote->is_helpful === $isHelpful) {
                    $vote->delete();

                    return null;
                }

                $vote->update(['is_helpful' => $isHelpful]);

                return $vote;
            }

            return ReviewHelpfulness::create([
                'review_id' => $review->id,
                'user_id' => $userId,
                'is_helpful' => $isHelpful,
            ]);
        } catch (UniqueConstraintViolationException $e) {
            return ReviewHelpfulness::where('review_id', $review->id)
                ->where('user_id', $userId)
                ->first();
        }
    }
}
