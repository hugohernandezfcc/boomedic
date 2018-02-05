<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\medical_appointments;


class medicalappointments extends Controller
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
        

        return view('medicalappointments', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = user::find(Auth::id());
        $medical = new medical_appointments;
   
        $medical->user           = Auth::id();
        $medical->user_doctor    = '16';
        $medical->workplace    = '21';
        //$medical->latitude       = '19.343255357777';
        //$medical->longitude     = '-99.1379801140335';
        $medical->when          = '2018-11-03 11:00:00';
        $doctor = user::find($medical->user_doctor);

        if ($medical->save()) {

            Mail::send('emails.confirmacionCita', ['doctor' => $doctor,'appointment' => $medical], function ($message) use($data){
                $message->subject('Boomedic');
                $message->to($data['email']);
            }); 

            return redirect('medicalconsultations');
        }
    }

    /**
     * Method responsable of list of paymentmethods
     */

    public function showPaymentMethods()
    {
        return response()->json(
            DB::table('paymentsmethods')->where('owner', Auth::id() )->get()
        );
    }

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
        $medical = medical_appointments::find($id);

        $medical->when = '2017-12-30 09:00:00';

        if ($medical->save()) 
       return redirect('medicalconsultations');
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('medicalappointments/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
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
