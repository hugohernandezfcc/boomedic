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

        $user = User::find(Auth::id()); 
        foreach($request->day as $day){   
        $startTime = Carbon::parse($request->start);
        $finishTime = Carbon::parse($request->end);

        $totalDuration = $finishTime->diffInMinutes($startTime);
        $consultation = $request->prom - 5;
        $totalconsultation = number_format(($totalDuration / $consultation), 0, '.', ',');


        $jsonhorary = collect();
        for($i=0; $i < $totalconsultation; $i++){
            if($i == '0'){
            $jsonhorary[$i] = collect([
                            'start' => $request->start,
                            'end' => gmdate('H:i', $request->start) + gmdate('H:i', '00:'.$consultation),
                            'duration' => $consultation
                            ]);
            } else {
                $key = $i-1; 
                            $jsonhorary[$i] = collect([
                            'start' => $jsonhorary[$key]['end'],
                            'end' => date('H:i',$jsonhorary[$key]['end']) + date('H:i', '00:'.$consultation),
                            'duration' => $consultation
                            ]);
            }
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
         $workboard->patient_duration_attention = $jsonhorary->toJson();
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
