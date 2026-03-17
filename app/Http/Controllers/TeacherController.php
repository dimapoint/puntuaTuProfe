<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query()->withAvg('reviews', 'quality');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $teachers = $query->orderBy('name')->paginate(12)->withQueryString();

        return view('teachers.index', compact('teachers'));
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['reviews.user', 'reviews.course']);
        
        $avgQuality = $teacher->reviews()->avg('quality');
        $avgDifficulty = $teacher->reviews()->avg('difficulty');
        
        $totalReviews = $teacher->reviews()->count();
        $wouldTakeAgainCount = $teacher->reviews()->where('would_take_again', true)->count();
        $wouldTakeAgainPercent = $totalReviews > 0 ? round(($wouldTakeAgainCount / $totalReviews) * 100) : 0;

        $courses = Course::orderBy('code')->get();
        
        $hasReviewed = auth()->check() 
            ? $teacher->reviews()->where('user_id', auth()->id())->exists() 
            : false;
        
        return view('teachers.show', compact('teacher', 'avgQuality', 'avgDifficulty', 'wouldTakeAgainPercent', 'courses', 'hasReviewed'));
    }
}
