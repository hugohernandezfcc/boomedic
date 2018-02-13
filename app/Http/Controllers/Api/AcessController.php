<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcessController extends Controller
{
    public function getAccesToken(Request $request){

    	$username = '';
    	$password = '';
    	$clientID = '2';
    	$clientSecret = 'UKCNKCjp0Joy5zmuNW0cTbtPGbCQ1IPoid9SIgjt';
    	$url = url('/');
    	$url.'/oauth/token';

    	if($request->has('username') && $request->has('password')){
    		$username = $request->username;
    		$password = $request->password;
    	}
    	$data = [
    		'username' => $username,
    		'password' => $password,
    		'client_id' => $clientID,
    		'client_secret' => $clientSecret,
    		'grant_type' => 'password',
    		'scope' => '*',
    	];

    	$curl = curl_init();

    	curl_setopt_array($curl, array(
	    CURLOPT_URL => "",
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => $url,
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 60000,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "POST",
	    CURLOPT_POSTFIELDS => json_encode($data),
	    CURLOPT_HTTPHEADER => array(
	        "content-type: application/json",
	    	),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    return $err;
		} else {
		    return json_decode($response));
		}




    	/*$url = url('/oauth/token');
    	$headers = ['Accept' => 'application/json'];
    	$http = new Client;

    	if($request->has('username') && $request->has('password')){
    		$username = $request->username;
    		$password = $request->password;
    	}

    	$response = $http->post($url, [
        'headers' => $headers,
        'form_params' => [
            'grant_type' => $password,
            'client_id' => $clientID,
            'client_secret' => $clientSecret,
            'username' => $username,
            'password' => $password
        	],
    	]);

    	return json_decode((string)$response->getBody(), true);*/

    }
}
