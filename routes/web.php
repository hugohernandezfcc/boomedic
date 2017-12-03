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

	Route::post('updateProfile/{id}', [
			'uses'	=>	'profile@updateProfile',
			'as'	=>	'updateProfile'
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

	Route::get('Transactions/{id}', [
			'uses'	=>	'payments@Transactions',
			'as'	=>	'Transactions'
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

	Route::post('postPaymentWithpaypal', [
		    'as' => 'postPaymentWithpaypal',
		    'uses' => 'payments@postPaymentWithpaypal'
		]);

		// when the payment is done, this will redirect us to our page
	Route::get('getPaymentStatus',[
		    'as' => 'getPaymentStatus',
		    'uses' => 'payments@getPaymentStatus'
		]);




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


Route::group(['prefix' => 'medicalappointments'], function(){

	Route::get('index', [
			'uses'	=>	'medicalappointments@index',
			'as'	=>	'index'
		]
	);

	Route::get('update/{id}', [
			'uses'	=>	'medicalappointments@update',
			'as'	=>	'update'
		]
	);

	Route::get('store/{id}', [
			'uses'	=>	'medicalappointments@store',
			'as'	=>	'store'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'medicalappointments@redirecting',
			'as'	=>	'redirecting'
		]
	);
});



Route::group(['prefix' => 'privacyStatement'], function(){

	Route::get('index', [
			'uses'	=>	'privacyStatement@index',
			'as'	=>	'index'
		]
	);

	Route::get('create', [
			'uses'	=>	'privacyStatement@create',
			'as'	=>	'create'
		]
	);

	Route::post('store', [
			'uses'	=>	'privacyStatement@store',
			'as'	=>	'store'
		]
	);

	Route::get('delete/{id}', [
			'uses'	=>	'privacyStatement@destroy',
			'as'	=>	'destroy'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'privacyStatement@redirecting',
			'as'	=>	'redirecting'
		]
	);
	Route::post('Aceptar', [
			'uses'	=>	'privacyStatement@Aceptar',
			'as'	=>	'Aceptar'
		]
	);
	Route::post('Rechazar', [
			'uses'	=>	'privacyStatement@Rechazar',
			'as'	=>	'Rechazar'
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

Route::group(['prefix' => 'emailInbound'], function(){

	Route::get('index', [
			'uses'	=>	'emailInboundController@index',
			'as'	=>	'index'
		]
	);

	Route::get('create', [
			'uses'	=>	'emailInboundController@create',
			'as'	=>	'create'
		]
	);

	Route::post('store', [
			'uses'	=>	'emailInboundController@store',
			'as'	=>	'store'
		]
	);

	Route::get('delete/{id}', [
			'uses'	=>	'emailInboundController@destroy',
			'as'	=>	'destroy'
		]
	);

});

Route::group(['prefix' => 'verifyExpiration'], function(){

	Route::get('index', [
			'uses'	=>	'verifyExpirationController@index',
			'as'	=>	'index'
		]
	);
});

Route::post('/bye' , 'Auth\LoginController@logout');

