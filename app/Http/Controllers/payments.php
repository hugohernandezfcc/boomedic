<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\menu;
use App\transaction_bank;
use App\Http\Controllers\VisaAPIClient;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use config;
use Mail;
use email;
use Mailgun\Mailgun;
use App\medical_appointments;

class payments extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_api_context;

    public function __construct()
    {
        $this->middleware('auth');
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential('AbVIn0UOzZZdKIhkGJDVfhvREJTEpxOaL1IxFdohTnXkgkLV-SO9irKdhmLL00tjQJTVIIAD0aIhcau-', 'ECKwqs6svjxoVIY55gw-LBX23jpWUKq6jUqIOh5adCDUhtfDxWAHPxPAWsPJshjXdpZvQK4po-L5buBS'));
        $this->_api_context->setConfig(['mode' => 'sandbox', 'http.ConnectionTimeOut' => 1000,'log.LogEnabled' => false,'log.FileName' => '','log.LogLevel' => 'FINE','validation.level' => 'log']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $cards = DB::table('paymentsmethods')->where('owner', Auth::id() )->get();

        return view('payments', [
                'cards'     => $cards,
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'mode'      => 'listPaymentMethods',
                'gender'    => $user->gender,
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

        $user = User::find(Auth::id());
        return view('payments', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'gender'    => $user->gender,
                'mode'      => 'createPaymentMethod'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pmethods = new PaymentMethod;

        if ($request->typemethod == 'card') {
            # code...
        $pmethods = new PaymentMethod;
        $number = substr($request->cardnumber,0,1);
        $provider = 'Null';

        if($number == '4') 
        {
         $provider ='Visa'; 
        }
        if($number =='5') 
        { 
            $provider ='MasterCard'; 
        }
   
        $pmethods->provider      = $provider;
        $pmethods->typemethod    = $request->typemethod;
        $pmethods->country       = $request->country;
        $pmethods->year          = $request->year;
        $pmethods->month         = $request->month;
        $pmethods->cvv           = $request->cvv;
        $pmethods->cardnumber    = $request->cardnumber;
        $pmethods->bank          = $request->bank;
        $pmethods->credit_debit  = $request->CreDeb;
        $pmethods->notified      = 'false';
        $pmethods->owner         = Auth::id();
        }
    

        if($request->typemethod == 'paypal'){
        $pmethods = new PaymentMethod;
        $pmethods->provider      = 'Paypal';
        $pmethods->typemethod    = $request->typemethod;
        $pmethods->cardnumber    = '0';
        $pmethods->paypal_email  = $request->paypal_email;
        $pmethods->owner         = Auth::id();
        }
        if ($pmethods->save()) 
       return redirect('payment/index');
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
        //
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('payment/index'); //show
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
    DB::delete('delete from transaction_bank where paymentmethod = ?',[$id]) ;    
    DB::delete('delete from paymentsmethods where id = ?',[$id]) ;
    
    // redirect
    
   return redirect('payment/index');
    }


    //Controller to make payment, Contains type of ROUTE defined post

    public function PaymentAuthorizations($idpay, $idtrans) {

        $id = $idpay;

        //Look in the table of methods of saved payments all the information of the selected method.
        $card = PaymentMethod::find($idpay);
        $user = User::find($card->owner);
        $transaction = transaction_bank::find($idtrans);

                    $this->VisaAPIClient = new VisaAPIClient;
                    //Build json with payment details
                    $this->paymentAuthorizationRequest = json_encode ( [ 
                    'amount' => $transaction->amount,
                    'currency' => 'USD',
                    'payment' => [
                      'cardNumber'=> $card->cardnumber,
                      'cardExpirationMonth' => $card->month,
                      'cardExpirationYear' =>  $card->year,
                      'cvn' => $card->cvv
                    ]
                    ] );

                    $baseUrl = 'cybersource/';
                    $resourceP = 'payments/v1/authorizations';
                    //apykey lo proporcionaVISA
                    $queryString = 'apikey=RY6NDJNX3Q2NDWVYUBQW21N37pbnY719X0SqzEs_CDSZbhFro';
                    $statusCode = $this->VisaAPIClient->doXPayTokenCall( 'post', $baseUrl, $resourceP, $queryString, 'Cybersource Payments', $this->paymentAuthorizationRequest);
        
         if($statusCode[0] == '201'){
            $this->AcceptedPayment($transaction, $statusCode[1], $user);
         }

         else {
              $this->RejectedPayment($transaction, $user);  
         }
     }

     
      protected function AcceptedPayment($transaction, $number, $user){
            /* Insert Transaction_bank*/   
            $transaction->transaction = $number;
            $transaction->status =  'Ok';
            $transaction->save();
            /* Insert Transaction_bank*/    

            $data = [
            'name'      => $user->name,
            'email'     => $user->email, 
            'username'  => $user->username,                 
            'firstname' => $user->firstname,                
            'lastname'  => $user->lastname,    
            'number'    => $number,
            'amount'    => '$'.$transaction->amount       
            ]; 
             $email = $user->email;
             Mail::send('emails.transaction', $data, function ($message) {
                        $message->subject('Transacción de pago en Boomedic');
                        $message->to('contacto@doitcloud.consulting');
                    });

      }

    protected function RejectedPayment($transaction, $user){  
             //Save transaction failed
             $transaction->status =  'Failed';
             $transaction->save();

            $transaction_fail = DB::table('transaction_bank')
            ->join('paymentsmethods', 'transaction_bank.paymentmethod', '=', 'paymentsmethods.id')
            ->where('transaction_bank.id', $transaction->id)
            ->select('transaction_bank.*','paymentsmethods.cardnumber','paymentsmethods.provider')
            ->first();
             $data = [
                        'title'             => 'Pago no procesado',
                        'user'              =>  $user->name,         
                        'card'              =>  $transaction_fail->cardnumber,
                        'provider'          =>  $transaction_fail->provider,
                        'amount'            =>  $transaction_fail->amount
                    ];
               $email = $user->email;     

                    Mail::send('emails.errorPayment', $data, function ($message) {
                        $message->subject('Tú pago no fue procesado');
                        $message->to('contacto@doitcloud.consulting');
                    });

    }

    public function transactions(Request $request) {
        $user = User::find(Auth::id());
        $id = $request->id;
        //Look in the table of methods of saved payments all the information of the selected method.
        $transactions = DB::table('transaction_bank')->where('paymentmethod', $id)->get();
        $card = DB::table('paymentsmethods')->where('id', $id)->first();
         return view('payments', [
                'type'              => $card->typemethod,
                'paypal_email'      => $card->paypal_email,
                'cardnumber'        => $card->cardnumber,
                'bank'              => $card->bank,
                'provider'          => $card->provider,
                'credit_debit'      => $card->credit_debit,
                'created'           => $card->created_at,
                'transactions'      => $transactions,
                'userId'            => $user->id,
                'photo'             => $user->profile_photo,
                'username'          => $user->username,
                'gender'    => $user->gender,
                'name'              => $user->name,
                'mode'              => 'historyTransaction',
                'date'              => $user->created_at
            ]
        );
                   
         
     }

            public function postPaymentWithpaypal(Request $request){
                    $url = url('/');

                    $payer = new Payer();
                            $payer->setPaymentMethod('paypal');
                            $item_1 = new Item();
                            $item_1->setName('Consulta') /** item name **/
                                ->setCurrency('MXN')
                                ->setQuantity(1)
                                ->setPrice($request->get('amount')); /** unit price **/
                            $item_list = new ItemList();
                            $item_list->setItems(array($item_1));
                            $amount = new Amount();
                            $amount->setCurrency('MXN')
                                ->setTotal($request->get('amount'));
                            $transaction = new Transaction();
                            $transaction->setAmount($amount)
                                ->setItemList($item_list)
                                ->setDescription('Your transaction description');
                            $redirect_urls = new RedirectUrls();
                            $redirect_urls->setReturnUrl($url.'/payment/getPaymentStatus') /** Specify return URL **/
                                ->setCancelUrl($url.'/medicalconsultations');
                            $payment = new Payment();
                            $payment->setIntent('Sale')
                                ->setPayer($payer)
                                ->setRedirectUrls($redirect_urls)
                                ->setTransactions(array($transaction));
                                /** dd($payment->create($this->_api_context));exit; **/
                            try {
                                $payment->create($this->_api_context);

                            } catch (\PayPal\Exception\PPConnectionException $ex) {
                                if (\Config::get('app.debug')) {
                              $notification2 = array(
                                        //If it has been rejected, the internal error code is sent.
                                    'message' => 'Hubo un error en tiempo de conexión', 
                                    'error' => 'error',
                                );

                            return redirect('medicalconsultations')->with($notification2);
                                } else {
                              $notification2 = array(
                                        //If it has been rejected, the internal error code is sent.
                                    'message' => 'Hubo un error interno en Paypal', 
                                    'error' => 'error',
                                );

                            return redirect('medicalconsultations')->with($notification2);
                                    /** die('Some error occur, sorry for inconvenient'); **/
                                }
                            }

                            foreach($payment->getLinks() as $link) {
                                if($link->getRel() == 'approval_url') {
                                    $redirect_url = $link->getHref();
                                    break;
                                }
                            }
                            $doc = User::find($request->dr); 
                            $work = DB::table('labor_information')->where('id', $request->idlabor)->first();    
                            /** add payment ID to session **/
                            session()->put('paypal_payment_id', $payment->getId());
                            session()->put('receiver', $request->get('receiver'));
                            session()->put('dr', $doc->id);
                            session()->put('monto', $request->amount);
                            session()->put('spe', $request->spe);
                            session()->put('work', $work->workplace);
                            session()->put('drphoto', $doc->profile_photo);
                            session()->put('idlabor', $request->get('idlabor'));
                            session()->put('when', $request->get('when'));


                            if(isset($redirect_url)) {
                                /** redirect to paypal **/
                                return redirect($redirect_url);   
                            }
                                 
                              $notification2 = array(
                                        //If it has been rejected, the internal error code is sent.
                                    'message' => 'Hubo un error en su pago Paypal', 
                                    'error' => 'error',
                                );

                            return redirect('medicalconsultations')->with($notification2);
                        }

                public function getPaymentStatus(Request $request)
                        {
                            // Get the payment ID before session clear
                            $payment_id = $request->session()->get('paypal_payment_id');
                            $receiver = $request->session()->get('receiver');
                            $dr = $request->session()->get('dr');
                            $idlabor = $request->session()->get('idlabor');
                            $when = $request->session()->get('when');
                            $drphoto = $request->session()->get('drphoto');
                            $work = $request->session()->get('work');
                            $monto = $request->session()->get('monto');
                            $spe = $request->session()->get('spe');

                            // clear the session payment ID
                            $request->session()->forget('paypal_payment_id');
                            $request->session()->forget('receiver');
                            $request->session()->forget('when');
                            $request->session()->forget('dr');
                            $request->session()->forget('idlabor');
                            $request->session()->forget('drphoto');
                            $request->session()->forget('work');
                            $request->session()->forget('monto');
                            $request->session()->forget('spe');
                            
                            if (empty($request->input('PayerID')) || empty($request->input('token'))) {
                                    session()->put('error','Unknown error occurred');
                              return redirect('medicalconsultations');
                            }
                            
                            $payment = Payment::get($payment_id, $this->_api_context);
                            
                            // PaymentExecution object includes information necessary
                            // to execute a PayPal account payment.
                            // The payer_id is added to the request query parameters
                            // when the user is redirected from paypal back to your site
                            $execution = new PaymentExecution();
                            $execution->setPayerId($request->input('PayerID'));
                            
                            //Execute the payment
                            $result = $payment->execute($execution, $this->_api_context);
                            
                            if ($result->getState() == 'approved') { // payment made
                              // Payment is successful do your business logic here
                                //Add payment method
                                $paypalExist = DB::table('paymentsmethods')->where('cardnumber', $request->input('PayerID'))->where('owner', Auth::id())->first();

                                if(!$paypalExist){
                                $pmethods = new PaymentMethod;
                                $pmethods->provider      = 'Paypal';
                                $pmethods->typemethod    = 'Paypal';
                                $pmethods->bank          = 'Paypal';
                                $pmethods->paypal_email  = $result->getPayer()->getPayerInfo()->getEmail();
                                $pmethods->cardnumber    = $request->input('PayerID');
                                $pmethods->owner         = Auth::id();
                                $pmethods->notified      = 'false';
                                $pmethods->save();
                                $idp = $pmethods->id;
                              }else{

                               $paypalExist2 = DB::table('paymentsmethods')->where('cardnumber', $request->input('PayerID'))->where('owner', Auth::id())->first();
                            $idp = $paypalExist2->id;
                                   }                /* Insert Cita */
                                        $medical = new medical_appointments;
                                        $medical->user           = Auth::id();
                                        $medical->user_doctor    = $dr;
                                        $medical->workplace       = $idlabor;
                                        $medical->when          = $when;
                                        $medical->status         = 'Registered';
                                
                            if ($medical->save()) {     
                                            $Trans = new transaction_bank;
                                            $Trans->paymentmethod = $idp;
                                            $Trans->receiver = $receiver;
                                            $Trans->amount = $payment->transactions[0]->amount->total;
                                            $Trans->transaction = $payment_id;
                                            $Trans->appointments =  $medical->id;
                                            $Trans->status     =  'Ok';
                                            $Trans->save();        

                              $notification = array(
                                        //If it has been rejected, the internal error code is sent.
                                    'message' => 'Procesado su pago de paypal, Correo: ' .$result->getPayer()->getPayerInfo()->getEmail().', Id de transacción: '. $payment_id, 
                                    'success' => 'success',
                                    'dr'      => $receiver,
                                    'drphoto'      => $drphoto,
                                    'fecha'   => $when,
                                    'monto'   => $monto,
                                    'transaccion' => $payment_id,
                                    'card'        => 'Paypal ' .$result->getPayer()->getPayerInfo()->getEmail(),
                                    'idcard'      => $idp,
                                    'spe'         => $spe,
                                    'work'        => $work
                                );


                                $user = User::find(Auth::id());
                                $data = [
                                'name'      => $user->name,
                                'email'     => $user->email, 
                                'username'  => $user->username,                 
                                'firstname' => $user->firstname,                
                                'lastname'  => $user->lastname,    
                                'gender'    => $user->gender,
                                'number'    => $payment_id,
                                'amount'    => '$'.$payment->transactions[0]->amount->total        
                                ];
                                $email = $user->email;
                                 Mail::send('emails.transaction', $data, function ($message) {
                                            $message->subject('Transacción de pago en Boomedic');
                                            $message->to('contacto@doitcloud.consulting');
                                        });
                             }
                              return redirect('medicalconsultations')->with($notification);
                            }
                              $notification2 = array(
                                        //If it has been rejected, the internal error code is sent.
                                    'message' => 'Hubo un error en su pago Paypal', 
                                    'error' => 'error',
                                );
                            return redirect('medicalconsultations')->with($notification2);
                          }

                                         
}
