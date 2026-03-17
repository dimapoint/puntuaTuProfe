<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
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
        
        return [
            'name' => fake()->name(),
            'department' => fake()->randomElement($departments),
            'bio' => fake()->paragraph(),
        ];
    }
}
