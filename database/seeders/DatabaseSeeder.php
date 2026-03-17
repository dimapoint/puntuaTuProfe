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
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Sample users
        $users = User::factory(10)->create();

        // Sample courses
        $courses = Course::factory(10)->create();

        // Sample teachers and reviews
        Teacher::factory(20)->create()->each(function ($teacher) use ($users, $courses) {
            $numReviews = rand(1, 5);
            Review::factory($numReviews)->create([
                'teacher_id' => $teacher->id,
                'user_id' => $users->random()->id,
                'course_id' => $courses->random()->id,
            ]);
        });
    }
}
