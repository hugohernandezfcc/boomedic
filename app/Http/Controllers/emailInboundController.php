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

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Auth;
use Mail;

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
        return view('tickets', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'email'     => DB::table('users')->where('id', Auth::id() )->value('email'),
                'photo'  => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
                'mode'      => 'sendEmail'
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
        $files = collect(json_decode($request->attachments, true));
        
        if ($files->count() === 0) {
            echo "Sin archivos";
        }else{
            foreach ($files as $file){
                $fileName = $file['name'];
                $url = $file['url'];

                $httpClient = new Client();
                $resp = $httpClient->get($url, [
                    'auth' => ['api', 'key-24a5298179ff4d60d1040dd961ec700f'],
                ]);
                $content = (string)$resp->getBody();

                $time = time();
                $time1 = date("d_M_Y_H_i_s", $time);
                $fname = $time1."_".$fileName;

                Storage::disk('s3')->put($fname, $content, 'public');
            }
        }

        return response()->json(['status' => 'ok', 'message' => $request]);
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



    public function sendEmail(Request $request)
    {
        $subjectE = $request->subject;

        $user = User::find(Auth::id());

        $data = [
            'name'     => $user->name,
            'email'    => $user->email,
            'age'     => $user->age,                 
            'gender'    => $user->gender,
            'occupation'=> $user->occupation,
            'country'   => $user->country,    
            'state'     => $user->state,                    
            'delegation'    => $user->delegation,               
            'colony'    => $user->colony,                   
            'street'    => $user->street,                   
            'mobile'     => $user->mobile,
            'username'  => $user->username,                 
            'firstname' => $user->firstname,                
            'lastname'  => $user->lastname,                
            'streetnumber'  => $user->streetnumber,           
            'interiornumber'    => $user->interiornumber,       
            'postalcode'    => $user->postalcode,
            'emailBody' => $request->emailBody
        ];

        Mail::send('sendEmail', $data, function ($message) {
            $message->subject($subjectE);
            $message->to('cristina@doitcloud.consulting');
        });

        return redirect('user/profile/' . $id );
    }
}
