<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name' => [
                'required|string|max:255|min:5',
                Rule::in([' '])
            ],
            'birthdate' => 'required|date_format:"m/d/Y"|before:"now"',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $explodeName = explode(' ', $data['name']);

        $namesUser = array();

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


        $uName = explode('@', $data['email']);
        $uName['username'] = $uName[0] . '@boomedic.mx';

        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'birthdate' => $data['birthdate'],
            'age'       => (int) $age,
            'status'    => 'In Progress',
            'firstname' => $namesUser['first'],
            'lastname'  => $namesUser['last'],
            'username'  => $uName['username'];
            'password'  => bcrypt($data['password']),
        ]);
    }
}
