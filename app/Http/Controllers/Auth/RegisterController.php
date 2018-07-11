<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\professional_information;

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
            'name'      => 'required|string|max:255|min:5',
            'birthdate' => 'required',
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
              $cpanelusr = 'fastcode';
              $cpanelpass = 'y1eT1dr9Y';
              $xmlapi = new xmlapi('127.0.0.1');
              $xmlapi->set_port( 2083 );
              $xmlapi->password_auth($cpanelusr,$cpanelpass);
              $xmlapi->set_debug(0);

        $data['confirmation_code'] = str_random(25);
        $age = date("Y") - Carbon::parse($data['birthdate'])->format('Y');
        $namesUser = array();

        //$pos = strpos(' ', $data['name']);

        //if($pos !== false){
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
        //}else{
           //$namesUser['first'] = $data['name'];

        //}

        


        $uName = explode('@', $data['email']);
        $uName['username'] = $uName[0] . '@boomedic.mx';
            $email_user = "$uName[0]";
            $email_password = "123456";
            $email_domain = "@fastcodecloud.com";
            $email_quota = '10';

            $addemail = $xmlapi->api1_query($cpanelusr, "Email", "addpop", array($email_user, $email_password, $email_quota, $email_domain) );
        /**
         * En caso de que este campo exista quiere decir que es un registro de médico.
         */

        if (isset($data['professional_license'])) {



            $userCreated =  User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'birthdate' => Carbon::parse($data['birthdate'])->format('m-d-Y'),
                'age'       => (int) $age,
                'status'    => 'In Progress',
                'firstname' => $namesUser['first'],
                'lastname'  => (isset($namesUser['last'])) ? $namesUser['last'] : ' ',
                'username'  => $uName['username'],
                'password'  => bcrypt($data['password']),
                'confirmation_code' => $data['confirmation_code']
            ]);
                 Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
                $message->to('contacto@doitcloud.consulting', $data['name'])->subject('Por favor confirma tu correo');
            });
            $profInformation = professional_information::create([ 
                'professional_license'  => $data['professional_license'],
                'medical_society'  => $data['medical_society'],
                'user'                  => $userCreated->id
            ]);

            if($profInformation && $userCreated)
                return $userCreated;
            else
                return false;

        }else{
                     Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
                    $message->to('contacto@doitcloud.consulting', $data['name'])->subject('Por favor confirma tu correo');
                });

            $usermor        = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'birthdate' => Carbon::parse($data['birthdate'])->format('m-d-Y'),
                'age'       => (int) $age,
                'status'    => 'In Progress',
                'firstname' => $namesUser['first'],
                'lastname'  => $namesUser['last'],
                'username'  => $uName['username'],
                'password'  => bcrypt($data['password']),
                'confirmation_code' => $data['confirmation_code']
            ]);
           return  $usermor;
 
        }
    }

    public function createbySocialMedia(Request $request){

        if($request->has('accessToken') && ($request->origin == "GG" || $request->origin == "FB" || $request->origin == "LI"))
        {
            $uN = explode('@', $request->email);
            $uN['username'] = $uN[0] . '@boomedic.mx';
            $smUser = new User;
            $smUser->name = $request->name;
            $smUser->email = $request->email;
            $smUser->status = 'In Progress';
            $smUser->firstname = $request->firstName;
            $smUser->lastname = $request->lastName;
            $smUser->username = $uN['username'];
            $smUser->password = bcrypt($uN[0]);
            $smUser->profile_photo = $request->input('picture');
            //$smUser->save();
            return $smUser;
        }else{
            return "ERROR";
        }

    }



}
