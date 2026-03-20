<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Services\ReviewService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewServiceTest extends TestCase
{
    use RefreshDatabase;

    private ReviewService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ReviewService;
    }

    public function test_it_syncs_teacher_to_course_on_review_creation(): void
    {
        $teacher = Teacher::factory()->create();
        $course = Course::factory()->create();
        $user = User::factory()->create();

        $data = [
            'course_id' => $course->id,
            'quality' => 5,
            'difficulty' => 3,
            'comment' => 'Great professor!',
            'would_take_again' => true,
            'takes_attendance' => true,
            'grade' => 'A',
            'delivery_method' => 'in-person',
            'punctuality' => 5,
            'attendance' => 'mandatory',
            'role' => 'student',
            'organization' => 5,
        ];

        $this->service->createReview($teacher, $user, $data);

        $this->assertTrue($teacher->courses->contains($course));
    }
}
