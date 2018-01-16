<?php

namespace App\Http\Requests\Api\RecipesTest;

use Illuminate\Foundation\Http\FormRequest;

class updateRecipesTestRequest extends FormRequest
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
            'type' => '',
            'doctor' => '',
            'patient' => '',
            'notes' => '',
            'folio' => '',
            'date' => '',
            'Data_frontend' =>''
        ];
    }
}
