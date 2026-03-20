<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    /**
     * Display the specified course.
     */
    public function show(Course $course): View
    {
        $course = $this->courseService->getCourseWithTeachers($course);

        return view('courses.show', compact('course'));
    }
}
