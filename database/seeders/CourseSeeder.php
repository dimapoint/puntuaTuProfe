<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Materias originales (hardcoded en el seeder inicial)
        $originalCourses = [
            'Matemática y Ciencias Básicas' => [
                'Fundamentos de Matemática', 'Matemática Discreta', 'Álgebra y Geometría I',
                'Álgebra y Geometría II', 'Probabilidad y Estadística', 'Cálculo Matemático I',
                'Cálculo Matemático II', 'Métodos Numéricos', 'Física 1', 'Física 2',
            ],
            'Programación y Datos' => [
                'Programación', 'Programación Orientada a Objetos', 'Algoritmos y Estructuras de Datos',
                'Estadística Multivariada', 'Diseño de Base de Datos', 'Lenguajes Formales y Autómatas',
                'Base de Datos Aplicada', 'Desarrollo de Software', 'Desarrollo Web',
            ],
            'Ingeniería de Software' => [
                'Sistemas de Información', 'Ingeniería de Software', 'Análisis y Diseño de Sistemas',
                'Arquitectura de Software', 'Implementación de Sistemas', 'Gestión de Proyectos de Software',
                'Calidad de Software',
            ],
            'Hardware, Redes y Seguridad' => [
                'Laboratorio de Computación', 'Técnicas Digitales', 'Organización de Computadoras',
                'Redes de Datos', 'Sistemas Operativos', 'Seguridad Informática y Criptografía',
                'Servicios de Transmisión de Datos', 'Auditoría Informática',
            ],
            'Gestión, Economía y Emprendedurismo' => [
                'Investigación de Operaciones', 'Modelos y Simulación', 'Economía y Contabilidad',
                'Organización Empresarial', 'Innovación y Emprendedurismo', 'Legislación y Ejercicio Profesional',
                'Formulación y Evaluación de Proyectos de Inversión',
            ],
            'Sostenibilidad, Habilidades y Humanidades' => [
                'Introducción a la Ingeniería', 'Tecnologías de la Información', 'Trabajo en Equipo',
                'Metodología de la Investigación', 'Desarrollo Sostenible', 'Seminario de Energías Renovables',
                'Higiene y Seguridad Laboral', 'Gestión Ambiental', 'Pensamiento Crítico Filosófico',
                'Problemáticas Antropológicas Contemporáneas', 'Materias optativas de Formación Institucional',
            ],
        ];

        // 2. Cargar materias desde materias.txt
        $filePath = base_path('materias.txt');
        $fileSubjects = [];
        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $fileSubjects = collect(explode("\n", $content))
                ->map(fn ($line) => trim($line))
                ->filter(fn ($line) => ! empty($line))
                ->toArray();
        }

        // 3. Procesar materias originales
        foreach ($originalCourses as $department => $subjectList) {
            foreach ($subjectList as $name) {
                $this->createCourse($name, $department);
            }
        }

        // 4. Procesar materias del archivo (si no existen ya)
        foreach ($fileSubjects as $name) {
            // Mapeo simple de departamentos para las nuevas materias si coinciden con palabras clave
            $department = $this->guessDepartment($name);
            $this->createCourse($name, $department);
        }

        $this->command->info('Base de datos de materias completada.');
    }

    private function createCourse($name, $department)
    {
        $cleanName = $this->cleanString($name);

        // Buscamos si existe por nombre original (insensible a mayúsculas en MySQL por defecto, pero mejor asegurar)
        $course = Course::where('name', $name)->first() ?? Course::where('name', $cleanName)->first();

        if ($course) {
            $course->update([
                'name' => $cleanName,
                'code' => $this->generateCode($cleanName),
                'department' => $department,
            ]);
        } else {
            Course::create([
                'name' => $cleanName,
                'code' => $this->generateCode($cleanName),
                'department' => $department,
            ]);
        }
    }

    private function cleanString($string)
    {
        $clean = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ'],
            ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N'],
            $string
        );

        return strtoupper(trim($clean));
    }

    private function guessDepartment($name)
    {
        $nameUpper = $this->cleanString($name);
        if (Str::contains($nameUpper, ['BIO', 'GENETICA', 'QUIMICA'])) {
            return 'Ciencias Biológicas y Químicas';
        }
        if (Str::contains($nameUpper, ['ELECTRONICA', 'CIRCUITO', 'SENAL', 'HARDWARE'])) {
            return 'Electrónica y Hardware';
        }
        if (Str::contains($nameUpper, ['ESTRUCTURA', 'CONSTRUCCION', 'SUELO', 'HIDRAULICA', 'VIAL', 'CIVIL'])) {
            return 'Ingeniería Civil';
        }
        if (Str::contains($nameUpper, ['INDUSTRIAL', 'PROCESO', 'CALIDAD', 'FABRICACION'])) {
            return 'Ingeniería Industrial';
        }

        return 'Otras Ingenierías';
    }

    private function generateCode(string $name): string
    {
        $cleanName = $this->cleanString($name);

        $words = preg_split('/[\s-]+/', $cleanName);
        $code = '';

        foreach ($words as $word) {
            $word = trim($word);
            if (empty($word)) {
                continue;
            }

            // Si es un número (como en Física 1), lo mantenemos tal cual
            if (is_numeric($word)) {
                $code .= $word;
            } elseif (mb_strlen($word) > 2 || count($words) < 3) {
                // Tomamos la primera letra de cada palabra "importante" (> 2 chars)
                // O de todas si el nombre es corto
                $code .= strtoupper(mb_substr($word, 0, 1));
            }
        }

        // Si quedó vacío o muy corto por preposiciones, forzamos algo
        if (strlen($code) < 2) {
            $code = strtoupper(substr($cleanName, 0, 3));
        }

        $originalCode = $code;
        $i = 1;
        while (Course::where('code', $code)->where('name', '!=', $cleanName)->exists()) {
            $code = $originalCode.$i++;
        }

        return $code;
    }
}
