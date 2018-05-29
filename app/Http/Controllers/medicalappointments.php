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
                        $Transaction->save();
                    /* Insert Transaction_bank*/    
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
            'transaccion' => '(Pendiente por ejecutar)',
            'card'        => $cardfin,
            'idcard'      => $card->id,
            'spe'         => $request->spe,
            'work'        => $work->workplace
            );


            $data = [
            'name'      => $user->name,
            'email'     => $user->email, 
            'username'  => $user->username,                 
            'firstname' => $user->firstname,                
            'lastname'  => $user->lastname,    
            'number'    => '(Pendiente por ejecutar)',
            'amount'    => '$'.$request->amount       
            ]; 
                $email = $user->email;
             Mail::send('emails.transaction', $data, function ($message) {
                        $message->subject('Transacción de pago en Boomedic');
                        $message->to('contacto@doitcloud.consulting');
                    });
         
            return redirect('medicalconsultations')->with($notification);
         }
         else {
             $notification = array(
                //If it has been rejected, the internal error code is sent.
            'message' => $statusCode, 
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
        return response()->json(
            DB::table('paymentsmethods')->where('owner', Auth::id() )->get()
        );
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
        $medical = menu::find('21');

        $medical->url = 'reports/redirecting/index';

        if ($medical->save()) 
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
