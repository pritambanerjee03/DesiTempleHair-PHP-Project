<?php
class products{
	var $userId;
	
	function products()
	{
		
	}

	function subCategoryMenu(){
		$subCategories = $this->getSubCategoriesByParentId($_POST['categoryId']);
		// pre($subCategories);
		$totalList = count($subCategories);
		$i=0;
		?>
		<div class="td-main bpad clearfix" id="t_<?=$_POST['categoryId']?>">
               <?php foreach ($subCategories as $subCategory) {?>
               <?php if($i%3==0){ ?>
                <div class="td-block">
                    <ul>  
                <?php } ?>                        
                        <li><a href="categoryProducts.php?categoryId=<?=base64_encode($subCategory['id'])?>" class="tlink"><?=$subCategory['categoryName']?></a></li>
               	<?php if( ($i%3==2) ||($totalList == ($i+1)) ) { ?>
                    </ul>
                </div>
                <?php } ?> 
                <?php $i++; } ?>
          </div>
       <?
	}

	function categoryMenu(){

		$parentCategories = $this->getMainCategories();

		?>
		<?php 
		
			foreach ($parentCategories as $parentCategory) {

			$subCategories = $this->getSubCategoriesByParentId($parentCategory['id']);
		?>
			<? if(count($subCategories)>0){ ?>
 			<li class="dropdown">

              <a href="#"  class="dropdown-toggle" data-toggle="dropdown" onclick="window.location.href='categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>'"><?=$parentCategory['categoryName']?><b class="caret"></b></a>
              <? if(count($subCategories)>0){ ?>
              <ul class="dropdown-menu">

              	<?php foreach($subCategories as $subCategory){ ?>
                <li><a href="subCatProducts.php?categoryId=<?=base64_encode($subCategory['id'])?>"><?=$subCategory['categoryName']?></a></li>
               <!--  <li><a href="#">Anti Aging</a></li>
                <li><a href="#">Eye Care</a></li>
                <li><a href="#">Masks</a></li>
                <li><a href="#">Cleansers</a></li> -->
                <?php }?>
                
              </ul>
              <?php }?>
            </li>
            <?}else{?>

            <li><a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>"><?=$parentCategory['categoryName']?></a></li>
            <!-- <li><a href="#">Men's Care</a></li> -->
           <?php }}?>
		<?

	}


	function categoryMenu147(){ 

		$parentCategories = $this->getMainCategories();

		?>

		<ul id="v-nav">


		<?php 
		$m=1;
		foreach ($parentCategories as $parentCategory) {

			  $subCategories = $this->getSubCategoriesByParentId($parentCategory['id']);
		 ?>
		<li class="level0 nav-<?=$m?> first level-top parent">
			<a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>" class="level-top">
				<span><?=$parentCategory['categoryName']?></span>
			</a> 
			<? if(count($subCategories)>0){ 
				?>
			<? if(isset($parentCategory['categoryImg']) && $parentCategory['categoryImg']!=''){?>
				
					<ul class="level0 vcol-2 img-right dropdownbg" style="background-image: url('<?=CATEGORY_THUMBNAIL_PATH?>/<?=$parentCategory["categoryImg"]?>') !important;">
				<?php
					}else{ ?>
					<ul class="level0 vcol-2 img-right dropdownbg" >
					<?php
						
					}
				 ?>
				 
			
				<h2 class="dropdowntitle"><a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>"><?=$parentCategory['categoryName']?></a></h2>
				<ul class="v-nav-left">
					<li class="level1 nav-<?=$m?>-0 first"><a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>"><span>All</span></a> </li>
					<?php 
						$sm=1;
					foreach($subCategories as $subCategory){ ?>
							<li class="level1 nav-<?=$m?>-<?=$sm?> first"><a href="subCatProducts.php?categoryId=<?=base64_encode($subCategory['id'])?>"><span><?=$subCategory['categoryName']?></span></a> </li>
						<? $sm++;
					} ?>
					
				</ul>
				<ul class="v-nav-right"></ul>
			</ul>
		
			<? } ?> 
		</li>
		<? $m++;
	} ?>

		<!-- <li class="level0 nav-10 last level-top parent">
			<a class="level-top" href="#"><span>VIEW COMPLETE SHOP </span></a> 
		</li> -->
		</ul>
									
		<?
	}


	
	function categoryMobileMenu(){

		$parentCategories = $this->getMainCategories();

		?>

		<div class="accordion_one mobshop col-md-12">
		    <h2 class="adelfox_heading">Shop By Category</h2>
		    <?php $i = 1; 
		    foreach ($parentCategories as $parentCategory) {

						  $subCategories = $this->getSubCategoriesByParentId($parentCategory['id']);
					 ?>
		    <div class="panel-group" id="accordion<?=$i?>">
		        <div class="panel panel-default">
		        	<?php if(count($subCategories) <= 0){ ?>
		        	<div class="panel-heading">
		                <h4 class="panel-title">
		                    <a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>" >
		                        <img width="25" src="<?=CATEGORY_THUMBNAIL_PATH?>/<?=$parentCategory['categoryImageIcon']?>"> <?=$parentCategory['categoryName']?> 
		                    </a>
		                </h4>
		            </div>
		        	<?php }else{ ?>
		            <div class="panel-heading">
		                <h4 class="panel-title">
		                    <a data-toggle="collapse" data-parent="#accordion<?=$i?>" href="#<?=$i?>_collapseOne">
		                        <img width="25" src="<?=CATEGORY_THUMBNAIL_PATH?>/<?=$parentCategory['categoryImageIcon']?>"> <?=$parentCategory['categoryName']?> <i class="fa fa-chevron-down pull-right"></i>
		                    </a>
		                </h4>
		            </div>
		            <div id="<?=$i?>_collapseOne" class="panel-collapse collapse subone">
		                <div class="accordion_two">
		                	
		                    <div class="panel-group" id="sub_accordion<?=$i?>">
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>" class="first">
		                                        View All <?=$parentCategory['categoryName']?>
		                                    </a>
		                                </h4>
		                            </div>
		                        </div>
		                        <?php foreach ($subCategories as $subCategory) {?>
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a href="subCatProducts.php?categoryId=<?=base64_encode($subCategory['id'])?>">
		                                        <?=$subCategory['categoryName']?> 
		                                    </a>
		                                </h4>
		                            </div>
		                            <!-- <div id="2_collapseOne" class="panel-collapse collapse">
		                                <div class="panel-body">
		                                    <ul class="subtwo">
		                                        <li><a href="#" class="first">View All Bread & Bakery</a></li>
		                                        <li><a href="#">Bread</a></li>
		                                        <li><a href="#">Cakes</a></li>
		                                    </ul>
		                                </div>
		                            </div> -->
		                        </div>
		                        <?php } ?>
		                        <!-- <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a data-toggle="collapse" data-parent="#accordion2" href="#">
		                                        Eggs
		                                    </a>
		                                </h4>
		                            </div>
		                        </div>
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a data-toggle="collapse" data-parent="#accordion2" href="#">
		                                        Fresh Foods & Meals
		                                    </a>
		                                </h4>
		                            </div>
		                        </div> -->
		                    </div>
		                   
		                </div>
		            </div>
		            <?php } ?>
		        </div>
		        
		    </div>
		    <?php $i++; } ?>
		</div>


		
									
		<?
	}

	function categoryTopbarMobileMenu(){

		$parentCategories = $this->getMainCategories();

		?>

		<div class="accordion_one mobshop ">
		    
		    <?php $i = 1; 
		    foreach ($parentCategories as $parentCategory) {

						  $subCategories = $this->getSubCategoriesByParentId($parentCategory['id']);
					 ?>
		    <div class="panel-group" id="topMenuaccordion<?=$i?>">
		        <div class="panel panel-default">
		        	<?php if(count($subCategories) <= 0){ ?>
		        	<div class="panel-heading">
		                <h4 class="panel-title">
		                    <a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>" >
		                        <img width="25" src="<?=CATEGORY_THUMBNAIL_PATH?>/<?=$parentCategory['categoryImageIcon']?>"> <?=$parentCategory['categoryName']?> 
		                    </a>
		                </h4>
		            </div>
		        	<?php }else{ ?>
		            <div class="panel-heading">
		                <h4 class="panel-title">
		                    <a data-toggle="collapse" data-parent="#topMenuaccordion<?=$i?>" href="#<?=$i?>_topMenucollapseOne">
		                        <img width="25" src="<?=CATEGORY_THUMBNAIL_PATH?>/<?=$parentCategory['categoryImageIcon']?>"> <?=$parentCategory['categoryName']?> <i class="fa fa-chevron-down pull-right"></i>
		                    </a>
		                </h4>
		            </div>
		            <div id="<?=$i?>_topMenucollapseOne" class="panel-collapse collapse subone">
		                <div class="accordion_two">
		                	
		                    <div class="panel-group" id="topMenusub_accordion<?=$i?>">
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>" class="first">
		                                        View All <?=$parentCategory['categoryName']?>
		                                    </a>
		                                </h4>
		                            </div>
		                        </div>
		                        <?php foreach ($subCategories as $subCategory) {?>
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a href="subCatProducts.php?categoryId=<?=base64_encode($subCategory['id'])?>">
		                                        <?=$subCategory['categoryName']?> 
		                                    </a>
		                                </h4>
		                            </div>
		                            <!-- <div id="2_collapseOne" class="panel-collapse collapse">
		                                <div class="panel-body">
		                                    <ul class="subtwo">
		                                        <li><a href="#" class="first">View All Bread & Bakery</a></li>
		                                        <li><a href="#">Bread</a></li>
		                                        <li><a href="#">Cakes</a></li>
		                                    </ul>
		                                </div>
		                            </div> -->
		                        </div>
		                        <?php } ?>
		                        <!-- <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a data-toggle="collapse" data-parent="#accordion2" href="#">
		                                        Eggs
		                                    </a>
		                                </h4>
		                            </div>
		                        </div>
		                        <div class="panel panel-default">
		                            <div class="panel-heading">
		                                <h4 class="panel-title">
		                                    <a data-toggle="collapse" data-parent="#accordion2" href="#">
		                                        Fresh Foods & Meals
		                                    </a>
		                                </h4>
		                            </div>
		                        </div> -->
		                    </div>
		                   
		                </div>
		            </div>
		            <?php } ?>
		        </div>
		        
		    </div>
		    <?php $i++; } ?>
		</div>


		
									
		<?
	}


	function categoryMenuInner(){ 

		$parentCategories = $this->getMainCategories();

		?>

		<ul id="v-nav" class="insidedropdown">


		<?php foreach ($parentCategories as $parentCategory) {

			  $subCategories = $this->getSubCategoriesByParentId($parentCategory['id']);
		 ?>
		<li class="level0 nav-<?=$m?> first level-top parent">
			<a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>" class="level-top">
				<span><?=$parentCategory['categoryName']?></span>
			</a> 
			<? if(count($subCategories)>0){ 
				?><? if(isset($parentCategory['categoryImg']) && $parentCategory['categoryImg']!=''){?>
				
					<ul class="level0 vcol-2 img-right dropdownbg" style="background-image: url('<?=CATEGORY_THUMBNAIL_PATH?>/<?=$parentCategory["categoryImg"]?>') !important;">
				<?php
					}else{ ?>
					<ul class="level0 vcol-2 img-right dropdownbg" >
					<?php
						
					}
				 ?>
				<h2 class="dropdowntitle"><a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>"><?=$parentCategory['categoryName']?></a></h2>
				<ul class="v-nav-left">
					<li class="level1 nav-<?=$m?>-0 first"><a href="categoryProducts.php?categoryId=<?=base64_encode($parentCategory['id'])?>"><span>All</span></a> </li>
					<?php 
						$sm=1;
					foreach($subCategories as $subCategory){ ?>
							<li class="level1 nav-<?=$m?>-<?=$sm?> first"><a href="subCatProducts.php?categoryId=<?=base64_encode($subCategory['id'])?>"><span><?=$subCategory['categoryName']?></span></a> </li>
						<? $sm++;
					} ?>
					
				</ul>
				<ul class="v-nav-right"></ul>
			</ul>
			<? } ?> 
		</li>
		<? $m++;
		 } ?>

		<!-- <li class="level0 nav-10 last level-top parent">
			<a class="level-top" href="#"><span>VIEW COMPLETE SHOP </span></a> 
		</li> -->
		</ul>
									
		<?
	}

	
    function getMainCategories(){
        $db = new DB();

        $query = "SELECT id, parentCategory, categoryName,categoryImg,categoryImageIcon FROM ".PRODUCT_CATEGORIES." WHERE parentCategory='0' AND active='1'";
        if($db->num_rows( $query ) > 0 ){
           return $db->get_results($query);
        }else{
           return false;
        }

    }

    function getSubCategoriesByParentId($parentCategoryId){

    	$records = array();

        $db = new DB();

        $query = "SELECT id, parentCategory, categoryName FROM ".PRODUCT_CATEGORIES." 
        		 WHERE parentCategory='".$parentCategoryId."' AND active='1' ORDER BY id ASC LIMIT 30";

        if($db->num_rows( $query ) > 0 ){
          $records = $db->get_results($query);
        }

        return $records;
    }

    function getProductsByCategory1114($categoryId){
        $db = new DB();

       	$records = array();

        $query = "SELECT id, productName FROM ".PRODUCTS." 
        		 WHERE categoryId='".$categoryId."' AND active='1'";

        if($db->num_rows( $query ) > 0 ){
          $records = $db->get_results($query);
        }

        return $records;

    }

