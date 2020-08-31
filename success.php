<?php include('includes/header.php');
if(!$oauth->authUser()){
  header('Location:'.APP_URL.'/login');
  exit;
}
$orders = new orders();

//Store transaction information from PayPal
 $invoiceId = $_GET['cm']; 
 $txn_id = $_GET['tx'];
 $payment_gross = $_GET['amt'];
 $currency_code = $_GET['cc'];
 $payment_status = $_GET['st'];

//Get product price

if(!empty($txn_id)){
    //Inser tansaction data into the database
    // if($orders->updatePaypalStatus($invoiceId)){
    // 	if($orders->paypalEmailNotifications($invoiceId)){
    // 		session_regenerate_id();
    //         header('Location:'.APP_URL.'/thankyou/'.base64_encode($invoiceId));
    //         exit;
    // 	}
    // }

    if($orders->updatepayuMoneyStatus($invoiceId)){
            if($orders->payuMoneyemailNotifications($invoiceId)){
              session_regenerate_id();
              
              $_SESSION['orderinvoice'] = $invoiceId;
              header('Location:'.APP_URL.'/thankyou.php');
              exit;
            }
           } 

}else{
?>
  <h1>Your payment has failed.</h1>
<?php
}
?>