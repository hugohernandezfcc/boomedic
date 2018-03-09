<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\clinic_history;
use App\answers_clinic_history;
use App\questions_clinic_history;


class clinicHistory extends Controller
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
        $clinic_history = DB::table('clinic_history')->get();
        $question = DB::table('questions_clinic_history')
            ->join('answers_clinic_history', 'questions_clinic_history.id', '=', 'answers_clinic_history.question')
            ->select('answers_clinic_history.answer', 'questions_clinic_history.question', 'questions_clinic_history.id', 'answers_clinic_history.id AS a')
            ->get();


        return view('clinicHistory', [
                'userId'            => $user->id,
                'username'          => $user->username,
                'name'              => $user->name,
                'photo'             => $user->profile_photo,
                'date'              => $user->created_at,
                'questions'         => $question,
                'clinic_history'    => $clinic_history,
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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('clinicHistory/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
  {     $user = User::find(Auth::id());

        $json = json_decode($request);
        $answers = json_decode($request->answers);
        $q = DB::table('questions_clinic_history')->where('id', $request->question)->first();

        $history = DB::table('clinic_history')->where('userid', Auth::id())->get();
        if(!$history){
            $clinic = new clinic_history;
            $clinic->userid = Auth::id();
            $clinic->question_id =  $request->question;
            $clinic->question = $q->question;
            $clinic->answer = $request->answers;
            $clinic->answer_Id = $request->ansId;
            $clinic->save();
        }

        return response()->json($request->answers);

    }

    
}
