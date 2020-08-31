<?
require_once('setup/config.php');
require_once('setup/common.functions.php');
require_once('classes/class.db.php');
require_once('classes/class.oauth.php');
require_once('classes/class.report_handler.php');

//Initiate the class
//$db = new DB();

class adminEnd {

	function adminEnd() {
		$db = new DB();
	}

	function displayContent($page){

		$oauth = new oauth();
		$report= new report_handler();

		switch($page){
		
			case 'login':
				 if($oauth->authUser()){
					$this->welcomePage();
				 }else{
					$this->landingPage();
				 }
			break;

			case 'home':
				if($oauth->authUser()){
				  	$this->welcomePage();
				}else{
					$this->redirect('/index.php?page=logout'); 
				}
			break;

            case 'manageProducts':
                if($oauth->authUser()){
                    $this->manageProducts();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;



            case 'addNewProduct':
                if($oauth->authUser()){
                    $this->addNewProduct();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'manageCategories':
                if($oauth->authUser()){
                    $this->manageCategories();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'addNewCategory':
                if($oauth->authUser()){
                    $this->addNewCategory();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'editCategory':
                if($oauth->authUser() && $_REQUEST['categoryId']!=''){
                    $this->editCategory($_REQUEST['categoryId']);
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'editProduct':
                if($oauth->authUser() && $_REQUEST['productId']!=''){
                    $this->editProduct($_REQUEST['productId']);
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'manageOrders':
                if($oauth->authUser()){
                    $this->manageOrders();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            default :
                ?>
                <br/><div class="alert alert-danger">Sorry, Access Denied!</div>
                <?
            break;

		}
	
	}


	function redirect($url,$time=0)	{
		if($time==0){
			if(!headers_sent()) {
				header('Location: http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '' . $url);
			}
			else{
				die('Could not redirect; Headers already sent.');
			}
		}
		else{
			if(!headers_sent()){
				header('Refresh: $time; URL="http://'.$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $url.'"');
				echo "<p>You are being redirected !</p>(If your browser doesn't support this, <a href=\"http://".$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $url."\">click here</a>)";
			}
			else{
				die('Could not redirect; Headers already sent.');
			}
		}
	}


	function loginPage(){
		?>
			<form action="" name="login_form" method="post">			
			<input type="hidden" name="action" value="login" />	
			<fieldset>
			    <div class="form-group">
			        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
			    </div>
			    <div class="form-group">
			        <input class="form-control" placeholder="Password" name="password" type="password" value="">
			    </div>
			   <!--  <div class="checkbox">
			        <label>
			            <input name="remember" type="checkbox" value="Remember Me">Remember Me
			        </label>
			    </div> -->
			    <!-- Change this to a button or input when using this as a form -->
			    <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
			    <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
			</fieldset>
			</form>
		<?	
	}


	function welcomePage(){
		?>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>New Messages!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- /.row -->
         
		<?
	}


    function manageCategories(){
            $db = new DB();

            $categories = $this->getAllProductCategories();

        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Categories
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Parent Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                     if(count($categories)>0){
                                     foreach ($categories as $category) {

                                            if($category['parentCategory']>0){
                                                   $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$category['parentCategory']."'";
                                                   $parentCategoryData = $db->get_row( $qry, true );
                                            }


                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$category['categoryName']?></td>
                                            <td><?=$parentCategoryData->categoryName?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editCategory&categoryId=<?=$category['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                             </td>
                                        </tr>
                                     <? } 
                                 } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
            <script>
            $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive:true,
                    "columnDefs": [
                                { "orderable": false, "targets": 2 }
                             ]
            });
            });
            </script>


        <?
    }

    function addNewCategory(){

            $categories = $this->getAllProductCategories();
        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Category
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveNewCategory" /> 
                                        <div class="form-group">
                                            <label>Parent Category</label>

                                            <?
                                                $this->categoryTree($categories, 0, 0, '-'); 
                                            ?>
                                           <select name="parentCategory" class="form-control">
                                                <option value="0">ROOT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input class="form-control" name="categoryName" value="" required>                                            
                                        </div>
                                       <div class="form-group">
                                            <label>Active?</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" checked="" value="1" id="optionsRadios1" name="active">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" id="optionsRadios2" name="active">No
                                                </label>
                                            </div>
                                            
                                        </div>                                     
                                        
                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <!-- <button type="reset" class="btn btn-default">Reset Button</button> -->
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


        <?
    }


    function saveNewCategory(){
        $db = new DB();

        $data = array(
            'categoryName' => $_POST['categoryName'],
            'parentCategory' => $_POST['parentCategory'],
            'active' => $_POST['active']
        );

        $rs = $db->insert(PRODUCT_CATEGORIES, $data);

        if($rs){
            return true;
        }

    }

    function getAllProductCategories(){
        
        $db = new DB();

        $query = "SELECT * FROM ".PRODUCT_CATEGORIES."";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $categories[]=$row;
        }

        return $categories;

    }




    function categoryTree(&$output, $preselected, $parent=0, $indent=""){

        $db = new DB();

        $query = "SELECT id, categoryName FROM ".PRODUCT_CATEGORIES." WHERE parentCategory=".$parent." AND active='1'";

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["categoryName"] . "</option>";
               
                if($row["id"] != $parent){
                  $this->categoryTree($output, $preselected, $row["id"], $indent . "-");
                }

        }

    }


    function editCategory($categoryId){

            $categories = $this->getAllProductCategories();

            $categoryData = $this->getCategoryById($categoryId);

           // pre($categoryData);
        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Category
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateCategory" /> 
                                        <div class="form-group">
                                            <label>Parent Category</label>

                                            <?
                                                $this->categoryTree($categories, $categoryData->parentCategory, 0, '-'); 
                                            ?>
                                           <select name="parentCategory" class="form-control">
                                                <option value="0">ROOT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input class="form-control" name="categoryName" value="<?=$categoryData->categoryName?>" required>                                            
                                        </div>
                                       <div class="form-group">
                                            <label>Active?</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="1" id="optionsRadios1" <? if($categoryData->active==1){?> checked='checked' <?}else{ ?> <? } ?> name="active">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" id="optionsRadios2" <? if($categoryData->active==0){?> checked='checked' <?}else{ ?> <? } ?> name="active">No
                                                </label>
                                            </div>
                                            
                                        </div>                                     
                                        
                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <!-- <button type="reset" class="btn btn-default">Reset Button</button> -->
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


        <?
    }


    function getCategoryById($categoryId){
        $db = new DB();

        $query = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$categoryId."'";
        if($db->num_rows( $query ) > 0 ){
           return $db->get_row( $query, true );
        }else{
           return false;
        }

    }


    function updateCategory(){
        $db = new DB();

        $update = array(
            'categoryName' => $_REQUEST['categoryName'], 
            'parentCategory' => $_REQUEST['parentCategory'],
            'active' => $_REQUEST['active']

        );

        $where_clause = array(
            'id' => $_REQUEST['categoryId']
        );

        $updated = $db->update(PRODUCT_CATEGORIES, $update, $where_clause, 1 );

        if($updated){
            return true;
        }else{
            return false;
        }

    }


// Products


    function manageProducts(){
            
            $db = new DB();
            
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Product Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php
                                        $query = "SELECT * FROM ".PRODUCTS;
                                        $results = $db->get_results($query);
                                    
        
                                        foreach($results as $row){

                                            if($row['categoryId']>0){
                                                   $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$row['categoryId']."'";
                                                   $categoryData = $db->get_row( $qry, true );
                                            }


                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$row['productName']?></td>
                                            <td><?=$categoryData->categoryName?></td>
                                            <td><?=$row['productStock']?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editProduct&productId=<?=$row['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                             </td>
                                        </tr>
                                     <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
            <script>
            $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive:true,
                    "columnDefs": [
                                { "orderable": false, "targets": 2 }
                             ]
            });
            });
            </script>


        <?
    }


    function addNewProduct(){

            $categories = $this->getAllProductCategories();

            // Weight Units
            $weightUnits = $this->getProductAttributeValsByWeight();

        ?>

        <script type="text/javascript">

            var costPerWtVal=0;

            function addMoreCostsPerWeightElement(content='moreWeights'){

                costPerWtVal=costPerWtVal + 1;
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+costPerWtVal;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+="<input type='number' min='1' class='form-control' name='productWeight[]' value='' style='width:25% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' style='width:15% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['productAttributeId']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select>&nbsp;<input type='number' min='1' class='form-control' name='productCost[]' value='' style='width:20% !important; display:inline !important' placeholder='Cost' required>&nbsp;<input type='number' min='1' class='form-control' name='productStock[]' value='' style='width:15% !important; display:inline !important' placeholder='Stock' required>&nbsp;<input type='date' class='form-control expiryDate' name='expiryDate[]' value='' style='width:15% !important; display:inline !important' placeholder='Expiry Date' readonly><br/><br/>";
                contentID.appendChild(newTBDiv);
                
                $(function(){
                    var nowDate = new Date();
                    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

                    $('.expiryDate').datepicker({
                        startDate: today,
                        autoclose:true,
                        format:'dd/mm/yyyy'
                    });
                });

            }

            function removeCostsPerWeightElement(content){
                
                if(costPerWtVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+costPerWtVal));
                    costPerWtVal = costPerWtVal-1;
                }
            }

