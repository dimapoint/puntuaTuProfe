<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Teacher;
use App\Services\CourseService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseServiceTest extends TestCase
{
    use RefreshDatabase;

    private CourseService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CourseService;
    }

    public function test_it_can_get_course_with_teachers(): void
    {
        $course = Course::factory()->create();
        $teacher = Teacher::factory()->create();
        $course->teachers()->attach($teacher);

        $result = $this->service->getCourseWithTeachers($course);

        $this->assertTrue($result->relationLoaded('teachers'));
        $this->assertCount(1, $result->teachers);
    }

    public function test_it_can_search_courses(): void
    {
        Course::factory()->create(['name' => 'Calculus I']);
        Course::factory()->create(['name' => 'Calculus II']);
        Course::factory()->create(['name' => 'Physics I']);

        $results = $this->service->searchCourses('Calculus');

        $this->assertCount(2, $results);
    }
}
