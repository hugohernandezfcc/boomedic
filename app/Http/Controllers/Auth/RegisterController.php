<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\ProfessionalInformation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => 'required|string|max:255|min:5',
            'birthdate' => 'required|date_format:"m/d/Y"|before:"now"',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    }


    /**
     *  
     *  
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $age = date("Y") - substr($data['birthdate'], -4);
        $namesUser = array();

        $pos = strpos(' ', $data['name']);

        if($pos !== false){
            $explodeName = explode(' ', $data['name']);

            
            
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
        }else{
           $namesUser['first'] = $data['name'];
        }

        


        $uName = explode('@', $data['email']);
        $uName['username'] = $uName[0] . '@boomedic.mx';

        /**
         * En caso de que este campo exista quiere decir que es un registro de médico.
         */

        if (isset($data['professional_license'])) {



            $userCreated =  User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'birthdate' => $data['birthdate'],
                'age'       => (int) $age,
                'status'    => 'In Progress',
                'firstname' => $namesUser['first'],
                'lastname'  => (isset($namesUser['last'])) ? $namesUser['last'] : ' ',
                'username'  => $uName['username'],
                'password'  => bcrypt($data['password']),
            ]);

            $profInformation = ProfessionalInformation::create([ 
                'professional_license'  => $data['professional_license'],
                'user'                  => $userCreated->id
            ]);

            if($profInformation && $userCreated)
                return $userCreated;
            else
                return false;

        }else{
            return User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'birthdate' => $data['birthdate'],
                'age'       => (int) $age,
                'status'    => 'In Progress',
                'firstname' => $namesUser['first'],
                'lastname'  => $namesUser['last'],
                'username'  => $uName['username'],
                'password'  => bcrypt($data['password']),
            ]);
        }
    }

    public function createbyFacebook(Request $request){
        
        if($request->has('accessToken') && ($request->origin == "GG" || $request->origin == "FB" || $request->origin == "LI")
        {
            $uN = explode('@', $request->email);
            $uN['username'] = $uN[0] . '@boomedic.mx';
            $facebookUser = new User;
            $facebookUser->name = $request->name;
            $facebookUser->email = $request->email;
            $facebookUser->status = 'In Progress';
            $facebookUser->firstname = $request->firstName;
            $facebookUser->lastname = $request->lastName;
            $facebookUser->username = $uN['username'];
            $facebookUser->password = bcrypt($request->firstName . $request->lastName);
            $facebookUser->profile_photo = $request->input('picture');
            //$facebookUser->save();
            return $facebookUser;
        }else{
            return "ERROR";
        }

    }
}
