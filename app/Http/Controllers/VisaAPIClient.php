<?php 
namespace App\Http\Controllers;
//Class where the CURL connection is made with VISA
class VisaAPIClient extends Controller {
	
	public function __construct() {
		$this->timeout = 80;
		$this->connectTimeout = 30;
	}
	
	public function loggingHelper( $response, $curl, $testInfo, $requestBody ) {
		printf("%s\n",$testInfo);
		if(!$response) {
			printf ('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
		} else {
			if (empty($requestBody) == false && $requestBody != '') {
				$json = json_decode($requestBody);
				$json = json_encode($json, JSON_PRETTY_PRINT);
				//printf("Request Body : %s\n", $json);
			}
			$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
			$header = substr($response, 0, $header_size);
			$body = substr($response, $header_size);
			printf ("Response Status: %s\n",curl_getinfo($curl, CURLINFO_HTTP_CODE));
			//printf($header);
			if (empty($body) == false && $body != '') {
				$json = json_decode($body);
				$json = json_encode($json, JSON_PRETTY_PRINT);
				//printf("Response Body : %s\n", $json);
			}
			
		}
	}
	
	/* Correlation Id ( ex-correlation-id ) is an optional header while making an API call. You can skip passing the header while calling the API's. */
	public function getCorrelationId() {
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
		shuffle($seed);
		$rand = '';
		foreach (array_rand($seed, 12) as $k) $rand .= $seed[$k];
		return $rand."_SC";
	}
	
	public function getBasicAuthHeader($userId, $password) {
		$authString = $userId.":".$password;
		$authStringBytes = utf8_encode($authString);
		$authloginString = base64_encode($authStringBytes);
		return "Authorization:Basic ".$authloginString;
	}
	
	public function doMutualAuthCall($method, $path, $testInfo, $requestBodyString, $inputHeaders = array()) {
		$curl = curl_init ();
		$method = strtolower ( $method );
		$certificatePath = '';
		$privateKey = '';
		$userId = env('VISA_USERID');
		$password = env('VISA_PASSWORD');
		$absUrl = env('VISA_URL').$path;
		$authHeader = $this->getBasicAuthHeader($userId, $password);
		
		$headers = (array("Accept: application/json", $authHeader, "ex-correlation-id: ".$this->getCorrelationId()));
		if (count($inputHeaders) > 0) {
			foreach ($inputHeaders as &$header) {
				array_push($headers, $header);
			}
		}
		$opts = array ();
		if ($method == 'get') {
			$opts [CURLOPT_HTTPGET] = 1;
		} elseif ($method == 'post') {
			array_push($headers, "Content-Type: application/json");
			$opts [CURLOPT_POST] = 1;
			$opts [CURLOPT_POSTFIELDS] = $requestBodyString;
		}
		
		$opts [CURLOPT_URL] = $absUrl;
		$opts [CURLOPT_RETURNTRANSFER] = true;
		$opts [CURLOPT_CONNECTTIMEOUT] = $this->connectTimeout;
		$opts [CURLOPT_TIMEOUT] = $this->timeout;
		$opts [CURLOPT_HTTPHEADER] = $headers;
		$opts [CURLOPT_HEADER] = 1;
		$opts [CURLOPT_SSLCERT] = $certificatePath;
		$opts [CURLOPT_SSLKEY] = $privateKey;
		
		curl_setopt_array ( $curl, $opts );
		$response = curl_exec ( $curl );
		$this->loggingHelper( $response, $curl, $testInfo, $requestBodyString );
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		curl_close ( $curl );
		$body = substr($response, $header_size);
		if($statusCode == '201'){
			return $statusCode;
		} else {	
			if (empty($body) == false && $body != '') {
				$json = json_decode($body);
				$json = json_encode($json->responseStatus->details[0]->message, JSON_PRETTY_PRINT);
				$resp = str_replace('"',' ', $json);
				return $resp;
			}
		
		}
	}
	
	//This data is passed from the PaymentsAutorization controller
	public function doXPayTokenCall($method, $baseUrl, $resource_path, $query_string, $testInfo, $requestBodyString, $inputHeaders = array()) {
		$curl = curl_init ();
		$method = strtolower ( $method );
		//These data are provided by visa.
		$sharedSecret = env('VISA_SHARETSECRET');
		$apiKey = env('VISA_APIKEY');
		//To determine what time the service started.
		$time = time(); 
		$preHashString = $time.$resource_path.$query_string.$requestBodyString; 
		$xPayToken = "xv2:".$time.":".hash_hmac('sha256', $preHashString, $sharedSecret);
		$headers = (array("Accept: application/json", "X-PAY-TOKEN: ".$xPayToken, "ex-correlation-id: ".$this->getCorrelationId()));
		$absUrl = env('VISA_URL').$baseUrl.$resource_path.'?'.$query_string;
		if (count($inputHeaders) > 0) {
			foreach ($inputHeaders as &$header) {
				array_push($headers, $header);
			}
		}
		$opts = array ();
		if ($method == 'get') {
			$opts [CURLOPT_HTTPGET] = 1;
		} elseif ($method == 'post') {
			array_push($headers, "Content-Type: application/json");
			$opts [CURLOPT_POST] = 1;
			$opts [CURLOPT_POSTFIELDS] = $requestBodyString;
		} elseif ($method == 'put') {
			array_push($headers, "Content-Type: application/json");
			$opts [CURLOPT_CUSTOMREQUEST] = "PUT";
			$opts [CURLOPT_POSTFIELDS] = $requestBodyString;
		}
	
		$opts [CURLOPT_URL] = $absUrl;
		$opts [CURLOPT_RETURNTRANSFER] = true;
		$opts [CURLOPT_CONNECTTIMEOUT] = $this->connectTimeout;
		$opts [CURLOPT_TIMEOUT] = $this->timeout;
		$opts [CURLOPT_HTTPHEADER] = $headers;
		$opts [CURLOPT_HEADER] = 1;
		
		curl_setopt_array ( $curl, $opts );
		$response = curl_exec ( $curl );
		$this->loggingHelper( $response, $curl, $testInfo, $requestBodyString );
		$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		curl_close ( $curl );
		$body = substr($response, $header_size);
		//Status code esmel HTTP_Code, so it will only be 201 or 400 in this case.
		if($statusCode == '201'){
				$json = json_decode($body);
				$json = json_encode($json->referenceId, JSON_PRETTY_PRINT);
				$resp = str_replace('"','', $json);
				$matriz = array($statusCode, $resp);
			return $matriz;
		} else {
			//If payment is not approved, the internal status code must be searched within the answer json.
			if (empty($body) == false && $body != '') {
				$json = json_decode($body);
				$json = json_encode($json->responseStatus->details[0]->message, JSON_PRETTY_PRINT);
				//The quotation marks are removed so that the code is clean and can be found in the trans.
				$resp = str_replace('"','', $json);
				return $resp;
			}
		
		}
	}
}