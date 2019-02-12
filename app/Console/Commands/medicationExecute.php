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
            ->select('medications.*', 'medicines.name as name_medicine', 'recipes_tests.date', 'cli_recipes_tests.frequency_days', 'cli_recipes_tests.posology', 'recipes_tests.id as rid')->get(); 
        foreach($medication as $med){    
            $arrayhour = array();
            $datehour[0] = Carbon::parse($med->start_date);
            $countact = 0;
            $countinac = 0;
            $formula =  ($med->frequency_days * 24) / 8;
                for($i = 0; $i < $formula; $i++){
                    if($i > 0){
                        $ineg = $i-1;
                        $datehour[$i] = $datehour[$ineg]->addHour(8);
                    }    
                    $this->info($datehour[$i]);
                    if(Carbon::now()->timezone('America/Mexico_City') > $datehour[$i])
                           $countact = $countact + 1;
                    else{ 
                           $countinac = $countinac + 1;
                           if(Carbon::now()->timezone('America/Mexico_City')->subMinutes(5) > $datehour[$i] && Carbon::now()->timezone('America/Mexico_City')->addMinutes(5) < $datehour[$i]){
                                       $data = [
                                              'name' => 'Rebbeca Goncalves',
                                            ]; 
                                           
                                       Mail::send('emails.medicalTreatment', $data, function ($message) {
                                                    $message->subject('Recordatorio: tienes un tratamiento que tomar...');
                                                    $message->to('contacto@doitcloud.consulting');
                                                });
                           }
                       }    
                }

                $Change = Medications::find($med->id);
                $Change->scheduller_active = $countact;
                $Change->scheduller_inactive = $countinac;
                if($countinac == 0)
                   $Change->active = 'Finished';
                $Change->save();
        }
       
    }
}