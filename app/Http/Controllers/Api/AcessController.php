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
	    CURLOPT_URL => "http://sbx03.herokuapp.com/oauth/token",
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 60000,
	    CURLOPT_CUSTOMREQUEST => "POST",
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => json_encode($data, JSON_PRETTY_PRINT),
	    CURLOPT_HTTPHEADER => array(
	        "Content-type: application/json",
	        "Accept: application/json",
	    	),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    return response()->json($err);
		} else {
		    //return response()->json($response);
		    return response()->json(json_decode(json_encode($response)));
		}

    }
}
