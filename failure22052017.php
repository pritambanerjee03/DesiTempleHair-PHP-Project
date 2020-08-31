<div class="paymentFailure">
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 0);
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];

$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
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
	       echo "<p>Invalid Transaction. Please try again</p>";
		   }
	   else {
         echo "<p>Your transaction was not successful, Your transaction id for this transaction is ".$txnid.".</p>";
         echo "<p>Your order status is ". $status .".</p>";  
        // echo "<h3>Your order status is ". $status .".</h3>";
         //echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
          
		 } 
?>
<!--Please enter your website homepagge URL -->
<!-- <p><a href="http://www.chitki.com"> Try Again</a></p> -->
</div>
<style type="text/css">
  .paymentFailure{
    max-width: 400px;
    margin: 0 auto;
    font-size: 20px;
    margin-top: 100px;
    text-align: center;
  } 
  .paymentFailure p{
    font-size: 20px;
    line-height: 26px;
    font-weight: normal;
    margin: 0px;
    color: #ff0000;
  }  
  .paymentFailure p a{
     border: 1px solid #006cb4;
    font-size: 20px;
    line-height: 24px;
    padding: 10px 20px;
    text-decoration: none;
    background:#006cb4;
    color: #fff;
    display: inline-block;
    margin-top: 10px;
  }  
  </style>
