<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

use App\User;
use App\email;

use Illuminate\Support\Facades\DB;
use App\SupportTicket;

/*require 'vendor/autoload.php';*/
use Mailgun\Mailgun;

use GuzzleHttp\Client;

class emailInboundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        /*$attachs = request('attachments');


        $nTicket = new email();
                $nTicket->userId      = 1;                
                $nTicket->message      = $attachs;           
                $nTicket->save();
        
        return response()->json(['status' => 'ok']);*/

        /*$request->input('sender');
        $request->input('attachments');
        $files = json_decode($request->input('attachments'),true);*/

        /*$files = json_decode($request->input('storage'),true);*/
        /*$files = json_decode($request,true);*/
        $recipient = request()->recipient;
        $sender = request()->sender;
        $subject = request()->subject;
        $Received = request()->Received;
        /*$MessageId = request()->Message-Id;*/
        /*$Date = request()->Date;
        $From = request()->From;*/

        $cadena = "recipient:: ".$recipient . "sender:: ".$sender . "subject:: ".$subject . "Received:: ".$Received . "Date:: ".$Date . "From:: ".$From;

        $mg = new Mailgun('key-f3d340554fdb2c32590a9d4ace93027a');
        /*foreach ($files as $file){
                    $fileName = $file['name'];
                    $content = $mg->getAttachment($file['url'])->http_response_body;
        }*/

        $nTicket = new email();
        $nTicket->userId      = 1;                
        $nTicket->message      = $cadena;

        if ( $nTicket->save() ){
            return response()->json(['status' => 'ok', 'message' => $request]);
        }else {
            return response()->json(['status' => 'error', 'message' => $request]);
        }

        // do something with $response->getBody();
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
