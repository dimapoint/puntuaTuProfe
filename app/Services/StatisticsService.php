<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Review;
use App\Models\ReviewHelpfulness;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class StatisticsService
{
    /**
     * Get statistics for a specific teacher with caching.
     */
    public function getTeacherStats(Teacher $teacher): array
    {
        return Cache::remember("teacher_stats_{$teacher->id}", now()->addDay(), function () use ($teacher) {
            $avgQuality = $teacher->reviews()->avg('quality') ?? 0;
            $avgDifficulty = $teacher->reviews()->avg('difficulty') ?? 0;
            $avgPunctuality = $teacher->reviews()->avg('punctuality') ?? 0;
            $avgOrganization = $teacher->reviews()->avg('organization') ?? 0;
            $totalReviews = $teacher->reviews()->count();

            $wouldTakeAgainCount = $teacher->reviews()->where('would_take_again', true)->count();
            $wouldTakeAgainPercent = $totalReviews > 0 ? round(($wouldTakeAgainCount / $totalReviews) * 100) : 0;

            $takesAttendanceCount = $teacher->reviews()->where('takes_attendance', true)->count();
            $attendancePercent = $totalReviews > 0 ? round(($takesAttendanceCount / $totalReviews) * 100) : 0;

            return [
                'avgQuality' => round($avgQuality, 1),
                'avgDifficulty' => round($avgDifficulty, 1),
                'avgPunctuality' => round($avgPunctuality, 1),
                'avgOrganization' => round($avgOrganization, 1),
                'totalReviews' => $totalReviews,
                'wouldTakeAgainPercent' => $wouldTakeAgainPercent,
                'attendancePercent' => $attendancePercent,
            ];
        });
    }

    /**
     * Get global dashboard statistics.
     */
    public function getDashboardStats(): array
    {
        return [
            'teacher_count' => Teacher::count(),
            'course_count' => Course::count(),
            'review_count' => Review::count(),
            'user_count' => User::count(),
            'latest_reviews' => Review::with(['teacher', 'user', 'course'])
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    /**
     * Get full admin dashboard statistics.
     */
    public function getAdminDashboardStats(): array
    {
        return [
            'teachers' => Teacher::count(),
            'reviews' => Review::count(),
            'courses' => Course::count(),
            'users' => User::count(),
            'google_users' => User::whereNotNull('google_id')->count(),
            'helpfulness_votes' => ReviewHelpfulness::count(),
            'avg_punctuality' => Review::avg('punctuality') ?? 0,
            'avg_organization' => Review::avg('organization') ?? 0,
            'latest_reviews' => Review::with(['teacher', 'user'])->latest()->take(10)->get(),
            'top_teachers' => Teacher::withAvg('reviews', 'quality')
                ->orderByDesc('reviews_avg_quality')
                ->take(10)
                ->get(),
        ];
    }
}
