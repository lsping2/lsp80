<?php
include_once("./_common.php");

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/gg/src/Google_Client.php');
require_once(G5_PLUGIN_PATH.'/social_login/gg/src/contrib/Google_Oauth2Service.php');


$client = new Google_Client();

$oauth2 = new Google_Oauth2Service($client);


if (!$client->getAccessToken()) {
	$authUrl = $client->createAuthUrl();
	header('Location: '.$authUrl); 
    break;
}else{
	header('Location: /'); 
    break;
}


?>