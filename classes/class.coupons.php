<?php
class coupons{
	var $userId;
	
	function coupons()
	{
		
	}
	function applyCouponCode(){
		$db = new DB();
		$oauth = new oauth();
		date_default_timezone_set("Asia/Calcutta");
		if($db->filter($_REQUEST['couponcode']) =='' || $_SESSION['businessUserOffer'] == 'Yes'){
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			echo "{\"codestatus\":\" \"}";
			exit;
		}
		//Get cart total
		$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";
		if($db->num_rows( $query ) > 0 ){
	    	$records = $db->get_results($query);
	  	 	$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
	  	 	foreach($records as $record){

				$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
								              WHERE id='".$record['productId']."'", true);
				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
								              WHERE productId='".$record['productId']."'", true);
				$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}
			}
			$grandTotal = $subTotal;
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
  		}

        $dateTime  = date('Y-m-d H:i:s', time());
		if(!$oauth->authUser()){
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			echo "{\"codestatus\":\"login\",\"msg\":\" Please <a href='".APP_URL."/loginregister.php?next=".base64_encode('checkout.php')."' >login</a> to apply coupon code. \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
		 	exit;
		}

		$query = "SELECT * FROM ".COUPONS." WHERE couponValue = '".$db->filter($_REQUEST['couponcode'])."' AND active = '1'";
		if($db->num_rows($query) > 0){
			$couponsRow = $db->get_row($query,true);
			if($couponsRow->dateTo < $dateTime){
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				echo "{\"codestatus\":\"expired\",\"msg\":\" The entered coupon code expired. \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
			}
			
			$userCount = $db->num_rows("SELECT * FROM ".COUPON_USERS." WHERE regId = '".$oauth->authUser()."' AND couponCode = '".$db->filter($_REQUEST['couponcode'])."'");
			if($userCount >= $couponsRow->useCount){
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				echo "{\"codestatus\":\"already_used\",\"msg\":\" The entered coupon code has reached maximum redemption limit. \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
			}

			if($couponsRow->typeId == 1){ //type -> Fixed Rate

				echo $this->couponFixRateMethod($couponsRow->id,$couponsRow->methodId,$couponsRow->applyId,$couponsRow->productIds,$couponsRow->categoryIds,$couponsRow->couponValue,$couponsRow->discountValue,$couponsRow->dateFrom,$couponsRow->dateTo,$couponsRow->minimumAmount);
								
				// if($couponsRow->methodId==1){ //method -> Voucher Code
				// 	if($couponsRow->applyId ==1){ //apply -> Total Cart Summary

				// 	}else if($couponsRow->applyId ==2){ //apply -> Products

				// 	}else if($couponsRow->applyId ==3){ //apply -> Categories

				// 	}
				// }else if($couponsRow->methodId==2){ //method -> Price Range

				// }
			}else if($couponsRow->typeId == 2){ //type -> Percentage
				
				echo $this->couponPercentageMethod($couponsRow->id,$couponsRow->methodId,$couponsRow->applyId,$couponsRow->productIds,$couponsRow->categoryIds,$couponsRow->couponValue,$couponsRow->discountValue,$couponsRow->dateFrom,$couponsRow->dateTo,$couponsRow->minimumAmount);
			}
		}else{
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			echo "{\"codestatus\":\"invalid\",\"msg\":\" Invalid coupon code. \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
			exit;
		}	
	
	}

	function couponFixRateMethod($id,$methodId,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount){
		if($methodId == 1){ //method -> Voucher Code
			return $this->couponFixRateVoucherApply($id,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount);
		}elseif($methodId == 2){ //method -> Price Range
			return 	$this->couponApply($id,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount);
		}
	}

	function couponPercentageMethod($id,$methodId,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount){
		if($methodId == 1){ //method -> Voucher Code
			return $this->couponPercentageVoucherApply($id,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount);
		}elseif($methodId == 2){ //method -> Price Range
			return 	$this->couponApply($id,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount);
		}
	}

	function couponFixRateVoucherApply($id,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount){
		$db = new DB();
		$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";
		if($db->num_rows( $query ) > 0 ){
	    	$records = $db->get_results($query);
	  	 	$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
	  	 	foreach($records as $record){

				$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
								              WHERE id='".$record['productId']."'", true);
				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
								              WHERE productId='".$record['productId']."'", true);
				$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}
			}
			$grandTotal = $subTotal;
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
  		}else{
  			return "emptycart";
  			exit;
  		}

		if($applyId ==1){ //apply -> Total Cart Summary
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			if($subTotal >= $minimumAmount){
				$discountGrandTotal = $grandTotal - $discountValue;
				if($discountGrandTotal < 0){
					$discountGrandTotal = 0;
					$discountValue = $grandTotal;
				}
				$_SESSION['couponAvailable'] = 'Yes';
				$_SESSION['couponAmount'] = $discountValue;
				$_SESSION['couponCode'] = $couponValue;
				$_SESSION['couponId'] = $id;
				unset($_SESSION['offerAvailable']);
				unset($_SESSION['offerAmount']);
				return "{\"codestatus\":\"applied_to_total\",\"msg\":\" Coupon code applied successfully. \",\"discount\":\"<p class='text-right'>Coupon Discount : &#8377; ".number_format($discountValue,2)."</p>\",\"totalpay\":\" &#8377; ".number_format($discountGrandTotal,2)."\"}";
				exit;
			}else{
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"notenoughammount\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
  				
			}

		}else if($applyId ==2){ //apply -> Products
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			$parts = explode(',', $productIds);
			$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
			$discountProductTotal = 0;
			$discountProductSubTotal = 0;
			$discountProductGrandTotal = 0;
			foreach($records as $record){
			    
		           	$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
									              WHERE id='".$record['productId']."'", true);
					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['productId']."'", true);
					$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}

					
			}
			$discountProductGrandTotal = $discountProductSubTotal;
			$grandTotal = $subTotal;
		
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
			if($discountProductGrandTotal <= 0){
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"item_not_incart\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
			}else if($subTotal >= $minimumAmount){
				$discountValue = $discountProductGrandTotal - $discountValue;
				if($discountValue < 0){
					$discountValue = $discountProductGrandTotal;
				}
				$discountGrandTotal = $grandTotal - $discountValue;
				if($discountGrandTotal < 0){
					$discountGrandTotal = 0;
					$discountValue = $grandTotal;
				}
				$_SESSION['couponAvailable'] = 'Yes';
				$_SESSION['couponAmount'] = $discountValue;
				$_SESSION['couponCode'] = $couponValue;
				$_SESSION['couponId'] = $id;
				unset($_SESSION['offerAvailable']);
				unset($_SESSION['offerAmount']);
				return "{\"codestatus\":\"applied_to_total\",\"msg\":\" Coupon code applied successfully\",\"discount\":\"<p class='text-right'>Coupon Discount : &#8377; ".number_format($discountValue,2)."</p>\",\"totalpay\":\" &#8377; ".number_format($discountGrandTotal,2)."\"}";
				exit;
			}else{
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"notenoughammount\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
  				
			}

		}else if($applyId ==3){ //apply -> Categories
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
			$parts = explode(',', $categoryIds);
			$categoryName = '';
			foreach ($parts as $catId) {
				$catNames = $db->get_row("SELECT categoryName FROM ".PRODUCT_CATEGORIES." WHERE id='".$catId."'",true);
				$categoryName .= $catNames->categoryName.', ';
			}
			$categoryNames = rtrim($categoryName,", ");
			$discountProductTotal = 0;
			$discountProductSubTotal = 0;
			$discountProductGrandTotal = 0;
			foreach($records as $record){
			    
		           	$productData = $db->get_row("SELECT id, productName,categoryId FROM ".PRODUCTS." 
									              WHERE id='".$record['productId']."'", true);
					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['productId']."'", true);
					$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}
			}
			$discountProductGrandTotal = $discountProductSubTotal;
			$grandTotal = $subTotal;
		    
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
			if($discountProductGrandTotal <= 0){
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"item_not_incart\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
			}else if($subTotal >= $minimumAmount){
				if($discountProductGrandTotal < $discountValue){
					$discountValue = $discountProductGrandTotal;
				}
				$discountGrandTotal = $grandTotal - $discountValue;
				if($discountGrandTotal < 0){
					$discountGrandTotal = 0;
					$discountValue = $grandTotal;
				}
				$_SESSION['couponAvailable'] = 'Yes';
				$_SESSION['couponAmount'] = $discountValue;
				$_SESSION['couponCode'] = $couponValue;
				$_SESSION['couponId'] = $id;
				unset($_SESSION['offerAvailable']);
				unset($_SESSION['offerAmount']);
				return "{\"codestatus\":\"applied_to_total\",\"msg\":\" Coupon code applied successfully\",\"discount\":\"<p class='text-right'>Coupon Discount : &#8377; ".number_format($discountValue,2)."</p>\",\"totalpay\":\" &#8377; ".number_format($discountGrandTotal,2)."\"}";
				exit;
			}else{
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"notenoughammount\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
  				
			}
		}
	}

	//coupon percentage calculation
	function couponPercentageVoucherApply($id,$applyId,$productIds,$categoryIds,$couponValue,$discountValue,$dateFrom,$dateTo,$minimumAmount){

		$db = new DB();
		$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";
		if($db->num_rows( $query ) > 0 ){
	    	$records = $db->get_results($query);
	  	 	$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
	  	 	foreach($records as $record){

				$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
								              WHERE id='".$record['productId']."'", true);
				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
								              WHERE productId='".$record['productId']."'", true);
				$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}
			}
			$grandTotal = $subTotal;
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
  		}else{
  			return "emptycart";
  			exit;
  		}

		if($applyId ==1){ //apply -> Total Cart Summary
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			if($subTotal >= $minimumAmount){
				$discountPercent = $discountValue;
				$discountValue = round(($discountValue/100) * $subTotal);
				if($discountValue < 1){
					$discountValue = 1;
				}
				$discountGrandTotal = $grandTotal - $discountValue;
				if($discountGrandTotal < 0){
					$discountGrandTotal = 0;
					$discountValue = $grandTotal;
				}
				$_SESSION['couponAvailable'] = 'Yes';
				$_SESSION['couponAmount'] = $discountValue;
				$_SESSION['couponCode'] = $couponValue;
				$_SESSION['couponId'] = $id;
				unset($_SESSION['offerAvailable']);
				unset($_SESSION['offerAmount']);
				return "{\"codestatus\":\"applied_to_total\",\"msg\":\" Coupon code applied successfully\",\"discount\":\"<p class='text-right'>Coupon Discount (".$discountPercent."%) : &#8377; ".number_format($discountValue,2)."</p>\",\"totalpay\":\" &#8377; ".number_format($discountGrandTotal,2)."\"}";
				exit;
			}else{
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"notenoughammount\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
  				
			}

		}else if($applyId ==2){ //apply -> Products
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			$parts = explode(',', $productIds);
			$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
			$discountProductTotal = 0;
			$discountProductSubTotal = 0;
			$discountProductGrandTotal = 0;
			foreach($records as $record){
			    
		           	$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
									              WHERE id='".$record['productId']."'", true);
					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['productId']."'", true);
					$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}
			}
			$discountProductGrandTotal = $discountProductSubTotal;
			$grandTotal = $subTotal;
		
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
			if($discountProductGrandTotal <= 0){
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"item_not_incart\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
			}else if($subTotal >= $minimumAmount){

				$discountPercent = $discountValue;
				$discountValue = round(($discountValue/100) * $discountProductGrandTotal);
				if($discountValue < 1){
					$discountValue = 1;
				}

				$discountGrandTotal = $grandTotal - $discountValue;
				if($discountGrandTotal < 0){
					$discountGrandTotal = 0;
					$discountValue = $grandTotal;
				}
				$_SESSION['couponAvailable'] = 'Yes';
				$_SESSION['couponAmount'] = $discountValue;
				$_SESSION['couponCode'] = $couponValue;
				$_SESSION['couponId'] = $id;
				unset($_SESSION['offerAvailable']);
				unset($_SESSION['offerAmount']);
				return "{\"codestatus\":\"applied_to_total\",\"msg\":\" Coupon code applied successfully\",\"discount\":\"<p class='text-right'>Coupon Discount (".$discountPercent."%): &#8377; ".number_format($discountValue,2)."</p>\",\"totalpay\":\" &#8377; ".number_format($discountGrandTotal,2)."\"}";
				exit;
			}else{
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"notenoughammount\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
  				
			}

		}else if($applyId ==3){ //apply -> Categories
			unset($_SESSION['couponAvailable']);
			unset($_SESSION['couponAmount']);
			unset($_SESSION['couponCode']);
			unset($_SESSION['couponId']);
			$subTotal = 0;
	  	 	$grandTotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
			$parts = explode(',', $categoryIds);
			$categoryName = '';
			foreach ($parts as $catId) {
				$catNames = $db->get_row("SELECT categoryName FROM ".PRODUCT_CATEGORIES." WHERE id='".$catId."'",true);
				$categoryName .= $catNames->categoryName.', ';
			}
			$categoryNames = rtrim($categoryName,", ");
			$discountProductTotal = 0;
			$discountProductSubTotal = 0;
			$discountProductGrandTotal = 0;
			foreach($records as $record){
			    
		           	$productData = $db->get_row("SELECT id, productName,categoryId FROM ".PRODUCTS." 
									              WHERE id='".$record['productId']."'", true);
					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['productId']."'", true);
					$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
							$offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
							if($offerPrice < 1){
								$offerPrice = 1;
							}
							$productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}else{
							if(in_array($record['productId'], $parts)){
								$discountProductTotal = $record['quantity']*$productOption->productCost;
								$discountProductSubTotal+=$discountProductTotal;
							}	
							$productTotal = $record['quantity']*$productOption->productCost;
							$totalItems+= $record['quantity'];
							$subTotal+=$productTotal;
						}
			}
			
			$discountProductGrandTotal = $discountProductSubTotal;
			$grandTotal = $subTotal;
		   
			if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){
				$grandTotal+=DELIVERY_CHARGE;
			}	
			//$grandTotal = $grandTotal - $_SESSION['offerAmount'];
			if($discountProductGrandTotal <= 0){
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"item_not_incart\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
			}else if($subTotal >= $minimumAmount){

				$discountPercent = $discountValue;
				$discountValue = round(($discountValue/100) * $discountProductGrandTotal);
				if($discountValue < 1){
					$discountValue = 1;
				}
				$discountGrandTotal = $grandTotal - $discountValue;
				if($discountGrandTotal < 0){
					$discountGrandTotal = 0;
					$discountValue = $grandTotal;
				}
				$_SESSION['couponAvailable'] = 'Yes';
				$_SESSION['couponAmount'] = $discountValue;
				$_SESSION['couponCode'] = $couponValue;
				$_SESSION['couponId'] = $id;
				unset($_SESSION['offerAvailable']);
				unset($_SESSION['offerAmount']);
				return "{\"codestatus\":\"applied_to_total\",\"msg\":\" Coupon code applied successfully\",\"discount\":\"<p class='text-right'>Coupon Discount (".$discountPercent."%): &#8377; ".number_format($discountValue,2)."</p>\",\"totalpay\":\" &#8377; ".number_format($discountGrandTotal,2)."\"}";
				exit;
			}else{
				unset($_SESSION['couponAvailable']);
				unset($_SESSION['couponAmount']);
				unset($_SESSION['couponCode']);
				unset($_SESSION['couponId']);
				return "{\"codestatus\":\"notenoughammount\",\"msg\":\" The coupon code you entered is invalid or not applicable to the content of your basket \",\"totalpay\":\" &#8377; ".number_format($grandTotal,2)."\"}";
				exit;
  				
			}
		}
	}
}