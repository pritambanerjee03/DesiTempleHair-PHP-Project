<?php

class cart{
	var $userId;
	
	function cart()
	{
		
	}

	function addToCartItems(){
		$db = new DB();

		$quantity = json_decode(stripslashes($_POST['quantity']));
		$productOptionId = json_decode(stripslashes($_POST['productOptionId']));

		$i=0;
            
           foreach($quantity as $quantityData){

            // echo $quantityData;
           	// exit;
           	if($quantity[$i]>0){
				$query = "SELECT id, quantity FROM ".CART." WHERE productId='".$_POST['productId']."' AND productOptionId='".$productOptionId[$i]."' AND cartId='".session_id()."'";
		        
		        if($db->num_rows($query)>0){

		        	$cartData = $db->get_row($query, true);

		        	$updatedQty = trim($cartData->quantity)+trim($quantity[$i]);

		        	$updateCart = array(
			            'quantity' => $db->filter($updatedQty),
			            // 'timeslotVal' => $db->filter($_POST['timeslotVal'])         
			        );

			        $where_clause = array(
			            'id' => $cartData->id
			        );

			        $rs = $db->update(CART, $updateCart, $where_clause, 1);

		        }else{

					$data = array(
			            'cartId' => session_id(),
			            'productId' => $_POST['productId'],
			            'productOptionId' => $productOptionId[$i],
			            'quantity' => trim($quantity[$i]),
			            // 'timeslotVal' => $db->filter($_POST['timeslotVal'])
			        );

			        $rs = $db->insert(CART, $data);

			    }
				}
					
		       
		      $i++;
		    }
				$sql = "SELECT sum(quantity) as quantity FROM ".CART." WHERE cartId='".session_id()."'";
				$res = $db->get_row($sql, true);
		     if($rs){
		        	echo $res->quantity;
		        }else{
		        	echo $res->quantity;
		        }

	}

	function addToCart(){
		$db = new DB();
		$productId = $_POST['productId'];
		$productOptionId = $_POST['productOptionId'];
		$qty = 1;
		$query = "SELECT id, quantity FROM ".CART." WHERE productId='".$db->filter($productId)."' AND productOptionId='".$db->filter($productOptionId)."' AND cartId='".session_id()."'";
        if($db->num_rows($query)>0){
        	$cartData = $db->get_row($query, true);
        	$updatedQty = trim($cartData->quantity)+trim($qty);
        	$updateCart = array(
	            'quantity' => $db->filter($updatedQty)         
	        );
	        $where_clause = array(
	            'id' => $cartData->id
	        );
	        $rs = $db->update(CART, $updateCart, $where_clause, 1);
        }else{
			$data = array(
	            'cartId' => session_id(),
	            'productId' => $productId,
	            'productOptionId' => $productOptionId,
	            'quantity' => trim($qty)
	        );
	        $rs = $db->insert(CART, $data);
	    }

        if($rs){
        	echo 'success';
        }else{
        	echo 'fail';
        }
	}

	function addTocartChitki(){
		$db = new DB();

		$query = "SELECT id, quantity FROM ".CART." WHERE productId='".$_POST['productId']."' AND productOptionId='".$_POST['productOptionId']."' AND cartId='".session_id()."'";
        
        if($db->num_rows($query)>0){

        	$cartData = $db->get_row($query, true);

        	$updatedQty = trim($cartData->quantity)+trim($_POST['quantity']);

        	$updateCart = array(
	            'quantity' => $db->filter($updatedQty),
	            'timeslotVal' => $db->filter($_POST['timeslotVal'])         
	        );

	        $where_clause = array(
	            'id' => $cartData->id
	        );

	        $rs = $db->update(CART, $updateCart, $where_clause, 1);

        }else{

			$data = array(
	            'cartId' => session_id(),
	            'productId' => $_POST['productId'],
	            'productOptionId' => $_POST['productOptionId'],
	            'quantity' => trim($_POST['quantity']),
	            'timeslotVal' => $db->filter($_POST['timeslotVal'])
	        );

	        $rs = $db->insert(CART, $data);

	    }

        if($rs){
        	echo 'success';
        }else{
        	echo 'failed';
        }

	}

	function miniCartBeautyMineral(){

		$db = new DB();

		$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";

		?>

		<span class="cnote totalItems">0</span>

				<? 

    				$totalItems = 0;

    				 if($db->num_rows( $query ) > 0 ){
      		   
      		  	 	$records = $db->get_results($query);
      		  	 	$subTotal = 0;
      		  	 	$grandtotal = 0;
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
    				 ?>

    			<?}}?>

    			<input type="hidden" name="totalItemsCount" id="totalItemsCount" value="<?=$totalItems?>"> 

				<script type="text/javascript">
					jQuery(document).ready(function () { 
						jQuery('.totalItems').html('<?=$totalItems?>');
						// jQuery('.mobItemCount').html('<?=$totalItems?>');
					});
				</script>


