<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;

class DashboardController extends Controller
{
    public function __construct(
        protected StatisticsService $statisticsService
    ) {}

    public function index()
    {
        $stats = $this->statisticsService->getDashboardStats();

        return view('dashboard', [
            'teacherCount' => $stats['teacher_count'],
            'courseCount' => $stats['course_count'],
            'reviewCount' => $stats['review_count'],
            'latestReviews' => $stats['latest_reviews'],
        ]);
    }
}
