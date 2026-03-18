<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Http\Requests\Admin\StoreTeacherRequest;
use App\Http\Requests\Admin\UpdateTeacherRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::with('courses')->orderBy('name')->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('admin.teachers.create');
    }

    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        $teacher = Teacher::create($request->safe()->except('courses'));

        if ($request->has('courses')) {
            $teacher->courses()->sync($request->courses);
        }

        return redirect()->route('admin.teachers.index')->with('success', __('Teacher created successfully.'));
    }

    public function edit(Teacher $teacher): View
    {
        $teacher->load('courses');
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $teacher->update($request->safe()->except('courses'));

        if ($request->has('courses')) {
            $teacher->courses()->sync($request->courses);
        } else {
            $teacher->courses()->detach();
        }

        return redirect()->route('admin.teachers.index')->with('success', __('Teacher updated successfully.'));
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', __('Teacher deleted successfully.'));
    }
}
