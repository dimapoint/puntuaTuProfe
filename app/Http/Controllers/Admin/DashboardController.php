<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Course;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'teachers' => Teacher::count(),
            'reviews' => Review::count(),
            'courses' => Course::count(),
            'users' => User::count(),
        ];

        $latest_reviews = Review::with(['teacher', 'user'])->latest()->take(5)->get();
        $top_teachers = Teacher::withAvg('reviews', 'quality')
            ->orderByDesc('reviews_avg_quality')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_reviews', 'top_teachers'));
    }
}
