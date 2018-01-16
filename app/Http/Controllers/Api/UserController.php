<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\professional_information;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();

    	return Fractal::includes(['profesionalInformation','paymentMethods', 'supportTickets', 'medicalAppointments','emails'])->collection($users, new UserTransformer);
    }

    public function show(User $user){
    	return Fractal::includes(['profesionalInformation','paymentMethods', 'supportTickets', 'medicalAppointments', 'emails'])->item($user, new UserTransformer);
    }

    public function store(StoreUserRequest $request){
    	$user = new User;
    	$uN = explode('@', $request->email);
        $uN['username'] = $uN[0] . '@boomedic.mx';
        $explodeName = explode(' ', $request->name);
        $namesUser = array();
        $age = date("Y") - substr($request->birthdate, -4);

        $user->name = $request->name;
        	if(count($explodeName) == 2){

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1];
            
            }elseif (count($explodeName) == 3) {

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1] . ' ' . $explodeName[2];

            }elseif (count($explodeName) == 4) {

                $namesUser['first'] = $explodeName[0] . ' ' . $explodeName[1];
                $namesUser['last'] = $explodeName[2] . ' ' . $explodeName[3];
            }
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->age       = (int) $age;
        $user->status    = 'In Progress';
        $user->firstname = $namesUser['first'];
        $user->lastname  = $namesUser['last'];
        $user->username  = $uN['username'];
        $user->password  = bcrypt($request->password);
        $user->save();
        
        if($request->has('professional_license'))
        {
            $profInformation = new professional_information;
            $profInformation->professional_license = $request->professional_license;
            $profInformation->user = $user->id;
            $profInformation->save();
            return Fractal::includes('profesionalInformation')->item($user, new UserTransformer);
        }

        return Fractal::item($user, new UserTransformer);
    }

    public function update(UpdateUserRequest $request, User $user){
        $user->password = ($request->has('password')) ? bcrypt($request->password) : $user->password; 
        $user->name = ($request->has('name')) ? $request->name : $user->name; 
        $user->email = ($request->has('email')) ? $request->email : $user->email;  
        $user->birthdate = ($request->has('birthdate')) ? $request->birthdate : $user->birthdate; 
        $user->age = ($request->has('age')) ? $request->age : $user->age;                  
        $user->gender = ($request->has('gender')) ? $request->gender : $user->gender;     
        $user->occupation = ($request->has('occupation')) ? $request->occupation : $user->occupation; 
        $user->scholarship = ($request->has('scholarship')) ? $request->scholarship : $user->scholarship;
        $user->country = ($request->has('country')) ? $request->country : $user->country;    
        $user->state = ($request->has('state')) ? $request->state : $user->state;                    
        $user->delegation = ($request->has('delegation')) ? $request->delegation : $user->delegation;               
        $user->colony = ($request->has('colony')) ? $request->colony : $user->colony;                   
        $user->street = ($request->has('street')) ? $request->street : $user->street;                   
        $user->phone = ($request->has('phone')) ? $request->phone : $user->phone;                    
        $user->status = ($request->has('status')) ? $request->status : $user->status;                   
        $user->username = ($request->has('username')) ? $request->username : $user->username;                 
        $user->firstname = ($request->has('firstname')) ? $request->firstname : $user->firstname;                
        $user->lastname = ($request->has('lastname')) ? $request->lastname : $user->lastname;                 
        $user->placebirth = ($request->has('placebirth')) ? $request->placebirth : $user->placebirth;                
        $user->maritalstatus = ($request->has('maritalstatus')) ? $request->maritalstatus : $user->maritalstatus;  
        $user->streetnumber = ($request->has('streetnumber')) ? $request->streetnumber : $user->streetnumber;
        $user->interiornumber = ($request->has('interiornumber')) ? $request->interiornumber : $user->interiornumber;
        $user->officephone = ($request->has('officephone')) ? $request->officephone : $user->officephone;
        $user->familydoctor = ($request->has('familydoctor')) ? $request->familydoctor : $user->familydoctor;
        $user->mobile = ($request->has('mobile')) ? $request->mobile : $user->mobile;                      
        $user->reasonforlastappointment = ($request->has('reasonforlastappointment')) ? $request->reasonforlastappointment : $user->reasonforlastappointment; 
        $user->postalcode = ($request->has('postalcode')) ? $request->postalcode : $user->postalcode;
        $user->latitude = ($request->has('latitude')) ? $request->latitude : $user->latitude;
        $user->longitude = ($request->has('longitude')) ? $request->longitude : $user->longitude;
        $user->profile_photo = ($request->has('profile_photo')) ? $request->profile_photo : $user->profile_photo;
        
        $user->save();

        return Fractal::includes(['profesionalInformation','paymentMethods', 'supportTickets', 'medicalAppointments', 'emails'])->item($user, new UserTransformer);
    }
}
