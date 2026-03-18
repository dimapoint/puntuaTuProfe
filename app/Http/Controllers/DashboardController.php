<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected TeacherService $teacherService
    ) {}

    public function index()
    {
        $stats = $this->teacherService->getDashboardStats();

        return view('dashboard', [
            'teacherCount' => $stats['teacher_count'],
            'courseCount' => $stats['course_count'],
            'reviewCount' => $stats['review_count'],
            'latestReviews' => $stats['latest_reviews'],
        ]);
    }
}
