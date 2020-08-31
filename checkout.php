<?php 
    include_once('actionHandler.php');
    include ('includes/header.php');
    $db = new DB();


    if(!$oauth->authUser()){
        header('Location:'.APP_URL);
        exit;
    }

   
    $sqlshipping = "SELECT * FROM ".USER_ADDRESSES." WHERE userId='".$_SESSION['regId']."' AND type='shipping' ";
    $shippingRecords = $db->get_results($sqlshipping);

    $sqlbilling = "SELECT * FROM ".USER_ADDRESSES." WHERE userId='".$_SESSION['regId']."' AND type='billing' ";
    $billingRecords = $db->get_results($sqlbilling);

    $db = new DB();
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
                    <li class="active"><div class="cs-ico vcenter"><span class="fa fa-map-marker"></span></div><p>Address</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-credit-card"></span></div><p>Payment</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-check"></span></div><p>Confirm</p></li>
                </ul>
            </div>
            <!-- /Steps -->

            <section class="csect-row clearfix">

                <!--Order -->
                <div class="csect-block fleft big">
                    <div class="cart-box nsp">
                             <? if(isset($_SESSION['error_message'])) { ?>
                    <br/><div class="alert alert-danger">
                    <?=$_SESSION['error_message']?>
                    </div>
                <?  unset($_SESSION['error_message']);
                } ?>

                <? if(isset($_SESSION['success_message'])) { ?>
                    <br/><div class="alert alert-success">
                    <?=$_SESSION['success_message']?>
                    </div>
                <?  unset($_SESSION['success_message']);
                } ?>
                        <!-- Address -->
                        <div class="crtb-head add clearfix">
                            <h4 class="fleft">Shipping Details</h4>
                            <a href="#addShippingAddress" class="btnBkPopup" style="float:right;"><button type="button" class="btn reg btn-addnew fright"  data-type="shipping">Add new Address</button></a>
                            <br>
                            <br>
                               <div class="crtb-body">
                            <!-- Shipping -->
                               
                                <div class="addr-block">
                                    <input type="hidden" id="ship_aid" name="ship_aid">
                                     <?if(!empty($shippingRecords)){?>
                                    <ul class="ad-list clearfix shipping">
                                         <?foreach($shippingRecords as $shipping){?>
                                         <!-- <input type="hidden" id="ship_aid" name="ship_aid" value="<?=$shipping['id']?>"> -->
                                        <li>
                                            <a href="javascript:void(0);" class="ad-box trans ship" onclick="getShippingAddress('<?=$shipping['id']?>');" data-aid="<?=$shipping['id']?>">
                                                <span></span>
                                                <p><?=$shipping['first_name']?> <?=$shipping['last_name']?></p>
                                                <p><?=$shipping['address_1']?></p>
                                                <p><?=$shipping['address_2']?></p>
                                                <p><?=$shipping['landmark']?></p>
                                                <p><?=$shipping['city']?> - <?=$shipping['pincode']?></p>
                                                <p><?=$shipping['state']?>, <?=$shipping['country']?></p>
                                                <p><?=$shipping['phone']?></p>
                                            </a>
                                        </li>
                                       <?}?> 
                                    </ul>
                                    <?}else{?>
                                    <div class="addr-block">
                                        <p>No address found.</p>
                                    </div>
                                <?}?>
                                </div>
                            <!-- /Shipping -->
                            </div>
                        </div>
                     
                        <div class="crtb-head add clearfix">
                            <h4 class="fleft">Billing Details</h4>
                            <!-- <button type="button" class="btn reg btn-addnew fright" data-type="billing">Add new Address</button> -->
                            <a href="#addBillingAddress" class="btnBkPopup" style="float:right;"><button type="button" class="btn reg btn-addnew fright"  data-type="billing">Add new Address</button></a>
                            <br>
                            <br>
                                 <div class="crtb-body">
                            <!-- Billing -->
                            
                            <div class="addr-block">
                                <input type="hidden" id="bill_aid" name="bill_aid">
                                <?if(!empty($billingRecords)){?>
                                <ul class="ad-list clearfix billing">
                                    
                                    <!-- <li class="empty billing"><p>No address found.</p></li> -->
                                    <?foreach($billingRecords as $billing){?>
                                    <!-- <input type="hidden" id="billing_aid" name="billing_aid" value="<?=$billing['id']?>"> -->
                                     <li>
                                        <a href="javascript:void(0);" style="" class="ad-box trans ship" onclick="getBillingAddress('<?=$billing['id']?>');" data-aid="<?=$billing['id']?>">
                                            <span></span>
                                            <p><?=$billing['first_name']?> <?=$billing['last_name']?></p>
                                            <p><?=$billing['address_1']?></p>
                                            <p><?=$billing['address_2']?></p>
                                            <p><?=$billing['landmark']?></p>
                                            <p><?=$billing['city']?> - <?=$billing['pincode']?></p>
                                            <p><?=$billing['state']?>, <?=$billing['country']?></p>
                                            <p><?=$billing['phone']?></p>
                                        </a>
                                    </li>
                                    <?}?>
                                </ul>
                                <?}else{?>
                                <div class="addr-block">
                                    <p>No address found.</p>
                                </div>
                            <?}?>
                            </div>
                            
                            <!-- /Billing -->
                        </div>
                  
                        </div>
                   
                        <!-- /Address -->
                    </div>
                </div>
                <!--Order -->
                <!--Summary -->
                <div class="csect-block fright small gray" id="sidebar">
                    <div class="cart-box">
                        <div class="crtb-head">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="crtb-body">
                            <div class="cart-total">
                                <input type="hidden" value="" name="subtotal" id="subtotal">
                                <?php  
                                    $shipping = DELIVERY_CHARGE;
                                    $grandTotal = $subTotal + $shipping;

                                ?>
                                <p>Subtotal<span>&dollar; <?=number_format($subTotal,2)?></span></p>
                                <p>Shipping<span>&dollar; <?=number_format($shipping,2)?></span></p>
                                <p class="final">Total<span>&dollar; <span id="final_total"><?=number_format($grandTotal,2)?></span></span></p>
                                <p>
                                <textarea class="form-control" placeholder="Note" id="addtional_note"></textarea>
                                </p>
                                <div class="check-btn">
                                    <button type="button" class="btn sbtn block make_payment" id='make-payment' name='make-payment'>Checkout</button>
                                    <p class="note hide" id="bnote">Please select billing & shipping addresses!</p>
                                </div>
                            </div>
                        </div>
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
                                    $productTotal = $record['quantity']*$productOption->productCost;
                                    $totalItems+= $record['quantity'];
                                    $subTotal+=$productTotal;
                                ?>
                                <ul class="csum-list" style="display:none;">
                                    
                                    <li class="clearfix">
                                        <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                            <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="Beauty-Mineral - <?=$productData->productName?>" alt="Beauty-Mineral - Health & Beauty from the Dead Sea">
                                        <? }else{ ?>
                                            <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png"  title="Beauty-Mineral - Health & Beauty from the Dead Sea" alt="Beauty-Mineral - Health & Beauty from the Dead Sea">
                                        <? } ?>
                                        <p><?=$productData->productName?> <?php if($attrValueSet !=''){ echo '('.rtrim($attrValueSet,',').')'; } ?><br><span>Quantity:  <?=$record['quantity']?></span><br><span>Unit Price: Rs <?=$productOption->productCost?></span><br><strong>Total: Rs <?=number_format($productTotal,2)?></strong></p>
                                    </li>
                                    <hr>
                                </ul>

                                <?}?>
                            </div>

                            
                            <!-- /Items -->
                    </div>
                </div>
                <!--Charges -->

            </section>

        </div>

    </div>
