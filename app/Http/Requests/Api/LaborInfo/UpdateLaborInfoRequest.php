<?php

namespace App\Http\Requests\Api\LaborInfo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaborInfoRequest extends FormRequest
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
            'workplace' => '',
            'professionalPosition' => '',
            'profInformation' => '',
            'country' => '',
            'state' => '',
            'delegation' => '',
            'colony' => '',
            'street' => '', 
            'streetNumber' => '',
            'interiorNumber' => '', 
            'phone' => '',
            'latitude' => '', 
            'longitude' => '',
            'postalcode' => '',
            'general_amount' => ''
        ];
    }
}
