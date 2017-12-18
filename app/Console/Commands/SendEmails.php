<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\email;
use Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to the user when its card is next to expire';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date00 = getdate();
        $day00 = date("d");
        $month00 = date("n");
        $year00 = date("y");

        /*return dd($month00 . $year00);*/

        $allCards = DB::table('paymentsmethods')->where('month', $month00)
                                            ->where('year', $year00)
                                            ->get();

        if (count($allCards) >0 ) {
            foreach($allCards as $card) {
                if($card->notified == FALSE){
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
                    $emailS->email       = $user->email;
                    $emailS->recipient   = $user->name;
                    $emailS->date        = date("Y")."-".date("n")."-".date("d");
                    $emailS->subject     = 'Tarjeta próxima a vencer';
                    $emailS->message     = "Se le notifica que su tarjeta se encuentra próxima a vencer el ". $card->month."/".$card->year." cómo método de pago para Boomedic";
                    $emailS->save();
                    
                    $card01 = PaymentMethod::find($card->id);
                    $card01->notified = TRUE;
                    $card01->save();
                }
            }
        }

        /*return view('cards', [
                'allCards'     => $allCards,
                'mode'      => 'listCardsExpired'
            ]
        );*/
    }
}
