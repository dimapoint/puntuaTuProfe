<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewHelpfulnessController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function store(Request $request, Review $review): RedirectResponse
    {
        $request->validate([
            'is_helpful' => 'required|boolean',
        ]);

        $this->reviewService->voteHelpfulness(
            $review,
            $request->user()->id,
            (bool) $request->is_helpful
        );

        return redirect()->back();
    }
}
