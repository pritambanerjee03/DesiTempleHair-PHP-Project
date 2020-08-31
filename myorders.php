<?php 
    include ('includes/header.php');
    if(!$oauth->authUser()){
        header('Location:'.APP_URL.'/login.php');
        exit;
    }

    $userDetails = $db->get_row("SELECT userId FROM ".REGISTERED_USER." WHERE id = '".$oauth->authUser()."'",true);
    // pre($userDetails);
    $userId = $userDetails->userId;
    $totalOrderCount = $db->num_rows("SELECT id FROM ".ORDER_DETAILS." WHERE order_details.userId='".$userId."' ORDER BY id DESC");
// pre($totalOrderCount);
    $query = "SELECT id,totalAmount,offerAmt,invoiceNo,fullName,orderStatus,dateTime,couponDiscount,dateTime FROM ".ORDER_DETAILS." WHERE order_details.userId='".$userId."' ORDER BY id DESC LIMIT 5";
       
    // if(!$oauth->authUser()){
    //     header('Location:'.APP_URL);
    //     exit;
    // }
    
    ?>
            
<section class="ourtopsellers skincare">
<div class="inner-container topsellers gray">
    <div class="inner-wrap">

        <div class="cart-container gray">

            <section class="csect-row clearfix">

                <!-- User -->
                <div class="csect-block fleft small">
                    <div class="cart-box nsp ntp">
                        <div class="crtb-body">
                            <div class="user-block">
                                <div class="user-info">
                                    <h5><?=$_SESSION['email']?></h5>
                                    <h6></h6>
                                </div>
                                <div class="user-action">
                                    <a href="myaccount.php" class="tlink"><span class="fa fa-user"></span>Account Info</a>
                                    <a href="myorders.php" class="tlink active"><span class="fa fa-bars"></span>My Orders</a>
                                    <a href="myaddresses.php" class="tlink"><span class="fa fa-map-marker"></span>My Addresses</a>
                                    <hr>
                                    <a href="logout.php" class="tlink"><span class="fa fa-sign-out"></span>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User -->
                <!-- Data -->
                <div class="csect-block fright big">
                    <div class="cart-box ntp nspm">
                        
                        <div class="crtb-inner ntb">
                            <div class="crtb-head">
                                <h4>My Orders</h4>
                            </div>
                            <div class="crtb-body clearfix">
                                <div class="olist">
                                    <?
                                        if($db->num_rows($query) > 0){
                                        $results = $db->get_results($query);                   
                                        foreach( $results as $row ){ 
                                        // pre($row);         
                                            $totalAmount = $row['totalAmount'];
                                            $offerAmt = $row['offerAmt'];
                                            $couponDiscount = $row['couponDiscount'];
                                            if($offerAmt > 0){
                                                $totalAmount = $totalAmount - $offerAmt;
                                            }
                                            if($couponDiscount > 0){
                                                $totalAmount = $totalAmount - $couponDiscount;
                                            }
                                            if($totalAmount < 0){
                                                $totalAmount = 0;
                                            }
                                            // $k++;
                                            //  $processStatus = '';
                                            // if(($row['orderStatus'] =='Cancel') && (strtotime($row['dateTime']) < (time()-14400))){
                                            //     $processStatus = 'Cancel';
                                            // }
                                            // if( ($row['orderStatus']=='Cancel') && ($processStatus != 'Cancel')){
                                            //     $row['orderStatus'] = 'Processing';
                                            // }

                                       
                                            $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$row['id']."' AND active='1'");

                                            // pre($records);
                                    ?>
                                    
                                        
                                        <div class="oblock">
                                            <div class="ob-head">
                                                <ul class="clearfix">
                                                    <li class="fleft"><h6>Order Placed</h6><p><?=stdDateFormat($row['dateTime'])?></p></li>
                                                    <li class="fleft"><h6>Total</h6><p>&dollar; <?=number_format($totalAmount,2)?></p></li>
                                                    <li class="fleft"><h6>Shipped To</h6><p><?=$row['fullName']?></p></li>
                                                    <li class="fleft"><?php if($row['invoiceNo'] !=''){ ?><h6>Order No:</h6><p>&nbsp; <?php echo $row['invoiceNo']; ?>  </p><?php }?></li>
                                                    <li class="fright clearfix">
                                                        <h6>Status: <span class="inv-onum"><?=$row['orderStatus']?></span></h6>
                                                        <p><a href="<?=APP_URL?>/invoice.php?id=<?=base64_encode($row['id'])?>" class="tlink btn-invoice" data-id="NjEyNQ==" target="_blank"s>View invoice</a></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ob-body">
                                                <ul>
                                                    <?foreach($records as $record){
                                                        $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$record['productOptionId']."'", true);
                                            $attrValueSet='';   
                                                foreach ($productAttrubutes as $productAttrubute) {
                                                    $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                                    if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                                                }
                                                        ?>
                                                        <li><p class="clearfix"><?=$record['productName']?><?php if($attrValueSet !=''){ echo '('.rtrim($attrValueSet,',').')'; } ?> <span>&dollar; <?=$record['unitPrice']?></span><span> <?=$record['quantity']?></span></p></li>
                                                    <?}?>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                     <?}}?>
                                </div>
                            </div>
                           
                        </div>

                        <!-- <div class="crtb-inner">
                            <div class="crtb-head">
                                <h4>Past Orders</h4>
                            </div>
                            <div class="crtb-body clearfix">
                                <div class="olist">
                                    
                                    <div class="obempty"><p>No orders found.</p></div>
                                    
                                    
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
                <!-- Data -->

            </section>

        </div>

    </div>
</div>
</section>
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
