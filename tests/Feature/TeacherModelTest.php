<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_search_teachers_by_name(): void
    {
        Teacher::factory()->create(['name' => 'John Doe']);
        Teacher::factory()->create(['name' => 'Jane Smith']);

        $results = Teacher::search('John')->get();

        $this->assertCount(1, $results);
        $this->assertEquals('John Doe', $results->first()->name);
    }

    public function test_it_can_search_teachers_by_course_name(): void
    {
        $course = Course::factory()->create(['name' => 'Advanced Math']);
        $teacher = Teacher::factory()->create(['name' => 'John Doe']);
        $teacher->courses()->attach($course);

        Teacher::factory()->create(['name' => 'Jane Smith']);

        $results = Teacher::search('Math')->get();

        $this->assertCount(1, $results);
        $this->assertEquals('John Doe', $results->first()->name);
    }

    public function test_it_can_search_teachers_by_course_code(): void
    {
        $course = Course::factory()->create(['code' => 'MATH101']);
        $teacher = Teacher::factory()->create(['name' => 'John Doe']);
        $teacher->courses()->attach($course);

        $results = Teacher::search('MATH101')->get();

        $this->assertCount(1, $results);
        $this->assertEquals('John Doe', $results->first()->name);
    }
}
