<?php 
namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\professional_information;
use App\medical_appointments;
use Carbon\Carbon;
use App\User;
use Mail;
use App\Medications;
use App\recipes_tests;
use App\cli_recipes_tests;


//Class where extract attachment of email pop3 domain
class medicalTreatment extends Controller {
	
	public function __construct() {

	}

	public function scheduler(){
		
		return $imbox;
	}

}