</div>

<!-- New shipping Address -->
<div id="addShippingAddress" class="bookPopup reserveForm">
    <div class="modal-inner">
       <div class="head"><b>Add New Address</b></div>
        <div class="modal-body">
            
             <div class="modal-form clearfix" style="padding-top:10px;">
                            <form id="form-add-new" method="post" action="" class="validable">
                            <input type="hidden" name="action" value="saveShippingAddress">
                            <input type="hidden" id="type" name="type" value="shipping">
                            <div class="formx col2">
                                <div class="fip">
                                    <input type="text" id="first_name" name="first_name" required>
                                    <label class="fpl">First Name</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="last_name" name="last_name" required>
                                    <label class="fpl">Last Name</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="address_1" name="address_1" required>
                                    <label class="fpl">Address Line 1</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="address_2" name="address_2" required>
                                    <label class="fpl">Address Line 2</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="landmark" name="landmark" required>
                                    <label class="fpl">Landmark</label>
                                </div>
                                <div class="fip">
                                    <input type="hidden" id="country_id" name="country_id" value="99">
                                    <input type="text" id="country" name="country" value="India" readonly>
                                    <label class="fpl show">Country</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="state" name="state" required>
                                 
                                    <label class="fpl show">State</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="city" name="city" required>
                                    <label class="fpl show">City</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="pincode" name="pincode" pattern="[0-9]{6}?$" title="Please enter correct PIN" required>
                                    <label class="fpl">Pincode</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="phone" name="phone" pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
                                    <label class="fpl">Mobile No.</label>
                                </div>
                                <div class="clear"></div>
                                <div class="fip sub full">
                                    <div class="check clearfix">
                                        <input type="checkbox" id="sameadd" value="Yes" name="sameadd">
                                        <label for="sameadd">Click here to use same address for billing and shipping</label>
                                    </div>
                                </div>
                                <div class="fsub">
                                    <button type="submit" class="btn sbtn block">Save Address</button>
                                </div>
                            </div>
                            </form>
                        </div>
            
        </div>
    </div>
