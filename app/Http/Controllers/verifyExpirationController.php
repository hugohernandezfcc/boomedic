<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\email;
use Mail;

class verifyExpirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$allCards = DB::table('paymentsmethods')->where('month', '<>', '')->get();*/
        /*$allCards = DB::table('paymentsmethods')->whereNotNull('month')
                                                ->whereNotNull('year')
                                                ->get();
        return view('cards', [
                'allCards'     => $allCards,
                'mode'      => 'listCardsExpired'
            ]
        );*/


        $date00 = getdate();
            $month00 = date("n");
            $year00 = date("y");

            /*return dd($month00 . $year00);*/

            $allCards = DB::table('paymentsmethods')->where('month', $month00)
                                                ->where('year', $year00)
                                                ->get();
            return dd($allCards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function index01(){

            $date00 = getdate();
            $month00 = date("n");
            $year00 = date("y");

            /*return dd($month00 . $year00);*/

            $allCards = DB::table('paymentsmethods')->where('month', $month00)
                                                ->where('year', $year00)
                                                ->get();

            if (count($allCards) >0 ) {
                foreach($allCards as $card) {
                    $user = User::find($card->owner);

                    $data = [
                        'name'     => $user->name,
                        'email'    => $user->email,
                        'age'     => $user->age,                 
                        'gender'    => $user->gender,
                        'occupation'=> $user->occupation,
                        'country'   => $user->country,    
                        'state'     => $user->state,                    
                        'delegation'    => $user->delegation,               
                        'colony'    => $user->colony,                   
                        'street'    => $user->street,                   
                        'mobile'     => $user->mobile,
                        'username'  => $user->username,                 
                        'firstname' => $user->firstname,                
                        'lastname'  => $user->lastname,                
                        'streetnumber'  => $user->streetnumber,           
                        'interiornumber'    => $user->interiornumber,       
                        'postalcode'    => $user->postalcode,
                        'dateExpM'   =>  $card->month,
                        'dateExpY'   =>  $card->year
                    ];

                    Mail::send('emails.card', $data, function ($message) {
                        $message->subject('Tarjeta próxima a vencer');
                        $message->to('cristina@doitcloud.consulting');
                    });

                    $emailS = new email();
                    $emailS->userId      = $user->id;
                    $emailS->email       = $user->name;
                    $emailS->date        = $date00;
                    $emailS->subject     = 'Tarjeta próxima a vencer';
                    $emailS->message     = "Se le notifica que su tarjeta se encuentra próxima a vencer el". $card->month."/".$card->year."cómo método de pago para Boomedic.";
                    $emailS->save();
                }
            }

            return view('cards', [
                    'allCards'     => $allCards,
                    'mode'      => 'listCardsExpired'
                ]
            );
    }
}
