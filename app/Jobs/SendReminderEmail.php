<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\email;
use Mail;

class SendReminderEmail
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $schedule->call(function () {
            $date00 = getdate();
            $month00 = $date00[month];
            $year00 =$date00[year];

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
            }
        });
    }
}
