<?php 
   include_once('actionHandler.php');
    include ('includes/header.php');
 // pre($_SESSION);
 //    exit;
if(!$oauth->authUser()){
        header('Location:'.APP_URL);
        exit;
    }

$db = new DB();

$qry = "SELECT * FROM ".CART_ADDRESS." WHERE cartId='".session_id()."'";
if($db->num_rows( $qry ) > 0 ){
    // header('Location:'.APP_URL.'/makepayment.php');
    // exit;
}else{
    header('Location:'.APP_URL.'/checkout.php');
    exit;
}

$query = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."' ORDER BY id DESC";
$records = $db->get_results($query);
$subTotal = 0;
$grandtotal = 0;
$productTotal = 0;
$totalItems = 0;

?>

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

<?}?>
            
<section class="ourtopsellers skincare">
<div class="inner-container topsellers">
    <div class="inner-wrap">

        <div class="cart-container">

            <!-- Steps -->
            <div class="cart-steps">
                <ul class="clearfix">
                    <li><div class="cs-ico vcenter"><span class="fa fa-shopping-cart"></span></div><p>Cart</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-sign-in"></span></div><p>Login</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-map-marker"></span></div><p>Address</p></li>
                    <li class="active"><div class="cs-ico vcenter"><span class="fa fa-credit-card"></span></div><p>Payment</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-check"></span></div><p>Confirm</p></li>
                </ul>
            </div>
            <!-- /Steps -->

            <section class="csect-row clearfix">
                <!--Order -->
                <div class="csect-block fleft big">
                    <div class="cart-box nsp">
                        <form id="form-3" name="form-3" method="post">
                        <!-- Payment -->
                        <input type="hidden" id="txtship" name="txtship" value="">
                        <input type="hidden" id="txtbill" name="txtbill" value="">
                        <div class="crtb-head">
                            <h4>Payment Method</h4>
                        </div>
                        <div class="crtb-body">
                            <div class="pay-block">
                                <h6>Select Payment Option</h6>
                                <div class="pay-type clearfix">
                                    <input type="hidden" id="pay_type" name="pay_type" value="">
                                    <a href="javascript:void(0);" class="tlink pay-btn cod active" data-type="cod">
                                        <span></span>Cash on delivery<!-- <sub class="sreg">INR 30 Extra</sub><sub class="soff">Not Available</sub> -->
                                    </a>

                                    <a href="javascript:void(0);" class="pay-btn pay"><span></span>Pay online</a>
                                   
                                </div>
                                <p class="pay-note online" style="display:none;">On clicking the make payment button, you will be directed to a secure gateway to process your payment.</p>
                                <!-- <p class="pay-note cod">If you select cash on delivery, you have to pay INR 30 extra.</p> -->
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!--Order -->
                   <!--Summary -->
                <div class="csect-block fright small gray" id="sidebar">
                    <div class="cart-box">
                        <div class="crtb-head">
                            <h4>Order Summary</h4>
                        </div>
                          <div class="crtb-body" id="cod">
                            <form name="onlinePaymentForm" action="actionHandler.php" method="post">
                                <input type="hidden" name="action" value="completeOrder">
                                <div class="cart-total">
                                    <input type="hidden" value="" name="subtotal" id="subtotal">
                                    <?php  
                                        $shipping = DELIVERY_CHARGE;
                                        $grandTotal = $subTotal + $shipping;
                                    ?>
                                    <p>Subtotal<span>&dollar; <?=number_format($subTotal,2)?></span></p>
                                    <p>Shipping<span>&dollar; <?=number_format($shipping,2)?></span></p>
                                    
                                    <p class="final">Total<span>&dollar; <span id=""><?=number_format($grandTotal,2)?></span></span></p>
                                    <div class="check-btn">
                                        <button type="submit" class="btn sbtn gout block" name="book_order" id="book_order1">Book my Order</button>
                                    </div>
                                </div>
                            </form>
                              
                            <!-- Items -->
                             <div class="csum-block">
                                <a href="javascript:void(0);" class="csum-toggle">In your Cart<span></span></a>
                                <?
                                    foreach($records as $record){

                                        $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                                                      WHERE id='".$record['productId']."'", true);

                                        $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                                      WHERE productId='".$record['productId']."'", true);

                                        $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                                      $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                                        $attrValueSet='';   
                                            foreach ($productAttrubutes as $productAttrubute) {
                                                $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                                if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                                            }
                                        $productCodTotal = $record['quantity']*$productOption->productCost; 
                                ?>
                                    <ul class="csum-list" style="display:none;">
                                        
                                        <li class="clearfix">
                                            <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                                <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="beauty-mineral - <?=$productData->productName?>" alt="beauty-mineral - Health & Beauty from the Dead Sea">
                                            <? }else{ ?>
                                                <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png"  title="beauty-mineral - <?=$productData->productName?>" alt="beauty-mineral - Health & Beauty from the Dead Sea">
                                            <? } ?>
                                            <p><?=$productData->productName?> <?php if($attrValueSet !=''){ echo '('.rtrim($attrValueSet,',').')'; } ?><br><span>Quantity: <?=$productOption->productWeight?> <?=$productOption->productUnit?> X <?=$record['quantity']?></span><br><span>Unit Price: Rs <?=$productOption->productCost?></span><br><strong>Total: Rs <?=number_format($productCodTotal,2)?></strong></p>
                                        </li>
                                        
                                    </ul>
                                <?}?>

                            </div>
                            <!-- /Items -->
                        </div>
                        
                        <div class="crtb-body" id="online" style="display:none;">
                            <form name="onlinePaymentForm" action="actionHandler.php" method="post">
                                <input type="hidden" name="action" value="completePayumoneyOrder">
                                <div class="cart-total">
                                    <input type="hidden" value="" name="subtotal" id="subtotal">
                                    <?php  
                                        $shipping = DELIVERY_CHARGE;
                                        $grandTotal = $subTotal + $shipping;
                                    ?>
                                    <p>Subtotal<span>&dollar; <?=number_format($subTotal,2)?></span></p>
                                    <p>Shipping<span>&dollar; <?=number_format($shipping,2)?></span></p>
                                    
                                    <p class="final">Total<span>&dollar; <span id=""><?=number_format($grandTotal,2)?></span></span></p>
                                    <div class="check-btn">
                                        <button type="submit" class="btn sbtn gout block" name="book_order" id="book_order1">Book my Order</button>
                                    </div>
                                </div>
                            </form>
                              
                           <!-- Items -->
                             <div class="csum-block">
                                <a href="javascript:void(0);" class="csum-toggle">In your Cart<span></span></a>
                                <?
                                    foreach($records as $record){

                                        $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                                                      WHERE id='".$record['productId']."'", true);

                                        $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                                      WHERE productId='".$record['productId']."'", true);

                                        $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                                        $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                                    $attrValueSet='';   
                                        foreach ($productAttrubutes as $productAttrubute) {
                                            $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                            if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                                        }
                                     
                                        $productOnlineTotal = $record['quantity']*$productOption->productCost;  
                                ?>
                                    <ul class="csum-list" style="display:none;">
                                        
                                        <li class="clearfix">
                                            <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                                <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="beauty-mineral - <?=$productData->productName?>" alt="beauty-mineral - Health & Beauty from the Dead Sea">
                                            <? }else{ ?>
                                                <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png"  title="beauty-mineral - <?=$productData->productName?>" alt="beauty-mineral - Health & Beauty from the Dead Sea">
                                            <? } ?>
                                            <p><?=$productData->productName?> <?php if($attrValueSet !=''){ echo '('.rtrim($attrValueSet,',').')'; } ?><br><span>Quantity: <?=$record['quantity']?></span><br><span>Unit Price: Rs <?=$productOption->productCost?></span><br><strong>Total: Rs <?=number_format($productOnlineTotal,2)?></strong></p>
                                        </li>
                                        
                                    </ul>
                                <?}?>

                            </div>
                            <!-- /Items -->
                        </div>

                      
                    </div>
                </div>
                <!--Charges -->

            </section>

        </div>

    </div>
</div>
</section>
<script type="text/javascript">
    $('#book_order1').click(function(e){
            var pay_type=$("#pay_type").val();
            if(pay_type!="")
            {
                var fd = new FormData();
                fd.append('pay_type',pay_type);
                $.ajax({
                    type:'POST',
                    url: 'place_order.php',
                    data:fd,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        console.log(pay_type);
                        if(data>0 && pay_type=="online"){
                            location.href="payuform.php";
                        }
                        else if(data>0 && pay_type=="cod"){
                            location.href="thankyou";
                        }
                    },
                    error: function(data){
                    }
                });
            }else{
                alert('Internal Error Occurred');
            }
        });
</script>

<?php include ('includes/footer.php');?>
        </main>
    </main >

    <div class="modal-backdrop"></div>
    <script type="text/javascript">
        $(document).ready(function(e){
            $('.tip').tooltipster();
            $('.scrollbox').tinyscrollbar();
            $('.validable').each(function(index, element) {
                $(this).validationEngine({focusFirstField:false,scroll:false,maxErrorsPerField:1,showArrow:false});
            });
        });
    </script>

  
</body>
</html>
