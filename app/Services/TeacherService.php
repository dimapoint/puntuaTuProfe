<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\Review;
use App\Models\Course;

class TeacherService
{
    /**
     * Get teachers with search and pagination.
     */
    public function getTeachers(?string $search = null, int $perPage = 12)
    {
        return Teacher::search($search)
            ->with('courses')
            ->withAvgQuality()
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Get statistics for a specific teacher.
     */
    public function getTeacherStats(Teacher $teacher)
    {
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
    }

    /**
     * Get global dashboard statistics.
     */
    public function getDashboardStats()
    {
        return [
            'teacher_count' => Teacher::count(),
            'course_count' => Course::count(),
            'review_count' => Review::count(),
            'latest_reviews' => Review::with(['teacher', 'user', 'course'])
                ->latest()
                ->take(5)
                ->get(),
        ];
    }
}