    function getCategoryDetailsById($productId){
        $db = new DB();
        $records = array();

        $query = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$db->filter($productId)."' OR parentCategory = '".$db->filter($productId)."' ORDER BY id ='".$productId."' desc,id asc";
        
        if($db->num_rows($query) > 0 ){
           $records = $db->get_row($query, true);
        }

        return $records;

    }

    function getProductDetailsById($productId){
    	$db = new DB();
        $records = array();
        $query = "SELECT * FROM ".PRODUCTS." WHERE id='".$db->filter($productId)."'";        
        if($db->num_rows($query) > 0 ){
           $productData = $db->get_row($query, true);
            $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." WHERE productId='".$productData->id."'", true);
			$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$productData->id."' AND active='1' AND productStock>0");
			$outOfStock = 'no';
           ?>
           
            <div class="col-xs-12 col-sm-6 col-md-5">
				<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
				<a class="prodImgThumb" href="#" data-image-id="" data-toggle="modal" data-title="<?=$productData->productName?>" data-image="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>" data-target="">
					<img src="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$productData->productName?>" alt="Chitki - Grocery Shopping Mangalore">
				</a>
				<div class="smMobHide"><p class="prodImgThumbText">(Click photo to enlarge)</p></div>
				<? }else{ ?>
					<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
				<? } ?>
			</div>	
			<div class="col-xs-12 col-sm-6 col-md-7 productDetailsContent" id="productDetails" >
				<h2><?=$productData->productName?></h2>

				<? $defaultProductCost='';
								//if(isset($productOptions) && count($productOptions)>0){
					?>
							<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$productData->id?>" id="productOptionId_<?=$productData->id?>" value="<?=$productOption['id']?>" >
							
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							
								} ?>
							

							<div class="itemprice">

								<p class="chitkiPrice_<?=$productData->id?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
        								?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"> 
										<?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

								<!-- <p>&dollar; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
								<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
								<input type="hidden" name="productQty_<?=$productData->id?>" id="productQty_<?=$productData->id?>" value="1">
								<!-- <p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$productData->id?>" id="productQty_<?=$productData->id?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
								 -->
								 <p class="addbtn ">
								
									<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
										<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
										<!-- <div id="deliveryDatePopup" data-val="false"><span>*</span>&nbsp;Select date & time slot</div> -->
										<div class="clearfix"><div id="deliveryDatePopup" data-val="false"><span style="color:#ff0000;">*</span>&nbsp;Select date & Time slot <i class="fa fa-calendar fa-lg" aria-hidden="true"></i></div>
										<input type="hidden" id="timeslotVal">
										</div>
										<div class="clearfix">
											<button class="add-to-cart" id="<?=$productData->id?>" type="button" title="Add to Cart">Add To Cart &nbsp;&nbsp;<i><img src="images/addcart.png"></i></button>
										</div>	
									<?php }else{ ?>
										<div class="clearfix">
											<p class="prdDetailsOutofstock" >Out of Stock</p>
										
											<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$productData->id?>">Notify Me</button> </div>
										
										<div id="notifybox_<?=$productData->id?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$productData->id?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$productData->id?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
									<?php } ?>
								
								</p>
								
								<div style="clear:both;width:100%;"></div>
							</div>
							<div class="productDescription">
								<p><?=nl2br($productData->productDescription);?></p>
							</div>
						</div>
						<div style="clear:both;width:100%;"></div>

			</div>

			
           <?php
        }        
    }


    function getProductsByCategory($categoryId, $all){

    	$db = new DB();
        $records = array();

    	if($all=='all'){

			$subCategories = $this->getSubCategoriesByParentId($categoryId);
			// pre($subCategories);
			$sqlStr = "categoryId='".$categoryId."'";
			foreach ($subCategories as $subCategory) {
				$sqlStr.= " || categoryId='".$subCategory['id']."' ";
			}

			$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
    		WHERE (".$sqlStr.") ".$sqlLastid." AND  active='1' GROUP BY id ORDER BY productStock = 0 ASC,product_orders ASC";

		}else{

			$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
		 	WHERE categoryId='".$categoryId."' ".$sqlLastid." AND active='1' ORDER BY productStock = 0 ASC,product_orders ASC";
		}

		if($db->num_rows( $query ) > 0 ){
		   
		   	$records = $db->get_results($query);

			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0", true);

				//pre($productOptions)
				$outOfStock = 'no';

		?>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 productlist">
		            <a href="detail.php?productId=<?=base64_encode($record['id'])?>" class="hoverable">
		                <div class="clearfix">
		                <div class="hovereffect clearfix" >
		                    <?if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                <img src="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>"  title="Click here for more information" style="cursor: pointer;" alt="Desi temple hair">
                            <? }else{ ?>
                                <img src="<?=PRODUCT_IMAGE_PATH?>/defaultbig.png"  title="Desi temple hair" alt="Desi temple hair">
                            <? } ?>
		                </div>
		                </div>
		                
		                <div class="clearfix caretext">
		                    <div class="productname"><?=$record['productName']?></div><br>
		                    <div class="productrate">&dollar; <?=$productOptions->productCost?></div>
		                    <div class="hoverablebuy productbuy">Buy Now</div>
		                </div>
		            </a>
		        </div>   
		       
		<?php }}else{?>
			<div>No Product Found</div>

		<?}?>

		<?
    }


    function getProductsByShop(){
    	   	$db = new DB();
        $records = array();

    	

			$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
		 	WHERE active='1' ORDER BY productStock = 0 ASC,product_orders ASC";
		
		if($db->num_rows( $query ) > 0 ){
		   

		   $categories = $this->getMainCategories();
		   foreach ($categories as $category) {
		   	
		   	?>

		   	<div class="col-xs-12">
		   		<h2><?=$category['categoryName']?></h2>
		   	</div>
		   	<?php
		   	$records = $db->get_results("SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS." WHERE active='1' AND categoryId = '".$category['id']."' ORDER BY productStock = 0 ASC,product_orders ASC");
		   	if(count($records)>0){
			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0", true);

				//pre($productOptions)
				$outOfStock = 'no';

		?>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 productlist">
		            <a href="detail.php?productId=<?=base64_encode($record['id'])?>" class="hoverable">
		                <div class="clearfix">
		                <div class="hovereffect clearfix" >
		                    <?if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                <img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Click here for more information" style="cursor: pointer;" alt="Desi temple hair">
                            <? }else{ ?>
                                <img src="<?=PRODUCT_IMAGE_PATH?>/defaultbig.png"  title="Desi temple hair" alt="Desi temple hair">
                            <? } ?>
		                </div>
		                </div>
		                
		                <div class="clearfix caretext">
		                    <div class="productname"><?=$record['productName']?></div><br>
		                    <div class="productrate">&dollar; <?=$productOptions->productCost?></div>
		                    <div class="hoverablebuy productbuy">Buy Now</div>
		                </div>
		            </a>
		        </div>   
		       
		<?php }
			}
		}

		}else{?>
			<div>No Product Found</div>

		<?}?>

		<?
    }


    function getProductsByCategory111($categoryId, $all=NULL){
    	?>
    	 <script type="text/javascript">
				      

				       jQuery( document ).ready(function($) {
				                function loading_show(){
				                    $('#loading').html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
				                }
				                function loading_hide(){
				                    $('#loading').fadeOut('fast');
				                }                
				                function loadData(page, categoryId){

				                    loading_show();                   
				                    $.ajax
				                    ({
				                        type: "POST",
				                        url: "ajxHandler.php",
				                        data: "action=loadProductsByCategory&page="+page+"&categoryId="+categoryId+"&type=<?=$all?>",
				                        success: function(msg)
				                        {			                           
			                                loading_hide();
			                                $("#productList").html(msg);	
			                                $('html, body').animate({scrollTop:0}, 'slow');		
			                                var is_loading = false; // initialize is_loading by false to accept new loading
												$(function() {
													$(window).scroll(function() {
												    	var scrollHeight = ($('.searchpage').height() - $(window).height());
												    	if($(window).scrollTop() >= scrollHeight) {
												        	if (is_loading == false && last_id !== '-1') { // stop loading many times for the same page
												                is_loading = true;
												                loading_show();	
												               setTimeout(function(){
												              	$.ajax
											                    ({
											                        type: "POST",
											                        url: "ajxHandler.php",
											                        data: "action=loadProductsByCategory&page="+page+"&categoryId="+categoryId+"&type=<?=$all?>&last_id="+last_id,
											                        success: function(msg)
											                        {			                           
										                                loading_hide();
										                                $("#productList").append(msg);	
										                                is_loading = false;
										                                			                           
											                        }
											                    });
											                }, 500);
												            }
												       }
												    });
												});	                           
				                        }
				                    });
				                }
				                loadData(1, '<?=$categoryId?>');  // For first time page load default results
				               // $('#container .pagination li.active').live('click',function(){
				               	$('#productList').on('click', '.pagination li.active', function(){
				                    var page = $(this).attr('p');
				                    loadData(page, '<?=$categoryId?>');
				                    
				                }); 								          
				               // $('#go_btn').live('click',function(){
				               	$('#productList').on('click', '#go_btn', function(){
				                    var page = parseInt($('.goto').val());
				                    var no_of_pages = parseInt($('.total').attr('a'));
				                    if(page != 0 && page <= no_of_pages){
				                        loadData(page);
				                    }else{
				                        alert('Enter a PAGE between 1 and '+no_of_pages);
				                        $('.goto').val("").focus();
				                        return false;
				                    }
				                    
				                });


				               // ADD TO CART

				               $('#productList').on('click', '.add-to-cart', function(){

				               			var quantity = jQuery('#productQty_'+this.id).val();

				               			if(quantity>0){
					               			addToCartChitki(this.id);
					               		}else{
					               			alert('Please choose atleast 1 or more quantity');
					               			return false;
					               		}
					    				
					    				 if (jQuery(window).width() <= 767){
					    			 		var cart = $('.mob-shopping-cart');
					    			 	 }else{
					    			 	 	var cart = $('.shopping-cart');
					    			 	 }

								       var imgtodrag = $(this).closest('.item').find("img").eq(0);
								       
								        // if (imgtodrag) {
								        //     var imgclone = imgtodrag.clone()
								        //         .offset({
								        //         top: imgtodrag.offset().top,
								        //         left: imgtodrag.offset().left
								        //     })
								        //         .css({
								        //         'opacity': '0.5',
								        //             'position': 'absolute',
								        //             'height': '150px',
								        //             'width': '150px',
								        //             'z-index': '100'
								        //     })
								        //         .appendTo($('body'))
								        //         .animate({
								        //         'top': cart.offset().top + 10,
								        //             'left': cart.offset().left + 10,
								        //             'width': 30,
								        //             'height': 30
								        //     }, 1000, 'easeInOutExpo');
								            
								        //     setTimeout(function () {
								        //         cart.effect("shake", {
								        //             times: 2
								        //         }, 200);
								        //     }, 1500);

								        //     imgclone.animate({
								        //         'width': 0,
								        //             'height': 0
								        //     }, function () {
								        //         $(this).detach()
								        //     });
								        // }


							    		
							    });

				            });


				        </script>

					


		<div class="searchitem" id="productList"></div>
		<div class="row"><div id="loading" class="loaderClass col-xs-12"></div></div>
	    	

		

    <?

	}

	
	function loadProductsByCategory(){
		
		$db =  new DB();
		$oauth = new oauth();
		 $regId = $oauth->authUser();
		 $wishlistProd = array();
		 if(isset($regId) && $regId !=''){
		 	$userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);

		 	$qry = "SELECT productId FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         	$wishlistProductIds = $db->get_results($qry);
         	if(count($wishlistProductIds)>0){
         	  foreach ($wishlistProductIds as $wishlistProductId) {
			  	$wishlistProd[] = $wishlistProductId['productId'];
			   }
			 }
         }

		if($_POST['page']){

				$page = $_POST['page'];
				$categoryId = $_POST['categoryId'];
				$cur_page = $page;
				$page -= 1;
				$per_page = 40;
				$previous_btn = true;
				$next_btn = true;
				$first_btn = true;
				$last_btn = true;
				$last_id = $_POST['last_id'];
				if(!isset($last_id) && $last_id ==''){
					$last_id = 0;
				}
				$start = $last_id * $per_page;
				$str="";
				$sqlLastid = '';
				$giftCatIds = explode(',', giftCatIds);
				// if(isset($last_id)&&($last_id!='')){
				// 	$sqlLastid = " AND product_orders > '".$last_id."'";
				// }	
				if($_POST['type']=='all'){

					$subCategories = $this->getSubCategoriesByParentId($categoryId);
					
					$sqlStr = "categoryId='".$categoryId."'";
					foreach ($subCategories as $subCategory) {
						$sqlStr.= " || categoryId='".$subCategory['id']."' ";
					}

					$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
	        		 WHERE (".$sqlStr.") ".$sqlLastid." AND  active='1' GROUP BY id ORDER BY productStock = 0 ASC,product_orders ASC LIMIT $start, $per_page";
    
				}else{		
				$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
        		 WHERE categoryId='".$categoryId."' ".$sqlLastid." AND active='1' ORDER BY productStock = 0 ASC,product_orders ASC LIMIT $start, $per_page";
        		}
      		    if($db->num_rows( $query ) > 0 ){
      		   
      		   	$records = $db->get_results($query);

      		   	$m=1;
				foreach($records as $record){

					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['id']."'", true);

					$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0");

					//pre($productOptions)
					$outOfStock = 'no';

				 ?>

					<div class="item col-md-3 col-sm-4 col-xs-12 <?php if($m%4!=0){ ?>borderright<? } ?> <?php if (in_array($record['categoryId'], $giftCatIds)) {?>giftItem<?php } ?>">
						<?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>
						<?php if($record['ad'] == '1') { ?>
					 <div class="blinkborder spl"> 
					 	<?php } ?>
						<a href="javascript:void(0);" id ="wish_<?=$record['id']?>" <?php if (in_array($record['id'], $wishlistProd)) {?> class="wish wishlistActive" title="Remove from Wish List" <?php }else{ ?> class="wish" title="Add to Wish List" <?php } ?>  onclick="addToWishlist('<?=$record["id"]?>');"><img src="images/wish.png"></a>
					
						<div class="mobdivpic">

							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
								<?php if($categoryId == '65'){ ?>
								<a class="prodImgThumb" href="#" data-image-id="" data-toggle="modal" data-title="<?=$record['productName']?>" data-image="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>" data-target="">
									<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
								</a>
								<div class="smMobHide"><p class="prodImgThumbText">(Click photo to enlarge)</p></div>
								<?php }else{ ?>
									<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
								<?php } ?>
							<? }else{ ?>
							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
						
							<? } ?>
							<span>&nbsp;</span>
						
						</div>

						<div class="mobdiv">
						
							<p><?=$record['productName']?></p>
							<?php if($categoryId == '65'){ ?>
							<div class="smMobShow"><p class="prodImgThumbText">(Click photo to enlarge)</p></div>
							<?php } ?>
							<? 
								$defaultProductCost='';
								//if(isset($productOptions) && count($productOptions)>0){
							?>
							<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<?php if (!in_array($record['categoryId'], $giftCatIds)) {?><span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span><?php } ?>
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>
							<?php if (!in_array($record['categoryId'], $giftCatIds)) {?><select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')">
								<? 
								// $defaultProductCost='';
								// if(isset($productOptions) && count($productOptions)>0){
									$k=1;

									foreach($productOptions as $productOption){ 
										
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										}

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}							
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
										?>

											<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productOption['productCost']?> </option>
											<? $k++;
										
									} ?>
								
							</select><?php } ?>
								<? }else{ ?>
								<p>&nbsp;</p>
								<? } ?>
							<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
							<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
									<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>
							</div>
							<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

							<div class="itemprice">

								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
        								?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"> 
										<?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

								<!-- <p>&dollar; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
								<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
								<?php if (!in_array($record['categoryId'], $giftCatIds)) {?>
								<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
								<?php } ?>
								<p class="addbtn ">
								<?php if (!in_array($record['categoryId'], $giftCatIds)) {?>
									<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
										<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
										<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i><img src="images/addcart.png"></i></button>

									<?php }else{ ?>
										<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
									<?php } ?>
								<?php }else{ ?>
								<div class="text-center "><a href="productDetails.php?categoryId=<?=base64_encode($record['categoryId'])?>&productId=<?=base64_encode($record['id'])?>" class="btn viewMoreBtn"  id="<?=$record['id']?>" title="View">View Details <i class="fa fa-caret-right" aria-hidden="true"></i></a></div>
								<?php } ?>
								</p>
								
								<div style="clear:both;width:100%;"></div>
							</div>

						</div>
						<div style="clear:both;width:100%;"></div>
						<?php if($record['ad'] == '1') { ?>
						</div>
						<?php } ?>

					</div>



				



					<?php if($m%4==0){ ?>
					<div class="devider"></div>
					<?php }?>
					<script type="text/javascript">var last_id = '<?=$last_id?>';
					 								   last_id = parseInt(last_id)+parseInt(1);
					 </script>
					<!-- <script type="text/javascript">var last_id = '<?=$record["product_orders"]?>';</script> -->
					<? 
					/* if($record["productStock"] == '0'){?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php } */
					$m++;
				}

				}else{ ?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php 
					//echo '<div class="row"><div class="col-xs-12"><p>More products are coming soon! Call/WhatsApp & Order!</p></div></div>';
					
				}

				
			}

	}


	function showFeaturedProductsByCategoryId($categoryId){

		 $db = new DB();
		 $oauth = new oauth();
		 $regId = $oauth->authUser();
		 $wishlistProd = array();
		 if(isset($regId) && $regId !=''){
		 	$userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);

		 	$qry = "SELECT productId FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         	$wishlistProductIds = $db->get_results($qry);
         	if(count($wishlistProductIds)>0){
         	  foreach ($wishlistProductIds as $wishlistProductId) {
			  	$wishlistProd[] = $wishlistProductId['productId'];
			   }
			 }
         }

		 $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$categoryId."'";
        
         $record = $db->get_row($qry, true);

         //pre($records);

		 ?>


		  <script type="text/javascript">
	
	      jQuery( document ).ready(function($) {

	               // ADD TO CART

	               $('#productList_'+<?=$categoryId?>).on('click', '.add-to-cart', function(){

	               			var quantity = jQuery('#productQty_'+this.id).val();

	               			if(quantity>0){
		               			addToCartChitki(this.id);
		               		}else{
		               			alert('Please choose atleast 1 or more quantity');
		               			return false;
		               		}
		    			
		    			 	var cart = $('.shopping-cart');

					       var imgtodrag = $(this).closest('.item').find("img").eq(0);
					       
					        // if (imgtodrag) {
					        //     var imgclone = imgtodrag.clone()
					        //         .offset({
					        //         top: imgtodrag.offset().top,
					        //         left: imgtodrag.offset().left
					        //     })
					        //         .css({
					        //         'opacity': '0.5',
					        //             'position': 'absolute',
					        //             'height': '150px',
					        //             'width': '150px',
					        //             'z-index': '100'
					        //     })
					        //         .appendTo($('body'))
					        //         .animate({
					        //         'top': cart.offset().top + 10,
					        //             'left': cart.offset().left + 10,
					        //             'width': 75,
					        //             'height': 75
					        //     }, 2000, 'easeInOutExpo');
					            
					        //     setTimeout(function () {
					        //         cart.effect("shake", {
					        //             times: 2
					        //         }, 200);
					        //     }, 1500);

					        //     imgclone.animate({
					        //         'width': 0,
					        //             'height': 0
					        //     }, function () {
					        //         $(this).detach()
					        //     });
					        // }


				    		
				    });

	            });


	        </script>

			


		<div class="col-md-12 arrivedrow nomob" id="productList_<?=$categoryId?>">
		<p class="rowbg"> <?=$record->categoryName?><a href="<?=APP_URL?>/categoryProducts.php?categoryId=<?=base64_encode($record->id)?>">View More</a></p>
	
		<?
			 $subCategories = $this->getSubCategoriesByParentId($categoryId);
			 
			$sqlStr = "categoryId='".$categoryId."'";
			  foreach ($subCategories as $subCategory) {
			   $sqlStr.= " || categoryId='".$subCategory['id']."' ";
			  }

			  $query = "SELECT id, productName,specialOffers,offersDescription,ultraFresh FROM ".PRODUCTS."
			   WHERE (".$sqlStr.") ".$sqlLastid." AND  active='1' AND featuredProduct = '1' AND productStock > 0 GROUP BY id ORDER BY product_orders ASC LIMIT 4";


			// $query = "SELECT id, productName FROM ".PRODUCTS." 
   			// WHERE categoryId='".$categoryId."' AND active='1' ORDER BY featuredProduct DESC, id ASC LIMIT 4";

  		    if($db->num_rows( $query ) > 0 ){
  		   
  		   	$records = $db->get_results($query);
  		   	$m=1;
			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' && productStock>0");

					//pre($productOptions)
				$outOfStock ='no';
				 ?>


					<div class="col-md-3 col-sm-4 col-xs-4 item  <?php if($m%4!=0){ ?>borderright<? } ?>">
						<?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>
					<!-- <div class="blinkborder spl"> -->
						<a href="javascript:void(0);" id ="wish_<?=$record['id']?>" <?php if (in_array($record['id'], $wishlistProd)) {?> class="wish wishlistActive" title="Remove from Wish List" <?php }else{ ?> class="wish" title="Add to Wish List" <?php } ?>  onclick="addToWishlist('<?=$record["id"]?>');"><img src="images/wish.png"></a>

						<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
						
						<?php if($categoryId == '65'){ ?>
							<a class="prodImgThumb" href="#" data-image-id="" data-toggle="modal" data-title="<?=$record['productName']?>" data-image="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>" data-target="">
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							</a>
							<div class="smMobHide"><p class="prodImgThumbText">(Click photo to enlarge)</p></div>
							<?php }else{ ?>
								<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							<?php } ?>
						
						<? }else{ ?>

						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
					
						<? } ?>
						<span>&nbsp;</span>
						<p><?=$record['productName']?></p>
						<!-- <p class="offertxt"><span><i aria-hidden="true" class="fa fa-star"></i> OFFER : </span> 5% Off on Foodles</p> -->

						<?php
						$defaultProductCost='';
							//if(isset($productOptions) && count($productOptions)>0){
						?>
						<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span>

							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>

						<select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')" >
							<? 
							
							
								$k=1;

								foreach($productOptions as $productOption){ 
									
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										}

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}							
										
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
									?>
										<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &#8377; <?=$productOption['productCost']?> </option>
										<? $k++;
									//}
								} 

							?>
						</select>
						<? }else{ ?>
						<p>&nbsp;</p>
						<? } ?>

						<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
						<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
						<div class="savelabel savelabel_<?=$record['id']?>">
							<p>
								<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
								<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
								<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
							</p>
						</div>
						<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

						<div class="itemprice">

								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
										?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"><?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

							<!-- <p>&#8377; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
							<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
							<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
							<p class="addbtn ">
								<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
								<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
									<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
									<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i><img src="images/addcart.png"></i></button>

								<?php }else{ ?>
									<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
								<?php } ?>
							</p>
							<div style="clear:both;width:100%;"></div>
						</div>
					<!-- </div> -->
				</div>

					<? $m++; }

				}else{
					echo '';
				}
				
				?>
				<div style="clear:both;width:100%;"></div>
			</div>

				<?

}


