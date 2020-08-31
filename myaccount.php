<?php
    include_once('actionHandler.php');
    include ('includes/header.php');
    if(!$oauth->authUser()){
    header('Location:'.APP_URL.'/login.php');
    exit;
    }
   // pre($_SESSION);
    if(isset($_SESSION['nextUrl']) && $_SESSION['nextUrl']!=''){
        $nextUrl = base64_decode($_SESSION['nextUrl']);
        unset($_SESSION['nextUrl']);
        header('Location:'.APP_URL.'/'.$nextUrl);
    }
   
    $userDetails = $oauth->getUserDetails();
   // pre($userDetails);
?>
            
<style type="text/css">
    .cf-list li:nth-child(3n+1){ clear:left;}
    @media(max-width:640px){
        .cf-list li:nth-child(3n+1){ clear:none;}
        .cf-list li:nth-child(2n+1){ clear:left;}
    }
</style>
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
                                    
                                </div>
                                <div class="user-action">
                                    <a href="myaccount.php" class="tlink active"><span class="fa fa-user"></span>Account Info</a>
                                    <a href="myorders.php" class="tlink"><span class="fa fa-bars"></span>My Orders</a>
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
                        <div class="crtb-inner acc bpad">
                            <div class="crtb-head">
                                <h4>General Info</h4>
                            </div>
                            <div class="crtb-body clearfix">
                                <form name="form-info" id="form-info" method="post" class="validable">
                                <input type="hidden" name="action" value="updateUserDetails">
                                <input type="hidden" name="regid" value="<?=$userDetails->id?>">
                                <div class="ginfo-block full clearfix">
                                    <div class="formx">
                                        <div class="fip">
                                            <input type="text" id="fullName" name="fullName" required value="<?=$userDetails->fullName?>">
                                            <div class="fpl">Name</div>
                                        </div>
                                        <!-- <div class="fip">
                                            <input type="text" id="last_name" name="last_name" value="" class="trans reqfield validate[required]">
                                            <div class="fpl">Last Name</div>
                                        </div> -->
                                        <div class="fip">
                                            <input type="text" id="email" name="email" readonly value="<?=$userDetails->email?>">
                                            <div class="fpl">Email Id</div>
                                        </div>
                                        
                                        <div class="fip">
                                            <input type="text" id="mobileNumber" name="mobileNumber" required value="<?=$userDetails->mobileNumber?>">
                                            <div class="fpl">Mobile No</div>
                                        </div>
                                       <!--  <div class="fip">
                                            <input type="text" id="dob" name="dob" value="" class="trans reqfield validate[required]" placeholder="DD-MM-YYYY">
                                            <div class="fpl show">Date of Birth</div>
                                        </div> -->
                                       <!--  <div class="fip">
                                            <div class="combo">
                                                <select name="gender" id="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">female</option>
                                                </select>
                                            </div>
                                            <script>
                                                if(''!='')
                                                    $("#gender").val('');
                                            </script>
                                            <div class="fpl show">Gender</div>
                                        </div> -->
                                        <div class="fip full"  >
                                            <p class="ferror login" id="info_msg"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ginfo-block full">
                                    <button type="submit" name="change_info" id="change_info" class="btn reg mini sqr">Save Changes</button>
                                </div>
                                </form>
                            </div>
                        </div>

                        <? if(isset($_SESSION['error_message1'])) { ?>
                            <br/><div class="alert alert-danger">
                            <?=$_SESSION['error_message1']?>
                            </div>
                        <?  unset($_SESSION['error_message1']);
                        } ?>

                        <? if(isset($_SESSION['success_message1'])) { ?>
                            <br/><div class="alert alert-success">
                            <?=$_SESSION['success_message1']?>
                            </div>
                        <?  unset($_SESSION['success_message1']);
                        } ?>
                        
                        <div class="crtb-inner acc bpad">
                            <div class="crtb-head">
                                <h4>Change Password</h4>
                            </div>
                            <div class="crtb-body clearfix">
                                <form name="form-pass" method="post" id="form-pass" class="validable">
                                    <input type="hidden" name="action" value="changepassword">
                                <div class="ginfo-block full">
                                    <div class="formx max">
                                        <div class="fip">
                                            <input type="password" name="oldpassword" required>
                                            <div class="fpl">Old Passowrd</div>
                                        </div>
                                        <div class="fip">
                                            <input type="password" name="newpassword" pattern=".{8,}" required title="8 characters minimum">
                                            <div class="fpl">New Passowrd</div>
                                        </div>
                                        <div class="fip">
                                            <input type="password" name="confirmpassword" pattern=".{8,}"   required title="8 characters minimum">
                                            <div class="fpl">Confirm New Passowrd</div>
                                        </div>
                                        <div class="fip">
                                            <p class="ferror login" id="password_msg"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ginfo-block full">
                                    <button type="submit" name="change_pass" id="change_pass" class="btn reg mini sqr">Save Changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Data -->

            </section>

        </div>

    </div>
</div>

<!-- Address -->
<div class="modal" id="modal-address">
    <div class="modal-inner">
        <div class="modal-head">
            <a href="javascript:void(0);" class="cross trans modal-close">&times;</a>
            <h4>Add new Address</h4>
        </div>
        <div class="modal-body" id="address-form">
            
        </div>
    </div>
</div>
</section>
<!-- /Address -->
<script type="text/javascript">
    $(document).ready(function(e){
        var datepicker = $('#dob').Zebra_DatePicker({ direction: false,format:'d-m-Y',offset:[-224,325]});
        $('#change_pass').click(function(e){
            if($('#form-pass').validationEngine('validate'))
            {
                var fd = new FormData();
                var other_data = $('#form-pass').serializeArray();
                $.each(other_data,function(key,input){
                    fd.append(input.name,input.value);
                });
                $.ajax({
                    type:'POST',
                    url: 'change_pass.php',
                    data:fd,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        if(data==1)
                        {
                            $("#password_msg").html("Updated Sucessfully");
                            $('#form-pass')[0].reset();
                        }
                        else if(data==3)
                            $("#password_msg").html("Wrong Old Password");
                        else if(data==0)
                            $("#password_msg").html("Error in Changing password please try again");
                    }});
            }
            
        });
        $('#change_info').click(function(e){
            $.post("update_info.php",{
                first_name:$('#first_name').val(),
                last_name:$('#last_name').val(),
                email:$('#email').val(),
                city:$('#city').val(),
                dob:$('#dob').val(),
                gender:$('#gender').val(),
            },function(data){
                if(data==1)
                    $("#info_msg").text("Updated Successfully");
                else
                    $("#info_msg").text("Error");
            });
            
        });
        $('body').on('click','.btn-addnew',function(e){
            var that = $(this);
            $('#flag').val(that.data('type'));
            var modal = $('#modal-address');
            var id=that.data('aid');
            var type=that.data('type');
            $('#address-form').load('update_address.php',{id:id,type:type},function(data){
                placeModal(modal);
                showModal(modal);
            });
        });
        $('body').on("change","#states",function(e){
            $('.city').load("get_city.php",{state:$(this).val()});
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
