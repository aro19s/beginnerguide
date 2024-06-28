<?php

namespace App\Http\Requests\Fruits;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFruitRequest extends FormRequest
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
        $id = $this->route('id'); // Obtén el ID del registro actual de la ruta.

    return [
        'name' => 'nullable|string|max:10', Rule::unique('fruits', 'name')->ignore($id),
        'amount' => 'nullable|integer|max:1000',
        'price' => 'nullable|integer|max:50000',
        'type' => 'nullable|string|max:20|in:fruit,vegetable'
    ];
    }
}
