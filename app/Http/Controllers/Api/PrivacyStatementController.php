<?php

namespace App\Http\Controllers\Api;

use App\privacy_statement;
use App\Transformers\PrivacyStatementTransformer;
use App\Http\Requests\Api\PrivacyStatement\storePrivacyStatementRequest;
use App\Http\Requests\Api\PrivacyStatement\updatePrivacyStatementRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class PrivacyStatementController extends Controller
{
    public function index(){
    	$ps = privacy_statement::all();
    	return Fractal::collection($ps, new PrivacyStatementTransformer);
    }

    public function show(privacy_statement $ps){
    	return Fractal::item($ps, new PrivacyStatementTransformer);

    }

    public function store(storePrivacyStatementRequest $request){
    	$ps = new privacy_statement;

    	$ps->description = $request->description;

        $ps->save();

        return Fractal::item($ps, new PrivacyStatementTransformer);

    }

    public function update(updatePrivacyStatementRequest $request, privacy_statement $ps){
    	$ps->description = ($request->has('description')) ? $request->description :  $ps->description;

        $ps->save();

        return Fractal::item($ps, new PrivacyStatementTransformer);

    }
}
