<?php

namespace App\Http\Requests\Api\MedicalAppointments;

use Illuminate\Foundation\Http\FormRequest;

class updateMedicalAppointmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => '',
            'user_doctor' => '',
            'when' => '',
            'status' => '',
            'workplace' => ''
        ];
    }
}
