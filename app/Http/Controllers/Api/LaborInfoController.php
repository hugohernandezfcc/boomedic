<?php

namespace App\Http\Controllers\Api;

use App\LaborInformation;
use App\Transformers\LaborInformationTransformer;
use App\Http\Requests\Api\LaborInfo\storeLaborInfoRequest;
use App\Http\Requests\Api\LaborInfo\UpdateLaborInfoRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class LaborInfoController extends Controller
{
    public function index(){
    	$LaborInfo = LaborInformation::all();
    	return Fractal::collection($LaborInfo, new LaborInformationTransformer);
    }

    public function show(LaborInformation $LaborInfo){
    	return Fractal::item($LaborInfo, new LaborInformationTransformer);

    }

    public function store(storeLaborInfoRequest $request){
    	$LaborInfo = new LaborInformation;

    	$LaborInfo->workplace = $request->workplace;
    	$LaborInfo->professionalPosition = $request->professionalPosition;
    	$LaborInfo->profInformation = $request->profInformation;

    	$LaborInfo->country = ($request->has('country')) ? $request->country : $LaborInfo->country;
    	$LaborInfo->state = ($request->has('state')) ? $request->state : $LaborInfo->state;
    	$LaborInfo->delegation = ($request->has('delegation')) ? $request->delegation : $LaborInfo->delegation;
    	$LaborInfo->colony = ($request->has('colony')) ? $request->colony : $LaborInfo->colony;
    	$LaborInfo->street = ($request->has('street')) ? $request->street : $LaborInfo->street;
    	$LaborInfo->streetNumber = ($request->has('streetNumber')) ? $request->streetNumber : $LaborInfo->streetNumber;
    	$LaborInfo->interiorNumber = ($request->has('interiorNumber')) ? $request->interiorNumber : $LaborInfo->interiorNumber;
    	$LaborInfo->phone = ($request->has('phone')) ? $request->phone : $LaborInfo->phone;
    	$LaborInfo->latitude = ($request->has('latitude')) ? $request->latitude : $LaborInfo->latitude;
    	$LaborInfo->longitude = ($request->has('longitude')) ? $request->longitude : $LaborInfo->longitude;
    	$LaborInfo->postalcode = ($request->has('postalcode')) ? $request->postalcode : $LaborInfo->postalcode;
    	$LaborInfo->general_amount = ($request->has('general_amount')) ? $request->general_amount : $LaborInfo->general_amount;

    	$LaborInfo->save();

    	return Fractal::item($LaborInfo, new LaborInformationTransformer);

    }

    public function update(UpdateLaborInfoRequest $request, LaborInformation $LaborInfo){
    	$LaborInfo->workplace = ($request->has('workplace')) ? $request->workplace : $LaborInfo->workplace;
    	$LaborInfo->professionalPosition = ($request->has('professionalPosition')) ? $request->professionalPosition : $LaborInfo->professionalPosition;
    	$LaborInfo->profInformation = ($request->has('profInformation')) ? $request->profInformation : $LaborInfo->profInformation;

    	$LaborInfo->country = ($request->has('country')) ? $request->country : $LaborInfo->country;
    	$LaborInfo->state = ($request->has('state')) ? $request->state : $LaborInfo->state;
    	$LaborInfo->delegation = ($request->has('delegation')) ? $request->delegation : $LaborInfo->delegation;
    	$LaborInfo->colony = ($request->has('colony')) ? $request->colony : $LaborInfo->colony;
    	$LaborInfo->street = ($request->has('street')) ? $request->street : $LaborInfo->street;
    	$LaborInfo->streetNumber = ($request->has('streetNumber')) ? $request->streetNumber : $LaborInfo->streetNumber;
    	$LaborInfo->interiorNumber = ($request->has('interiorNumber')) ? $request->interiorNumber : $LaborInfo->interiorNumber;
    	$LaborInfo->phone = ($request->has('phone')) ? $request->phone : $LaborInfo->phone;
    	$LaborInfo->latitude = ($request->has('latitude')) ? $request->latitude : $LaborInfo->latitude;
    	$LaborInfo->longitude = ($request->has('longitude')) ? $request->longitude : $LaborInfo->longitude;
    	$LaborInfo->postalcode = ($request->has('postalcode')) ? $request->postalcode : $LaborInfo->postalcode;
    	$LaborInfo->general_amount = ($request->has('general_amount')) ? $request->general_amount : $LaborInfo->general_amount;

    	$LaborInfo->save();

    	return Fractal::item($LaborInfo, new LaborInformationTransformer);
    }
}