            var upload_number = 1;

            function addFileInput() {

                var d = document.createElement("div");
                var file = document.createElement("input");
                file.setAttribute("type", "file");
                file.setAttribute("name", "productPhotos[]");
                file.setAttribute("class", "file_1");
                file.setAttribute("accept", "image/png, image/jpeg");
                d.appendChild(file);
                document.getElementById("moreUploads").appendChild(d);
                
                upload_number++;
                document.getElementById("uploadsNeeded").value=upload_number;
            
            }

        </script>

        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
        
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Product
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <form action="" name="product_form" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="saveNewProduct" /> 
                                        
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="productName" value="" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Category</label>

                                            <?
                                                $this->categoryTree($categories, 0, 0, '-'); 
                                            ?>
                                           <select name="categoryId" class="form-control" required>
                                                <option value="">SELECT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Cost/Weight(Qty)</label><br/>
                                            <input type="number" min="1"  class="form-control" name="productWeight[]" value="" style="width:25% !important; display:inline !important" placeholder="Weight/Qty" required>
                                            <select class="form-control" name="productUnit[]" style="width:15% !important; display:inline !important" required >
                                                <option value="">-Unit-</option>
                                                <? foreach($weightUnits as $weightUnit){ ?>
                                                   <option value="<?=$weightUnit['attributeValue']?>"><?=$weightUnit['attributeValue']?></option>
                                                <? } ?>   
                                                </select>  
                                            <input type="number" min="1" class="form-control" name="productCost[]" value="" style="width:20% !important; display:inline !important" placeholder="Cost" required>   
                                            <input type="number" min="0" class="form-control" name="productStock[]" value="" style="width:15% !important; display:inline !important" placeholder="Stock" required>
                                             <input type="date" class="form-control expiryDate" name="expiryDate[]" value="" style="width:15% !important; display:inline !important" placeholder="Expiry Date">   

