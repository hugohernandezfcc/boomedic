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


                    $data = [
                        'title'     => 'Esto es una prueba',
                    ];
                    Mail::send('emails.errorPayment', $data, function ($message) {
                        $message->subject('Tarjeta próxima a vencer');
                        $message->to('rebbeca.goncalves@doitcloud.consulting');
                    });

    }
}