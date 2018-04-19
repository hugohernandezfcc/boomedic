<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\medical_appointments;
use Carbon\Carbon;


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
           $appo =DB::table('medical_appointments')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where('user_doctor', $user->id)
            ->select('medical_appointments.*', 'users.name', 'users.profile_photo')
            ->get();

                $array = array();
                        foreach($appo  as $ap){
                            if(Carbon::parse($ap->when)->format('m-d-Y') < Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["start" => $ap->when, "user" => $ap->name, "color" => "gray", "photo" => $ap->profile_photo]);
                                }
                            if(Carbon::now()->format('m-d-Y') < Carbon::parse($ap->when)->format('m-d-Y')){
                                    array_push($array, ["start" => $ap->when, "user" => $ap->name, "color" => "black", "photo" => $ap->profile_photo]);
                                }
                            if(Carbon::parse($ap->when)->format('m-d-Y') == Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["start" => $ap->when, "user" => $ap->name, "color" => "blue", "photo" => $ap->profile_photo]);
                                }
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
