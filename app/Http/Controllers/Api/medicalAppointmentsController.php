<?php

namespace App\Http\Controllers\Api;

use App\medical_appointments;
use App\Transformers\MedicalAppointmentsTransformer;
use App\Http\Requests\Api\MedicalAppointments\storeMedicalAppointmentsRequest;
use App\Http\Requests\Api\MedicalAppointments\updateMedicalAppointmentsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class medicalAppointmentsController extends Controller
{
    	public function index(){
    	$medicalAppo = medical_appointments::all();
    	return Fractal::includes(['owner', 'doctor'])->collection($medicalAppo, new MedicalAppointmentsTransformer);
    }

    public function show(medical_appointments $medicalAppo){
    	return Fractal::includes(['owner', 'doctor'])->item($medicalAppo, new MedicalAppointmentsTransformer);

    }

    public function store(storeMedicalAppointmentsRequest $request){
    	$medicalAppo = new medical_appointments;

    	$medicalAppo->user = $request->user;
        $medicalAppo->user_doctor = $request->user_doctor; 
        $medicalAppo->when = $request->when;
        $medicalAppo->status = $request->status;
        $medicalAppo->workplace = $request->workplace;

        $medicalAppo->save();

        return Fractal::includes(['owner', 'doctor'])->item($medicalAppo, new MedicalAppointmentsTransformer);

    }

    public function update(updateMedicalAppointmentsRequest $request, medical_appointments $medicalAppo){
    	$medicalAppo->user = ($request->has('user')) ? $request->user :  $medicalAppo->user;
        $medicalAppo->user_doctor = ($request->has('user_doctor')) ? $request->user_doctor :  $medicalAppo->user_doctor;
        $medicalAppo->when = ($request->has('when')) ? $request->when :  $medicalAppo->when;
        $medicalAppo->status = ($request->has('status')) ? $request->status :  $medicalAppo->status;
        $medicalAppo->workplace = ($request->has('workplace')) ? $request->workplace :  $medicalAppo->workplace;

        $medicalAppo->save();

        return Fractal::includes(['owner', 'doctor'])->item($medicalAppo, new MedicalAppointmentsTransformer);

    }  
}
