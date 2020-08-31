<!DOCTYPE html5>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Invoice - Desi temple hair</title>

<?php
   include ('includes/header.inc.php');
   
   $db = new DB();

   // $id = base64_decode($_REQUEST['id']);
   if(isset($_REQUEST['id']) && $_REQUEST['id']!='' && is_numeric(base64_decode($_REQUEST['id']))){
        $id = base64_decode($_REQUEST['id']);
    }else{
        header('Location:'.APP_URL);
        exit;
    }

   $query = "SELECT id,totalAmount,subTotal,deliveryCost,offerAmt,invoiceNo,fullName,orderStatus,shippingId,billingId,dateTime,couponDiscount,dateTime FROM ".ORDER_DETAILS." WHERE id='".$id."'";
   $results = $db->get_row($query, ture);
   // pre($results);
   // echo "SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$results->shippingId."'";
   $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$results->shippingId."'",true);
   $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$results->billingId."'",true);
   $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$results->id."' AND active='1'");

   if(!$oauth->authUser()){
        header('Location:'.APP_URL);
        exit;
    }
?>

</head>
<body style="padding:20px 0;">
<input type="hidden" name="awbno" id="awbno" value="" />
<div style="width:990px;margin:0 auto;">
    <div style="height:150px;">
    <div style="width:400px;float:left;font:24px/1px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;margin-top:50px; color:#353537;"><a href="index.php"><img src="images/logo.png"></a></div>
    <div style="width:250px;float:right;margin-top:30px;" align="right">
    	<p style="font:15px/1px Helvetica, Arial, sans-serif;color:#CCC;font-weight:bold;">INVOICE DATE TIME</p>
        <p style="font:22px/1px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;"><?=stdDateFormat($results->dateTime)?></p>
        <p style="font:12px/1px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;">ORDER STATUS: <?=$results->orderStatus?></p>
    </div>
    <?php if($results->invoiceNo!=''){ ?>
      <div style="width:300px;float:right;margin-top:30px;" align="right">
      	<p style="font:15px/1px Helvetica, Arial, sans-serif;color:#CCC;font-weight:bold;">INVOICE #</p>
          <p style="font:22px/1px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;"><?php echo $results->invoiceNo; ?></p>
      </div>
    <?php }?>


    </div>
    <div style="clear:both;"></div>
    <div style="height:200px;margin:0;padding-top:10px;">
        <div style="width:315px;float:left;">
        <h4 style="font-family:Helvetica, Arial, sans-serif;color:#000;margin-top:0;">BILLING ADDRESS</h4>
        <p style="font:14px/18px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;">
        <strong style="text-transform:capitalize;"><?=$billingDetail->first_name?> <?=$billingDetail->last_name?></strong><br />
        <?=$billingDetail->address_1?>,<br />
        <?=$billingDetail->address_2?>,<br />
        <?=$billingDetail->landmark?>,<br />
        <?=$billingDetail->city?> - <?=$billingDetail->pincode?>,<br />
        <?=$billingDetail->state?>, <?=$billingDetail->country?>.<br /><br />
        Ph.: <?=$billingDetail->phone?><br />
        Email: <?=$_SESSION['email']?></p>
      </div>
      <div style="width:315px;float:left;">
        <h4 style="font-family:Helvetica, Arial, sans-serif;color:#000;margin-top:0;">SHIPPING ADDRESS</h4>
        <p style="font:14px/18px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;">
        <strong style="text-transform:capitalize;"><?=$shippingDetail->first_name?> <?=$shippingDetail->last_name?></strong><br />
        <?=$shippingDetail->address_1?>,<br />
        <?=$shippingDetail->address_2?>,<br />
        <?=$shippingDetail->landmark?>,<br />
        <?=$shippingDetail->city?> - <?=$shippingDetail->pincode?>,<br />
        <?=$shippingDetail->state?>, <?=$shippingDetail->country?>.<br /><br />
        Ph.: <?=$shippingDetail->phone?><br />
        Email: <?=$_SESSION['email']?></p>
      </div>
      <div style="float:left; width:330px;">
          <div>
            <h5 style="font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:300;margin:0;">USD</h5>
            <p><span style="font:24px/1px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;margin-top:10px;width:115px;"><?=$results->totalAmount?></span></p>
          </div>
          <div style="margin-top:25px;">
            <h5 style="font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:300;margin:0;">PAYMENT TYPE</h5>
            <p><span style="font:24px/1px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;margin-top:10px;width:115px;">Prepaid</span></p>
          </div>
          <div style="margin-top:25px;">
            <h5 style="font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:300; margin:0 0 10px 0;">AWB#</h5>
            <div id="bcTarget"></div>
          </div>
      </div>
      
      
     </div>
     
     
     <div style="clear:both;"></div>
    
  <div style="height:auto;margin:0;padding:40px 0;">
    <div style="border-top:1px solid #CCC;" align="center">
    <h4 style="font-family:Helvetica, Arial, sans-serif;color:#929292;margin-top:0;padding:30px 0 20px 0 !important;font-weight:300">ORDER DETAILS</h4>
   	</div>
      <table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr style="text-transform:uppercase;">
    <td width="40%" style="font:13px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="left">Details</td>
    <td width="20%" style="font:13px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="center">Quantity</td>
    <td width="20%" style="font:13px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="right">Unit Price</td>
    <td width="20%" style="font:13px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="right">Amount</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  
  <?foreach($records as $record){

      $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                  WHERE productId='".$record['productId']."'", true);
      $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$record['productOptionId']."'", true);
        $attrValueSet='';   
            foreach ($productAttrubutes as $productAttrubute) {
                $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
            }
    ?>
    <tr>
      <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;" align="left">
        <div class="ci-image">
                                  <!-- <img src="images/cloves.png"> -->
          <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
            <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>" style="height: 100px;"  >
          <? }else{ ?>
            <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png" style="height: 100px;" >
          <? } ?>
        </div>

      <h3>
        <?=$record['productName']?><?php if($attrValueSet !=''){ echo '('.rtrim($attrValueSet,',').')'; } ?>
      </h3>

      <!-- <p style="font-style:italic; color:#757575;">Sangri, Ker, Fennel, Pomogranate Seeds, Mustard seeds, Salt, Hing, Turmeric, Chilli powder, Amchur, Kalonji, Jeera, Sesame oil</p> -->
      </td>
      <td style="font:14px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="center"><?=$record['quantity']?></td>
      <td style="font:14px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="right">&dollar; <?=$record['unitPrice']?></td>
      <td style="font:14px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:300;" align="right">&dollar; <?=$record['productTotalPrice']?></td>
      
    </tr>
  <?}?>
  <tr><td colspan="6" style="border-bottom:1px solid #d9d9d9;">&nbsp;</td></tr>
  <tr><td colspan="6">&nbsp;</td></tr>
  
  <tr>

    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;" align="left">
    <h3 style="font-weight:300;">SUB-TOTAL</h3>
    </td>
    <td colspan="1">&nbsp;</td><td colspan="1">&nbsp;</td>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;" align="right">
    <h3 style="font-weight:300;">&dollar; <?=$results->subTotal?></h3>
    </td>
  </tr>
  <tr>

    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;" align="left">
    <h3 style="font-weight:300;">SHIPPING</h3>
    </td>
    <td colspan="1">&nbsp;</td><td colspan="1">&nbsp;</td>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;" align="right">
    <h3 style="font-weight:300;">&dollar; <?=$results->deliveryCost?></h3>
    </td>
  </tr>
<!--   <tr>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;" align="left">
    <h3 style="font-weight:300;">Shipping Charges</h3>
    </td>
    <td colspan="1">&nbsp;</td>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;" align="right">
    <h3 style="font-weight:300;">&dollar; 0.00</h3>
    </td>
  </tr>
  <tr>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;" align="left">
    <h3 style="font-weight:300;">Cash on Delivery Charges</h3>
    </td>
    <td colspan="1">&nbsp;</td>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;" align="right">
    <h3 style="font-weight:300;">&dollar; 0.00</h3>
    </td>
  </tr> -->
  <tr>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:normal;" align="left">
    <h2>TOTAL</h2>
    </td>
    <td colspan="1">&nbsp;</td><td colspan="1">&nbsp;</td>
    <td style="font:12px/16px Helvetica, Arial, sans-serif;color:#000;font-weight:bold;" align="right">
    <h2>&dollar; <?=$results->totalAmount?></h2>
    </td>
  </tr>
  

  
  </table>
   </div>
  
  <div style="clear:both"></div>   
  
    
</div>


</body>
</html>
