<?php
include_once "library/OAuthStore.php";
include_once "library/OAuthRequester.php";
 
define("CONSUMER_KEY", "bestapp262");
define("CONSUMER_SECRET", "UJHSG");
define("OAUTH_HOST", "http://sandbox.appprime.net");
define("REQUEST_TOKEN_URL", OAUTH_HOST."/TemanDev/rest/RequestToken/");
define("ACCESS_TOKEN_URL", OAUTH_HOST."/TemanDev/rest/AccessToken/");
 
// Init the OAuthStore
$options = array(
'consumer_key' => CONSUMER_KEY,
'consumer_secret' => CONSUMER_SECRET,
'server_uri' => OAUTH_HOST,
'request_token_uri' => REQUEST_TOKEN_URL,
'access_token_uri' => ACCESS_TOKEN_URL
);
// Note: do not use "Session" storage in production. Prefer a database storage, such as MySQL.
OAuthStore::instance("Session", $options);
 
try
{
	// STEP 1: If we do not have an OAuth token yet, go get one
	$getAuthTokenParams = null;
	// get a request token
	$tokenResultParams = OAuthRequester::requestRequestToken(CONSUMER_KEY, 0, $getAuthTokenParams);	
	// STEP 2: Get an access token
	try {				
		OAuthRequester::requestAccessToken(CONSUMER_KEY, $tokenResultParams["token"], 0, 'POST');						
	} catch (OAuthException2 $e) {
		print_r($e);
		return;
	} 
} catch(OAuthException2 $e) {
	echo "OAuthException: " . $e->getMessage();
	var_dump($e);
}


