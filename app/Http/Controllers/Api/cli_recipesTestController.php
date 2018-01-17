<?php

namespace App\Http\Controllers\Api;

use App\cli_recipes_tests;
use App\Transformers\CliRecipesTestsTransformer;
use App\Http\Requests\Api\cli_recipes\storeCliRecipesRequest;
use App\Http\Requests\Api\cli_recipes\updateCliRecipesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class cli_recipesTestController extends Controller
{
     public function index(){
    	$cliRecipe = cli_recipes_tests::all();
    	return Fractal::includes(['medicine_data','diagnostic_test_data'])->collection($cliRecipe, new CliRecipesTestsTransformer);
    }

    public function show(cli_recipes_tests $cliRecipe){
    	return Fractal::includes(['medicine_data','diagnostic_test_data'])->item($cliRecipe, new CliRecipesTestsTransformer);

    }

    public function store(storeCliRecipesRequest $request){
    	$cliRecipe = new cli_recipes_tests;

    	$cliRecipe->medicine = $request->medicine;
    	$cliRecipe->test = $request->test;
    	$cliRecipe->recipe_test = $request->recipe_test;

    	$cliRecipe->save();

    	return Fractal::includes(['medicine_data','diagnostic_test_data'])->item($cliRecipe, new CliRecipesTestsTransformer);

    }

    public function update(updateCliRecipesRequest $request, cli_recipes_tests $cliRecipe){
    	$cliRecipe->medicine = ($request->has('medicine')) ? $request->medicine : $cliRecipe->medicine;
    	$cliRecipe->test = ($request->has('test')) ? $request->test : $cliRecipe->test;
    	$cliRecipe->recipe_test = ($request->has('recipe_test')) ? $request->recipe_test : $cliRecipe->recipe_test;

    	$cliRecipe->save();

    	return Fractal::includes(['medicine_data','diagnostic_test_data'])->item($cliRecipe, new CliRecipesTestsTransformer);
    }
}
