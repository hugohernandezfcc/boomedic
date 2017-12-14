<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            $date00 = getdate();
            $month00 = $date00[month];
            $year00 =$date00[year];

            $allCards = DB::table('paymentsmethods')->whereNotNull('month')
                                                ->whereNotNull('year')
                                                ->where('month', $month00);
                                                ->where('year', $year00);
                                                ->get();
            /*return view('cards', [
                    'allCards'     => $allCards,
                    'mode'      => 'listCardsExpired'
                ]
            );*/

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
        })->dailyAt('13:30');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
