<?php 
include_once('actionHandler.php');
include ('includes/header.php');
    
    $db = new DB();
    // $shippingId = base64_decode($_REQUEST['shippingId']);
    if(isset($_REQUEST['shippingId']) && $_REQUEST['shippingId']!='' && is_numeric(base64_decode($_REQUEST['shippingId']))){
        $shippingId = base64_decode($_REQUEST['shippingId']);
    }else{
        header('Location:'.APP_URL);
        exit;
    }
    // pre($shippingId);
    $sqlshipping = "SELECT * FROM ".USER_ADDRESSES." WHERE id='".$shippingId."' AND type='shipping' ";
    $shippingRecords = $db->get_row($sqlshipping, ture);
    // pre($shippingRecords);

    if(!$oauth->authUser()){
        header('Location:'.APP_URL);
        exit;
    }
?>

<section class="ourtopsellers skincare">
<div class="inner-container topsellers">
    <div class="inner-wrap">

        <div class="cart-container">

         

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

               
                        <!-- Address -->
                        <div class="crtb-head add clearfix">
                            <h4 class="fleft">Edit Shipping Address</h4>
                            <!-- <button type="button" class="btn reg btn-addnew fright" data-type="shipping">Add new Address</button> -->
                            <br>
                         
                            <div class="modal-form clearfix" style="padding-top:10px;">
                            <form id="form-add-new" method="post" name="form-add-new" class="validable">
                            <input type="hidden" id="flag" name="action" value="updateShippingAddress">
                            <input type="hidden" name="shippingId" value="<?=base64_encode($shippingRecords->id)?>">
                            <div class="formx col2">
                                <div class="fip">
                                    <input type="text" id="first_name" name="first_name" value="<?=$shippingRecords->first_name?>" required class="trans validate[required] reqfield">
                                    <label class="fpl">First Name</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="last_name" name="last_name" value="<?=$shippingRecords->last_name?>" required class="trans validate[required] reqfield">
                                    <label class="fpl">Last Name</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="address_1" name="address_1" value="<?=$shippingRecords->address_1?>" required class="trans validate[required] reqfield">
                                    <label class="fpl">Address Line 1</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="address_2" name="address_2" value="<?=$shippingRecords->address_2?>" required class="trans validate[required] reqfield">
                                    <label class="fpl">Address Line 2</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="landmark" name="landmark" value="<?=$shippingRecords->landmark?>" required class="trans validate[required] reqfield">
                                    <label class="fpl">Landmark</label>
                                </div>
                                <div class="fip">
                                    <input type="hidden" id="country_id" name="country_id" value="99">
                                    <input type="text" id="country" name="country" value="<?=$shippingRecords->country?>" readonly>
                                    <label class="fpl show">Country</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="state" name="state" value="<?=$shippingRecords->state?>" required class="trans validate[required] reqfield">
                                 
                                    <label class="fpl show">State</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="city" name="city" value="<?=$shippingRecords->city?>" required class="trans validate[required] reqfield">
                                    <label class="fpl show">City</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="pincode" name="pincode" value="<?=$shippingRecords->pincode?>" required class="trans validate[required] reqfield">
                                    <label class="fpl">Pincode</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="phone" name="phone" value="<?=$shippingRecords->phone?>" class="trans validate[required] reqfield">
                                    <label class="fpl">Phone No.</label>
                                </div>
                                <div class="clear"></div>
                               <!--  <div class="fip sub full">
                                    <div class="check clearfix">
                                        <input type="checkbox" id="sameadd" value="Yes" name="sameadd">
                                        <label for="sameadd">Click here to use same address for billing and shipping</label>
                                    </div>
                                </div> -->
                                <div class="fsub">
                                    <button type="submit" class="btn sbtn block" id="bnadd" id="bnadd">Update Address</button>
                                </div>
                            </div>
                            </form>
                        </div>
            
                        </div>
                     
                      
                        </div>
                    </div>
                
            </section>

        </div>

    </div>
</div>
</section>
<script type="text/javascript">
    //$(document).ready(function(e){

        // var flag;
        // $('#bnadd').click(function(e){
        //     var valid = $('#form-add-new').validationEngine('validate');
        //     if(valid){
        //         flag=$("#flag").val();
        //         $('#bnadd').attr('disabled','disabled').text('Processing...');
                
        //     }
        // });

      
    //});
</script>
<?php include ('includes/footer.php');?>