<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Medications;
use App\email;
use Mail;
use App\Http\Controllers\payments;

class medicationExecute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MedicationExecute:send';
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
        $user = User::find('3');
        $data = [
            'name'      => $user->name,
            ]; 
             $email = $user->email;
             Mail::send('emails.medicalTreatment', $data, function ($message) {
                        $message->subject('Recordatorio: tienes un tratamiento que tomar hoy');
                        $message->to('contacto@doitcloud.consulting');
                    });
        
    }
    
}