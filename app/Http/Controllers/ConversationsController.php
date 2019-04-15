<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Conversations;
use App\Items_Conversations;
use Carbon\Carbon;


class ConversationsController extends Controller
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
        
        return view('medicalconsultations', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'gender'    => $user->gender

            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function messages($id)
    {
         $data = array();   
         $data2 = array(); 
         if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
         $user = User::find(Auth::id());
         }
         $profInfo = DB::table('professional_information')
                            ->where('user', $user->id)
                            ->get();
       if(count($profInfo) == 0){                     
         $messages = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('conversations.id_record', $id)
            ->select('items_conversations.*', 'conversations.name as namec', 'conversations.created_at as datec', 'users.profile_photo','conversations.doctor')
            ->orderBy('items_conversations.created_at')
            ->get();

        if(count($messages) > 0){
         $messagesAll = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('items_conversations.by', $messages[0]->by)
            ->where('conversations.doctor',   $messages[0]->doctor)
            ->select('items_conversations.*', 'conversations.name as namec', 'conversations.id_record','conversations.created_at as datec', 'users.profile_photo')
            ->orderBy('items_conversations.created_at')
            ->get(); 
            
        }else{
         $doc = DB::table('medical_appointments')->where('id', $id)->first();               
         $messagesAll = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('items_conversations.by', $user->id)
            ->where('conversations.doctor',   $doc->user_doctor)
            ->select('items_conversations.*', 'conversations.name as namec', 'conversations.id_record','conversations.created_at as datec', 'users.profile_photo')
            ->orderBy('items_conversations.created_at')
            ->get(); 
        }
             $chats = $messagesAll->unique('conversation');   
                    $messagesAll2 = DB::table('items_conversations')
                    ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
                    ->join('users', 'items_conversations.by', '=', 'users.id')
                    ->select('items_conversations.*', 'conversations.name as namec', 'conversations.id_record','conversations.created_at as datec', 'users.profile_photo','conversations.id_record')
                    ->orderBy('items_conversations.created_at')
                    ->get(); 
                foreach($chats as $c){
                    foreach($messagesAll2 as $all){
                        if($c->conversation == $all->conversation){    
                        array_push($data2, $all);
                    }
                    }
                } 

           array_push($data, $data2);

        array_push($data, json_decode($profInfo));        
       
        }else{
               
            $conv= DB::table('conversations')
            ->join('items_conversations', 'conversations.id', '=', 'items_conversations.conversation')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('conversations.doctor', $user->id)
            ->where('items_conversations.by','!=', $user->id)
            ->where( 'items_conversations.created_at', '>', Carbon::now()->subDays(8))
            ->select('conversations.*', 'users.profile_photo', 'users.name as nameu', 'users.id as uid', 'items_conversations.created_at as cre')
            ->orderBy('items_conversations.created_at', 'desc')
            ->get();

            if($id != 0){
                $com = $id;
             }else{
                    if(count($conv) > 0){
                        $com = $conv[0]->id;
                    }else{
                        $com = 0;
                    }  
             }   
            $messages = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('conversations.id', $com)
            ->where( 'items_conversations.created_at', '>', Carbon::now()->subDays(8))
            ->select('items_conversations.*', 'conversations.name as namec', 'conversations.id_record','conversations.created_at as datec', 'users.profile_photo')
            ->orderBy('items_conversations.created_at')
            ->get();
            if(count($messages) > 0){
            $messagesAll = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('items_conversations.by', $messages[0]->by)
            ->where('conversations.doctor',  $user->id)
            ->select('items_conversations.*', 'conversations.name as namec', 'conversations.id_record','conversations.created_at as datec', 'users.profile_photo')
            ->orderBy('items_conversations.created_at')
            ->get(); 
             $chats = $messagesAll->unique('conversation');   
                    $messagesAll2 = DB::table('items_conversations')
                    ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
                    ->join('users', 'items_conversations.by', '=', 'users.id')
                    ->select('items_conversations.*', 'conversations.name as namec', 'conversations.id_record','conversations.created_at as datec', 'users.profile_photo','conversations.id_record')
                    ->orderBy('items_conversations.created_at')
                    ->get(); 
                foreach($chats as $c){
                    foreach($messagesAll2 as $all){
                        if($c->conversation == $all->conversation){    
                            array_push($data2, $all);
                        }
                    }
                } 
            array_push($data, $data2);
                }else{
                    array_push($data, json_decode($messages));
                }
            $conversations2 = $conv->unique('uid');   
            array_push($data, json_decode($profInfo));
            array_push($data, $conversations2->values()->all()); 
        }
           return response()->json($data); 
    }

        public function sendMessages(Request $request)
    {
          if(session()->get('utype') == "assistant"){
           $user = User::find(session()->get('asdr'));
         }else{  
         $user = User::find(Auth::id());
         }
          $exist = DB::table('conversations')->where('id_record', $request->id_record)->get();
          if(count($exist) == 0){
            $Conversation              = new Conversations;
            $Conversation->name        = $request->name_mess;
            $Conversation->table       = $request->table;
            $Conversation->id_record   = $request->id_record;
            $Conversation->doctor      = $request->doc;
            if($Conversation->save()){
                $item               = new Items_Conversations;
                $item->by           = $user->id;
                $item->name         = $user->name;
                $item->conversation = $Conversation->id;
                $item->type         = "Answer";
                $item->text_body    = $request->textbody;
                if($item->save()){
                   $message = DB::table('items_conversations')
                    ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
                    ->join('users', 'items_conversations.by', '=', 'users.id')
                    ->where('items_conversations.id', $item->id)
                    ->select('items_conversations.*', 'conversations.name as namec', 'conversations.created_at as datec', 'users.profile_photo')
                    ->get();
                    return response()->json($message);
                }
            }                   
          }else{
                $item2               = new Items_Conversations;
                $item2->by           = $user->id;
                $item2->name         = $user->name;
                $item2->conversation = $exist[0]->id;
                $item2->type         = "Answer";
                $item2->text_body    = $request->textbody;
                if($item2->save()){
               $message = DB::table('items_conversations')
                    ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
                    ->join('users', 'items_conversations.by', '=', 'users.id')
                    ->where('items_conversations.id', $item2->id)
                    ->select('items_conversations.*', 'conversations.name as namec', 'conversations.created_at as datec', 'users.profile_photo')
                    ->get();
                    return response()->json($message);
                }else{
           return response()->json($request);
                }
       }
    }



    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('ConversationsController/index'); //show
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
