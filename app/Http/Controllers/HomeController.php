<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        
        if(DB::table('users')->where('id', Auth::id() )->value('status') == 'In Progress'){
            return redirect('profile/In%20Progress');
        }else{
            return view('medicalconsultations', [
                    'KEY' => 'Hugo hernández meneses',
                    'userId' => Auth::id()
                ]
            );
        }
    }

}
