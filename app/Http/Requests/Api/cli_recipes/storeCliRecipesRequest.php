<?php

namespace App\Http\Requests\Api\cli_recipes;

use Illuminate\Foundation\Http\FormRequest;

class storeCliRecipesRequest extends FormRequest
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
            'medicine' => 'required',
            'test' => 'required',
            'recipe_test' => 'required',
        ];
    }
}
