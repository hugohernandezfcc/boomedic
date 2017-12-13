<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ProfessionalInformation;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacyStatement = DB::table('privacy_statement')->orderby('id','DESC')->take(1)->get();
        $StatementForUser = DB::table('users')->where('id', Auth::id() )->value('privacy_statement');
        
        if(is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id){
            $mode = 'Null';
            return view('privacyStatement', [
                    'privacy'   => $privacyStatement[0],
                    'userId'    => Auth::id(),
                    'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                    'photo'     => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
                    'mode'      => $mode
                ]
            );
        }

        $profInfo = DB::table('ProfessionalInformation')
                            ->where('user', Auth::id() )
                            ->get();

        if ($profInfo->count() > 0 && DB::table('users')->where('id', Auth::id() )->value('status') == 'In Progress') 
            return redirect('doctor/edit/In%20Progress');
        

        if(DB::table('users')->where('id', Auth::id() )->value('status') == 'In Progress')
            return redirect('user/edit/In%20Progress');
        
        else {
            return view('medicalconsultations', [
                    'username' => DB::table('users')->where('id', Auth::id() )->value('name'),
                    'userId' => Auth::id()
                ]
            );
        }
    }

}
