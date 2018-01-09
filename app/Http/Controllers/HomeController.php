<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\professional_information;
use Carbon\Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacyStatement = DB::table('privacy_statement')->orderby('id','DESC')->take(1)->get();
        $StatementForUser = DB::table('users')->where('id', Auth::id() )->value('privacy_statement');
        $appointments = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
           ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
           ->where('medical_appointments.user', '=', Auth::id())
            ->where('medical_appointments.when', '>', Carbon::now())
           ->select('medical_appointments.id','medical_appointments.created_at','users.name','medical_appointments.when', 'medical_appointments.status', 'labor_information.workplace')->get();

        $join = DB::table('professional_information')
            ->join('labor_information', 'professional_information.id', '=', 'labor_information.profInformation')
            ->join('users', 'professional_information.user', '=', 'users.id')
            ->select('labor_information.*', 'users.name', 'professional_information.specialty')
            ->get();


             foreach($join as $labor){
                    if($labor->specialty == 'Médico General'){
                        $mg = '["'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'"]';
                    }
                    else{
                    $it[] = '["'.$labor->specialty.'",'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'"]';

                    $sp[] = '["'.$labor->specialty.'"]';
                    $mg = '0';
                        }
                     }

     

             Session(['it' => $it]);
             Session(['sp' => $sp]);
             Session(['mg' => $mg]);


        if(is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id){
            $mode = 'Null';
            return view('privacyStatement', [
                    'privacy'   => $privacyStatement[0],
                    'userId'    => Auth::id(),
                    'username'  => DB::table('users')->where('id', Auth::id() )->value('username'),
                    'name'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                    'photo'     => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
                    'date'     => DB::table('users')->where('id', Auth::id() )->value('created_at'),
                    'mode'      => $mode
                   
                ]
            );
        }

        $profInfo = DB::table('professional_information')
                            ->where('user', Auth::id() )
                            ->get();

        if ($profInfo->count() > 0 && DB::table('users')->where('id', Auth::id() )->value('status') == 'In Progress') 
            return redirect('doctor/edit/In%20Progress');
        

        if(DB::table('users')->where('id', Auth::id() )->value('status') == 'In Progress')
            return redirect('user/edit/In%20Progress');
        
        else {
            return view('medicalconsultations', [
                    'username' => DB::table('users')->where('id', Auth::id() )->value('username'),
                    'name'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                    'firstname' => DB::table('users')->where('id', Auth::id() )->value('firstname'),
                    'lastname' => DB::table('users')->where('id', Auth::id() )->value('lastname'),
                    'photo' => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
                    'date'     => DB::table('users')->where('id', Auth::id() )->value('created_at'),
                    'userId' => Auth::id(),
                    'labor' => $join,
                    'appointments' => $appointments

                ]
            );
        }
    }

}