</div>
<!-- /New Shipping Address -->


<!-- New Billing Address -->
<div id="addBillingAddress" class="bookPopup reserveForm">
    <div class="modal-inner">
       <div class="head"><b>Add New Address</b></div>
        <div class="modal-body">
            
          <div class="modal-form clearfix" style="padding-top:10px;">
                <form id="form-add-new1" method="post" name="form-add-new" class="validable">
                <input type="hidden" name="action" value="saveBillingAddress">
                <input type="hidden" id="type" name="type" value="billing">
                <div class="formx col2">
                    <div class="fip">
                        <input type="text" id="first_name" name="first_name" required>
                        <label class="fpl">First Name</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="last_name" name="last_name" required>
                        <label class="fpl">Last Name</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="address_1" name="address_1" required>
                        <label class="fpl">Address Line 1</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="address_2" name="address_2" required>
                        <label class="fpl">Address Line 2</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="landmark" name="landmark" required>
                        <label class="fpl">Landmark</label>
                    </div>
                    <div class="fip">
                        <input type="hidden" id="country_id" name="country_id" value="99">
                        <input type="text" id="country" name="country" value="India" readonly>
                        <label class="fpl show">Country</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="state" name="state" required>
                     
                        <label class="fpl show">State</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="city" name="city" required>
                        <label class="fpl show">City</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="pincode" name="pincode" pattern="[0-9]{6}?$" title="Please enter correct PIN" required>
                        <label class="fpl">Pincode</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="phone" name="phone" pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
                        <label class="fpl">Phone No.</label>
                    </div>
                    <div class="clear"></div>
                    <div class="fip sub full">
                       
                    </div>
                    <div class="fsub">
                        <button type="submit" class="btn sbtn block">Save Address</button>
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- /New Billing Address -->

