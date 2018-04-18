<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\medical_appointments;


class drAppointments extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = User::find(Auth::id());
        $appo =  DB::table('medical_appointments') ->where('user_doctor', $user->id)->get();
                $array = array();
                        foreach($appo  as $ap){
                                    array_push($array, $ap->when);
                                  }


        return view('drAppointments', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'array'     => json_encode($array)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('drAppointments/index/'. Auth::id()); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }


    
}
