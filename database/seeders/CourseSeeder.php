<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Matemática y Ciencias Básicas' => [
                'Fundamentos de Matemática',
                'Matemática Discreta',
                'Álgebra y Geometría I',
                'Álgebra y Geometría II',
                'Probabilidad y Estadística',
                'Cálculo Matemático I',
                'Cálculo Matemático II',
                'Métodos Numéricos',
            ],
            'Programación y Datos' => [
                'Programación',
                'Programación Orientada a Objetos',
                'Algoritmos y Estructuras de Datos',
                'Estadística Multivariada',
                'Diseño de Base de Datos',
                'Lenguajes Formales y Autómatas',
                'Base de Datos Aplicada',
                'Desarrollo de Software',
                'Desarrollo Web',
            ],
            'Ingeniería de Software' => [
                'Sistemas de Información',
                'Ingeniería de Software',
                'Análisis y Diseño de Sistemas',
                'Arquitectura de Software',
                'Implementación de Sistemas',
                'Gestión de Proyectos de Software',
                'Calidad de Software',
            ],
            'Hardware, Redes y Seguridad' => [
                'Laboratorio de Computación',
                'Técnicas Digitales',
                'Organización de Computadoras',
                'Redes de Datos',
                'Sistemas Operativos',
                'Seguridad Informática y Criptografía',
                'Servicios de Transmisión de Datos',
                'Auditoría Informática',
            ],
            'Gestión, Economía y Emprendedurismo' => [
                'Investigación de Operaciones',
                'Modelos y Simulación',
                'Economía y Contabilidad',
                'Organización Empresarial',
                'Innovación y Emprendedurismo',
                'Legislación y Ejercicio Profesional',
                'Formulación y Evaluación de Proyectos de Inversión',
            ],
            'Sostenibilidad, Habilidades y Humanidades' => [
                'Introducción a la Ingeniería',
                'Tecnologías de la Información',
                'Trabajo en Equipo',
                'Metodología de la Investigación',
                'Desarrollo Sostenible',
                'Seminario de Energías Renovables',
                'Higiene y Seguridad Laboral',
                'Gestión Ambiental',
                'Pensamiento Crítico Filosófico',
                'Problemáticas Antropológicas Contemporáneas',
                'Materias optativas de Formación Institucional',
            ],
        ];

        foreach ($courses as $department => $subjectList) {
            foreach ($subjectList as $name) {
                Course::updateOrCreate(
                    ['name' => $name],
                    [
                        'code' => $this->generateCode($name),
                        'department' => $department,
                    ]
                );
            }
        }
    }

    private function generateCode(string $name): string
    {
        // Simple code generator from name initials
        $words = explode(' ', $name);
        $code = '';
        foreach ($words as $word) {
            if (mb_strlen($word) > 2) {
                $code .= strtoupper(mb_substr($word, 0, 1));
            }
        }
        
        // Add a hash if the code is too short or to ensure uniqueness
        if (strlen($code) < 3) {
            $code = strtoupper(substr(md5($name), 0, 4));
        }

        // Check uniqueness and append if needed
        $originalCode = $code;
        $i = 1;
        while (Course::where('code', $code)->exists()) {
            $code = $originalCode . $i++;
        }

        return $code;
    }
}
