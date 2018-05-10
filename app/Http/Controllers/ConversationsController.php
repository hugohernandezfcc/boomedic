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
         $messages = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->where('conversations.doctor', Auth::id())
            ->select('items_conversations.*', 'conversations.name')
            ->get();
        $data = array();
        array_push($data, json_decode($messages));
        array_push($data, json_decode($profInfo));    

           return response()->json($data);
    }

        public function sendMessages()
    {
         $user = User::find(Auth::id());
         $profInfo = DB::table('professional_information')
                            ->where('user', Auth::id() )
                            ->get();
         $messages = DB::table('items_conversations')
            ->join('conversations', 'items_conversations.conversation', '=', 'conversations.id')
            ->where('conversations.doctor', Auth::id())
            ->select('items_conversations.*', 'conversations.name')
            ->get();
        $data = array();
        array_push($data, json_decode($messages));
        array_push($data, json_decode($profInfo));    

           return response()->json($data);
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
