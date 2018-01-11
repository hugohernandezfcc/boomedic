<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => '', 
            'email' => '',  
            'password' => '', 
            'birthdate' => '', 
            'age' => '',                  
            'gender' => '',     
            'occupation' => '', 
            'scholarship' => '',
            'country' => '',    
            'state' => '',                    
            'delegation' => '',               
            'colony' => '',                   
            'street' => '',                   
            'phone' => '',                    
            'status' => '',                   
            'username' => '',                 
            'firstname' => '',                
            'lastname' => '',                 
            'placebirth' => '',                               
            'maritalstatus' => '',            
            'streetnumber' => '',             
            'interiornumber' => '',           
            'officephone' => '',              
            'familydoctor' => '',             
            'mobile' => '',                      
            'reasonforlastappointment' => '', 
            'postalcode' => '',
            'latitude' => '',
            'longitude' => '',
            'profile_photo' => ''
        ];
    }
}
