<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_search_courses_by_name(): void
    {
        Course::factory()->create(['name' => 'Mathematics I', 'code' => 'MATH101']);
        Course::factory()->create(['name' => 'Physics I', 'code' => 'PHYS101']);

        $results = Course::search('Mathematics')->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Mathematics I', $results->first()->name);
    }

    public function test_it_can_search_courses_by_code(): void
    {
        Course::factory()->create(['name' => 'Mathematics I', 'code' => 'MATH101']);
        Course::factory()->create(['name' => 'Physics I', 'code' => 'PHYS101']);

        $results = Course::search('PHYS101')->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Physics I', $results->first()->name);
    }
}
