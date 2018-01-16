<?php

namespace App\Http\Requests\Api\Menu;

use Illuminate\Foundation\Http\FormRequest;

class storeMenuRequest extends FormRequest
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
            'text' => 'required', 
            'order' => 'required', 
            'label' => 'required',
            'icon' => 'required', 
            'label_color' => 'required', 
            'url' => 'required', 
            'to' => 'required', 
            'typeitem' => 'required', 
            'parent' => ''
        ];
    }
}
