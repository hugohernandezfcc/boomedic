<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\time_blockers;
use App\medical_appointments;
use Carbon\Carbon;


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
        $user = User::find(Auth::id());
           $appo = DB::table('medical_appointments')
            ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
            ->join('workboard', 'labor_information.id', '=', 'workboard.labInformation')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where('medical_appointments.user_doctor', '=', Auth::id())
            ->where('medical_appointments.status', '!=', 'No completed')
            ->select('medical_appointments.*', 'users.name', 'users.profile_photo','users.age', 'labor_information.workplace as place', 'workboard.patient_duration_attention')
            ->get();
            $appo2 = $appo->unique('id');

                $array = array();
                        foreach($appo2  as $ap){
                            $a = json_decode($ap->patient_duration_attention);
                            $end1 = Carbon::parse('12-12-2012 ' .$a[0]);
                            $end2 = Carbon::parse('12-12-2012 ' .$a[1]);
                            $end3 = $end1->diffInMinutes($end2);
                            $end = Carbon::parse($ap->when)->addMinutes($end3);

                            if(Carbon::parse($ap->when)->format('m-d-Y') < Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["id" => $ap->id, "start" => $ap->when, "user" => $ap->name, "color" => "gray", "photo" => $ap->profile_photo, "age" => $ap->age, "lug" => $ap->place, "end" => $end]);
                                }
                            if(Carbon::parse($ap->when)->format('m-d-Y') > Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["id" => $ap->id, "start" => $ap->when, "user" => $ap->name, "color" => "black", "photo" => $ap->profile_photo, "age" => $ap->age, "lug" => $ap->place, "end" => $end]);
                                }
                            if(Carbon::parse($ap->when)->format('m-d-Y') === Carbon::now()->format('m-d-Y')){
                                    array_push($array, ["id" => $ap->id, "start" => $ap->when, "user" => $ap->name, "color" => "blue", "photo" => $ap->profile_photo, "age" => $ap->age, "lug" => $ap->place, "end" => $end]);
                                }
                                  }

            
        return view('drAppointments', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'array'     => json_encode($array)
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
       $id = $request->idcancel;
       $appo = medical_appointments::find($id);
       $appo->status = 'No completed';
       $appo->sub_status = 'cancel by doctor';
       $appo->save();
       return redirect('drAppointments/index/'. Auth::id());
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function confirmTimeBlocker(Request $request)
    {
       $prof = DB::table('professional_information')->where('user', Auth::id())->first(); 
       $blocker = new time_blockers;
       $blocker->start = $request->start;
       $blocker->end = $request->end;
       $blocker->type = $request->radio;
       $blocker->horary = $request->title;
       $blocker->professional_inf = $prof->id;
       if($blocker->save()){
       return redirect('drAppointments/index/'. Auth::id());
     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('drAppointments/index/'. Auth::id()); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }


    
}
