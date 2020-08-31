<?php 
include_once('actionHandler.php');
include ('includes/header.php');
// pre($oauth->authUser());
if($oauth->authUser()){
    header('Location:'.APP_URL.'/myaccount.php');
    exit;
}
?>
            
<div class="inner-container">
    <div class="inner-wrap">

        <div class="cart-container">


            <section class="csect-row clearfix">

                <!--Social -->
                <div class="csect-block">
                    <div class="cart-box nsp">
                        <div class="crtb-head">
                            <h4>Forgot Password?</h4>
                        </div>
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
                        <div class="crtb-body">
                            <div class="log-section clearfix">
                                <!-- Social -->
                                <!-- <div class="log-block">
                                    <div class="log-wrap">
                                        <h6>Via social network</h6>
                                        <div class="log-social">
                                            <a href="login.php" class="trans fb"><i class="fa fa-facebook"></i>&nbsp; Continue with facebook</a>
                                            <a href="login.php" class="trans gp"><i class="fa fa-google-plus"></i>&nbsp; Continue with Google+</a>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- /Social -->

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
                   
                                <!-- Login -->
                                <div class="log-block">
                                    <div class="log-wrap">
                                        <!-- <h6><b>Forgot Password?</b></h6> -->
                                        <form id="form-login" name="form-login" class="validable" method="post">
                                           <input type="hidden" name="action" value="forgotpassword">
                                        <div class="formx">
                                            <div class="fip">
                                                <input type="email" name="email" required>
                                                <label class="fpl">Email</label>
                                                
                                            </div>
                                           
                                            <div class="fip sub">
                                                <p class="ferror login"></p>
                                            </div>
                                            <div class="fip sub">
                                                <button type="submit" name="login" id="login" class="btn block reg">Send Password to Email ID</button>
                                            </div>
                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Login -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--Social -->

            </section>

        </div>

    </div>
</div>

<div class="modal small" id="forgot-modal">
    <div class="modal-inner">
        <div class="modal-head">
            <a href="javascript:void(0);" class="cross trans modal-close">&times;</a>
            <h4>forgot Password?</h4>
        </div>
        <div class="modal-body" id="forgot-form">
            <div class="modal-form clearfix">
                <form id="form-forgot" name="form-forgot" class="validable" method="post">
                <div class="formx">
                    <div class="fip center">
                        <p>Please validate your email address</p>
                    </div>
                    <div class="fip">
                        <input type="text" id="forgot_email" name="forgot_email" class="trans validate[required, custom[email]] reqfield" value="">
                        <label class="fpl">Email ID</label>
                    </div>
                    <div class="fip sub">
                        <p class="ferror forgot"></p>
                    </div>
                    <div class="fip sub fsub">
                        <button type="submit" class="btn sbtn block" id="forgot">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


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
