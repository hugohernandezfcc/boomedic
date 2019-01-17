<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Conversations;
use App\Items_Conversations;
use Carbon\Carbon;
use App\transaction_bank;


class PaymentsDoctor extends Controller
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
    public function show(){
        $user = User::find(Auth::id());
        $countowed = 0;
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
                            if($tr->type_doctor == 'Owed')
                                $countowed = $countowed + $tr->amount;
                            if($tr->type_doctor == 'Paid')
                                $countpaid = $countpaid + $tr->amount;
                        }
        
        return view('paymentsdoctor', [
                'userId'        => $user->id,
                'username'      => $user->username,
                'name'          => $user->name,
                'photo'         => $user->profile_photo,
                'date'          => $user->created_at,
                'transaction'   => $transactions,
                'paid'          => number_format($countpaid,2),
                'owed'          => number_format($countowed,2)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('PaymentsDr/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }
}
