<?php
return array(
/** set your paypal credential **/
'client_id' => 'AbVIn0UOzZZdKIhkGJDVfhvREJTEpxOaL1IxFdohTnXkgkLV-SO9irKdhmLL00tjQJTVIIAD0aIhcau-',
'secret' => 'ECKwqs6svjxoVIY55gw-LBX23jpWUKq6jUqIOh5adCDUhtfDxWAHPxPAWsPJshjXdpZvQK4po-L5buBS',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);