                                            <a href="javascript:void(0);" onClick="addMoreCostsPerWeightElement('moreWeights');" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                            <a href="javascript:void(0);" onClick="removeCostsPerWeightElement('moreWeights');" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>

                                            <br/><br/>

                                            <div class='moreWeights' id="moreWeights">
                                            
                                            </div>  
                                            <br/>                                 

                                        <!-- <div class="form-group">
                                            <label>Product Stock</label>
                                            <input type="number" min="0" class="form-control" name="productStock" value="" >   
                                        </div> -->
                                                <script type="text/javascript">

                                                    $(function(){

                                                            var nowDate = new Date();
                                                            var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                                                            
                                                            $('.expiryDate').datepicker({
                                                                    startDate: today,
                                                                    autoclose:true,
                                                                    format:'dd/mm/yyyy'
                                                             });
                                                    });

                                                </script>

                                         <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" rows="3" name="productDescription"></textarea>
                                        </div>


                                         <div class="form-group">
                                            <label>Product Photos</label><br/>
                                            <input type="file" name="productPhotos[]" accept="image/png, image/jpeg" onChange="document.getElementById('moreUploadsLink').style.display = 'block';" style="width:50% !important; display:inline !important"> 
                                             <a href="javascript:addFileInput();" title="Upload more photos"><i class="fa fa-plus-square fa-lg"></i></a>
                                             <div id="moreUploads"></div>                                           
                                             <input type="hidden" id="uploadsNeeded" name="uploadsNeeded" value="">
                                        </div>
                                     
                                       <div class="form-group">
                                            <label>Active?</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" checked="" value="1" id="optionsRadios1" name="active">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" id="optionsRadios2" name="active">No
                                                </label>
                                            </div>
                                            
