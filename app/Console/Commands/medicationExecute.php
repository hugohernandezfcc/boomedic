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
    protected $signature = 'schedule:cron {--queue}';
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
        $this->info('Waiting '. $this->nextMinute(). ' for next run of scheduler');
        sleep($this->nextMinute());
        $this->runScheduler();
    }
    /**
     * Main recurring loop function.
     * Runs the scheduler every minute.
     * If the --queue flag is provided it will run the scheduler as a queue job.
     * Prevents overruns of cron jobs but does mean you need to have capacity to run the scheduler
     * in your queue within 60 seconds.
     *
     */
    protected function runScheduler()
    {
       $user = User::find('3');

        $fn = $this->option('queue') ? 'queue' : 'call';
        $this->info('Running scheduler');

        $data = [
            'name'      => $user->name,
            ]; 
             $email = $user->email;
             Mail::send('emails.medicalTreatment', $data, function ($message) {
                        $message->subject('Recordatorio: tienes un tratamiento que tomar hoy');
                        $message->to('contacto@doitcloud.consulting');
                    });
        Artisan::$fn('schedule:run');
        $this->info('completed, sleeping..');
        sleep($this->nextMinute());
        $this->runScheduler();
    }
    /**
     * Works out seconds until the next minute starts;
     *
     * @return int
     */
    protected function nextMinute()
    {
        $current = Carbon::now();
        return 60 -$current->second;
    }
}