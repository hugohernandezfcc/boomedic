<?php

namespace App\Http\Controllers\Api;

use App\medicines;
use App\Transformers\MedicinesTransformer;
use App\Http\Requests\Api\Medicines\storeMedicinesRequest;
use App\Http\Requests\Api\Medicines\updateMedicinesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class MedicinesController extends Controller
{
    public function index(){
    	$medicine = medicines::all();
    	return Fractal::includes('parent_medicine')->collection($medicine, new MedicinesTransformer);
    }

    public function show(medicines $medicine){
    	return Fractal::includes('parent_medicine')->item($medicine, new MedicinesTransformer);

    }

    public function store(storeMedicinesRequest $request){
    	$medicine = new medicines;

    	$medicine->name = $request->name;
    	$medicine->description = $request->description;
    	$medicine->code = $request->code;

    	$medicine->parent = ($request->has('parent')) ? $request->parent : $medicine->parent;

    	$medicine->save();

    	return Fractal::includes('parent_medicine')->item($medicine, new MedicinesTransformer);

    }

    public function update(updateMedicinesRequest $request, medicines $medicine){
    	$medicine->name = ($request->has('name')) ? $request->name : $medicine->name;
    	$medicine->description = ($request->has('description')) ? $request->description : $medicine->description;
    	$medicine->code = ($request->has('code')) ? $request->code : $medicine->code;

    	$medicine->parent = ($request->has('parent')) ? $request->parent : $medicine->parent;

    	$medicine->save();

    	return Fractal::includes('parent_medicine')->item($medicine, new MedicinesTransformer);
    }
}
