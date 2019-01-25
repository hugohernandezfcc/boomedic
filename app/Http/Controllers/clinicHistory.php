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
use App\diagnostic_test_result;
use Mail;
use email;
use Mailgun\Mailgun;
use App\Medications;


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
            $data = $this->helperIndex($user);
        return view('clinicHistory',[
                            'userId'     => $user->id,
                            'username'   => $user->username,
                            'name'       => $user->name,
                            'photo'      => $user->profile_photo,
                            'date'      => $user->created_at
                           ]
                           )->with($data);

    }

     /**
     * Display a listing of the resource helper to index.
     *
     * @return \Illuminate\Http\Response
     */
    public function helperIndex($user){

        $clinic_history = DB::table('clinic_history')
        ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
        ->where('userid', $user->id)
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
        ->where('diagnostic_test_result.patient', $user->id)
        ->select('diagnostic_test_result.*', 'diagnostic_tests.name', 'users.name as doc', 'recipes_tests.doctor', 'recipes_tests.folio')
        ->get();  

            
        $question_parent = DB::table('answers_clinic_history')->get();
            /* ----------Files of inbox function store s3 pop3-------------- */
             /*          $this->imapPop3 = new imapPop3;
                        $host = 'iscoapp.com';
                        $port = '110';
                        $mbox = $this->imapPop3->connect($host, $port, $user->username, "adfm90f1m3f0m0adf");
                        if($mbox){
                            $count =  $this->imapPop3->count($mbox);
                            $attach = $this->imapPop3->attachment($mbox, $user->id);

                                   
                                        foreach($attach as $array){ 
                                            $c = DB::table('diagnostic_test_result')
                                            ->where('patient','=', $user->id)
                                            ->where('url','=', $array['path'])->get();
                                            if(count($c) == 0){                             
                                               $new_result = new diagnostic_test_result;
                                               $new_result->url =  $array['path'];
                                               $new_result->email =  $array['from'];
                                               $new_result->details =  $array['filename'];
                                               $new_result->patient =  $user->id;
                                               //$new_result->header_email =  json_encode($array['header']);
                                               $new_result->body_email =  json_encode($array['body']);
                                               //$new_result->structure_email =  json_encode($array['structure']);
                                               $new_result->date_email =  $array['date'];
                                               $new_result->subject_email =  $array['subject'];
                                               $new_result->text_email =  $array['message'];
                                               $new_result->save();

                                            }
                                        }
                                

                           //print_r($result2);


                        }*/
                          $result = DB::table('diagnostic_test_result')->where('patient','=', $user->id)->where('diagnostic_test','=',null)->get();   
                           $result2 = $result->groupBy('date_email'); 

           
        if(count($clinic_history) == 0){
            $mode = "null";
        } else{
            $mode = "finish";
        }
        return  [
                'questions'         => $question,
                'email'             => $user->email,
                'questions_parent'  => $question_parent,
                'clinic_history'    => $clinic_history,
                'test_result'       => $test_result,
                'mode'              => $mode,
                'files'             => $result2,
                'count'             => count($result)
            ];
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


        $history = DB::table('clinic_history')->where('userid', $user->id)->orWhere('question_id', '1')->first();


        if($history){
                $history2 = clinic_history::find($history->id);
                $history2->answer = '["papa"]';
                $history2->answer_id = '3';
                $history2->save();
         } else {
            $clinic = new clinic_history;
            $clinic->userid = $user->id;
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
                ->where('userid', $user->id)
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
        ->where('diagnostic_test_result.patient', $user->id)
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
                'email'             => $user->email,
                'clinic_history'    => $clinic_history,
                'test_result'       => $test_result,
                'questions_parent'  => $question_parent,
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
    public function edit(Request $request, $id)
    {
      $user = User::find(Auth::id());
        if($id == '0'){
        $clinic_history = DB::table('clinic_history')
        ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
        ->where('userid', $user->id)
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
                ->where('userid', $user->id)
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
                'email'             => $user->email,
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
        ->where('userid', $user->id)->where('question_id', $request->question)->first();
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
                if(count($newArray) == 0){
                $clinic->answer = $request->answers;
            }else {
                $clinic->answer = json_encode($newArray);
            }

               
         } else {
            $clinic = new clinic_history;
            $clinic->userid = $user->id;
            $clinic->question_id =  $request->question;
            $clinic->question = $q->question;
            if(count($newArray) == 0){
            $clinic->answer = $request->answers;
              }else {
                $clinic->answer = json_encode($newArray);
            }
            $clinic->answer_id = $request->ansId;

                }
         
        if($clinic->save())        
        return response()->json($clinic->id);

    }
     /**
     * Method responsable of sender email
     */
    public function reSender($id)
      { 
         $user = User::find(Auth::id());
         $diagnostic_test = diagnostic_test_result::find($id);
         $email = $user->email;
           $data = [
            'name'      => $user->name,
            'email'     => $user->email, 
            'username'  => $user->username,                 
            'url'       => $diagnostic_test->url,
            'filename'  => $diagnostic_test->details, 
            'from'      => $diagnostic_test->email,
            'subject'   => $diagnostic_test->subject_email,
            'date'      => $diagnostic_test->date_email
            ]; 
            Mail::send('emails.sendResult', $data, function ($message) {
                        $message->subject('Reenvío: adjunto (Test 1)');
                        $message->to('contacto@doitcloud.consulting');
                    });
             return response()->json($id);
      }

          /**
     * ConfirmMedication a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmMedication(Request $request)
    {
        $user = User::find(Auth::id());


        $medication = DB::table('medications')->get();

        $recipe_id = json_decode($request->id);

            foreach($recipe_id as $rec){
                foreach($medication as $med){
                     if($rec == $med->id){
                         $change = Medications::find($rec);
                         $change->active = 'Confirmed';
                         $change->start_date = json_decode($request->date). ' 00:00:00';
                         $change->save();

                     }
                }
            }

        return response()->json(json_decode($request->id));
    
    }

    
}
