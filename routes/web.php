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
	$itemMenu->text = 'Historial';
	$itemMenu->url = 'admin/pages';
	$itemMenu->icon = 'history';
	$itemMenu->label_color = 'success';
	$itemMenu->parent = 1;

	$itemMenu->save();


	$itemMenu = new App\menu();

	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'section';
	$itemMenu->text = 'CUENTA';

	$itemMenu->save();


	$itemMenu = new App\menu();

	$itemMenu->to = 'Patient';
	$itemMenu->typeitem = 'section';
	$itemMenu->text = 'TERMINOS Y CONDICIONES';

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
