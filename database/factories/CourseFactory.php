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
        $subjects = [
            'Programación I',
            'Análisis Matemático',
            'Física General',
            'Bases de Datos',
            'Redes',
            'Sistemas Operativos',
            'Estructuras de Datos',
            'Ingeniería de Software',
            'Álgebra Lineal',
            'Sistemas Distribuidos',
            'Inteligencia Artificial'
        ];

        $subj = fake()->randomElement($subjects);
        $subjCode = strtoupper(substr($subj, 0, 3));

        return [
            'code' => $subjCode . fake()->unique()->numberBetween(100, 999),
            'name' => $subj . ' ' . fake()->unique()->numberBetween(1, 4),
            'department' => fake()->randomElement(['Matemática', 'Programación', 'Ingeniería', 'Hardware', 'Gestión']),
        ];
    }
}
