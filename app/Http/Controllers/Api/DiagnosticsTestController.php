<?php

namespace App\Http\Controllers\Api;

use App\diagnostic_tests;
use App\Transformers\DiagnosticTestsTransformer;
use App\Http\Requests\Api\DiagnosticsTest\storeDiagnosticTestRequest;
use App\Http\Requests\Api\DiagnosticsTest\updateDiagnosticTestRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class DiagnosticsTestController extends Controller
{
    public function index(){
    	$diagTest = diagnostic_tests::all();
    	return Fractal::collection($diagTest, new DiagnosticTestsTransformer);
    }

    public function show(diagnostic_tests $diagTest){
    	return Fractal::item($diagTest, new DiagnosticTestsTransformer);

    }

    public function store(storediagTestRequest $request){
    	$diagTest = new diagnostic_tests;

    	$diagTest->name = $request->name;
    	$diagTest->description = $request->description;
    	$diagTest->code = $request->code;

    	$diagTest->parent = ($request->has('parent')) ? $request->parent : $diagTest->parent;

    	$diagTest->save();

    	return Fractal::item($diagTest, new DiagnosticTestsTransformer);

    }

    public function update(UpdatediagTestRequest $request, diagnostic_tests $diagTest){
    	$diagTest->name = ($request->has('name')) ? $request->name : $diagTest->name;
    	$diagTest->description = ($request->has('description')) ? $request->description : $diagTest->description;
    	$diagTest->code = ($request->has('code')) ? $request->code : $diagTest->code;

    	$diagTest->parent = ($request->has('parent')) ? $request->parent : $diagTest->parent;

    	$diagTest->save();

    	return Fractal::item($diagTest, new DiagnosticTestsTransformer);
    }
}
