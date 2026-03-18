<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    public function rules(): array
    {
        $courseId = $this->route('course')?->id;

        return [
            'code' => 'required|string|max:10|unique:courses,code,' . $courseId,
            'name' => 'required|string|max:255',
        ];
    }
}
