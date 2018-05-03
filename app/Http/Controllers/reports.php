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
            $grap2 = $grap->unique('us');
            $total = count($grap2);
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
        $user = User::find(Auth::id());

        return view('reports', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'fem'      => $porcentf,
                'mas'      => $porcentm,

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