		<?

	}

	function miniCartChitki(){

		$db = new DB();

		$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";

		?>
		<div class="dropdown-toggle basket nomob" data-toggle="dropdown" onclick="window.location.href='http://www.chitki.com/cart'">
		<!-- <i class="fa fa-shopping-cart shopping-cart"></i> -->
		<i><img src="images/cart.png"></i>
		<div class="basketstatus">
		<!-- <span>Cart(<font class="totalItems">0</font>)</span> -->
			<span class="item"><font class="totalItems">0</font></span>
			<span>Cart</span>
		<!-- <span class="item">0 items</span> -->
		</div>

		</div>
		<ul class="dropdown-menu basketcontent miniCartChitki">
		<li>
    		<p>
    			Your Cart  
    			<span> (<span class="totalItems">0</span> Items)</span> 
				<span class="saveamount"> 
					<!-- <i class="fa fa-money"></i> <span>You Saved! <span>Rs.5</span></span> -->
				</span>
			</p>
    		<div class="basketitems">

    				<? 

    				$totalItems = 0;

    				 if($db->num_rows( $query ) > 0 ){
      		   
      		  	 	$records = $db->get_results($query);
      		  	 	$subTotal = 0;
      		  	 	$grandtotal = 0;
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
    				 ?>
    				<div class="item">
						<!-- <a class="close" href="javascript:void(0);" onclick="removeItemFromCart('<?=$record['id']?>')"><img src="images/close.png"></a> -->

	    				<div class="imagebox">
	    					<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
						
							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							
							<? }else{ ?>

							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
						
							<? } ?>

	    				</div>
	    				<div class="info">
	    					<a class="close" href="javascript:void(0);" onclick="removeItemFromCart('<?=$record['id']?>')"><img src="images/close.png"></a>
	    					<!-- <span class="title">Fresho</span> -->
	    					<a href="#" class="subtitle"><?=$productData->productName?> <?=$productOption->productWeight?> <?=$productOption->productUnit?></a>
	    					<span class="price">
	    						<!-- <div class="edit">
	    							<div class="minus"><a href="#">-</a></div>
	    							<div class="value"><input type="text" value="1"></div>
	    							<div class="plus"><a href="#">+</a></div>
	    						</div> -->
	    						<?=$record['quantity']?> &nbsp; X &nbsp; &#36; <?=$productOption->productCost?> = &#36; <?=number_format($productTotal, 2)?>
							</span>
	    					<!-- <span class="save"><span>Saved</span> Rs.5.00</span> -->
						</div>
						<div style="clear:both;width:100%;"></div>
    				</div>
    				<? }

    				}else{ ?>
    					Your cart is empty!
    				<? } ?>
    			
    			

    		</div>

			<div class="total">
				<p>Sub Total : &#36; <?=number_format($subTotal,2)?></p>
				<?php  
				$grandTotal = $subTotal;
				if($subTotal<FREE_DELIVERYAMOUNT_LIMIT && $subTotal>0){ ?> 
					<p>Delivery Charges : &#36; <?=number_format(DELIVERY_CHARGE,2)?></p>
   					<p class="freeDelivery">(Shop for &#36; <?=FREE_DELIVERYAMOUNT_LIMIT?> or more for FREE delivery)</p>

				<? 
					$grandTotal+=DELIVERY_CHARGE;
				} ?>

				<input type="hidden" name="totalItemsCount" id="totalItemsCount" value="<?=$totalItems?>"> 

				<script type="text/javascript">
					jQuery(document).ready(function () { 
						jQuery('.totalItems').html('<?=$totalItems?>');
						jQuery('.mobItemCount').html('<?=$totalItems?>');
					});
				</script>
				

				<p class="final">Total Payable : &#36; <?=number_format($grandTotal,2)?></p>
				<!-- <div class="freedelivery">
					<p>
						Shop for <span>Rs. 955</span> or more and get free delivery!
					</p>
				</div> -->
				<!-- <div class="grandtotal">
					<a href="cart.php">View Cart & Checkout <i class="fa fa-shopping-cart"></i></a>
				</div> -->
				<button class="grandtotal" onclick="window.location.href='<?=APP_URL?>/cart'">
					View Cart & Checkout <i class="fa fa-shopping-cart"></i>
				</button>
			</div>

    	</li>
    	</ul>
		<?
	}

//out of stock modal
function showOutofStockModal(){
	$db = new DB();
	$oauth = new oauth();
	$cartIds = $_POST['cartIds'];
	$query = "SELECT id, productId, productOptionId, quantity,timeslotVal FROM ".CART." WHERE id IN(".$cartIds.") ORDER BY id DESC";
	if($db->num_rows( $query ) > 0 ){	   
	  	$records = $db->get_results($query);
	  	$subTotal = 0;
  	 	$grandtotal = 0;
  	 	$productTotal = 0;
  	 	$totalItems = 0; ?>  	 	
		<table class="table table-bordered showOutofStockCartdata">
			<tr class="active"><th>Item</th><th>Description</th><th>Total</th></tr>
			<?
			foreach($records as $record){
				$stockEmptyMsg ='';

				$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
								              WHERE id='".$record['productId']."'", true);

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
								              WHERE productId='".$record['productId']."'", true);

				$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer,active FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
				
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
			?>
			<tr>
				<td>
					<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
					<? }else{ ?>
						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png"  title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
					<? } ?>
				</td>
				<td>
					<?=$productData->productName?> (<?=$productOption->productWeight?> <?=$productOption->productUnit?>)
					<br/><?=$record['timeslotVal']?><?=$stockEmptyMsg?>
				</td>				
				<td>
					 &#36; <?=number_format($productTotal,2)?>
				</td>
			</tr>
			<? } ?>			
		</table>
<?php
		}
}

