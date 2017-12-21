<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Workboard;
use App\LaborInformation;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Image;
use App\professional_information;

class doctor extends Controller
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = DB::table('users')->where('id', Auth::id() )->get();
        $professionali = DB::table('professional_information')->where('user', Auth::id() )->get();
        return view('profileDoctor', [
                'username' => DB::table('users')->where('id', Auth::id() )->value('name'),

                 /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),

                /** INFORMATION USER */

                'firstname'     => $users[0]->firstname,
                'lastname'      => $users[0]->lastname,
                'email'         => $users[0]->email,
                'username'      => $users[0]->name,
                'age'           => $users[0]->age,
                'photo'         => $users[0]->profile_photo,
                /** PERSONAL INFORMATION */

                'gender'        => $users[0]->gender,
                'occupation'    => $users[0]->occupation,
                'scholarship'   => $users[0]->scholarship,
                'maritalstatus' => $users[0]->maritalstatus,
                'mobile'        => $users[0]->mobile,
                'updated_at'    => $users[0]->updated_at,

                /** PROFESSIONAL INFORMATION  */
                'professional_license'  =>  $professionali[0]->professional_license,
                'specialty'     => $professionali[0]->specialty,
                'schoolOfMedicine' => $professionali[0]->schoolOfMedicine,
                'facultyOfSpecialization' => $professionali[0]->facultyOfSpecialization,
                'practiseProfessional'    => $professionali[0]->practiseProfessional,

                /** ADDRESS FISICAL USER  */

                'country'       => (   empty($users[0]->country)        ) ? '' : $users[0]->country, 
                'state'         => (   empty($users[0]->state)          ) ? '' : $users[0]->state, 
                'delegation'    => (   empty($users[0]->delegation)     ) ? '' : $users[0]->delegation, 
                'colony'        => (   empty($users[0]->colony)         ) ? '' : $users[0]->colony, 
                'street'        => (   empty($users[0]->street)         ) ? '' : $users[0]->street, 
                'streetnumber'  => (   empty($users[0]->streetnumber)   ) ? '' : $users[0]->streetnumber, 
                'interiornumber'=> (   empty($users[0]->interiornumber) ) ? '' : $users[0]->interiornumber, 
                'postalcode'    => (   empty($users[0]->postalcode)     ) ? '' : $users[0]->postalcode,
                'longitude'     => (   empty($users[0]->longitude)      ) ? '' : $users[0]->longitude,
                'latitude'      => (   empty($users[0]->latitude)       ) ? '' : $users[0]->latitude
            ]
        );
    }


    public function redirecting($page)
    {
        switch ($page) {
            case 'show':
                return redirect('user/profile/' . Auth::id() ); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($status){

        $users = DB::table('users')->where('id', Auth::id() )->get();
        $professionali = DB::table('professional_information')->where('user', Auth::id() )->get();
        return view('profileDoctor', [

                /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),
                'status'        => $status,

                /** INFORMATION USER */

                'firstname'     => $users[0]->firstname,
                'lastname'      => $users[0]->lastname,
                'email'         => $users[0]->email,
                'username'      => $users[0]->name,
                'age'           => $users[0]->age,
                'photo'         => $users[0]->profile_photo,
                /** PERSONAL INFORMATION */

                'gender'        => $users[0]->gender,
                'occupation'    => $users[0]->occupation,
                'scholarship'   => $users[0]->scholarship,
                'maritalstatus' => $users[0]->maritalstatus,
                'mobile'        => $users[0]->mobile,

                /** PROFESSIONAL INFORMATION  */
                'professional_license'  =>  $professionali[0]->professional_license,
                'specialty'     => $professionali[0]->specialty,
                'schoolOfMedicine' => $professionali[0]->schoolOfMedicine,
                'facultyOfSpecialization' => $professionali[0]->facultyOfSpecialization,
                'practiseProfessional'    => $professionali[0]->practiseProfessional,

                /** ADDRESS FISICAL USER  */

                'country'       => (   empty($users[0]->country)        ) ? '' : $users[0]->country, 
                'state'         => (   empty($users[0]->state)          ) ? '' : $users[0]->state, 
                'delegation'    => (   empty($users[0]->delegation)     ) ? '' : $users[0]->delegation, 
                'colony'        => (   empty($users[0]->colony)         ) ? '' : $users[0]->colony, 
                'street'        => (   empty($users[0]->street)         ) ? '' : $users[0]->street, 
                'streetnumber'  => (   empty($users[0]->streetnumber)   ) ? '' : $users[0]->streetnumber, 
                'interiornumber'=> (   empty($users[0]->interiornumber) ) ? '' : $users[0]->interiornumber, 
                'postalcode'    => (   empty($users[0]->postalcode)     ) ? '' : $users[0]->postalcode  

            ]
        );
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
        $user = User::find($id);
        $professionali = DB::table('professional_information')->where('user', Auth::id())->get();
        $bus = $professionali[0]->id;
        $prof = professional_information::find($bus);


        $user->status        = $request->status;         
        $user->firstname     = $request->firstname;         
        $user->lastname      = $request->lastname;         
        $user->email         = $request->email;         
        $user->username      = $request->username;         
        $user->age           = $request->age;         
        $user->gender        = $request->gender;         
        $user->occupation    = $request->occupation;         
        $user->scholarship   = $request->scholarship;         
        $user->maritalstatus = $request->maritalstatus;         
        $user->mobile        = $request->mobile;         
        $user->status        = 'Complete';

        $user->country       = $request->country; 
        $user->state         = $request->state; 
        $user->delegation    = $request->delegation; 
        $user->colony        = $request->colony; 
        $user->street        = $request->street; 


        $user->postalcode    = $request->postalcode; 
        $user->latitude      = $request->latitude; 
        $user->longitude     = $request->longitude;

        $prof->professional_license  =  $request->professional_license;
        $prof->specialty                = $request->specialty;
        $prof->schoolOfMedicine         = $request->schoolOfMedicine;
        $prof->facultyOfSpecialization  = $request->facultyOfSpecialization;
        $prof->practiseProfessional     = $request->practiseProfessional;

        $prof->save();
        $user->save();

            return redirect('doctor/doctor/' . $id );
    }

    public function updateDoctor(Request $request, $id)
    {
       // $path = $request->photo->store('images', 's3');
        $user = User::find($id);
        $file = $request->file('file');
         $imagen = getimagesize($file);    //Sacamos la información
          $width = $imagen[0];              //Ancho
          $height = $imagen[1];  

          if($height > '600' || $width > '600'){
            $height = $height / 3;
            $width = $width / 3;
          }
            if($height > '900' || $width > '900'){
                $height = $height / 4;
                $width = $width / 4;
              }

        $img = Image::make($file);
        $img->resize($width, $height);
        $img->encode('jpg');
        Storage::disk('s3')->put( $id.'.jpg',  (string) $img, 'public');
        $filename = $id.'.jpg';
        $path = Storage::cloud()->url($filename);
        $path2= 'https://s3.amazonaws.com/abiliasf/'. $filename;

       
        $user->profile_photo = $path2;   
        Session(['val' => 'true']);
        $user->save();
        return redirect('doctor/doctor/' . $id );
    }

    public function cropDoctor(Request $request, $id)
    {
       // $path = $request->photo->store('images', 's3');
        $user = User::find($id);
        $targ_w = $targ_h = 300;
        $jpeg_quality = 90;

        $src = $user->profile_photo;
        $img_r = imagecreatefromjpeg($src);
        $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

        imagecopyresampled($dst_r,$img_r,0,0,$request->x,$request->y,
            $targ_w,$targ_h,$request->w,$request->h);
        $filename = $id.'.jpg';
        $path2= 'https://s3.amazonaws.com/abiliasf/'. $filename;
        
        ob_start();
        imagejpeg($dst_r);
        $jpeg_file_contents = ob_get_contents();
        ob_end_clean();
        Storage::disk('s3')->put( $id.'.jpg',  $jpeg_file_contents, 'public');
        
        $path = Storage::cloud()->url($filename);

         Session(['val' => 'false']);
       
        $user->profile_photo = $path2;   

        if($user->save())
            return redirect('doctor/doctor/' . $id );
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
