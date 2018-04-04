<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\family;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Image;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class profile extends Controller
{

     use SendsPasswordResetEmails;
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
        $family = DB::table('family')
            ->join('users', 'family.activeUser', '=', 'users.id')
            ->where('family.parent', Auth::id())
            ->select('family.*', 'users.firstname', 'users.profile_photo')
            ->get();
        $nodes = array();
    //Json que guarda datos de familiares para generar externalidad//
      if(count($family) < 1){
         array_push( $nodes, ['name' => 'Yo', 'photo' => $users[0]->profile_photo. '?'. Carbon::now()->format('h:i'), 'id' => '0']);
          for($i = 1; $i < 2; $i++){
                array_push($nodes, ['name' => 'Agregar familiar', 'target' => [0] , 'photo' => 'https://image.freepik.com/iconos-gratis/signo-de-interrogacion_318-52837.jpg' , 'id' => 'n']);
            }
      }   else {      
      
          array_push( $nodes, ['name' => 'Yo', 'photo' => $users[0]->profile_photo. '?'. Carbon::now()->format('h:i'), 'id' => $users[0]->id]);
          for($i = 0; $i < count($family); $i++){
            if($family[$i]->profile_photo != null){
                array_push($nodes, ['name' => $family[$i]->firstname, 'target' => [0] , 'photo' => $family[$i]->profile_photo. '?'. Carbon::now()->format('h:i') , 'id' => $family[$i]->activeUser]);
                  }else {
                        array_push($nodes, ['name' => $family[$i]->firstname, 'target' => [0] , 'photo' => 'https://s3.amazonaws.com/abiliasf/profile-42914_640.png', 'id' => $family[$i]->activeUser]);
                  }
            }
          }
    //Json que guarda datos de familiares para generar externalidad//   

        return view('profile', [
                
                 /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),

                /** INFORMATION USER */

                'firstname'     => $users[0]->firstname,
                'lastname'      => $users[0]->lastname,
                'email'         => $users[0]->email,

                'name'          => $users[0]->name,

                'username'      => $users[0]->username,
                'age'           => $users[0]->age,
                'photo'         => $users[0]->profile_photo,
                'date'         => $users[0]->created_at,

                /** PERSONAL INFORMATION */

                'gender'        => $users[0]->gender,
                'occupation'    => $users[0]->occupation,
                'scholarship'   => $users[0]->scholarship,
                'maritalstatus' => $users[0]->maritalstatus,
                'mobile'        => $users[0]->mobile,
                'updated_at'    => $users[0]->updated_at,

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
                'latitude'      => (   empty($users[0]->latitude)       ) ? '' : $users[0]->latitude,
                'nodes'         => json_encode($nodes)
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

        return view('profile', [

                /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),
                'status'        => $status,

                /** INFORMATION USER */

                'firstname'     => $users[0]->firstname,
                'lastname'      => $users[0]->lastname,
                'email'         => $users[0]->email,
                'name'          => $users[0]->name,

                'username'      => $users[0]->username,
                'age'           => $users[0]->age,
                'photo'         => $users[0]->profile_photo,
                'date'         => $users[0]->created_at,

                /** PERSONAL INFORMATION */

                'gender'        => $users[0]->gender,
                'occupation'    => $users[0]->occupation,
                'scholarship'   => $users[0]->scholarship,
                'maritalstatus' => $users[0]->maritalstatus,
                'mobile'        => $users[0]->mobile,

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
       // $path = $request->photo->store('images', 's3');
        $user = User::find($id);
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
        if($user->save())
            return redirect('user/profile/' . $id );
    }

    public function updateProfile(Request $request, $id)
    {
       // $path = $request->photo->store('images', 's3');
        $user = User::find($id);
        $file = $request->file('file');
         $imagen = getimagesize($file);    //Sacamos la información
          $width = $imagen[0];              //Ancho
          $height = $imagen[1];  

          if($height > '600' || $width > '400'){
            $height = $height / 2;
            $width = $width / 2;
          }
          if($height > '800' || $width > '600'){
            $height = $height / 2.5;
            $width = $width / 2.5;
          }
            if($height > '1000' || $width > '900'){
                $height = $height / 3;
                $width = $width / 3;
              }



        $img = Image::make($file);
        $img->resize($width, $height);
        $img->encode('jpg');
        Storage::disk('s3')->put( $id.'temporal.jpg',  (string) $img, 'public');
        $filename = $id.'temporal.jpg';
        $path = Storage::cloud()->url($filename);
        $path2= 'https://s3.amazonaws.com/abiliasf/'. $filename;

       
        $user->profile_photo = $path2;   
               
        if($user->save()){
        Session(['val' => 'true']);
        return redirect('/user/edit/complete');
      }
    }

    public function cropProfile(Request $request, $id)
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
        Storage::disk('s3')->delete('https://s3.amazonaws.com/abiliasf/'.$user->id.'temporal.jpg');
        if($user->save())
            return redirect('/user/edit/complete');
    }
        

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

        public function userSearch (Request $request)
      {     $user = User::find(Auth::id());
           
        if($request->search != null){
          $search =  DB::table('users')->where('name', 'ILIKE','%'.$request->search.'%')->get();
          
            return response()->json($search);
              }
        }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

        public function saveFamily (Request $request)
      {     
        $user = User::find(Auth::id());
           
        if($request->idfam != null){
         if($request->val == "false") {
          $userFam =  DB::table('users')->where('id', $request->idfam)->get();
          $family = new family;
          $family->parent = $user->id;
          $family->relationship = $request->relationship;
          $family->activeUser = $request->idfam;
          $family->activeUserStatus = 'inactive';
          if($family->save()){
           $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Bien', 
            'success' => 'success'
            );
         }else{
           $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Bien', 
            'error' => 'error'
            );

         }
          }
        } else{

        $age = date("Y") - substr($request->birthdate, -4);
        $namesUser = array();

        //$pos = strpos(' ', $data['name']);

        //if($pos !== false){
            $explodeName = explode(' ', $request->name);

            
            
            if(count($explodeName) == 2){

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1];
            
            }elseif (count($explodeName) == 3) {

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1] . ' ' . $explodeName[2];

            }elseif (count($explodeName) == 4) {

                $namesUser['first'] = $explodeName[0] . ' ' . $explodeName[1];
                $namesUser['last'] = $explodeName[2] . ' ' . $explodeName[3];
            }

        $uName = explode('@', $request->email);
        $uName['username'] = $uName[0] . '@boomedic.mx';
        $create = DB::table('users')->where('email', $request->email)->get();
         if(!$create){
        $unew = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'birthdate' => $request->birthdate,
                'age'       => (int) $age,
                'status'    => 'In Progress',
                'firstname' => $namesUser['first'],
                'lastname'  => $namesUser['last'],
                'username'  => $uName['username'],
                'password'  => bcrypt('123456')
            ]);

        if(count($unew) > 0){
          $userFam  =  DB::table('users')->where('id', $unew->id)->get();
          $family = new family;
          $family->parent = $user->id;
          $family->relationship = $request->relationship;
          $family->activeUser = $unew->id;
          $family->activeUserStatus = 'inactive';
          $family->save();
         $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

          }
         $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Bien', 
            'success' => 'success'
            );

        }
                  else{
            $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'nel perro', 
            'error' => 'error'
            );
          }
      }
             return redirect('user/profile/' . Auth::id() )->with($notification);
              
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
