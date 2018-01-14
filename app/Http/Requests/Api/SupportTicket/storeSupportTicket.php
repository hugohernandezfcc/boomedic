<?php

namespace App\Http\Requests\Api\SupportTicket;

use Illuminate\Foundation\Http\FormRequest;

class storeSupportTicket extends FormRequest
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
            'email' => 'required',
            'userType' => 'required',
            'ticketDescription' => 'required',
            'userId' => 'required',
            'status' => 'required', 
            'subject' => 'required'
        ];
    }
}
