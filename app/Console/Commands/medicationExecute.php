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
    protected $signature = 'medicationExecute:send';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email medication hour';
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
            ->where('medications.active', '=', 'Confirmed')
            ->where('medications.interval_hour', '!=', 1)
            ->select('medications.*', 'medicines.name as name_medicine', 'recipes_tests.date', 'cli_recipes_tests.frequency_days', 'cli_recipes_tests.posology', 'recipes_tests.id as rid')->get(); 


        foreach($medication as $med){    
            $arrayhour = array();
            $datehour = Carbon::parse($med->start_date)->timezone('America/Mexico_City');
            $countact = 0;
            $countinac = 0;
            $current = null;
            $interval = null;

            $formula =  ($med->frequency_days * 24) / 8;

                for($i = 1; $i < $formula; $i++){
                    $datehour = $datehour->addHour(8);
                    array_push($arrayhour, $datehour);
                }
                foreach ($arrayhour as $hour) {
                    if($hour < Carbon::now()->timezone('America/Mexico_City'))
                            $countact = $countact + 1;
                    else {  
                           $countinac = $countinac + 1;
                           if($countinac == 1){
                                 $current = Carbon::now()->timezone('America/Mexico_City')->diffInSeconds($hour);
                                 $interval = 1;
                             }
                           }
                }

                $Change = Medications::find($med->id);
                $Change->scheduller_active = $countact;
                $Change->scheduller_inactive = $countinac;
                $change->interval_hour = $interval;
                $Change->save();
                             if($countinac > 0 && $current != null){
                                    $this->runSchedulersleep($current, $med->id);
                            } 

        }
       
    }

        protected function runSchedulersleep($current, $id)
    {
                                    sleep($current);
                                        $Change = Medications::find($med->id);
                                        $change->interval_hour = 1;
                                        $Change->save();
                                    $data = [
                                              'name' => 'Rebbeca Goncalves',
                                            ]; 
                                           
                                       Mail::send('emails.medicalTreatment', $data, function ($message) {
                                                    $message->subject('Recordatorio: tienes un tratamiento que tomar...');
                                                    $message->to('rebbeca.goncalves@doitcloud.consulting');
                                                });

    }
}