</section>
<script type="text/javascript">
    $(document).ready(function(e){
        if(!isMobile())
            $("#sidebar").stick_in_parent({offset_top:100});
        $('.btn-addnew').click(function(e){
            var that = $(this);
            $('#flag').val(that.data('type'));
            var modal = $('#modal-address');
            placeModal(modal);
            showModal(modal);
        });
        $('body').on("change","#states",function(e){
            $('.city').load("get_city.php",{state:$(this).val()});
        });

        $('#make-payment').click(function(e){
            var address_array=[];
            var shipp_add=$("#ship_aid").val();
            var bill_add=$("#bill_aid").val();
            var note = $('#addtional_note').val();
            //if(note!=''){
                jQuery.ajax
                ({
                    type: "POST",
                    url: APPURL+"ajxHandler.php",
                    data: "action=addtional_note&note="+note,
                    success: function(data)
                    {   
                        if(shipp_add!="" && bill_add!=""){
                            address_array={bill_add:bill_add,shipp_add:shipp_add};
                            // $.post("cart.php",{address:address_array},function(data){
                            //     if(data>0)
                                    location.href="makepayment.php";
                            //     else
                            //         alert('Sorry, An error occurred! Please try again!');
                            // });
                        }
                        else{
                            $('#bnote').removeClass('hide');
                        } 
                    },
                    
                });
            // }else{
            //     if(shipp_add!="" && bill_add!=""){
            //         address_array={bill_add:bill_add,shipp_add:shipp_add};
            //         // $.post("cart.php",{address:address_array},function(data){
            //         //     if(data>0)
            //                 location.href="makepayment.php";
            //         //     else
            //         //         alert('Sorry, An error occurred! Please try again!');
            //         // });
            //     }
            //     else{
            //         $('#bnote').removeClass('hide');
            //     }
            // }
            
        });
        
        var flag;
        $('#bnadd').click(function(e){
            var valid = $('#form-add-new').validationEngine('validate');
            if(valid){
                flag=$("#flag").val();
                $('#bnadd').attr('disabled','disabled').text('Processing...');
                add_address();
            }
        });

        var flag1;
        $('#bnadd1').click(function(e){
            var valid = $('#form-add-new1').validationEngine('validate');
            if(valid){
                flag=$("#flag").val();
                $('#bnadd1').attr('disabled','disabled').text('Processing...');
                add_address();
            }
        });
        
        
        // function add_address(){
        //     $.ajax({
        //         type:'POST',
        //         url: 'add_address.php',
        //         data:$('#form-add-new').serialize(),
        //         datatype : 'html',
        //         success:function(data){
        //             if(!$('#sameadd').is(':checked'))
        //                 $('#bnadd').text('Saved successfully!');
        //             setTimeout(function(){
        //                 if(flag=="billing"){
        //                     if($('.empty.billing').size()>0)
        //                         $('.empty.billing').remove();
        //                     $("ul.billing").append(data);
        //                 }
        //                 else if(flag=="shipping"){
        //                     if($('.empty.shipping').size()>0)
        //                         $('.empty.shipping').remove();
        //                     $("ul.shipping").append(data);
        //                 }
        //                 $('.ad-box.new').trigger('click');
        //                 if($('#sameadd').is(':checked')){
        //                     flag = flag=="billing" ? "shipping" : "billing";
        //                     $("#flag").val(flag);
        //                     //fd.set('flag',flag);
        //                     $('#sameadd').prop('checked',false);
        //                     $('#sameadd').removeAttr('checked');
        //                     add_address();
        //                 }
        //                 else{
        //                     hideModal($('#modal-address'));
        //                     setTimeout(function(){
        //                         $('#form-add-new')[0].reset();
        //                         $('#bnadd').removeAttr('disabled').text('Save Address');
        //                     },600);
        //                 }
        //             },300);
        //         }
        //     });
        // }
        
        
        
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
