<?php

$path = XOO_SL_PATH.'/library/Facebook';

require_once $path.'/Facebook.php';
require_once $path.'/autoload.php';
require_once $path.'/Exceptions/FacebookResponseException.php';
require_once $path.'/Exceptions/FacebookSDKException.php';
require_once $path.'/Helpers/FacebookRedirectLoginHelper.php';
 
// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


$appId      = xoo_sl_helper()->get_fb_option('gl-appid');
$appSecret  = xoo_sl_helper()->get_fb_option('gl-appSecret');
 
$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v3.1',   
]);
 

$accessToken = $_POST['socialData']['authResponse']['accessToken']; 
 
$response= "";

try {
    $response = $fb->get('/me?fields=first_name,email,last_name', $accessToken);
    return $response->getGraphUser();
} catch (FacebookResponseException $e) {
    return new WP_Error( 'fb-error', $e->getMessage() );
}
 

?>