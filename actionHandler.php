<?php
ini_set('error_reporting', E_ALL);
ini_set("display_errors","0"); 
include_once('includes/header.inc.php');
$products = new products();
$cart = new cart();
$orders = new orders();
$oauth = new oauth();
$frontEnd = new front_end();
$action = isset($_POST['action'])?$_POST['action']:NULL;
if($action){
	switch ($action) {	

		case 'completeOrder':
			
			// if($_POST['fullName']!='' && $_POST['mobileNumber']!='' && $_POST['address']!=''){
			// 	if(preg_match('/^\d{10}$/',$_POST['mobileNumber'])) // phone number is valid
   //  			{
    				
			if($orders->completeOrder()){
						header('Location:'.APP_URL.'/thankyou.php');
						exit;
					
			}else{

				$report->setReport('error_message','Error while payment Please try again!');
				$frontEnd->redirect('/makepayment.php'); //Redirect to the referrer page if there is one
				exit;
			}	

			// }
			// else{
			// 	header('Location:'.APP_URL);
			// 	exit;
			// }

			exit;
		break;
		case 'completePayumoneyOrder':

		// echo 'Hiii';
		// exit;
					
			$orderId = $orders->completePayumoneyOrder();
			if($orderId){
				$id = base64_encode($orderId);
				header('Location:'.APP_URL.'/payment.php?id='.$id);
				exit;
			}
					

			exit;
		break;

		case 'completeGiftOffersOrder':
			
			if($_POST['fullName']!='' && $_POST['mobileNumber']!='' && $_POST['address']!=''){
				if(preg_match('/^\d{10}$/',$_POST['mobileNumber'])) // phone number is valid
    			{
    				
					$orderId = $orders->completeGiftOffersOrder();
					if($orderId){
						$id = base64_encode($orderId);
						header('Location:'.APP_URL.'/onlinePayment.php?id='.$id);
						exit;
					}
				}else{
					$report->setReport('error_message','Enter valid 10 digit mobile number.');
					$frontEnd->redirect('/checkout'); //Redirect to the referrer page if there is one
					exit;
				}	

			}else{
				header('Location:'.APP_URL);
				exit;
			}

			exit;
		break;
		case 'login':

				//pre($_POST); exit;
			 if($_POST['email']!='' && $_POST['password']!=''){
				
				if($oauth->logUserIn()){

					if(isset($_REQUEST['nextUrl']) && $_REQUEST['nextUrl']!=''){

						header('Location:'.APP_URL.'/'.base64_decode($_REQUEST['nextUrl']));
					}else{
						//$frontEnd->redirect('/useraccount'); //Redirect to the referrer page if there is one
						// header('Location:'.APP_URL.'/');	
						// exit;
						header('Location:'.APP_URL.'/myaccount.php');	
					}
					exit;
				}else{
					
					if(isset($_REQUEST['nextUrl']) && $_REQUEST['nextUrl']!=''){
						$report->setReport('error_message','Invalid Email or Password.');
						$frontEnd->redirect('/cartlogin.php?next='.$_REQUEST['nextUrl']); //Redirect to the referrer page if there is one
					}else{
						$report->setReport('error_message','Invalid Email or Password.');
						$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
					}
					
					exit;
					// header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('invalid'));
					// exit;
				}

			}else{
				$report->setReport('error_message','Please fill all the fields.');
				$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
				//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('emptyfields'));
				exit;
			}

			exit;
		break;
		case 'register':

			 if(strtolower($_POST['captcha1']) !=strtolower($_SESSION['captcha_id1'])){
			 	$report->setReport('error_message','Invalid captcha code!');
					$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
					exit;
			 }	
			 if($_POST['fullName']!='' && $_POST['mobileNumber']!='' && $_POST['password']!='' && $_POST['email']!=''){
			 	if(preg_match('/\s/',$_POST['password'])){
			 		$report->setReport('error_message','Password should not contain spaces!');
					$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
					exit;
			 	}
				$reg = $oauth->registerUser();
				if($reg){
					if($reg ==='alredyRegistred'){

							if(isset($_REQUEST['nextUrl']) && $_REQUEST['nextUrl']!=''){
								$report->setReport('error_message','The email address you entered is already exist.');
								$frontEnd->redirect('/cartlogin.php?next='.$_REQUEST['nextUrl']); //Redirect to the referrer page if there is one
								//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('alredyRegistred'));
								exit;
							}else{
								$report->setReport('error_message','The email address you entered is already exist.');
								$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
								//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('alredyRegistred'));
								exit;
							}

						}else{
							if(isset($_REQUEST['nextUrl']) && $_REQUEST['nextUrl']!=''){
								$report->setReport('success_message','You have successfully registered. Login below!');
								$frontEnd->redirect('/cartlogin.php?next='.$_REQUEST['nextUrl']); //Redirect to the referrer page if there is one
								//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('success'));
								exit;
							}else{
								$report->setReport('success_message','You have successfully registered. Login below!');
								$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
								//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('success'));
								exit;
							}
						}
				}else{
					$report->setReport('error_message','Error while registering Please try again!');
					$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
					//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('error'));
					exit;
				}
					
			}else{
				$report->setReport('error_message','Please fill all the fields.');
				$frontEnd->redirect('/login.php'); //Redirect to the referrer page if there is one
				//header('Location:'.APP_URL.'/loginregister.php?msg='.base64_encode('emptyfields'));
				exit;
			}
			exit;
		break;
		case 'changepassword':
			 if($_POST['oldpassword']!='' && $_POST['newpassword']!='' && $_POST['confirmpassword']!=''){

			 	if($_POST['newpassword'] !=$_POST['confirmpassword']){
			 		$report->setReport('error_message1','New password and confirm password does not match.');
					$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
			 		//header('Location:'.APP_URL.'/changepassword/'.base64_encode('doesnotmatch'));
					exit;
			 	}

				if($oauth->changePassword()){
					$report->setReport('success_message1','Password has been changed successfully.');
					$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
					//header('Location:'.APP_URL.'/changepassword/'.base64_encode('success'));
					exit;
				}else{
					$report->setReport('error_message1','Invalid old password.');
					$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
					//header('Location:'.APP_URL.'/changepassword/'.base64_encode('error'));
					exit;
				}

			}else{
				$report->setReport('error_message1','Please fill all the fields.');
				$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
				//header('Location:'.APP_URL.'/changepassword/'.base64_encode('emptyfields'));
				exit;
			}

			exit;
		break;
		case 'forgotpassword':
			 if($_POST['email']!=''){
			 	if($oauth->forgotPassword()){
			 		$report->setReport('success_message','Password has been changed, please check your email.');
					$frontEnd->redirect('/forgotpassword.php'); //Redirect to the referrer page if there is one
			 		//header('Location:'.APP_URL.'/forgotpassword/'.base64_encode('success'));
					exit;
				}else{
					$report->setReport('error_message','Email address does not exits.');
					$frontEnd->redirect('/forgotpassword.php'); //Redirect to the referrer page if there is one
					//header('Location:'.APP_URL.'/forgotpassword/'.base64_encode('error'));
					exit;
				}
				
			}else{
				$report->setReport('error_message','Please fill all the fields.');
				$frontEnd->redirect('/forgotpassword.php'); //Redirect to the referrer page if there is one
				//header('Location:'.APP_URL.'/forgotpassword/'.base64_encode('emptyfields'));
				exit;
			}

			exit;
		break;
		case 'updateUserDetails':
			if($_POST['fullName']!='' && $_POST['mobileNumber']!=''){
				if($oauth->updateUserDetails()){
					$report->setReport('success_message','Your details are updated successfully.');
					$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
					exit;
				}else{
					$report->setReport('error_message','Error while updating details! Please try again.');
					$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
					exit;
				}
			}else{
				$report->setReport('error_message','Please fill all the fields.');
				$frontEnd->redirect('/myaccount.php'); //Redirect to the referrer page if there is one
				exit;
			}
		exit;	
		break;
		case 'outofStockCartItems':			
    		
			if($cart->outofStockCartItems()){
				if($oauth->authUser()){
					header('Location:'.APP_URL.'/checkout');
					exit;
				}else{
					header('Location:'.APP_URL.'/createAccount.php?next='.base64_encode('checkout.php'));
					exit;
				}				
			}else{
				if($oauth->authUser()){
					header('Location:'.APP_URL.'/checkout');
					exit;
				}else{
					header('Location:'.APP_URL.'/createAccount.php?next='.base64_encode('checkout.php'));
					exit;
				}
			}
				
			exit;
		break;

		
		case 'saveShippingAddress':

			// pre('Hiii');
			// exit;
			if($orders->saveShippingAddress()){
				$report->setReport('success_message','Address added successfully.');
				$frontEnd->redirect('/checkout.php'); //Redirect to the referrer page if there is one
				exit;
			}else{
				$report->setReport('error_message','Error while adding details! Please try again.');
				$frontEnd->redirect('/checkout.php'); //Redirect to the referrer page if there is one
				exit;
			}
			
		exit;	
		break;


		case 'saveBillingAddress':

			
			if($orders->saveBillingAddress()){
				$report->setReport('success_message','Address added successfully.');
				$frontEnd->redirect('/checkout.php'); //Redirect to the referrer page if there is one
				exit;
			}else{
				$report->setReport('error_message','Error while adding details! Please try again.');
				$frontEnd->redirect('/checkout.php'); //Redirect to the referrer page if there is one
				exit;
			}
			
		exit;	
		break;
	
		case 'updateShippingAddress':

			
			if($orders->updateShippingAddress()){
				$report->setReport('success_message','Address has been updated successfully.');
				$frontEnd->redirect('/myaddresses.php'); //Redirect to the referrer page if there is one
				exit;
			}else{
				$report->setReport('error_message','Error while updating details! Please try again.');
				$frontEnd->redirect('/editShippingAddress.php?shippingId='.base64_encode($_POST['shippingId'])); //Redirect to the referrer page if there is one
				exit;
			}
			
		exit;	
		break;

		case 'updateBillingAddress':

			
			if($orders->updateBillingAddress()){
				$report->setReport('success_message','Address has been updated successfully.');
				$frontEnd->redirect('/myaddresses.php'); //Redirect to the referrer page if there is one
				exit;
			}else{
				$report->setReport('error_message','Error while updating details! Please try again.');
				$frontEnd->redirect('/editBillingAddress.php?billingId='.base64_encode($_POST['billingId'])); //Redirect to the referrer page if there is one
				exit;
			}
			
		exit;	
		break;

		
		case 'saveNewReview':
			
			if($orders->saveNewReview()){
				$report->setReport('success_message','Your review has been accepted for moderation.');
				$frontEnd->redirect('/detail.php?productId='.base64_encode($_POST['productId'])); //Redirect to the referrer page if there is one
				exit;
			}else{
				$report->setReport('error_message','Error while submitting the review! Please try again.');
				$frontEnd->redirect('/detail.php?productId='.base64_encode($_POST['productId'])); //Redirect to the referrer page if there is one
				exit;
			}
			
		exit;	
		break;

		

	    default:
			echo "Access Denied!";
			exit;
		break;
	}
}
?>