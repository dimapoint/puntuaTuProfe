<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Services\ReviewService;
use App\Services\StatisticsService;
use App\Services\TeacherSearchService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct(
        protected TeacherSearchService $teacherSearchService,
        protected ReviewService $reviewService,
        protected StatisticsService $statisticsService
    ) {}

    public function index(Request $request)
    {
        $search = $request->search;
        $teachers = $this->teacherSearchService->getTeachers($search);

        $courses = [];
        if ($search) {
            $courses = Course::search($search)->take(5)->get();
        }

        return view('teachers.index', compact('teachers', 'courses', 'search'));
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['reviews.user', 'reviews.course']);
        $stats = $this->statisticsService->getTeacherStats($teacher);
        $courses = Course::orderBy('name')->get();

        return view('teachers.show', array_merge([
            'teacher' => $teacher,
            'courses' => $courses,
            'hasReviewed' => false, // No longer a single boolean per teacher
        ], $stats));
    }

    public function create()
    {
        $courses = Course::orderBy('name')->get();

        return view('teachers.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teachers,name',
            'course_id' => 'required|exists:courses,id',
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
        ]);

        $teacher->courses()->attach($request->course_id);

        return redirect()->route('teachers.show', $teacher)->with('success', __('Profesor creado con éxito. ¡Ya podés dejar tu reseña!'));
    }
}
