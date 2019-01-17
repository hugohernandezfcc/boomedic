<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\professional_information;
use App\medical_appointments;
use Carbon\Carbon;
use App\User;
use Mail;
use App\devices; 
use App\users_devices;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\ImapPop3;
use App\diagnostic_test_result;
use Event;
use App\Events\EventName;
use Redis;

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
         /*$redis = Redis::connection();
         $data = ['message' => 'hola'];
         $redis->publish('message', json_encode($data));
         Event::fire(new EventName('JohnDoe'));*/
         $agent = new Agent();
         $user = User::find(Auth::id());
         $uuid = session()->get('uuid');

          if($agent->isMobile() && $uuid != "null"){
            if($uuid){
                $device = DB::table('devices')->where('uuid_device', $uuid)->get();
                $old =  DB::table('users_devices')->where(
                [
                    ['device', '=', $device[0]->id],
                    ['user_id', '=',  $user->id]
                ]
            )->get();
                if(count($old) == 0){
                    $ud = new users_devices;
                    $ud->user_id = $user->id;
                    $ud->device = $device[0]->id;
                    if($ud->save())
                    Session(['uuid' => $uuid]);    
            }
            }
          }



        Session(['entered' => $user->entered]);
        $privacyStatement = DB::table('privacy_statement')->orderby('id','DESC')->take(1)->get();
        $StatementForUser = $user->privacy_statement;
        $appointments = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
           ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
           ->join('transaction_bank', 'medical_appointments.id', '=', 'transaction_bank.appointments')
           ->join('paymentsmethods', 'transaction_bank.paymentmethod', '=', 'paymentsmethods.id')
           ->where('medical_appointments.user', '=', Auth::id())
           ->where('medical_appointments.when', '>', Carbon::now()->subDays(1))
           ->select('medical_appointments.id','medical_appointments.created_at','users.name', 'users.profile_photo', 'users.id as did','medical_appointments.when', 'medical_appointments.status', 'labor_information.workplace', 'labor_information.longitude', 'labor_information.latitude','paymentsmethods.cardnumber', 'paymentsmethods.provider', 'paymentsmethods.paypal_email','paymentsmethods.id as idtr')->get();

         $join = DB::table('professional_information')
            ->join('labor_information', 'professional_information.id', '=', 'labor_information.profInformation')
            ->join('users', 'professional_information.user', '=', 'users.id')
            ->select('labor_information.*', 'users.name', 'professional_information.specialty', 'professional_information.id as prof', 'users.id AS dr', 'users.profile_photo')
            ->get();
         $time_blockers =  DB::table('time_blockers')->get();
         $cites = DB::table('medical_appointments')->get();
         $workboard = DB::table('workboard')->get();

             foreach($join as $labor){
             $workArray = array();
             $cite = array();
             $blocker = array();
                       
                          foreach($cites  as $cit){
                            if($cit->user_doctor == $labor->dr){
                            array_push($cite, $cit->when);
                             }
                          }

                          foreach($workboard  as $work){
                            if($work->labInformation == $labor->id){
                                array_push($workArray, $work->workingDays.':'.$work->patient_duration_attention);
                              }
                          }

                         foreach($time_blockers  as $block){
                            if($block->professional_inf == $labor->prof){
                                array_push($blocker, ["start" => $block->start, "end" => $block->end]);
                              }
                          }

                    if($labor->specialty == 'Médico General'){

                        if(!$labor->profile_photo){
                            $mg[] = json_encode(array($labor->latitude, $labor->longitude, $labor->name, $labor->workplace, $labor->general_amount, $workArray, $labor->id, $labor->dr, $cite, "https://s3.amazonaws.com/abiliasf/iconoo_doc_verde-01.png", $blocker)); 
                        } else{
                            $mg[] = json_encode(array($labor->latitude, $labor->longitude, $labor->name, $labor->workplace, $labor->general_amount, $workArray, $labor->id, $labor->dr, $cite, $labor->profile_photo, $blocker));
                                    //$mg[] = '["'.$labor->latitude.','.$labor->longitude.', "'.$labor->name.'", "'.$labor->workplace.'","'.$labor->general_amount.'",'.json_encode($workArray).', "'.$labor->id.'", "'.$labor->dr.'",'.json_encode($cite).', "'.$labor->profile_photo.'",'.json_encode($blocker).']';
                            }
                        }
                    else{
                        if(!$labor->profile_photo){
                            $it[] = json_encode(array($labor->specialty, $labor->latitude, $labor->longitude, $labor->name, $labor->workplace, $labor->general_amount, $workArray, $labor->id, $labor->dr, $cite, "https://s3.amazonaws.com/abiliasf/iconoo_doc_verde-01.png", $blocker));
                            } 
                        else{
                            $it[] = json_encode(array($labor->specialty, $labor->latitude, $labor->longitude, $labor->name, $labor->workplace, $labor->general_amount, $workArray, $labor->id, $labor->dr, $cite, $labor->profile_photo, $blocker));
                           }

                    $sp[] =  json_encode(array($labor->specialty));
                    $mg = '0';
               
                        }
                     }

     

             Session(['it' => $it]);
             Session(['sp' => $sp]);
             Session(['mg' => $mg]);

        if($user->confirmed == false){
               return view('confirme', [
                    'userId'    => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'photo'     => $user->profile_photo,
                    'date'      => $user->created_at,
                   
                ]
            );
        }     
        elseif(is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id){
            $mode = 'Null';
            return view('privacyStatement', [
                    'privacy'   => $privacyStatement[0],
                    'userId'    => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'photo'     => $user->profile_photo,
                    'date'      => $user->created_at,
                    'mode'      => $mode,
                   
                ]
            );
        }

        $profInfo = DB::table('professional_information')
                            ->where('user', Auth::id() )
                            ->get();
        $statusRecordUser = DB::table('users')->where('id', Auth::id() )->value('status');
        if($profInfo->count() > 0 && $user->confirmed == false){
               return view('confirme', [
                    'userId'    => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'photo'     => $user->profile_photo,
                    'date'      => $user->created_at,
                   
                ]
            );
        }  
        elseif($profInfo->count() > 0 && is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id){
            $mode = 'Null';
            return view('privacyStatement', [
                    'privacy'   => $privacyStatement[0],
                    'userId'    => $user->id,
                    'username'  => $user->username,
                    'name'      => $user->name,
                    'photo'     => $user->profile_photo,
                    'date'      => $user->created_at,
                    'mode'      => $mode,
                   
                ]
            );
        }
        if ($profInfo->count() > 0 && $statusRecordUser == 'In Progress') {
            Session(['utype' => 'doctor']);
            return redirect('doctor/edit/In%20Progress');
        }
        if ($profInfo->count() > 0 && $statusRecordUser != 'In Progress') {
             Session(['utype' => 'doctor']);
                    $countpaid = 0;

                    $transactions = DB::table('transaction_bank')
                                    ->join('medical_appointments', 'transaction_bank.appointments', '=', 'medical_appointments.id')
                                    ->join('users', 'medical_appointments.user', '=', 'users.id')
                                    ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
                                    ->where('medical_appointments.user_doctor', '=', $user->id)
                                    ->whereMonth('transaction_bank.created_at','=', Carbon::now()->month)
                                    ->select('transaction_bank.*', 'users.name', 'medical_appointments.when', 'labor_information.workplace as place')
                                    ->get();

                        foreach ($transactions as $tr) {
                            if($tr->type_doctor == 'Paid')
                                $countpaid = $countpaid + $tr->amount;
                        }
        
            return view('homemedical', [
                    'username'      => $user->username,
                    'name'          => $user->name,
                    'firstname'     => $user->firstname,
                    'lastname'      => $user->lastname,
                    'photo'         => $user->profile_photo,
                    'date'          => $user->created_at,
                    'userId'        => $user->id,
                    'labor'         => $join,
                    'photo'         => $user->profile_photo,
                    'workplaces'    => $this->getWorkPlaces(),
                    'medAppoints'   => $this->getMedicalAppointments(),
                    'paid'          => number_format($countpaid,2)
                ]);   
        }
        if(DB::table('users')->where('id', Auth::id() )->value('status') == 'In Progress'){
            Session(['utype' => 'mortal']); 
            return redirect('user/edit/In%20Progress');
        }
        else {
             $assistant = DB::table('assistant')
             ->join('users', 'assistant.user_doctor', '=', 'users.id')
             ->where('user_assist', Auth::id())
             ->select('assistant.*', 'users.name', 'users.profile_photo', 'users.id as iddr')
             ->get();
                        if(count($assistant) == 0){

                             Session(['utype' => 'mortal']); 

                                return view('medicalconsultations', [
                                        'username'  => $user->username,
                                        'name'      => $user->name,
                                        'firstname' => $user->firstname,
                                        'lastname'  => $user->lastname,
                                        'photo'     => $user->profile_photo,
                                        'date'      => $user->created_at,
                                        'userId'    => $user->id,
                                        'labor'     => $join,
                                        'appointments' => $appointments,
                                        'title'     => 'Este doctor no tiene horarios agregados',
                                        'it'        => $it,
                                        'sp'        => $sp,
                                        'mg'        => $mg

                                    ]
                                );
                            }
                            /*Aquimandare la vista del home asistente */
                            else{
                               Session(['utype' => 'assistant']); 
                               /*Validate doctor online*/
                               $donli = array();
                               foreach($assistant as $as){
                                 $doconline = User::find($as->iddr);
                                         if($doconline->isOnline() > 0){
                                            array_push($donli, ['id' => $as->iddr, 'online' => '1']);
                                       }else{
                                            array_push($donli, ['id' => $as->iddr, 'online' => '0']);
                                       }
                                 }
                               /*Validate doctor online*/  

                               if(session()->get('asdr') == null){
                                Session(['asdr' => $assistant[0]->iddr]);
                            }
                                return view('assistant.homeassistant', [
                                        'username'  => $user->username,
                                        'name'      => $user->name,
                                        'firstname' => $user->firstname,
                                        'lastname'  => $user->lastname,
                                        'photo'     => $user->profile_photo,
                                        'date'      => $user->created_at,
                                        'userId'    => $user->id,
                                        'labor'     => $join,
                                        'appointments' => $appointments,
                                        'title'     => 'Este doctor no tiene horarios agregados',
                                        'it'        => $it,
                                        'sp'        => $sp,
                                        'mg'        => $mg,
                                        'as'        => $assistant,
                                        'donli'     => $donli
                                    ]
                                );
                            }

        }
    }
    /**
     * Show the application dashboard.
     *
     * @author  Hugo Hernández <hugo@doitcloud.consulting>
     * @return [Array] [List of workplaces]
     */
    public function getWorkPlaces(){
        return DB::table('labor_information')
            ->join('professional_information', 'labor_information.profInformation', '=', 'professional_information.id')
            ->where('professional_information.user', '=', Auth::id())->get();
    }
    /**
     * Method responsable of return the Medical Appoinments registered to current doctor.
     * @author  Hugo Hernández <hugo@doitcloud.consulting>
     * @return [Array] [List of Medical Appointments]
     */
    public function getMedicalAppointments(){
        return DB::table('medical_appointments')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where(
                [
                    ['medical_appointments.user_doctor', '=', Auth::id()],
                    ['when', '<', Carbon::now()]
                ]
            )->get();
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
        if($request->search != null){
             if(!$user->recent_search){
                 array_push($recent, $request->search);
                     $user->recent_search  = json_encode($recent); 
             } else{  

              if(!in_array($request->search,  $userSearch)){
                 
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

            $user->save();
           } 
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

    //Function for send email notification of empty horary (Ajax controller)
        public function notificationdr($id)
    {
          $user = User::find(Auth::id());
          $doctor = User::find($id);
          $email = $doctor->email;
          $data = [
            'patient'   => $user->name,
            'age'       => $user->age, 
            'gender'    => trans('adminlte::adminlte.'.$user->gender),                 
            'doctor'    => $doctor->name,
            'id'        => $id             
            ]; 

             Mail::send('emails.notificationDr', $data, function ($message) {
                        $message->subject('Alguien echó un vistazo a tu consultorio');
                        $message->to('contacto@doitcloud.consulting');
                    });

        return response()->json($data);
    }

    //Function notify ajax master blade
        public function notify()
    {
          $user = User::find(Auth::id());
          Session(['entered' => $user->entered]);
        //if is for user or for all
         $notifications = DB::table('notifications')->where(function($q) {
          $q->where('user_id', Auth::id())
            ->orWhere('type', 'Global');})->get();

        return response()->json($notifications);
    }


        public function notify2()
    {
        //if is for user or for all
         $user = User::find(Auth::id());
         $user->entered  = true;
          Session(['entered' => $user->entered]);
        if($user->save())
        return response()->json($user->entered);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function messages()
    {
        $array = array();
        $assistant = DB::table('assistant')
             ->join('users', 'assistant.user_doctor', '=', 'users.id')
             ->where('user_assist', Auth::id())
             ->select('assistant.*', 'users.name', 'users.profile_photo', 'users.id as iddr')
             ->get();
                     if(count($assistant) > 0){
                        Session(['utype' => 'assistant']); 
                          if(session()->get('asdr') == null){
                              Session(['asdr' => $assistant[0]->iddr]);
                             }
                         $user = User::find(session()->get('asdr'));
                     }else{  
                            $user = User::find(Auth::id());
                      }
                          /* ----------Files of inbox function store s3 pop3-------------- */
                $this->imapPop3 = new imapPop3;
                $host = 'iscoapp.com';
                $port = '110';
                $mbox = $this->imapPop3->connect($host, $port, $user->username, "adfm90f1m3f0m0adf");
                                /* ----------Files of inbox function store s3 pop3-------------- */
                $this->imapPop3 = new imapPop3;
                $host = 'iscoapp.com';
                $port = '110';
                $mbox = $this->imapPop3->connect($host, $port, $user->username, "adfm90f1m3f0m0adf");
                    $count =  $this->imapPop3->count($mbox);
                    $attach = $this->imapPop3->attachment($mbox, $user->id);
                                foreach($attach as $arraym){ 
                                    $c = DB::table('diagnostic_test_result')
                                    ->where('patient','=', $user->id)
                                    ->where('url','=', $arraym['path'])->get();
                                    if(count($c) == 0){                             
                                       $new_result = new diagnostic_test_result;
                                       $new_result->url =  $arraym['path'];
                                       $new_result->email =  $arraym['from'];
                                       $new_result->details =  $arraym['filename'];
                                       $new_result->patient =  $user->id;
                                       //$new_result->header_email =  json_encode($array['header']);
                                       $new_result->body_email =  json_encode($arraym['body']);
                                       //$new_result->structure_email =  json_encode($array['structure']);
                                       $new_result->date_email =  $arraym['date'];
                                       $new_result->subject_email =  $arraym['subject'];
                                       $new_result->text_email =  $arraym['message'];
                                       $new_result->save();

                                    }
                                }
                           $result = DB::table('diagnostic_test_result')->where('patient','=', $user->id)->where('viewed','=',false)->get();   
                           $result2 = $result->unique('date_email');
                           if(count($result2) > 0){
                            foreach($result2 as $mail){
                                array_push($array, ['type' => 'correo', 'title' => $mail->details, 'name' => $mail->email, 'profile_photo' => asset('inbox_icon.png'), 'created_at' => $mail->created_at]);
                              }
                           } 
                
  

                //if is for messages
                $profInfo = DB::table('professional_information')
                            ->where('user', Auth::id() )
                            ->get();
                 if(count($profInfo) == 0){      
                     $messages1 = DB::table('items_conversations')->where('by', $user->id)->orderBy('created_at')->get();
                 }else{
                    $messages1 = DB::table('items_conversations')
                    ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
                    ->where('conversations.doctor', $user->id)
                    ->select('items_conversations.*')
                    ->orderBy('items_conversations.created_at', 'desc')
                    ->get();
                 }
            $search = $messages1->unique('conversation');
            $messages = DB::table('items_conversations')
                ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
                ->join('users', 'items_conversations.by', '=', 'users.id')
                ->where( 'items_conversations.created_at', '>', Carbon::now()->subDays(7))
                ->select('items_conversations.*', 'conversations.name as namec', 'users.profile_photo')
                ->orderBy('items_conversations.created_at', 'desc')
                ->get();
            $messages = $messages->unique('by');
                foreach($search as $s){
                    foreach($messages as $mess){
                        if($s->conversation == $mess->conversation && $mess->viewed == false && $mess->by != $user->id){
                           array_push($array, ['type' => 'chat', 'title' => $mess->namec, 'name' => $mess->name, 'profile_photo' => $mess->profile_photo, 'created_at' => $mess->created_at]);
                        }
                    }
                }
            $array = array_reverse(array_sort($array, function ($value) {
              return $value['created_at'];
            }));

        return response()->json($array);
    }

     /**
     * Method responsable of list of appoiintments
     */
    public function appointments(){

         $user = User::find(Auth::id());
         $appointments = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
           ->join('professional_information', 'medical_appointments.user_doctor', '=', 'professional_information.user')
           ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
           ->where('medical_appointments.user', '=', Auth::id())
           ->where('medical_appointments.when', '>', Carbon::now())
           ->select('medical_appointments.id','medical_appointments.created_at','users.name', 'users.id as did','medical_appointments.when', 'medical_appointments.status', 'labor_information.*', 'professional_information.specialty','users.profile_photo')->get();

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


         /**
     * Method responsable of list of patients for day
     */
    public function listpatients(){
         $array = array(); 
         $appo = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user', '=', 'users.id')
           ->where('medical_appointments.user_doctor', Auth::id())
           ->whereNull('medical_appointments.aware')
           ->whereDate('medical_appointments.when', Carbon::now()->format('Y-m-d'))
           ->select('medical_appointments.*', 'users.id as did', 'users.profile_photo', 'users.name', 'users.gender','users.age','users.profile_photo')->orderBy('medical_appointments.when')->get();


         $appoFuture = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user', '=', 'users.id')
           ->where('medical_appointments.user_doctor', Auth::id())
            ->whereBetween('medical_appointments.when', [Carbon::now()->addDays(1)->format('Y-m-d'), Carbon::now()->addDays(8)->format('Y-m-d')])
           ->select('medical_appointments.*', 'users.id as did', 'users.profile_photo', 'users.name', 'users.gender','users.age','users.profile_photo')->orderBy('medical_appointments.when')->get();  

           if(count($appo) > 0){
                 $array[0] = $appo;
               }
           else{
               array_push($array, null);  
           }    
           if(count($appoFuture) > 0){
                 $array[1] = $appoFuture;  
               }
           else{
               array_push($array, null);  
           }        

          if(count($appoFuture) == 0 && count($appo) == 0){
                  return response()->json('listo');
               }
               return response()->json($array);  
      }     

      public function listpatients2($id){
        $appo = medical_appointments::find($id);
        $appo->aware = true;
        if($appo->save()){
            return response()->json($appo->$id); 
        }

      }      

        public function logoutback(){

        $parental = session()->get('parental');
        $user = DB::table('users')->where('username', $parental)->first();
        $user2 = User::find($user->id);

        Auth::login($user2, true);
        session()->flush();
        // if successful, then redirect to their intended location
        return redirect()->intended(route('medicalconsultations'));
    }

        public function returnverify()
            {
                $user = User::find(Auth::id());
                $user->confirmation_code = str_random(25);
                if($user->save()){
                $data = [
                'confirmation_code'      => $user->confirmation_code,
                'name'                   => $user->name
            ];
                Mail::send('emails.confirmation_code', $data, function ($message) {
                    $message->to('contacto@doitcloud.consulting')->subject('Por favor confirma tu correo');
                });
                     \Auth::logout();
                      return redirect('/login');
                } else{
                          \Auth::logout();
                        return redirect('/login');
                }
            }
    
}

