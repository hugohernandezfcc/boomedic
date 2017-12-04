<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use App\User;
use App\email;

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
        /*$httpClient = new Client();
        $response = $httpClient->get('https://se.api.mailgun.net/v3/domains/sandboxde0a5dc93a4d4d6584ee4bde0852c464.mailgun.org/messages/eyJwIjpmYWxzZSwiayI6Ijc1NWJjZDE2LTlmZTMtNDNlMC05YWU4LTMzMTA1N2IyZjRjMSIsInMiOiJmMDgxNGY2NTE0IiwiYyI6InRhbmtiIn0=', [
            'auth' => ['api', 'key-6acc7a4795144cf3dfe94d1e9b6393e6'], 
        ]);
        $message = (string)$response->getMessage();
        //return $message;
        return view('emails', [
                'message'     => $message]);*/
        $nTicket = new SupportTicket();        
        $nTicket->userId    = 1;
        $nTicket->status    = 'In Progress';

        $nTicket->save();
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
