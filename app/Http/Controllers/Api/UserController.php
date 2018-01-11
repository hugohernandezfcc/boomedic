<?php

namespace App\Http\Controllers\Api;

use App\User;
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

    	return Fractal::collection($users, new UserTransformer);
    }

    public function show(User $user){
    	return Fractal::item($user, new UserTransformer);
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
        $user->username  = $uName['username'];
        $user->password  = bcrypt($data['password']);
        $user->save();
        
        if($request->filled('professional_license'))
        {
            $profInformation = new professional_information;
            $profInformation->professional_license = $request->professional_license;
            $profInformation->user = $user->id;
        }

        return Fractal::item($user, new UserTransformer);
    }

    public function update(UpdateUserRequest $request, User $user){
       /* $user->name = ($request->filled('name')) ? $request->name : $user->name; 
        $user->email = ($request->filled('email')) ? $request->email : $user->email;  
        $user->birthdate = ($request->filled('birthdate')) ? $request->birthdate : $user->birthdate; 
        $user->age = ($request->filled('age')) ? $request->age : $user->age;                  
        $user->gender = ($request->filled('gender')) ? $request->gender : $user->gender;     
        $user->occupation = ($request->filled('occupation')) ? $request->occupation : $user->occupation; 
        $user->scholarship = ($request->filled('scholarship')) ? $request->scholarship : $user->scholarship;
        $user->country = ($request->filled('country')) ? $request->country : $user->country;    
        $user->state = ($request->filled('state')) ? $request->state : $user->state;                    
        $user->delegation = ($request->filled('delegation')) ? $request->delegation : $user->delegation;               
        $user->colony = ($request->filled('colony')) ? $request->colony : $user->colony;                   
        $user->street = ($request->filled('street')) ? $request->street : $user->street;                   
        $user->phone = ($request->filled('phone')) ? $request->phone : $user->phone;                    
        $user->status = ($request->filled('status')) ? $request->status : $user->status;                   
        $user->username = ($request->filled('username')) ? $request->username : $user->username;                 
        $user->firstname = ($request->filled('firstname')) ? $request->firstname : $user->firstname;                
        $user->lastname = ($request->filled('lastname')) ? $request->lastname : $user->lastname;                 
        $user->placebirth = ($request->filled('placebirth')) ? $request->placebirth : $user->placebirth;                
        $user->maritalstatus = ($request->filled('maritalstatus')) ? $request->maritalstatus : $user->maritalstatus;  
        $user->streetnumber = ($request->filled('streetnumber')) ? $request->streetnumber : $user->streetnumber;
        $user->interiornumber = ($request->filled('interiornumber')) ? $request->interiornumber : $user->interiornumber;
        $user->officephone = ($request->filled('officephone')) ? $request->officephone : $user->officephone;
        $user->familydoctor = ($request->filled('familydoctor')) ? $request->familydoctor : $user->familydoctor;
        $user->mobile = ($request->filled('mobile')) ? $request->mobile : $user->mobile;                      
        $user->reasonforlastappointment = ($request->filled('reasonforlastappointment')) ? $request->reasonforlastappointment : $user->reasonforlastappointment; 
        $user->postalcode = ($request->filled('postalcode')) ? $request->postalcode : $user->postalcode;
        $user->latitude = ($request->filled('latitude')) ? $request->latitude : $user->latitude;
        $user->longitude = ($request->filled('longitude')) ? $request->longitude : $user->longitude;
        $user->profile_photo = ($request->filled('profile_photo')) ? $request->profile_photo : $user->profile_photo;
        */
        $user->mobile = ($request->filled('mobile')) ? $request->mobile : $user->mobile;
        $user->interiornumber = ($request->filled('interiornumber')) ? $request->interiornumber : $user->interiornumber;
        $user->streetnumber = ($request->filled('streetnumber')) ? $request->streetnumber : $user->streetnumber;
        $user->save();

        return Fractal::item($user, new UserTransformer);
    }
}
