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
           ->select('medical_appointments.id','medical_appointments.created_at','users.name', 'users.profile_photo','medical_appointments.when', 'medical_appointments.status', 'labor_information.workplace', 'labor_information.longitude', 'labor_information.latitude')->get();

        $join = DB::table('professional_information')
            ->join('labor_information', 'professional_information.id', '=', 'labor_information.profInformation')
            ->join('users', 'professional_information.user', '=', 'users.id')
            ->select('labor_information.*', 'users.name', 'professional_information.specialty', 'users.id AS dr', 'users.profile_photo')
            ->get();

                

             foreach($join as $labor){
                 $workArray = array();
                 $cite = array();
                  $cites = DB::table('medical_appointments') ->where('user_doctor', '=', $labor->dr)->get();
                          foreach($cites  as $cit){
                            array_push($cite, $cit->when);
                          }

                $workboard = DB::table('workboard') ->where('workboard.labInformation', '=', $labor->id)->get();
                          foreach($workboard  as $work){
                            array_push($workArray, $work->workingDays.':'.$work->patient_duration_attention);
                          }



                    if($labor->specialty == 'Médico General'){
                        if(!$labor->profile_photo){
                        $mg = '["'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'",'.json_encode($workArray).', "'.$labor->id.'", "'.$labor->dr.'",'.json_encode($cite).', "https://s3.amazonaws.com/abiliasf/iconoo_doc_verde-01.png"]';
                        } else{
                        $mg = '["'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'",'.json_encode($workArray).', "'.$labor->id.'", "'.$labor->dr.'",'.json_encode($cite).', "'.$labor->profile_photo.'"]';
                    }
                    }
                    else{
                    if(!$labor->profile_photo){
                          $it[] = '["'.$labor->specialty.'",'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'",'.json_encode($workArray).', "'.$labor->id.'", "'.$labor->dr.'",'.json_encode($cite).', "https://s3.amazonaws.com/abiliasf/iconoo_doc_verde-01.png"]';

                        } else{
                    $it[] = '["'.$labor->specialty.'",'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'",'.json_encode($workArray).', "'.$labor->id.'", "'.$labor->dr.'",'.json_encode($cite).', "'.$labor->profile_photo.'"]';
                            }
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function recent(Request $request)
  {     $user = User::find(Auth::id());
        $userSearch = json_decode($user->recent_search);
        $recent = array();
        $json = json_decode($request);
    if($request->search != null && !in_array($request->search,  $userSearch)){
        if(!$userSearch){
           
            array_push($recent, $request->search);
             $user->recent_search  = json_encode($recent); 
         
      } else{
         
        if(count($userSearch) == 4 ){
            unset($userSearch[0]);
            $userSearch = array_values($userSearch);
            array_push($userSearch, $request->search);
            $user->recent_search  = json_encode($userSearch); 
        } else{
            array_push($userSearch, $request->search);
            $user->recent_search  = json_encode($userSearch); 
            }
        }
       } 
       if($user->recent_search == '' && $request->search != null){
            array_push($recent, $request->search);
             $user->recent_search  = json_encode($recent); 
         }
            $user->save();

        return response()->json($user->recent_search);

    }

     /**
     * Method responsable of list of recent
     */
    public function showrecent()
    {
         $user = User::find(Auth::id());
        return response()->json($user->recent_search);
    }


     /**
     * Method responsable of list of recent
     */
    public function appointments(){

         $user = User::find(Auth::id());
         $appointments = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
           ->join('professional_information', 'medical_appointments.user_doctor', '=', 'professional_information.user')
           ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
           ->where('medical_appointments.user', '=', Auth::id())
            ->where('medical_appointments.when', '>', Carbon::now())
           ->select('medical_appointments.id','medical_appointments.created_at','users.name','medical_appointments.when', 'medical_appointments.status', 'labor_information.*', 'professional_information.specialty','users.profile_photo')->get();


                 return view('appointments', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'app'       => $appointments
            ]
        );
    }
}

