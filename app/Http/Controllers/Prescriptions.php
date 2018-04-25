<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Jenssegers\Agent\Agent;


class Prescriptions extends Controller
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
        $agent = new Agent();

        return view('prescriptions', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at, 
                'isMobile'  => $agent->isMobile(),
            ]
        );
    }


    public function medicinesCatalogue(){

        $medicines = DB::table('medicines')->get();

        for ($i=0; $i < count(var); $i++) { 
            $medicines[$i]->name = strtolower($medicines[$i]->name);
        }


        return response()->json(
            $medicines   
        );

    }













}
