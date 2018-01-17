<?php

namespace App\Http\Controllers\Api;

use App\recipes_tests;
use App\Transformers\RecipesTestsTransformer;
use App\Http\Requests\Api\RecipesTest\storeRecipesTestRequest;
use App\Http\Requests\Api\RecipesTest\updateRecipesTestRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class recipesTestController extends Controller
{
    public function index(){
    	$recipe = recipes_tests::all();
    	return Fractal::collection($recipe, new RecipesTestsTransformer);
    }

    public function show(recipes_tests $recipe){
    	return Fractal::item($recipe, new RecipesTestsTransformer);

    }

    public function store(storeRecipesTestRequest $request){
    	$recipe = new recipes_tests;

    	$recipe->type = $request->type;
        $recipe->doctor = $request->doctor; 
        $recipe->patient = $request->patient;
        $recipe->notes = $request->notes;
        $recipe->folio = $request->folio;
        $recipe->date = $request->date;
        $recipe->Data_frontend = $request->Data_frontend;
        dd($recipe);
        $recipe->save();

        return Fractal::item($recipe, new RecipesTestsTransformer);

    }

    public function update(updateRecipesTestRequest $request, recipes_tests $recipe){
    	$recipe->type = ($request->has('type')) ? $request->type :  $recipe->type;
        $recipe->doctor = ($request->has('doctor')) ? $request->doctor :  $recipe->doctor;
        $recipe->patient = ($request->has('patient')) ? $request->patient :  $recipe->patient;
        $recipe->notes = ($request->has('notes')) ? $request->notes :  $recipe->notes;
        $recipe->folio = ($request->has('folio')) ? $request->folio :  $recipe->folio;
        $recipe->date = ($request->has('date')) ? $request->date :  $recipe->date;
        $recipe->Data_frontend = ($request->has('Data_frontend')) ? $request->Data_frontend :  $recipe->Data_frontend;

        $recipe->save();

        return Fractal::item($recipe, new RecipesTestsTransformer);

    }
}
