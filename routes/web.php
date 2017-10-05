<?php

/*
|--------------------------------------------------------------------------
| Web Routes
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

Route::get('/createmenu', function () {

    $itemMenu = new App\menu();
	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'item';
	$itemMenu->text = 'Perfil';
	$itemMenu->url = 'user/redirecting/show';
	$itemMenu->icon = 'user';
	$itemMenu->parent = 4;

	$itemMenu->save();


	$itemMenu = new App\menu();
	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'item';
	$itemMenu->text = 'Historia clinica';
	$itemMenu->url = 'admin/settings';
	$itemMenu->icon = 'street-view';
	$itemMenu->parent = 4;

	$itemMenu->save();


	$itemMenu = new App\menu();

	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'item';
	$itemMenu->text = 'Método de pago';
	$itemMenu->url = 'payment/index';
	$itemMenu->icon = 'credit-card';
	$itemMenu->parent = 4;

	$itemMenu->save();



	$itemMenu = new App\menu();

	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'item';
	$itemMenu->text = 'Aviso de privacidad';
	$itemMenu->url = 'admin/pages';
	$itemMenu->label_color = 'red';
	$itemMenu->parent = 5;

	$itemMenu->save();

	$itemMenu = new App\menu();

	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'item';
	$itemMenu->text = 'Ayuda';
	$itemMenu->url = 'admin/pages';
	$itemMenu->label_color = 'aqua';
	$itemMenu->parent = 5;

	$itemMenu->save();


});




/**
 * Rutas con autorización de acceso
 */

Auth::routes();

Route::get('/medicalconsultations', 'HomeController@index')->name('medicalconsultations');


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


	Route::get('redirecting/{page}', [
			'uses'	=>	'payments@redirecting',
			'as'	=>	'redirecting'
		]
	);

});




Route::post('/bye' , 'Auth\LoginController@logout');
