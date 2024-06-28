<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ZodiacRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array<string
     */
    public function rules(): array
    {
        $todayMinus18Years = Carbon::now()->subYears(18)->format('Y-m-d');


        return [
            'name' => 'required|string|max:15|regex:/^[A-Za-z]+$/',
            'lastName' => 'required|string|max:15|regex:/^[A-Za-z]+$/',
            'birthDate' => 'required|date_format:Y-m-d|before_or_equal:' . $todayMinus18Years,
            'wish' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        ];
    }

    public function messages()
    {
        return [
            'birthDate.before_or_equal' => 'Debes tener al menos 18 años.',
            'name.regex' => 'El campo nombre solo puede contener letras.',
            'lastName.regex' => 'El campo apellido solo puede contener letras.',
            'wish.regex'=> 'Este campo solo puede contener letras.',
        ];
    }
}
