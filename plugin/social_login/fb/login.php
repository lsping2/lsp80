<?php
ini_set("display_errors","on");
include_once('./_common.php');

//ver1.0 150517 @_untitle_d


require_once(G5_PLUGIN_PATH.'/social_login/fb/facebook.php');
;

$config = array(
	'appId' => FB_CONSUMER_KEY,
	'secret' => FB_CONSUMER_SECRET
);

$facebook = new Facebook($config);

//$helper = $fb->getRedirectLoginHelper();
//$permissions = ['email', 'user_likes']; // optional

$users = $facebook->getUser();

if (!$users){
	$params = array(
		'scope' => 'email,user_likes',
		'redirect_uri' => FB_OAUTH_CALLBACK
	);
	$loginUrl = $facebook->getLoginUrl($params);
	header('Location: '.$loginUrl);
	break;
}else{
	//die('Error');
	header('Location: ./fblogin.php'); 
  break;

}



?>