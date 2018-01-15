<?php

namespace App\Http\Requests\Api\MedicalAppointments;

use Illuminate\Foundation\Http\FormRequest;

class storeMedicalAppointmentsRequest extends FormRequest
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
            'user' => 'required',
            'user_doctor' => 'required',
            'when' => 'required',
            'status' => 'required',
            'workplace' => 'required'
        ];
    }
}
