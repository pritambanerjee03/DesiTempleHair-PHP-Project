<?php
session_start();

//Include Google client library 
include_once 'googlesdk/src/Google_Client.php';
include_once 'googlesdk/src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = 'InsertGoogleClientID';
$clientSecret = 'InsertGoogleClientSecret';
$redirectURL = 'http://localhost/test1.php/';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to desihair');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>