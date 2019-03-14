<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\email;
use Mail;
use App\Http\Controllers\Workboard;

class changeWorkboardDr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changeWorkboardDr:send';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change horary to new';
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
            $workboardNew = DB::table('workboard')->where('oldnew', 'new')->get(); 
            $workboardOld = DB::table('workboard')->where('oldnew', 'old')->get(); 
            foreach($workboardNew as $new){
                    foreach($workboardOld as $old){
                        if($new->labInformation == $old->labInformation){
                                DB::table('workboard')->where('id', $old->id)->delete();
                            }
                        }
                        $wnew = workboard::find($new->id);
                        $wnew->oldnew = 'old';
                        $wnew->save();
            }
            
    }
}