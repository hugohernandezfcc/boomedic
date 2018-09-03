<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Workboard;
use App\LaborInformation;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Image;
use Carbon\Carbon;
use App\professional_information;
use App\assistant;
use Mail;


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
        $assist = DB::table('assistant')
            ->join('users', 'assistant.user_assist', '=', 'users.id')
            ->where('assistant.user_doctor', Auth::id())
            ->where('assistant.confirmation', true)
            ->select('assistant.*', 'users.firstname', 'users.profile_photo', 'users.age', 'users.name')
            ->get();
        $nodes = array();
    //Json que guarda datos de familiares para generar externalidad//
      if(count($assist) < 1){
        if($users[0]->profile_photo != null)
         array_push( $nodes, ['name' => 'Yo', 'photo' => $users[0]->profile_photo. '?'. Carbon::now()->format('h:i'), 'id' => '0']);
            else{
                array_push( $nodes, ['name' => 'Yo', 'photo' => 'https://s3.amazonaws.com/abiliasf/profile-42914_640.png?'. Carbon::now()->format('h:i'), 'id' => '0']);
            }
          for($i = 1; $i < 2; $i++){
                array_push($nodes, ['name' => 'Agregar asistente', 'target' => [0] , 'photo' => 'https://image.freepik.com/iconen-gratis/zwart-plus_318-8487.jpg' , 'id' => 'n']);
            }
      }   else {
               
          array_push( $nodes, ['name' => 'Yo', 'photo' => $users[0]->profile_photo. '?'. Carbon::now()->format('h:i'), 'id' => $users[0]->id]);
          for($i = 0; $i < count($assist); $i++){
            if($assist[$i]->profile_photo != null){
                array_push($nodes, ['name' => $assist[$i]->firstname, 'target' => [0] , 'photo' => $assist[$i]->profile_photo. '?'. Carbon::now()->format('h:i') , 'id' => $assist[$i]->user_assist, 'namecom' => $assist[$i]->name]);
                  }else {
                        array_push($nodes, ['name' => $assist[$i]->firstname, 'target' => [0] , 'photo' => 'https://s3.amazonaws.com/abiliasf/profile-42914_640.png', 'id' => $assist[$i]->user_assist, 'namecom' => $assist[$i]->name]);
                  }
            }
          }
        $professionali = DB::table('professional_information')->where('user', Auth::id() )->get();
        $bus = $professionali[0]->id;
        $prof = professional_information::find($bus);
        $labor = DB::table('labor_information')->where('profInformation', $bus)->get();
        $asso = DB::table('medical_association')->where('parent', '>', '0')->get();
        return view('profileDoctor', [
                'username' => DB::table('users')->where('id', Auth::id() )->value('name'),

                 /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),

                /** INFORMATION USER */

                'firstname'     => $users[0]->firstname,
                'lastname'      => $users[0]->lastname,
                'email'         => $users[0]->email,
                'username'      => $users[0]->username,
                'name'      => $users[0]->name,
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

                /** PROFESSIONAL INFORMATION  */
                'professional_license'  =>  $professionali[0]->professional_license,
                'specialty'     => $professionali[0]->specialty,
                'schoolOfMedicine' => $professionali[0]->schoolOfMedicine,
                'facultyOfSpecialization' => $professionali[0]->facultyOfSpecialization,
                'practiseProfessional'    => $professionali[0]->practiseProfessional,
                'medical_society'         => $professionali[0]->medical_society,  

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
                'mode'          => 'doctor',
                'labor'         => $labor,
                'asso'          => $asso,
                /*NODES ASSISTANT*/
                'nodes'         => json_encode($nodes)
            ]
        );
    }

        public function saveAssistant (Request $request)
      {     
        $user = User::find(Auth::id());
           
        if($request->idassist != null){

         
          $assist = new assistant;
          $assist->user_doctor = $user->id;
          $assist->user_assist = $request->idassist;
          if($assist->save()){
             $userass=  DB::table('users')->where('id', $assist->user_assist )->first();
           $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'Usuario agregado como asistente de manera exitosa.', 
            'success' => 'success'
            );

          $data = [
                                'username'      => $user->username,
                                'name'      => $user->name,
                                'email'     => $user->email,                
                                'firstname' => $user->firstname,                
                                'lastname'  => $user->lastname,    
                                'user_assist'        => $assist->user_assist,
                                'id'                => $assist->id
                                ];
                                $email = $userass->email;
                                 Mail::send('emails.assistant', $data, function ($message) {
                                            $message->subject('Un doctor te ha asignado como su asistente');
                                            $message->to('contacto@doitcloud.consulting');
                                        });
         }else{
           $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'No se pudo agregar el usuario, vuelva a intentarlo más tarde.', 
            'error' => 'error'
            );

         }
          
        } else{
         $notification = array(
                //In case the payment is approved it shows a message reminding you the amount you paid.
            'message' => 'No se pudo agregar el usuario, vuelva a intentarlo más tarde.', 
            'error' => 'error'
            );
        } 
             return redirect('doctor/doctor/' . Auth::id() )->with($notification);
              
        } 

         public function verify($id)
           {
             $assistant = assistant::where('id', $id)->first();
                if (!$assistant){
             $notification = array(
                            //In case the payment is approved it shows a message reminding you the amount you paid.
                        'message' => 'Ha ocurrido un error con la confirmación, al parecer fue eliminado', 
                        'error' => 'error'
                        );
                      
                    return  redirect('user/profile/' . Auth::id() )->with($notification);
                }
                else{

          $assist = User::where('id', $assistant->user_assist)->first();
          $doctor = User::where('id', $assistant->user_doctor)->first();


                $assistant->confirmation = true;
                if($assistant->save()){
                    $notification = array(
                        'message' => 'Se confirmó exitosamente se agregó por defecto a tu perfil', 
                        'success' => 'success'
                        );
                      $data = [
                                'username'      => $assist->username,
                                'name'      => $assist->name,
                                ];
                               $email = $doctor->email;
                                 Mail::send('emails.assistantconfirm', $data, function ($message) {
                                            $message->subject('El asistente que agregaste ha confirmado exitosamente');
                                            $message->to('contacto@doitcloud.consulting');
                                        });
                return redirect('user/profile/' . Auth::id())->with($notification);
              }
            }
        }

    public function redirecting($page)
    {
        switch ($page) {
            case 'show':
                return redirect('doctor/doctor/' . Auth::id() ); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *questions_clinic_history
id
code_translation
question
text_help

answers_clinic_history
id
code_translation
answer
text_help
question
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($status){

        $users = DB::table('users')->where('id', Auth::id() )->get();
        $professionali = DB::table('professional_information')->where('user', Auth::id() )->get();
        $bus = $professionali[0]->id;
        $prof = professional_information::find($bus);
        $labor = DB::table('labor_information')->where('profInformation', $bus)->get();
        $asso = DB::table('medical_association')->where('parent', '>', '0')->get();
        return view('profileDoctor', [

                /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),
                'status'        => $status,

                /** INFORMATION USER */

                'firstname'     => $users[0]->firstname,
                'lastname'      => $users[0]->lastname,
                'email'         => $users[0]->email,
                'username'      => $users[0]->username,
                'name'      => $users[0]->name,
                'age'           => $users[0]->age,
                'photo'         => $users[0]->profile_photo,
                'date'         => $users[0]->created_at,
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
                'medical_society'         => $professionali[0]->medical_society,  

                /** ADDRESS FISICAL USER  */

                'country'       => (   empty($users[0]->country)        ) ? '' : $users[0]->country, 
                'state'         => (   empty($users[0]->state)          ) ? '' : $users[0]->state, 
                'delegation'    => (   empty($users[0]->delegation)     ) ? '' : $users[0]->delegation, 
                'colony'        => (   empty($users[0]->colony)         ) ? '' : $users[0]->colony, 
                'street'        => (   empty($users[0]->street)         ) ? '' : $users[0]->street, 
                'streetnumber'  => (   empty($users[0]->streetnumber)   ) ? '' : $users[0]->streetnumber, 
                'interiornumber'=> (   empty($users[0]->interiornumber) ) ? '' : $users[0]->interiornumber, 
                'postalcode'    => (   empty($users[0]->postalcode)     ) ? '' : $users[0]->postalcode,
                'mode'          => 'doctor',
                'labor'         => $labor,
                'asso'          => $asso

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
        $labor = DB::table('labor_information')->where('profInformation', $bus)->get();
         $asso = DB::table('medical_association')->where('parent', '>', '0')->get();

        if ($request->change == "true") {
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
        $prof->medical_society          = $request->medical_society ;  

        $prof->save();
        $user->save();
        }
            return view('profileDoctor', [

                /** SYSTEM INFORMATION */

                'userId'        => Auth::id(),
                'name'      => $user->name,
                'photo'         => $user->profile_photo,
                'date'         => $user->created_at,
                'mode'          => 'labor',
                'asso'          => $asso,

                /* DIRECTION LABOR PROFESSIONAL  */
                'labor'         => $labor,

            ]
        );
    }

        public function laborInformationNext(Request $request, $id)
    {
        $user = user::find(Auth::id());
        $professionali = DB::table('professional_information')->where('user', Auth::id())->get();
        $bus = $professionali[0]->id;
        $prof = professional_information::find($bus);
        $services = array();
        if($request->Estacionamiento){
         array_push($services,'Estacionamiento');
        }
        if($request->Cafeteria){
          array_push($services,'Cafeteria');
        }
        if($request->Ambulancias){
           array_push($services,'Ambulancias');
        }
        if($request->Elevador){
           array_push($services,'Elevador');
        }
        if($request->Wifi){
           array_push($services,'Wifi');
        }


        $laborInformation = new laborInformation;


        $laborInformation->workplace       = $request->workplace; 
        $laborInformation->professionalPosition       = $request->professionalPosition; 

        $laborInformation->country       = $request->country; 
        $laborInformation->state         = $request->state; 
        $laborInformation->delegation    = $request->delegation; 
        $laborInformation->colony        = $request->colony; 
        $laborInformation->street        = $request->street; 


        $laborInformation->postalcode    = $request->postalcode; 
        $laborInformation->latitude      = $request->lati; 
        $laborInformation->longitude     = $request->long;
        $laborInformation->general_amount = $request->cost;

        $laborInformation->profInformation  =   $prof->id;
        $laborInformation->services         = json_encode($services);
   
        $laborInformation->save();

          $labor = DB::table('labor_information')->where('profInformation', $bus)->get();
            return view('profileDoctor', [

                /** SYSTEM INFORMATION */

                'userId'        => $user->id,
                'name'          => $user->name,
                'photo'         => $user->profile_photo,
                'date'          => $user->created_at,
                'mode'          => 'labor',

                /* DIRECTION LABOR PROFESSIONAL  */
                'labor'         => $labor
            ]
        );
    }

    public function laborInformationView($id)
    {
        $user = user::find(Auth::id());
        $professionali = DB::table('professional_information')->where('user', Auth::id())->get();
        $bus = $professionali[0]->id;
        $prof = professional_information::find($bus);


          $labor = DB::table('labor_information')->where('profInformation', $bus)->get();
            return view('profileDoctor', [

                /** SYSTEM INFORMATION */

                'userId'        => $user->id,
                'name'          => $user->name,
                'photo'         => $user->profile_photo,
                'date'          => $user->created_at,
                'mode'          => 'viewlabor',

                /* DIRECTION LABOR PROFESSIONAL  */
                'labor'         => $labor
            ]
        );
    }

    public function updateDoctor(Request $request, $id)
    {

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
        return redirect('doctor/doctor/' . $id );
        }
    }

    public function cropDoctor(Request $request, $id)
    {
       // $path = $request->photo->store('images', 's3');
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
        if($user->save()){

        //Imagen copia circular//
            $newwidth = 150;
            $newheight = 150;
        $image = imagecreatetruecolor( $newwidth, $newheight);
        $image_s = imagecreatefromstring(file_get_contents($path2));
       /* $image_z = imagecreatefromstring(file_get_contents('https://s3.amazonaws.com/abiliasf/circle.png'));*/
        $width = imagesx($image_s);
        $height = imagesy($image_s);
        imagealphablending($image, true);

        imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newwidth, $newheight,$width,$height);
        //create masking
        $mask = imagecreatetruecolor( $width,$height);
        $transparent = imagecolorallocate($mask, 255, 0, 0);
        imagecolortransparent($mask,$transparent);
        imagefilledellipse($mask,  $newwidth/2, $newheight/2, $newwidth, $newheight, $transparent);
        $red = imagecolorallocate($mask, 0, 0, 0);
        imagecopymerge($image, $mask, 0, 0, 0, 0, $newwidth,$newheight, 100);
        imagecolortransparent($image,$red);
        imagefill($image, 0, 0, $red);
      /*  imagecopyresampled(
            $image,
            $image_z,
            0, 0, 0, 0,
            imagesx($image_z),
            imagesy($image_z),
            imagesx($image_z),
            imagesy($image_z)
            );*/
        ob_start();
        imagepng($image);
        $png_file = ob_get_contents();
        ob_end_clean();
        Storage::disk('s3')->put( $id.'-circle.png',  $png_file, 'public');
        //Imagen copia circular//


            return redirect('doctor/edit/complete' . $id );
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  $workboard = DB::table('workboard')->where('labInformation', $id)->get();
  $appointments = DB::table('medical_appointments')->where('workplace', $id)->get();
 if(count($workboard) > 0){
    DB::table('workboard')->where('labInformation', $id)->delete();   
 }
  if(count($appointments) > 0){
    DB::table('medical_appointments')->where('workplace', $id)->delete();   
 }
    DB::delete('delete from labor_information where id = ?',[$id]) ;    

    
    // redirect
    
   return redirect('doctor/laborInformationView/'.Auth::id() );
    }
}
