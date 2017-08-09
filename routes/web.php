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



/**
 * Rutas con autorización de acceso
 */

Auth::routes();

Route::get('/medicalconsultations', 'HomeController@index')->name('medicalconsultations');

Route::get('profile/{status}', [
			'uses'	=>	'profile@edit',
			'as'	=>	'profile'
		]
	);

Route::post('/bye' , 'Auth\LoginController@logout');
