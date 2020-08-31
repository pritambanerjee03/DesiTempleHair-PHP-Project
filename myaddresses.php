<?php include ('includes/header.php');

    $db = new DB();
    $sqlshipping = "SELECT * FROM ".USER_ADDRESSES." WHERE userId='".$_SESSION['regId']."' AND type='shipping' ";
    $shippingRecords = $db->get_results($sqlshipping);

    $sqlbilling = "SELECT * FROM ".USER_ADDRESSES." WHERE userId='".$_SESSION['regId']."' AND type='billing' ";
    $billingRecords = $db->get_results($sqlbilling);
// pre($shippingRecords);
    if(!$oauth->authUser()){
        header('Location:'.APP_URL);
        exit;
    }
?>          
<section class="ourtopsellers skincare">
<div class="inner-container topsellers gray">
    <div class="inner-wrap">

        <div class="cart-container">

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
                                    <a href="myorders.php" class="tlink"><span class="fa fa-bars"></span>My Orders</a>
                                    <a href="myaddresses.php" class="tlink active"><span class="fa fa-map-marker"></span>My Addresses</a>
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
                        <!-- Shipping -->
                        <div class="crtb-inner  bpad">
                            <div class="crtb-head add clearfix">
                                <h4 class="fleft">Shipping Details</h4>
                                <!-- <button type="button" class="btn reg sqr mini btn-addnew fright" data-type="shipping" data-id="">Add new Address</button> -->
                            </div>
                            <?if(!empty($shippingRecords)){?>
                            <div class="crtb-body clearfix">
                                <div class="addr-block compact">
                                    <ul class="ad-list clearfix shipping">
                                        
                                     <?foreach($shippingRecords as $shipping){?>    
                                        <li>
                                            <a href="javascript:void(0);" onclick="window.location.href='<?=APP_URL?>/editShippingAddress.php?shippingId=<?=base64_encode($shipping['id'])?>'" style="text-decoration:none;" class="ad-box stat trans btn-addnew" data-type="shipping" data-aid="9569">
                                               <p><?=$shipping['first_name']?> <?=$shipping['last_name']?></p>
                                                <p><?=$shipping['address_1']?></p>
                                                <p><?=$shipping['address_2']?></p>
                                                <!-- <p>Oberoi International School</p> -->
                                                <p><?=$shipping['landmark']?></p>
                                                <p><?=$shipping['city']?> - <?=$shipping['pincode']?></p>
                                                <p><?=$shipping['state']?>, <?=$shipping['country']?></p>
                                                <p><?=$shipping['phone']?></p>
                                                <h5>Edit</h5>
                                            </a>
                                            <a href="javascript:void(0);" onclick="removeShippingAddress('<?=$shipping['id']?>')" class="ad-remove" data-aid="<?=$shipping['id']?>">Remove</a>
                                        </li>
                                     <?}?>     
                                      <!--   <li>
                                            <a href="javascript:void(0);" class="ad-box stat trans btn-addnew" data-type="shipping" data-aid="10897">
                                                <p>gfdgfd fdgdfg</p>
                                                <p>fdgdf</p>
                                                <p>fdgfd</p>
                                                <p>dfg</p>
                                                <p>Port Blair - 435435</p>
                                                <p>Andaman and Nicobar Islands, India</p>
                                                <p>9876543210</p>
                                                <h5>Edit</h5>
                                            </a>
                                            <a href="javascript:void(0);" class="ad-remove" data-aid="10897">Remove</a>
                                        </li> -->
                                        
                                    </ul>
                                    
                                </div>
                            </div>
                            <?}else{?>
                                <div class="addr-block">
                                        <p>No address found.</p>
                                    </div>
                            <?}?>
                        </div>
                        <!-- /Shipping -->
                        <!-- Billing -->
                        <div class="crtb-inner bpad">
                            <div class="crtb-head add clearfix">
                                <h4 class="fleft">Billing Details</h4>
                                <!-- <button type="button" class="btn reg sqr mini btn-addnew fright" data-type="billing" data-id="">Add new Address</button> -->
                            </div>
                            <?if(!empty($billingRecords)){?>
                            <div class="crtb-body clearfix">
                                <div class="addr-block compact">
                                    <ul class="ad-list clearfix billing">
                                        
                                    <?foreach($billingRecords as $billing){?>    
                                        <li>
                                            <a href="javascript:void(0);" onclick="window.location.href='<?=APP_URL?>/editBillingAddress.php?billingId=<?=base64_encode($billing['id'])?>'" style="text-decoration:none;" class="ad-box stat trans btn-addnew" data-type="billing" data-aid="10781">
                                                <p><?=$billing['first_name']?> <?=$billing['last_name']?></p>
                                                <p><?=$billing['address_1']?></p>
                                                <p><?=$billing['address_2']?></p>
                                                <p><?=$billing['landmark']?></p>
                                                <p><?=$billing['city']?> - <?=$billing['pincode']?></p>
                                                <p><?=$billing['state']?>, <?=$billing['country']?></p>
                                                <p><?=$billing['phone']?></p>
                                                <h5>Edit</h5>
                                            </a>
                                            <a href="javascript:void(0);" onclick="removeBillingAddress('<?=$billing['id']?>')" class="ad-remove" data-aid="<?=$billing['id']?>">Remove</a>
                                        </li>
                                    <?}?>   
                                    </ul>
                                    
                                </div>
                            </div>
                            <?}else{?>
                                 <div class="addr-block">
                                        <p>No address found.</p>
                                    </div>
                            <?}?>
                        </div>
                        <!-- /Billing -->
                    </div>
                </div>
                <!-- Data -->

            </section>

        </div>

    </div>
