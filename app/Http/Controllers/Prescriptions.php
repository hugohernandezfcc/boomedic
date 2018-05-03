<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;


class Prescriptions extends Controller
{

    /**
     * Create a new controller instance.
     * 
     * Is used a middleware to validate if exist a valid session.
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
        $agent = new Agent();

        $medAppointments = DB::table('medical_appointments')
                            ->join('users', 'medical_appointments.user', '=', 'users.id')
                            ->where([
                                ['medical_appointments.when', '<=', Carbon::today()],
                                ['medical_appointments.when', '>=', Carbon::today()],
                            ])->select('medical_appointments.*', 'users.firstname', 'users.lastname', 'users.gender', 'users.age' )
                            ->get();

        dd($medAppointments);

        return view('prescriptions', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at, 
                'isMobile'  => $agent->isMobile(),
                'medAppointments'  => $medAppointments,
            ]
        );
    }


    public function medicinesCatalogue(){

        $medicines = DB::table('medicines')->get();

        for ($i=0; $i < count($medicines); $i++) { 
            $medicines[$i]->name = strtolower($medicines[$i]->name);
            $medicines[$i]->medicine = 'name:' . $medicines[$i]->name . '---id:' . $medicines[$i]->id;
        }


        return response()->json(
            $medicines   
        );
    }













}