function mainCartFlavors(){

	$db = new DB();
	$oauth = new oauth();
	$query = "SELECT id, productId, productOptionId, quantity,timeslotVal FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";

	?>
	   <section class="csect-row clearfix">
                <!--Order -->
                <div class="csect-block fleft big">
                    <div class="cart-box nsp">
                        <div class="crtb-head">
                            <h4>Order Summary</h4>
                        </div>
                        <?
							 if($db->num_rows( $query ) > 0 ){	   
						  	 	$records = $db->get_results($query);
						  	 	$subTotal = 0;
						  	 	$grandtotal = 0;
						  	 	$productTotal = 0;
						  	 	$totalItems = 0;
								$emptyStockExits = 'No';
								$emptyStockCartIds = '';

								?>
                        <div class="crtb-body">
                            <!-- Cart Listing -->
                            <div class="clisting">
                                <div class="clist-head clearfix">
                                    <h6 class="name">Product</h6>
                                    <h6 class="sub">Quantity</h6>
                                    <h6 class="sub">Unit Price</h6>
                                    <!-- <h6 class="sub">Unit Price</h6> -->
                                    <h6 class="sub amt">Amount</h6>
                                </div>
                                	<?
					foreach($records as $record){
						$stockEmptyMsg ='';

						$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
										              WHERE id='".$record['productId']."'", true);

						$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['productId']."'", true);

						$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer,active FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						$productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
						$attrValueSet='';	
							foreach ($productAttrubutes as $productAttrubute) {
								$attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
								if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
							}
						
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
						
						if($productOption->active=='1'){
							if($productOption->productStock <1){
								$stockEmptyMsg = '<br/><span class="cartItemStockmsg">Out of stock</span>';
								$emptyStockExits = 'Yes';	
								$emptyStockCartIds .= $record['id'].',';	
							}
						}else{
							$productOptionStockCheck = $db->get_row("SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE active='1' AND productId='".$record['productId']."' AND productWeight='".$productOption->productWeight."' AND productUnit='".$productOption->productUnit."' ", true);
							if($productOptionStockCheck->productStock <1){
								$stockEmptyMsg = '<br/><span class="cartItemStockmsg">Out of stock</span>';
								$emptyStockExits = 'Yes';
								$emptyStockCartIds .= $record['id'].',';								
							}
						}

					?>

                                <ul class="cartlist">
                                    
                                    <li class="cart_pro">
                                        <div class="citem clearfix">
                                            <div class="ci-image">
                                                <!-- <img src="images/cloves.png"> -->
                                                <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
													<img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="desi temple hair - <?=$productData->productName?>" alt="desi temple hair">
												<? }else{ ?>
													<img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png"  title="desi temple hair" alt="desi temple hair">
												<? } ?>
                                            </div>
                                            <div class="pqb-row ci-data clearfix">
                                                
                                                <div class="ci-name"><p><?=$productData->productName?> </p>
                                                <p style="font-size: 13px;"><?php if($attrValueSet !=''){ echo rtrim($attrValueSet,','); } ?></p></div>
                                                
                                                <div class="ci-det">
                                                    <div class="pb-spinner spinner clearfix">
                                                        <a class="minus" href="javascript:void(0);" onclick="updateCartItems('<?=$record['id']?>', 'minus', '<?=$productOption->productCost?>');">-</a>
                                                        <input type="text" id="qty_<?=$record['id']?>" value="<?=$record['quantity']?>" readonly >
                                                        <a class="plus" href="javascript:void(0);" onclick="updateCartItems('<?=$record['id']?>', 'plus', '<?=$productOption->productCost?>');">+</a>
                                                    </div>
                                                </div>

                                                <div class="ci-det">
                                                    <p>&#36; <?=$productOption->productCost?></p>
                                                </div>
                                                
                                                <div class="ci-amt">
                                                	<input type="hidden" data-id="<?=$record['id']?>" value="<?=$productTotal?>" class="total_amtont" name="amount" id="amtont_<?=$record['id']?>">
                                                    <p class="rp pqb-amt" id="cost_<?=$record['id']?>"> <?=number_format($productTotal,2)?></p>
                                                    <a href="javascript:void(0);" onclick="removeItemFromCart('<?=$record['id']?>')" class="cart-rem tlink" data-id="0">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                                <? } ?>
                            </div>
                            <!-- /Cart Listing -->
                        </div>
                    </div>
                </div>
                <!--Order -->
                <!--Summary -->
                <div class="csect-block fright small gray sub" id="sidebar">
                    <div class="cart-box ntp">
                        <div class="crtb-body">
                            <div class="cart-total">
                            	<?php  
    								$grandTotal = $subTotal;
    							?>
                                <p>Subtotal<span>&#36; <span class="totalammount" id="totalCartAmount"> <?=number_format($subTotal,2)?></span></span></p>
                                <!-- <p>Shipping Charges<span>INR <span id="amt-ship">0</span></span></p> -->
                                <p class="final">Total<span>&#36; <span class="totalammount" id="grandTotalCartAmount"><?=number_format($grandTotal,2)?></span></span></p>
                                <!-- <h6 class="cartnote">Dispatched within 7 working days.</h6> -->
                                <div class="check-btn">
                                    <!-- <button type="button" id="checkout" name="checkout" class="btn sbtn block checkout">Checkout</button> -->
                                    <?php if($oauth->authUser()){ ?>
										<button class="btn sbtn block checkout"  onclick="window.location='<?=APP_URL?>/checkout.php';">Checkout</button>
									<?php }else{ ?>
										<button class="btn sbtn block checkout"  onclick="window.location='<?=APP_URL?>/cartlogin.php?next=<?=base64_encode('checkout.php')?>';">Checkout</button>
									<? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <?}else{echo "<h2 style='text-align:center;'>You have no items in your shopping cart.! <a href='".APP_URL."' style='text-decoration:none;'>Click here to continue shopping</a></h2>";
			?>
			</h2>
			<?}?>

                <!--Charges -->
            </section>
       	<?
}
// MAIN CART