</div>
</section>
<!-- Address -->
<!-- <div class="modal" id="modal-address">
    <div class="modal-inner">
        <div class="modal-head">
            <a href="javascript:void(0);" class="cross trans modal-close">&times;</a>
            <h4>Add new Address</h4>
        </div>
        <div class="modal-body" id="address-form">
            
        </div>
    </div>
</div> -->
<!-- /Address -->
<script type="text/javascript">
    $(document).ready(function(e){
        $('body').on('click','.btn-addnew',function(e){
            var that = $(this);
            $('#flag').val(that.data('type'));
            var modal = $('#modal-address');
            var id=that.data('aid');
            var type=that.data('type');
            $('#address-form').load('update_address.php',{id:id,type:type},function(data){
                placeModal(modal);
                showModal(modal);
                checkValue();
                $('#form-add-new').validationEngine({focusFirstField:false,scroll:false,maxErrorsPerField:1,showArrow:false});
                bindMoves();
            });
        });
        $('body').on("change","#states",function(e){
            $('.city').load("get_city.php",{state:$(this).val()});
        });
        $('body').on("click",".ad-remove",function(e){
            var that=$(this);
            $.post("removeadd.php",{aid:$(this).data("aid")},function(data){
                that.closest("li").remove();
            });
        });
        
        $('body').on("click","#bnadd",function(e){
            var valid = $('#form-add-new').validationEngine('validate');
            if(valid){
                var fd = new FormData();
                var other_data = $('form').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                fd.append('sub',$('#sub').val());
                fd.append('page','myaccount');
                var flag=$("#flag").val();
                var aid=$("#aid").val();

                $('#bnadd').attr('disabled','disabled').text('Processing...');
                $.ajax({
                    type:'POST',
                    url: 'add_address.php',
                    data:fd,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        $('#bnadd').text('Saved successfully!');
                        setTimeout(function(){
                            hideModal($('#modal-address'));
                            setTimeout(function(){
                                $('#form-add-new')[0].reset();
                                $('#bnadd').removeAttr('disabled').text('Save Address');
                            },600);
                            if(aid!='')
                            {
                                $(".ad-box[data-aid='"+aid+"']").closest('li').replaceWith(data);
                                /*if(flag=="billing")
                                    $(".ad-box[data-aid='"+aid+"']").closest('li').html(data);
                                else if(flag=="shipping")
                                    $("ul.shipping").append(data);*/
                            }
                            else{
                                if(flag=="billing"){
                                    if($('.empty.billing').size()>0)
                                        $('.empty.billing').remove();
                                    $("ul.billing").append(data);
                                }
                                else if(flag=="shipping"){
                                    if($('.empty.shipping').size()>0)
                                        $('.empty.shipping').remove();
                                    $("ul.shipping").append(data);
                                }
                            }
                        },300);
                    },
                    error: function(data){
                    }
                });
            }
        });
        
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
