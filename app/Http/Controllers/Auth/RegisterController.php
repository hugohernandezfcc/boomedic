<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\professional_information;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\xmlapi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;
use App\devices; 
use App\users_devices;


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
    public function index()
    {
        $asso = DB::table('medical_association')->where('parent', '>', '0')->get();
        return response()->json($asso);
    }
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  $id
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function fcm($code)
    {
       $array = explode("&", $code);
       $deviceOld = DB::table('devices')->where([
                        ['token_registration', '!=', $array[0]],
                        ['uuid_device', '=', $array[1]],
                    ])->get();
       if(count($deviceOld) > 0){
                    $device = devices::find($deviceOld[0]->id);
                    $device->token_registration = $array[0];
                    $device->save();
       } else{
        $deviceOld2 = DB::table('devices')->where([
                ['token_registration', '=', $array[0]],
                ['uuid_device', '=', $array[1]],
            ])->get();  

        if(count($deviceOld2) == 0){
           $device = new devices;
           $device->token_registration = $array[0];
           $device->uuid_device = $array[1];
           $device->save();
        }

     }

        return response()->json("token");
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
            'name'      => 'required|string|max:255|min:5|space',
            'birthdate' => 'required',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    }


    /**
     *  
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['confirmation_code'] = str_random(25);
        $namesUser = array();
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

        /**
         * En caso de que este campo exista quiere decir que es un registro de médico.
         */

        if (isset($data['professional_license'])) {


            $userCreated = $this->creationMethodUser($data, $namesUser);
            
            $profInformation = professional_information::create([ 
                'professional_license'  => $data['professional_license'],
                'medical_society'  => $data['medical_society'],
                'user'                  => $userCreated->id
            ]);

            if($profInformation && $userCreated)
                return $userCreated;
            else
                return false; //send information to developer team.

        }else{

            return $this->creationMethodUser($data, $namesUser);
        }
    }
    /**
     * Method executed to create and send notification to user and confirm the email.
     *
     * @param      <array>  $userData   The user data
     * @param      <array>  $namesUser  The names user
     *
     * @return     <stdClass>  ( User created in stdClass Object ).
     */
    public function creationMethodUser($userData, $namesUser)
    {
        $age = date("Y") - Carbon::parse($userData['birthdate'])->format('Y');

        Mail::send('emails.confirmation_code', $userData, function($message) use ($userData) {
            $message->to('contacto@doitcloud.consulting', $userData['name'])->subject('Hola ' . $userData['name'] . ', es hora de confirmar tu correo.');
        });

        return User::create([
            'name'      => $userData['name'],
            'firstname' => $namesUser['first'],
            'lastname'  => $namesUser['last'],
            'email'     => $userData['email'],
            'birthdate' => Carbon::parse($userData['birthdate'])->format('m-d-Y'),
            'age'       => (int) $age,
            'status'    => 'In Progress',
            'username'  => explode('@', $userData['email'])[0] . '@iscoapp.com',
            'password'  => bcrypt($userData['password']),
            'confirmation_code' => (empty($userData['confirmation_code'])) ? str_random(25) : $userData['confirmation_code']
        ]);
    }

    /**
     * @deprecated method
     */
    public function createbySocialMedia(Request $request)
    {

        // if($request->has('accessToken') && ($request->origin == "GG" || $request->origin == "FB" || $request->origin == "LI"))
        // {
        //     $uN = explode('@', $request->email);
        //     $uN['username'] = $uN[0] . '@iscoapp.com';
        //     $smUser = new User;
        //     $smUser->name = $request->name;
        //     $smUser->email = $request->email;
        //     $smUser->status = 'In Progress';
        //     $smUser->firstname = $request->firstName;
        //     $smUser->lastname = $request->lastName;
        //     $smUser->username = $uN['username'];
        //     $smUser->password = bcrypt($uN[0]);
        //     $smUser->profile_photo = $request->input('picture');
        //     //$smUser->save();
        //     return $smUser;
        // }else{
        //     return "ERROR";
        // }
    }
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  $id
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function loginusers($id)
    {
             $device = DB::table('devices')->where('uuid_device', $id)->get();
             $usersd =  DB::table('users_devices')
             ->join('users', 'users_devices.user_id', '=', 'users.id')
             ->where('device', $device[0]->id)
             ->select('users_devices.*','users.name', 'users.profile_photo', 'users.id as idu')
             ->get();
        return response()->json($usersd);
    }


    public function verify($code){ 
        $user = User::where( [
                ['confirmation_code', '=', $code],
                ['status', '=', 'In Progress'],
                ['confirmed', '=', false]
            ])->first();

        Auth::loginUsingId($user->id);

        if (!$user){
            return redirect('/login');
        }else{   
            /*
             * Create account email in cpanel
             */
            $cpanelusr = config('app.cpanel_user');
            $cpanelpass = config('app.cpanel_pass');

            $xmlapi = new xmlapi(config('app.cpanel_host'));
            $xmlapi->set_port( 2083 );
            $xmlapi->password_auth($cpanelusr,$cpanelpass);
            $xmlapi->set_output('json');
            $xmlapi->set_debug(1);
                
            /* Data new user */ 
            $email_user = $user->username;
            $email_password = "adfm90f1m3f0m0adf";
            $email_domain = "iscoapp.com";
            $email_quota = '50';
            $em = $xmlapi->api1_query($cpanelusr, "Email", "addpop", array($email_user, $email_password, $email_quota, $email_domain));
            /* End create account email in cpanel */   
         
                $user->confirmed = true;
                $user->confirmation_code = null;
                if($user->save())
                    return redirect()->intended(route('medicalconsultations'))->with('notification', 'Has confirmado correctamente tu correo!');
               
            }
     }



}
