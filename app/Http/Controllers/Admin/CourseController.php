<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::orderBy('name')->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.courses.create');
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        Course::create($request->validated());
        return redirect()->route('admin.courses.index')->with('success', __('Course created successfully.'));
    }

    public function edit(Course $course): View
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());
        return redirect()->route('admin.courses.index')->with('success', __('Course updated successfully.'));
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', __('Course deleted successfully.'));
    }
}
