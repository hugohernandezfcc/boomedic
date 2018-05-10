<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Conversations;
use App\Items_Conversations;


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
    public function messages()
    {
         $user = User::find(Auth::id());
         $profInfo = DB::table('professional_information')
                            ->where('user', Auth::id() )
                            ->get();
       if(count($profInfo) == 0){                     
         $messages = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('items_conversations.by', Auth::id())
            ->select('items_conversations.*', 'conversations.name as namec', 'users.profile_photo')
            ->get();
        }else{
         $messages = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->join('users', 'items_conversations.by', '=', 'users.id')
            ->where('coversations.doctor', Auth::id())
            ->select('items_conversations.*', 'conversations.name as namec', 'users.profile_photo')
            ->get();
        }

        $data = array();
        array_push($data, json_decode($messages));
        array_push($data, json_decode($profInfo));    

           return response()->json($data);
       
    }

        public function sendMessages(Request $request)
    {
        $user = User::find(Auth::id());
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
                    return response()->json($item);
                }
            }                   
          }else{
           return response()->json($request);
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
