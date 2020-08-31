<?php 
include('includes/header.inc.php');
include ('includes/header.php');
// $productsOurCollection = $db->get_results("SELECT * FROM ".PRODUCTS." WHERE productType='ourCollection' AND active='1' ORDER BY product_orders LIMIT 9");
$productsOurTopSellers = $db->get_results("SELECT * FROM ".PRODUCTS." WHERE active='1' ORDER BY product_orders ASC LIMIT 6");
// $productsSkinCarebundles = $db->get_results("SELECT * FROM ".PRODUCTS." WHERE productType='skinCarebundles' AND active='1' ORDER BY product_orders LIMIT 9");

?>
<!-- Slider -->
<section class="bslider home-page" id="hscon">
  
<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- <ol class="carousel-indicators indication">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol> -->
        <div class="carousel-inner topimage" role="listbox">
            <div class="item active">
                <a href="#">
                    <img src="images/slides/templehairslide.png" alt="Anti Aging" style="margin:0 auto;">
                </a>
            </div>
            <!-- <div class="item">
                <a href="http://www.beautymineral.in/categoryProducts.php?categoryId=MQ==">
                    <img src="images/slides/slide2.png" alt="Face care" style="margin:0 auto;">
                </a>
            </div>
             <div class="item">
                <a href="http://www.beautymineral.in/subCatProducts.php?categoryId=NQ==">
                    <img src="images/slides/slide3.png" alt="Nature Balance" style="margin:0 auto;">
                </a>
            </div>
            <div class="item">
                <a href="http://www.beautymineral.in/subCatProducts.php?categoryId=Nw==">
                    <img src="images/slides/slide4.png" alt="Masks" style="margin:0 auto;">
                </a>
            </div>
            <div class="item">
                <a href="http://www.beautymineral.in/subCatProducts.php?categoryId=OA==">
                    <img src="images/slides/slide5.png" alt="Cleansers" style="margin:0 auto;">
                </a>
            </div> -->
        </div>
       <!--  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a> -->
    </div>
</section>
<!-- /Slider -->

<!-- Featured -->


<section class="hblock anim-block ourtopsellers skincare">
    <div class="cantainer topsellers ">
        <h3 class="hb-head">Our Top Sellers</h3>
        <!-- <h6 class="sub-head">Priceless beauty from the Dead Sea, at an affordable price</h6> -->
    <div class="hb-inner fprod clearfix">

        <?foreach($productsOurTopSellers as $ourTopSellers){

            $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                  WHERE productId='".$ourTopSellers['id']."'", true);
            $productOptions = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$ourTopSellers['id']."' AND active='1' AND productStock>0", true);
            ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 productlist">
                <a href="detail.php?productId=<?=base64_encode($ourTopSellers['id'])?>" class="hoverable">
                    <div class="clearfix">
                    <div class="hovereffect clearfix" >
                        <!-- <img class="img-responsive" src="images/sample1.png" alt="Renewal Vitalizing Day Cream" title="Click here for more information" style="cursor: pointer;"> -->
                       <?if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                            <img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Click here for more information" style="cursor: pointer;" alt="Desi temple hair">
                        <? }else{ ?>
                            <img src="<?=PRODUCT_IMAGE_PATH?>/defaultbig.png"  title="Desi temple hair" alt="Desi temple hair">
                        <? } ?>
                    </div>
                    </div>
                    
                    <div class="clearfix caretext">
                        <div class="productname"><?=$ourTopSellers['productName']?></div><br>
                        <div class="productrate">&dollar; <?=$productOptions->productCost?></div>
                        <div class="hoverablebuy productbuy">Buy Now</div>
                    </div>
                </a>
               
            </div>
        <?}?>

       <!--  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="detail.php?productId=Ng==" class="hoverable">
                <div class="clearfix">
                <div class="hovereffect clearfix">
                    <img class="img-responsive" src="images/sample2.png" alt="Black Mud Soap" title="Click here for more information" style="cursor: pointer;">
                   
                </div>
                </div>
                
                <div class="clearfix caretext">
                    <div class="productname">Black Mud Soap</div><br>
                    <div class="productrate">Rs. 9</div>
                    <div class="hoverablebuy productbuy">Buy Now</div>
                </div>
            </a>
        </div>-->

        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="detail.php?productId=Nw==" class="hoverable">
                <div class="clearfix">
                    <div class="hovereffect clearfix">
                        <img class="img-responsive" src="images/sample3.png" alt="Activating Intensive Anti Aging Cream" title="Click here for more information" style="cursor: pointer;">
                       
                    </div>
                </div>
                    

                <div class="clearfix caretext">
                    <div class="productname">Activating Intensive Anti Aging Cream</div><br>
                    <div class="productrate">Rs. 55</div>
                    <div class="hoverablebuy productbuy">Buy Now</div>
                </div>
            </a>
        </div> -->

    </div>
    </div> 
