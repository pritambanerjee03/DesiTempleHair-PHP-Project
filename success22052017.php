<?php
include('includes/header.inc.php');
$orders = new orders();

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
// $salt="dRzlfdIvtG";
$salt="eCwWELxi";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
             $invoiceNumber = substr($txnid, strpos($txnid, "_") + 1);
            // $mobileNo = "7353920717";

            // $message = "Chitki.com: You have a new order. Order Ref Number: ".$invoiceNumber;

            // $orders->sendSMSViaMsgClub($mobileNo, $message);
          if($orders->updatepayuMoneyStatus($invoiceNumber)){
            if($orders->payuMoneyemailNotifications($invoiceNumber)){
              session_regenerate_id();
              
              $_SESSION['orderinvoice'] = $invoiceNumber;
              header('Location:'.APP_URL.'/thankyou.php');
              exit;
            }
           } 
           
		   }         
?>	