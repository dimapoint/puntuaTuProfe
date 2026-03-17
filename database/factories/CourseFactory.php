<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = [
            'Ciencias de la Computación', 
            'Matemática', 
            'Física', 
            'Astronomía', 
            'Biología', 
            'Química', 
            'Historia', 
            'Lenguas', 
            'Ingeniería',
            'Derecho',
            'Arquitectura'
        ];
        
        $dept = fake()->randomElement($departments);
        $deptCode = strtoupper(substr($dept, 0, 2));

        return [
            'code' => $deptCode . fake()->unique()->numberBetween(100, 999),
            'name' => $dept . ' ' . fake()->unique()->word(),
            'department' => $dept,
        ];
    }
}
