<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\PaymentMethod;
use App\email;
use Mail;
class paymentExecute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paymentExecute:send';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to payment no procesed';
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
            $transaction_fail = DB::table('transaction_bank')
            ->join('paymentsmethods', 'transaction_bank.paymentmethod', '=', 'paymentsmethods.id')
            ->join('medical_appointments', 'transaction_bank.appointments', '=', 'medical_appointments.id')
            ->join('users', 'medical_appointments.user', '=', 'users.id')
            ->where('transaction_bank.status', 'Failed')
            ->select('transaction_bank.*','paymentsmethods.cardnumber','paymentsmethods.provider', 'users.name', 'users.email','medical_appointments.when')
            ->get();

            if(count($transaction_fail) > 0){ 
            foreach($transaction_fail as $tra){
               $data = [
                        'title'             => 'Pago no procesado',
                        'user'              =>  $tra->name,         
                        'appointments'      =>  $tra->when,
                        'card'              =>  $tra->cardnumber,
                        'provider'          =>  $tra->provider,
                        'amount'            =>  $tra->amount
                    ];
               $email = $tra->email;     

                    Mail::send('emails.errorPayment', $data, function ($message) {
                        $message->subject('Tú pago no fue procesado');
                        $message->to('rebbeca.goncalves@doitcloud.consulting');
                    });
            }
        }

    }
}