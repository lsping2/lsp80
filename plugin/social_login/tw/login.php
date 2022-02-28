<?php
 ini_set('display_errors', 'on'); 
include_once('./_common.php');

//ver1.0 150517 @_untitle_d


/* Start session and load library. */
require_once(G5_PLUGIN_PATH.'/social_login/tw/twitteroauth.php');

/* Build TwitterOAuth object with client credentials. */
$connection = new TwitterOAuth(TW_CONSUMER_KEY, TW_CONSUMER_SECRET);
 
/* Get temporary credentials. */
$request_token = $connection->getRequestToken(TW_OAUTH_CALLBACK);

/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

/* If last connection failed don't display authorization link. */
switch ($connection->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
    $url = $connection->getAuthorizeURL($token);
    header('Location: '.$url);
   break;
  default:
    /* Show notification if something went wrong. */
    //echo 'Could not connect to Twitter. Refresh the page or try again later.';
	header('Location: /'); 
    exit;
}
?>