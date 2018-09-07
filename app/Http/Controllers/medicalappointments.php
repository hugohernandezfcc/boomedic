<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\medical_appointments;
use App\menu;
use App\cli_recipes_tests;
use App\transaction_bank;
use config;
use Mail;
use email;
use Mailgun\Mailgun;
use App\PaymentMethod;
use App\Http\Controllers\payments;
use Carbon\Carbon;

class medicalappointments extends Controller
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
        

        return view('medicalappointments', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
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
    public function store(Request $request)
    {

        $id = $request->id;
        $user = User::find(Auth::id());
        //Look in the table of methods of saved payments all the information of the selected method.
        $card = DB::table('paymentsmethods')->where('id', $id)->first();

                    /* Insert Cita */
                    $medical = new medical_appointments();
                    $medical->user           = Auth::id();
                    $medical->user_doctor    = $request->dr;
                    $medical->workplace      = $request->idlabor;
                    $medical->when           = $request->when;
                    $medical->status         = 'Registered';

            
           if ($medical->save()) {
                         /* Insert_bank*/
                        $Transaction = new transaction_bank();
                        $Transaction->paymentmethod = $request->id;
                        $Transaction->receiver = $request->receiver;
                        $Transaction->amount = $request->amount;
                        $Transaction->appointments =  $medical->id;
                        $Transaction->transaction = '(Pendiente por Ejecutar)';
                        $Transaction->save();
                    /* Insert Transaction_bank*/

                    //Validate payment or not
                        if(Carbon::parse($request->when)->format('d-m-Y') == Carbon::now()->format('d-m-Y')){
                            $this->payments = new payments;
                            $this->payments->PaymentAuthorizations($request->id, $Transaction->id);
                            $tr = transaction_bank::find($Transaction->id);
                            $trn = $tr->transaction;
                        }else{
                            $trn = '(Pendiente por ejecutar)';    
                        }  

            $doc = User::find($request->dr); 
            $work = DB::table('labor_information')->where('id', $request->idlabor)->first();    
            $cardfin = substr_replace($card->cardnumber, '••••••••••••', 0, 12);
            $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Transacción (pendiente por ejecutar) por un monto de: $'. $request->amount.', para más información consulte su cartera de pago... ', 
            'success' => 'success',
            'dr'      => $doc->name,
            'drphoto'      => $doc->profile_photo,
            'fecha'   => $request->when,
            'monto'   => $request->amount,
            'transaccion' => $trn,
            'card'        => $cardfin,
            'idcard'      => $card->id,
            'spe'         => $request->spe,
            'work'        => $work->workplace
            );


         
            return redirect('medicalconsultations')->with($notification);
         }
         else {
             $notification = array(
                //If it has been rejected, the internal error code is sent.
            'message' => 'No se pudo guardar la cita, vuelva a intentarlo', 
            'error' => 'error'
        );
            return redirect('medicalconsultations')->with($notification);
         }
         
    }

 /**
     * Method responsable of list of paymentmethods
     */
    public function showPaymentMethods()
    {
        if(session()->get('parental'))
        {
           $user = DB::table('users')->where('username', session()->get('parental'))->first();
             $pay = DB::table('paymentsmethods')
             ->where('owner', Auth::id())
             ->orWhere('owner', $user->id)
             ->get();
        }else{
           $pay =  DB::table('paymentsmethods')->where('owner', Auth::id() )->get(); 
        }
        return response()->json($pay);
    }
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
        $menu = menu::find('33');
        $menu->icon = 'user';
     /*   $menu = new menu();
        $menu->text = 'Agenda';
        $menu->to = 'assistant';
        $menu->typeitem = 'item';
        $menu->order = '2';
        $menu->parent = '1';
        $menu->icon = 'calendar-check-o';
        $menu->url = 'drAppointments/redirecting/index';*/
        if($menu->save()) 
       return redirect('medicalconsultations');
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('medicalappointments/index'); //show
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
