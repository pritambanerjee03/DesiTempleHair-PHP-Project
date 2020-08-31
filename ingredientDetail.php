<?php 

    include('includes/header.inc.php');
    
    $db =  new DB();
    $products = new products();
    if(isset($_REQUEST['ingredientId']) && $_REQUEST['ingredientId']!=''){
        $ingredientId = base64_decode($_REQUEST['ingredientId']);
    }else{
        header('Location:'.APP_URL);
        exit;
    }

    include_once('actionHandler.php');
    include ('includes/header.php');

    $ingredientImage = $db->get_row("SELECT * FROM ".INGREDIENTS." 
                                                      WHERE id='".$ingredientId."'", true);
    // pre($ingredientImageData);
?>
            <!-- Title Bar -->

<div class="inner-container" >

    <div class="pickle-container">
        <?//if($db->num_rows( $query ) > 0){?>
        <div class="pickle-wrapper">
            
            <!-- Banner -->
            <div class="pickle-banner vcenter">
                <div class="demo">
                    <div class="item">            
                        <div class="clearfix" >
                            <div style="padding:10px;font-weight:bold;"><?=$ingredientImage->title?></div>
                            <ul id="image-gallery">
                               
                                <?if(isset($ingredientImage->image) && $ingredientImage->image!=''){ ?>
                                    <li data-thumb="<?=INGREDIENT_THUMBNAIL_PATH?>/<?=$ingredientImage->image?>"> <img src="<?=INGREDIENT_THUMBNAIL_PATH?>/<?=$ingredientImage->image?>"></li>
                                <?}?>
                               
                            </ul>

                        </div>

                    </div>

                </div>  
                <div style="padding:10px;text-align:justify;"><?=$ingredientImage->description?></div>
            </div>

            <!-- /Banner -->
        </div> 
    </div>
</div>     
    <?php include ('includes/footer.php');?>
</main>
</main >
<div class="modal-backdrop"></div>
</body>
</html>
