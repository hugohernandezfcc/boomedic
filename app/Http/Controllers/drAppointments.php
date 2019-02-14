<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\time_blockers;
use App\medical_appointments;
use Carbon\Carbon;
use App\email;
use Mail;


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
        $user2 = User::find(Auth::id());
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
         }else{  
           $user = User::find(Auth::id());
           $assistant = null;
           $donli = null;
         }
           $appo = DB::table('medical_appointments')
            ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
            ->join('workboard', 'labor_information.id', '=', 'workboard.labInformation')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where('medical_appointments.user_doctor', '=', $user->id)
            ->where('medical_appointments.status', '!=', 'No completed')
            ->select('medical_appointments.*', 'users.name', 'users.profile_photo','users.age', 'users.gender', 'users.id as userid', 'labor_information.workplace as place', 'workboard.patient_duration_attention')
            ->get();
            $appo2 = $appo->unique('id');
            $time_blockers = DB::table('time_blockers')
            ->join('professional_information', 'time_blockers.professional_inf', '=', 'professional_information.id')
            ->where('professional_information.user', $user->id)
            ->select('time_blockers.*')
            ->get();
            $time2 = $time_blockers->unique('id');

                $array = array();
                        foreach($appo2  as $ap){
                            $a = json_decode($ap->patient_duration_attention);
                            $end1 = Carbon::parse('12-12-2012 ' .$a[0]);
                            $end2 = Carbon::parse('12-12-2012 ' .$a[1]);
                            $end3 = $end1->diffInMinutes($end2);
                            $end = Carbon::parse($ap->when)->addMinutes($end3);

                            if(Carbon::parse($ap->when)->format('m-d-Y') < Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["id" => $ap->id, "start" => $ap->when, "user" => $ap->name, "color" => "gray", "photo" => $ap->profile_photo, "gender" => $ap->gender, "uid" => $ap->userid, "age" => $ap->age, "lug" => $ap->place, "end" => $end, "type" => "1"]);
                                }
                            if(Carbon::parse($ap->when)->format('m-d-Y') > Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["id" => $ap->id, "start" => $ap->when, "user" => $ap->name, "color" => "black", "photo" => $ap->profile_photo, "gender" => $ap->gender, "age" => $ap->age, "uid" => $ap->userid, "lug" => $ap->place, "end" => $end, "type" => "1"]);
                                }
                            if(Carbon::parse($ap->when)->format('m-d-Y') === Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["id" => $ap->id, "start" => $ap->when, "user" => $ap->name, "color" => "blue", "photo" => $ap->profile_photo, "gender" => $ap->gender, "age" => $ap->age, "uid" => $ap->userid, "lug" => $ap->place, "end" => $end, "type" => "1"]);
                                }
                                  }
                        foreach($time2  as $ti){
                            array_push($array, ["id" => $ti->id, "start" => $ti->start, "user" => $user->name, "color" => "green", "photo" => $user->profile_photo, "gender" => $ap->gender, "age" => $user->age, "title" => $ti->title, "color" => $ti->color, "end" => $ti->end, "type" => "3"]);
                        }           

            
        return view('drAppointments', [
                'userId'    => $user->id,
                'username'  => $user2->username,
                'name'      => $user2->name,
                'photo'     => $user2->profile_photo,
                'date'      => $user2->created_at,
                'gender'    => $user2->gender,
                'array'     => json_encode($array),
                'as'        => $assistant,
                'donli'     => $donli

            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function cancelAppointment(Request $request)
    {
         if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
           $user = User::find(Auth::id());
         }
       $id = $request->idcancel;
       $appo = medical_appointments::find($id);
       $appo->status = 'No completed';
       $appo->sub_status = 'cancel by doctor';
       $appo->reasontocancel = $request->radioreason;
       if($request->definitive == 'true')
          $appo->definitive = true;
       $appo->save();

       $option1 = array();
       $daydatef = Carbon::parse($appo->when);

                 $join = DB::table('professional_information')
                              ->join('labor_information', 'professional_information.id', '=', 'labor_information.profInformation')
                              ->join('users', 'professional_information.user', '=', 'users.id')
                              ->where('labor_information.id','=', $id)
                              ->select('users.name', 'professional_information.*', 'users.id AS dr', 'users.profile_photo')
                              ->first();

                           $time_blockers =  DB::table('time_blockers')->where('professional_inf', $join->id)->get();
                           $cites = DB::table('medical_appointments')->where('workplace',$id)->get();
                           $workboard = DB::table('workboard')->where('labInformation',$id)->get();

                            foreach($workboard as $work){
                                for($s = 1; $s < 10; $s++){
                                   $daydate = $daydatef->addDays($s);
                                   $day =  trans('adminlte::adminlte.'.$daydate->format('D')); 
                                   if($work->workingDays == $day)
                                      $hours = $work->workingHours;  
                                       foreach($hours as $h){
                                        $ex = 0;
                                        $notex = 0;
                                        $time = $daydate->format('HH:mm:ss');
                                        $date = $daydate->format('m-d-Y');
                                          if($h >= $time){
                                            foreach ($cites as $cite) {

                                                if($date.' '.$h == $cite->when)
                                                    $ex++;
                                                else
                                                    $notex++;
                                            }
                                              if($ex == 0){
                                                 array_push($option1, $date.' '.$h);
                                              }

                                          }
                                       }

                                }
                            } 
                                     $data = [
                                              'dr'     => $user->name,
                                              'reason' => $appo->reasontocancel,
                                              'definitive'     => $appo->definitive,
                                              'array'            => $option1
                                            ];  
                                           
                                       Mail::send('emails.cancelAppointment', $data, function ($message) {
                                                    $message->subject('Te acaban de cancelar una cita...');
                                                    $message->to('contacto@doitcloud.consulting');
                                                });
        

       return redirect('drAppointments/index/'. $user->id);
       
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editTimeBlocker(Request $request)
    {
        if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
           $user = User::find(Auth::id());
         }
       $id = $request->idEdit;
       $time = time_blockers::find($id);
       $time->title = $request->titleEdit;
       $time->start = $request->startEdit;
       $time->end   = $request->endEdit;       
       $time->save();
       return redirect('drAppointments/index/'. $user->id);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */        
 
    public function confirmTimeBlocker(Request $request)
    {
        if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
           $user = User::find(Auth::id());
         }
        $prof = DB::table('professional_information')->where('user', $user->id)->first(); 
        $blocker = new time_blockers;
       if($request->t == "1"){
       $blocker->start            = $request->start;
       $blocker->end              = $request->end;
       $blocker->type             = $request->radio;
       $blocker->title            = $request->title;
       $blocker->professional_inf = $prof->id;
       $blocker->color            = $request->color;
       }
       else{
       $start =  Carbon::parse($request->date)->format('m-d-Y') . ' ' . $request->start;   
       $end = Carbon::parse($request->date)->format('m-d-Y') . ' ' . $request->end;   
       $blocker->start            = $start;
       $blocker->end              = $end;
       $blocker->type             = $request->radio;
       $blocker->title            = $request->title;
       $blocker->professional_inf = $prof->id;
       $blocker->color            = $request->color;
         }
       if($blocker->save()){
       return redirect('drAppointments/index/'. $user->id);
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
         if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
           $user = User::find(Auth::id());
         }
         DB::delete('delete from time_blockers where id = ?',[$id]) ;    
    
          return redirect('drAppointments/index/'. $user->id);
    } 

    public function redirecting($page)
    {
          if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
           $user = User::find(Auth::id());
         }
        switch ($page) {
            case 'index':
                return redirect('drAppointments/index/'. $user->id); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }


    
}
