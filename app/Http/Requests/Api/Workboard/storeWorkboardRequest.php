<?php

namespace App\Http\Requests\Api\Workboard;

use Illuminate\Foundation\Http\FormRequest;

class storeWorkboardRequest extends FormRequest
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
            'workingDays' => 'required', 
            'workingHours' => 'required',
            'labInformation' => 'required'
        ];
    }
}
