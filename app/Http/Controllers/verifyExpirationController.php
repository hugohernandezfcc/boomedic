<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
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

            $allCards = DB::table('paymentsmethods')->where('month', 1)
                                                ->where('year', 22)
                                                ->get();

            /*if (empty($allCards)) {
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
                        $message->subject('Tarjeta próxima a vencer.');
                        $message->to('cristina@doitcloud.consulting');
                    });
                }
            };

            return view('cards', [
                    'allCards'     => $allCards,
                    'mode'      => 'listCardsExpired'
                ]
            );*/
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

            $allCards = DB::table('paymentsmethods')->whereNotNull('month')
                                                ->whereNotNull('year')
                                                ->where('month', $month00)
                                                ->where('year', $year00)
                                                ->get();

            if (empty($allCards)) {
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
                        $message->subject('Tarjeta próxima a vencer.');
                        $message->to('cristina@doitcloud.consulting');
                    });
                }
            };

            return dd("Creado");
    }
}
