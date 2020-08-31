<?php 
include('includes/header.inc.php');
include ('includes/header.php');

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
        <div class="carousel-inner" role="listbox" style="margin-top:80px;">
           <div class="item active">
                <a href="subCatProducts.php?categoryId=NQ==">
                    <img src="images/slides/slide1.png" alt="Anti Aging" style="margin:0 auto;">
                </a>
            </div>
            <div class="item">
                <a href="subCatProducts.php?categoryId=NA==">
                    <img src="images/slides/slide2.png" alt="Face care" style="margin:0 auto;">
                </a>
            </div>
             <div class="item">
                <a href="natureBalance.php">
                    <img src="images/slides/slide3.png" alt="Nature Balance" style="margin:0 auto;">
                </a>
            </div>
            <div class="item">
                <a href="subCatProducts.php?categoryId=Nw==">
                    <img src="images/slides/slide4.png" alt="Masks" style="margin:0 auto;">
                </a>
            </div>
            <div class="item">
                <a href="subCatProducts.php?categoryId=OA==">
                    <img src="images/slides/slide5.png" alt="Cleansers" style="margin:0 auto;">
                </a>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- /Slider -->

<section class="hblock anim-block skincare">

    

    <div class="cantainer skincarebundles">
        <h3 class="hb-head">Nature balance</h3>
        <div class="hb-inner fprod clearfix">
            
                <?php $products->getNaturalBalanceProduct(); ?>
            
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