function getProductCostByOptionId(){

	$db =  new DB();

	$productId = $_POST['productId'];
	$productOption = $db->get_row("SELECT productCost, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' 
									AND id='".$_POST['productOptionId']."'", true);

	if(isset($productOption->productCost) && $productOption->productCost>0 && $productOption->productCost!='' && $productId!=''){

		if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
		 $savedTotal = $productOption->productOffer."%"; 
		 $mpCost = $productOption->productCost;
		 $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
		if($offerPrice < 1){
			$offerPrice = 1;
		}
		$productOption->productCost =  number_format(($productOption->productCost - $offerPrice),2); ?>
		 	<script type="text/javascript">
		 		jQuery('.savelabel_'+<?=$productId?>).css('display', 'block');
		 		jQuery('.offerTag_'+<?=$productId?>).css('display', 'block');
				jQuery('.saveTag_'+<?=$productId?>).css('display', 'none');
					//jQuery(document).ready(function () { 
						jQuery('.savedPrice_'+<?=$productId?>).html('<?=$savedTotal?>');
						jQuery('.savedPrice_'+<?=$productId?>).removeClass('savePrice');
						jQuery('.savedPrice_'+<?=$productId?>).addClass('offerPrice');
					//});
				</script>
			
		<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span></span> 
		 <?php } else if($productOption->productCost<$productOption->productMRP && $productOption->productMRP!='' && $productOption->productMRP!=0){
			$savedTotal = '&#8377; '.number_format(($productOption->productMRP-$productOption->productCost), 2);
			?>

				<script type="text/javascript">
				jQuery('.savelabel_'+<?=$productId?>).css('display', 'block');
				jQuery('.offerTag_'+<?=$productId?>).css('display', 'none');
				jQuery('.saveTag_'+<?=$productId?>).css('display', 'block');
					//jQuery(document).ready(function () { 
						jQuery('.savedPrice_'+<?=$productId?>).html('<?=$savedTotal?>');
						jQuery('.savedPrice_'+<?=$productId?>).removeClass('offerPrice');
						jQuery('.savedPrice_'+<?=$productId?>).addClass('savePrice');
					//});
				</script>
			
		<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$productOption->productMRP?></span></span> 
		<? }else{ ?>
			
			<script type="text/javascript">
			jQuery('.savelabel_'+<?=$productId?>).css('display', 'none');
			</script>

		<? } ?>
		<span class="chitkiprice"> &#8377; <?=$productOption->productCost?></span>
		<?
	}

}



   function getProductsBySearch(){   
    	$db = new DB();
        $records = array();
        $page = $_POST['page'];
        $Keyword = $db->filter($_REQUEST['Keyword']);

    

			 $query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."	WHERE (productName LIKE '%".$Keyword."%' OR productDescription LIKE '%".$Keyword."%') AND active='1' ORDER BY productStock = 0 ASC,product_orders ASC";
		

		if($db->num_rows( $query ) > 0 ){
		   
		   	$records = $db->get_results($query);

			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0", true);

				//pre($productOptions)
				$outOfStock = 'no';

		?>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 productlist">
		            <a href="detail.php?productId=<?=base64_encode($record['id'])?>" class="hoverable">
		                <div class="clearfix">
		                <div class="hovereffect clearfix" >
		                    <?if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                <img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>"  title="Click here for more information" style="cursor: pointer;" alt="Desi temple hair">
                            <? }else{ ?>
                                <img src="<?=PRODUCT_IMAGE_PATH?>/defaultbig.png"  title="Desi temple hair" alt="Desi temple hair">
                            <? } ?>
		                </div>
		                </div>
		                
		                <div class="clearfix caretext">
		                    <div class="productname"><?=$record['productName']?></div><br>
		                    <div class="productrate">&dollar; <?=$productOptions->productCost?></div>
		                    <div class="hoverablebuy productbuy">Buy Now</div>
		                </div>
		            </a>
		        </div>   
		       
		<?php }}else{?>
			<div>No Product Found</div>

		<?}?>

		<?

	}


	function loadProductsBySearch(){

		$db =  new DB();
		$oauth = new oauth();
		 $regId = $oauth->authUser();
		 $wishlistProd = array();
		 if(isset($regId) && $regId !=''){
		 	$userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);

		 	$qry = "SELECT productId FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         	$wishlistProductIds = $db->get_results($qry);
         	if(count($wishlistProductIds)>0){
         	  foreach ($wishlistProductIds as $wishlistProductId) {
			  	$wishlistProd[] = $wishlistProductId['productId'];
			   }
			 }
         }
		if($_POST['page']){

				$page = $_POST['page'];
				$searchQuery = base64_decode($_POST['searchQuery']);
				$cur_page = $page;
				$page -= 1;
				$per_page = 40;
				$previous_btn = true;
				$next_btn = true;
				$first_btn = true;
				$last_btn = true;
				$last_id = $_POST['last_id'];
				if(!isset($last_id) && $last_id ==''){
					$last_id = 0;
				}
				$start = $last_id * $per_page;
				$str="";	
				$sqlLastid = '';
				$giftCatIds = explode(',', giftCatIds);
				$parts = explode(' ', $searchQuery);
				$p = count($parts);
				$searchByKeyword = '';
				//$soundxWord = '';
				// for($i = 0; $i < $p; $i++) {
				//   $soundex = soundex($db->filter($parts[$i]));
				//   $soundxWord .= 'OR SOUNDEX(productName) LIKE ' . "'%" . $soundex . "%' ";
				// }
				// $soundex = soundex($searchQuery);
				// $soundxWord .= 'OR SOUNDEX(keywordSearch) LIKE ' . "'%" . $soundex . "%' ";

				$searchByKeyword = ' AND(';
				for($i = 0; $i < $p; $i++) {
				  $searchByKeyword .= ' productName LIKE ' . "'%" . $db->filter($parts[$i]) . "%' AND";
				}
				$searchByKeyword = rtrim($searchByKeyword,' AND');
				$searchByKeyword .= ' OR keywordSearch LIKE ' . "'%" . $db->filter($searchQuery) . "%' ";
				//$searchByKeyword .= $soundxWord;
				$searchByKeyword .=' ) ';

				$totalNumQuery = "SELECT id, productName,productStock,ad,categoryId,ultraFresh,categoryId FROM ".PRODUCTS."
        		 WHERE active='1' ".$sqlLastid." ".$searchByKeyword." ORDER BY productStock = 0 ASC,id ASC";

				$query = "SELECT id, productName,productStock,ad,categoryId,ultraFresh,categoryId FROM ".PRODUCTS."
        		 WHERE active='1' ".$sqlLastid." ".$searchByKeyword." ORDER BY productStock = 0 ASC,id ASC LIMIT $start, $per_page";

        		//No rows use levenshtein algorithm
        		if($db->num_rows($totalNumQuery) < 1){
        			$datain = file_get_contents('keywords.txt');
	        		$out = explode("<!-- E -->", $datain);
	        		$count = count($out);
	        		$words = array();
	        		for ($i = 0; $i < $count; $i++)
			        {
			            $curAdoption[$i] = unserialize($out[$i]);  
			        }
			        $curAdoption = array_filter($curAdoption);
			        $words = array_filter(iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($curAdoption)), 0));
			        // no shortest distance found, yet
					$shortest = -1;
					// loop through words to find the closest
					//pre($words);
					// no shortest distance found, yet
					foreach ($words as $word) {
					    // calculate the distance between the input word,
					    // and the current word
					    $lev = levenshtein($searchQuery, $word);
					    // check for an exact match
					    if ($lev == 0) {
					        // closest word is this one (exact match)
					        $closest = $word;
					        $shortest = 0;
					        // break out of the loop; we've found an exact match
					        break;
					    }
					    // if this distance is less than the next found shortest
					    // distance, OR if a next shortest word has not yet been found
					    if ($lev <= $shortest || $shortest < 0) {
					        // set the closest match, and shortest distance
					        $closest  = $word;
					        $shortest = $lev;
					    }
					}
					$newSearchQuery = $closest;
					$parts = explode(' ', $newSearchQuery);
					$p = count($parts);
					$searchByKeyword = '';
					$soundxWord = '';
					for($i = 0; $i < $p; $i++) {
					  $soundex = soundex($db->filter($parts[$i]));
					  $soundxWord .= 'OR SOUNDEX(productName) LIKE ' . "'%" . $soundex . "%' ";
					}
					$soundex = soundex($newSearchQuery);
					$soundxWord .= 'OR SOUNDEX(keywordSearch) LIKE ' . "'%" . $soundex . "%' ";

					$searchByKeyword = ' AND(';
					for($i = 0; $i < $p; $i++) {
					  $searchByKeyword .= ' productName LIKE ' . "'%" . $db->filter($parts[$i]) . "%' AND";
					}
					$searchByKeyword = rtrim($searchByKeyword,' AND');
					$searchByKeyword .= ' OR keywordSearch LIKE ' . "'%" . $db->filter($newSearchQuery) . "%' ";
					$searchByKeyword .= $soundxWord;
					$searchByKeyword .=' ) ';
					$query = "SELECT id, productName,productStock,ad,categoryId,ultraFresh,categoryId FROM ".PRODUCTS."
	        		 WHERE active='1' ".$sqlLastid." ".$searchByKeyword." ORDER BY productStock = 0 ASC,id ASC LIMIT $start, $per_page";
						//if ($shortest != 0) { 	
							//if($start == 0 && ($db->num_rows( $query ) > 0) ){						
							?>
						   <!--  <div class="col-xs-12 searchSuggestText">
						    	<h4>Showing results for <b><?=$closest?></b></h4>
								<p>Search instead for <?=$searchQuery?></p>
						    </div>	 -->					
						<?php 
							//}
						//}
	        		}
      		    
      		    if($db->num_rows( $query ) > 0 ){
      		   
      		   	$records = $db->get_results($query);

      		   	$m=1;
				foreach($records as $record){

					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['id']."'", true);

					$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND productStock>0 AND active='1'");

					$outOfStock = 'no';
				 ?>

					<div class="item col-md-3 col-sm-4 col-xs-12 <?php if($m%4!=0){ ?>borderright<? } ?> <?php if (in_array($record['categoryId'], $giftCatIds)) {?>giftItem<?php } ?>">
						<?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>
						<?php if($record['ad'] == '1') { ?>
					 <div class="blinkborder spl"> 
					 	<?php } ?>
						<a href="javascript:void(0);" id ="wish_<?=$record['id']?>" <?php if (in_array($record['id'], $wishlistProd)) {?> class="wish wishlistActive" title="Remove from Wish List" <?php }else{ ?> class="wish" title="Add to Wish List" <?php } ?>  onclick="addToWishlist('<?=$record["id"]?>');"><img src="images/wish.png"></a>
						<div class="mobdivpic">

							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
								<?php if($record['categoryId'] == '65'){ ?>
									<a class="prodImgThumb" href="#" data-image-id="" data-toggle="modal" data-title="<?=$record['productName']?>" data-image="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>" data-target="">
										<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
									</a>
									<div class="smMobHide"><p class="prodImgThumbText">(Click photo to enlarge)</p></div>
								<?php } else{ ?>
									<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
								<?php } ?>
							<? }else{ ?>

							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
						
							<? } ?>
							<span>&nbsp;</span>
						
						</div>

						<div class="mobdiv">
						
							<p><?=$record['productName']?></p>
							<?php if($record['categoryId'] == '65'){ ?>
							<div class="smMobShow"><p class="prodImgThumbText">(Click photo to enlarge)</p></div>
							<?php } ?>
							<?
							$defaultProductCost='';
								//if(isset($productOptions) && count($productOptions)>0){
							?>
							<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<?php if (!in_array($record['categoryId'], $giftCatIds)) {?><span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span><?php } ?>
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>
							 <?php if (!in_array($record['categoryId'], $giftCatIds)) {?>
							<select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')">
								<? 
								
									$k=1;

									foreach($productOptions as $productOption){ 
										
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										 }

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}		
										
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
										?>
										<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productOption['productCost']?> </option>
										<? $k++;
										//}
									} ?>
								
							</select>
							<?php } ?>
							<? } ?>

							<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
						<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
									<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>
							</div>
							<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

							<div class="itemprice">

								<!-- <p class="chitkiPrice_<?=$record['id']?>">
									<? if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"> &#8377; 
										<?=$defaultProductCost?></span>
								</p> -->
								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
										?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"> 
										<?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>
								<div class="row"></div>
								<!-- <p>&dollar; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
								<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
								<?php if (!in_array($record['categoryId'], $giftCatIds)) {?>
								<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
								<?php } ?>
								<p class="addbtn ">
									<?php if (!in_array($record['categoryId'], $giftCatIds)) {?>
									<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
									<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
										<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
										<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i><img src="images/addcart.png"></i></button>

									<?php }else{ ?>
										<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>

									<?php } ?>
									<?php }else{ ?>
								<div class="text-center"><a href="productDetails.php?categoryId=<?=base64_encode($record['categoryId'])?>&productId=<?=base64_encode($record['id'])?>" class="btn viewMoreBtn"  id="<?=$record['id']?>" title="View">View Details <i class="fa fa-caret-right" aria-hidden="true"></i></a></div>
								<?php } ?>
								</p>
								<div style="clear:both;width:100%;"></div>

							</div>

						</div>
						<?php if($record['ad'] == '1') { ?>
							</div>
						<?php } ?>

					</div>



				



					<?php if($m%4==0){ ?>
					<div class="devider"></div>
					<?php }?>
					<script type="text/javascript">var last_id = '<?=$last_id?>';
					 								   last_id = parseInt(last_id)+parseInt(1);
					 </script>
					<!-- <script type="text/javascript">var last_id = '<?=$record["id"]?>';</script> -->
					<? /* if($record["productStock"] == '0'){?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php } */
					$m++;
				}

				}else{ ?><script type="text/javascript">var last_id = '-1';</script>
				<?php	
					//echo '<div class="row"><div class="col-xs-12"><p>More products are coming soon! Call/WhatsApp & Order!</p></div></div>';
				}


				// $qry = "SELECT COUNT(*) AS count FROM ".PRODUCTS." WHERE active='1' AND productName LIKE '%".$searchQuery."%' OR SOUNDEX(`productName`) LIKE SOUNDEX('".$db->filter($searchQuery)."')";
        		
    //     		if($db->num_rows( $qry ) > 0 ){          	
	   //        	     $row = $db->get_row( $qry, true );
	   //        	 }

	   //        	 //print_r($row);


				// $count = $row->count;
				// $no_of_paginations = ceil($count / $per_page);
				// /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
				// if ($cur_page >= 7) {
				//     $start_loop = $cur_page - 3;
				//     if ($no_of_paginations > $cur_page + 3)
				//         $end_loop = $cur_page + 3;
				//     else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
				//         $start_loop = $no_of_paginations - 6;
				//         $end_loop = $no_of_paginations;
				//     } else {
				//         $end_loop = $no_of_paginations;
				//     }
				// } else {
				//     $start_loop = 1;
				//     if ($no_of_paginations > 7)
				//         $end_loop = 7;
				//     else
				//         $end_loop = $no_of_paginations;
				// }

				// if($count>$per_page){
				
				// $msg .= "<div id='dyntable_info' class='dataTables_info'>
				// <div class='viewcount'>Showing 1 to ".$num_rows." of ".$count." entries </div>
				// 	 <div class='pagination pagination-right'>
				// 		 <ul>";
				// 		   // FOR ENABLING THE FIRST BUTTON
				// 			if ($first_btn && $cur_page > 1) {
				// 			    $msg .= "<li p='1' class='active'><a href='javascript:void(0);'>First</a></li>";
				// 			} else if ($first_btn) {
				// 			    $msg .= "<li p='1' class='disabled'><a>First</a></li>";
				// 			}

				// 			// FOR ENABLING THE PREVIOUS BUTTON
				// 			if ($previous_btn && $cur_page > 1) {
				// 			    $pre = $cur_page - 1;
				// 			    $msg .= "<li p='$pre' class='active'><a>Previous</a></li>";
				// 			} else if ($previous_btn) {
				// 			    $msg .= "<li class='disabled'><a>Previous</a></li>";
				// 			}

				// 			for ($i = $start_loop; $i <= $end_loop; $i++) {

				// 			    if ($cur_page == $i)
				// 			        $msg .= "<li p='$i' class='active'><a class='current'>{$i}</a></li>";
				// 			    else
				// 			        $msg .= "<li p='$i' class='active'><a>{$i}</a></li>";
				// 			}

				// 			// TO ENABLE THE NEXT BUTTON
				// 			if ($next_btn && $cur_page < $no_of_paginations) {
				// 			    $nex = $cur_page + 1;
				// 			    $msg .= "<li p='$nex' class='active'><a>Next</a></li>";
				// 			} else if ($next_btn) {
				// 			    $msg .= "<li class='disabled'><a>Next</a></li>";
				// 			}

				// 			// TO ENABLE THE END BUTTON
				// 			if ($last_btn && $cur_page < $no_of_paginations) {
				// 			    $msg .= "<li p='$no_of_paginations' class='active'><a>Last</a></li>";
				// 			} else if ($last_btn) {
				// 			    $msg .= "<li p='$no_of_paginations' class='disabled'><a>Last</a></li>";
				// 			}
							
				// $msg.="</ul>	
				// 	 </div>
				// </div>";

				// echo $msg;

			 // 	}
			}

	}


	function searchHistory($searchQuery){
		$db = new DB();

        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

        $data = array(
                'searchQuery' => $db->filter($searchQuery),
                'page' => $db->filter($_SERVER['REQUEST_URI']),
                'dateTime' => $dateTime
        );

        $historyInsert = $db->insert('search_history', $data);

        if($historyInsert){
        	return true;
        }
	}