function cartCheckout(){

	$db = new DB();
	// $oauth = new oauth();
	$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";


	?>

	   <section class="csect-row clearfix">
                <!--Order -->
                <div class="csect-block fleft big">
                    <div class="cart-box nsp">
                        <div class="crtb-head">
                            <h4>Checkout & Confirm Order</h4>
                        </div>
                        <?
							 if($db->num_rows( $query ) > 0 ){
	   
						  	 	$records = $db->get_results($query);
						  	 	$subTotal = 0;
						  	 	$grandtotal = 0;
						  	 	$productTotal = 0;
						  	 	$totalItems = 0;
							

								?>
                        <div class="crtb-body">
                            <!-- Cart Listing -->
                            <div class="clisting">
                                <div class="clist-head clearfix">
                                    <h6 class="name">Product</h6>
                                    <h6 class="sub">Quantity</h6>
                                    <h6 class="sub">Units</h6>
                                    <h6 class="sub amt">Amount</h6>
                                </div>
                                <?
								
									foreach($records as $record){

									$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
													              WHERE id='".$record['productId']."'", true);

									$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
													              WHERE productId='".$record['productId']."'", true);

									$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
									
									$productTotal = $record['quantity']*$productOption->productCost;
									$totalItems+= $record['quantity'];
									$subTotal+=$productTotal;
								?>

                                <ul class="cartlist">
                                    
                                    <li class="cart_pro">
                                        <div class="citem clearfix">
                                            <div class="ci-image">
                                                <!-- <img src="images/cloves.png"> -->
                                                <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
													<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
												<? }else{ ?>
													<img src="<?=PRODUCT_THUMBNAIL_PATH?>/cloves.png"  title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
												<? } ?>
                                            </div>
                                            <div class="pqb-row ci-data clearfix">
                                                <input type="hidden" class="pid" value="29">
                                                <input type="hidden" class="ingd_num" value="0">
                                                <input type="hidden" class="ingredients" value="Sangri, Ker, Fennel, Pomogranate Seeds, Mustard seeds, Salt, Hing, Turmeric, Chilli powder, Amchur, Kalonji, Jeera, Sesame oil">
                                                <input type="hidden" class="ing" value="">
                                                <input type="hidden" class="pqb-rate" value="325">
                                                <input type="hidden" class="pqb-size" value="185" data-val="500">
                                                <div class="ci-name"><p><?=$productData->productName?><br><!-- <small>Sangri, Ker, Fennel, Pomogranate Seeds, Mustard seeds, Salt, Hing, Turmeric, Chilli powder, Amchur, Kalonji, Jeera, Sesame oil</small> --></p></div>
                                                <div class="ci-det">
                                                    <h6><?=$productOption->productWeight?> <?=$productOption->productUnit?></h6>
                                                </div>
                                                <div class="ci-det">
                                                    <div class="pb-spinner spinner clearfix">
                                                        <!-- <a class="minus" href="javascript:void(0);" onclick="updateCartItems('<?=$record['id']?>', 'minus', '<?=$productOption->productCost?>');">-</a> -->
                                                        <input type="text" id="qty_<?=$record['id']?>" value="<?=$record['quantity']?>" readonly >
                                                        <!-- <a class="plus" href="javascript:void(0);" onclick="updateCartItems('<?=$record['id']?>', 'plus', '<?=$productOption->productCost?>');">+</a> -->
                                                    </div>
                                                </div>
                                                <div class="ci-amt">
                                                	<!-- <input type="hidden" data-id="<?=$record['id']?>" value="<?=$productTotal?>" class="total_amtont" name="amount" id="amtont_<?=$record['id']?>"> -->
                                                    <p class="rp pqb-amt" id="cost_<?=$record['id']?>"> <?=number_format($productTotal,2)?></p>
                                                    <!-- <a href="javascript:void(0);" onclick="removeItemFromCart('<?=$record['id']?>')" class="cart-rem tlink" data-id="0">Remove</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                                <? } ?>


                            </div>
                            <!-- /Cart Listing -->
                        </div>
                    </div>
                </div>
                <!--Order -->
                <!--Summary -->
                <div class="csect-block fright small gray sub" id="sidebar">
                    <div class="cart-box ntp">
                        <div class="crtb-body">
                            <div class="cart-total">
                            	<?php  
    								$grandTotal = $subTotal;
    							?>
                                <p>Subtotal<span> &#36; <span class="totalammount" id="totalCartAmount"> <?=number_format($subTotal,2)?></span></span></p>
                                <!-- <p>Shipping Charges<span>INR <span id="amt-ship">0</span></span></p> -->
                                <p class="final">Total<span> &#36; <span class="totalammount" id="grandTotalCartAmount"><?=number_format($grandTotal,2)?></span></span></p>
                                <!-- <h6 class="cartnote">Dispatched within 7 working days.</h6> -->
                                <div class="check-btn">
                                    <!-- <button type="button" id="checkout" name="checkout" class="btn sbtn block checkout">Checkout</button> -->
                                    
                                </div>
                            </div>
                            <br>
                            <div class="log-block">
                                    <div class="log-wrap">
                                        <h4>Your Details</h4>
                                        <form id="form-login" name="form-login" class="validable">
                                        <div class="formx">
                                            <div class="fip">
                                                <input type="text" id="email" name="email" class="trans validate[required, custom[email]] reqfield">
                                                <label class="fpl">Email</label>
                                            </div>
                                            <div class="fip">
                                                <input type="password" id="pass" name="pass" class="trans validate[required] reqfield">
                                                <label class="fpl">Password</label>
                                            </div>
                                            <div class="fip">
                                                <p class="ferror login"></p>
                                            </div>
                                            <div class="fip">
                                                <button type="button" name="login" id="login" class="btn block reg">Log In</button>
                                            </div>
                                            <div class="fip center">
                                                <a href="javascript:void(0);" class="tlink modal-toggle" data-target="#forgot-modal">Forgot Password?</a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Gift Btn -->
                    <!-- <div class="gfhead">
                        <div class="gfbtn clearfix">
                            <input type="checkbox" id="gift-check" >
                            <label for="gift-check"><img src="http://cdn.goosebumpspickles.com/image/gift-icon.png"></label>
                        </div>
                    </div> -->
                    <!-- /Gift Btn -->
                </div>
                <?}?>
                <!--Charges -->
            </section>
       	<?
}

function mainCartChitki111(){
		$db = new DB();
		$oauth = new oauth();
		$query = "SELECT id, productId, productOptionId, quantity,timeslotVal FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";
		?>
		<h2>Your Cart</h2>
		<?
		 if($db->num_rows( $query ) > 0 ){	   
	  	 	$records = $db->get_results($query);
	  	 	$subTotal = 0;
	  	 	$grandtotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
			$emptyStockExits = 'No';
			$emptyStockCartIds = '';

			?>

				<div class="col-md-12 col-sm-12 col-xs-12 showcart itemSummery">
					<div class="carttitle nomob">
						<div class="col-md-1 col-sm-1 col-xs-1">Item</div>
						<div class="col-md-4 col-sm-4 col-xs-4">Description</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Quantity</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Unit Price</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Total</div>
						<div class="col-md-1 col-sm-1 col-xs-1 last">Delete</div>
						<div style="clear:both;width:100%;padding:0;"></div>
					</div>

					<?
					foreach($records as $record){
						$stockEmptyMsg ='';

						$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
										              WHERE id='".$record['productId']."'", true);

						$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['productId']."'", true);

						$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer,active FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
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
						
						if($productOption->active=='1'){
							if($productOption->productStock <1){
								$stockEmptyMsg = '<br/><span class="cartItemStockmsg">Out of stock</span>';
								$emptyStockExits = 'Yes';	
								$emptyStockCartIds .= $record['id'].',';	
							}
						}else{
							$productOptionStockCheck = $db->get_row("SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE active='1' AND productId='".$record['productId']."' AND productWeight='".$productOption->productWeight."' AND productUnit='".$productOption->productUnit."' ", true);
							if($productOptionStockCheck->productStock <1){
								$stockEmptyMsg = '<br/><span class="cartItemStockmsg">Out of stock</span>';
								$emptyStockExits = 'Yes';
								$emptyStockCartIds .= $record['id'].',';								
							}
						}

					?>

					<div class="col-md-12 col-sm-12 col-xs-12 mobonlypadd cartdata">
						<!-- <button class="btn btn-danger mobcartbtn onlymob pull-right" onclick="removeItemFromCart('<?=$record['id']?>')">X</button> -->
						<b class="mobcartbtn onlymob pull-right" onclick="removeItemFromCart('<?=$record['id']?>')"><img src="images/cartremove.png" style="width:auto;"></b>
						<div class="col-md-1 col-sm-1 col-xs-4 mobleft">
							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							<? }else{ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png"  title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
							<? } ?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-8 mobright">
							<?=$productData->productName?> (<?=$productOption->productWeight?> <?=$productOption->productUnit?>)
							<?php if($record['timeslotVal']!=''){ echo '<br/>'.$record['timeslotVal']; } ?><?=$stockEmptyMsg?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobright">
							<a class="minus" href="javascript:void(0);" onclick="updateCartItems('<?=$record['id']?>', 'minus');">-</a><input type="text" id="qty_<?=$record['id']?>" value="<?=$record['quantity']?>" readonly ><a class="plus" href="javascript:void(0);" onclick="updateCartItems('<?=$record['id']?>', 'plus');">+</a>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobpricetop mobright">
							<span class="onlymobprice">Unit Price : </span> &#36; <?=number_format($productOption->productCost,2)?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobpricebottom mobright">
							<span class="onlymobprice">Total Price : </span> &#36; <?=number_format($productTotal,2)?>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-8 nomob last ">
							<!-- <button class="btn btn-danger pccartbtn center-block" onclick="removeItemFromCart('<?=$record['id']?>')">X</button> -->
							<b class="pccartbtn" onclick="removeItemFromCart('<?=$record['id']?>')"><img src="images/cartremove.png" style="width:auto;"></b>
						</div>
						<div style="clear:both;width:100%;padding:0;"></div>
					</div>
					<div style="clear:both;width:100%;"></div>
					<? } ?>
					
				</div>

				<p class="textright">Sub Total : &#36; <?=number_format($subTotal,2)?></p>
    				<?php  
    				$grandTotal = $subTotal;
    				if($subTotal<FREE_DELIVERYAMOUNT_LIMIT && $subTotal>0 ){ ?> 
    					<p class="textright">Delivery Charges : &#36; <?=number_format(DELIVERY_CHARGE,2)?></p>
    					<p class="freeDelivery">(Shop for &#36; <?=FREE_DELIVERYAMOUNT_LIMIT?> or more for FREE delivery)</p>
    				<?php
    					$grandTotal+=DELIVERY_CHARGE;
    				} ?>

				<p class="grandtiotal">Total Payable :  <span> &#36; <?=number_format($grandTotal,2)?></span></p>
				<?php if($emptyStockExits == 'Yes'){
				$emptyStockCartIds = rtrim($emptyStockCartIds,','); ?>
				<button type="button" class="btn btn-success summerybtn" id="showOutofStockModal" data-id="<?=$emptyStockCartIds?>" > Checkout</button>
				<?php }else{?>
						<?php if($oauth->authUser()){ ?>
							<button class="btn btn-success summerybtn"  onclick="window.location='<?=APP_URL?>/checkout';">Checkout</button>
						<?php }else{ ?>
							<button class="btn btn-success summerybtn"  onclick="window.location='<?=APP_URL?>/createAccount.php?next=<?=base64_encode('checkout.php')?>';">Checkout</button>
						<? } ?>
				<?php } ?> 
				
			<?

		}else{

			echo "Your cart is empty! ";
			?>
			<button class="shoppingbtn" onclick="window.location.href='<?=APP_URL?>'">
				Continue Shopping <i class="fa fa-shopping-cart"></i>
			</button>
			<?

		}

		?>
		<div style="clear:both;width:100%;"></div>
		<?

}




