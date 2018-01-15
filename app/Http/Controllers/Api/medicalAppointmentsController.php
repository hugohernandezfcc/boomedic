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

    public function show(medical_appointments $medicalApp){
    	return Fractal::includes(['owner', 'doctor'])->item($medicalAppo, new MedicalAppointmentsTransformer);

    }

    public function store(storeMedicalAppointmentsRequest $request){
    	$medicalAppo = new medical_appointments;

    	$medicalAppo->provider = $request->provider;
        $medicalAppo->typemethod = $request->typemethod; 
        $medicalAppo->cvv = $request->cvv;
        $medicalAppo->cardnumber = $request->cardnumber;
        $medicalAppo->owner = $request->owner;

        $medicalAppo->country = ($request->has('country')) ? $request->country :  $medicalAppo->country;
        $medicalAppo->month = ($request->has('month')) ? $request->month :  $medicalAppo->month;
        $medicalAppo->year = ($request->has('year')) ? $request->year :  $medicalAppo->year;
        $medicalAppo->paypal_email = ($request->has('paypal_email')) ? $request->paypal_email :  $medicalAppo->paypal_email;
        $medicalAppo->bank = ($request->has('bank')) ? $request->bank :  $medicalAppo->bank;
        $medicalAppo->notified = ($request->has('notified')) ? $request->notified :  $medicalAppo->notified;


        $medicalAppo->save();

        return Fractal::includes(['owner', 'doctor'])->item($medicalAppo, new MedicalAppointmentsTransformer);

    }

    public function update(updateMedicalAppointmentsRequest $request, medical_appointments $medicalAppo){
    	$medicalAppo->provider = ($request->has('provider')) ? $request->provider :  $medicalAppo->provider;
        $medicalAppo->typemethod = ($request->has('typemethod')) ? $request->typemethod :  $medicalAppo->typemethod;
        $medicalAppo->country = ($request->has('country')) ? $request->country :  $medicalAppo->country;
        $medicalAppo->month = ($request->has('month')) ? $request->month :  $medicalAppo->month;
        $medicalAppo->year = ($request->has('year')) ? $request->year :  $medicalAppo->year;
        $medicalAppo->cvv = ($request->has('cvv')) ? $request->cvv :  $medicalAppo->cvv;
        $medicalAppo->cardnumber = ($request->has('cardnumber')) ? $request->cardnumber :  $medicalAppo->cardnumber;
        $medicalAppo->owner = ($request->has('owner')) ? $request->owner :  $medicalAppo->owner;
        $medicalAppo->paypal_email = ($request->has('paypal_email')) ? $request->paypal_email :  $medicalAppo->paypal_email;
        $medicalAppo->bank = ($request->has('bank')) ? $request->bank :  $medicalAppo->bank;
        $medicalAppo->notified = ($request->has('notified')) ? $request->notified :  $medicalAppo->notified;

        $medicalAppo->save();

        return Fractal::includes(['owner', 'doctor'])->item($medicalAppo, new MedicalAppointmentsTransformer);

    }  
}
