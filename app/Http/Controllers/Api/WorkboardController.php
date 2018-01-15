<?php

namespace App\Http\Controllers\Api;

use App\Workboard;
use App\Transformers\WorkboardTransformer;
use App\Http\Requests\Api\Workboard\storeWorkboardRequest;
use App\Http\Requests\Api\Workboard\updateWorkboardRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class WorkboardController extends Controller
{
    public function index(){
    	$workboard = Workboard::all();
    	return Fractal::collection($workboard, new WorkboardTransformer);
    }

    public function show(Workboard $workboard){
    	return Fractal::item($workboard, new WorkboardTransformer);

    }

    public function store(storeWorkboardRequest $request){
    	$workboard = new Workboard;

    	$workboard->workingDays = $request->workingDays;
        $workboard->workingHours = $request->workingHours; 
        $workboard->labInformation = $request->labInformation;

        $workboard->save();

        return Fractal::item($workboard, new WorkboardTransformer);

    }

    public function update(updateWorkboardRequest $request, Workboard $workboard){
    	$workboard->workingDays = ($request->has('workingDays')) ? $request->workingDays :  $workboard->workingDays;
        $workboard->workingHours = ($request->has('workingHours')) ? $request->workingHours :  $workboard->workingHours;
        $workboard->labInformation = ($request->has('labInformation')) ? $request->labInformation :  $workboard->labInformation;

        $workboard->save();

        return Fractal::item($workboard, new WorkboardTransformer);

    }
}
