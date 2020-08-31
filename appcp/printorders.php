<?php
session_start();
if(isset($_SESSION['adminId']) && $_SESSION['adminId']!=''){

}else{
	header('location:http://www.desitemplehair.com/');
	exit;
}
require_once('setup/config.php');
require_once('setup/common.functions.php');
require_once('classes/class.db.php');
require_once('classes/class.oauth.php');
require_once('classes/class.report_handler.php');
require_once('admin.fns.php');
	$db = new DB();
	$report= new report_handler();
	$adminEnd = new adminEnd();
	$orderId = $_REQUEST['orderId'];
	$orderDetails = $db->get_row("SELECT id, userId, invoiceNumber,invoiceNo, fullName,shippingId,billingId, mobileNumber, email, address, note, subTotal, deliveryCost, totalAmount, orderStatus, dateTime,paymentType,onlinePaymentStatus,offerAmt,couponDiscount FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
    
    if(($orderDetails->invoiceNumber =='')||($orderDetails->invoiceNumber == '0')){
    	$report->setReport('error_message','Invoice number is not set. Please try again!'); 
		$adminEnd->redirect('/index.php?page=viewOrderDetail&orderId='.$orderId); //Redirect to the referrer page if there is one
		exit;
    }
    if($orderDetails->orderStatus != 'Confirmed'){
    	$report->setReport('error_message','Please confirm the order before generating the invoice.'); 
		$adminEnd->redirect('/index.php?page=viewOrderDetail&orderId='.$orderId); //Redirect to the referrer page if there is one
		exit;
    }
    $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");

    $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->shippingId."' ",true);
    // pre($shippingDetail);
    $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->billingId."' ",true);
?>	
<!DOCTYPE html>
<html>
<head>
	<title>desi temple hair</title>
</head>
<body>