</section>

<!-- <section class="hblock anim-block skincare">

    <div class="cantainer skincarebundles">
        <h3 class="hb-head">Skin Care bundles</h3>
         <div class="hb-inner fprod clearfix">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="detail.php?productId=OA==" class="hoverable">
                <div class="clearfix">
                <div class="hovereffect clearfix" >
                    <img class="img-responsive" src="images/bodycareB.png" alt="Body Care bundle" title="Click here for more information" style="cursor: pointer;">
                </div>
                </div>
                
                <div class="clearfix caretext">
                    <div class="productname">Body Care bundle</div><br>
                    <div class="productrate">Rs. 104</div>
                    <div class="hoverablebuy productbuy">Buy Now</div>
                </div>
            </a>
           
        </div>

       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="detail.php?productId=OQ==" class="hoverable">
                <div class="clearfix">
                <div class="hovereffect clearfix" >
                    <img class="img-responsive" src="images/facialcareB.png" alt="Facial bundle" title="Click here for more information" style="cursor: pointer;">
                </div>
                </div>
                
                <div class="clearfix caretext">
                    <div class="productname">Facial bundle</div><br>
                    <div class="productrate">Rs. 198</div>
                    <div class="hoverablebuy productbuy">Buy Now</div>
                </div>
            </a>
           
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="detail.php?productId=MTA=" class="hoverable">
                <div class="clearfix">
                <div class="hovereffect clearfix" >
                    <img class="img-responsive" src="images/antiaging.png" alt="Renewal Vitalizing Day Cream" title="Click here for more information" style="cursor: pointer;">
                </div>
                </div>
                
                <div class="clearfix caretext">
                    <div class="productname">Renewal Vitalizing Day Cream</div><br>
                    <div class="productrate">Rs. 10</div>
                    <div class="hoverablebuy productbuy">Buy Now</div>
                </div>
            </a>
           
        </div>
      
    </div>
</div>
</section> -->

<!-- Slider -->
<!-- <section class="testimonial">
   
    <h3 class="client">Testimonials</h3>

   
<div id="myCarousel1" class="carousel slide testislide" data-ride="carousel">
      
        <div class="carousel-inner" role="listbox">
            <div class="item active tesimonialItem">
                
                <div class="t-box">
                        <div class="t-image">
                            <span class="author-info">
                                
                                <p>Recently I received my shipment containing exfoliating Peeling body scrub And it was amazing! Leaving skin smooth and really not dried and peeling dead skin.For additional bonus and it smells really good !</p>
                                <p class="testiname"><b>Samantha Brown</b></p>
                            </span>
                        </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="item tesimonialItem">
                
                <div class="t-box">
                        <div class="t-image">
                            <span class="author-info">
                                
                                <p> Very nice aroma and lathers better than any other product I have used before. I have had many compliments on the aroma. Very good prices for Very good products!</p>
                                <p class="testiname"><b>Nisha</b></p>
                            </span>
                        </div>
                    <div class="clear"></div>
                </div>
            </div>

             <div class="item tesimonialItem">
                
                <div class="t-box">
                        <div class="t-image">
                            <span class="author-info">
                                
                                <p>All master professionals, high-quality interior materials. Thank you come again :)</p>
                                <p class="testiname"><b>Jody P</b></p>
                            </span>
                        </div>
                    <div class="clear"></div>
                </div>
            </div>
            
        </div>
        <a class="left carousel-control removebackground" href="#myCarousel1" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control removebackground" href="#myCarousel1" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section> -->
<!-- /Slider -->


    
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
