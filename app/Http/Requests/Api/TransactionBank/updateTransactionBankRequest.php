<?php

namespace App\Http\Requests\Api\TransactionBank;

use Illuminate\Foundation\Http\FormRequest;

class updateTransactionBankRequest extends FormRequest
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
            'receiver' => '',
            'amount' => '',
            'paymentmethod' => '',
            'transaction' => '',
            'credit_debit' => '',
        ];
    }
}
