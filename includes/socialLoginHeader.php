<?php


//GOOGLE LOGIN


########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id 		= '54990800951-fanffp2ff4g909htjva1klptvm6e3ojk.apps.googleusercontent.com';
$google_client_secret 	= 'cbhhNoyTX7yqBeuAv2QfZdwl';
$google_redirect_url 	= 'http://localhost/desitemplehair/login.php'; //path to your script
$google_developer_key 	= 'AIzaSyBpjPXpIkvSRK1Ehv6LZBtFfyFDtyMOhuI';


//include google api files
require_once 'googlesdk/src/Google_Client.php';
require_once 'googlesdk/src/contrib/Google_Oauth2Service.php';

$gClient = new Google_Client();
$gClient->setApplicationName('Login to desitemplehair');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}


if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{
	  //For logged in user, get details from google using access token
	  $userG 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $userG['id'];
	  $user_name 			= filter_var($userG['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($userG['email'], FILTER_SANITIZE_EMAIL);

	  $_SESSION['social']['userName']=$user_name;
	  $_SESSION['social']['email']=$email;


	  if($oauth->checkgoogleUserExists($email,$user_name,$user_id)){  
			
				$frontEnd->redirect('/myaccount.php');
					
	  }else{	  	
				$frontEnd->redirect('/login.php');	

	  }
	  //$profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  //$profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	 // $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  $_SESSION['token'] 	= $gClient->getAccessToken();
}
else 
{
	//For Guest user, get google login url
	$authUrl = $gClient->createAuthUrl();
}
?>