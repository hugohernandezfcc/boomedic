<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Workboard;
use Carbon\Carbon;


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
                $assistant = null;
                $donli = null;
          } 
    $work = $id;

    $arrayName = array();

    $workboard = DB::table('workboard')->where('labInformation', $work)->where('oldnew', 'old')->get();
    array_push($arrayName, $workboard);
    $workboard2 = DB::table('workboard')->where('workboard.labInformation', '=', $id)->where('oldnew', 'old')->get();
    array_push($arrayName, $workboard2);
    $workboardNew = DB::table('workboard')->where('workboard.labInformation', '=', $id)->where('oldnew', 'new')->get();
    array_push($arrayName, $workboardNew);

    dd($arrayName);

        $workArray = array();
        foreach($workboard2  as $work2){
            array_push($workArray, $work2->workingDays.':'.$work2->patient_duration_attention);
        }
        

        $workArrayNew = array();
        foreach($workboardNew  as $work3){
            array_push($workArrayNew, $work3->workingDays.':'.$work3->patient_duration_attention);
        }  
     
        $validate = $this->handleExistAppointments($id);                    

        return view('workboard', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'gender'    => $user->gender,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'work'      => $work,
                'workboard' => $workboard,
                'workboard2' => json_encode($workArray),
                'mode'      => 'null',
                'as'        => $assistant,
                'donli'     => $donli,
                'new'       => json_encode($workArrayNew),
                'new2'      => $workboardNew,
                'appointments' => $validate
            ]
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $user = User::find(Auth::id());

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
                $assistant = null;
                $donli = null;
        } 

        $workboard = DB::table('workboard')->where('labInformation', $id)->where('oldnew', 'new')->get();
        if(count($workboard) > 0){
            DB::table('workboard')->where('labInformation', $id)->where('oldnew', 'new')->delete();   
        }


        if ($request->type == 'false') {
            //$user = User::find(Auth::id()); 
        
            $startTime  = Carbon::parse($request->start);
            $finishTime = Carbon::parse($request->end);
            $totalDuration = $finishTime->diffInMinutes($startTime);
            $consultation = $request->prom + 5;
            $totalconsultation = number_format(($totalDuration / $consultation), 0, '.', ',');
            $hora_inicio = new \DateTime(  $startTime );
            $hora_fin    = new \DateTime(  $finishTime );
            $hora_fin->modify('+1 second'); // Añadimos 1 segundo para que nos muestre $hora_fin

            // Establecemos el intervalo en minutos        
            $intervalo = new \DateInterval('PT'.$consultation.'M');
        
            // Sacamos los periodos entre las horas
            $periodo   = new \DatePeriod($hora_inicio, $intervalo, $hora_fin);        
       
            foreach( $periodo as $hora ) {
                // Guardamos las horas intervalos 
                $horas[] =  $hora->format('H:i:s');
            }

            $timeend = Carbon::parse(\end($horas));

            if($timeend !=  $finishTime){
                $timedeath = $finishTime->diffInMinutes($timeend);
                array_push($horas, "asueto :".$timedeath);
            }

            foreach($request->day as $day){   
                $workboard = new workboard;
        
                if($day == 'Lun'){
                    $workboard->workingDays = $day;
                }
                if($day == 'Mar'){
                    $workboard->workingDays = $day;
                }
                if($day == 'Mie'){
                    $workboard->workingDays = $day;
                }
                if($day == 'Jue'){
                    $workboard->workingDays = $day;
                }
                if($day == 'Vie'){
                    $workboard->workingDays = $day;
                }
                if($day == 'Sab'){
                    $workboard->workingDays = $day;
                }
                if($day == 'Dom'){
                    $workboard->workingDays = $day;
                }

                $workboard->workingHours = number_format(($totalDuration / 60), 0, '.', ',');
                $workboard->labInformation = $id;
                $workboard->start = $request->start;
                $workboard->end   = $request->end;

                if($request->fixed == 'fixed'){
                    $workboard->fixed_schedule = 'True';
                }
                $workboard->patient_duration_attention =  json_encode($horas);
                $workboard->oldnew = 'new';
                $workboard->save();
                
            }
        } 

        if ($request->type == 'true')  {
            
            $json = json_decode($request->vardays);
            
            foreach ($json as $json2) {

                $horas = array();
                $startTime = Carbon::parse($json2->start);
                $finishTime = Carbon::parse($json2->end);
                $totalDuration = $finishTime->diffInMinutes($startTime);
                $consultation = $request->prom - 5;
                $totalconsultation = number_format(($totalDuration / $consultation), 0, '.', ',');
                $hora_inicio = new \DateTime(  $startTime );
                $hora_fin    = new \DateTime(  $finishTime );
                $hora_fin->modify('+1 second'); // Añadimos 1 segundo para que nos muestre $hora_fin

                // Establecemos el intervalo en minutos        
                $intervalo = new \DateInterval('PT'.$consultation.'M');
                // Sacamos los periodos entre las horas
                $periodo   = new \DatePeriod($hora_inicio, $intervalo, $hora_fin);        
                foreach( $periodo as $hora ) {
                    // Guardamos las horas intervalos 
                    $horas[] =  $hora->format('H:i:s');
                }
                $timeend = Carbon::parse(\end($horas)); 
                if($timeend !=  $finishTime){
                     $timedeath = $finishTime->diffInMinutes($timeend);
                     array_push($horas, "asueto :".$timedeath);
                }
       
                 $workboard = new workboard;
                 $workboard->workingHours = number_format(($totalDuration / 60), 0, '.', ',');
                 $workboard->workingDays = $json2->day;
                 $workboard->start = $json2->start;
                 $workboard->end   = $json2->end;
                 $workboard->labInformation = $id;
                 $workboard->patient_duration_attention =  json_encode($horas);
                 $workboard->fixed_schedule = 'False';
                 $workboard->oldnew = 'new';
                 $workboard->save();

                 


            }
        }
        $workboard2 = DB::table('workboard')->where('workboard.labInformation', '=', $id)->where('oldnew', 'old')->get();
        $workboardNew = DB::table('workboard')->where('workboard.labInformation', '=', $id)->where('oldnew', 'new')->get();
        $workArray = array();
        
        foreach($workboard2  as $work){
            array_push($workArray, $work->workingDays.':'.$work->patient_duration_attention);
        }
        
        return redirect('workboardDr/index/'.$id);
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


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('workboardDr/index'); //show
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


    /**
     * Function handle for cancel appointments for change horary
     * 
     * @param 
     * @return  [<description>]
     */
    public function handleExistAppointments($id){

        $appointments = DB::table('medical_appointments')
                        ->join('users', 'medical_appointments.user', '=', 'users.id')
                        ->where('workplace',$id)->wheredate('when', '>', Carbon::today())
                        ->select('medical_appointments.*', 'users.name', 'users.profile_photo')
                        ->get();

        if(count($appointments) > 0){
            foreach($appointments as $app){
                $app->when;
            }
            return $appointments;
         }  
         else{ 
            return 'null';
         }
    }
    
}