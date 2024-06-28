<?php

namespace App\Http\Requests\Fruits;

use Illuminate\Foundation\Http\FormRequest;

class CreateFruitRequest extends FormRequest
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
            'name' => 'required|string|max:20|unique:fruits',
            'amount' => 'required|integer|max:1000',
            'price' => 'required|integer|max:50000',
            'type' => 'required|string|max:20|in:fruit,vegetable'
        ];
    }
}