                                        </div>                                     
                                        
                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <!-- <button type="reset" class="btn btn-default">Reset Button</button> -->
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    <?
    }

    function getProductById($productId){
        $db = new DB();

        $query = "SELECT * FROM ".PRODUCTS." WHERE id='".$productId."'";
        if($db->num_rows( $query ) > 0 ){
           return $db->get_row( $query, true );
        }else{
           return false;
        }

    }


    function editProduct($productId){

            $db = new DB();

            $categories = $this->getAllProductCategories();

            // Weight Units
            $weightUnits = $this->getProductAttributeValsByWeight();

            $productData = $this->getProductById($productId);

           // pre($productData);

            $query = "SELECT * FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active='1'";
            $productOptions = $db->get_results($query);


            $query = "SELECT * FROM ".PRODUCT_IMAGES." WHERE productId='".$productId."'";
            $productPhotos = $db->get_results($query);

            // pre($productPhotos);
     


        ?>

        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">

            var costPerWtVal=0;

            function addMoreCostsPerWeightElement(content='moreWeights'){
                var costPerWtVal = parseInt($('#costPerWtCount').val());

                costPerWtVal=costPerWtVal + 1;
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+costPerWtVal;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+="<input type='number' min='1' class='form-control' name='productWeight[]' value='' style='width:25% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' style='width:15% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['productAttributeId']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select>&nbsp;<input type='number' min='1' class='form-control' name='productCost[]' value='' style='width:15% !important; display:inline !important' placeholder='Cost' required>&nbsp;<input type='number' min='1' class='form-control' name='productStock[]' value='' style='width:15% !important; display:inline !important' placeholder='Stock' required>&nbsp;<input type='text' class='form-control expiryDate' name='expiryDate[]' value='' style='width:20% !important; display:inline !important' placeholder='Expiry Date' readonly><br/><br/>";
                contentID.appendChild(newTBDiv);
                $('#costPerWtCount').val(costPerWtVal);

                var nowDate = new Date();
                var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                
                $('.expiryDate').datepicker({
                        startDate: today,
                        autoclose: true
                 });



            }

            function removeCostsPerWeightElement(content){
                
                var costPerWtVal = parseInt($('#costPerWtCount').val());

                if(costPerWtVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+costPerWtVal));
                    costPerWtVal = costPerWtVal-1;
                    $('#costPerWtCount').val(costPerWtVal);
                }
            }

            var upload_number = 1;

            function addFileInput() {

                var d = document.createElement("div");
                var file = document.createElement("input");
                file.setAttribute("type", "file");
                file.setAttribute("name", "productPhotos[]");
                file.setAttribute("class", "file_1");
                file.setAttribute("accept", "image/png, image/jpeg");
                d.appendChild(file);
                document.getElementById("moreUploads").appendChild(d);
                
                upload_number++;
                document.getElementById("uploadsNeeded").value=upload_number;
            
            }

            function deleteProductOption(productOptionId){

                if(confirm("Are you sure you want to delete this?")){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=deleteProductOption&productOptionId="+productOptionId,
                            success: function(msg){       
                                if(msg=='success'){
                                     $('.option_'+productOptionId).css('display', 'none');
                                }                                                               
                            }
                        });
                }
            }

            function deleteProductPhoto(productImageId){

                    if(confirm("Are you sure you want to delete this?")){
                        $.ajax
                            ({
                                type: "POST",
                                url: "ajxHandler.php",
                                data: "action=deleteProductPhoto&productImageId="+productImageId,
                                success: function(msg){       

                                    if(msg=='success'){
                                        $('#row_'+productImageId).css('display', 'none');
                                    }                                                               
                                }
                            });
                    }
            }

        </script>
        
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Product Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <form action="" name="product_form" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="updateProduct" /> 
                                         <input type="hidden" name="productId" value="<?=$productData->id?>" /> 
                                        
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="productName" value="<?=$productData->productName?>" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Category</label>

                                            <?
                                                $this->categoryTree($categories, $productData->categoryId, 0, '-'); 
                                            ?>
                                           <select name="categoryId" class="form-control" required>
                                                <option value="">SELECT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label>Product Cost/Weight(Qty)</label><br/>
                                            
                                            <? 
                                            $k=1;
                                            foreach ($productOptions as $productOption) { 
                                            
                                                $productOptionId= $productOption['id'];
                                                
                                            ?>
                                            <div class="option_<?=$productOptionId?>" id="moreWeights<?=$k?>">
                                            <input type="number" min="1"  class="form-control" name="productWeight[]" value="<?=$productOption['productWeight']?>" style="width:25% !important; display:inline !important" placeholder="Weight/Qty" required>
                                            <select class="form-control" name="productUnit[]" style="width:15% !important; display:inline !important" required >
                                                <option value="">-Unit-</option>
                                                <? foreach($weightUnits as $weightUnit){ ?>
                                                   <option value="<?=$weightUnit['attributeValue']?>" <? if($productOption['productUnit']==$weightUnit['attributeValue']){ ?> selected <? } ?> ><?=$weightUnit['attributeValue']?></option>
                                                <? } ?>   
                                                </select>  
                                            <input type="number" min="1" class="form-control" name="productCost[]" value="<?=$productOption['productCost']?>" style="width:15% !important; display:inline !important" placeholder="Cost" required>   
                                            <input type="number" min="0" class="form-control" name="productStock[]" value="<?=$productOption['productStock']?>" style="width:15% !important; display:inline !important" placeholder="Stock" required>   

                                            <input type="text" class="form-control expiryDate" name="expiryDate[]" value="<?=($productOption['expiryDate']=='0000-00-00')?'':$productOption['expiryDate']?>" style="width:20% !important; display:inline !important" placeholder="Expiry Date" readonly>   
                                            <? if($k==1){ ?>
                                            
                                                <a href="javascript:void(0);" onClick="addMoreCostsPerWeightElement('moreWeights');" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                                <a href="javascript:void(0);" onClick="removeCostsPerWeightElement('moreWeights');" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>
                                                
                                            <? }else{?>
                                                
                                                <a href="javascript:void(0);" onClick="deleteProductOption('<?=$productOptionId?>');" Title="Delete Option"><i class="fa fa-trash-o fa-lg"></i></a>
                                                
                                            <? } ?>
                                             <br/><br/> </div>
                                             <?  
                                             $k++;
                                         } ?>
                                          
                                            <input type="hidden" id="costPerWtCount" name="costPerWtCount" value="<?=count($productOptions)?>">
                                            <div class='moreWeights' id="moreWeights">
                                            
                                            </div>  
                                            <br/>                                 

                                            <script type="text/javascript">

                                                    $(function(){

                                                            var nowDate = new Date();
                                                            var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                                                            
                                                            $('.expiryDate').datepicker({
                                                                    startDate: today,
                                                                    autoclose:true
                                                             });
                                                    });

                                                </script>
                                        <!-- <div class="form-group">
                                            <label>Product Stock</label>
                                            <input type="number" min="0" class="form-control" name="productStock" value="<?=$productData->productStock?>" >   
                                        </div> -->

                                         <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" rows="3" name="productDescription"><?=$productData->productDescription?></textarea>
                                        </div>


                                         <div class="form-group">
                                            <label>Product Photos</label><br/>
                                            <input type="file" name="productPhotos[]" accept="image/png, image/jpeg" onChange="document.getElementById('moreUploadsLink').style.display = 'block';" style="width:50% !important; display:inline !important"> 
                                             <a href="javascript:addFileInput();" title="Upload more photos"><i class="fa fa-plus-square fa-lg"></i></a>
                                             <div id="moreUploads"></div>                                           
                                             <input type="hidden" id="uploadsNeeded" name="uploadsNeeded" value="">
                                        </div>


                                            <?php foreach ($productPhotos as $productPhoto) { 

                                                  $productImageId = $productPhoto['id'];
                                                ?>
                                            <div class="row" id="row_<?=$productImageId?>">
                                                <img src="<?=APP_URL?>/productFiles/images/thumb/<?=$productPhoto['image']?>" title="<?=$productData->productName?>">
                                                 <a href="javascript:void(0);" onClick="deleteProductPhoto('<?=$productImageId?>');" Title="Delete Photo"><i class="fa fa-trash-o fa-lg"></i></a>
                                                <br>
                                            </div>
                                            <? } ?>
                                       <div class="form-group">
                                            <label>Active?</label>
                                                <label class="radio-inline">
                                                    <input type="radio" <? if($productData->active=='1'){ ?> checked="" <? } ?> value="1" id="optionsRadios1" name="active"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="0" id="optionsRadios2"  <? if($productData->active=='0'){ ?> checked="" <? } ?>  name="active" class="radio-inline"> No
                                                </label>
                                            
                                        </div>                                     
                                        
                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <!-- <button type="reset" class="btn btn-default">Reset Button</button> -->
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    <?
    }


    function getProductAttributeValsByWeight(){
        $db = new DB();
        // productAttributeId=1 for weight

        $query = "SELECT * FROM ".PRODUCT_ATTRIBUTE_VALUES." WHERE productAttributeId='1'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $attrValues[]=$row;
        }

        return $attrValues;
    }



    function saveNewProduct(){

        $db = new DB();

        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

        // for now

        $_POST['supplierId'] = 1;

        $data = $_POST;
        $file = $_FILES;

        if($data['uploadsNeeded']==0 || $data['uploadsNeeded']==1){
            $uploadsNeeded = 2; 
        }else{
            $uploadsNeeded = $data['uploadsNeeded']; 
        }

        $dateTime = date('Y-m-d h:i:s');

        $date = date("shdmy");

        $data = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'productName' => $_POST['productName'],
            'productDescription' => $_POST['productDescription'],
            'dateTime' => $dateTime,
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId']
        );

        $rs = $db->insert(PRODUCTS, $data);

        $productId = $db->lastid();

        if($rs){

            $productWeight = $_POST['productWeight'];
            $productUnit = $_POST['productUnit'];
            $productCost   = $_POST['productCost'];
            $productStock   = $_POST['productStock'];
            $expiryDate   = $_POST['expiryDate'];

            $i=0;

            foreach($productWeight as $productWt){

                list($dd, $mm, $yy) = explode('/', $expiryDate[$i]);

                $expDate = $yy.'-'.$mm.'-'.$dd;


                $records = array(
                    'productId' => $productId,
                    'productWeight' => $productWeight[$i],
                    'productUnit' => $productUnit[$i],
                    'productCost' => $productCost[$i],
                    'productStock' => $productStock[$i],
                    'expiryDate' => $expDate,
                    'dateTime' => $dateTime
                );

                $inserted = $db->insert(PRODUCT_OPTIONS, $records);

                $i++;
            }


            if($inserted){

                    if(isset($uploadsNeeded)){

                        for($j = 0; $j < $uploadsNeeded; $j++){
                            
                            if(isset($file['productPhotos']['size'][$j]) && $file['productPhotos']['size'][$j] > 0){
                                
                                

                                $imagename = 'chitki_'.$date.'_'.$file['productPhotos']['name'][$j];
                                $imagename1 = SITE_URL."/productFiles/images/".$imagename; 
                                
                                $uploadedfile = $file['productPhotos']['tmp_name'][$j];
                                $filename = stripslashes($imagename);
                                $extension = getExtension($filename); // function
                                $extension = strtolower($extension);
                                
                                if($extension=="jpg" || $extension=="jpeg" ){
                                    $src = imagecreatefromjpeg($uploadedfile);
                                }else if($extension=="png"){
                                    $src = imagecreatefrompng($uploadedfile);
                                }else{
                                    $src = imagecreatefromgif($uploadedfile);
                                }
                                
                                list($width,$height)=getimagesize($uploadedfile);
                                
                                $newwidth=150;
                                $newheight=150;
                                $tmp=imagecreatetruecolor($newwidth,$newheight);
                                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                $filename = "productFiles/images/thumb/".$imagename;
                                imagejpeg($tmp,$filename,100);
                                
                                move_uploaded_file($file['productPhotos']['tmp_name'][$j], "productFiles/images/".$imagename);


                                $imageData = array(
                                    'productId' => $productId,
                                    'image'=>$imagename
                                );

                                $rs = $db->insert(PRODUCT_IMAGES, $imageData);
                            
                            }
                        }
                    }

                return true;
            }
        }


    }


    function deleteProductOption(){
        $db = new DB();

        $delete = array(
            'id' => $_POST['productOptionId']
        );

        $deleted = $db->delete(PRODUCT_OPTIONS, $delete, 1);
        
        if($deleted){
            echo 'success';
        }else{
            echo 'fail';
        }

    }




    function deleteProductPhoto(){
        $db = new DB();

        $delete = array(
            'id' => $_POST['productImageId']
        );

        $deleted = $db->delete(PRODUCT_IMAGES, $delete, 1);
        
        if($deleted){
            echo 'success';
        }else{
            echo 'fail';
        }

    }


