<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\VisaAPIClient;
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
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));


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

        $pmethods->provider      = $request->provider;
        $pmethods->typemethod    = $request->typemethod;
        $pmethods->country       = $request->country;
        $pmethods->year          = $request->year;
        $pmethods->month         = $request->month;
        $pmethods->cvv           = $request->cvv;
        $pmethods->cardnumber    = $request->cardnumber;
        $pmethods->owner         = Auth::id();

        if ( $pmethods->save() ) 
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

    DB::delete('delete from paymentsmethods where id = ?',[$id]) ;
    
    // redirect
    
   return redirect('payment/index');
    }


    //Controller to make payment, Contains type of ROUTE defined post

    public function PaymentAuthorizations(Request $request) {
        $id = $request->id;

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
        
         if($statusCode == '201'){
            $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Pago procesado correctamente por un monto de: '. $request->pay.'$, para más información consulte su cartera de pago...', 
            'success' => 'success'
            );

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

         public function postPayment()
                    {

                        $payer = new Payer();
                        $payer->setPaymentMethod('paypal');

                        $item_1 = new Item();
                        $item_1->setName('Item 1')
                            ->setCurrency('USD')
                            ->setQuantity(2)
                            ->setPrice('15');

                        $item_2 = new Item();
                        $item_2->setName('Item 2')
                            ->setCurrency('USD')
                            ->setQuantity(4)
                            ->setPrice('7');

                        $item_3 = new Item();
                        $item_3->setName('Item 3')
                            ->setCurrency('USD')
                            ->setQuantity(1)
                            ->setPrice('20');

                        // add item to list
                        $item_list = new ItemList();
                        $item_list->setItems(array($item_1, $item_2, $item_3));

                        $amount = new Amount();
                        $amount->setCurrency('USD')
                            ->setTotal(78);

                        $transaction = new Transaction();
                        $transaction->setAmount($amount)
                            ->setItemList($item_list)
                            ->setDescription('Your transaction description');

                        $redirect_urls = new RedirectUrls();
                        $redirect_urls->setReturnUrl(URL::route('payment.status'))
                            ->setCancelUrl(URL::route('payment.status'));

                        $payment = new Payment();
                        $payment->setIntent('Sale')
                            ->setPayer($payer)
                            ->setRedirectUrls($redirect_urls)
                            ->setTransactions(array($transaction));

                        try {
                            $payment->create($this->_api_context);
                        } catch (\PayPal\Exception\PPConnectionException $ex) {
                            if (\Config::get('app.debug')) {
                                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                                $err_data = json_decode($ex->getData(), true);
                                exit;
                            } else {
                                die('Some error occur, sorry for inconvenient');
                            }
                        }

                        foreach($payment->getLinks() as $link) {
                            if($link->getRel() == 'approval_url') {
                                $redirect_url = $link->getHref();
                                break;
                            }
                        }

                        // add payment ID to session
                        Session::put('paypal_payment_id', $payment->getId());

                        if(isset($redirect_url)) {
                            // redirect to paypal
                            return Rredirect('payment/index');
                        }

                        return Redirect::route('original.route')
                            ->with('error', 'Unknown error occurred');
                    }

                public function getPaymentStatus()
                {
                    // Get the payment ID before session clear
                    $payment_id = Session::get('paypal_payment_id');

                    // clear the session payment ID
                    Session::forget('paypal_payment_id');

                    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
                        return Redirect::route('original.route')
                            ->with('error', 'Payment failed');
                    }

                    $payment = Payment::get($payment_id, $this->_api_context);

                    // PaymentExecution object includes information necessary 
                    // to execute a PayPal account payment. 
                    // The payer_id is added to the request query parameters
                    // when the user is redirected from paypal back to your site
                    $execution = new PaymentExecution();
                    $execution->setPayerId(Input::get('PayerID'));

                    //Execute the payment
                    $result = $payment->execute($execution, $this->_api_context);

                    if ($result->getState() == 'approved') { // payment made
                        return Redirect::route('original.route')
                            ->with('success', 'Payment success');
                    }
                    return Redirect::route('original.route')
                        ->with('error', 'Payment failed');
                }
    
}
