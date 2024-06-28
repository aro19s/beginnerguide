<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumbersRequest extends FormRequest
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
            'number1' => 'required|integer|min:0',
            'number2' => 'required|integer|max:0'
        ];
    }
}
