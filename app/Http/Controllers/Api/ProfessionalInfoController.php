<?php

namespace App\Http\Controllers\Api;

use App\professional_information;
use App\Transformers\ProfessionalInformationTransformer;
use App\Http\Requests\Api\ProfessionalInfo\StoreProfInfoRequest;
use App\Http\Requests\Api\ProfessionalInfo\UpdateProfInfoRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class ProfessionalInfoController extends Controller
{
    public function index(){
    	$pInfo = professional_information::all();
    	//return Fractal::includes('parent')->collection($pInfo, new ProfessionalInformationTransformer);
    	return Fractal::collection($pInfo, new ProfessionalInformationTransformer);
    }

    public function show(professional_information $pInfo){
    	return Fractal::item($pInfo, new ProfessionalInformationTransformer);

    }

    public function store(StoreProfInfoRequest $request){
    	$pInfo = new professional_information;

    	$pInfo->specialty = ($request->has('specialty')) ? $request->specialty : $pInfo->specialty;
        $pInfo->schoolOfMedicine = ($request->has('schoolOfMedicine')) ? $request->schoolOfMedicine : $pInfo->schoolOfMedicine;
        $pInfo->facultyOfSpecialization = ($request->has('facultyOfSpecialization')) ? $request->facultyOfSpecialization : $pInfo->facultyOfSpecialization;
        $pInfo->practiseProfessional = ($request->has('practiseProfessional')) ? $request->practiseProfessional : $pInfo->practiseProfessional;
        $pInfo->medical_society = ($request->has('medical_society')) ? $request->medical_society : $pInfo->medical_society;

        $pInfo->user = $request->user;
        $pInfo->professional_license = $request->professional_license;

        $pInfo->save();

        return Fractal::item($pInfo, new ProfessionalInformationTransformer);
    }

    public function update(UpdateProfInfoRequest $request, professional_information $pInfo){
    	$pInfo->specialty = ($request->has('specialty')) ? $request->specialty : $pInfo->specialty ;
        $pInfo->schoolOfMedicine = ($request->has('schoolOfMedicine')) ? $request->schoolOfMedicine : $pInfo->schoolOfMedicine;
        $pInfo->facultyOfSpecialization = ($request->has('facultyOfSpecialization')) ? $request->facultyOfSpecialization : $pInfo->facultyOfSpecialization;
        $pInfo->practiseProfessional = ($request->has('practiseProfessional')) ? $request->practiseProfessional : $pInfo->practiseProfessional;
        $pInfo->user = ($request->has('user')) ? $request->user : $pInfo->user;
        $pInfo->professional_license = ($request->has('professional_license')) ? $request->professional_license : $pInfo->professional_license;
        $pInfo->medical_society = ($request->has('medical_society')) ? $request->medical_society : $pInfo->medical_society ;

        $pInfo->save();

        return Fractal::includes('parent')->item($pInfo, new ProfessionalInformationTransformer);
    }
}
