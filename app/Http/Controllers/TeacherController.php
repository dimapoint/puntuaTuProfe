<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use App\Services\TeacherService;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct(
        protected TeacherService $teacherService,
        protected ReviewService $reviewService
    ) {}

    public function index(Request $request)
    {
        $teachers = $this->teacherService->getTeachers($request->search);

        return view('teachers.index', compact('teachers'));
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['reviews.user', 'reviews.course']);
        $stats = $this->teacherService->getTeacherStats($teacher);
        $courses = Course::orderBy('code')->get();
        $hasReviewed = $this->reviewService->hasUserReviewedTeacher($teacher, auth()->id());
        
        return view('teachers.show', array_merge([
            'teacher' => $teacher,
            'courses' => $courses,
            'hasReviewed' => $hasReviewed,
        ], $stats));
    }
}
