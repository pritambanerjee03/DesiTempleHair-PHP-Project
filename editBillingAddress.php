<?php 
include_once('actionHandler.php');
include ('includes/header.php');
    
    $db = new DB();
    // $billingId = base64_decode($_REQUEST['billingId']);
    if(isset($_REQUEST['billingId']) && $_REQUEST['billingId']!='' && is_numeric(base64_decode($_REQUEST['billingId']))){
        $billingId = base64_decode($_REQUEST['billingId']);
    }else{
        header('Location:'.APP_URL);
        exit;
    }
   
    $sqlbilling = "SELECT * FROM ".USER_ADDRESSES." WHERE id='".$billingId."' AND type='billing' ";
    $billingRecords = $db->get_row($sqlbilling, ture);

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
                            <h4 class="fleft">Edit Billing Address</h4>
                            <!-- <button type="button" class="btn reg btn-addnew fright" data-type="shipping">Add new Address</button> -->
                            <br>
                         
                            <div class="modal-form clearfix" style="padding-top:10px;">
                            <form id="form-add-new" method="post" name="form-add-new" class="validable">
                            <input type="hidden" name="action" value="updateBillingAddress">
                            <input type="hidden" name="billingId" value="<?=base64_encode($billingRecords->id)?>">
                            <div class="formx col2">
                                <div class="fip">
                                    <input type="text" id="first_name" name="first_name" required value="<?=$billingRecords->first_name?>" class="trans validate[required] reqfield">
                                    <label class="fpl">First Name</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="last_name" name="last_name" required value="<?=$billingRecords->last_name?>" class="trans validate[required] reqfield">
                                    <label class="fpl">Last Name</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="address_1" name="address_1" required value="<?=$billingRecords->address_1?>" class="trans validate[required] reqfield">
                                    <label class="fpl">Address Line 1</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="address_2" name="address_2" required value="<?=$billingRecords->address_2?>" class="trans validate[required] reqfield">
                                    <label class="fpl">Address Line 2</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="landmark" name="landmark" required value="<?=$billingRecords->landmark?>" class="trans validate[required] reqfield">
                                    <label class="fpl">Landmark</label>
                                </div>
                                <div class="fip">
                                    
                                    <input type="text" id="country" name="country" value="<?=$billingRecords->country?>" readonly>
                                    <label class="fpl show">Country</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="state" name="state" required value="<?=$billingRecords->state?>" class="trans validate[required] reqfield">
                                 
                                    <label class="fpl show">State</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="city" name="city" required value="<?=$billingRecords->city?>" class="trans validate[required] reqfield">
                                    <label class="fpl show">City</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="pincode" name="pincode" required value="<?=$billingRecords->pincode?>" class="trans validate[required] reqfield">
                                    <label class="fpl">Pincode</label>
                                </div>
                                <div class="fip">
                                    <input type="text" id="phone" name="phone" required value="<?=$billingRecords->phone?>" class="trans validate[required] reqfield">
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
<?php include ('includes/footer.php');?>