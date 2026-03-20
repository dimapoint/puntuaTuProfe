<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StatisticsService;

class DashboardController extends Controller
{
    public function __construct(
        protected StatisticsService $statisticsService
    ) {}

    public function index()
    {
        $statsData = $this->statisticsService->getAdminDashboardStats();

        return view('admin.dashboard', [
            'stats' => $statsData,
            'latest_reviews' => $statsData['latest_reviews'],
            'top_teachers' => $statsData['top_teachers'],
        ]);
    }
}
