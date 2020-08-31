<?php 

    include('includes/header.inc.php');
    
    $db =  new DB();
    $products = new products();
    if(isset($_REQUEST['productId']) && $_REQUEST['productId']!=''){
        $productId = base64_decode($_REQUEST['productId']);
    }else{
        header('Location:'.APP_URL);
        exit;
    }
 
    include_once('actionHandler.php');
    include ('includes/header.php');

    $query = "SELECT id, productName,specialOffers,sku,offersDescription,productDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
                     WHERE id='".$productId."' AND  active='1' GROUP BY id ORDER BY productStock = 0 ASC";

    $productsData = $db->get_row($query, ture);
  
    $categoryData = $products->getCategoryDetailsById($productsData->categoryId);
    $productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$productsData->id."' AND active='1' AND productStock>0");

    $productImageData = $db->get_results("SELECT image FROM ".PRODUCT_IMAGES." 
                                                      WHERE productId='".$productsData->id."'", true);

    $productReviews = $db->get_results("SELECT * FROM ".REVIEW." 
                                                      WHERE product_id='".$productsData->id."' AND active='1'", true);

    $ingredientImageData = $db->get_results("SELECT * FROM ".INGREDIENTS." 
                                                      WHERE product_id='".$productsData->id."'", true);

    $outOfStock = 'no';
    
?>
            <!-- Title Bar -->
<section class="anim-block ourtopsellers skincare">
<div class="inner-container topsellers " >

    <div class="pickle-container" style="padding-right:0px;">
        <?//if($db->num_rows( $query ) > 0){?>
        <div class="pickle-wrapper">
            
            <!-- Banner -->
            <div class="pickle-banner vcenter col-md-7" >
                 <?if(!empty($productImageData)){?>
                  <div class="demo">
                        <div class="item">            
                            <div class="clearfix" >
                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                   
                                   
                                        <?foreach($productImageData as $productImage){?>
                                        
                                            <li data-thumb="<?=PRODUCT_IMAGE_PATH?>/<?=$productImage->image?>"> <img src="<?=PRODUCT_IMAGE_PATH?>/<?=$productImage->image?>"></li>
                                            
                                        <?}?>
                                    
                                   
                                </ul>
                            </div>
                        </div>
                       

                    </div>  
                    <?}else{?>
                         <img src="<?=PRODUCT_IMAGE_PATH?>/defaultbig.png"  title="Beauty-Mineral - Health & Beauty from the Dead Sea" alt="Beauty-Mineral - Health & Beauty from the Dead Sea">
                    <?}?>
             
            </div>
            <!-- /Banner -->
            <div class="col-md-5" style="padding-top:20px;">
                            <div class="pside-inner active" id="bnow" style="display:block;">
                                <form name="addcart" id="addcart">
                                    <div class="ps-block first">
                                        <h2><?=$productsData->productName?></h2>
                                        <h6 class="upper">Availability: <?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?> <b style="color:#74B436">In stock</b><?}else{?> <b style="color:#FF0000">Out of stock<?}?></b></h6>
                                        <!-- <p><?=$productsData->productName?></p> -->
                                         <div class="ps-block second">

                                                <div class="productAttributes">
                                                    <?php 
                                                        $products->getproductOptionAttributes($productId);
                                                     ?>
                                                </div>  

                                                <div id="productOptionDetails">
                                                    
                                                </div>
                                        </div>
                                        <p style="text-align:justify"><?= html_entity_decode($productsData->productDescription,ENT_COMPAT, 'UTF-8');?></p>
                                        
                                    </div>
                                    <div class="ps-block second">

                                    
                                    <?php /* 
                                        <div class="pqty-block">
                                            <div class="pqb-row clearfix">
                                                <div class="pqb-col fleft"><p class="pqbh">Weight</p></div>
                                                <div class="pqb-col fright"><p class="pqbh">Quantity </p></div>
                                                <div class="pqb-col center"><p class="pqbh">Amount</p></div>
                                            </div>
                                            <?php foreach($productOptions as $productOption){ ?>
                                                <div class="pqb-row clearfix">
                                                    
                                                    <input type="hidden" value="<?=$productOption['productWeight']?>" name="quantity[]" data-val="<?=$productOption['productWeight']?>">
                                                    <div class="pqb-col fleft"><p><?=$productOption['productWeight']?> <span class="gray"><?=$productOption['productUnit']?></span></p></div>
                                                    
                                                    <div class="pqb-col fright">
                                                        <div class="pb-spinner spinner clearfix">
                                                            <a href="javascript:void(0);" onclick="updateCartItemsData('<?=$productOption['id']?>', 'minus', '<?=$productOption['productCost']?>');" >-</a>
                                                            <input type="text" value="1" name="unit[]" readonly class="spin-txt" id="qty_<?=$productOption['id']?>">
                                                            <a href="javascript:void(0);" onclick="updateCartItemsData('<?=$productOption['id']?>', 'plus', '<?=$productOption['productCost']?>');" >+</a>
                                                        </div>
                                                    </div>
                                                    <div class="pqb-col center">
                                                        <p><span class="gray">Rs </span> <?=$productOption['productCost']?> <!-- <span class="pqb-amt" id="cost_<?=$productOption['id']?>">0</span> --><input type="hidden" data-id="<?=$productOption['id']?>" class="total_amt" name="amount" id="amt_<?=$productOption['id']?>"></p>
                                                    </div>
                                                </div>
                                            <?}?>
                                        </div>
                                         */ ?>
                                    </div>
                                    <?php /*
                                    <div class="ps-block center">
                                       
                                        
                                        <button type="submit" name="addtocart" id="addtocart" onclick="addToCartItems('<?=$productsData->id?>')" class="btn bbox reg cart add_to_cart" >

                                            <span class="fleft add_to_cart">Rs. <strong id="totalAmount" class="trans"><?=$productOption['productCost']?></strong></span>
                                            <span class="fright add_to_cart" >Add to Cart</span>

                                        </button>
                                        
                                    </div>
                                     */ ?>
                                </form>
                            </div>
                            <!-- Info -->
                         
           </div>            

        </div>
        <?//}else{?>
            <?//echo 'Empty'?>
        <?//}?>
    </div>

<!-- <div class="container"> -->

    
            <button class="accordion" style="visibility: hidden;">Write Your Own Review <i class="fa fa-caret-down" aria-hidden="true"></i></button>
      

           
<!-- </div> -->
</div>
</section>
<script type="text/javascript">
    $(window).load(function(e){
        setTimeout(function(){ $('.pside-main').stick_in_parent({offset_top:84,recalc_every:1}); },300);
    });
    $(document).ready(function(e){
        if(!isMobile())
            $(".psimg").stick_in_parent();
		$('.pmg-toggle').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate:'.pm-gal', // the selector for gallery item
				type: 'image',
				gallery: {
				  enabled:true
				}
			});
		});
    });

    // var acc = document.getElementsByClassName("accordion");
    // var i;

    // for (i = 0; i < acc.length; i++) {
    //   acc[i].onclick = function() {
    //     this.classList.toggle("active");
    //     var panel = this.nextElementSibling;
    //     if (panel.style.maxHeight){
    //      panel.style.maxHeight = null;
    //     } else {
    //      panel.style.maxHeight = panel.scrollHeight + "px";
    //     } 
    //   }
    // }
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
