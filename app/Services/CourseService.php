<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

class CourseService
{
    /**
     * Get a course with its associated teachers.
     */
    public function getCourseWithTeachers(Course $course): Course
    {
        return $course->load(['teachers' => function ($query) {
            $query->withAvgQuality();
        }]);
    }

    /**
     * Search for courses by a term.
     *
     * @return Collection<int, Course>
     */
    public function searchCourses(string $term): Collection
    {
        return Course::search($term)->get();
    }
}
