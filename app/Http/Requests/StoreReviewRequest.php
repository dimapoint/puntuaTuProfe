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
            'quality' => 'required|integer|min:1|max:5',
            'difficulty' => 'required|integer|min:1|max:5',
            'punctuality' => 'required|integer|min:1|max:5',
            'organization' => 'required|integer|min:1|max:5',
            'takes_attendance' => 'required|boolean',
            'teacher_role' => 'required|in:theory,practice,general',
            'comment' => 'nullable|string|min:10|max:10000',
            'course_id' => 'required|exists:courses,id',
            'would_take_again' => 'required|boolean',
        ];
    }
}
