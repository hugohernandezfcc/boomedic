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
    public function index()
    {
        $user = User::find(Auth::id());
        $allTickets = DB::table('support_tickets')->where('userId', Auth::id() )->get();
        return view('tickets', [
                'allTickets'=> $allTickets,
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
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
             $user = User::find(Auth::id());
        return view('tickets', [
                'userId'    => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'email'     => $user->email,
                'photo'     => $user->profile_photo,
                'date'      => $user->created_at,
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
        $nTicket->userId    = $user->id;
        $nTicket->status    = 'In Progress';
        $nTicket->user      = $user->name;
        $nTicket->email     = $user->email;
        $nTicket->userType  = 'paciente';

        if ( $nTicket->save() ){

            $data = [
                'name'       => $user->name,
                'email'      => $user->email,
                'age'        => $user->age,                 
                'gender'     => $user->gender,
                'occupation' => $user->occupation,
                'country'    => $user->country,    
                'state'      => $user->state,                    
                'delegation' => $user->delegation,               
                'colony'     => $user->colony,                   
                'street'     => $user->street,                   
                'mobile'     => $user->mobile,
                'username'   => $user->username,                 
                'firstname'  => $user->firstname,                
                'lastname'   => $user->lastname,                
                'streetnumber'      => $user->streetnumber,           
                'interiornumber'    => $user->interiornumber,       
                'postalcode'        => $user->postalcode,
                'subject'           => $request->subject,
                'description'       => $request->ticketDescription
            ];

            // Send email
            //Mail::send('emails.newTicket', ['user' => $user], function ($message) {
            // VISTA: <h2>El usuario {{ $user->name }} ha creado un ticket.</h2>
            Mail::send('emails.newTicket', $data, function ($message) {
                $message->subject('Nuevo Ticket creado ');
                $message->to('contacto@doitcloud.consulting');
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
