<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\privacy_statement;


class privacyStatement extends Controller
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
        $privacyStatement = DB::table('privacy_statement')->orderby('id','DESC')->take(1)->get();
        $StatementForUser = $user->privacy_statement;

        if(is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id)
            $mode = 'Null';
        else 
            $mode = 'Full';
        

        return view('privacyStatement', [
                'privacy'   => $privacyStatement[0],
                'userId'    => $user->id,
                'username'  => $user->username,
                'gender'    => $user->gender,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
                'mode'      => $mode
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
                return redirect('privacyStatement/index'); //show
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
    public function destroy($id)
    {

    DB::delete('delete from privacy_statement where id = ?',[$id]) ;
    
    // redirect
    
        return redirect('privacyStatement/index');
    }

    public function Aceptar()
    {
        $privacyStatement = DB::table('privacy_statement')->orderby('id','DESC')->take(1)->get();
        DB::table('users')->where('id',Auth::id())->update(['privacy_statement' => $privacyStatement[0]->id]);
        $StatementForUser = DB::table('users')->where('id', Auth::id() )->value('privacy_statement');

        if(is_null($StatementForUser))
            $mode = 'Null';
        else 
            $mode = 'Full';
        

        return redirect('medicalconsultations');
    }



    public function Rechazar(){
        \Auth::logout();
        return redirect('/login');
    }
    
}
