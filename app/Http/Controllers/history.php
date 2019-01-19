<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;



class history extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       $user = User::find(Auth::id());
       $count = Session(['history' => '7']);
       $i= 0;

       while($this->historyHelper($count, Auth::id()) == "null")
       {
        $i++;
          $count = session()->get('history') + 7;
          Session(['history' => $count]);
          $new = $this->historyHelper($count, Auth::id());
            if($new != "null"){
                break;
            }
            if($i == 25){
                break;
            }
       }
     if($i > 0){
       if($new == "null"){
           $array1 = collect();
           $array2 = collect();
           $array3 = collect();
           $array4 = collect();
           $array5 = collect();
           $array6 = collect();
           $arraynow = collect();
          return  view('history',
                         [
                            'userId'     => $user->id,
                            'username'   => $user->username,
                            'name'       => $user->name,
                            'photo'      => $user->profile_photo,
                             'date'      => $user->created_at,
                            'array2'     => $array2,
                            'array1'     => $array1,
                            'array3'     => $array3,
                            'array4'     => $array4,
                            'array5'     => $array5,
                            'array6'     => $array6,
                            'arraynow'   => $arraynow,
                            'mode'       => 'null',
                         ]
                         );
       }else{
          $data = $new;
          return view('history', [
                            'userId'     => $user->id,
                            'username'   => $user->username,
                            'name'       => $user->name,
                            'photo'      => $user->profile_photo,
                            'date'      => $user->created_at
                           ]
                           )->with($data);
      }
    }else{
      $data = $this->historyHelper($count, Auth::id());
          return view('history',[
                            'userId'     => $user->id,
                            'username'   => $user->username,
                            'name'       => $user->name,
                            'photo'      => $user->profile_photo,
                            'date'      => $user->created_at
                           ]
                           )->with($data);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function moredays(){
       $user = User::find(Auth::id());
       $count = session()->get('history') + 7;
       Session(['history' => $count]);
       $i= 0;

       while($this->historyHelper($count, Auth::id()) == "null")
       {
        $i++;
          $count = session()->get('history') + 7;
          Session(['history' => $count]);
          $new = $this->historyHelper($count, Auth::id());
            if($new != "null"){
                break;
            }
            if($i == 25){
                break;
            }
       }
     if($i > 0){
       if($new == "null"){

           $array1 = collect();
           $array2 = collect();
           $array3 = collect();
           $array4 = collect();
           $array5 = collect();
           $array6 = collect();
           $arraynow = collect();
          return  view('history',
                         [
                            'userId'      => $user->id,
                            'username'    => $user->username,
                            'name'        => $user->name,
                            'photo'       => $user->profile_photo,
                             'date'       => $user->created_at,
                            'array2'      => $array2,
                            'array1'      => $array1,
                            'array3'      => $array3,
                            'array4'      => $array4,
                            'array5'      => $array5,
                            'array6'      => $array6,
                            'arraynow'    => $arraynow,
                            'mode'        => 'null',
                         ]
                         );
       }else{
        $data = $new;
          return view('history',[
                            'userId'     => $user->id,
                            'username'   => $user->username,
                            'name'       => $user->name,
                            'photo'      => $user->profile_photo,
                            'date'      => $user->created_at
                           ]
                           )->with($data);
      }
    }else{
      $data = $this->historyHelper($count, Auth::id());
          return view('history',[
                            'userId'     => $user->id,
                            'username'   => $user->username,
                            'name'       => $user->name,
                            'photo'      => $user->profile_photo,
                            'date'      => $user->created_at
                           ]
                           )->with($data);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function iframe($id){

       $count = Session(['history' => '7']);
       $i= 0;

       while($this->historyHelper($count, $id) == "null")
       {
        $i++;
          $count = session()->get('history') + 7;
          Session(['history' => $count]);
          $new = $this->historyHelper($count, $id);
            if($new != "null"){
                break;
            }
            if($i == 25){
                break;
            }
       }
     if($i > 0){
       if($new == "null"){
         $user = User::find($id);
           $array1 = collect();
           $array2 = collect();
           $array3 = collect();
           $array4 = collect();
           $array5 = collect();
           $array6 = collect();
           $arraynow = collect();
          return [
                            'array2'     => $array2,
                            'array1'     => $array1,
                            'array3'     => $array3,
                            'array4'     => $array4,
                            'array5'     => $array5,
                            'array6'     => $array6,
                            'arraynow'   => $arraynow,
                            'mode'       => 'null',
                         ];
       }else{
          return $new;
      }
    }else{
      $data = $this->historyHelper($count, Auth::id());
          return $data;
      }
    }


    public function historyHelper($count, $userid){
      $user = User::find($userid);

       $sumDays = $count;
       Session(['history' => $sumDays]);
       Session(['history2' => Carbon::now()->subDays($sumDays)->format('d-m-Y')]);
       $varnewnow = Carbon::now()->subDays($sumDays);

        $dateUser = DB::table('users')->where('id', $user->id)
           ->where( 'updated_at', '>',  Carbon::now()->subDays($sumDays))
            ->select('id','created_at','updated_at')->get();

        $dateSupport = DB::table('support_tickets')->where('userId', $user->id)
           ->where( 'created_at', '>',  Carbon::now()->subDays($sumDays))
           ->select('id','created_at','updated_at','ticketDescription')->get();

        $datePayment = DB::table('paymentsmethods')->where('owner', $user->id)
           ->where( 'created_at', '>', Carbon::now()->subDays($sumDays))
           ->select('id','created_at','updated_at','provider','cardnumber')->get();


         $dateAppointments = DB::table('medical_appointments')
           ->join('users', 'medical_appointments.user', '=', 'users.id')
           ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
           ->where('medical_appointments.user', $user->id)
           ->where( 'medical_appointments.created_at', '>', Carbon::now()->subDays($sumDays))
           ->select('medical_appointments.id','medical_appointments.created_at','medical_appointments.updated_at','medical_appointments.user_doctor','medical_appointments.when', 'medical_appointments.status', 'labor_information.workplace', 'labor_information.latitude', 'labor_information.longitude')->get();

           $array = collect();
           $array1 = collect();
           $array2 = collect();
           $array3 = collect();
           $array4 = collect();
           $array5 = collect();
           $array6 = collect();
           $arraynow = collect();
           
           foreach($dateSupport as $date){
            $car = new Carbon($date->created_at);
                $array[$date->updated_at]  = collect([
                            'Type'       => 'Support Ticket',
                            'id'         =>  $date->id,
                            'created_at' => $date->created_at,
                            'updated_at' => $date->updated_at,
                            'time'       => $car->diffForHumans(),
                            'des'        => $date->ticketDescription
                            ]);
           }
        foreach($dateUser as $date){
            $car = new Carbon($date->updated_at);
                $array[]  = collect([
                            'Type'       => 'User',
                            'id'         =>  $date->id,
                            'created_at' => $date->created_at,
                            'updated_at' => $date->updated_at,
                            'time'       => $car->diffForHumans(),
                            ]);
           }

           foreach($datePayment as $date){
           /* $dateTransaction = DB::table('transaction_bank')->where('payment', $date)
           ->where( 'created_at', '>', Carbon::now()->subDays(7))
           ->select('id','created_at','updated_at')->get(); */
           $car = new Carbon($date->created_at);

                $array[]  = collect([
                            'Type'       => 'Payment Method',
                            'id'         =>  $date->id,
                            'created_at' => $date->created_at,
                            'updated_at' => $date->updated_at,
                            'time'       => $car->diffForHumans(),
                            'typemethod' => $date->provider,
                            'cardnumber' => $date->cardnumber
                            ]);


           }


          foreach($dateAppointments as $date){
           /* $dateTransaction = DB::table('transaction_bank')->where('payment', $date)
           ->where( 'created_at', '>', Carbon::now()->subDays(7))
           ->select('id','created_at','updated_at')->get(); */
           $car = new Carbon($date->created_at);

                $array[]  = collect([
                            'Type'       => 'Medical Appointments',
                            'id'         =>  $date->id,
                            'created_at' => $date->created_at,
                            'updated_at' => $date->updated_at,
                            'time'       => $car->diffForHumans(),
                            'when'       => $date->when,
                            'workplace' => $date->workplace,
                            'latitude'  => $date->latitude,
                            'longitude'  => $date->longitude,
                            'status'    => $date->status
                            ]);

           }

           $tot = $sumDays - 7;
           foreach($array->sortByDesc('updated_at') as $items){
            //if(Carbon::parse($items['created_at'])->format('d-m-Y') == Carbon::now()->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') == Carbon::now()->format('d-m-Y')){
                //$arraynow[] = $items;
            //}
             if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 1)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') == Carbon::now()->subDays($tot + 1)->format('d-m-Y')){
                $array1[] = $items;
            }
            if(Carbon::parse($items['created_at'])->format('d-m-Y') ==  Carbon::now()->subDays($tot+ 2)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') == Carbon::now()->subDays($tot + 2)->format('d-m-Y')){
                $array2[] = $items;
            }
            if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 3)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 3)->format('d-m-Y')){
                $array3[] = $items;
            }
           if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 4)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 4)->format('d-m-Y')){
                $array4[] = $items;
            }
            if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 5)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 5)->format('d-m-Y')){
                $array5[] = $items;
            }
            if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 6)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 6)->format('d-m-Y')){
                $array6[] = $items;
            }
            if($tot == 0)
             if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') ==  Carbon::now()->format('d-m-Y')){
                $arraynow[] = $items;
            }
            else
            if(Carbon::parse($items['created_at'])->format('d-m-Y') ==   Carbon::now()->subDays($tot + 7)->format('d-m-Y') || Carbon::parse($items['updated_at'])->format('d-m-Y') ==  Carbon::now()->subDays($tot + 7)->format('d-m-Y')){
                $arraynow[] = $items;
            }
           }
                if($arraynow->isEmpty() && $array1->isEmpty() && $array2->isEmpty() && $array3->isEmpty() && $array4->isEmpty() && $array5->isEmpty() && $array6->isEmpty()){
                       return "null";
                }
                else{
                    $data = [
                                'array2'       => $array2,
                                'array1'       => $array1,
                                'array3'       => $array3,
                                'array4'       => $array4,
                                'array5'       => $array5,
                                'array6'       => $array6,
                                'arraynow'     => $arraynow,
                                'mode'         => 'finish'
                             ];
                       return $data; 
                    }   
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('history/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
