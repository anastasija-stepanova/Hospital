<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientCreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required_without_all:first_name,middle_name', 'string'],
            'first_name' => ['required_without_all:last_name,middle_name', 'string'],
            'middle_name' => ['required_without_all:last_name,first_name', 'string'],
            'snils' => ['required', 'string'],
            'date_of_birth' => ['date'],
            'address' => ['string'],
        ];
    }
}
