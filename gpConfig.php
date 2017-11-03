<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '548436634031-nm7b31sks6202kpf3ota4ad7namgnkt6.apps.googleusercontent.com';
$clientSecret = '8bSLlDjfntWWC9Wemm2g-ceF';
$redirectURL = 'http://localhost/Tasks/';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>