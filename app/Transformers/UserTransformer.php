<?php

namespace App\Transformers;

use App\User;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['profesionalInformation','paymentMethods', 'supportTickets', 'medicalAppointments'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(User $user)
    {
        return [

            'id' => $user->id,
            'name' =>$user->name, 
            'email'=>$user->email,  
            'birthdate' =>$user->birthdate, 
            'age'=>$user->age,                  
            'gender' =>$user->gender,     
            'occupation' =>$user->occupation, 
            'scholarship' =>$user->scholarship,
            'country' =>$user->country,    
            'state' =>$user->state,                    
            'delegation' =>$user->delegation,               
            'colony' =>$user->colony,                   
            'street' =>$user->street,                   
            'phone' =>$user->phone,                    
            'status' =>$user->status,                   
            'username' =>$user->username,                 
            'firstname' =>$user->firstname,                
            'lastname' =>$user->lastname,                 
            'placebirth' =>$user->placebirth,               
            'birthdate' =>$user->birthdate,                
            'maritalstatus' =>$user->maritalstatus,            
            'streetnumber' =>$user->streetnumber,             
            'interiornumber' =>$user->interiornumber,           
            'officephone' =>$user->officephone,              
            'familydoctor' =>$user->familydoctor,             
            'mobile' =>$user->mobile,                      
            'reasonforlastappointment' =>$user->reasonforlastappointment, 
            'postalcode' =>$user->postalcode,
            'latitude' =>$user->latitude,
            'longitude' =>$user->longitude,
            'profile_photo' =>$user->profile_photo
			
        ];
    }
    public function includeProfesionalInformation(User $user){
        return $this->item($user->profesionalInformation, new ProfessionalInformationTransformer);
    }
    public function includePaymentMethods(User $user){
        return $this->collection($user->paymentMethod, new PaymentMethodTransformer);
    }
    public function includeSupportTickets(User $user){
        return $this->collection($user->supportTickets, new SupportTicketTransformer);
    }

    public function includeMedicalAppointments(User $user){
        return $this->collection($user->medicalAppointments, new MedicalAppointmentsTransformer);
    }
}
