<?php

namespace App\Http\Controllers;

use App\User;
use App\assistant;
use Mail;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $assistants = DB::table('assistant')
             ->join('users', 'assistant.user_assist', '=', 'users.id')
             ->where('user_doctor', $user->id)
             ->where('user_assist', $id)
             ->select('assistant.*', 'users.name', 'users.profile_photo', 'users.id as idass')
             ->first();

         $saveAssis = assistant::find($assistants->id);
         $saveAssis->profile = $request->profile;
         $saveAssis->calendar = $request->calendar;           
         $saveAssis->workboard = $request->workboard;
         $saveAssis->chat = $request->chat;
         $saveAssis->assistant = $request->assistant;

                if($saveAssis->save())
                    return response()->json($assistants->name);
                else
                    return response()->json('Error');                   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
