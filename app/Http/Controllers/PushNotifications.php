<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;


class PushNotifications extends Controller
{

	public function Sender($fmc, $body, $title) {

	    $msg = array
				 (
					'body' 	=> $body,
					'title'	=> $title,

				 );
		$fields = array
				 (
					'to'		=> $fmc,
					'notification'	=> $msg,	
				 );
	
		$headers = array
				(
					'Authorization: key=' . env('FIREBASE_ACCESS_KEY'),
					'Content-Type: application/json'
				);
		#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
				print_r($result);
			return $result;
		}
}