<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use \PDF;


class medicalPrescription extends Controller
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

        return view('medicalPrescription', [
                'userId'    => Auth::id(),
                'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                'mode'      => 'Index'
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


    public function redirecting($page)
    {
        switch ($page) {
            case 'index':
                return redirect('medicalPrescription/index'); //show
                break;
            
            default:
                return redirect('/medicalconsultations'); //medicalconsultations
                break;
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

   
    }


        public function PDFGenerator (Request $request){
        $this->user = User::find( Auth::id() );

        $data =  array(
                        'date'   => date("Y-m-d H:i:s"),
                        'clinic' => $request->clinic,
                        'qr'     => 'https://localhost/boomedic/public/index.php/medicalPrescription/',
                        'nameMedic' => $this->user->name,
                        'phoneM'    => $this->user->mobile,
                        'espe'      => $request->Especialidad,
                        'lic'       => $request->Licencia,
                        'Paciente'  => $request->Paciente,
                        'peso'      => $request->peso,
                        'est'      => $request->est,
                        'mobileP'  => $request->mobileP,
                        'email'    => $request->email,
                        'alergias' => $request->alergias,
                        'age'      => $request->age


                    ); 

        $pdf = \PDF::loadView('medicalPrescriptionPDF', $data);
         return $pdf->stream('Receta.pdf',array('Attachment'=>0));
 
}
}