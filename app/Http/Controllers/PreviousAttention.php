<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;



class PreviousAttention extends Controller
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
        
        $questions = DB::table('questions_clinic_history')->get();
        $clinic = array();
        for ($i=0; $i < count($questions); $i++)  
            array_push($clinic, $questions[$i]->question);

        array_push($clinic, 'Familiares relacionados');
        

        $informationUser = array(
            'personalInformation' => array(
                    'Nombre',
                    'Edad',
                    'Ocupación',
                    'Genero',
                    'Estado civil'
                ), 
            'medicalRecord' => array(
                    'Cita',
                    'Fecha de cita',
                    'Médico',
                    'Prescripción',
                ), 
            'clinicHistory'=> $clinic,  
            'habits' => array()
        );

        dd($informationUser);

        return view('previousattention', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'info'      => $informationUser
            ]
        );
    } 
}
