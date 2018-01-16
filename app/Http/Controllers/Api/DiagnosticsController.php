<?php

namespace App\Http\Controllers\Api;

use App\diagnostics;
use App\Transformers\DiagnosticsTransformer;
use App\Http\Requests\Api\Diagnostics\storeDiagnosticRequest;
use App\Http\Requests\Api\Diagnostics\updateDiagnosticRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class DiagnosticsController extends Controller
{
    public function index(){
    	$diagnostic = diagnostics::all();
    	return Fractal::includes('parentDiagnostic')->collection($diagnostic, new DiagnosticsTransformer);
    }

    public function show(diagnostics $diagnostic){
    	return Fractal::includes('parentDiagnostic')->item($diagnostic, new DiagnosticsTransformer);

    }

    public function store(storeDiagnosticRequest $request){
    	$diagnostic = new diagnostics;

    	$diagnostic->name = $request->name;
        $diagnostic->description = $request->description; 
        $diagnostic->code = $request->code;

        $diagnostic->parent = ($request->has('parent')) ? $request->parent :  $diagnostic->parent;

        $diagnostic->save();

        return Fractal::includes('parentDiagnostic')->item($diagnostic, new DiagnosticsTransformer);

    }

    public function update(updateDiagnosticRequest $request, diagnostics $diagnostic){
    	$diagnostic->name = ($request->has('name')) ? $request->name :  $diagnostic->name;
        $diagnostic->description = ($request->has('description')) ? $request->description :  $diagnostic->description;
        $diagnostic->code = ($request->has('code')) ? $request->code :  $diagnostic->code;
        $diagnostic->parent = ($request->has('parent')) ? $request->parent :  $diagnostic->parent;

        $diagnostic->save();

        return Fractal::includes('parentDiagnostic')->item($diagnostic, new DiagnosticsTransformer);

    }
}
