<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ];
    }
}
