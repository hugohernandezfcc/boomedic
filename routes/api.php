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
	Route::put('/',['as' => 'professionalInfo.store', 'uses' => 'ProfessionalInfoController@store']);
	Route::get('/{pInfo}',['as' => 'professionalInfo.show', 'uses' => 'ProfessionalInfoController@show']);
	Route::post('/{pInfo}',['as' => 'professionalInfo.update', 'uses' => 'ProfessionalInfoController@update']);

});

Route::group(['namespace' => 'Api', 'prefix' => '/laborInfo'], function(){

	Route::get('/',['as' => 'laborInfo', 'uses' => 'LaborInfoController@index']);
	Route::put('/',['as' => 'laborInfo.store', 'uses' => 'LaborInfoController@store']);
	Route::get('/{LaborInfo}',['as' => 'laborInfo.show', 'uses' => 'LaborInfoController@show']);
	Route::post('/{LaborInfo}',['as' => 'laborInfo.update', 'uses' => 'LaborInfoController@update']);

});

Route::group(['namespace' => 'Api', 'prefix' => '/supportTicket'], function(){

	Route::get('/',['as' => 'supportTicket', 'uses' => 'SupportTicketController@index']);
	Route::put('/',['as' => 'supportTicket.store', 'uses' => 'SupportTicketController@store']);
	Route::get('/{supportTicket}',['as' => 'supportTicket.show', 'uses' => 'SupportTicketController@show']);
	Route::post('/{supportTicket}',['as' => 'supportTicket.update', 'uses' => 'SupportTicketController@update']);

});

Route::group(['namespace' => 'Api', 'prefix' => '/workboard'], function(){

	Route::get('/',['as' => 'workboard', 'uses' => 'WorkboardController@index']);
	Route::put('/',['as' => 'workboard.store', 'uses' => 'WorkboardController@store']);
	Route::get('/{workboard}',['as' => 'workboard.show', 'uses' => 'WorkboardController@show']);
	Route::post('/{workboard}',['as' => 'workboard.update', 'uses' => 'WorkboardController@update']);

});
