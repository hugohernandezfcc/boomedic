<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;

use App\User;
use App\email;

require '../../vendor/autoload.php';
use Mailgun\Mailgun;

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

                foreach($attachments as $k => $a) {
                    $httpClient = new Client();
                    $response = $httpClient->get($attachment['url'], [
                        'auth' => ['api', "key-f3d340554fdb2c32590a9d4ace93027a"], 
                    ]);
                    $imageData = (string)$response->getBody();
                    $base64 = base64_encode($imageData);
                    return $base64;
                }
            }
            return response()->json(['status' => 'ok']);
        } 
        catch(\Exception $e) 
        {
            return response()->json(['status' => 'ok']);
        }


        $nEmail = new SupportTicket();        
        $nEmail->userId    = 1;
        $nEmail->status    = 'Closed';
        $nEmail->ticketDescription    =  $attachments;

        $nEmail->save();
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
