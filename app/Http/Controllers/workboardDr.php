<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\workboard;


class workboardDr extends Controller
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
    public function index($id){
    $user = User::find(Auth::id());   
    $work = $id;
        return view('workboard', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'work'      => $work
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id )
    {

         $user = User::find(Auth::id()); 
         
         $workboard = new workboard;
         if($request->Mar == 'Mar'){
         $workboard->workingDays = $request->Mar;
         $workboard->workingHours = 
         $workboard->labInformation = $id;
         $workboard->start = $request->start;
         $workboard->end   = $request->end;
         if($request->fixed == 'fixed'){
         $workboard->fixed_schedule = 'True';
            }
         $workboard->patient_duration_attention = $request->prom;
         $workboard->save();
        }



        return view('workboard', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'work'      => $id

            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       return redirect('medicalconsultations');
    }

    /**
     * Method responsable of list of paymentmethods
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('workboard/index'); //show
                break;
            
            default:
                return redirect('/workboard'); //medicalconsultations
                break;
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    
}
