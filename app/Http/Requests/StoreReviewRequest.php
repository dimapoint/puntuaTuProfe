<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'quality' => 'nullable|integer|min:1|max:5',
            'difficulty' => 'nullable|integer|min:1|max:5',
            'punctuality' => 'nullable|integer|min:1|max:5',
            'organization' => 'nullable|integer|min:1|max:5',
            'takes_attendance' => 'nullable|boolean',
            'teacher_role' => 'required|in:theory,practice,general',
            'comment' => 'nullable|string|min:10|max:10000',
            'course_id' => 'required|exists:courses,id',
            'would_take_again' => 'nullable|boolean',
        ];
    }
}
