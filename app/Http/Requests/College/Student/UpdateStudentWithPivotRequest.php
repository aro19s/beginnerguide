<?php

namespace App\Http\Requests\College\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentWithPivotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'studentName' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer',
            'courses' => 'sometimes|required|array',
            'courses.*.course_id' => 'exists:courses,id',
            'courses.*.additional_info' => 'nullable|string'
        ];
    }
}
