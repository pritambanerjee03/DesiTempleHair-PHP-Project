<?php include ('includes/header.php');?>

<section class="ourtopsellers skincare">
<div class="inner-container topsellers">
    <div class="inner-wrap">

        <div class="cart-container">

            <!-- Steps -->
            <div class="cart-steps">
                <ul class="clearfix">
                    <li class="active"><div class="cs-ico vcenter"><span class="fa fa-shopping-cart"></span></div><p>Cart</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-sign-in"></span></div><p>Login</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-map-marker"></span></div><p>Address</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-credit-card"></span></div><p>Payment</p></li>
                    <li><div class="cs-ico vcenter"><span class="fa fa-check"></span></div><p>Confirm</p></li>
                </ul>
            </div>
            <!-- /Steps -->
                <div class="mainCart">
                    <?php $cart->mainCartFlavors();?>
                </div>
        </div>

    </div>
</div>


</section>

<script type="text/javascript">
    $(document).ready(function(e){
        if(!isMobile())
            $("#sidebar").stick_in_parent({offset_top:30});
        
        var cart_array=[];
        $(".checkout").click(function(){
            var gift = $('#gift-check').is(":checked") ? 'gift' : '';
            var valid = $('#gift-check').is(":checked") ? $('#form-gift').validationEngine('validate') : true;
            if(valid){
                $('.cart_pro').each(function(){
                    var pid=$(this).find(".pid").val();
                    var pquantity=$(this).find(".pqb-size").val();
                    var piamt = getIngdAmt($(this).find('.size'));
                    var ingd_num = $(this).find(".ingd_num").val();
                    var ingredients = $(this).find(".ing").val();
                    var units = $(this).find(".spin-txt").val();
                    cart_array.push({pid:pid,pquantity:pquantity,ingd_num:ingd_num,punits:units,ingredients:ingredients});
                });
                $.post("cart.php",{cart:cart_array,to:$('#txt-to').val(),message:$('#txt-message').val(),from:$('#txt-from').val(),gift:gift},function(data){
                    if(data>0)
                        location.href="checkout/";
                    else
                        location.href="cart-login/";
                });
            }
        });
        
        function getIngdAmt(that){
            var result;
            var qname = that.find('option:selected').text();
            if(qname=='3 Kgs')
                result=40;
            else if(qname=='2 Kgs')
                result=25;
            else if(qname=='1 Kgs')
                result=15;
            else
                result=10;
            return result;
        }
        
        /*$('.btn-gift').click(function(e){
            $('#form-gift').validationEngine('validate');
        });*/
        
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
