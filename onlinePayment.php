<?php
// Merchant key here as provided by Payu
//$MERCHANT_KEY = "ausMAc";
 $MERCHANT_KEY = "gtKFFx";   //test details

// Merchant Salt as provided by Payu
//$SALT = "dkx7QBw5";
 $SALT = "eCwWELxi"; //test details

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://secure.payu.in";
 $PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();
$posted['key'] = $MERCHANT_KEY;
//$posted['service_provider'] = 'payu_paisa';

if($_SERVER['HTTP_HOST']=='localhost'){
  $posted['surl'] = 'http://localhost/desitemplehair/success.php';
}else{
  $posted['surl'] = 'http://www.desitemplehair.com/success.php';
}
if($_SERVER['HTTP_HOST']=='localhost'){
  $posted['furl'] = 'http://localhost/desitemplehair/failure.php';
}else{
  $posted['furl'] = 'http://www.desitemplehair.com/failure.php';
}

$posted['productinfo'] = 'Desi Temple Hair';
$id = base64_decode($_GET['id']);
include('includes/header.inc.php');
$orders = new orders();
$orderDetails = $orders->getorderDetails($id);
// pre($orderDetails);
$shippingDetail = $orders->getShippingDetails($orderDetails->shippingId);
// $billingDetail = $orders->getBillingDetails($orderDetails->billingId);
// pre($shippingDetail);
if(!empty($orderDetails)) {

  foreach($orderDetails as $key => $value) {    
    $posted[$key] = $value; 
  
  }
}

$formError = 0;
function cleanName($string) {
   return preg_replace('/[^A-Za-z ]/', '', $string); // Removes special chars.
}
function cleanNumber($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^0-9]/', '', $string); // Removes special chars.
}
$posted['firstname'] = cleanName($shippingDetail->first_name);
$posted['phone'] = cleanNumber($shippingDetail->phone);
// $posted['email'] = 'santhosh@evol.co.in';
// if(empty($posted['txnid'])) {
//   // Generate random transaction id
//   $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
// } else {
//   $txnid = $posted['txnid'];
// }
if($posted['offerAmt'] > 0){
  $posted['amount'] = $posted['amount'] - $posted['offerAmt'];
}
if($posted['couponDiscount'] > 0){
  $posted['amount'] = $posted['amount'] - $posted['couponDiscount'];
}
if($posted['amount'] < 0){
  $posted['amount'] = 0;
}

$posted['txnid'] = date('ymdhms').'_'.$posted['txnid'];
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
          // || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <div class="paymentMessage">Redirecting to payment... <br/> <span>Please do not refresh the page or do not click back button, we are redirecting to payment gateway.</span></div>
    <div class="paymentForm" >
    <br/>
    <?php if($formError) { ?>
	
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <!-- <input type="hidden" name="txnid" value="<?php echo $txnid ?>" /> -->
      <input type="hidden" name="txnid" value="<?php echo (empty($posted['txnid'])) ? '' : $posted['txnid'];?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><input name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
          <td>First Name: </td>
          <td><input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
          <td>Phone: </td>
          <td><input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr>
        <tr>
          <td>Product Info: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
        </tr>
        <tr>
          <td>Success URI: </td>
          <td colspan="3"><input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URI: </td>
          <td colspan="3"><input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
            <!-- <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" />  -->
             <!-- <input type="hidden" name="service_provider" value="" size="64" /> -->
          </td>
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Last Name: </td>
          <td><input name="lastname" id="lastname" value="<?php echo (empty($shippingDetail->last_name)) ? '' : $shippingDetail->last_name; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input name="curl" value="" /></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input name="address1" value="<?php echo (empty($shippingDetail->address_1)) ? '' : $shippingDetail->address_1; ?>" /></td>
          <td>Address2: </td>
          <td><input name="address2" value="<?php echo (empty($shippingDetail->address_2)) ? '' : $shippingDetail->address_2; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php echo (empty($shippingDetail->city)) ? '' : $shippingDetail->city; ?>" /></td>
          <td>State: </td>
          <td><input name="state" value="<?php echo (empty($shippingDetail->state)) ? '' : $shippingDetail->state; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php echo (empty($shippingDetail->country)) ? '' : $shippingDetail->country; ?>" /></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php echo (empty($shippingDetail->pincode)) ? '' : $shippingDetail->pincode; ?>" /></td>
        </tr>
        <tr>
          <td>UDF1: </td>
          <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
          <td>UDF2: </td>
          <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF3: </td>
          <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
          <td>UDF4: </td>
          <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
        <tr>
          <td>UDF5: </td>
          <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>
        <tr>
          <?php //if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit" /></td>
          <?php //} ?>
        </tr>
      </table>
    </form>
  </div>
      <style type="text/css">
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
  .paymentForm{ display: none;}
  </style>
  </body>
</html>
