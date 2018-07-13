<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\clinic_history;
use App\answers_clinic_history;
use App\questions_clinic_history;
use App\Http\Controllers\ImapPop3;


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
                $clinic_history = DB::table('clinic_history')
                ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
                ->where('userid', Auth::id())
                ->select('clinic_history.*', 'questions_clinic_history.text_help', 'questions_clinic_history.type')
                ->get();

        $question = DB::table('questions_clinic_history')
            ->join('answers_clinic_history', 'questions_clinic_history.id', '=', 'answers_clinic_history.question')
            ->where('answers_clinic_history.question','!=', null)
            ->select('answers_clinic_history.answer', 'answers_clinic_history.parent', 'answers_clinic_history.parent_answer','questions_clinic_history.question', 'questions_clinic_history.id', 'answers_clinic_history.id AS a')
            ->get();

        $test_result = DB::table('diagnostic_test_result')
        ->join('diagnostic_tests', 'diagnostic_test_result.diagnostic_test', '=', 'diagnostic_tests.id')
        ->join('recipes_tests', 'diagnostic_test_result.recipes_test', '=', 'recipes_tests.id')
        ->join('users', 'recipes_tests.doctor', '=', 'users.id')
        ->where('diagnostic_test_result.patient', Auth::id())
        ->select('diagnostic_test_result.*', 'diagnostic_tests.name', 'users.name as doc', 'recipes_tests.doctor', 'recipes_tests.folio')
        ->get();  
            
        $question_parent = DB::table('answers_clinic_history')->get();

        if(count($clinic_history) == 0){
            $mode = "null";
        } else{
            $mode = "finish";
        }
        return view('clinicHistory', [
                'userId'            => $user->id,
                'username'          => $user->username,
                'name'              => $user->name,
                'photo'             => $user->profile_photo,
                'date'              => $user->created_at,
                'questions'         => $question,
                'questions_parent'  => $question_parent,
                'clinic_history'    => $clinic_history,
                'test_result'       => $test_result,
                'mode'              => $mode,
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
            ->select('answers_clinic_history.answer', 'answers_clinic_history.parent', 'answers_clinic_history.parent_answer','questions_clinic_history.question', 'questions_clinic_history.id', 'answers_clinic_history.id AS a')
            ->get();
        $test_result = DB::table('diagnostic_test_result')
        ->join('diagnostic_tests', 'diagnostic_test_result.diagnostic_test', '=', 'diagnostic_tests.id')
        ->join('recipes_tests', 'diagnostic_test_result.recipes_test', '=', 'recipes_tests.id')
        ->join('users', 'recipes_tests.doctor', '=', 'users.id')
        ->where('diagnostic_test_result.patient', Auth::id())
        ->select('diagnostic_test_result.*', 'diagnostic_tests.name', 'users.name as doc', 'recipes_tests.doctor', 'recipes_tests.folio')
        ->get();    
        
        $question_parent = DB::table('answers_clinic_history')->get();
        return view('clinicHistory', [
                'userId'            => $user->id,
                'username'          => $user->username,
                'name'              => $user->name,
                'photo'             => $user->profile_photo,
                'date'              => $user->created_at,
                'questions'         => $question,
                'clinic_history'    => $clinic_history,
                'test_result'       => $test_result,
                'questions_parent'  => $question_parent,
                'mode'              => 'finish'
            ]
        );
    
    }

        public function imbox()
    {
        $user = User::find(Auth::id());
        $this->imapPop3 = new imapPop3;
        $host = 'fastcodecloud.com';
        $port = '110';
        $mbox = $this->imapPop3->connect($host, $port, "contactoboomedic@fastcodecloud.com", "adfm90f1m3f0m0adf");
        if($mbox){
        $count =  $this->imapPop3->count($mbox);
        $attach = $this->imapPop3->attachment($mbox);
        }

        return view('imbox', [
                'userId'            => $user->id,
                'username'          => $user->username,
                'name'              => $user->name,
                'photo'             => $user->profile_photo,
                'date'              => $user->created_at,
                'count'             => $count,
                'files'             => $attach
            ]
        );
    
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $user = User::find(Auth::id());
        if($id == '0'){
        $clinic_history = DB::table('clinic_history')
        ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
        ->where('userid', Auth::id())
        ->select('clinic_history.*', 'questions_clinic_history.text_help', 'questions_clinic_history.type')
        ->get();

        $question = DB::table('questions_clinic_history')
            ->join('answers_clinic_history', 'questions_clinic_history.id', '=', 'answers_clinic_history.question')
            ->where('answers_clinic_history.question','!=', null)
            ->select('answers_clinic_history.answer', 'answers_clinic_history.parent', 'answers_clinic_history.parent_answer','questions_clinic_history.question', 'questions_clinic_history.id', 'answers_clinic_history.id AS a')
            ->get();
        } else{

        $clinic_history = DB::table('clinic_history')
                ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
                ->where('question_id', $id)
                ->select('clinic_history.*', 'questions_clinic_history.text_help', 'questions_clinic_history.type')
                ->get();

        $question = DB::table('questions_clinic_history')
            ->join('answers_clinic_history', 'questions_clinic_history.id', '=', 'answers_clinic_history.question')
            ->where('questions_clinic_history.id', $id)
            ->select('answers_clinic_history.answer', 'answers_clinic_history.parent', 'answers_clinic_history.parent_answer','questions_clinic_history.question', 'questions_clinic_history.id', 'answers_clinic_history.id AS a')
            ->get();
        }
            
        $question_parent = DB::table('answers_clinic_history')->get();


        return view('clinicHistory', [
                'userId'            => $user->id,
                'username'          => $user->username,
                'name'              => $user->name,
                'photo'             => $user->profile_photo,
                'date'              => $user->created_at,
                'questions'         => $question,
                'questions_parent'  => $question_parent,
                'clinic_history'    => $clinic_history,
                'mode'              => "null"
            ]
        );
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
        $newArray = array();
        $answers = json_decode($request->answers);
            if (in_array("Fallecido", $answers) && in_array("Vivo", $answers)) {
                $z = 1;
               for($i = 0; $i < count($answers); $i++){
                $z = $z++;
                            if($answers[$z] == "Vivo" && $answers[$z] === "Fallecido"){
                                $comp = $answers[$i] . $answers[$z];
                                array_push($newArray, $comp);
                            } else{
                                array_push($newArray, $answers[$i]);
                            }
                         
                      }
                   } 

        if($history){
                $clinic = clinic_history::find($history->id);
                $clinic->answer_id = $request->ansId;
                if(!count($newArray)){
                $clinic->answer = $request->answers;
            }else {
                $clinic->answer = json_encode($newArray);
            }

               
         } else {
            $clinic = new clinic_history;
            $clinic->userid = Auth::id();
            $clinic->question_id =  $request->question;
            $clinic->question = $q->question;
            if(!count($newArray)){
            $clinic->answer = $request->answers;
              }else {
                $clinic->answer = json_encode($newArray);
            }
            $clinic->answer_id = $request->ansId;

                }
         
        if( $clinic->save())        
        return response()->json($clinic->id);

    }

    
}