function cartCheckoutTest(){
		$db = new DB();

		$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";

		?>
		
		<h2>Checkout & Confirm Order</h2>
		
		<?

		 if($db->num_rows( $query ) > 0 ){
	   
	  	 	$records = $db->get_results($query);
	  	 	$subTotal = 0;
	  	 	$grandtotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
		

		

			?>
				<div class="col-md-12 col-sm-12 col-xs-12 showcart itemSummery">
					<div class="carttitle nomob">
						<div class="col-md-1 col-sm-1 col-xs-1">Item</div>
						<div class="col-md-5 col-sm-5 col-xs-5">Description</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Quantity</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Unit Price</div>
						<div class="col-md-2 col-sm-2 col-xs-2 last">Total</div>
						<div style="clear:both;width:100%;padding:0;"></div>
					</div>

					<?
					foreach($records as $record){

						$productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
										              WHERE id='".$record['productId']."'", true);

						$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['productId']."'", true);

						$productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
						
						$productTotal = $record['quantity']*$productOption->productCost;
						$totalItems+= $record['quantity'];
						$subTotal+=$productTotal;
					?>

					<div class="col-ms-12 col-sm-12 col-xs-12 mobonlypadd cartdata">
						<div class="col-md-1 col-sm-1 col-xs-4 mobleft">
							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							<? }else{ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
							<? } ?>
						</div>
						<div class="col-md-5 col-sm-5 col-xs-8 mobright">
							<?=$productData->productName?> (<?=$productOption->productWeight?> <?=$productOption->productUnit?>)
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobright">
							Qty <?=$record['quantity']?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobpricetop mobright">
							<span class="onlymobprice">Unit Price : </span> &#36; <?=number_format($productOption->productCost,2)?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobpricebottom mobright">
							<span class="onlymobprice">Total Price : </span> &#36; <?=number_format($productTotal,2)?>
						</div>
						<div style="clear:both;width:100%;padding:0;"></div>
					</div>
					<div style="clear:both;width:100%;"></div>
					<? } ?>
					
				</div>
				
				<p class="textright"><button class="mobeditcarbtn onlymob" onclick="window.location.href='<?=APP_URL?>/cart'" >Edit Cart</button>Sub Total : &#36; <?=number_format($subTotal,2)?></p>
    				<?php  
    				$grandTotal = $subTotal;
    				if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){ ?> 
    					<p class="textright">Delivery Charges : &#36; <?=number_format(DELIVERY_CHARGE,2)?></p>
    					<p class="freeDelivery">(Shop for &#36; <?=FREE_DELIVERYAMOUNT_LIMIT?> or more for FREE delivery)</p>
    				<? 
    					$grandTotal+=DELIVERY_CHARGE;
    				} ?>

				<span id="discountAmt">
    			</span>	
				<p class="grandtiotal">
					<button class="editcartbtn nomob" onclick="window.location.href='<?=APP_URL?>/cart'" >Edit Cart</button> 
					Total Payable :  <span id="totalPayable"> &#36; <?=number_format($grandTotal,2)?></span>
				</p>

				
				


				<div style="clear:both;width:100%;"></div>
		<div class="separator"></div>
		
		<div class=" userinfo">
			<h2>Your Details</h2>
			<span id="offerMsg" class="text-center"></span>
			<form  action="actionHandler.php" method="post">
				<input type="hidden" name="action" value="completeOrder">
				<input type="text" name="mobileNumber" placeholder="Mobile Number*" pattern=".{10,}" required title="Enter Valid Mobile Number" id="newMobileNumber">
				<input type="text" name="fullName" placeholder="Full Name*" required>
				<input type="email" name="email" placeholder="Email ID(Optional)">
				<textarea rows="5" cols="5" name="address" placeholder="Address*" required></textarea>
				<textarea rows="5" cols="5" name="note" placeholder="Note(Optional)"></textarea>
				<div class="checkout">
					<p><input type="radio" name="paymentType" value="cashOnDelivery" checked> Cash on Delivery</p>
					<button class="btn btn-success" type="submit">Confirm Order</button>
				</div>
			</form>
		</div>

		
			<?

		}else{

			echo "Your cart is empty!";
		}

}


