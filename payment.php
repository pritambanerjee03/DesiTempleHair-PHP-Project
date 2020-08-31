<?php include('includes/header.php');
if(!$oauth->authUser()){
    header('Location:'.APP_URL.'/login.php');
    exit;
} 
$db = new db();
$id = base64_decode($db->filter($_REQUEST['id']));
$orderDetails = $orders->getTotalByInvoice($id);
$orderItems = $orders->getInvoiceOrderItems($id); 
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
//$paypal_url = 'https://www.paypal.com/cgi-bin/webscr'; //live
$paypal_id = 'sandesh-seller@evol.co.in'; //Business Email
//$paypal_id = 'andrea-facilitator@duckfeet.co.uk';
?>
<script type="text/javascript">
$(document).ready(function(){
     $("#paymentform").submit();
});
</script>
<div class="paymentMessage">Redirecting to payment... <br/> <span>Please do not refresh the page or do not click back button, we are redirecting to payment gateway.</span></div>
 <form action="<?php echo $paypal_url; ?>" method="post" id="paymentform">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1"> 
        
        <!-- Specify details about the item that buyers will purchase. -->
        <?php $i=0;
            foreach ($orderItems as $orderItem) { $i++; ?>
            <input type="hidden" name="item_name_<?=$i?>" value="<?=$orderItem['productName']?>">
            <input type="hidden" name="amount_<?=$i?>" value="<?=$orderItem['unitPrice']?>">
            <input type="hidden" name="quantity_<?=$i?>" value="<?=$orderItem['quantity']?>">
            
             <?php if($orderItem['attr'] !=''){ ?>
            <input type="hidden" name="on1_<?=$i?>" value="attributes">
            <input type="hidden" name="os1_<?=$i?>" value="<?=$orderItem['attr']?>">
            <?php } ?>         
        <?php 
        } ?>
        <?php if($orderDetails->deliveryCost>0){            
             ?>
            <input type="hidden" name="shipping_1" value="<?=$orderDetails->deliveryCost?>">
        <?php }  ?> 
        <input type="hidden" name="custom" value="<?=$orderDetails->invoiceNumber?>">
        <input type="hidden" name="currency_code" value="USD">
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?=APP_URL?>'>
        <input type='hidden' name='return' value='<?=APP_URL?>/success.php'>

        
        <!-- Display the payment button. -->
        <input type="image" name="submit" border="0"
        src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
        <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
    
    </form>
    <style type="text/css">
    #paymentform{
        display: none;
    }
    .paymentMessage{
    max-width: 400px;
    margin: 0 auto;
    font-size: 24px;
    color: #235A9B;
    margin-top: 100px;
    text-align: center;
  }
  .paymentMessage span{
    font-size: 16px;
  }
   </style>