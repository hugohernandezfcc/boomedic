<?php

namespace App\Http\Requests\Api\TransactionBank;

use Illuminate\Foundation\Http\FormRequest;

class storeTransactionBankRequest extends FormRequest
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
            'receiver' => 'required',
            'amount' => 'required',
            'paymentmethod' => 'required',
            'transaction' => 'required',
            'credit_debit' => '',
        ];
    }
}
