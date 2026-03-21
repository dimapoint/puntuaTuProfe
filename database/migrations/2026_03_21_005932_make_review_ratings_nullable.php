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
        Schema::table('reviews', function (Blueprint $table) {
            $table->tinyInteger('quality')->nullable()->change();
            $table->tinyInteger('difficulty')->nullable()->change();
            $table->tinyInteger('punctuality')->nullable()->default(null)->change();
            $table->tinyInteger('organization')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->tinyInteger('quality')->nullable(false)->change();
            $table->tinyInteger('difficulty')->nullable(false)->change();
            $table->tinyInteger('punctuality')->nullable(false)->default(5)->change();
            $table->tinyInteger('organization')->nullable(false)->default(3)->change();
        });
    }
};
