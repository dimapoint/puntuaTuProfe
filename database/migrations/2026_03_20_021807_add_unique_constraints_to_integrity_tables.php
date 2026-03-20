<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Evitar que un profesor se asocie más de una vez a la misma materia
        Schema::table('course_teacher', function (Blueprint $table) {
            $table->unique(['course_id', 'teacher_id']);
        });

        // 2. Evitar que un alumno califique dos veces al mismo profesor en la misma materia
        Schema::table('reviews', function (Blueprint $table) {
            // Nota: Si permitimos course_id null, MySQL permite duplicados con NULL.
            // Pero en nuestra lógica de negocio, course_id es obligatorio.
            $table->unique(['user_id', 'teacher_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'teacher_id', 'course_id']);
        });

        Schema::table('course_teacher', function (Blueprint $table) {
            $table->dropUnique(['course_id', 'teacher_id']);
        });
    }
};