function updateProduct(){

        $db = new DB();

        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());
        
        // for now
        $_POST['supplierId'] = 1;

        $data = $_POST;
        $file = $_FILES;
        $productId = $_POST['productId'];

        if($data['uploadsNeeded']==0 || $data['uploadsNeeded']==1){
            $uploadsNeeded = 2; 
        }else{
            $uploadsNeeded = $data['uploadsNeeded']; 
        }

        $dateTime = date('Y-m-d h:i:s');

        $date = date("shdmy");

        $updateData = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'productName' => $_POST['productName'],
            'productDescription' => $_POST['productDescription'],
            'dateTime' => $dateTime,
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId']
        );

        $where_clause = array(
            'id' => $productId
        );

        $updated = $db->update(PRODUCTS, $updateData, $where_clause, 1 );

        if($updated){

             // $delete = array(
             //    'productId' => $productId
             // );

             // $db->delete(PRODUCT_OPTIONS, $delete);

            //--update existing product options to inactive

            $inactiveData = array(
                'active' => '0',
                'dateTime' => $dateTime
            );

            $where_clause_inactive = array(
                'productId' => $productId
            );

            $db->update(PRODUCT_OPTIONS, $inactiveData, $where_clause_inactive);

            // $deleteFromCartIfOptionUpdated = array(
            //     'productId' => $productId
            //  );

            //  $db->delete(CART, $deleteFromCartIfOptionUpdated);

            //--


            $productWeight = $_POST['productWeight'];
            $productUnit = $_POST['productUnit'];
            $productCost   = $_POST['productCost'];
            $productStock   = $_POST['productStock'];
            $expiryDate   = $_POST['expiryDate'];

            $i=0;

            foreach($productWeight as $productWt){



                list($dd, $mm, $yy) = explode('/', $expiryDate[$i]);

                $expDate = $yy.'-'.$mm.'-'.$dd;

                $records = array(
                    'productId' => $productId,
                    'productWeight' => $productWeight[$i],
                    'productUnit' => $productUnit[$i],
                    'productCost' => $productCost[$i],
                    'productStock' => $productStock[$i],
                    'expiryDate' => $expDate
                );

                $inserted = $db->insert(PRODUCT_OPTIONS, $records);

                $i++;
            }


            if($inserted){

                    if(isset($uploadsNeeded)){

                        for($j = 0; $j < $uploadsNeeded; $j++){
                            
                            if(isset($file['productPhotos']['size'][$j]) && $file['productPhotos']['size'][$j] > 0){
                                
                                

                                $imagename = 'chitki_'.$date.'_'.$file['productPhotos']['name'][$j];
                                $imagename1 = SITE_URL."/productFiles/images/".$imagename; 
                                
                                $uploadedfile = $file['productPhotos']['tmp_name'][$j];
                                $filename = stripslashes($imagename);
                                $extension = getExtension($filename); // function
                                $extension = strtolower($extension);
                                
                                if($extension=="jpg" || $extension=="jpeg" ){
                                    $src = imagecreatefromjpeg($uploadedfile);
                                }else if($extension=="png"){
                                    $src = imagecreatefrompng($uploadedfile);
                                }else{
                                    $src = imagecreatefromgif($uploadedfile);
                                }
                                
                                list($width,$height)=getimagesize($uploadedfile);
                                
                                $newwidth=150;
                                $newheight=150;
                                $tmp=imagecreatetruecolor($newwidth,$newheight);
                                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                $filename = "productFiles/images/thumb/".$imagename;
                                imagejpeg($tmp,$filename,100);
                                
                                move_uploaded_file($file['productPhotos']['tmp_name'][$j], "productFiles/images/".$imagename);


                                $imageData = array(
                                    'productId' => $productId,
                                    'image'=>$imagename
                                );

                                $rs = $db->insert(PRODUCT_IMAGES, $imageData);
                            
                            }
                        }
                    }

                return true;
            }
        }else{
            return false;
        }

}


function manageOrders(){

        $db = new DB();

        $categories = $this->getAllProductCategories();
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Categories
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Parent Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php foreach ($categories as $category) {

                                            if($category['parentCategory']>0){
                                                   $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$category['parentCategory']."'";
                                                   $parentCategoryData = $db->get_row( $qry, true );
                                            }


                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$category['categoryName']?></td>
                                            <td><?=$parentCategoryData->categoryName?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editCategory&categoryId=<?=$category['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                             </td>
                                        </tr>
                                     <? } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
            <script>
            $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive:true,
                    "columnDefs": [
                                { "orderable": false, "targets": 2 }
                             ]
            });
            });
            </script>


        <?
}


}