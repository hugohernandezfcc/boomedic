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
          $grap = DB::table('medical_appointments')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where('user_doctor', '=', Auth::id())
            ->select('medical_appointments.*', 'users.id as us', 'users.gender', 'users.age')
            ->get();

            $polig = DB::table('cli_recipes_tests')
            ->join('recipes_tests', 'cli_recipes_tests.recipe_test', '=', 'recipes_tests.id')
            ->join('diagnostics', 'cli_recipes_tests.diagnostic', '=', 'diagnostics.id')
            ->where('diagnostic', '>', 0)
            ->where('recipes_tests.doctor', Auth::id())
            ->select('recipes_tests.patient', 'diagnostics.name', 'cli_recipes_tests.created_at')
            ->get();

                 //Graphic poligone 

                    $arrayPol = array();
                    $arraydis = array();
                        foreach($polig as $poli){
                         if(Carbon::parse($poli->created_at)->format('Y-m') == Carbon::now()->format('Y-m')){
                           array_push($arrayPol, ['y' => Carbon::parse($poli->created_at)->format('Y-m'), $poli->name => '1']);      
                           }
                         if(Carbon::parse($poli->created_at)->format('Y-m') == Carbon::now()->subMonths(1)->format('Y-m')){
                           array_push($arrayPol, ['y' => Carbon::parse($poli->created_at)->format('Y-m'), $poli->name => '1']);      
                           }
                        if(Carbon::parse($poli->created_at)->format('Y-m') == Carbon::now()->subMonths(2)->format('Y-m')){
                           array_push($arrayPol, ['y' => Carbon::parse($poli->created_at)->format('Y-m'), $poli->name => '1']);      
                           }
                           array_push($arraydis,  $poli->name);
                        }

                        
                 //Graphic bar and donuts (ages, genders)   
                    $grap2 = $grap->unique('us');
                    $total = count($grap2);
                    $arrayAge = array();
                    $v = array();
                    $fem = 0;
                    $mas = 0;

                    foreach($grap2 as $gr){
                        if($gr->gender == "female"){
                            $fem = $fem + 1;      
                        }
                       if($gr->gender == "male"){
                            $mas = $mas + 1;   
                        }
                    }
                    $porcentf = (100 * $fem) / $total;
                    $porcentm = (100 * $mas) / $total;
                            //array edades
                            foreach ($grap2 as $gr2) {
                                if($gr2->age){
                                 array_push($arrayAge, $gr2->age);
                                }
                            }
                            //Calculando total por edades array
                            $val = array_count_values($arrayAge);
                            foreach ($val as $val2) {
                                  array_push($v, $val2);   
                            }
                    //End Graphic bar and donuts (ages, genders) 
                

        $user = User::find(Auth::id());

        return view('reports', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'fem'       => $porcentf,
                'mas'       => $porcentm,
                'arrayA'    => json_encode($arrayAge),
                'count'     => json_encode($v),
                'report'    => json_encode($arraydis)
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
