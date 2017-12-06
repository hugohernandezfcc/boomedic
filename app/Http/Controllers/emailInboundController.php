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
        try
        {
            $attachs = request('attachments');

            if(!is_null($attachs)) {
                $attachments = json_decode($attachs, true);

                foreach($attachments as $file) {
                    $httpClient = new Client();
                    $response = $httpClient->get($file['url'], ['auth' => ['api', 'key-f3d340554fdb2c32590a9d4ace93027a']]);
                    $imageData = (string)$response->getBody();
                    $base64 = base64_encode($imageData);
                    return $base64;
                }

                /*foreach($attachments as $att) {
                    $httpClient = new Client();
                    $response = $httpClient->get($att['url'], ['auth' => ['api', 'key-f3d340554fdb2c32590a9d4ace93027a'],]);
                    $imageData = (string)$response->getBody();
                    $base64 = base64_encode($imageData);
                    return $base64;

                    /*$nTicket = new SupportTicket();     
                    $nTicket->userId    = 1;
                    $nTicket->status    = 'New';
                    $nTicket->subject    = 'Nuevo Email';
                    $nTicket->ticketDescription      = 'Nuevo';
                    $nTicket->save();*
                }*/
                $nTicket = new SupportTicket();     
                    $nTicket->userId    = 1;
                    $nTicket->status    = 'New';
                    $nTicket->subject    = 'Nuevo Email';
                    $nTicket->ticketDescription      = 'Nuevo';
                    $nTicket->save();
            }
            return response()->json(['status' => 'ok', 'message' => $attachments], 200);
        } 
        catch(\Exception $e) 
        {
            return response()->json(['status' => 'error', 'message' => $request], 406);
        }
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
