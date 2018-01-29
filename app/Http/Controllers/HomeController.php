<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\professional_information;
use Carbon\Carbon;
use App\User;

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
        $user = User::find(Auth::id());
        $privacyStatement = DB::table('privacy_statement')->orderby('id','DESC')->take(1)->get();
        $StatementForUser = $user->privacy_statement;
        $appointments = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
           ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
           ->where('medical_appointments.user', '=', Auth::id())
            ->where('medical_appointments.when', '>', Carbon::now())
           ->select('medical_appointments.id','medical_appointments.created_at','users.name','medical_appointments.when', 'medical_appointments.status', 'labor_information.workplace', 'labor_information.longitude', 'labor_information.latitude')->get();

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
                    'userId'    => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'photo'     => $user->profile_photo,
                    'date'      => $user->created_at,
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
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'firstname' => $user->firstname,
                    'lastname'  => $user->lastname,
                    'photo'     => $user->profile_photo,
                    'date'      => $user->created_at,
                    'userId'    => $user->id,
                    'labor'     => $join,
                    'appointments' => $appointments

                ]
            );
        }
    }


    public function recent(Request $request)
  {     $user = User::find(Auth::id());
        $userSearch = $user->recent_search;
        $recent = array();
        $json = json_decode($request);


   
             $user->recent_search  = $json; 

            $user->save();
        return response()->json(['search' => $user->recent_search]);

    }

}
