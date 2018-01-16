<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',  
        'password', 
        'birthdate', 
        'age',                  
        'gender',     
        'occupation', 
        'scholarship',
        'country',    
        'state',                    
        'delegation',               
        'colony',                   
        'street',                   
        'phone',                    
        'status',                   
        'username',                 
        'firstname',                
        'lastname',                 
        'placebirth',               
        'birthdate',                
        'maritalstatus',            
        'streetnumber',             
        'interiornumber',           
        'officephone',              
        'familydoctor',             
        'mobile',                      
        'reasonforlastappointment', 
        'postalcode',
        'latitude',
        'longitude',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profesionalInformation(){
        return $this->hasMany(professional_information::class, 'user', 'id');
    }

    public function paymentMethod(){
        return $this->hasMany(PaymentMethod::class, 'owner', 'id');
    }

    public function supportTickets(){
        return $this->hasMany(SupportTicket::class, 'userId', 'id');
    }

    public function medicalAppointments(){
        return $this->hasMany(medical_appointments::class, 'user', 'id');
    }

    public function emails(){
        return $this->hasMany(Email::class, 'userId', 'id');
    }
}