<table cellspacing="0" cellpadding="0" style="font-family:arial;width:800px;margin:0 auto;font-size:10px;">
	
	<td style="width:49.5%;">
		<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:1px solid #7e7e7e;width:100%;">
			<!-- <tr>
				<td colspan="4" style="padding:10px;text-align:center;font-weight:bold;">Customer Copy</td>
			</tr> -->
			<tr style="border-bottom:1px dotted #7e7e7e;">
				<td colspan="4" style="padding:10px;font-size:12px;">
					<img src="images/logo.png" style="float:left; max-width: 60px;">
					<p style="margin:0 0 3px 0;padding:8px 0 0 0;text-align:right;font-weight:normal;">www.desitemplehair.com</p>
					<p style="margin:0 0 3px 0;padding:0 ;text-align:right;font-weight:normal;">support@desitemplehair.com</p>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="padding:10px;font-size:12px;">
					<p style="margin:0 0 3px 0;font-weight:normal;"></p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Invoice No. </b>: <?=$orderDetails->invoiceNumber?></p>
					<br>
					<div><b>Shipping Address</b></div>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Name </b>: <?=$shippingDetail->first_name?> <?=$shippingDetail->last_name?></p>
					<p style="padding-left:108px;margin:0 0 10px 0;width:250px;">
					<span style="display:block;"><?=$shippingDetail->address_1?>, <?=$shippingDetail->address_2?>,<br> <?=$shippingDetail->landmark?><br><?=$shippingDetail->city?> <?=$shippingDetail->pincode?><br><?=$shippingDetail->state?> <?=$shippingDetail->country?></span>
					
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Mobile No. </b>: <?=$shippingDetail->phone?></p>
					<br>
					<div><b>Billing Address</b></div>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Name </b>: <?=$billingDetail->first_name?> <?=$billingDetail->last_name?></p>
					<p style="padding-left:108px;margin:0 0 10px 0;width:250px;">
					<span style="display:block;"><?=$billingDetail->address_1?>, <?=$billingDetail->address_2?>, <?=$billingDetail->landmark?><br><?=$billingDetail->city?> <?=$billingDetail->pincode?><br><?=$billingDetail->state?> <?=$billingDetail->country?></span>
					
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Mobile No. </b>: <?=$billingDetail->phone?></p>
					<br>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Order Date </b>: <?=stdDateFormat($orderDetails->dateTime)?></p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Delivery Date </b>: <?=mdyDateFormat(date('Y-m-d'))?></p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Payment </b>: <?=$orderDetails->paymentType?><?php if($orderDetails->paymentType == 'Online'){?> - <?php  if($orderDetails->onlinePaymentStatus=='Complete'){ echo 'Paid'; }else{ echo $orderDetails->onlinePaymentStatus; } } ?></p>
				</td>
			</tr>
			
			<tr style="border-top:1px dotted #7e7e7e;">
				<td style="padding:10px;font-weight:bold;">Description</td>
				<td style="padding:10px;text-align:center;font-weight:bold;">Qty</td>
				<td style="padding:10px;text-align:center;font-weight:bold;">Rate</td>
				<td style="padding:10px;text-align:center;font-weight:bold;">Value</td>
			</tr>
			<?foreach($records as $record){
		   $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                      WHERE productId='".$record['productId']."'", true);

                        $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                        // pre($productOption);
                         $productCategoryId = $db->get_row("SELECT categoryId,productDescription FROM ".PRODUCTS." 
                                                      WHERE id='".$record['productId']."'", true);
                        $productTotal = $record['quantity']*$record['unitPrice'];
                        $totalItems+= $record['quantity'];
                        $subTotal+=$productTotal;
                        $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                                    $attrValueSet='';   
                                        foreach ($productAttrubutes as $productAttrubute) {
                                            $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                            if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                                        }
                ?>
			<tr>
				<td style="padding:2px 10px;"><?=$record['productName']?>&nbsp;<?php if($attrValueSet !=''){ echo '<br/>('.rtrim($attrValueSet,',').')'; } ?></td>
				<td style="padding:2px 0;text-align:center;"><?=$record['quantity']?></td>
				<td style="padding:2px 0;text-align:center; width:20%;">&#36; <?=number_format($record['unitPrice'],2)?></td>
				<td style="padding:2px 0;text-align:center; width:20%;">&#36; <?=number_format($productTotal,2)?></td>
			</tr>
			<?}?>
			<tr style="border-bottom:1px dotted #7e7e7e;">
				<td colspan="4" style="padding:10px;">
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
						<b>Sub Total </b>: <span style="display:inline-block;width:80px;">&#36; <?=number_format($orderDetails->subTotal, 2)?></span>
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
						<b>Shipping </b>: <span style="display:inline-block;width:80px;">&#36; <?=number_format($orderDetails->deliveryCost, 2)?></span>
					</p>
					<?php $totalPay = $orderDetails->totalAmount; ?>
		            <?php if($orderDetails->couponDiscount > 0){?>
		            <p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
		            	<b>Coupon Discount </b>: <span style="display:inline-block;width:80px;"> &#36; <?=number_format($orderDetails->couponDiscount,2)?></span>
		            </p>
		            <?php 
		            $totalPay = $totalPay - $orderDetails->couponDiscount;
		            } ?>
		            <?php if($orderDetails->offerAmt > 0){?>
		            <p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
		            	<b>Discount  (5%)</b>: <span style="display:inline-block;width:80px;"> &#36; <?=number_format($orderDetails->offerAmt,2)?></span>
		            </p>
		            <?php 
		            $totalPay = $totalPay - $orderDetails->offerAmt;
		            } ?>
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
						<b>Grand Total </b>: <span style="display:inline-block;width:80px;"><b>&#36; <?=number_format($totalPay, 2)?></b></span>
					</p>
				</td>
			</tr>
			<tr >
				<td colspan="4" style="padding:10px;">
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;padding-right:90px;">
						<b>Signature </b>
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;float:right;border-bottom:1px solid #7e7e7e;width:160px;height:25px;"></p>
				</td>
			</tr>
		</table>
	</td>
	<td style="width:1%;"></td>
	<td style="width:49.5%;">
		<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:1px solid #7e7e7e;width:100%;">
			<!-- <tr>
				<td colspan="4" style="padding:10px;text-align:center;font-weight:bold;">Customer Copy</td>
			</tr> -->
			<tr style="border-bottom:1px dotted #7e7e7e;">
				<td colspan="4" style="padding:10px;font-size:12px;">
					<img src="images/logo.png" style="float:left; max-width: 60px;">
					<p style="margin:0 0 3px 0;padding:8px 0 0 0;text-align:right;font-weight:normal;">www.desitemplehair.com</p>
					<p style="margin:0 0 3px 0;padding:0 ;text-align:right;font-weight:normal;">support@desitemplehair.com</p>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="padding:10px;font-size:12px;">
					<p style="margin:0 0 3px 0;font-weight:normal;"></p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Invoice No. </b>: <?=$orderDetails->invoiceNumber?></p>
					<br>
					<div><b>Shipping Address</b></div>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Name </b>: <?=$shippingDetail->first_name?> <?=$shippingDetail->last_name?></p>
					<p style="padding-left:108px;margin:0 0 10px 0;width:250px;">
					<span style="display:block;"><?=$shippingDetail->address_1?>, <?=$shippingDetail->address_2?>,<br> <?=$shippingDetail->landmark?><br><?=$shippingDetail->city?> <?=$shippingDetail->pincode?><br><?=$shippingDetail->state?> <?=$shippingDetail->country?></span>
					
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Mobile No. </b>: <?=$shippingDetail->phone?></p>
					<br>
					<div><b>Billing Address</b></div>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Name </b>: <?=$billingDetail->first_name?> <?=$billingDetail->last_name?></p>
					<p style="padding-left:108px;margin:0 0 10px 0;width:250px;">
					<span style="display:block;"><?=$billingDetail->address_1?>, <?=$billingDetail->address_2?>, <?=$billingDetail->landmark?><br><?=$billingDetail->city?> <?=$billingDetail->pincode?><br><?=$billingDetail->state?> <?=$billingDetail->country?></span>
					
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Mobile No. </b>: <?=$billingDetail->phone?></p>
					<br>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Order Date </b>: <?=stdDateFormat($orderDetails->dateTime)?></p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Delivery Date </b>: <?=mdyDateFormat(date('Y-m-d'))?></p>
					<p style="margin:0 0 3px 0;font-weight:normal;"><b style="min-width:100px;display:inline-block;">Payment </b>: <?=$orderDetails->paymentType?><?php if($orderDetails->paymentType == 'Online'){?> - <?php  if($orderDetails->onlinePaymentStatus=='Complete'){ echo 'Paid'; }else{ echo $orderDetails->onlinePaymentStatus; } } ?></p>
				</td>
			</tr>
			
			<tr style="border-top:1px dotted #7e7e7e;">
				<td style="padding:10px;font-weight:bold;">Description</td>
				<td style="padding:10px;text-align:center;font-weight:bold;">Qty</td>
				<td style="padding:10px;text-align:center;font-weight:bold;">Rate</td>
				<td style="padding:10px;text-align:center;font-weight:bold;">Value</td>
			</tr>
			<?foreach($records as $record){
		   $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                      WHERE productId='".$record['productId']."'", true);

                        $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                        // pre($productOption);
                         $productCategoryId = $db->get_row("SELECT categoryId,productDescription FROM ".PRODUCTS." 
                                                      WHERE id='".$record['productId']."'", true);
                        $productTotal = $record['quantity']*$record['unitPrice'];
                        $totalItems+= $record['quantity'];
                        $subTotal+=$productTotal;
                        $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                                    $attrValueSet='';   
                                        foreach ($productAttrubutes as $productAttrubute) {
                                            $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                            if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                                        }
                ?>
			<tr>
				<td style="padding:2px 10px;"><?=$record['productName']?>&nbsp;<?php if($attrValueSet !=''){ echo '<br/>('.rtrim($attrValueSet,',').')'; } ?></td>
				<td style="padding:2px 0;text-align:center;width:20%;"> <?=$record['quantity']?></td>
				<td style="padding:2px 0;text-align:center; width:20%;">&#36; <?=number_format($record['unitPrice'],2)?></td>
				<td style="padding:2px 0;text-align:center; width:20%;">&#36; <?=number_format($productTotal,2)?></td>
			</tr>
			<?}?>
			<tr style="border-bottom:1px dotted #7e7e7e;">
				<td colspan="4" style="padding:10px;">
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
						<b>Sub Total </b>: <span style="display:inline-block;width:80px;">&#36; <?=number_format($orderDetails->subTotal, 2)?></span>
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
						<b>Shipping </b>: <span style="display:inline-block;width:80px;">&#36; <?=number_format($orderDetails->deliveryCost, 2)?></span>
					</p>
					<?php $totalPay = $orderDetails->totalAmount; ?>
					<?php if($orderDetails->couponDiscount > 0){?>
		            <p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
		            	<b>Coupon Discount </b>: <span style="display:inline-block;width:80px;"> &#36; <?=number_format($orderDetails->couponDiscount,2)?></span>
		            </p>
		            <?php 
		            $totalPay = $totalPay - $orderDetails->couponDiscount;
		            } ?>
		            <?php if($orderDetails->offerAmt > 0){?>
		            <p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
		            	<b>Discount  (5%)</b>: <span style="display:inline-block;width:80px;"> &#36; <?=number_format($orderDetails->offerAmt,2)?></span>
		            </p>
		            <?php 
		            $totalPay = $totalPay - $orderDetails->offerAmt;
		            } ?>
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;">
						<b>Grand Total </b>: <span style="display:inline-block;width:80px;"><b>&#36; <?=number_format($totalPay, 2)?></b></span>
					</p>
				</td>
			</tr>
			<tr >
				<td colspan="4" style="padding:10px;">
					<p style="margin:0 0 3px 0;font-weight:normal;text-align:right;padding-right:90px;">
						<b>Signature </b>
					</p>
					<p style="margin:0 0 3px 0;font-weight:normal;float:right;border-bottom:1px solid #7e7e7e;width:160px;height:25px;"></p>
				</td>
			</tr>
		</table>
	</td>

</table>

</body>
</html>