<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Services\ReviewService;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function store(StoreReviewRequest $request, Teacher $teacher): RedirectResponse
    {
        if ($this->reviewService->hasUserReviewedTeacher($teacher, $request->user()->id)) {
            return redirect()->back()->with('error', __('You have already left a review for this teacher.'));
        }

        $this->reviewService->createReview($teacher, $request->user(), $request->validated());

        return redirect()->route('teachers.show', $teacher)->with('success', __('Review added successfully!'));
    }
}
