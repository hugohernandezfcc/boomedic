<?php 
namespace App\Http\Controllers;

//Class where extract attachment of email pop3 domain
class ImapPop3 extends Controller {
	
	public function __construct() {

	}

	public function connect($host, $port, $email, $pass){
		$imbox = imap_open ('"{"'. $host .'":"'.$port.'"/pop3}INBOX"', '"'.$email.'"', '"'.$pass.'"') or die('Cannot connect to Gmail: ' . imap_last_error());
		return $imbox;
	}

}
