<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MedicalAppointmentListRequest extends FormRequest
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
            'filter.doctor.last_name' => ['string'],
            'filter.doctor.first_name' => ['string'],
            'filter.doctor.middle_name' => ['string'],
            'filter.patient.last_name' => ['string'],
            'filter.patient.first_name' => ['string'],
            'filter.patient.middle_name' => ['string'],
            'filter.date.from' => ['date'],
            'filter.date.to' => ['date'],
        ];
    }
}
