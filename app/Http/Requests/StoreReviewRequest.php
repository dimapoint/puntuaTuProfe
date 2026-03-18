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
            'comment' => 'nullable|string|min:10',
            'course_id' => 'required|exists:courses,id',
            'would_take_again' => 'required|boolean',
        ];
    }
}
