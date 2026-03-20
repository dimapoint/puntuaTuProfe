<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:teachers,name',
            'bio' => 'nullable|string|max:5000',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ];
    }
}
