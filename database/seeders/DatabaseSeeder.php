<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        // Sample users
        $users = User::factory(10)->create();

        // Seed specific courses
        $this->call(CourseSeeder::class);
        $courses = Course::all();

        // Sample teachers and reviews
        Teacher::factory(20)->create()->each(function ($teacher) use ($users, $courses) {
            // Attach 1 to 3 random courses to each teacher
            $teacherCourses = $courses->random(rand(1, 3));
            $teacher->courses()->attach($teacherCourses->pluck('id')->toArray());

            $numReviews = rand(1, 5);
            Review::factory($numReviews)->create([
                'teacher_id' => $teacher->id,
                'user_id' => $users->random()->id,
                // Assign a course that the teacher actually teaches
                'course_id' => $teacherCourses->random()->id,
            ]);
        });
    }
}
