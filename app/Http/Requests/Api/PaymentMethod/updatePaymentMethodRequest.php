<?php

namespace App\Http\Requests\Api\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;

class updatePaymentMethodRequest extends FormRequest
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
            'provider' => '',
            'typemethod' => '',
            'country' => '',
            'month' => '',
            'year' => '',
            'cvv' => '',
            'cardnumber' => '',
            'owner' => '',
            'paypal_email' => '',
            'bank' => '',
            'notified' => '' 
        ];
    }
}
