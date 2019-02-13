<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Medications;
use App\email;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\payments;
class medicationExecute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:cron';
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

        $medication = DB::table('medications')
            ->join('cli_recipes_tests', 'medications.recipe_medicines', '=', 'cli_recipes_tests.id')
            ->join('recipes_tests', 'cli_recipes_tests.recipe_test', '=', 'recipes_tests.id')
            ->join('medicines', 'cli_recipes_tests.medicine', '=', 'medicines.id')
            ->join('users', 'recipes_tests.patient', '=', 'users.id')
            ->where('medications.active', '=', 'Confirmed')
            ->select('medications.*', 'medicines.name as name_medicine', 'recipes_tests.date', 'cli_recipes_tests.frequency_days', 'cli_recipes_tests.posology', 'recipes_tests.id as rid', 'users.name as nameu', 'users.email')
            ->get(); 

        foreach($medication as $med){    
            $arrayhour = array();
            $datehour[0] = Carbon::parse($med->start_date);
            $countact = 0;
            $countinac = 0;
            $frequency_time = 24;
            $formula =  ($med->frequency_days * 24) / $frequency_time;
                for($i = 0; $i < $formula; $i++){
                    if($i > 0){
                        $ineg = $i-1;
                        $datehour[$i] = $datehour[$ineg]->addHour($frequency_time);
                    }    
                    
                    if(Carbon::now()->timezone('America/Mexico_City') > $datehour[$i])
                           $countact = $countact + 1;
                    else{ 
                        $this->info($datehour[$i]);
                           $countinac = $countinac + 1;
                           if(Carbon::now()->timezone('America/Mexico_City') > $datehour[$i]->subMinutes(5) && Carbon::now()->timezone('America/Mexico_City') < $datehour[$i]->addMinutes(5)){
                                       $data = [
                                              'name' => $med->nameu,
                                              'medicine' => $med->name_medicine,
                                              'days'     => $med->frequency_days,
                                              'time'     => $frequency_time,
                                              'prescr'   => $datehour[$i],
                                              'start'    => Carbon::parse($med->start_date) 
                                            ]; 

                                       $email = $med->email;     
                                           
                                       Mail::send('emails.medicalTreatment', $data, function ($message) {
                                                    $message->subject('Recordatorio: tienes programado un tratamiento a esta hora');
                                                    $message->to('contacto@doitcloud.consulting');
                                                });
                           }
                           else{
                                    if($countinac == 1)
                                            $nexttime = $datehour[$i];
                                    
                           }
                       }    
                }

                $Change = Medications::find($med->id);
                $Change->scheduller_active = $countact;
                $Change->scheduller_inactive = $countinac;
                if($countinac == 0)
                    $Change->active = 'Finished';
                if($countinac == 1)
                    $Change->next_time = $nexttime;    
                $Change->save();
        }
       
    }
}