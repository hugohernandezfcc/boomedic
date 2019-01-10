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

Route::get('/loginId/{id}', function ($id){
	Auth::loginUsingId($id);
     return redirect()->intended(route('medicalconsultations'));
});

/**
 * Rutas con autorización de acceso
 */

Auth::routes();

/**
*Rutas para registro con redes sociales
*/
Route::post('SMRegister', ['as' => 'SMRegister.createbySocialMedia', 'uses' => 'Auth\RegisterController@createbySocialMedia']);
Route::get('medicalRegister/society', ['as' => 'medicalRegister/society', 'uses' => 'Auth\RegisterController@index']);
Route::get('fcm/{code}', 'Auth\RegisterController@fcm')->name('fcm/{code}');
Route::get('loginusers/{id}', 'Auth\RegisterController@loginusers')->name('loginusers/{id}');
Route::get('verify/{code}', 'Auth\RegisterController@verify')->name('verify/{code}');
Route::get('/returnverify', 'HomeController@returnverify')->name('/returnverify');




Route::get('/medicalconsultations', 'HomeController@index')->name('medicalconsultations');
Route::get('logoutback', 'HomeController@logoutback')->name('logoutback');


Route::post('/medicalconsultations/recent', 'HomeController@recent')->name('medicalconsultations/recent');
Route::get('/medicalconsultations/showrecent', 'HomeController@showrecent')->name('medicalconsultations/showrecent');
Route::get('/medicalconsultations/notificationdr/{id}', 'HomeController@notificationdr')->name('medicalconsultations/notificationdr/{id}');
Route::get('HomeController/notify', 'HomeController@notify')->name('HomeController/notify');
Route::get('HomeController/notify2', 'HomeController@notify2')->name('HomeController/notify2');
Route::get('HomeController/messages', 'HomeController@messages')->name('HomeController/messages');
Route::get('HomeController/listpatients', 'HomeController@listpatients')->name('HomeController/listpatients');
Route::get('HomeController/listpatients2/{id}', 'HomeController@listpatients2')->name('HomeController/listpatients2/{id}');
Route::get('/appointments', 'HomeController@appointments')->name('/appointments');

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

	Route::get('verify/{id}', [
			'uses'	=>	'profile@verify',
			'as'	=>	'verify'
		]
	);	

	Route::post('update/{id}', [
			'uses'	=>	'profile@update',
			'as'	=>	'update'
		]
	);

	Route::post('userSearch/', [
			'uses'	=>	'profile@userSearch',
			'as'	=>	'userSearch'
		]
	);

	Route::post('saveFamily/', [
			'uses'	=>	'profile@saveFamily',
			'as'	=>	'saveFamily'
		]
	);

	Route::post('updateProfile/{id}', [
			'uses'	=>	'profile@updateProfile',
			'as'	=>	'updateProfile'
		]
	);
	Route::post('loginSon', [
			'uses'	=>	'profile@loginSon',
			'as'	=>	'loginSon'
		]
	);

	Route::post('cropProfile/{id}', [
			'uses'	=>	'profile@cropProfile',
			'as'	=>	'cropProfile'
		]
	);

	Route::get('profile/{id}', [
			'uses'	=>	'profile@show',
			'as'	=>	'profile'
		]
	);
	Route::get('select/{id}', [
			'uses'	=>	'profile@select',
			'as'	=>	'select'
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

	Route::post('laborInformation/{id}', [
			'uses'	=>	'doctor@update',
			'as'	=>	'laborInformation'
		]
	);

	Route::get('doctor/{id}', [
			'uses'	=>	'doctor@show',
			'as'	=>	'doctor'
		]
	);

	Route::get('settingAss', [
			'uses'	=>	'doctor@settingAss',
			'as'	=>	'settingAss'
		]
	);	

	Route::get('deleteAssistant/{id}', [
			'uses'	=>	'doctor@deleteAssistant',
			'as'	=>	'deleteAssistant'
		]
	);

	Route::get('verify/{id}', [
			'uses'	=>	'doctor@verify',
			'as'	=>	'verify'
		]
	);
	Route::post('saveAssistant', [
			'uses'	=>	'doctor@saveAssistant',
			'as'	=>	'saveAssistant'
		]
	);	

	Route::post('laborInformationNext/{id}', [
			'uses'	=>	'doctor@laborInformationNext',
			'as'	=>	'laborInformationNext'
		]
	);

	Route::get('laborInformationView/{id}', [
			'uses'	=>	'doctor@laborInformationView',
			'as'	=>	'laborInformationView'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'doctor@redirecting',
			'as'	=>	'redirecting'
		]
	);

	Route::post('updateDoctor/{id}', [
			'uses'	=>	'doctor@updateDoctor',
			'as'	=>	'updateDoctor'
		]
	);

	Route::post('cropDoctor/{id}', [
			'uses'	=>	'doctor@cropDoctor',
			'as'	=>	'cropDoctor'
		]
	);
	Route::get('delete/{id}', [
			'uses'	=>	'doctor@destroy',
			'as'	=>	'destroy'
		]
	);
	Route::get('viewPatient/{id}', [
			'uses'	=>	'doctor@viewPatient',
			'as'	=>	'doctor'
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

	Route::post('store', [
			'uses'	=>	'medicalappointments@store',
			'as'	=>	'store'
		]
	);
	
		Route::get('showPaymentMethods', [
			'uses'	=>	'medicalappointments@showPaymentMethods',
			'as'	=>	'showPaymentMethods'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'medicalappointments@redirecting',
			'as'	=>	'redirecting'
		]
	);
});

Route::group(['prefix' => 'clinicHistory'], function(){

	Route::get('index', [
			'uses'	=>	'clinicHistory@index',
			'as'	=>	'index'
		]
	);
		Route::get('cHistory', [
			'uses'	=>	'clinicHistory@show',
			'as'	=>	'cHistory'
		]
	);
	Route::get('edit/{id}', [
			'uses'	=>	'clinicHistory@edit',
			'as'	=>	'edit'
		]
	);

	Route::get('update/{id}', [
			'uses'	=>	'clinicHistory@update',
			'as'	=>	'update'
		]
	);

	Route::post('save', [
			'uses'	=>	'clinicHistory@save',
			'as'	=>	'save'
		]
	);
	Route::get('store', [
			'uses'	=>	'clinicHistory@store',
			'as'	=>	'store'
		]
	);

	Route::get('reSender/{id}', [
			'uses'	=>	'clinicHistory@reSender',
			'as'	=>	'reSender'
		]
	);
	Route::get('redirecting/{page}', [
			'uses'	=>	'clinicHistory@redirecting',
			'as'	=>	'redirecting'
		]
	);
});

Route::group(['prefix' => 'workboardDr'], function(){

	Route::get('index/{id}', [
			'uses'	=>	'workboardDr@index',
			'as'	=>	'index'
		]
	);

	Route::get('update/{id}', [
			'uses'	=>	'workboardDr@update',
			'as'	=>	'update'
		]
	);

	Route::post('create/{id}', [
			'uses'	=>	'workboardDr@create',
			'as'	=>	'create'
		]
	);
	

	Route::get('redirecting/{page}', [
			'uses'	=>	'workboardDr@redirecting',
			'as'	=>	'redirecting'
		]
	);
});


Route::group(['prefix' => 'Conversations'], function(){

	Route::get('index', [
			'uses'	=>	'ConversationsController@index',
			'as'	=>	'index'
		]
	);

	Route::get('messages/{id}', [
			'uses'	=>	'ConversationsController@messages',
			'as'	=>	'messages'
		]
	);	
	Route::post('sendMessages', [
			'uses'	=>	'ConversationsController@sendMessages',
			'as'	=>	'sendMessages'
		]
	);	
	Route::get('redirecting/{page}', [
			'uses'	=>	'ConversationsController@redirecting',
			'as'	=>	'redirecting'
		]
	);
});


Route::group(['prefix' => 'drAppointments'], function(){

	Route::get('index/{id}', [
			'uses'	=>	'drAppointments@index',
			'as'	=>	'index'
		]
	);

	Route::post('cancelAppointment', [
			'uses'	=>	'drAppointments@cancelAppointment',
			'as'	=>	'cancelAppointment'
		]
	);	

	Route::post('confirmTimeBlocker', [
			'uses'	=>	'drAppointments@confirmTimeBlocker',
			'as'	=>	'confirmTimeBlocker'
		]
	);

	Route::post('editTimeBlocker', [
			'uses'	=>	'drAppointments@editTimeBlocker',
			'as'	=>	'editTimeBlocker'
		]
	);	
	Route::get('deleteBlocker/{id}', [
			'uses'	=>	'drAppointments@destroy',
			'as'	=>	'destroy'
		]
	);	

	Route::get('redirecting/{page}', [
			'uses'	=>	'drAppointments@redirecting',
			'as'	=>	'redirecting'
		]
	);
});

Route::group(['prefix' => 'reports'], function(){

	Route::get('index', [
			'uses'	=>	'reports@index',
			'as'	=>	'index'
		]
	);

	Route::get('redirecting/{page}', [
			'uses'	=>	'reports@redirecting',
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

Route::group(['prefix' => 'help'], function(){

	Route::get('index', [
			'uses'	=>	'help@index',
			'as'	=>	'index'
		]
	);

});

Route::group(['prefix' => 'emails'], function(){

	Route::get('verify/{code}', [
			'uses'	=>	'emails@verify',
			'as'	=>	'verify'
		]
	);

	Route::get('create', [
			'uses'	=>	'supportTickets@create',
			'as'	=>	'create'
		]
	);

});

Route::group(['prefix' => 'history'], function(){

	Route::get('index', [
			'uses'	=>	'history@index',
			'as'	=>	'index'
		]
	);


	Route::get('moredays', [
			'uses'	=>	'history@moredays',
			'as'	=>	'moredays'
		]
	);

	Route::post('store', [
			'uses'	=>	'history@store',
			'as'	=>	'store'
		]
	);



});

Route::post('/bye' , 'Auth\LoginController@logout');


