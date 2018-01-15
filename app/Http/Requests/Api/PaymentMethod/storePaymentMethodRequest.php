<?php

namespace App\Http\Requests\Api\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;

class storePaymentMethodRequest extends FormRequest
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
            'provider' => 'required',
            'typemethod' => 'required',
            'country' => '',
            'month' => '',
            'year' => '',
            'cvv' => 'required',
            'cardnumber' => 'required',
            'owner' => 'required',
            'paypal_email' => '',
            'bank' => 'required',
            'notified' => ''
        ];
    }
}
