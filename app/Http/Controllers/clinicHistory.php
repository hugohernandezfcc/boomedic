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
                'mode'              => 'null'
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
        $user = User::find(Auth::id());


        $history = DB::table('clinic_history')->where('userid', Auth::id())->orWhere('question_id', '1')->first();


        if($history){
                $history2 = clinic_history::find($history->id);
                $history2->answer = '["papa"]';
                $history2->answer_id = '3';
                $history2->save();
         } else {
            $clinic = new clinic_history;
            $clinic->userid = Auth::id();
            $clinic->question_id =  '1';
            $clinic->question = 'question1';
            $clinic->answer = '["papa"]';
            $clinic->answer_id = '2';
            $clinic->save();
                }

         return redirect('medicalconsultations');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::find(Auth::id());
        $clinic_history = DB::table('clinic_history')
                ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
                ->where('userid', Auth::id())
                ->select('clinic_history.*', 'questions_clinic_history.text_help', 'questions_clinic_history.type')
                ->get();
        $question = DB::table('questions_clinic_history')
            ->join('answers_clinic_history', 'questions_clinic_history.id', '=', 'answers_clinic_history.question')
            ->select('answers_clinic_history.answer', 'questions_clinic_history.question', 'questions_clinic_history.id', 'answers_clinic_history.id AS a')
            ->get();
        $test_result = DB::table('diagnostic_test_result')
        ->join('diagnostic_tests', 'diagnostic_test_result.diagnostic_test', '=', 'diagnostic_tests.id')
        ->join('recipes_tests', 'diagnostic_test_result.recipes_test', '=', 'recipes_tests.id')
        ->join('users', 'recipes_tests.doctor', '=', 'users.id')
        ->where('diagnostic_test_result.patient', Auth::id())
        ->select('diagnostic_test_result.*', 'diagnostic_tests.name', 'users.name as doc', 'recipes_tests.folio')
        ->get();    

        return view('clinicHistory', [
                'userId'            => $user->id,
                'username'          => $user->username,
                'name'              => $user->name,
                'photo'             => $user->profile_photo,
                'date'              => $user->created_at,
                'questions'         => $question,
                'clinic_history'    => $clinic_history,
                'test_result'       => $test_result,
                'mode'              => 'finish'
            ]
        );
    
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

        $q = DB::table('questions_clinic_history')->where('id', $request->question)->first();

        $history = DB::table('clinic_history')
        ->where('userid', Auth::id())->where('question_id', $request->question)->first();
        
        
        if($history){
                $clinic = clinic_history::find($history->id);
                $clinic->answer = $request->answers;
                $clinic->answer_id = $request->ansId;
               
         } else {
            $clinic = new clinic_history;
            $clinic->userid = Auth::id();
            $clinic->question_id =  $request->question;
            $clinic->question = $q->question;
            $clinic->answer = $request->answers;
            $clinic->answer_id = $request->ansId;

                }
         
        if( $clinic->save())        
        return response()->json($clinic->id);

    }

    
}
