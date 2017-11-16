<?php

/*
|--------------------------------------------------------------------------
| Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/medicalRegister', function () {
    return view('auth.medicalRegister');
});



/**
 * Rutas con autorización de acceso
 */

Auth::routes();

Route::get('/medicalconsultations', 'HomeController@index')->name('medicalconsultations');


Route::get('/homemedical', function () {
    return view('homemedical');
});


Route::group(['prefix' => 'user'], function(){
	// Por Método GET cacha el parametro status, "as" sirve para nombrar la ruta.
	Route::get('edit/{status}', [
			'uses'	=>	'profile@edit',
			'as'	=>	'edit'
		]
	);

	Route::post('update/{id}', [
			'uses'	=>	'profile@update',
			'as'	=>	'update'
		]
	);

	Route::get('profile/{id}', [
			'uses'	=>	'profile@show',
			'as'	=>	'profile'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'profile@redirecting',
			'as'	=>	'redirecting'
		]
	);
});



Route::group(['prefix' => 'payment'], function(){

	Route::get('index', [
			'uses'	=>	'payments@index',
			'as'	=>	'index'
		]
	);

	Route::get('create', [
			'uses'	=>	'payments@create',
			'as'	=>	'create'
		]
	);

	Route::post('store', [
			'uses'	=>	'payments@store',
			'as'	=>	'store'
		]
	);

	Route::get('delete/{id}', [
			'uses'	=>	'payments@destroy',
			'as'	=>	'destroy'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'payments@redirecting',
			'as'	=>	'redirecting'
		]
	);
	Route::post('PaymentAuthorizations',[
			'uses'	=>	'payments@PaymentAuthorizations',
			'as'	=>	'PaymentAuthorizations'
		]
	);


});



Route::group(['prefix' => 'doctor'], function(){

	Route::get('edit/{status}', [
			'uses'	=>	'doctor@edit',
			'as'	=>	'edit'
		]
	);

	Route::post('update/{id}', [
			'uses'	=>	'doctor@update',
			'as'	=>	'update'
		]
	);

	Route::get('doctor/{id}', [
			'uses'	=>	'doctor@show',
			'as'	=>	'profile'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'doctor@redirecting',
			'as'	=>	'redirecting'
		]
	);
});



Route::group(['prefix' => 'supportTicket'], function(){

	Route::get('index', [
			'uses'	=>	'supportTickets@index',
			'as'	=>	'index'
		]
	);

	Route::get('create', [
			'uses'	=>	'supportTickets@create',
			'as'	=>	'create'
		]
	);

	Route::post('store', [
			'uses'	=>	'supportTickets@store',
			'as'	=>	'store'
		]
	);

	Route::get('delete/{id}', [
			'uses'	=>	'supportTickets@destroy',
			'as'	=>	'destroy'
		]
	);

});


/*Route::post('/send', 'MailController@send');*/
Route::post('/build', 'MailController@build');



Route::post('/bye' , 'Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