/* ------------- brand ------------------- */
	function productBrands(){
		$db = new DB();

        $query = "SELECT * FROM ".BRANDS." WHERE active ='1' ORDER BY brandName ASC";
        if($db->num_rows( $query ) > 0 ){
           return $db->get_results($query);
        }else{
           return false;
        }
	}

	function getBrandDetailsById($brandId){
        $db = new DB();
        $records = array();

        $query = "SELECT * FROM ".BRANDS." WHERE id='".$db->filter($brandId)."'";
        
        if($db->num_rows($query) > 0 ){
           $records = $db->get_row($query, true);
        }

        return $records;

    }
    function getProductsByBrands($brandId, $all=NULL){
    	?>
    	 <script type="text/javascript">
				      

				       jQuery( document ).ready(function($) {
				                function loading_show(){
				                    $('#loading').html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
				                }
				                function loading_hide(){
				                    $('#loading').fadeOut('fast');
				                }                
				                function loadData(page, brandId){

				                    loading_show();                   
				                    $.ajax
				                    ({
				                        type: "POST",
				                        url: "ajxHandler.php",
				                        data: "action=loadProductsByBrands&page="+page+"&brandId="+brandId+"&type=<?=$all?>",
				                        success: function(msg)
				                        {			                           
			                                loading_hide();
			                                $("#productList").html(msg);	
			                                $('html, body').animate({scrollTop:0}, 'slow');		
			                                var is_loading = false; // initialize is_loading by false to accept new loading
												$(function() {
													$(window).scroll(function() {
												    	var scrollHeight = ($('.searchpage').height() - $(window).height());
												    	if($(window).scrollTop() >= scrollHeight) {
												        	if (is_loading == false && last_id !== '-1') { // stop loading many times for the same page
												                is_loading = true;
												                loading_show();	
												               setTimeout(function(){
												              	$.ajax
											                    ({
											                        type: "POST",
											                        url: "ajxHandler.php",
											                        data: "action=loadProductsByBrands&page="+page+"&brandId="+brandId+"&type=<?=$all?>&last_id="+last_id,
											                        success: function(msg)
											                        {			                           
										                                loading_hide();
										                                $("#productList").append(msg);	
										                                is_loading = false;
										                                			                           
											                        }
											                    });
											                }, 500);
												            }
												       }
												    });
												});	                           
				                        }
				                    });
				                }
				                loadData(1, '<?=$brandId?>');  // For first time page load default results
				               // $('#container .pagination li.active').live('click',function(){
				               	$('#productList').on('click', '.pagination li.active', function(){
				                    var page = $(this).attr('p');
				                    loadData(page, '<?=$brandId?>');
				                    
				                }); 								          
				               // $('#go_btn').live('click',function(){
				               	$('#productList').on('click', '#go_btn', function(){
				                    var page = parseInt($('.goto').val());
				                    var no_of_pages = parseInt($('.total').attr('a'));
				                    if(page != 0 && page <= no_of_pages){
				                        loadData(page);
				                    }else{
				                        alert('Enter a PAGE between 1 and '+no_of_pages);
				                        $('.goto').val("").focus();
				                        return false;
				                    }
				                    
				                });


				               // ADD TO CART

				               $('#productList').on('click', '.add-to-cart', function(){

				               			var quantity = jQuery('#productQty_'+this.id).val();

				               			if(quantity>0){
					               			addToCartChitki(this.id);
					               		}else{
					               			alert('Please choose atleast 1 or more quantity');
					               			return false;
					               		}
					    				
					    				 if (jQuery(window).width() <= 767){
					    			 		var cart = $('.mob-shopping-cart');
					    			 	 }else{
					    			 	 	var cart = $('.shopping-cart');
					    			 	 }

								       var imgtodrag = $(this).closest('.item').find("img").eq(0);
								      
							    		
							    });

				            });


				        </script>

					


		<div class="searchitem" id="productList"></div>
		<div class="row"><div id="loading" class="loaderClass col-xs-12"></div></div>
	    	

		

    <?

	}

	
	function loadProductsByBrands(){
		
		$db =  new DB();
		$oauth = new oauth();
		 $regId = $oauth->authUser();
		 $wishlistProd = array();
		 if(isset($regId) && $regId !=''){
		 	$userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);

		 	$qry = "SELECT productId FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         	$wishlistProductIds = $db->get_results($qry);
         	if(count($wishlistProductIds)>0){
         	  foreach ($wishlistProductIds as $wishlistProductId) {
			  	$wishlistProd[] = $wishlistProductId['productId'];
			   }
			 }
         }
         
		if($_POST['page']){

				$page = $_POST['page'];
				$brandId = $_POST['brandId'];
				$cur_page = $page;
				$page -= 1;
				$per_page = 40;
				$previous_btn = true;
				$next_btn = true;
				$first_btn = true;
				$last_btn = true;
				$last_id = $_POST['last_id'];
				if(!isset($last_id) && $last_id ==''){
					$last_id = 0;
				}
				$start = $last_id * $per_page;
				$str="";
				$noRows='';
				$sqlLastid = '';
				if(isset($last_id)&&($last_id!='')){
					$sqlLastid = " AND product_orders > '".$last_id."'";
				}

				$numQuery = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock FROM ".PRODUCTS."
	        		 WHERE brandId='".$brandId."' AND  active='1' GROUP BY id ORDER BY productStock = 0 ASC,product_orders ASC";
	        	if($db->num_rows( $numQuery ) == 0 ){
	        		$noRows = '1';
	        	}
				if($_POST['type']=='all'){
					
					$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ultraFresh FROM ".PRODUCTS."
	        		 WHERE brandId='".$brandId."' ".$sqlLastid." AND  active='1' GROUP BY id ORDER BY productStock = 0 ASC,product_orders ASC LIMIT $start, $per_page";
    
				}else{		
					$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ultraFresh FROM ".PRODUCTS."
	        		 WHERE brandId='".$brandId."' ".$sqlLastid." AND active='1' ORDER BY productStock = 0 ASC,product_orders ASC LIMIT $start, $per_page";
        		}
      		    if($db->num_rows( $query ) > 0 ){
      		   
      		   	$records = $db->get_results($query);

      		   	$m=1;
				foreach($records as $record){

					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['id']."'", true);

					$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0");

					$outOfStock = 'no';

				 ?>

					<div class="item col-md-3 col-sm-4 col-xs-12 <?php if($m%4!=0){ ?>borderright<? } ?>">
						<?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>
						<a href="javascript:void(0);" id ="wish_<?=$record['id']?>" <?php if (in_array($record['id'], $wishlistProd)) {?> class="wish wishlistActive" title="Remove from Wish List" <?php }else{ ?> class="wish" title="Add to Wish List" <?php } ?>  onclick="addToWishlist('<?=$record["id"]?>');"><img src="images/wish.png"></a>
						<div class="mobdivpic">

							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
							
							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							
							<? }else{ ?>

							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
						
							<? } ?>
							<span>&nbsp;</span>
						
						</div>

						<div class="mobdiv">
						
							<p><?=$record['productName']?></p>
							<? 
								$defaultProductCost='';
								//if(isset($productOptions) && count($productOptions)>0){
							?>
							<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span>
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>
							<select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')">
								<? 
								// $defaultProductCost='';
								// if(isset($productOptions) && count($productOptions)>0){
									$k=1;

									foreach($productOptions as $productOption){ 
										
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										}

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}							
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
										?>

											<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productOption['productCost']?> </option>
											<? $k++;
										
									} ?>
								
							</select>
								<? }else{ ?>
								<p>&nbsp;</p>
								<? } ?>
							<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
							<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
									<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>
							</div>
							<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

							<div class="itemprice">

								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
        								?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"> 
										<?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

								<!-- <p>&dollar; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
								<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
								<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
								<p class="addbtn ">
									<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
										<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
										<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i><img src="images/addcart.png"></i></button>

									<?php }else{ ?>
										<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
									<?php } ?>
								</p>
								<div style="clear:both;width:100%;"></div>
							</div>

						</div>

					</div>



				



					<?php if($m%4==0){ ?>
					<div class="devider"></div>
					<?php }?>
					<script type="text/javascript">var last_id = '<?=$last_id?>';
					 								   last_id = parseInt(last_id)+parseInt(1);
					 </script>
					<!-- <script type="text/javascript">var last_id = '<?=$record["product_orders"]?>';</script> -->
					<? 
					/* if($record["productStock"] == '0'){?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php } */
					$m++;
				}

				}else{ ?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php 
					if($noRows == '1'){
						echo '<div class="row"><div class="col-xs-12 text-center"><p>No products found! </p></div></div>';
					}
				}

				
			}

	}

	function showProductById($productId){

		 $db = new DB();
		 $oauth = new oauth();
		 $regId = $oauth->authUser();
		 $wishlistProd = array();
		 if(isset($regId) && $regId !=''){
		 	$userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);

		 	$qry = "SELECT productId FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         	$wishlistProductIds = $db->get_results($qry);
         	if(count($wishlistProductIds)>0){
         	  foreach ($wishlistProductIds as $wishlistProductId) {
			  	$wishlistProd[] = $wishlistProductId['productId'];
			   }
			 }
         }
		 // $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$categoryId."'";
        
   //       $record = $db->get_row($qry, true);

         //pre($records);

		 ?>


		  <script type="text/javascript">
	
	      jQuery( document ).ready(function($) {

	               // ADD TO CART

	               $('#productList_'+<?=$productId?>).on('click', '.add-to-cart', function(){

	               			var quantity = jQuery('#productQty_'+this.id).val();

	               			if(quantity>0){
		               			addToCartChitki(this.id);
		               		}else{
		               			alert('Please choose atleast 1 or more quantity');
		               			return false;
		               		}
		    			
		    			 	var cart = $('.shopping-cart');

					       var imgtodrag = $(this).closest('.item').find("img").eq(0);
					  	
				    });

	            });


	        </script>


			


		<div class="arrivedrow" id="productList_<?=$productId?>">
		<?
			//  $subCategories = $this->getSubCategoriesByParentId($categoryId);
			 
			// $sqlStr = "categoryId='".$categoryId."'";
			//   foreach ($subCategories as $subCategory) {
			//    $sqlStr.= " || categoryId='".$subCategory['id']."' ";
			//   }

			  $query = "SELECT id, productName,specialOffers,offersDescription,ultraFresh FROM ".PRODUCTS."
			   WHERE id = '".$productId."' AND  active='1'  GROUP BY id ORDER BY product_orders ASC ";


			// $query = "SELECT id, productName FROM ".PRODUCTS." 
   			// WHERE categoryId='".$categoryId."' AND active='1' ORDER BY featuredProduct DESC, id ASC LIMIT 4";

  		    if($db->num_rows( $query ) > 0 ){
  		   
  		   	$records = $db->get_results($query);
  		   	$m=1;
			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' && productStock>0");

					//pre($productOptions)
				$outOfStock ='no';
				 ?>


					<div class="col-xs-12 item  <?php if($m%4!=0){ ?>borderright<? } ?>">
						<?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>
						<a href="javascript:void(0);" id ="wish_<?=$record['id']?>" <?php if (in_array($record['id'], $wishlistProd)) {?> class="wish wishlistActive" title="Remove from Wish List" <?php }else{ ?> class="wish" title="Add to Wish List" <?php } ?>  onclick="addToWishlist('<?=$record["id"]?>');"><img src="images/wish.png"></a>
					<!-- <div class="blinkborder"> -->

						<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
						
						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
						
						<? }else{ ?>

						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
					
						<? } ?>
						<span>&nbsp;</span>
						<p><?=$record['productName']?></p>

						<?php
						$defaultProductCost='';
							//if(isset($productOptions) && count($productOptions)>0){
						?>
						<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span>
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>
						<select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')" >
							<? 
							
							
								$k=1;

								foreach($productOptions as $productOption){ 
									
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										}

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}							
										
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
									?>
										<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &#8377; <?=$productOption['productCost']?> </option>
										<? $k++;
									//}
								} 

							?>
						</select>
						<? }else{ ?>
						<p>&nbsp;</p>
						<? } ?>

						<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
						<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
						<div class="savelabel savelabel_<?=$record['id']?>">
							<p>
								<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
								<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
								<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
							</p>
						</div>
						<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

						<div class="itemprice">

								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
										?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"><?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

							<!-- <p>&#8377; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
							<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
							<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
							<p class="addbtn ">
								<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
								<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
									<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
									<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i><img src="images/addcart.png"></i></button>
									
								<?php }else{ ?>
									<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
								<?php } ?>
							</p>
							<div style="clear:both;width:100%;"></div>
						</div>
					<!-- </div> -->
				</div>

					<? $m++; }

				}else{
					echo '';
				}
				
				?>
				<div style="clear:both;width:100%;"></div>
			</div>

				<?

}
function showWishlistProducts(){
		 $db = new DB();
		 $oauth = new oauth();
		 $regId = $oauth->authUser();

		 $userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);
		 $qry = "SELECT * FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         $wishlistProducts = $db->get_results($qry);

		 ?>


		  <script type="text/javascript">
	
	      jQuery( document ).ready(function($) {

	               // ADD TO CART

	               $('#productList_'+<?=$regId?>).on('click', '.add-to-cart', function(){

	               			var quantity = jQuery('#productQty_'+this.id).val();

	               			if(quantity>0){
		               			addToCartChitki(this.id);
		               		}else{
		               			alert('Please choose atleast 1 or more quantity');
		               			return false;
		               		}
		    			
		    			 	var cart = $('.shopping-cart');

					       var imgtodrag = $(this).closest('.item').find("img").eq(0);
					    	
				    });

	            });


	        </script>

			

	    <?  $sqlStr = "";
			if(count($wishlistProducts)>0){ ?>    
		<div class="searchitem" id="productList_<?=$regId?>">
		
			<?php foreach ($wishlistProducts as $wishlistProduct) {
			   $sqlStr.= " id='".$wishlistProduct['productId']."' OR";
			  }
			$sqlStr = rtrim($sqlStr,'OR');
			$query = "SELECT id, productName,specialOffers,offersDescription,ultraFresh FROM ".PRODUCTS."
			   WHERE (".$sqlStr.") AND  active='1' GROUP BY id ORDER BY product_orders ASC";


			// $query = "SELECT id, productName FROM ".PRODUCTS." 
   			// WHERE categoryId='".$categoryId."' AND active='1' ORDER BY featuredProduct DESC, id ASC LIMIT 4";

  		    if($db->num_rows( $query ) > 0 ){
  		   
  		   	$records = $db->get_results($query);
  		   	$m=1;
			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' && productStock>0");

					//pre($productOptions)
				$outOfStock ='no';
				 ?>


					<div id="wishList_<?=$record['id']?>" class="col-md-3 col-sm-4 col-xs-4 item  <?php if($m%4!=0){ ?>borderright<? } ?> ">
						 <?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>	
					<!-- <div class="blinkborder"> -->
						<a href="javascript:void(0);" title="Remove from Wishlist" class="deleteWish" onclick="removeFromWishlist('<?=$record["id"]?>');"><img src="images/cartremove.png"></a>
						<div class="mobdivpic">
						<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
						
						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
						
						<? }else{ ?>

						<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
					
						<? } ?>
						<span>&nbsp;</span>
						</div>
						<div class="mobdiv">
						<p><?=$record['productName']?></p>

						<?php
						$defaultProductCost='';
							//if(isset($productOptions) && count($productOptions)>0){
						?>
						<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span>
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>
						<select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')" >
							<? 
							
							
								$k=1;

								foreach($productOptions as $productOption){ 
									
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										}

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}							
										
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
									?>
										<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &#8377; <?=$productOption['productCost']?> </option>
										<? $k++;
									//}
								} 

							?>
						</select>
						<? }else{ ?>
						<p>&nbsp;</p>
						<? } ?>

						<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
						<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
						<div class="savelabel savelabel_<?=$record['id']?>">
							<p>
								<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
								<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
								<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
							</p>
						</div>
						<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

						<div class="itemprice">

								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
										?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"><?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

							<!-- <p>&#8377; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
							<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
							<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
							<p class="addbtn ">
								<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
								<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
									<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i class="fa fa-shopping-cart"></i></button>
								<?php }else{ ?>
									<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
								<?php } ?>
							</p>
							<div style="clear:both;width:100%;"></div>
						</div>
					</div>		
					<!-- </div> -->
				</div>
					<?php if($m%4==0){ ?>
					<div class="devider"></div>
					<?php }?>
					<? $m++; }

				}else{
					echo '';
				}
				
				?>
			</div>
			<? }else{

			echo "No products in the wishlist!";
			?>
			<button class="shoppingbtn" onclick="window.location.href='<?=APP_URL?>'">
				Continue Shopping <i class="fa fa-shopping-cart"></i>
			</button>
			<?
			}
	}

	function getProductsByOffers($offerId=NULL,$offerType=NULL){
    	?>
    	 <script type="text/javascript">
				      

				       jQuery( document ).ready(function($) {
				                function loading_show(){
				                    $('#loading').html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
				                }
				                function loading_hide(){
				                    $('#loading').fadeOut('fast');
				                }                
				                function loadData(page){

				                    loading_show();                   
				                    $.ajax
				                    ({
				                        type: "POST",
				                        url: "ajxHandler.php",
				                        data: "action=loadProductsByOffers&page="+page+"&offerType=<?=$offerType?>&offerId=<?=$offerId?>",
				                        success: function(msg)
				                        {			                           
			                                loading_hide();
			                                $("#productList").html(msg);	
			                                $('html, body').animate({scrollTop:0}, 'slow');		
			                                var is_loading = false; // initialize is_loading by false to accept new loading
												$(function() {
													$(window).scroll(function() {
												    	var scrollHeight = ($('.searchpage').height() - $(window).height());
												    	if($(window).scrollTop() >= scrollHeight) {
												        	if (is_loading == false && last_id !== '-1') { // stop loading many times for the same page
												                is_loading = true;
												                loading_show();	
												               setTimeout(function(){
												              	$.ajax
											                    ({
											                        type: "POST",
											                        url: "ajxHandler.php",
											                        data: "action=loadProductsByOffers&page="+page+"&last_id="+last_id+"&offerType=<?=$offerType?>&offerId=<?=$offerId?>",
											                        success: function(msg)
											                        {			                           
										                                loading_hide();
										                                $("#productList").append(msg);	
										                                is_loading = false;
										                                			                           
											                        }
											                    });
											                }, 500);
												            }
												       }
												    });
												});	                           
				                        }
				                    });
				                }
				                loadData(1);  // For first time page load default results
				               // $('#container .pagination li.active').live('click',function(){
				               	$('#productList').on('click', '.pagination li.active', function(){
				                    var page = $(this).attr('p');
				                    loadData(page);
				                    
				                }); 								          
				               // $('#go_btn').live('click',function(){
				               	$('#productList').on('click', '#go_btn', function(){
				                    var page = parseInt($('.goto').val());
				                    var no_of_pages = parseInt($('.total').attr('a'));
				                    if(page != 0 && page <= no_of_pages){
				                        loadData(page);
				                    }else{
				                        alert('Enter a PAGE between 1 and '+no_of_pages);
				                        $('.goto').val("").focus();
				                        return false;
				                    }
				                    
				                });


				               // ADD TO CART

				               $('#productList').on('click', '.add-to-cart', function(){

				               			var quantity = jQuery('#productQty_'+this.id).val();

				               			if(quantity>0){
					               			addToCartChitki(this.id);
					               		}else{
					               			alert('Please choose atleast 1 or more quantity');
					               			return false;
					               		}
					    				
					    				 if (jQuery(window).width() <= 767){
					    			 		var cart = $('.mob-shopping-cart');
					    			 	 }else{
					    			 	 	var cart = $('.shopping-cart');
					    			 	 }

								       var imgtodrag = $(this).closest('.item').find("img").eq(0);
								     
							    });

				            });


				        </script>

					


		<div class="searchitem" id="productList"></div>
		<div class="row"><div id="loading" class="loaderClass col-xs-12"></div></div>
	    	

		

    <?

	}

	
	function loadProductsByOffers(){
		
		$db =  new DB();
		$oauth = new oauth();
		 $regId = $oauth->authUser();
		 $wishlistProd = array();
		 if(isset($regId) && $regId !=''){
		 	$userMobNumber = $db->get_row("SELECT mobileNumber FROM ".REGISTERED_USER." WHERE id='".$regId."'",true);
		 	
		 	$qry = "SELECT productId FROM ".WISHLIST." WHERE regId='".$regId."' AND active = '1'";
         	$wishlistProductIds = $db->get_results($qry);
         	if(count($wishlistProductIds)>0){
         	  foreach ($wishlistProductIds as $wishlistProductId) {
			  	$wishlistProd[] = $wishlistProductId['productId'];
			   }
			 }
         }

		if($_POST['page']){

				$page = $_POST['page'];
				$offerType = $_POST['offerType'];
				$offerId = $_POST['offerId'];
				$cur_page = $page;
				$page -= 1;
				$per_page = 40;
				$previous_btn = true;
				$next_btn = true;
				$first_btn = true;
				$last_btn = true;
				$last_id = $_POST['last_id'];
				if(!isset($last_id) && $last_id ==''){
					$last_id = 0;
				}
				$start = $last_id * $per_page;
				// $last_id = $_POST['last_id'];
				$str="";
				$sqlLastid = '';
				// if(isset($last_id)&&($last_id!='')){
				// 	$sqlLastid = " AND product_orders > '".$last_id."'";
				// }
				if(isset($offerId) && $offerId!=''){
					$query = "SELECT id, productName,product_orders,productStock,ultraFresh FROM ".PRODUCTS."
        		 	WHERE active='1' ".$sqlLastid." AND find_in_set('".$offerId."',productOfferId) ORDER BY productStock = 0 ASC, categoryId ASC LIMIT $start, $per_page";
        		}else if($offerType =='ramzan'){
					$query = "SELECT id, productName,product_orders,productStock,ultraFresh FROM ".PRODUCTS."
        		 WHERE active='1' ".$sqlLastid." AND ramzanOffer='1' ORDER BY productStock = 0 ASC, categoryId ASC LIMIT $start, $per_page";
        		}else if($offerType =='combo'){
        			$query = "SELECT id, productName,product_orders,productStock,ultraFresh FROM ".PRODUCTS."
        		 WHERE active='1' ".$sqlLastid." AND comboOffer='1' ORDER BY productStock = 0 ASC, categoryId ASC LIMIT $start, $per_page";
        		
        		}
      		    if($db->num_rows( $query ) > 0 ){
      		   	$records = $db->get_results($query);
      		   	$m=1;
				foreach($records as $record){

					$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
										              WHERE productId='".$record['id']."'", true);

					$productOptions = $db->get_results("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0");

					//pre($productOptions)
					$outOfStock = 'no';

				 ?>

					<div class="item col-md-3 col-sm-4 col-xs-12 <?php if($m%4!=0){ ?>borderright<? } ?>">
						<?php if($record['ultraFresh'] == '1') { ?>
						<img src="images/ultrafresh.png" class="mobUltraFresh" title="Ultra Fresh Recommended Today">
						<?php } ?>
						<a href="javascript:void(0);" id ="wish_<?=$record['id']?>" <?php if (in_array($record['id'], $wishlistProd)) {?> class="wish wishlistActive" title="Remove from Wish List" <?php }else{ ?> class="wish" title="Add to Wish List" <?php } ?>  onclick="addToWishlist('<?=$record["id"]?>');"><img src="images/wish.png"></a>
					<!-- <div class="blinkborder spl"> -->
						<div class="mobdivpic">

							<? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
							
							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/<?=$productImageData->image?>" class="center-block" title="Chitki.com - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
							
							<? }else{ ?>

							<img src="<?=PRODUCT_THUMBNAIL_PATH?>/default.png" class="center-block" title="Chitki.com - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
						
							<? } ?>
							<span>&nbsp;</span>
						
						</div>

						<div class="mobdiv">
						
							<p><?=$record['productName']?></p>
							<? 
								$defaultProductCost='';
								//if(isset($productOptions) && count($productOptions)>0){
							?>
							<?php if(isset($productOptions) && count($productOptions) == 1){ 
								foreach($productOptions as $productOption){ 
									$productCost = $productOption['productCost']; 
									if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productCost = number_format(($productOption['productCost'] - $offerPrice),2);
										} 
							?>
							<input type="hidden" name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" value="<?=$productOption['id']?>" >
							<span class="oneProductselects"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productCost?></span>
							<?php 	$defaultProductCost = $productOption['productCost'];
									$defaultProductMRP = $productOption['productMRP'];
									$defaultProductOffer = $productOption['productOffer'];
									if($productOption['productStock']>0){	

									}else{
										$outOfStock = 'yes';
									}
								}
							 }else if(isset($productOptions) && count($productOptions)>1){?>
							<select name="productOptionId_<?=$record['id']?>" id="productOptionId_<?=$record['id']?>" onchange="getProductCostByOptionId(this, '<?=$record['id']?>')">
								<? 
								// $defaultProductCost='';
								// if(isset($productOptions) && count($productOptions)>0){
									$k=1;

									foreach($productOptions as $productOption){ 
										
										if($k==1){ 
											$defaultProductCost = $productOption['productCost'];
											$defaultProductMRP = $productOption['productMRP'];
											$defaultProductOffer = $productOption['productOffer'];
										}

										if($productOption['productStock']>0){	

										}else{
											$outOfStock = 'yes';
										}							
										if((isset($productOption['productOffer'])) && ($productOption['productOffer']!='') && ($productOption['productOffer'] > 0) && (count($productOptions)>0)){
											$offerPrice = round(($productOption['productOffer']*$productOption['productCost'])/100);
											if($offerPrice < 1){
												$offerPrice = 1;
											}
											$productOption['productCost'] = number_format(($productOption['productCost'] - $offerPrice),2);
										}
										?>

											<option value="<?=$productOption['id']?>"><?=$productOption['productWeight']?> <?=$productOption['productUnit']?>- &dollar;<?=$productOption['productCost']?> </option>
											<? $k++;
										
									} ?>
								
							</select>
								<? }else{ ?>
								<p>&nbsp;</p>
								<? } ?>
							<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){?>	
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;">Save</span>
									<span class="savedPrice_<?=$record['id']?> offerPrice"><?=$defaultProductOffer?>%</span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel">OFF</span>
									
								</p>
							</div>
							<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductMRP>0 && count($productOptions)>0){ ?>
							<div class="savelabel savelabel_<?=$record['id']?>">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" >Save</span>
									<span class="savedPrice_<?=$record['id']?> savePrice">&#8377; <?=number_format(($defaultProductMRP-$defaultProductCost), 2)?></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>
							</div>
							<? }else{ ?>
							<div class="savelabel savelabel_<?=$record['id']?>" style="display:none;">
								<p>
									<span class="saveTag_<?=$record['id']?> tagLabel saveLabel" style="display:none;" >Save</span>
									<span class="savedPrice_<?=$record['id']?>"></span>
									<span class="offerTag_<?=$record['id']?> tagLabel offerLabel" style="display:none;">OFF</span>
								</p>

							</div>
							<?php } ?>

							<div class="itemprice">

								<p class="chitkiPrice_<?=$record['id']?>">
									<?php if((isset($defaultProductOffer)) && ($defaultProductOffer!='') && ($defaultProductOffer > 0) && (count($productOptions)>0)){
										$mpCost = $defaultProductCost;
										$offerPrice = round(($defaultProductOffer*$defaultProductCost)/100);
										if($offerPrice < 1){
											$offerPrice = 1;
										}
										$defaultProductCost = number_format(($defaultProductCost - $offerPrice),2);
        								?>
										<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$mpCost?></span> </span> 
									<? } else if($defaultProductCost<$defaultProductMRP && $defaultProductMRP!='' && $defaultProductCost!='' && $defaultProductMRP>0){ ?>
									<span class="marketprice">MP<a href="#" title="Market Price/MRP"><i class="fa fa-question-circle"></i></a>  &#8377; <span><?=$defaultProductMRP?></span> </span> 
									<? } ?>
									<span class="chitkiprice"> 
										<?=($defaultProductCost!='')?'&#8377; '.$defaultProductCost:''?></span>
								</p>	
								<div class="row"></div>

								<!-- <p>&dollar; <span class="productPrice_<?=$record['id']?>"><?=$defaultProductCost?></span></p>							 -->
								<!-- <p> <i class="fa fa-truck"></i> <span>Standard Delivery: Tomorrow Evening</span> </p> -->
								<p class="qty"><label>Qty</label><input type="number" name="productQty_<?=$record['id']?>" id="productQty_<?=$record['id']?>" min="1" onkeypress="return numbersOnly(event)" value="1"></p>
								<p class="addbtn ">
									<?php if(isset($productOptions) && count($productOptions)>0 && $outOfStock=='no'){ ?>
										<!-- <button class="add-to-cart" id="<?=$record['id']?>" type="button">Add <i class="fa fa-shopping-cart"></i></button> -->
										<button class="add-to-cart" id="<?=$record['id']?>" type="button" title="Add to Cart">Add <i><img src="images/addcart.png"></i></button>

									<?php }else{ ?>
										<button type="button" class="notifybtn btn btn-info btn-lg" data-toggle="modal" data-target="#notifybox_<?=$record['id']?>">Notify Me</button> 
										<p style="color:red;width:100%;text-align:center;margin-top:3px;">Out of Stock</p>
										
										<div id="notifybox_<?=$record['id']?>" class="modal fade" role="dialog">
										  	<div class="modal-dialog">
										    	<div class="modal-content">
										      		<div class="modal-header">
										        		<h4 class="modal-title">Notify me</h4>
										      		</div>
										      		<div class="modal-body">
										      			<div class="modalMsgContent">
										      			</div>
										      			<div class="modalFormContent">
											      			<form id="notifyForm" action="" method="post" onsubmit="notifyUsers('<?=$record['id']?>');return false">
												        		<input type="text" name="notifyNumber" id="notifyNumber_<?=$record['id']?>" value="<?=$userMobNumber->mobileNumber?>" placeholder="Enter Mobile Number (10 digit) to notify." pattern="[0-9]{10}?$" required title="Enter valid 10 digit mobile number">
												        		<button type="submit" class="notifypopupbtn" >Submit</button>
											        		</form>
										        		</div>
									      			</div>
											      	<div class="modal-footer">
											        	<button type="button" class="btn btn-default notifypopupbtn" data-dismiss="modal">Close</button>
											      	</div>
											      	
											    </div>
										  	</div>

										</div>
									<?php } ?>
								</p>
								<div style="clear:both;width:100%;"></div>
							</div>

						</div>
						<div style="clear:both;width:100%;"></div>
					<!-- </div> -->

					</div>


					<?php if($m%4==0){ ?>
					<div class="devider"></div>
					<?php }?>
					<script type="text/javascript">var last_id = '<?=$last_id?>';
					 								   last_id = parseInt(last_id)+parseInt(1);
					 </script>
					<? 
					/* if($record["productStock"] == '0'){?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php } */
					$m++;
				}

				}else{ ?>
					<script type="text/javascript">var last_id = '-1';</script>
					<?php 
					//echo '<div class="row"><div class="col-xs-12"><p>More products are coming soon! Call/WhatsApp & Order!</p></div></div>';
					
				}

				
			}

	}

	function getOfferDetailsById($offerId){
        $db = new DB();
        $records = array();

        $query = "SELECT * FROM ".PRODUCT_OFFERS." WHERE id='".$db->filter($offerId)."'";
        
        if($db->num_rows($query) > 0 ){
           $records = $db->get_row($query, true);
        }

        return $records;

    }


    function getNaturalBalanceProduct(){
		$db = new DB();
        $records = array();

		$query = "SELECT id, productName,specialOffers,offersDescription,product_orders,productStock,ad,ultraFresh,categoryId FROM ".PRODUCTS."
	 	WHERE productType='natureBalance' AND active='1' ORDER BY productStock = 0 ASC,product_orders ASC";
		
		if($db->num_rows( $query ) > 0 ){
		   
		   	$records = $db->get_results($query);

			foreach($records as $record){

				$productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
									              WHERE productId='".$record['id']."'", true);

				$productOptions = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, productMRP,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId='".$record['id']."' AND active='1' AND productStock>0", true);

				//pre($productOptions)
				$outOfStock = 'no';

		?>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom:20px;">
		            <a href="detail.php?productId=<?=base64_encode($record['id'])?>" class="hoverable">
		                <div class="clearfix">
		                <div class="hovereffect clearfix" >
		                    <?if(isset($productImageData->image) && $productImageData->image!=''){ ?>
                                <img src="<?=PRODUCT_IMAGE_PATH?>/<?=$productImageData->image?>"  title="Click here for more information" alt="Desi temple hair" style="cursor: pointer;">
                            <? }else{ ?>
                                <img src="images/sample1.png"  title="Desi temple hair" alt="Desi temple hair" style="cursor: pointer;">
                            <? } ?>
		                </div>
		                </div>
		                
		                <div class="clearfix caretext">
		                    <div class="productname"><?=$record['productName']?></div><br>
		                    <div class="productrate">&dollar; <?=$productOptions->productCost?></div>
		                    <div class="hoverablebuy productbuy">Buy Now</div>
		                </div>
		            </a>
		        </div>   
		       
		<?php }}else{?>
			<div>No Product Found</div>

		<?}?>

		<?
    }


    function getproductSingleOptionAttributes($productId){
        $db = new DB();
        $records = array();
        $attributes = array();
        $attributeValues = array();
        $productId = $db->filter($productId);      
        $query = "SELECT id FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active ='1'";
        $prodOptCount = $db->num_rows($query);
        if($prodOptCount == 1){
              $attributeDisabled = 'No';
              $query = "SELECT * FROM ".PRODUCT_ATTRIBUTES." WHERE productId='".$productId."' AND active ='1'";
              if($db->num_rows($query) > 0 ){
                $records = $db->get_results($query, true);
                foreach ($records as $record) {
                  $attributes[] =  $record->attributeId;
                  $attributeValues[] =  $record->attributeValueId;
                }
                $attributes = array_unique($attributes);
                $attributeIds = implode(',', $attributes);
                $attributeValues = array_unique($attributeValues);
                $attributeValueIds = implode(',', $attributeValues);
                  $query1 = "SELECT * FROM ".ATTRIBUTES." WHERE id IN (".$attributeIds.") AND active ='1' ORDER BY id ASC";
                  $attrCount = $db->num_rows($query1);
                  if($attrCount > 0 ){
                  $records1 = $db->get_results($query1, true);
                  $i=1;
                  foreach ($records1 as $record1) { 
                    $records2 = $db->get_row("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$record1->id."' AND id IN (".$attributeValueIds.") AND active='1'",true);
                    if(!empty($records2)){                                  
                  ?>
                  <div id="productAtt_<?=$i?>">
                  <label style="width:25% !important; display:inline-block !important"><?=$record1->attributeName;?>:</label>                  
                      <span><?php  echo $records2->attributeValue; ?></span>                 
                  </div>                   
                  <?php
                   }
                   $i++;
                  }
                  $query1 = "SELECT id,productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active ='1'";
                  $productOption = $db->get_row($query1,true);                  //pre($productOption);
                  if(isset($productOption) && count($productOption) == 1){ 
                              
                             ?>
                              <!-- <a href="javascript:void(0);" onclick="addToCart('<?=$productId?>','<?=$productOption->id?>');" class="addToCartLink btn btn-primary" >Add To Cart
                              <span id="addToCartError"></span>
                            </a> -->
                            <div class="ps-block center">
                            	<button type="submit" name="addtocart" id="addtocart" onclick="addToCart('<?=$productId?>','<?=$productOption->id?>');" class="btn bbox reg cart add_to_cart" >

                                            <span class="fleft add_to_cart"><strong id="totalAmount" class="trans"><?php $this->getProductPrice($productId,$productOption->id); ?></strong></span>
                                          <?php  if($productOption->productStock > 0 ){ ?>
                                            <span class="fright add_to_cart" >Add to Cart</span>
                                            <?php }else{ ?>
                                            <p class="productSold"><b style="color:#FF0000">Out of stock</b></p>
                                            <?php } ?>
                                        </button>
                                        <span id="addToCartError"></span>
                             </div>           
                            <?php
                        
                    }else{ ?>
                      <p class="productSold"><b style="color:#FF0000">Out of stock</b> </p>
                    <?php
                    }
              }else{
                 $attributeDisabled = 'Yes';
              }
              return true;  
            }else{
              $attributeDisabled = 'Yes';
            }               
        }else{
          return false;
          exit;
        }
    }

    function getproductOptionAttributes($productId){
        if(!$this->getproductSingleOptionAttributes($productId)){         
       
        $db = new DB();
        $records = array();
        $attributes = array();
        $attributeValues = array();
        $productId = $db->filter($productId);
        $attributeDisabled = 'No';
        $query = "SELECT attributeId,attributeValueId FROM ".PRODUCT_ATTRIBUTES." WHERE productId='".$productId."' AND active ='1'";
        if($db->num_rows($query) > 0 ){
          $records = $db->get_results($query, true);
          foreach ($records as $record) {
            $attributes[] =  $record->attributeId;
            $attributeValues[] =  $record->attributeValueId;
          }
          $attributes = array_unique($attributes);                   
          $attributeIds = implode(',', $attributes);
          $attributeValues = array_unique($attributeValues);
          $attributeValueIds = implode(',', $attributeValues);
            $query1 = "SELECT * FROM ".ATTRIBUTES." WHERE id IN (".$attributeIds.") AND active ='1' ORDER BY FIELD(id,".$attributeIds.")";
            $attrCount = $db->num_rows($query1);
            if($attrCount > 0 ){
            $records1 = $db->get_results($query1, true);
            $i=1;
            foreach ($records1 as $record1) { 
              $records2 = $db->get_results("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$record1->id."' AND id IN (".$attributeValueIds.") AND active='1' ORDER BY order_no");
              if(!empty($records2)){   
                           
            ?>
            <div id="productAtt_<?=$i?>">
            <label style="width:25% !important; display:inline-block !important"><?=$record1->attributeName;?>:</label> 
            <?php if(count($records2) ==1){ ?>
                <span><?php foreach($records2 as $record2){ echo $record2['attributeValue']; }?></span>
             <?php  }else{ ?>
             <select id="productAttSel_<?=$i?>" class="form-control selectAttOpt" data-product="<?=$productId?>" data-attribute="<?=$record1->id?>" data-position="<?=$i?>" data-attrCount="<?=$attrCount?>" onchange="getProductNextAttribute('<?=$productId?>','<?=$record1->id?>','<?=$i?>','<?=$attrCount?>',this.value,'<?=$attributeIds?>');" style="width:70% !important; display:inline-block !important" >
                <option value="">Select <?=$record1->attributeName?></option>
                <?php foreach($records2 as $record2){ ?>
                   <option value="<?=$record2['id']?>"><?=$record2['attributeValue']?></option>
                <?php } ?>
            </select> 
            <?php } ?>
            </div> 
            
            <?php
             }
             $i++;
            }
        }else{
           $attributeDisabled = 'Yes';
        }
      }else{
        $attributeDisabled = 'Yes';
      }

      if( $attributeDisabled == 'Yes'){
        $query1 = "SELECT id,productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active ='1' AND productWeight=(SELECT max(cast(productWeight as unsigned)) FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active ='1')";
      $productOption = $db->get_row($query1,true);

      //pre($productOption);
      if(isset($productOption) && count($productOption) == 1){ 
           ?><div class="ps-block center">
             <button type="submit" name="addtocart" id="addtocart" onclick="addToCart('<?=$productId?>','<?=$productOption->id?>');" class="btn bbox reg cart add_to_cart" >

                                            <span class="fleft add_to_cart"><strong id="totalAmount" class="trans"><?php $this->getProductPrice($productId,$productOption->id); ?></strong></span>
                                          <?php  if($productOption->productStock > 0 ){ ?>
                                            <span class="fright add_to_cart" >Add to Cart</span>
                                            <?php }else{ ?>
                                            <p class="productSold"><b style="color:#FF0000">Out of stock</b></p>
                                            <?php } ?>
                                        </button>
                                        <span id="addToCartError"></span>
                </div>                        
               <?php
               /*   $this->getProductPrice($productId,$productOption->id);
                 if($productOption->productStock > 0 ){ ?>
                  <a href="javascript:void(0);" onclick="addToCart('<?=$productId?>','<?=$productOption->id?>');" class="addToCartLink btn btn-primary" >Add To Cart
                  <span id="addToCartError"></span>
                </a>
                <?php }else{ ?>
                <p class="productSold">SOLD - Contact Us to get a similar product</p>
                <?php } */
           
        }else{ ?>
          <p class="productSold"><b style="color:#FF0000">Out of stock</b> </p>
        <?php
        }
       
        } 
        ?>
      <?php
      }
    }

    function getProductOptionByAttr(){
      $db = new DB();
      $productId = $db->filter($_POST['productId']);
      $attributeId = rtrim($db->filter($_POST['attributeId']),',');
      $attributeValueId = rtrim($db->filter($_POST['attributeValueId']),',');
      $attrIds = explode(',', $attributeId);
      $attrValIds = explode(',', $attributeValueId);
      
      //pre($attrIds);
      //pre($attrValIds);
      $countAttId = count($attrIds);
      for($i=0; $i<$countAttId;$i++){
        if($attrIds[$i]!=''&& $attrValIds[$i]!=''){
          if($optIdStr !=''){
           $queryLoop = "SELECT productOptionId FROM ".PRODUCT_ATTRIBUTES." WHERE productId='".$productId."'AND attributeId='".$attrIds[$i]."' AND attributeValueId='".$attrValIds[$i]."' AND active ='1' AND productOptionId IN(".$optIdStr.")";
          }else{
            $queryLoop = "SELECT productOptionId FROM ".PRODUCT_ATTRIBUTES." WHERE productId='".$productId."' AND attributeId='".$attrIds[$i]."' AND attributeValueId='".$attrValIds[$i]."' AND active ='1'";
          }
          if($db->num_rows($queryLoop) > 0 ){
            $optIds = array();
            $queryLoopRes = $db->get_results($queryLoop, true);
            foreach ($queryLoopRes as $queryLoopvalue) {
              $optIds[] = $queryLoopvalue->productOptionId;
            }
            $optIds = array_unique($optIds);
            $optIdStr = implode(',', $optIds);
          }
        }
      }
      if(isset($optIdStr) && $optIdStr!=''){ 
      $productOptionId = $optIds[0];
      $query1 = "SELECT id,productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND id IN(".$optIdStr.") AND active ='1' AND productWeight=(SELECT max(cast(productWeight as unsigned)) FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND id IN(".$optIdStr.") AND active ='1')";
      $productOption = $db->get_row($query1,true);

      //pre($productOption);
      if(isset($productOption) && count($productOption) == 1){        ?>   
               <div class="ps-block center">
               		<button type="submit" name="addtocart" id="addtocart" onclick="addToCart('<?=$productId?>','<?=$productOption->id?>');" class="btn bbox reg cart add_to_cart" >

                                            <span class="fleft add_to_cart"><strong id="totalAmount" class="trans"><?php $this->getProductPrice($productId,$productOption->id);?></strong></span>
                                          <?php  if($productOption->productStock > 0 ){ ?>
                                            <span class="fright add_to_cart" >Add to Cart</span>
                                            <?php }else{ ?>
                                            <p class="productSold"><b style="color:#FF0000">Out of stock</b></p>
                                            <?php } ?>
                                        </button>
                                        <span id="addToCartError"></span>
                </div>                        
             <?php /*    $this->getProductPrice($productId,$productOption->id);
                 if($productOption->productStock > 0 ){ ?>
                  <a href="javascript:void(0);" onclick="addToCart('<?=$productId?>','<?=$productOption->id?>');" class="addToCartLink btn btn-primary" >Add To Cart
                  <span id="addToCartError"></span>
                </a>
                <?php }else{ ?>
                <p class="productSold">SOLD - Contact Us to get a similar product</p>
                <?php } */
            // }
        }else{ ?>
          <p class="productSold"><b style="color:#FF0000">Out of stock</b> </p>
        <?php
        }     

      }          
    }

    function getProductAttributes(){
        $db = new DB();
        $records = array();
        $attributes = array();
        $attributeValues = array();
        $productOptionId = array();
        $productId = $db->filter($_POST['productId']);
        $attributeId = $db->filter($_POST['attributeId']);
        $attributeValueId = $db->filter($_POST['attributeValueId']);
        $query = "SELECT productOptionId FROM ".PRODUCT_ATTRIBUTES." WHERE productId='".$productId."' AND attributeId='".$attributeId."' AND attributeValueId='".$attributeValueId."' AND active ='1'";
        if($db->num_rows($query) > 0 ){
          $records = $db->get_results($query, true);
          foreach ($records as $record) {
            $productOptionId[] =  $record->productOptionId;
          }
          $productOptionId = array_unique($productOptionId);
          $productOptionIds = implode(',', $productOptionId);
          $query = "SELECT * FROM ".PRODUCT_ATTRIBUTES." WHERE productOptionId IN (".$productOptionIds.") AND attributeId !='".$attributeId."' AND active ='1'";
          if($db->num_rows($query) > 0 ){
            $records = $db->get_results($query, true);
            foreach ($records as $record) {
              $attributes[] =  $record->attributeId;
              $attributeValues[] =  $record->attributeValueId;
            }
          }
          $attributes = array_unique($attributes);
          $attributeIds = implode(',', $attributes);
          $attributeValues = array_unique($attributeValues);
          $attributeValueIds = implode(',', $attributeValues);
            $query1 = "SELECT * FROM ".ATTRIBUTES." WHERE id IN (".$attributeIds.") AND active ='1'";
            if($db->num_rows($query1) > 0 ){
            $records1 = $db->get_results($query1, true);
            foreach ($records1 as $record1) { 
              $records2 = $db->get_results("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$record1->id."' AND id IN (".$attributeValueIds.") AND active='1'");
              if(!empty($records2)){
            ?>
            <div id="productAtt_<?=$record1->id?>">
            <label style="width:25% !important; display:inline-block !important"><?=$record1->attributeName;?>:</label> 
             <select class="form-control selectAttOpt" style="width:70% !important; display:inline-block !important" onchange="getProductOptionByAttr('<?=$productId?>','<?=$record1->id;?>',this.value);getProductAttributes('<?=$productId?>','<?=$record1->id;?>',this.value);">
                <option value="">Select <?=$record1->attributeName?></option>
                <? foreach($records2 as $record2){ ?>
                   <option value="<?=$record2['id']?>"><?=$record2['attributeValue']?></option>
                <? } ?>
            </select> 
            </div> 
            <?php
             }
            }
        }
      } 
    }

    function getProductNextAttribute(){
        $db = new DB();
        $records = array();
        $attributes = array();
        $attributeValues = array();
        $productOptionId = array();
        $curAttributeId = array();
        $productId = $db->filter($_POST['productId']);
        $attributeId = $db->filter($_POST['attributeId']);
        $attributeValueId = $db->filter($_POST['attributeValueId']);
        
        $nextPos = $db->filter($_POST['nextPos']);
        $attrCount = $db->filter($_POST['attrCount']);
        $attributeIds = $db->filter($_POST['attributeIds']);
        $curAttributeId = explode(',', $attributeIds);
        $curAttrIdPos = $nextPos-1;
        $curAttrId = $curAttributeId[$curAttrIdPos];
        if($productId !='' && $attributeId !='' && $attributeValueId !=''){
            $query = "SELECT * FROM ".ATTRIBUTES." WHERE active='1' AND id = '".$curAttrId."'";
            if($db->num_rows($query) > 0 ){
              $nextAttRes = $db->get_row($query,true);
              $nextAttId = $nextAttRes->id;
              $query = "SELECT productOptionId FROM ".PRODUCT_ATTRIBUTES." WHERE productId='".$productId."' AND attributeId='".$attributeId."' AND attributeValueId='".$attributeValueId."' AND active ='1'";
              if($db->num_rows($query) > 0 ){
                $records = $db->get_results($query, true);
                foreach ($records as $record) {
                  $productOptionId[] =  $record->productOptionId;
                }
                $productOptionId = array_unique($productOptionId);
                $productOptionIds = implode(',', $productOptionId);
                $query = "SELECT * FROM ".PRODUCT_ATTRIBUTES." WHERE productOptionId IN (".$productOptionIds.") AND attributeId ='".$nextAttId."' AND active ='1'";
                if($db->num_rows($query) > 0 ){
                  $records = $db->get_results($query, true);
                  foreach ($records as $record) {
                    $attributeValues[] =  $record->attributeValueId;
                  }
                $attributeValues = array_unique($attributeValues);
                $attributeValueIds = implode(',', $attributeValues);
                $query2 = "SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$nextAttId."' AND id IN (".$attributeValueIds.") AND active='1' ORDER BY order_no";
                if($db->num_rows($query2) > 0 ){
                  $records2 = $db->get_results($query2);
                    if(!empty($records2)){
                  ?>
                   <div id="productAtt_<?=$nextPos?>">
                    <label style="width:25% !important; display:inline-block !important"><?=$nextAttRes->attributeName;?>:</label> 
                     <select id="productAttSel_<?=$nextPos?>" class="form-control selectAttOpt" data-product="<?=$productId?>" data-attribute="<?=$nextAttId?>" data-position="<?=$nextPos?>" data-attrcount="<?=$attrCount?>" style="width:70% !important; display:inline-block !important" onchange="getProductNextAttribute('<?=$productId?>','<?=$nextAttId?>','<?=$nextPos?>','<?=$attrCount?>',this.value,'<?=$attributeIds?>');" >
                         <!-- <option value="">Select <?=$nextAttRes->attributeName?></option> -->
                        <? foreach($records2 as $record2){ ?>
                           <option value="<?=$record2['id']?>"><?=$record2['attributeValue']?></option>
                        <? } ?>
                    </select> 
                  </div> 

                  <?php
                   }
                }   
              } 
            }
          }
        } 
    }


     function getProductPrice($productId,$productOptionId){
            $db = new DB();
            $records = array();
            $dateTime  = date('Y-m-d H:i:s', time());
            $productDiscount = 0;
            
            $query = "SELECT productCost,productMRP FROM ".PRODUCT_OPTIONS." WHERE id='".$db->filter($productOptionId)."' AND active ='1'";
            if($db->num_rows($query) > 0 ){
               $records = $db->get_row($query, true);
                   if($productDiscount == 0){
                        if($records->productDiscount>0){
                            $discountPrice = $records->productCost - ($records->productCost * ($records->productDiscount / 100));
                            ?>
                            <span class="productPrice oldPrice">&dollar;<?=number_format($records->productCost,2);?></span>
                            <span class="productPrice discountPrice"><span class="discountText">Discount(<?=$records->productDiscount?>%)</span>&nbsp; <span class="newPrice">&dollar;<?=number_format($discountPrice,2);?></span> </span>
                        <?php }else{ 
                            if($records->productMRP > $records->productCost){
                            ?>
                            <span class="productPrice oldPrice"><span class="mrp">MRP</span>&nbsp; &dollar;<?=number_format($records->productMRP,2);?></span>
                            <span class="productPrice"><span class="newPrice">&dollar;<?=number_format($records->productCost,2);?></span></span>
                            <?php }else{?>
                            <span class="productPrice"><span class="">&dollar;<?=number_format($records->productCost,2);?></span></span>
                       <?php }
                          }
                   }else{
                        $discountPrice = $records->productCost - ($records->productCost * ($productDiscount / 100));
                    ?>
                        <span class="productPrice oldPrice">&dollar;<?=number_format($records->productCost,2);?></span>
                        <span class="productPrice discountPrice"><span class="discountText">Discount(<?=$productDiscount?>%)</span>&nbsp; <span class="newPrice">&dollar;<?=number_format($discountPrice,2);?></span></span>
                 <?php  }
            }
    }

}