// CHECKOUT Test


function cartCheckout111(){
		$db = new DB();
		$oauth = new oauth();
		$query = "SELECT id, productId, productOptionId, quantity,timeslotVal FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";

		?>
		
		<h2>Checkout & Confirm Order</h2>
		
		<?

		 if($db->num_rows( $query ) > 0 ){
	   
	  	 	$records = $db->get_results($query);
	  	 	$subTotal = 0;
	  	 	$grandtotal = 0;
	  	 	$productTotal = 0;
	  	 	$totalItems = 0;
	  	 	$giftProduct = 'No';
	  	 	$giftCatIds = explode(',', giftCatIds);
	  	 			

			?>
				<div class="col-md-12 col-sm-12 col-xs-12 showcart itemSummery">
					<div class="carttitle nomob">
						<div class="col-md-1 col-sm-1 col-xs-1">Item</div>
						<div class="col-md-5 col-sm-5 col-xs-5">Description</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Quantity</div>
						<div class="col-md-2 col-sm-2 col-xs-2">Unit Price</div>
						<div class="col-md-2 col-sm-2 col-xs-2 last">Total</div>
						<div style="clear:both;width:100%;padding:0;"></div>
					</div>

					<?
					foreach($records as $record){

						$productData = $db->get_row("SELECT id, productName,categoryId FROM ".PRODUCTS." 
										              WHERE id='".$record['productId']."'", true);

						if (in_array($productData->categoryId, $giftCatIds)) {
							$giftProduct = 'Yes';
						}

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

						if($productOption->active=='1'){
							if($productOption->productStock <1){
								header('Location:'.APP_URL.'/cart');
								exit;
							}
						}else{
							$productOptionStockCheck = $db->get_row("SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE active='1' AND productId='".$record['productId']."' AND productWeight='".$productOption->productWeight."' AND productUnit='".$productOption->productUnit."' ", true);
							if($productOptionStockCheck->productStock <1){
								header('Location:'.APP_URL.'/cart');
								exit;						
							}
						}
					?>

					<div class="col-ms-12 col-sm-12 col-xs-12 mobonlypadd cartdata">
						<div class="col-md-1 col-sm-1 col-xs-4 mobleft">
							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							<? }else{ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
							<? } ?>
						</div>
						<div class="col-md-5 col-sm-5 col-xs-8 mobright">
							<?=$productData->productName?> (<?=$productOption->productWeight?> <?=$productOption->productUnit?>)
							<br/><?=$record['timeslotVal']?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobright">
							<span class="visible-xs">Qty</span> <?=$record['quantity']?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobpricetop mobright">
							<span class="onlymobprice">Unit Price : </span> &#36; <?=number_format($productOption->productCost,2)?>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-8 mobpricebottom mobright">
							<span class="onlymobprice">Total Price : </span> &#36; <?=number_format($productTotal,2)?>
						</div>
						<div style="clear:both;width:100%;padding:0;"></div>
					</div>
					<div style="clear:both;width:100%;"></div>
					<? } ?>
					
				</div>
				<div class="row">
					<div class="couponCodeWrap col-xs-12 col-sm-4">
						<form action="" id="coupon_form" name="coupon_form" method="post" role="form">
							<div class="row">
								<div class="col-xs-8">
									<input class="form-control" placeholder="Coupon Code" name="couponcode" value="<?=$_SESSION['couponCode']?>" type="text" required>
				                
				                </div>
				                <div class="col-xs-4 paddoff">
				                	<button type="submit" class="editcartbtn">Apply</button>
				                	<!-- <button type="submit" class="mobeditcarbtn onlymob">Apply</button> -->
				            	</div>
				            </div>	
						</form>
						<span id="couponMsg"></span>
						<div class="editcartbtnDiv ">
							<button class="editcartbtn nomob" onclick="window.location.href='<?=APP_URL?>/cart'" >Edit Cart</button> 
						</div>	
					</div>
					<div class="col-xs-12 col-sm-8">
						<p class="textright"><button class="mobeditcarbtn onlymob" onclick="window.location.href='<?=APP_URL?>/cart'" >Edit Cart</button>Sub Total : &#36; <?=number_format($subTotal,2)?></p>
	    				<?php  
	    				$grandTotal = $subTotal;
	    				if($subTotal<FREE_DELIVERYAMOUNT_LIMIT){ ?> 
	    					<p class="textright">Delivery Charges : &#36; <?=number_format(DELIVERY_CHARGE,2)?></p>
	    					<p class="freeDelivery">(Shop for &#36; <?=FREE_DELIVERYAMOUNT_LIMIT?> or more for FREE delivery)</p>
	    				<? 
	    					$grandTotal+=DELIVERY_CHARGE;
	    				} ?>
	    			<div id="couponDiscount">
	    			</div>
	    			<span id="discountAmt">
	    			</span>

					<p class="grandtiotal">
						
						Total Payable :  <span id="totalPayable"> &#36; <?=number_format($grandTotal,2)?></span>
					</p>
					</div>	
				</div>
				

				
				


				<div style="clear:both;width:100%;"></div>
		<div class="separator"></div>
		
		<div class=" userinfo">
			<h2>Your Details</h2>
			<? if(isset($_SESSION['error_message'])) { ?>
					<br/><div class="alert alert-danger">
					<?=$_SESSION['error_message']?>
					</div>
				<? 	unset($_SESSION['error_message']);
				} ?>

				<? if(isset($_SESSION['success_message'])) { ?>
					<br/><div class="alert alert-success">
					<?=$_SESSION['success_message']?>
					</div>
				<? 	unset($_SESSION['success_message']);
				} ?>
			<span id="offerMsg" class="text-center"></span>
			<?php if($oauth->authUser()){
					$userDetails = $oauth->getUserDetails();
					$lastOrderAddress = $oauth->getLastOrderAddress($userDetails->userId);
					if($userDetails->userType == 'Business'){ ?>
						<script type="text/javascript">
							jQuery( document ).ready(function() {
								applyBusinessUserOffer('<?=$subTotal?>','<?=$grandTotal?>');
							});
						</script>
			<?php	
					}
				}
			?>
			<?php if($giftProduct=='Yes'){?>

				<div id="onlinePayment" >
					<form name="cashOnDeliveryForm" action="actionHandler.php" method="post">
						<h5 class="senderDetails">Recipient's Details:</h5>
						<input type="hidden" name="action" value="completeGiftOffersOrder">
						<input type="text" name="fullName" placeholder="Recipient's Name*" required>
						<input type="text" name="mobileNumber" placeholder="Recipient's Mobile Number* (10 digit mobile number)"  pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number" class="newMobileNumber" > <!-- onkeyup="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" onblur="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" -->
						<input type="email" name="email" placeholder="Email ID*"  required>
						<textarea rows="5" cols="5" name="address" placeholder="Address*" required></textarea>
						<textarea rows="5" cols="5" name="giftMessage" placeholder="Message on Bouquet"></textarea>
						<br/>
						<h5 class="senderDetails">Sender Details:</h5>
						<input type="text" name="senderfullName" placeholder="Sender Name*" value="<?=$userDetails->fullName?>" required>
						<input type="text" name="sendermobileNumber" placeholder="Sender Mobile Number* (10 digit mobile number)" value="<?=$userDetails->mobileNumber?>" pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number" class="newMobileNumber" > <!-- onkeyup="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" onblur="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" -->
						<textarea rows="5" cols="5" name="note" placeholder="Note(Optional)"></textarea>
						<div class="checkout">
							<!-- <p><input type="radio" name="paymentType" value="cashOnDelivery" checked> Cash on Delivery</p> -->
							<button class="btn btn-success" type="submit">Confirm Order</button>
						</div>
					</form>
				</div>

			<?php }else{?>
			<div class="checkout">
					 <p>
						<label><input type="radio" name="paymentType" value="cashOnDelivery" checked onclick="changePaymentOption(this)"> Cash on Delivery</label>
						<label><input type="radio" name="paymentType" value="onlinePayment" onclick="changePaymentOption(this)"> Online Payment <span>Pay Via Credit/Debit Card</span></label>
					</p>
					
			</div>
			
			
			<div id="cashOnDelivery">
				<form name="cashOnDeliveryForm" action="actionHandler.php" method="post">
					<input type="hidden" name="action" value="completeOrder">
					<input type="text" name="fullName" placeholder="Full Name*" value="<?=$userDetails->fullName?>" required>
					<input type="text" name="mobileNumber" placeholder="Mobile Number* (10 digit mobile number)" value="<?=$userDetails->mobileNumber?>"  pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number" class="newMobileNumber"  ><!-- onkeyup="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" onblur="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" -->
					<input type="email" name="email" placeholder="Email ID(Optional)" value="<?=$userDetails->email?>">
					<textarea rows="5" cols="5" name="address" placeholder="Address*" required><?=$lastOrderAddress->address?></textarea>
					<textarea rows="5" cols="5" name="note" placeholder="Note(Optional)"></textarea>
					<div class="checkout">
						<!-- <p><input type="radio" name="paymentType" value="cashOnDelivery" checked> Cash on Delivery</p> -->
						<button class="btn btn-success" type="submit">Confirm Order</button>
					</div>
				</form>
			</div>

			<div id="onlinePayment" style="display:none">
				<form name="cashOnDeliveryForm" action="actionHandler.php" method="post">
					<input type="hidden" name="action" value="completePayumoneyOrder">
					<input type="text" name="fullName" placeholder="Full Name*" value="<?=$userDetails->fullName?>" required>
					<input type="text" name="mobileNumber" placeholder="Mobile Number* (10 digit mobile number)" value="<?=$userDetails->mobileNumber?>" pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number" class="newMobileNumber" > <!-- onkeyup="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" onblur="newRegNumberCheck(this,'<?=$subTotal?>','<?=$grandTotal?>');" -->
					<input type="email" name="email" placeholder="Email ID*" value="<?=$userDetails->email?>" required>
					<textarea rows="5" cols="5" name="address" placeholder="Address*" required><?=$lastOrderAddress->address?></textarea>
					<textarea rows="5" cols="5" name="note" placeholder="Note(Optional)"></textarea>
					<div class="checkout">
						<!-- <p><input type="radio" name="paymentType" value="cashOnDelivery" checked> Cash on Delivery</p> -->
						<button class="btn btn-success" type="submit">Confirm Order</button>
					</div>
				</form>
			</div>
			<?php } ?>
		</div>

		
		

			<?

		}else{

			echo "Your cart is empty!";

			?>
			<button class="shoppingbtn" onclick="window.location.href='<?=APP_URL?>'">
				Continue Shopping <i class="fa fa-shopping-cart"></i>
			</button>
	<?php	}

}




function removeItemFromCart(){

	$db = new DB();

    $delete = array(
        'id' => $db->filter($_POST['id'])
    );

    $deleted = $db->delete(CART, $delete, 1);
    
    if($deleted){
        $this->mainCartFlavors();
        // return ture;
    }else{
        echo 'fail';
    }

}

function updateCartItems(){

	$db = new DB();

	$updatedQty = $db->filter($_POST['qty']);
	$id = $db->filter($_POST['id']);
	
	$updateCart = array(
	    'quantity' => $db->filter($updatedQty)         
	);

	$where_clause = array(
	    'id' => $id
	);

	$updated = $db->update(CART, $updateCart, $where_clause, 1);

	if($updated){
        // $this->mainCartFlavors();
        return ture;
    }else{
        return false;
    }

}
 function getRecommendedProdutcs(){
        $db = new DB();
        $oauth = new oauth();
        $products = new products();
        $query = "SELECT id FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";
		if($db->num_rows($query) > 0 ){

        $cartProductIds = $db->get_results("SELECT productId FROM ".CART." WHERE cartId='".session_id()."'",true);
		foreach ($cartProductIds as $productId) {
                $productIdlist[] = $productId->productId;
            }
		//$productIds = trim($_REQUEST['productIds'],",");
        @$productIds = implode(',', $productIdlist);
        if(isset($productIds) && $productIds!=''){
            $subquery = "AND productId NOT IN (".$productIds.")";
        }else{
            $subquery ='';
        }
        $userDetails = $oauth->getUserDetails();
        $orderIds = $db->get_results("SELECT id FROM ".ORDER_DETAILS." WHERE userId = '".$userDetails->userId."'",true);
        
        if(count($orderIds) > 0){
            foreach ($orderIds as $orderId) {
                $orderIdlist[] = $orderId->id;
            }
            $allOrderIds = implode(',', $orderIdlist);
            $query = "SELECT productName,productId,COUNT(productId) AS count  FROM ".ORDER_ITEMS." WHERE orderId IN (".$allOrderIds.") ".$subquery."  AND active = '1' GROUP BY productId ORDER BY count DESC LIMIT 0,12";
      
        }else{
          $query = "SELECT productName,productId,COUNT(productId) AS count  FROM ".ORDER_ITEMS." WHERE active = '1' ".$subquery." GROUP BY productId ORDER BY count DESC LIMIT 0,12";
       
        }   
        ?>
        <div class="col-xs-12 recommendProduct">
       	<h2>Recommended Products</h2>
	  	<div class="flexslider carousel">
          <ul class="slides">
        <?php
        $recommendedItems = $db->get_results($query);
         foreach ($recommendedItems as $recommendedItem) {
          	?>
          	<li><?php $products->showProductById($recommendedItem['productId']);?></li>
    <?php    
        } ?>
        </ul>
        </div>
    	</div>
     
   <?php }
}
function checkNewNumberOffer(){
	unset($_SESSION['offerAvailable']);
	unset($_SESSION['offerAmount']);
	if($_SESSION['businessUserOffer'] !== 'Yes'){
	    $db = new DB();
	    $couponDiscount = $_SESSION['couponAmount'];
       if($db->filter($_POST['unsetSession'])=='Yes'){
	    	$grandTotal = $db->filter($_POST['grandTotal']);
	    	$totalPay = $grandTotal - $couponDiscount;
			if($totalPay < 0){
				$totalPay = 0;
			}
			echo "{\"msg\":\"unset\",\"totalpay\":\" &#36; ".number_format($totalPay,2)."\"}";
			exit;
		}
		$numberCount =  $db->num_rows( "SELECT id FROM ".ORDER_DETAILS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."' AND orderStatus !='Pending'");
		if($numberCount == 0){
			if($_SESSION['couponAvailable'] !=='Yes'){		
				$_SESSION['offerAvailable'] = 'Yes';
				$grandTotal = $db->filter($_POST['grandTotal']);
				$subTotal = $db->filter($_POST['subTotal']);
				$offerTotal = round(( OFFER_PERCENT / 100) * $subTotal);
				if($offerTotal < 1){
					$offerTotal = 1;
				}
				$_SESSION['offerAmount'] = $offerTotal;
				$totalPay = $grandTotal - $offerTotal;
				if($totalPay < 0){
					$totalPay = 0;
				}
				echo "{\"msg\":\"<p>Discount applied successfully. Total amount reduced by ".OFFER_PERCENT."%!</p>\",\"offer\":\"<p class='text-right'>Discount (".OFFER_PERCENT."%): &#36; ".number_format($offerTotal,2)."</p>\",\"totalpay\":\" &#36; ".number_format($totalPay,2)."\"}";
			}else{
				$grandTotal = $db->filter($_POST['grandTotal']);
		    	$totalPay = $grandTotal - $couponDiscount;
				if($totalPay < 0){
					$totalPay = 0;
				}
				echo "{\"msg\":\"unset\",\"totalpay\":\" &#36; ".number_format($totalPay,2)."\"}";
				exit;
			}
		}	
	}else{
		echo "{\"msg\":\"businessoffer\"}";
				exit;
	}	
}

function applyBusinessUserOffer(){
	unset($_SESSION['businessUserOffer']);
	unset($_SESSION['businessUserOfferAmount']);
	unset($_SESSION['couponAvailable']);
	unset($_SESSION['couponAmount']);
	unset($_SESSION['couponCode']);
	unset($_SESSION['couponId']);
	unset($_SESSION['offerAvailable']);
	unset($_SESSION['offerAmount']);
    $db = new DB();
    $couponDiscount = $_SESSION['couponAmount'];
    $_SESSION['businessUserOffer'] = 'Yes';
	$grandTotal = $db->filter($_POST['grandTotal']);
	$subTotal = $db->filter($_POST['subTotal']);
	$offerTotal = round(( BUSINESS_OFFER_PERCENT / 100) * $subTotal);
	if($offerTotal < 1){
		$offerTotal = 1;
	}
	$_SESSION['businessUserOfferAmount'] = $offerTotal;
	$totalPay = $grandTotal - $offerTotal;
	if($totalPay < 0){
		$totalPay = 0;
	}
	echo "{\"msg\":\"<p>Discount applied successfully. Total amount reduced by ".BUSINESS_OFFER_PERCENT."%!</p>\",\"offer\":\"<p class='text-right'>Discount (".BUSINESS_OFFER_PERCENT."%): &#36; ".number_format($offerTotal,2)."</p>\",\"totalpay\":\" &#36; ".number_format($totalPay,2)."\"}";
		
}
function addToWishlist(){
		$db = new DB();
		$oauth = new oauth();
		date_default_timezone_set("Asia/Calcutta");
        $dateTime  = date('Y-m-d H:i:s', time());
		$productId = $db->filter($_POST['productId']);
		$regId = $oauth->authUser();
		if(isset($regId) && $regId !=''){
			$qry = "SELECT id FROM ".WISHLIST." WHERE productId='".$productId."' AND regId='".$regId."' AND active = '1'";
			if($db->num_rows($qry) > 0 ){
				$wishResult = $db->get_row($qry,true);
				 $delete = array(
		            'id' => $wishResult->id
		        );
		        $deleted = $db->delete(WISHLIST, $delete);
		        if($deleted){
		            echo 'removed';
		        }else{
		            echo 'fail';
		        }
			}else{
				$data = array(
			            'regId' => $regId,
			            'productId' => $productId,
			            'dateTime' => $dateTime
		                );
				$rs = $db->insert(WISHLIST, $data);
				if($rs){
					echo "success";
				}else{
					echo "fail";
				}
			}	
		}else{
			echo "login";
		}
	
	}

	function removeFromWishlist(){
		$db = new DB();
		$oauth = new oauth();
		$productId = $db->filter($_POST['productId']);
		$regId = $oauth->authUser();
		if(isset($regId) && $regId !=''){
			$qry = "SELECT id FROM ".WISHLIST." WHERE productId='".$productId."' AND regId='".$regId."' AND active = '1'";
			if($db->num_rows($qry) > 0 ){
				$wishResult = $db->get_row($qry,true);
				 $delete = array(
		            'id' => $wishResult->id
		        );
		        $deleted = $db->delete(WISHLIST, $delete);
		        if($deleted){
		            echo 'removed';
		        }else{
		            echo 'fail';
		        }
			}else{
				echo 'fail';
			}
		}
	}

	function outofStockCartItems(){
		$db = new DB();
		$cartIds = explode(',', $_REQUEST['cartItemsCatIds']);
		foreach ($cartIds as $catId) {
            $delete = array(
	            'id' => $catId
	        );
	        $deleted = $db->delete(CART, $delete, 1);
        }
        if($deleted){
        	return true;
        }else{
        	return false;
        }		
	}

}
?>