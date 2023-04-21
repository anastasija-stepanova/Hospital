<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DoctorCreateRequest extends FormRequest
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
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'working_start_time' => ['required', 'date_format:H:i'],
            'working_end_time' => ['required', 'date_format:H:i'],
            'date_of_birth' => ['date'],
            'middle_name' => ['string'],
            'email' => ['email'],
        ];
    }
}
