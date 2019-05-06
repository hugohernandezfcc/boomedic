<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\devices;
use App\users_devices;

class notficationExecute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notification:send';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an push notification';
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
        $devices_all = DB::table('users_devices')
         ->join('users', 'users_devices.user_id', '=', 'users.id')
         ->join('devices', 'users_devices.user_id', '=', 'users.id')         
         ->select('devices.*','users.name')
         ->get();

        $body = "Bienvenido a Isco";


          if(count($devices_all) > 0){ 
            foreach($devices_all as $dev){
                 $title = "¡Hola " . $dev->name . "!"; 

                    $this->PushNotifications = new PushNotifications;
                    $this->PushNotifications->Sender($dev->token_registration, $body, $title);

                }
             }
        
    }
}