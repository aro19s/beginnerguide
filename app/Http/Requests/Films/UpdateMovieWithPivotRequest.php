<?php

namespace App\Http\Requests\Films;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieWithPivotRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'duration' => 'sometimes|required|integer',
            'genres'=> 'sometimes|required|array',
            'genres.*.genre_id' => 'exists:genres,id',
            'genres.*.extra_info' => 'nullable|string'

        ];
    }
}
