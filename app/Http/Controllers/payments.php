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
        $cards = DB::table('paymentsmethods')->where('owner', Auth::id() )->get();

        return view('payments', [
                'cards'     => $cards,
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'photo'  => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
                'mode'      => 'listPaymentMethods'
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


        return view('payments', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'photo'  => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
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

    public function PaymentAuthorizations(Request $request) {

        $id = $request->id;
        $user = User::find(Auth::id());
        //Look in the table of methods of saved payments all the information of the selected method.
        $card = DB::table('paymentsmethods')->where('id', $id)->first();

                    $this->VisaAPIClient = new VisaAPIClient;
                    //Build json with payment details
                    $this->paymentAuthorizationRequest = json_encode ( [ 
                    'amount' => $request->pay,
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
             /* Insert_bank*/
                        $Transaction = new transaction_bank;
                        $Transaction->paymentmethod = $request->id;
                        $Transaction->receiver = 'receiver prueba';
                        $Transaction->amount = $request->pay;
                        $Transaction->transaction = $statusCode[1];
                        $Transaction->save();
                    /* Insert Transaction_bank*/    
            $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Transacción Nro. '.$statusCode[1].'. Pago procesado correctamente por un monto de: $'. $request->pay.', para más información consulte su cartera de pago... ', 
            'success' => 'success'
            );


            $data = [
            'name'     => $user->name,
            'email'    => $user->email, 
            'username'  => $user->username,                 
            'firstname' => $user->firstname,                
            'lastname'  => $user->lastname,    
            'number'   => $statusCode[1],
            'amount'   => '$'.$request->pay         
            ];
                $email = $user->email;
             Mail::send('emails.transaction', $data, function ($message) {
                        $message->subject('Transacción de pago en Boomedic');
                        $message->to('rebbeca.goncalves@doitcloud.consulting');
                    });
            return redirect('payment/index')->with($notification);
         }
         else {
             $notification = array(
                //If it has been rejected, the internal error code is sent.
            'message' => $statusCode, 
            'error' => 'error'
        );
            return redirect('payment/index')->with($notification);
         }
         
     }

     public function transactions(Request $request) {
        $id = $request->id;
        //Look in the table of methods of saved payments all the information of the selected method.
        $transactions = DB::table('transaction_bank')->where('paymentmethod', $id)->get();
        $card = DB::table('paymentsmethods')->where('id', $id)->first();
         return view('payments', [
                'type'      => $card->typemethod,
                'paypal_email'      => $card->paypal_email,
                'cardnumber' => $card->cardnumber,
                'bank' => $card->bank,
                'provider' => $card->provider,
                'credit_debit' => $card->credit_debit,
                'created' => $card->created_at,
                'transactions'     => $transactions,
                'userId'    => Auth::id(),
                'photo'  => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'mode'      => 'historyTransaction'
            ]
        );
                   
         
     }

            public function postPaymentWithpaypal(Request $request)

                {
                    $url = url('/');

                    $payer = new Payer();
                            $payer->setPaymentMethod('paypal');
                            $item_1 = new Item();
                            $item_1->setName('Item 1') /** item name **/
                                ->setCurrency('USD')
                                ->setQuantity(1)
                                ->setPrice($request->get('amount')); /** unit price **/
                            $item_list = new ItemList();
                            $item_list->setItems(array($item_1));
                            $amount = new Amount();
                            $amount->setCurrency('USD')
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
                                    \Session::put('error','Connection timeout');
                                    return redirect('payment/index');
                                    /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                                    /** $err_data = json_decode($ex->getData(), true); **/
                                    /** exit; **/
                                } else {
                                    \Session::put('error','Some error occur, sorry for inconvenient');
                                     return redirect('payment/index');
                                    /** die('Some error occur, sorry for inconvenient'); **/
                                }
                            }

                            foreach($payment->getLinks() as $link) {
                                if($link->getRel() == 'approval_url') {
                                    $redirect_url = $link->getHref();
                                    break;
                                }
                            }
                            /** add payment ID to session **/
                            session()->put('paypal_payment_id', $payment->getId());
                            if(isset($redirect_url)) {
                                /** redirect to paypal **/
                                return redirect($redirect_url);   
                            }
                                 
                            
                            session()->put('error','Unknown error occurred');
                            return redirect('payment/index');

                        }

                public function getPaymentStatus(Request $request)
                        {
                            // Get the payment ID before session clear
                            $payment_id = $request->session()->get('paypal_payment_id');

                            // clear the session payment ID
                            $request->session()->forget('paypal_payment_id');
                            
                            if (empty($request->input('PayerID')) || empty($request->input('token'))) {
                                    session()->put('error','Unknown error occurred');
                              return redirect('payment/index');
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
                                if(empty($paypalExist)){
                                $pmethods = new PaymentMethod;
                                $pmethods->provider      = 'Paypal';
                                $pmethods->typemethod    = 'Paypal';
                                $pmethods->bank         = 'Paypal';
                                $pmethods->paypal_email  = $result->getPayer()->getPayerInfo()->getEmail();
                                $pmethods->cardnumber    = $request->input('PayerID');
                                $pmethods->owner         = Auth::id();
                                $pmethods->notified      = 'false';
                                $pmethods->save();

                              }
                               
                               $paypalExist2 = DB::table('paymentsmethods')->where('cardnumber', $request->input('PayerID'))->where('owner', Auth::id())->first();
                                            $Trans = new transaction_bank;
                                            $Trans->paymentmethod = $paypalExist2->id;
                                            $Trans->receiver = 'receiver prueba';
                                            $Trans->amount = $payment->transactions[0]->amount->total;
                                            $Trans->transaction = $payment_id;
                                            $Trans->save();    
                                        

                              $notification = array(
                                        //If it has been rejected, the internal error code is sent.
                                    'message' => 'Procesado su pago de paypal, Correo: ' .$result->getPayer()->getPayerInfo()->getEmail().', Id de transacción: '. $payment_id, 
                                    'success' => 'success'
                                );
                                $user = User::find(Auth::id());
                                $data = [
                                'name'     => $user->name,
                                'email'    => $user->email, 
                                'username'  => $user->username,                 
                                'firstname' => $user->firstname,                
                                'lastname'  => $user->lastname,    
                                'number'   => $payment_id,
                                'amount'   => '$'.$payment->transactions[0]->amount->total        
                                ];
                                $email = $user->email;
                                 Mail::send('emails.transaction', $data, function ($message) {
                                            $message->subject('Transacción de pago en Boomedic');
                                            $message->to('rebbeca.goncalves@doitcloud.consulting');
                                        });
                              return redirect('payment/index')->with($notification);
                            }
                            
                            session()->put('error','Unknown error occurred');
                            return redirect('payment/index');
                          }

                                         
}
