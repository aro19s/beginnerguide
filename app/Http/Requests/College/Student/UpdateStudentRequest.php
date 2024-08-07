<?php

namespace App\Http\Requests\College\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'studentName'=>'sometimes|required|string',
            'age'=>'sometimes|required|integer',
            'course_ids'=>'sometimes|required|array',
            'course_ids.*'=>'exists:courses,id',
        ];
    }
}
