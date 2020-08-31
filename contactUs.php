<?php 
include('includes/header.inc.php');
require 'captcha/rand.php';
 $_SESSION['captcha_id'] = $str;
include ('includes/header.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['post']=$_POST;
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->From = 'noreply@beauty-mineral.in';
        $mail->FromName = 'Desi Temple Hair';
        $mail->AddAddress('pradeep@evol.co.in'); // you can add any no of address
        $mail->AddBCC('santhosh@evol.co.in'); // you can add any no of address
        $mail->Subject = 'Desi temple hair - Enquiry through website';
        $message='Hi, <br/><br/> Client enquiry:<br/><br/>
                  <b>Name</b>:'.$_POST['name'].'<br/>
                  <b>Email.</b>:'.$_POST['email'].'<br/>
                  <b>Contact No.</b>:'.$_POST['phone'].'<br/>
                  <b>Message</b>:'.$_POST['message'].'<br/><br/>
                  Regards,<br/>'.$_POST['name'];
        $mail->Body     =$message;
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
        $mail->Send();
        
        $_SESSION['success_message']='Thanks for your enquiry. A Desi Temple Hair representative will get in touch with you soon!';
        unset($_SESSION['post']);
        // header('Location:index.php#contact');
        // exit;   
    }

?>

<section class="ourtopsellers skincare">
<div class="inner-container topsellers">
    <div class="data-container">
        <div class="data-head"><h1>Contact Us</h1></div>
        
        <div class="contact-container">
            <div class="contact-left">
                <div class="contact-data">
                    <h6>Address</h6>
                    <p>
                       
                    </p>

                </div>
            </div>
            <div class="contact-right">
                 <?php
                if(isset($_SESSION['error_message'])) {
                        echo '<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FFFFFF; background:#FF0000; padding:0 0 0 28px; margin:0;" >'.$_SESSION['error_message'].'</p>';
                        unset($_SESSION['error_message']);
                    }
                    
                if(isset($_SESSION['success_message'])) {
                        echo '<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#00681C;font-weight:bold; padding:0 0 0 28px; margin:0;" >'.$_SESSION['success_message'].'</p>';
                        unset($_SESSION['success_message']);
                    }
            ?>
                <form action="" id="contactForm" method="post" class="contactus">
                <!-- <input type="hidden" name="email_title" value="Contact Us Alert"> -->
                <div class="formx">
                    <div class="fip">
                        <input type="text" id="name" name="name" value="">
                        <label class="fpl">Full Name</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="email" name="email" value="">
                        <label class="fpl">Email Id</label>
                    </div>
                    <div class="fip">
                        <input type="text" id="phone" name="phone" value="">
                        <label class="fpl">Mobile No.</label>
                    </div>
                    <!-- <div class="fip">
                        <input type="text" id="subject" name="subject" value="">
                        <label class="fpl">Subject</label>
                    </div> -->
                    <div class="fip">
                        <textarea id="message" name="message"></textarea>
                        <label class="fpl">Write your comment</label>
                    </div>
                    <!-- <div class="fip sub">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    </div> -->
                    <div class="security form-group">
                                    <!-- <p>Please verify that your human</p> -->
                        <label class="g-form-row-label-h" for="message">Please verify that your human</label>
                        <div class="securityinput">
                            <div id="captchaimage"><img src="captcha/images/image.php?<?php echo time(); ?>" style="float:left;margin-bottom:15px;" width="120" height="36"></div>
                          <div class="refresh">
                                <input type="text" class="form-control" maxlength="6" name="captcha" id="captcha" placeholder="Enter Code">
                            </div> 
                        </div>
                        <span id='captchaError'></span>
                      <div style="clear:both;width:100%;"></div>
                    </div>
                    <div class="fip sub">
                        <button class="btn block reg" type="submit" name="sub" id="sub" value="Submit">Submit</button>
                    </div>
                    <div class="fip sub">
                        <p class="ferror login"></p>
                    </div>
                </div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
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
