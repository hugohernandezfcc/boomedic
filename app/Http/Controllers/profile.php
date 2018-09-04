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
use Mail;


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
            ->select('family.*', 'users.firstname', 'users.profile_photo', 'users.age', 'users.name')
            ->get();
        $nodes = array();
    //Json que guarda datos de familiares para generar externalidad//
      if(count($family) < 1){
        if($users[0]->profile_photo != null)
         array_push( $nodes, ['name' => 'Yo', 'photo' => $users[0]->profile_photo. '?'. Carbon::now()->format('h:i'), 'id' => '0']);
            else{
                array_push( $nodes, ['name' => 'Yo', 'photo' => 'https://s3.amazonaws.com/abiliasf/profile-42914_640.png?'. Carbon::now()->format('h:i'), 'id' => '0']);
            }
          for($i = 1; $i < 2; $i++){
                array_push($nodes, ['name' => 'Agregar familiar', 'target' => [0] , 'photo' => 'https://image.freepik.com/iconen-gratis/zwart-plus_318-8487.jpg' , 'id' => 'n']);
            }
      }   else {
               
          array_push( $nodes, ['name' => 'Yo', 'photo' => $users[0]->profile_photo. '?'. Carbon::now()->format('h:i'), 'id' => $users[0]->id]);
          for($i = 0; $i < count($family); $i++){
            $session = "0";
            if($family[$i]->relationship == "son" && $family[$i]->age < 18){
                $session = "1";
            } 
            if($family[$i]->profile_photo != null){
                array_push($nodes, ['name' => $family[$i]->firstname, 'target' => [0] , 'photo' => $family[$i]->profile_photo. '?'. Carbon::now()->format('h:i') , 'id' => $family[$i]->activeUser, 'relationship' => trans('adminlte::adminlte.'.$family[$i]->relationship), "session" => $session, 'namecom' => $family[$i]->name]);
                  }else {
                        array_push($nodes, ['name' => $family[$i]->firstname, 'target' => [0] , 'photo' => 'https://s3.amazonaws.com/abiliasf/profile-42914_640.png', 'id' => $family[$i]->activeUser, 'relationship' => trans('adminlte::adminlte.'.$family[$i]->relationship), "session" => $session, 'namecom' => $family[$i]->name]);
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

    public function select($id){
      Session(['asdr' => $id]);
      return response()->json(session()->get('asdr')); 

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
          $search = family::ilike($request->search);
          
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
         
          $family = new family;
          $family->parent = $user->id;
          $family->relationship = $request->relationship;
          $family->activeUser = $request->idfam;
          $family->activeUserStatus = 'inactive';
          if($family->save()){
             $userfam=  DB::table('users')->where('id', $family->activeUser)->first();
           $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Usuario emparentado como familiar de manera exitosa.', 
            'success' => 'success'
            );

          if($request->relationship == "siblings"){
            $rela = "Hermano(a)";
          }
          if($request->relationship == "mother"){
            $rela = "Madre";
          }
          if($request->relationship == "father"){
            $rela = "Padre";
          }
          if($request->relationship == "son"){
            $rela = "Hijo(a)";
          }
          if($request->relationship == "wife"){
            $rela = "Esposa";
          }  
          if($request->relationship == "husband"){
            $rela = "Esposo";
          }  
          if($request->relationship == "uncles"){
            $rela = "Tío(a)";
          } 
          if($request->relationship == "grandparents"){
            $rela = "Abuelo(a)";
          }                                                           
                             $data = [
                                'username'      => $user->username,
                                'name'      => $user->name,
                                'email'     => $user->email,                
                                'firstname' => $user->firstname,                
                                'lastname'  => $user->lastname,    
                                'relationship'      => $rela,
                                'activeUser'        => $family->activeUser,
                                'id'                => $family->id
                                ];
                                $email = $user->email;
                                 Mail::send('emails.family', $data, function ($message) {
                                            $message->subject('Tienes una solicitud de parentesco familiar');
                                            $message->to('contacto@doitcloud.consulting');
                                        });
         }else{
           $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'No se pudo emparentar el usuario, vuelva a intentarlo más tarde.', 
            'error' => 'error'
            );

         }
          }
        } else{

        $age = date("Y") - Carbon::parse($request->birthdate)->format('Y');
        $namesUser = array();

        //$pos = strpos(' ', $data['name']);

        //if($pos !== false){
            $explodeName = explode(' ', $request->name);
            $porcent = 0;
            
            if(count($explodeName) == 2){

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1];

             $search =  family::ilike($explodeName[0]);
                 if(count($search) > 0){
                     $porcent++;
                 }

             $search2 =  family::ilike($explodeName[1]);
               if(count($search2) > 0){
                     $porcent++;
                 }
            $search3 =  family::ilike($request->name);
               if(count($search3) > 0){
                     $porcent++;
                 }
                 $total = $porcent * 100 / 3;
            
            }elseif (count($explodeName) == 3) {

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1] . ' ' . $explodeName[2];
             $search =  family::ilike($explodeName[0]); 
                 if(count($search) > 0){
                     $porcent++;
                 }

             $search2 = family::ilike($explodeName[1]); 
               if(count($search2) > 0){
                     $porcent++;
                 }
            $search3 =  family::ilike($request->name);
               if(count($search3) > 0){
                     $porcent++;
                 }
            $search4 =  family::ilike($explodeName[2]); 
               if(count($search4) > 0){
                     $porcent++;
                 }
                 $total = $porcent * 100 / 4;

            }elseif (count($explodeName) == 4) {

                $namesUser['first'] = $explodeName[0] . ' ' . $explodeName[1];
                $namesUser['last'] = $explodeName[2] . ' ' . $explodeName[3];

            $search = family::ilike($explodeName[0]);
                 if(count($search) > 0){
                     $porcent++;
                 }

             $search2 = family::ilike($explodeName[1]);
               if(count($search2) > 0){
                     $porcent++;
                 }
            $search3 = family::ilike($request->name);
               if(count($search3) > 0){
                     $porcent++;
                 }
            $search4 =  family::ilike($explodeName[2]);
               if(count($search4) > 0){
                     $porcent++;
                 }
            $search5 =  family::ilike($explodeName[3]);
               if(count($search5) > 0){
                     $porcent++;
                 }                 
                 $total = intval($porcent * 100 / 5);
            }

        $uName = explode('@', $request->email);
        $uName['username'] = $uName[0] . '@boomedic.mx';




        $create = DB::table('users')->where('email', $request->email)->get();
        $coin = 0;  
 
      if(count($create) == 0){
        if($total > 74){

            $bir =  DB::table('users')->where('birthdate', $request->birthdate)->where('name', 'ILIKE','%'.$request->name.'%')->get();
                if(count($bir) > 0){
                    $coincidences =  DB::table('family')->where('parent', Auth::id())->get();
                      for($y = 0; $y < count($bir); $y++){ 
                          for($z = 0; $z < count($coincidences); $z++){
                       
                                if($bir[$y]->id === $coincidences[$z]->activeUser ){
                                      $coin++;
                                }
                                if($bir[$y]->id === $coincidences[$z]->passiveUser ){
                                      $coin++;
                                } 
                           }   
                     }
                     if($coin > 0){
                                   $notification = array(
                                    'message' => 'Hubo una coincidencia en nombre, fecha de nacimiento y un usuario que registraste antes, asegurate de no estar duplicando.', 
                                    'error' => 'error'
                                    );
                     } 
                else{
                      $unew = User::create([
                              'name'      => $request->name,
                              'email'     => $request->email,
                              'birthdate' => Carbon::parse($request->birthdate)->format('m-d-Y'),
                              'age'       => (int) $age,
                              'status'    => 'In Progress',
                              'firstname' => $namesUser['first'],
                              'lastname'  => $namesUser['last'],
                              'username'  => $uName['username'],
                              'password'  => bcrypt('123456')
                          ]);
                        $family = family::create([
                              'activeUser'        => $unew->id,
                              'relationship'      => $request->relationship,
                              'activeUserStatus'  => 'inactive',
                              'parent'            => $user->id
                        ]);

                        //Envío de correo para modificar contraseña
                        $response = $this->broker()->sendResetLink(
                          $request->only('email')
                      );

                        
                       $notification = array(
                              //In case the payment is approved it shows a message reminding you the amount you paid.
                          'message' => 'Se creó correctamente un usuario para tu familiar y se emparentó correctamente.', 
                          'success' => 'success'
                          );
                     }
                }
                else{
                      $unew = User::create([
                              'name'      => $request->name,
                              'email'     => $request->email,
                              'birthdate' => Carbon::parse($request->birthdate)->format('m-d-Y'),
                              'age'       => (int) $age,
                              'status'    => 'In Progress',
                              'firstname' => $namesUser['first'],
                              'lastname'  => $namesUser['last'],
                              'username'  => $uName['username'],
                              'password'  => bcrypt('123456')
                          ]);
                        $family = family::create([
                              'activeUser'        => $unew->id,
                              'relationship'      => $request->relationship,
                              'activeUserStatus'  => 'inactive',
                              'parent'            => $user->id
                        ]);

                        //Envío de correo para modificar contraseña
                        $response = $this->broker()->sendResetLink(
                          $request->only('email')
                      );

                        
                       $notification = array(
                              //In case the payment is approved it shows a message reminding you the amount you paid.
                          'message' => 'Se creó correctamente un usuario para tu familiar y se emparentó correctamente.', 
                          'success' => 'success'
                          );
                     } 
        }

        else{
        $unew = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'birthdate' => Carbon::parse($request->birthdate)->format('m-d-Y'),
                'age'       => (int) $age,
                'status'    => 'In Progress',
                'firstname' => $namesUser['first'],
                'lastname'  => $namesUser['last'],
                'username'  => $uName['username'],
                'password'  => bcrypt('123456')
            ]);
          $family = family::create([
                'activeUser'        => $unew->id,
                'relationship'      => $request->relationship,
                'activeUserStatus'  => 'inactive',
                'parent'            => $user->id
          ]);

          //Envío de correo para modificar contraseña
          $response = $this->broker()->sendResetLink(
            $request->only('email')    
        );

          if($request->relationship == "siblings"){
            $rela = "Hermano(a)";
          }
          if($request->relationship == "mother"){
            $rela = "Madre";
          }
          if($request->relationship == "father"){
            $rela = "Padre";
          }
          if($request->relationship == "son"){
            $rela = "Hijo(a)";
          }
          if($request->relationship == "wife"){
            $rela = "Esposa";
          }  
          if($request->relationship == "husband"){
            $rela = "Esposo";
          }  
          if($request->relationship == "uncles"){
            $rela = "Tío(a)";
          } 
          if($request->relationship == "grandparents"){
            $rela = "Abuelo(a)";
          }                                                           
                             $data = [
                                'username'      => $user->username,
                                'name'      => $user->name,
                                'email'     => $user->email,                
                                'firstname' => $user->firstname,                
                                'lastname'  => $user->lastname,    
                                'relationship'      => $rela,
                                'activeUser'        => $unew->id,
                                'id'                => $family->id
                                ];
                                $email = $user->email;
                                 Mail::send('emails.family', $data, function ($message) {
                                            $message->subject('Tienes una solicitud de parentesco familiar');
                                            $message->to('contacto@doitcloud.consulting');
                                        });

          
         $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Se creó correctamente un usuario para tu familiar y se emparentó correctamente.', 
            'success' => 'success'
            );

        }
      }
         else{
            $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'No se pudo registrar, el correo que utilizaste  ya está en uso.', 
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

     public function verify($id)
           {
             $family= family::where('id', $id)->first();
                if (!$family){
             $notification = array(
                            //In case the payment is approved it shows a message reminding you the amount you paid.
                        'message' => 'Ha ocurrido un error con el parentesco familiar, al parecer fue eliminado', 
                        'error' => 'error'
                        );
                      
                    return  redirect('user/profile/' . Auth::id() )->with($notification);
                }
                else{

          $user = User::where('id', $family->activeUser)->first();
          $user2 = User::where('id', $family->parent)->first();

          if($family->relationship == "siblings"){
            $rela = "siblings";
          }
          if($family->relationship == "mother"){
            $rela = "son";
          }
          if($family->relationship == "father"){
            $rela = "son";
          }
          if($family->relationship == "son" && $user2->gender == "female"){
            $rela = "mother";
          }
          if($family->relationship == "son" && $user2->gender == "male"){
            $rela = "father";
          }
          if($family->relationship == "wife"){
            $rela = "husband";
          }  
          if($family->relationship == "husband"){
            $rela = "wife";
          }  
          if($family->relationship == "uncles"){
            $rela = "son";
          } 
          if($family->relationship == "grandparents"){
            $rela = "son";
          }    

                $family->activeUserStatus = 'active';
                $family->save();
                $family2 = new family;
                $family2->parent = $family->activeUser;
                $family2->relationship = $rela;
                $family2->activeUser = $family->parent;
                $family2->activeUserStatus = 'active';
                if($family2->save()){
                    $notification = array(
                        'message' => 'Fue confirmado el parentesco y se agregó por defecto a tu perfil', 
                        'success' => 'success'
                        );
                return redirect('user/profile/' . Auth::id())->with($notification);
              }
            }
        }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

        public function loginSon (Request $request)
      {    
        $parental = User::find(Auth::id());
        $user = User::find($request->id);
        Auth::login($user, true);
        Session(['parental' => $parental->username]);

        // if successful, then redirect to their intended location
        return redirect()->intended(route('medicalconsultations'));

    }
  
}
