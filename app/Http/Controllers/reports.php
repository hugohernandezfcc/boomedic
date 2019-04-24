<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;


class reports extends Controller
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

          $grap = DB::table('medical_appointments')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where('medical_appointments.user_doctor', '=', $user->id)
            ->select('medical_appointments.*', 'users.id as us', 'users.gender', 'users.age')
            ->get();

            $polig = DB::table('cli_recipes_tests')
            ->join('recipes_tests', 'cli_recipes_tests.recipe_test', '=', 'recipes_tests.id')
            ->join('diagnostics', 'cli_recipes_tests.diagnostic', '=', 'diagnostics.id')
            ->where('diagnostic', '>', 0)
            ->where('recipes_tests.doctor', $user->id)
            ->select('recipes_tests.patient', 'diagnostics.name', 'cli_recipes_tests.created_at', 'cli_recipes_tests.id')
            ->get();
            
           $transactions = DB::table('transaction_bank')
            ->join('medical_appointments', 'transaction_bank.appointments', '=', 'medical_appointments.id')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
            ->where('medical_appointments.user_doctor', '=', $user->id)
            ->orderBy('medical_appointments.when', 'desc')
            ->select('transaction_bank.*', 'users.name', 'medical_appointments.when', 'labor_information.workplace as place')
            ->get();


            $workplace = DB::table('medical_appointments')
            ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
            ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
            ->where('medical_appointments.user_doctor', '=', $user->id)
            ->orderBy('medical_appointments.when', 'desc')
            ->select('medical_appointments.*', 'users.name', 'labor_information.workplace as place')
            ->get();

                 //Graphic polligone 
                    $arrayM1 = collect();
                    $arrayM2 = collect();
                    $arrayM3 = collect();
                    $arrayM = collect();
                    $arraydis = array();

                        foreach($polig as $poli){

                           $arrayM1->push(["y" => Carbon::parse($poli->created_at)->format('Y-m'), "name" => $poli->name]);
                           array_push($arraydis, $poli->name);

                        }
                            $arrayM1 = $arrayM1->groupBy('y')->toarray();
                               

                        foreach($arrayM1 as $keyP => $arr){
                                    $arrayM2 = array_count_values(array_column($arrayM1[$keyP], 'name'));
                                    $arrayM3 = array_merge(["y" => $keyP], $arrayM2);
                                    $arrayM->push($arrayM3);


                        }
                        $arrayM = $arrayM->toarray();

                        $arraydis = array_values(array_unique($arraydis));
                //End Graphic polligone  

                 //Graphic bar and donuts (ages, genders)   
                    $grap2 = $grap->unique('us');
                    $total = count($grap2);
                    $arrayAge = array();
                    $v = array();
                    $fem = 0;
                    $mas = 0;
                    $other = 0;
                    $porcentf = 0;
                    $porcentm = 0;
                    $porcento = 0;
                    $arrayAppointments = array();
                    $appo = array();
                    $vAppo = array();

                    foreach($grap2 as $gr){
                        if($gr->gender == "female"){
                            $fem = $fem + 1;      
                        }
                       if($gr->gender == "male"){
                            $mas = $mas + 1;   
                        }
                        if($gr->gender == "other"){
                            $other = $other + 1;   
                        }
                    }

                    if($fem > 0)
                        $porcentf = (100 * $fem) / $total;
                    if($mas > 0)
                        $porcentm = (100 * $mas) / $total;
                    if($other > 0)
                        $porcento = (100 * $other) / $total;


                            //array edades
                            foreach ($grap2 as $gr2) {
                                if($gr2->age){
                                 array_push($arrayAge, $gr2->age);
                                }
                            }

                            //array citas
                            foreach ($grap as $gr) {
                                if(Carbon::parse($gr->when)->format('y-m-d h:s') < Carbon::now()->format('y-m-d h:s')){
                                      if($gr->status == 'Registered')
                                             array_push($arrayAppointments, 'Registradas (N/A)');
                                      if($gr->status == 'No completed')  
                                             array_push($arrayAppointments, 'Canceladas');    
                                      if($gr->status == 'Taked')  
                                             array_push($arrayAppointments, 'Efectuadas');                                            
                                }else{
                                      array_push($arrayAppointments, 'Próximas');
                                }
                            }
                            //Calculando total por edades array
                            $val = array_count_values($arrayAge);
                            $valAppo = array_count_values($arrayAppointments);

                            foreach ($val as $val2) {
                                  array_push($v, $val2);   
                            }

                            foreach ($valAppo as $key => $valApp) {
                                  array_push($vAppo, $valApp);  
                                  array_push($appo, $key);

                            }


                     //Labels dates to medical_appointments status       
                        $dates = collect();
                        foreach ($transactions as $tr) {
                            $dates->push(['when' => Carbon::parse($tr->when)->format('m/Y')]);
                        }
                        $dates = $dates->unique('when');

                     //Labels workplaces - citas
                       $places = array();   
                        foreach ($workplace as $work) {
                           array_push($places, $work->place);
                        }

                        $places = array_values(array_unique($places));
                

        
        return view('reports', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'gender'    => $user->gender,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'fem'       => $fem,
                'mas'       => $mas,
                'oth'       => $other,
                'arrayA'    => json_encode($arrayAge),
                'count'     => json_encode($v),
                'report'    => json_encode($arrayM),
                'dis'       => json_encode($arraydis),
                'arrayAppo' => json_encode($appo),
                'countAppo' => json_encode($vAppo),
                'grap'      => $grap2,
                'balances'  => $transactions,
                'balancedates'  => $dates,
                'workplaces'    => $workplace,
                'places'        => json_encode($places)
            ]
        );
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
                return redirect('reports/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }


    
}
