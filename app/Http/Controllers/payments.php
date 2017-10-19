<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\VisaAPIClient;

class payments extends Controller
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


    public function PaymentAuthorizations(Request $request) {
        $id = $request->id;
        $card = DB::table('paymentsmethods')->where('id', $id)->first();

                    $this->VisaAPIClient = new VisaAPIClient;
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
                    $queryString = 'apikey=RY6NDJNX3Q2NDWVYUBQW21N37pbnY719X0SqzEs_CDSZbhFro';
                    $statusCode = $this->VisaAPIClient->doXPayTokenCall( 'post', $baseUrl, $resourceP, $queryString, 'Cybersource Payments', $this->paymentAuthorizationRequest);
        
         if($statusCode == '201'){
            //return view(echo '<script type="text/javascript">alert("Pago procesado!");</script>');
            $notification = array(
            'message' => 'Pago procesado correctamente por un monto de: '. $request->pay.'$, para más información consulte su cartera de pago...', 
            'success' => 'success'
            );

            return redirect('payment/index')->with($notification);
         }
         else {
             $notification = array(
            'message' => $statusCode, 
            'error' => 'error'
        );
            return redirect('payment/index')->with($notification);
         }
         
     }
    
}
