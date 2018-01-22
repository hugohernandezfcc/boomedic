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
if ($request->type == '') {

        $user = User::find(Auth::id()); 
        foreach($request->day as $day){   
        $startTime = Carbon::parse($request->start);
        $finishTime = Carbon::parse($request->end);

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
         $workboard->save();
        
        }

} else {
    $jsonstart = json_decode($request->timestart);
    $jsonend = json_decode($request->timeend);
    $jsonprom = json_decode($request->varprom);
    $jsonday = json_decode($vardays->vardays);
         $workboard = new workboard;
        
     
         $workboard->workingDays = $jsonday;

         $workboard->labInformation = $id;
         $workboard->start = $jsonstart;
         $workboard->end   =  $jsonend;   
         $workboard->fixed_schedule = 'False';

         $workboard->patient_duration_attention =  $jsonprom;
         $workboard->save();




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

    
}
