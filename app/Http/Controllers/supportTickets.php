<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\SupportTicket;
use Mail;

class supportTickets extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTickets = DB::table('support_tickets')->where('userId', Auth::id() )->get();
        return view('tickets', [
                'allTickets'=> $allTickets,
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'mode'      => 'listTickets'
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
        return view('tickets', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'email'     => DB::table('users')->where('id', Auth::id() )->value('email'),
                'mode'      => 'createTicket'
            ]
        );
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

        $nTicket = new SupportTicket($request->all());        
        $nTicket->userId    = Auth::id();
        $nTicket->status    = 'In Progress';
        $nTicket->user      = $user->name;
        $nTicket->email     = $user->email;
        $nTicket->userType  = 'paciente';

        if ( $nTicket->save() ){

            $data = [
                 'name'     => $user->name,
                 'subject'  => $request->subject,
                 'description' => $request->ticketDescription
            ];

            // Send email
            //Mail::send('emails.newTicket', ['user' => $user], function ($message) {
            // VISTA: <h2>El usuario {{ $user->name }} ha creado un ticket.</h2>
            Mail::send('emails.newTicket', $data, function ($message) {
                //$message->from('cristina@doitcloud.consulting', 'Boomedic');
                $message->subject('Nuevo Ticket creado.');
                //$message->to('cristina.pioquinto@hotmail.com');
                $message->to('cristina.pioquinto@hotmail.com');
            });

            return redirect('supportTicket/index');
        }
        else
            dd('Problemas al crear registro.');
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
        $ticket = SupportTicket::find($id);
        $ticket->delete();
        
       return redirect('supportTicket/index');
    }
}
