<?php

namespace App\Http\Requests\Api\Emails;

use Illuminate\Foundation\Http\FormRequest;

class storeEmailsRequest extends FormRequest
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
            'userId' => 'required',
            'email' => 'required',
            'date' => 'required',
            'sender' => 'required',
            'recipient' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'parent' => 'required'
        ];
    }
}
