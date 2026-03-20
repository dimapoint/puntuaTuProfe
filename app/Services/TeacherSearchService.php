<?php

namespace App\Services;

use App\Models\Teacher;

class TeacherSearchService
{
    /**
     * Get teachers with search and pagination.
     */
    public function getTeachers(?string $search = null, int $perPage = 24)
    {
        return Teacher::search($search)
            ->with('courses')
            ->withAvgQuality()
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();
    }
}
