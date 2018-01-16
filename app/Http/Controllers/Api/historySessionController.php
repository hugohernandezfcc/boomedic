<?php

namespace App\Http\Controllers\Api;

use App\history_session;
use App\Transformers\HistorySessionTransformer;
use App\Http\Requests\Api\HistorySession\storeHistorySessionRequest;
use App\Http\Requests\Api\HistorySession\updateHistorySessionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class historySessionController extends Controller
{
    public function index(){
    	$hs = history_session::all();
    	return Fractal::includes('parentTest')->collection($hs, new HistorySessionTransformer);
    }

    public function show(history_session $hs){
    	return Fractal::includes('parentTest')->item($hs, new HistorySessionTransformer);

    }

    public function store(storeHistorySessionRequest $request){
    	$hs = new history_session;

    	$hs->browser = $request->browser;
    	$hs->dateIn = $request->dateIn;
    	$hs->status = $request->status;
    	$hs->dateOut = $request->dateOut;
    	$hs->createdBy = $request->createdBy;

    	$hs->save();

    	return Fractal::includes('parentTest')->item($hs, new HistorySessionTransformer);

    }

    public function update(updateHistorySessionRequest $request, history_session $hs){
    	$hs->browser = ($request->has('browser')) ? $request->browser : $hs->browser;
    	$hs->dateIn = ($request->has('dateIn')) ? $request->dateIn : $hs->dateIn;
    	$hs->status = ($request->has('status')) ? $request->status : $hs->status;
    	$hs->dateOut = ($request->has('dateOut')) ? $request->dateOut : $hs->dateOut;
    	$hs->createdBy = ($request->has('createdBy')) ? $request->createdBy : $hs->createdBy;

    	$hs->save();

    	return Fractal::includes('parentTest')->item($hs, new HistorySessionTransformer);
    }
}
