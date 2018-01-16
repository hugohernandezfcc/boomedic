<?php

namespace App\Http\Controllers\Api;

use App\diagnostics;
use App\Transformers\DiagnosticsTransformer;
use App\Http\Requests\Api\Diagnostics\storeDiagnosticRequest;
use App\Http\Requests\Api\Diagnostics\updateDiagnosticRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
//use Illuminate\Support\Facades\DB;

class DiagnosticsController extends Controller
{
    public function index(){
    	//$diagnostic = DB::table('diagnostics')->get();
    	$diagnostic = diagnostics::all();
    	return Fractal::includes('parent_diagnostic')->collection($diagnostic, new DiagnosticsTransformer);
    }

    public function show(diagnostics $diagnostic){
    	return Fractal::includes('parent_diagnostic')->item($diagnostic, new DiagnosticsTransformer);

    }

    public function store(storeDiagnosticRequest $request){
    	$diagnostic = new diagnostics;

    	$diagnostic->name = $request->name;
        $diagnostic->description = $request->description; 
        $diagnostic->code = $request->code;

        $diagnostic->parent = ($request->has('parent')) ? $request->parent :  $diagnostic->parent;

        $diagnostic->save();

        return Fractal::includes('parent_diagnostic')->item($diagnostic, new DiagnosticsTransformer);

    }

    public function update(updateDiagnosticRequest $request, diagnostics $diagnostic){
    	$diagnostic->name = ($request->has('name')) ? $request->name :  $diagnostic->name;
        $diagnostic->description = ($request->has('description')) ? $request->description :  $diagnostic->description;
        $diagnostic->code = ($request->has('code')) ? $request->code :  $diagnostic->code;
        $diagnostic->parent = ($request->has('parent')) ? $request->parent :  $diagnostic->parent;

        $diagnostic->save();

        return Fractal::includes('parent_diagnostic')->item($diagnostic, new DiagnosticsTransformer);

    }
}
