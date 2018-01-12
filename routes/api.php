<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api', 'prefix' => '/users'], function(){

	Route::get('/',['as' => 'users', 'uses' => 'UserController@index']);
	Route::put('/',['as' => 'users.store', 'uses' => 'UserController@store']);
	Route::get('/{user}',['as' => 'user.show', 'uses' => 'UserController@show']);
	Route::post('/{user}',['as' => 'user.update', 'uses' => 'UserController@update']);
	//Route::delete('/{article}',['as' => 'articles.destroy', 'uses' => 'ArticleController@destroy']);

});

Route::group(['namespace' => 'Api', 'prefix' => '/professionalInfo'], function(){

	Route::get('/',['as' => 'professionalInfo', 'uses' => 'ProfessionalInfoController@index']);
	//Route::put('/',['as' => 'professionalInfo.store', 'uses' => 'ProfessionalInfoController@store']);
	Route::get('/{pInfo)}',['as' => 'professionalInfo.show', 'uses' => 'ProfessionalInfoController@show']);
	//Route::post('/{professionalInfo}',['as' => 'professionalInfo.update', 'uses' => 'ProfessionalInfoController@update']);

});
