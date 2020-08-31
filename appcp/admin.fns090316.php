<?
require_once('setup/config.php');
require_once('setup/common.functions.php');
require_once('classes/class.db.php');
require_once('classes/class.oauth.php');
require_once('classes/class.report_handler.php');
require_once('classes/class.phpmailer.php');
require_once('classes/class.smtp.php');

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
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageProducts();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'orderProduct':
                if($oauth->authUser()){
                     if($oauth->authAccessLevel() == 'admin'){
                        $this->orderProduct();
                    }else{
                        $this->welcomePage();
                    }
                    
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'addNewProduct':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addNewProduct();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'manageCategories':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageCategories();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'addNewCategory':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addNewCategory();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'editCategory':
                if($oauth->authUser() && $_REQUEST['categoryId']!=''){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->editCategory($_REQUEST['categoryId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'editProduct':
                if($oauth->authUser() && $_REQUEST['productId']!=''){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->editProduct($_REQUEST['productId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'manageOrders':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       $this->manageOrders();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'manageUsersOrder':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       $this->manageUsersOrder($_REQUEST['userId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'manageCustomers':
                if($oauth->authUser()){
                    
                     if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       $this->manageCustomers();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'addNewOrder':
                if($oauth->authUser()){
                    if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       $this->addNewOrder();
                    }else{
                        $this->welcomePage();
                    }
                    
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            
            case 'viewOrderDetail':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       $this->viewOrderDetail($_REQUEST['orderId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'editOrderDetail':
                if($oauth->authUser()){

                     
                    if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       if( ($_REQUEST['orderStatus'] != 'Cancel') && ($_REQUEST['orderStatus'] != 'Pending')){
                            $report->setReport('error_message','Cannot edit confirmed order. Please cancel the order to edit.'); 
                            $this->redirect('/index.php?page='.$_REQUEST['prevPage'].'&orderId='.$_REQUEST['orderId']); //Redirect to the referrer page if there is one
                            exit;
                        }
                        $this->editOrderDetail($_REQUEST['orderId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            
            case 'manageSuppliers':
                if($oauth->authUser()){
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->manageSuppliers();
                    }else{
                        $this->welcomePage();
                    }
                    
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'addNewSupplier':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->addNewSupplier();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'editSupplier':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->editSupplier($_REQUEST['supplierId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'manageBills':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->manageBills();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            

            case 'newBill':
                if($oauth->authUser()){
                   
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->newBill();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'viewBills':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->viewBills($_REQUEST['product_supplyId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'manageBrand':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageBrand();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'addNewBrand':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addNewBrand();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'editBrands':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->editBrands();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
             case 'manageAdminUsers':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageAdminUsers();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;


            case 'addNewAdminUser':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addNewAdminUser();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'editAdminUsers':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->editAdminUsers();
                    }else{
                        $this->welcomePage();
                    }
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


    function redirect($url,$time=0) {
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
        $db = new DB();
        $oauth = new oauth();
        $newordersResult = $db->get_row("SELECT COUNT(id) AS neworders FROM order_details WHERE viewOrders ='0'", true);
        $neworders = $newordersResult->neworders;
        date_default_timezone_set("Asia/Calcutta");
        $todayTime = date('Y-m-d');
        $todayordersResult = $db->get_row("SELECT COUNT(id) AS todayorders FROM order_details WHERE dateTime >= '".$todayTime."'", true);
        $todayorders = $todayordersResult->todayorders;
        ?>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
            <?php if($oauth->authAccessLevel() == 'admin'){ ?>
            <div class="row">
                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$neworders?></div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="<?=APP_URL?>/index.php?page=manageOrders">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$todayorders?></div>
                                    <div>Today's Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <a href="<?=APP_URL?>/index.php?page=manageOrders">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </a>    
                            </div>
                        </a>
                    </div>
                </div>
               <!--  <div class="col-lg-3 col-md-6">
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
                </div> -->
            </div>
            <?php } ?>
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
                                    <form action="" name="login_form" method="post" role="form" enctype="multipart/form-data">            
                                         <input type="hidden" name="action" value="saveNewCategory" /> 
                                        <div class="form-group">
                                            <label>Parent Category</label>

                                            <?
                                                $this->categoryTree($categories, 0, 0, '-',''); 
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
                                            <label>Category image</label><br/>
                                            <input type="file" name="categoryImage" accept="image/png, image/jpeg" > 
                                             
                                        </div>
                                         <div class="form-group">
                                            <label>Category Mobile Icon</label><br/>
                                            <input type="file" name="categoryImageIcon" accept="image/png, image/jpeg"> 
                                             
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
        $imagename = '';
        $imageicon ='';
        $date = date("shdmy");
        if($_POST['parentCategory'] == 0){
            if(isset($_FILES['categoryImage']['size']) && $_FILES['categoryImage']['size'] > 0){
               
                $imagename = 'chitki_'.$date.'_'.$_FILES['categoryImage']['name'];
                $imagename1 = SITE_URL."/categoryFiles/images/".$imagename; 
                
                $uploadedfile = $_FILES['categoryImage']['tmp_name'];
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
                
                $newwidth=560;
                $newheight=400;
                $tmp=imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                $filename = "categoryFiles/images/thumb/".$imagename;
                imagejpeg($tmp,$filename,100);
                
                move_uploaded_file($_FILES['categoryImage']['tmp_name'], "categoryFiles/images/".$imagename);

            
            }
            if(isset($_FILES['categoryImageIcon']['size']) && $_FILES['categoryImageIcon']['size'] > 0){
               
                $imageicon = 'chitki_'.$date.'_'.$_FILES['categoryImageIcon']['name'];
                $imagename1 = SITE_URL."/categoryFiles/images/".$imageicon; 
                
                $uploadedfile = $_FILES['categoryImageIcon']['tmp_name'];
                $filename = stripslashes($imageicon);
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
                
                $newwidth=25;
                $newheight=29;
                $tmp=imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                $filename = "categoryFiles/images/thumb/".$imageicon;
                imagejpeg($tmp,$filename,100);
                
                move_uploaded_file($_FILES['categoryImageIcon']['tmp_name'], "categoryFiles/images/".$imageicon);

            
            }
        }
        $data = array(
            'categoryName' => $_POST['categoryName'],
            'parentCategory' => $_POST['parentCategory'],
            'active' => $_POST['active'],
            'categoryImg' => $imagename,
            'categoryImageIcon' => $imageicon
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


    function getAllOrderDetails(){
        
        $db = new DB();

        $query = "SELECT * FROM ".ORDER_DETAILS." ORDER BY dateTime DESC";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $orders[]=$row;
        }

        return $orders;

    }

    function getUserOrderDetails($userId){
         $db = new DB();

        $query = "SELECT * FROM ".ORDER_DETAILS." WHERE userId = '".$userId."' ORDER BY dateTime DESC";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $orders[]=$row;
        }

        return $orders;
    }
    function getUserOrderCount($userId){
         $db = new DB();

        $query = "SELECT * FROM ".ORDER_DETAILS." WHERE userId = '".$userId."' ORDER BY dateTime DESC";
        
        $results = $db->num_rows( $query );
        
        return $results;
    }
    function getUserDetailsById($userId){
        $db = new DB();

        $query = "SELECT * FROM ".USERS." WHERE id = '".$userId."'";
        if($db->num_rows( $query ) > 0 ){
           return $db->get_row( $query, true );
        }else{
           return false;
        }

        

    }
    function getAllUserDetails(){
        
        $db = new DB();

        $query = "SELECT * FROM ".USERS." ORDER BY id DESC";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $orders[]=$row;
        }

        return $orders;

    }




    function categoryTree(&$output, $preselected, $parent=0, $indent="",$type){

        $db = new DB();

        $query = "SELECT id, categoryName,parentCategory FROM ".PRODUCT_CATEGORIES." WHERE parentCategory=".$parent." AND active='1'";

        $results = $db->get_results( $query);
        
        foreach($results as $row ){
            $disabled = '';
            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            //if(($type == 'products') && ($row['parentCategory'] == 0)){
              //  $disabled = "disabled=\"disabled\"";
            //}
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . " ".$disabled .">" . $indent.'&gt;'. $row["categoryName"] . "</option>";
               
                if($row["id"] != $parent){
                  $this->categoryTree($output, $preselected, $row["id"], $indent . "-",$type);
                }

        }

    }
    function brandTree(&$output, $preselected, $indent=""){

        $db = new DB();

        $query = "SELECT id, brandName FROM ".BRANDS;

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["brandName"] . "</option>";
               
               

        }

    }

    function supplierTree(&$output, $preselected, $indent=""){

        $db = new DB();

        $query = "SELECT id, companyName FROM ".SUPPLIERS;

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["companyName"] . "</option>";
               
               

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
                                    <form action="" name="login_form" method="post" role="form" enctype="multipart/form-data">            
                                         <input type="hidden" name="action" value="updateCategory" /> 
                                        <div class="form-group">
                                            <label>Parent Category</label>

                                            <?
                                                $this->categoryTree($categories, $categoryData->parentCategory, 0, '-',''); 
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
                                            <label>Category Image</label><br/>
                                            <input type="file" name="categoryImage" accept="image/png, image/jpeg"> 
                                             
                                        </div>


                                           <?php if($categoryData->categoryImg !=''){?>
                                            <div class="row" >
                                                <img src="<?=APP_URL?>/categoryFiles/images/thumb/<?=$categoryData->categoryImg?>" title="<?=$categoryData->categoryName?>" width="100">
                                                
                                                
                                            </div>
                                            <?php } ?>
                                             <div class="form-group">
                                            <label>Category Mobile Icon</label><br/>
                                            <input type="file" name="categoryImageIcon" accept="image/png, image/jpeg"> 
                                             
                                        </div>


                                           <?php if($categoryData->categoryImageIcon !=''){?>
                                            <div class="row" >
                                                <img src="<?=APP_URL?>/categoryFiles/images/thumb/<?=$categoryData->categoryImageIcon?>" title="<?=$categoryData->categoryImageIcon?>" >
                                                
                                                
                                            </div>
                                            <?php } ?>
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
        
        $date = date("shdmy");

        if($_POST['parentCategory'] == 0){

            if(isset($_FILES['categoryImage']['size']) && $_FILES['categoryImage']['size'] > 0){
                 $qry = "SELECT categoryImg FROM ".PRODUCT_CATEGORIES." WHERE id='".$_REQUEST['categoryId']."'";
                 $categoryImgLink = $db->get_row( $qry, true );
                 $catImgPath = SITE_ROOT."/categoryFiles/images/".$categoryImgLink->categoryImg;
                 $catImgPath1 = SITE_ROOT."/categoryFiles/images/thumb/".$categoryImgLink->categoryImg;
                  if($_SERVER['REMOTE_ADDR'] == '122.179.58.200' ){
                        echo $catImgPath;
                        exit;
                    }
                 unlink($catImgPath);
                 unlink($catImgPath1);
               
                $imagename = 'chitki_'.$date.'_'.$_FILES['categoryImage']['name'];
                $imagename1 = SITE_URL."/categoryFiles/images/".$imagename; 
                
                $uploadedfile = $_FILES['categoryImage']['tmp_name'];
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
                
                $newwidth=560;
                $newheight=400;
                $tmp=imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                $filename = "categoryFiles/images/thumb/".$imagename;
                imagejpeg($tmp,$filename,100);
                
                move_uploaded_file($_FILES['categoryImage']['tmp_name'], "categoryFiles/images/".$imagename);
                
                 $update = array(
                      'categoryImg'=> $imagename

                );

                $where_clause = array(
                    'id' => $_REQUEST['categoryId']
                );

                $updated = $db->update(PRODUCT_CATEGORIES, $update, $where_clause, 1 );
            }
            if(isset($_FILES['categoryImageIcon']['size']) && $_FILES['categoryImageIcon']['size'] > 0){
                 $qry = "SELECT categoryImg FROM ".PRODUCT_CATEGORIES." WHERE id='".$_REQUEST['categoryId']."'";
                 $categoryImgLink = $db->get_row( $qry, true );
                 $catImgPath = SITE_ROOT."/categoryFiles/images/".$categoryImgLink->categoryImg;
                 $catImgPath1 = SITE_ROOT."/categoryFiles/images/thumb/".$categoryImgLink->categoryImg;
                  if($_SERVER['REMOTE_ADDR'] == '122.179.58.200' ){
                        echo $catImgPath;
                        exit;
                    }
                 unlink($catImgPath);
                 unlink($catImgPath1);
               
                $imagename = 'chitki_'.$date.'_'.$_FILES['categoryImageIcon']['name'];
                $imagename1 = SITE_URL."/categoryFiles/images/".$imagename; 
                
                $uploadedfile = $_FILES['categoryImageIcon']['tmp_name'];
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
                
                $newwidth=25;
                $newheight=29;
                $tmp=imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                $filename = "categoryFiles/images/thumb/".$imagename;
                imagejpeg($tmp,$filename,100);
                
                move_uploaded_file($_FILES['categoryImage']['tmp_name'], "categoryFiles/images/".$imagename);
                
                 $update = array(
                      'categoryImageIcon'=> $imagename

                );

                $where_clause = array(
                    'id' => $_REQUEST['categoryId']
                );

                $updated = $db->update(PRODUCT_CATEGORIES, $update, $where_clause, 1 );
            }
        }
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
                <div class="col-lg-12 alert alert-success updateproductCostsuccess"> </div>
                <div class="col-lg-12 alert alert-danger updateproductCosterror"> </div>
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
                                            <th width="35%">Product Name</th>
                                            <th width="15%">Category</th>
                                            <th width="40%">Product Wt/Qty - Stock - Price</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php
                                        $query = "SELECT * FROM ".PRODUCTS ;
                                        $results = $db->get_results($query);
                                    
        
                                        foreach($results as $row){

                                            if($row['categoryId']>0){
                                                   $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$row['categoryId']."'";
                                                   $categoryData = $db->get_row( $qry, true );
                                            }
                                            
                                            $qry1 = "SELECT * FROM ".PRODUCT_OPTIONS." WHERE productId='".$row['id']."' AND active = '1'";
                                            $productOptions = $db->get_results( $qry1, true );
                                                                                     

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$row['productName']?></td>
                                            <td><?=$categoryData->categoryName?></td>
                                            <td ><?php foreach($productOptions as $prdOptiondetails){
                                                if($prdOptiondetails->productStock <= 5){ echo "<span class='stock_alert'>";}
                                               echo '<span class="prodWordspace">'.$prdOptiondetails->productWeight.' '.$prdOptiondetails->productUnit.' </span>- <input type="text" pattern="[0-9]*" class="stockOptTxt" id="stockopt_'.$prdOptiondetails->id.'" value="'.$prdOptiondetails->productStock.'" size="2"/>'; 
                                               echo '&nbsp; - &nbsp;<input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" class="optPriceTxt" id="optPrice_'.$prdOptiondetails->id.'" value="'.$prdOptiondetails->productCost.'" size="4"/>';
                                               echo '<a href="javascript:void(0)" class="updateProductcost" onclick="updateProductcost(\''.$prdOptiondetails->id.'\');" title="Update stock and Cost" ><i class="fa fa-refresh"></i></a>'; 
                                                if($prdOptiondetails->productStock <= 5){ echo " </span> &nbsp;&nbsp;<span class='lessThan5' title='<=5'>#L5</span>";}
                                                if($prdOptiondetails->productStock <= 0){ echo " &nbsp;&nbsp;<span class='nostock' title='No stock'>#NS</span>";}
                                                echo "<br/>";
                                            } ?>
                                            </td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editProduct&productId=<?=$row['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                                <?php if($row['active'] == '1'){ echo " <span class='prodActive' title='Active'>#A</span>";} ?>
                                                <?php if($row['active'] == '0'){ echo " <span class='prodInactive' title='Inactive'>#I</span>";} ?>
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
                    iDisplayLength: 50,
                    "columnDefs": [
                                { "orderable": false, "targets": 2 }
                             ]
            });

            });
            function updateProductcost(prdOptid){
                var qty = $('#stockopt_'+prdOptid).val(); 
                var cost = $('#optPrice_'+prdOptid).val(); 
                if(!/^([0-9]*)$/.test(qty)){
                    return false;
                }
                if(!/^([0-9]+(\.[0-9]{1,2})?$)/.test(cost)){
                    return false;
                }
                if(confirm("Are you sure you want to update cost and stock ?")){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=updatecoststock&productOptionId="+prdOptid+"&stockqty="+qty+"&productCost="+cost,
                            success: function(msg){       
                                   if(msg =='success'){
                                        $('.updateproductCostsuccess').show('slow');
                                        $('.updateproductCostsuccess').html('Product cost and stock/qty are updated.');
                                        setTimeout(function(){
                                          $('.updateproductCostsuccess').hide('slow');
                                        }, 3000);
                                   }else{
                                        $('.updateproductCosterror').show('slow');
                                        $('.updateproductCosterror').html('Problem while updating. Please try again!');
                                        setTimeout(function(){
                                          $('.updateproductCosterror').hide('slow');
                                        }, 3000);
                                   }                                                            
                            }
                        });
                }
                
            }
            </script>


        <?
    }

    function orderProduct(){
            
            $db = new DB();
            
        ?>

            <div class="row">
                <div class="col-lg-12 alert alert-success updateproductCostsuccess"> </div>
                <div class="col-lg-12 alert alert-danger updateproductCosterror"> </div>
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
                           Order Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <div id="loading" class="text-center"> </div>
                                <ul id="sortme">
                                    <?php
                                    
                                    $query = "SELECT * FROM ".PRODUCTS." ORDER BY product_orders ASC" ;
                                        $results = $db->get_results($query);
                                        foreach($results as $row){
                                    echo '<li id="questions_' . $row['id'] . '">' . $row['productName'] . "</li>\n";
                                    }
                                    ?>
                                </ul>
                              
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
            
            <script type="text/javascript" src="js/jquery-ui.js"></script>
            <script>
                $(document).ready(function() {
                            $("#sortme").sortable({
                            update : function () {
                                serial = 'action=sortProducts&' + $('#sortme').sortable('serialize');
                                $('#loading').html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
                                $.ajax({
                                    url: "ajxHandler.php",
                                    type: "post",
                                    data: serial,
                                    success:function(){
                                        $('#loading').html('');
                                         $('.updateproductCostsuccess').show('slow');
                                         $('.updateproductCostsuccess').html('Product order is updated.');
                                            setTimeout(function(){
                                              $('.updateproductCostsuccess').hide('slow');
                                            }, 2000);
                                    },
                                    error: function(){
                                        $('#loading').html('');
                                        $('.updateproductCosterror').show('slow');
                                        $('.updateproductCosterror').html('There is an error with Sorting. Please try again!');
                                        setTimeout(function(){
                                          $('.updateproductCosterror').hide('slow');
                                        }, 3000);
                                    }
                                });
                            }
                        });
                    });
            

                    
             
               
            
            </script>


        <?
    }

    function sortProducts(){
        $db = new DB();
        $questions = $_POST['questions'];
        for ($i = 0; $i < count($questions); $i++) {
            $updateData = array(
                'product_orders' => $i
            );

            $where_clause_id = array(
                    'id' => $questions[$i]
            );

            $update = $db->update(PRODUCTS, $updateData, $where_clause_id);
        }
        // for ($i = 0; $i < count($questions); $i++) {
        // mysql_query("UPDATE `questions` SET `orders`=" . $i . " WHERE `id`='" . $questions[$i] . "'") or die(mysql_error());
        // }
    }

    function updatecoststock(){
        $db = new DB();
        $productOptionId = $db->filter($_REQUEST['productOptionId']);
        $stockqty = $db->filter($_REQUEST['stockqty']);
        $productCost = $db->filter($_REQUEST['productCost']);

        $updateData = array(
                'productCost' => $productCost,
                'productStock' => $stockqty
        );

        $where_clause_optid = array(
                'id' => $productOptionId
          );

        $update = $db->update(PRODUCT_OPTIONS, $updateData, $where_clause_optid);
        if($update){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    function addNewProduct(){

            $categories = $this->getAllProductCategories();

            // Weight Units
            $weightUnits = $this->getProductAttributeValsByWeight();

        ?>

        <script type="text/javascript">
            $( document ).ready(function() {
            var costPerWtVal=0;

            $('#addMoreCostsPerWeightElement').click(function(){
                var content = $(this).attr("data-val");
                costPerWtVal=costPerWtVal + 1;
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+costPerWtVal;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+="<input type='number' min='1' class='form-control' step='0.01' name='productWeight[]' value='' style='width:25% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' style='width:15% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select>&nbsp;<input type='number' min='1' class='form-control' name='productCost[]' value='' style='width:10% !important; display:inline !important' placeholder='Cost' required>&nbsp;<input type='number' min='1' class='form-control' name='productStock[]' value='' style='width:15% !important; display:inline !important' placeholder='Stock' required>&nbsp;<input type='date' class='form-control expiryDate' name='expiryDate[]' value='' style='width:15% !important; display:inline !important' placeholder='Expiry Date' readonly>&nbsp;&nbsp;<input type='number' min='1' class='form-control' step='0.01' name='productMRP[]' value='' style='width:10% !important; display:inline !important' placeholder='MRP' required><br/><br/>";
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

            });
            $('#removeCostsPerWeightElement').click(function(){
                var content = $(this).attr("data-val");           
                if(costPerWtVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+costPerWtVal));
                    costPerWtVal = costPerWtVal-1;
                }
            });

            var upload_number = 1;
            $('#addFileInput').click(function(){
            
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
            
            });

 
        });
        
        function checkSploffer(){
            if ($('input#specialOffers').is(':checked')) {
                
                $('#offersDescription').fadeIn();
            }else{
               $('#offersDescription').fadeOut(); 
            }
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
                                <div class="col-lg-12">
                                    <form action="" name="product_form" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="saveNewProduct" /> 
                                        
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="productName" value="" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Category</label>

                                            <?
                                                $this->categoryTree($categories, 0, 0, '-','products'); 
                                            ?>
                                           <select name="categoryId" class="form-control" required>
                                                <option value="">SELECT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Suppliers</label>

                                            <?
                                                $this->supplierTree($supplier, 0, '-'); 
                                            ?>
                                           <select name="supplierId" class="form-control" required>
                                                <option value="">SELECT</option>
                                               <?php echo $supplier ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Brand</label>

                                            <?
                                                $this->brandTree($brands, 0, '-'); 
                                            ?>
                                           <select name="brandId" class="form-control" >
                                                <option value="">SELECT</option>
                                               <?php echo $brands ?>
                                            </select>
                                        </div>

                                         


                                        <div class="form-group">
                                            <label>Product Cost/Weight(Qty)</label><br/>
                                            <input type="number" min="1"  class="form-control" step="0.01" name="productWeight[]" value="" style="width:25% !important; display:inline !important" placeholder="Weight/Qty" required>
                                            <select class="form-control" name="productUnit[]" style="width:15% !important; display:inline !important" required >
                                                <option value="">-Unit-</option>
                                                <? foreach($weightUnits as $weightUnit){ ?>
                                                   <option value="<?=$weightUnit['attributeValue']?>"><?=$weightUnit['attributeValue']?></option>
                                                <? } ?>   
                                                </select>  
                                            <input type="number" min="1" class="form-control" name="productCost[]" value="" style="width:10% !important; display:inline !important" placeholder="Cost" required>   
                                            <input type="number" min="0" class="form-control" name="productStock[]" value="" style="width:15% !important; display:inline !important" placeholder="Stock" required>
                                             <input type="date" class="form-control expiryDate" name="expiryDate[]" value="" style="width:15% !important; display:inline !important" placeholder="Expiry Date">   
                                            <input type="number" min="1" class="form-control" step='0.01' name="productMRP[]"  value="" style="width:10% !important; display:inline !important" placeholder="MRP">

                                            <a href="javascript:void(0);" id="addMoreCostsPerWeightElement" data-val="moreWeights" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                            <a href="javascript:void(0);" id="removeCostsPerWeightElement" data-val="moreWeights" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>

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
                                             <a href="javascript:void(0)" id="addFileInput" title="Upload more photos"><i class="fa fa-plus-square fa-lg"></i></a>
                                             <div id="moreUploads"></div>                                           
                                             <input type="hidden" id="uploadsNeeded" name="uploadsNeeded" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Special Offers?</label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="1" id="specialOffers" name="specialOffers" onchange="checkSploffer();">Yes
                                                </label>                                            
                                        </div>  
                                        <div class="form-group" id="offersDescription">
                                            <label>Offers</label>
                                            <input type="text" maxlength="50" class="form-control" name="offersDescription">
                                            <p>maximum 50 characters long!</p>
                                        </div> 

                                        <div class="form-group">
                                            <label>Featured Product</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" id="featuredProduct" name="featuredProduct">Yes
                                            </label>
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
            $( document ).ready(function() {
                var costPerWtVal=0;

                $('#addMoreCostsPerWeightElement').click(function(){
                    var content = $(this).attr("data-val");
                    var costPerWtVal = parseInt($('#costPerWtCount').val());

                    costPerWtVal=costPerWtVal + 1;
                    var contentID = document.getElementById(content);
                    var newTBDiv = document.createElement("div");
                    var descriptionId = content+costPerWtVal;
                    newTBDiv.setAttribute("id",descriptionId);
                    newTBDiv.innerHTML+="<input type='number' min='1' class='form-control' step='0.01' name='productWeight[]' value='' style='width:25% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' style='width:15% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select>&nbsp;<input type='number' min='1' class='form-control' name='productCost[]' value='' style='width:10% !important; display:inline !important' placeholder='Cost' required>&nbsp;<input type='number' min='1' class='form-control' name='productStock[]' value='' style='width:15% !important; display:inline !important' placeholder='Stock' required>&nbsp;<input type='text' class='form-control expiryDate' name='expiryDate[]' value='' style='width:15% !important; display:inline !important' placeholder='Expiry Date' readonly>&nbsp;<input type='number' min='1' class='form-control' step='0.01' name='productMRP[]' value='' style='width:10% !important; display:inline !important' placeholder='MRP' required><br/><br/>";
                    contentID.appendChild(newTBDiv);
                    $('#costPerWtCount').val(costPerWtVal);

                    var nowDate = new Date();
                    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                    
                    $('.expiryDate').datepicker({
                            startDate: today,
                            autoclose: true,
                            format:'dd/mm/yyyy'
                     });



                });
                
                $('#removeCostsPerWeightElement').click(function(){
                    var content = $(this).attr("data-val");
                
                    
                    var costPerWtVal = parseInt($('#costPerWtCount').val());

                    if(costPerWtVal != 0){
                        var contentID = document.getElementById(content);
                        contentID.removeChild(document.getElementById(content+costPerWtVal));
                        costPerWtVal = costPerWtVal-1;
                        $('#costPerWtCount').val(costPerWtVal);
                    }
                });
            
            var upload_number = 1;
            $('#addFileInput').click(function(){
           

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
            
            });

            // $('#deleteProductOption').click(function(){
            //     var productOptionId = $(this).attr("data-val");
           

            //     if(confirm("Are you sure you want to delete this?")){
            //         $.ajax
            //             ({
            //                 type: "POST",
            //                 url: "ajxHandler.php",
            //                 data: "action=deleteProductOption&productOptionId="+productOptionId,
            //                 success: function(msg){       
            //                     if(msg=='success'){
            //                          $('.option_'+productOptionId).css('display', 'none');
            //                          window.location.reload(true); 
            //                     }                                                               
            //                 }
            //             });
            //     }
            // });
       
            // $('#deleteProductPhoto').click(function(){
            //         var productImageId = $(this).attr("data-val");
            //         if(confirm("Are you sure you want to delete this?")){
            //             $.ajax
            //                 ({
            //                     type: "POST",
            //                     url: "ajxHandler.php",
            //                     data: "action=deleteProductPhoto&productImageId="+productImageId,
            //                     success: function(msg){       

            //                         if(msg=='success'){
            //                             $('#row_'+productImageId).css('display', 'none');
            //                         }                                                               
            //                     }
            //                 });
            //         }
            // });
         });
        function checkSploffer(){
            if ($('input#specialOffers').is(':checked')) {
                
                $('#offersDescription').fadeIn();
            }else{
               $('#offersDescription').fadeOut(); 
            }
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
                                     window.location.reload(true); 
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
                                <div class="col-lg-12">
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
                                                $this->categoryTree($categories, $productData->categoryId, 0, '-','products'); 
                                            ?>
                                           <select name="categoryId" class="form-control" required>
                                                <option value="">SELECT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Suppliers</label>

                                            <?
                                                $this->supplierTree($supplier, $productData->supplierId, '-'); 
                                            ?>
                                           <select name="supplierId" class="form-control" required>
                                                <option value="">SELECT</option>
                                               <?php echo $supplier ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Brand</label>

                                            <?
                                                $this->brandTree($brands, $productData->brandId, '-'); 
                                            ?>
                                           <select name="brandId" class="form-control" >
                                                <option value="">SELECT</option>
                                               <?php echo $brands ?>
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
                                            <input type="number" min="1" step="0.01" class="form-control" name="productWeight[]" value="<?=$productOption['productWeight']?>" style="width:25% !important; display:inline !important" placeholder="Weight/Qty" required>
                                            <select class="form-control" name="productUnit[]" style="width:15% !important; display:inline !important" required >
                                                <option value="">-Unit-</option>
                                                <? foreach($weightUnits as $weightUnit){ ?>
                                                   <option value="<?=$weightUnit['attributeValue']?>" <? if($productOption['productUnit']==$weightUnit['attributeValue']){ ?> selected <? } ?> ><?=$weightUnit['attributeValue']?></option>
                                                <? } ?>   
                                                </select>  
                                            <input type="number" min="1" class="form-control" name="productCost[]" value="<?=$productOption['productCost']?>" style="width:10% !important; display:inline !important" placeholder="Cost" required>   
                                            <input type="number" min="0" class="form-control" name="productStock[]" value="<?=$productOption['productStock']?>" style="width:15% !important; display:inline !important" placeholder="Stock" required>   

                                            <?php
                                                
                                                if($productOption['expiryDate']!='0000-00-00'){
                                                    list($yy, $mm, $dd) = explode('-', $productOption['expiryDate']);
                                                    $expiryDate = $dd.'/'.$mm.'/'.$yy;
                                                }else{
                                                    $expiryDate ='';
                                                }

                                            ?>
                                            <input type="text" class="form-control expiryDate" name="expiryDate[]" value="<?=$expiryDate?>" style="width:15% !important; display:inline !important" placeholder="Expiry Date" readonly>   
                                            <input type="number" step='0.01' min="1" class="form-control" name="productMRP[]" value="<?=$productOption['productMRP']?>" style="width:10% !important; display:inline !important" placeholder="MRP" required>   

                                            <? if($k==1){ ?>
                                            
                                                <a href="javascript:void(0);" id="addMoreCostsPerWeightElement" data-val="moreWeights" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                                <a href="javascript:void(0);" id="removeCostsPerWeightElement" data-val="moreWeights" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>
                                                
                                            <? }else{?>
                                                
                                                <a href="javascript:void(0);" id="deleteProductOption" onclick="deleteProductOption('<?=$productOptionId?>');" data-val="<?=$productOptionId?>" Title="Delete Option"><i class="fa fa-trash-o fa-lg"></i></a>
                                                
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
                                                                    autoclose:true,
                                                                    format:'dd/mm/yyyy'
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
                                             <a href="javascript:void(0)" id="addFileInput" title="Upload more photos"><i class="fa fa-plus-square fa-lg"></i></a>
                                             <div id="moreUploads"></div>                                           
                                             <input type="hidden" id="uploadsNeeded" name="uploadsNeeded" value="">
                                        </div>


                                            <?php foreach ($productPhotos as $productPhoto) { 

                                                  $productImageId = $productPhoto['id'];
                                                ?>
                                            <div class="row" id="row_<?=$productImageId?>">
                                                <img src="<?=APP_URL?>/productFiles/images/thumb/<?=$productPhoto['image']?>" title="<?=$productData->productName?>">
                                                 <a href="javascript:void(0);" id="deleteProductPhoto" onclick="deleteProductPhoto('<?=$productImageId?>');" data-val="<?=$productImageId?>" Title="Delete Photo"><i class="fa fa-trash-o fa-lg"></i></a>
                                                <br>
                                            </div>
                                            <? } ?>

                                        <div class="form-group">
                                            <label>Special Offers?</label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="1" id="specialOffers" name="specialOffers" <?php if($productData->specialOffers==1){ ?> checked="checked" <? } ?> onchange="checkSploffer()" >Yes
                                                </label>                                            
                                        </div>  
                                        <div class="form-group" id="offersDescription" <?php if($productData->specialOffers==1){ ?> style="display:block" <? } ?>>
                                            <label>Offers</label>
                                            <input type="text" maxlength="50" class="form-control" name="offersDescription" value="<?=$productData->offersDescription?>">
                                            <p>maximum 50 characters long!</p>
                                        </div> 
                                        <div class="form-group">
                                            <label>Featured Product</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" id="featuredProduct" name="featuredProduct" <?php if($productData->featuredProduct==1){ ?> checked="checked" <? } ?> >Yes
                                            </label>
                                        </div>   

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
        // for now

        //$_POST['supplierId'] = 1;
        $prodOrdsql = "SELECT id FROM ".PRODUCTS;
        $product_orders = $db->num_rows($prodOrdsql);
        $newprd_orders = $product_orders + 1;

        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

        $data = $_POST;
        $file = $_FILES;

        if($data['uploadsNeeded']==0 || $data['uploadsNeeded']==1){
            $uploadsNeeded = 2; 
        }else{
            $uploadsNeeded = $data['uploadsNeeded']; 
        }

        $dateTime = date('Y-m-d h:i:s');

        $date = date("shdmy");

        $specialOffers = (isset($_POST['specialOffers']) && $_POST['specialOffers']=='1')?'1':'0';
        $featuredProduct = (isset($_POST['featuredProduct']) && $_POST['featuredProduct']=='1')?'1':'0';
         

         if($_POST['brandId'] ==''){
             $data = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'specialOffers' => $specialOffers,
            'featuredProduct' => $featuredProduct,
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription']),
            'product_orders' => $newprd_orders
            );
        }else{
           $data = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'brandId' => $_POST['brandId'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'specialOffers' => $specialOffers,
            'featuredProduct' => $featuredProduct,
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription']),
            'product_orders' => $newprd_orders
            );
        }
        

        $rs = $db->insert(PRODUCTS, $data);

        $productId = $db->lastid();

        if($rs){

            $productWeight = $_POST['productWeight'];
            $productUnit   = $_POST['productUnit'];
            $productCost   = $_POST['productCost'];
            $productStock  = $_POST['productStock'];
            $productMRP   = $_POST['productMRP'];
            $expiryDate   = $_POST['expiryDate'];

            $i=0;

            foreach($productWeight as $productWt){

                list($dd, $mm, $yy) = explode('/', $expiryDate[$i]);

                $expDate = $yy.'-'.$mm.'-'.$dd;

                if($productMRP[$i]=='' || $productMRP[$i]==0){
                    $productMRPAmount = $productCost[$i];
                }else{
                    $productMRPAmount = $productMRP[$i];
                }

                $records = array(
                    'productId' => $productId,
                    'productWeight' => $productWeight[$i],
                    'productUnit' => $productUnit[$i],
                    'productCost' => $productCost[$i],
                    'productStock' => $productStock[$i],
                    'productMRP' => $productMRPAmount,
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

        $inactiveData = array(
                'active' => '0',
        );

        $where_clause_inactive = array(
                'id' => $_POST['productOptionId']
          );

        $deleted = $db->update(PRODUCT_OPTIONS, $inactiveData, $where_clause_inactive);
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
        
        // for now
       // $_POST['supplierId'] = 1;

        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

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

        $specialOffers = (isset($_POST['specialOffers']) && $_POST['specialOffers']=='1')?'1':'0';
        $featuredProduct = (isset($_POST['featuredProduct']) && $_POST['featuredProduct']=='1')?'1':'0';
        if($_POST['brandId'] ==''){
             $updateData = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'specialOffers' => $specialOffers,
            'featuredProduct' => $featuredProduct,            
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription'])
            );
        }else{
           $updateData = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'brandId' => $_POST['brandId'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'specialOffers' => $specialOffers,
            'featuredProduct' => $featuredProduct,            
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription'])
            );
        }
        
        

        $where_clause = array(
            'id' => $productId
        );

        $updated = $db->update(PRODUCTS, $updateData, $where_clause, 1 );

        if($updated){

            //--update existing product options to inactive

            $inactiveData = array(
                'active' => '0',
                'dateTime' => $dateTime
            );

            $where_clause_inactive = array(
                'productId' => $productId
            );

            $db->update(PRODUCT_OPTIONS, $inactiveData, $where_clause_inactive);



            $productWeight = $_POST['productWeight'];
            $productUnit = $_POST['productUnit'];
            $productCost   = $_POST['productCost'];
            $productStock   = $_POST['productStock'];
            $productMRP   = $_POST['productMRP'];
            $expiryDate   = $_POST['expiryDate'];

            // pre($expiryDate);
            // exit;

           // $i=0;

            for($i=0; $i<count($productWeight); $i++){

                list($dd, $mm, $yy) = explode('/', $expiryDate[$i]);

                $expDate = $yy.'-'.$mm.'-'.$dd;


                if($productMRP[$i]=='' || $productMRP[$i]==0){
                    $productMRPAmount = $productCost[$i];
                }else{
                    $productMRPAmount = $productMRP[$i];
                }


                $records = array(
                    'productId' => $productId,
                    'productWeight' => $productWeight[$i],
                    'productUnit' => $productUnit[$i],
                    'productCost' => $productCost[$i],
                    'productStock' => $productStock[$i],
                    'productMRP' => $productMRPAmount, 
                    'expiryDate' => $expDate
                );

                $inserted = $db->insert(PRODUCT_OPTIONS, $records);

              //  $i++;
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

        $orders = $this->getAllOrderDetails();
        // pre($orders);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Orders</h1>
                </div>
                <div class="col-lg-12 text-right margin-bottom10">
                        <a href="<?=APP_URL?>/index.php?page=addNewOrder" title="Add new order" class="btn btn-primary">Add New Order</a>
                </div>    
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Orders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="8%">Sl. No.</th>
                                            <th>Invoice</th>
                                            <th>Name</th>
                                            <th>Mobile No</th>
                                            <th>Order status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php $slno = 1;
                                            foreach ($orders as $order){
                                                $userOrdercount = $this->getUserOrderCount($order['userId']);
                                                ?>
                                        <tr class="odd gradeX <?php if($order['viewOrders']=='0'){ echo 'newOrderRow';}?>" >
                                            <td><?=$slno?></td>
                                            <td><?=$order['invoiceNo']?></td>
                                            <td><?=$order['fullName']?></td>
                                            <td><?=$order['mobileNumber']?></td>
                                            <td><?=$order['orderStatus']?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=viewOrderDetail&orderId=<?=$order['id']?>" title="View Order Detail"><i class="fa fa-eye"></i></a>
                                                <a href="<?=APP_URL?>/index.php?page=editOrderDetail&orderId=<?=$order['id']?>&orderStatus=<?=$order['orderStatus']?>&prevPage=manageOrders" title="Edit Order Detail"><i class="fa fa-pencil-square-o"></i></a>
                                                <?php if($userOrdercount =='1'){?><i class="fa fa-th-list alert-success" title="New order"></i>&nbsp;<span class="alert-success" title="New order">(<?=$userOrdercount?>)</span><?php }else{ ?><a href="<?=APP_URL?>/index.php?page=manageUsersOrder&userId=<?=$order['userId']?>" title="See all orders"><i class="fa fa-th-list"></i></a>&nbsp;<span title="Save order">(<?=$userOrdercount?></span>)<?php } ?>
                                             </td> 
                                        </tr>
                                     <? $slno++; } ?>
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
                                { "orderable": false}
                             ]
            });
            });
            </script>


        <?
    }

     function manageUsersOrder($userId){

        $db = new DB();

        $orders = $this->getUserOrderDetails($userId);
        $user = $this->getUserDetailsById($userId);
        // pre($orders);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Orders from <?=$user->fullName?></h1>
                </div>
                <div class="col-lg-12 text-right margin-bottom10">
                        <a href="<?=APP_URL?>/index.php?page=manageOrders" title="Manage orders" class="btn btn-primary">Back</a>
                </div>    
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Orders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="8%">Sl. No.</th>
                                            <th>Invoice</th>
                                            <th>Name</th>
                                            <th>Mobile No</th>
                                            <th>Order status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php $slno = 1;
                                            foreach ($orders as $order){?>
                                        <tr class="odd gradeX <?php if($order['viewOrders']=='0'){ echo 'newOrderRow';}?>" >
                                            <td><?=$slno?></td>
                                            <td><?=$order['invoiceNo']?></td>
                                            <td><?=$order['fullName']?></td>
                                            <td><?=$order['mobileNumber']?></td>
                                            <td><?=$order['orderStatus']?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=viewOrderDetail&orderId=<?=$order['id']?>" title="View Order Detail"><i class="fa fa-eye"></i></a>
                                                <a href="<?=APP_URL?>/index.php?page=editOrderDetail&orderId=<?=$order['id']?>&orderStatus=<?=$order['orderStatus']?>&prevPage=manageOrders" title="Edit Order Detail"><i class="fa fa-pencil-square-o"></i></a>
                                                
                                             </td> 
                                        </tr>
                                     <? $slno++; } ?>
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
                                { "orderable": false}
                             ]
            });
            });
            </script>


        <?
    }
    function manageCustomers(){

        $db = new DB();

        $usersData = $this->getAllUserDetails();
        // pre($orders);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Customers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Customers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile No</th>
                                            <th>Email</th>
                                            <th>Date Time</th>
                                            
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php foreach ($usersData as $users){?>
                                        <tr class="odd gradeX">
                                            <td><?=$users['fullName']?></td>
                                            <td><?=$users['mobileNumber']?></td>
                                            <td><?=$users['email']?></td>
                                            <td><?=stdDateFormat($users['dateTime'])?></td>
                                            <!-- <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editCategory&categoryId=<?=$category['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                             </td> --> 
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
                                { "orderable": false}
                             ]
            });
            });
            </script>


        <?
    }
 function addNewOrder(){ 
    $db = new DB();
    $query = "SELECT * FROM ".PRODUCTS." WHERE active='1' ORDER BY productName ASC";
    $products = $db->get_results($query);
    $orderDetails = $db->get_row("SELECT invoiceNo FROM order_details WHERE invoiceNo IS NOT NULL AND TRIM(invoiceNo) <> '' ORDER BY id DESC LIMIT 1 ", true);
    $oldinvoice = substr($orderDetails->invoiceNo,4);
    $newinvoiceNo = $oldinvoice + 1;
    $invoiceNo = "CTKI".$newinvoiceNo;


    ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Orders</h1>
                </div>
                <!-- /.col-lg-12 -->
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Add New Orders
                        </div>
                        <!-- /.panel-heading -->
                        
                        <form action="" name="order_form" method="post" role="form" enctype="multipart/form-data" >
                        <input type="hidden" name="action" value="saveNewOrders" />
                        <section>
                            <div class="panel-body">
                                <h3>User details : </h3>
                                <div class="form-group">
                                    <label>Phone number:</label>
                                    <input type="text" class="form-control" required="" id="userPhone" value="" name="userPhone" onblur="getaddressbyphoneno();">
                                </div> 
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" class="form-control" required="" id="userName" value="" name="userName">
                                </div>   
                                
                                <div class="form-group">
                                    <label> Email:</label>
                                    <input type="email" class="form-control" value="" id="userEmail" name="userEmail">
                                </div> 
                                <div class="form-group">
                                    <label> Shipping address:</label>
                                    <textarea class="form-control" name="shippingAddress" id="shippingAddress" rows="3" required=""></textarea>
                                </div> 
                                <div class="form-group">
                                    <label> Invoice number:</label>
                                    <input type="text" class="form-control" name="invoiceNo" rows="3" required="" value="<?=$invoiceNo?>"/>
                                </div> 
                            </div>
                        </section>
                        <section>
                            <div class="panel-body additemFields">
                               <div class="form-group">
                                    <label>Add Exiting Items :</label><br/><br/>
                                    <select class="form-control" name="productId[]" id="productId_0" style="width:25% !important; float:left;" placeholder="Product name" onChange="loadOrderweightForm(this,0)">
                                    <option value="">-Select Item-</option>
                                    <? foreach($products as $product){ ?>
                                       <option value="<?=$product['id']?>"><?=$product['productName']?></option>
                                    <? } ?>   
                                    </select>
                                    <span id="orderWeightunitsDiv_0">
                                        <input type="text" class="form-control getPriceval" data-ordercnt="0" id="orderweight_0" name="productWeight[]" style="width:15% !important; float:left;" placeholder="Weight/Qty" >
                                        <input type="text" class="form-control getPriceval" data-ordercnt="0" name="orderUnit[]" id="orderUnit_0" style="width:20% !important; float:left;" placeholder="Unit"  >
                                    </span>
                                    <!-- <div class="magicsuggest" style="width:25% !important; float:left;" placeholder="Product name"></div>
                                    <input type="hidden" name="productId[]" id="productId_0"> -->
                                    
                                    <input type="text" class="form-control getPriceval" data-ordercnt="0" name="orderQty[]" id="orderqty_0" value="" style="width:10% !important; float:left;" placeholder="Qty" >
                                    
                                    <input type="text" class="form-control getTotalval" name="price[]" value="" id="orderprice_0"  onfocus="getorderPrice(0);" data-ordercnt="0" style="width:10% !important; float:left;" placeholder="Price" >   
                                    <input type="hidden" name="productoptionId[]" id="productOptionId_0"> 
                                    <input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_0" style="width:10% !important; float:left;" placeholder="Total price" >
                                     
                                    <a href="javascript:void(0);" id="exitingaddMoreOrders" data-val="exitingmoreOrders"  Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                    <a href="javascript:void(0);" id="exitingremoveMoreOrders" data-val="exitingmoreOrders" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>

                                </div> 
                                
                                   
                                <div class='exitingmoreOrders' id="exitingmoreOrders">
                                </div> 


                             </div>   
                            <div class="panel-body additemFields">
                               <div class="form-group">
                                    <label>Add New Items :</label><br/><br/>
                                    <div class="magicsuggest" style="width:25% !important; float:left;" placeholder="Product name"></div>
                                    <input type="hidden" name="productId[]" id="productId_1">
                                    <input type="text" class="form-control getPriceval" data-ordercnt="1" id="orderweight_1" name="productWeight[]" style="width:15% !important; float:left;" placeholder="Weight/Qty" >
                                    <div class="magicsuggest1 getPriceval" style="width:20% !important; float:left;" placeholder="Unit"></div>
                                    <input type="hidden" name="orderUnit[]" id="orderUnit_1"  >
                                    <input type="text" class="form-control getPriceval" data-ordercnt="1" name="orderQty[]" id="orderqty_1" value="" style="width:10% !important; float:left;" placeholder="Qty" >
                                    
                                    <input type="text" class="form-control getTotalval" name="price[]" value="" id="orderprice_1"  onfocus="getorderPrice(1);" data-ordercnt="1" style="width:10% !important; float:left;" placeholder="Price" >   
                                    <input type="hidden" name="productoptionId[]" id="productOptionId_1"> 
                                    <input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_1" style="width:10% !important; float:left;" placeholder="Total price" readonly>
                                     
                                    <a href="javascript:void(0);" id="addMoreOrders" data-val="moreOrders"  Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                    <a href="javascript:void(0);" id="removeMoreOrders" data-val="moreOrders" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>

                                </div> 
                                <input type="hidden" id="orderCount" name="orderCount" value="1" >
                                   
                                <div class='moreOrders' id="moreOrders">
                                </div> 


                             </div>   
                        </section>  
                        <section>
                            <div class="panel-body">
                               <div class="form-group row">
                                <div class="col-lg-4">
                                    <a href="javascript:void(0);" onClick="getGrandtotal();" Title="Grand total" class="btn btn-default ">Get Grand Total</a>
                                </div>
                                <div class="totalOrders col-lg-offset-4 col-lg-2 ">
                                        <input type="hidden" name="totalQty" id="totalQty" class="form-control"  required /> 
                                        <p >Sub Total : <input type="text" name="subtotal" id="subtotal" class="form-control" required  /></p>
                                        <p >Delivery Charges : <input type="text" name="deliverycharge" id="deliverycharge" class="form-control" required  /></p>
                                        <p >Grand Total : <input type="text" name="grandTotal" id="grandTotal" class="form-control" required /></p>
                                </div>  
                               </div> 
                               
                                <div class="form-group">
                                 <button type="submit" class="btn btn-default text-right">Submit</button> 
                                </div>
                               </div> 
                            </div>   
                       </section> 
                     </form>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->   
            <link href="css/magicsuggest-min.css" rel="stylesheet">
            <script src="js/magicsuggest-min.js"></script>      
           <script type="text/javascript">
                $(function(){
                   
                  var ord_name = $('.magicsuggest').magicSuggest({
                        //data: ['Paris', 'New York', 'Gotham']
                        data: 'get_productnames.php'

                    });
                  var ord_unit = $('.magicsuggest1').magicSuggest({
                        data: 'get_productunits.php'
                       

                    });
                    var orderCount = parseInt($('#orderCount').val());
                    
                    $(ord_name).on('selectionchange', function(){

                        $('#productId_'+orderCount).val(this.getValue());

                    });

                    $(ord_unit).on('selectionchange', function(){

                        $('#orderUnit_'+orderCount).val(this.getValue());
                     });
                   
                });
                $(".getPriceval").on("keyup keypress blur change focus", function(){
                    var id = $(this).attr("data-ordercnt");

                    var productid = $('#productId_'+id).val();
                    var orderweight = $('#orderweight_'+id).val();
                    var orderqty = $('#orderqty_'+id).val();
                    var orderUnit = $('#orderUnit_'+id).val();
                    
                    if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                        $.ajax({
                                type: "POST",
                                url: "index.php",
                                dataType: 'json',
                                data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                                success: function(data)
                                {    
                                     
                                     $('#productOptionId_'+id).val(data.p_optid);                                      
                                     $('#orderprice_'+id).val(data.price);
                                     getorderTotal(id);
            
                                }
                            });
                         
                    }
                });
                $(".getTotalval").on("keyup keydown keypress blur change focus", function(){
                    var id = $(this).attr("data-ordercnt");
                    getorderTotal(id);
                });
            
            var orderCount = 1;
            
            $('#addMoreOrders').click(function(){
                 var content = $(this).attr("data-val");
                orderCount=orderCount + 1;
                var contentID = document.getElementById(content);
                console.log(contentID);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+orderCount;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+= '<div class="magicsuggest" id="'+orderCount+'" style="width:25% !important; float:left;" placeholder="Product name"></div><input type="hidden" name="productId[]" id="productId_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" id="orderweight_'+orderCount+'" name="productWeight[]" style="width:15% !important; float:left;" placeholder="Weight/Qty" required><div id="'+orderCount+'" class="magicsuggest1 getPriceval" style="width:20% !important; float:left;" placeholder="Unit"></div><input type="hidden" name="orderUnit[]" id="orderUnit_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderQty[]" id="orderqty_'+orderCount+'" style="width:10% !important; float:left;" placeholder="Qty" required><input type="text" class="form-control getTotalval" name="price[]" value="" id="orderprice_'+orderCount+'"  onfocus="getorderPrice( \''+orderCount+'\');"  data-ordercnt="'+orderCount+'" style="width:10% !important; float:left;" placeholder="Price" required><input type="hidden" name="productoptionId[]" id="productOptionId_'+orderCount+'"><input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_'+orderCount+'" onfocus="getorderTotal(\''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Total price" readonly>';
                //newTBDiv.innerHTML+='<div class="magicsuggest" style="width:25% !important; float:left;" placeholder="Product name"></div><input type="hidden" name="productId[]" id="productId_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="productWeight[]" id="orderweight_'+orderCount+'" style="width:15% !important; float:left;" placeholder="Weight/Qty" required><div class="magicsuggest1" style="width:20% !important; float:left;" placeholder="Unit"></div><input type="hidden" name="orderUnit[]" id="orderUnit_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderQty[]" id="orderqty_'+orderCount+'" value="" style="width:10% !important; float:left;" placeholder="Qty" required><input type="text" class="form-control" name="price[]" id="orderprice_'+orderCount+'" value="" onfocus="getorderPrice( \''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Price" required><input type="hidden" name="productoptionId[]" id="productOptionId_'+orderCount+'"><input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_'+orderCount+'" onfocus="getorderTotal(\''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Total price" required>';
                contentID.appendChild(newTBDiv);
                console.log(orderCount);
                $('#orderCount').val(orderCount);
                var ms = $('.magicsuggest').magicSuggest({
                        data: 'get_productnames.php'

                    });
                var ord_unit =   $('.magicsuggest1').magicSuggest({
                        data: 'get_productunits.php'

                    });
                    
                    $(ms).on('selectionchange', function(event, combo, selection){
                     var idval = combo.container[0].id
                        $('#productId_'+idval).val(this.getValue());
                    });
                    $(ord_unit).on('selectionchange', function(event, combo, selection){
                        var idval1 = combo.container[0].id
                        $('#orderUnit_'+idval1).val(this.getValue());
                    });
                    $(".getPriceval").on("keyup keydown keypress blur change focus", function(){
                    var id = $(this).attr("data-ordercnt");
                    var productid = $('#productId_'+id).val();
                    var orderweight = $('#orderweight_'+id).val();
                    var orderqty = $('#orderqty_'+id).val();
                    var orderUnit = $('#orderUnit_'+id).val();
                    
                    if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                        $.ajax({
                                type: "POST",
                                url: "index.php",
                                dataType: 'json',
                                data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                                success: function(data)
                                {    
                                     
                                     $('#productOptionId_'+id).val(data.p_optid);                                      
                                     $('#orderprice_'+id).val(data.price);
                                     getorderTotal(id);
            
                                }
                            });
                        

                    }
                });
                $(".getTotalval").on("keyup keydown keypress blur change focus", function(){
                            var id = $(this).attr("data-ordercnt");
                            getorderTotal(id);
                        });
            });
            $('#removeMoreOrders').click(function(){
                var content = $(this).attr("data-val");
                var orderCount = parseInt($('#orderCount').val());

                if(orderCount != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+orderCount));
                    orderCount = orderCount-1;
                    $('#orderCount').val(orderCount);
                }
            });

            $('#exitingaddMoreOrders').click(function(){
                 var content = $(this).attr("data-val");
                orderCount=orderCount + 1;
                var contentID = document.getElementById(content);
                console.log(contentID);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+orderCount;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+= '<select class="form-control" name="productId[]" id="productId_'+orderCount+'" style="width:25% !important; float:left;" placeholder="Product name" required onChange="loadOrderweightForm(this,'+orderCount+')"><option value="">-Select Item-</option><? foreach($products as $product){ ?><option value="<?=$product["id"]?>"><?=$product["productName"]?></option><? } ?></select><span id="orderWeightunitsDiv_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" id="orderweight_'+orderCount+'" name="productWeight[]" style="width:15% !important; float:left;" placeholder="Weight/Qty" required><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderUnit[]" id="orderUnit_'+orderCount+'" style="width:20% !important; float:left;" placeholder="Unit"  ></span><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderQty[]" id="orderqty_'+orderCount+'" style="width:10% !important; float:left;" placeholder="Qty" required><input type="text" class="form-control getTotalval" name="price[]" value="" id="orderprice_'+orderCount+'"  onfocus="getorderPrice( \''+orderCount+'\');"  data-ordercnt="'+orderCount+'" style="width:10% !important; float:left;" placeholder="Price" required><input type="hidden" name="productoptionId[]" id="productOptionId_'+orderCount+'"><input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_'+orderCount+'" onfocus="getorderTotal(\''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Total price" readonly>';
                //newTBDiv.innerHTML+='<div class="magicsuggest" style="width:25% !important; float:left;" placeholder="Product name"></div><input type="hidden" name="productId[]" id="productId_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="productWeight[]" id="orderweight_'+orderCount+'" style="width:15% !important; float:left;" placeholder="Weight/Qty" required><div class="magicsuggest1" style="width:20% !important; float:left;" placeholder="Unit"></div><input type="hidden" name="orderUnit[]" id="orderUnit_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderQty[]" id="orderqty_'+orderCount+'" value="" style="width:10% !important; float:left;" placeholder="Qty" required><input type="text" class="form-control" name="price[]" id="orderprice_'+orderCount+'" value="" onfocus="getorderPrice( \''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Price" required><input type="hidden" name="productoptionId[]" id="productOptionId_'+orderCount+'"><input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_'+orderCount+'" onfocus="getorderTotal(\''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Total price" required>';
                contentID.appendChild(newTBDiv);
                console.log(orderCount);
                $('#orderCount').val(orderCount);
                var ms = $('.magicsuggest').magicSuggest({
                        data: 'get_productnames.php'

                    });
                var ord_unit =   $('.magicsuggest1').magicSuggest({
                        data: 'get_productunits.php'

                    });
                    
                    $(ms).on('selectionchange', function(event, combo, selection){
                     var idval = combo.container[0].id
                        $('#productId_'+idval).val(this.getValue());
                    });
                    $(ord_unit).on('selectionchange', function(event, combo, selection){
                        var idval1 = combo.container[0].id
                        $('#orderUnit_'+idval1).val(this.getValue());
                    });
                    $(".getPriceval").on("keyup keydown keypress blur change focus", function(){
                    var id = $(this).attr("data-ordercnt");
                    var productid = $('#productId_'+id).val();
                    var orderweight = $('#orderweight_'+id).val();
                    var orderqty = $('#orderqty_'+id).val();
                    var orderUnit = $('#orderUnit_'+id).val();
                    
                    if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                        $.ajax({
                                type: "POST",
                                url: "index.php",
                                dataType: 'json',
                                data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                                success: function(data)
                                {    
                                     
                                     $('#productOptionId_'+id).val(data.p_optid);                                      
                                     $('#orderprice_'+id).val(data.price);
                                     getorderTotal(id);
            
                                }
                            });
                        

                    }
                });
                $(".getTotalval").on("keyup keydown keypress blur change focus", function(){
                            var id = $(this).attr("data-ordercnt");
                            getorderTotal(id);
                        });
            });
            $('#exitingremoveMoreOrders').click(function(){
                var content = $(this).attr("data-val");
                var orderCount = parseInt($('#orderCount').val());

                if(orderCount != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+orderCount));
                    orderCount = orderCount-1;
                    $('#orderCount').val(orderCount);
                }
            });

            function getorderPrice(id){
                var productid = $('#productId_'+id).val();
                var orderweight = $('#orderweight_'+id).val();
                var orderqty = $('#orderqty_'+id).val();
                var orderUnit = $('#orderUnit_'+id).val();
                if(orderweight==''){
                    alert('Select Weight');
                }
                if(orderqty==''){
                    alert('Select Qty');
                }
                if(orderUnit==''){
                    alert('Select Unit');
                }
                console.log(productid+'-'+orderweight+'-'+orderqty+'-'+orderUnit);
                if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                    $.ajax({
                            type: "POST",
                            url: "index.php",
                            dataType: 'json',
                            data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                            success: function(data)
                            {    
                                 
                                 $('#productOptionId_'+id).val(data.p_optid);                                      
                                 $('#orderprice_'+id).val(data.price);
                                 getorderTotal(id);
        
                            }
                        });
                }
                
            }
            function getorderTotal(id){
                var orderqty = $('#orderqty_'+id).val();
                var orderprice = $('#orderprice_'+id).val();
                var totalPrice = +(orderqty*orderprice);
                totalPrice = totalPrice.toFixed(2);
                $('#ordertotal_'+id).val(totalPrice);
                getGrandtotal();
            }
            function getGrandtotal(){
                var orderCount = $('#orderCount').val();
                var subtotal = 0.00;
                var totalQty = 0;
                var deliveryCharge = 0.00;
                var gradnd_total = 0.00;
                var qtyvalue = 0;
                var subtotval = 0;
                for(var i=0; i <= orderCount; i++){
                    qtyvalue = isNumber($('#orderqty_'+i).val());
                    if(qtyvalue){
                      qtyvalue = parseInt($('#orderqty_'+i).val());  
                    }else{
                      qtyvalue = 0;
                    }
                    totalQty = parseInt(totalQty) + qtyvalue;
                    if(isNumber($('#ordertotal_'+i).val())){
                        subtotval = parseFloat($('#ordertotal_'+i).val());
                    } else{
                        subtotval = 0;
                    }
                    subtotal = parseFloat(subtotal) + subtotval;
                }
                
                if(subtotal >= 300){
                    gradnd_total = subtotal;
                    deliveryCharge = 0.00;

                }else{
                    deliveryCharge = 30.00;
                    gradnd_total = parseFloat(subtotal) + parseFloat(deliveryCharge);
                    
                }
                subtotal = subtotal.toFixed(2);
                deliveryCharge = deliveryCharge.toFixed(2);
                gradnd_total = gradnd_total.toFixed(2);
                $('#subtotal').val(subtotal);
                $('#deliverycharge').val(deliveryCharge);
                $('#totalQty').val(totalQty);
                $('#grandTotal').val(gradnd_total);
            }
            function loadOrderweightForm(ele,val){
                    var productId = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadOrderweightForm&productId="+productId+"&divid="+val,
                        success: function(msg){       
                            $('#orderWeightunitsDiv_'+val).html(msg);                                              
                        }
                    });
                }
                function loadOrderunitForm(ele,pid,val){
                    var productId = pid;
                    var productWt = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadOrderunitForm&productId="+productId+"&productWt="+productWt+"&divid="+val,
                        success: function(msg){       
                            $('#orderUnitDiv_'+val).html(msg);                                              
                        }
                    });
                }
                function getaddressbyphoneno(){
                    var userPhone = $('#userPhone').val();
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        dataType: 'json',
                        data: "action=getaddressbyphoneno&userPhone="+userPhone,
                        success: function(msg){       
                            $('#userName').val(msg.name);  
                            $('#userEmail').val(msg.email);  
                            $('#shippingAddress').val(msg.address);                                          
                        }
                    });
                }
             function isNumber(num) {
              return (typeof num == 'string' || typeof num == 'number') && !isNaN(num - 0) && num !== '';
            };
          </script>

 <?php 
   
}
function loadOrderweightForm(){
        $db = new DB();
        $productId = $_REQUEST['productId'];
        $divid = $_REQUEST['divid'];
        $query = "SELECT productWeight,productUnit FROM ".product_options." WHERE productId='".$productId."' AND active ='1'";
        $products = $db->get_results($query);
    ?>
        
        <select class="form-control" name="productWeight[]" id="orderweight_<?=$divid?>" data-cntid="<?=$divid?>" style="width:15% !important; float:left;" placeholder="Weight/Qty" required onChange='loadOrderunitForm(this,"<?=$productId?>","<?=$divid?>")'>
            <option value="">-Select Weight-</option>
            <? foreach($products as $product){ ?>
               <option value="<?=$product['productWeight']?>"><?=$product['productWeight']?></option>
            <? } ?>   
        </select> 
        <span id="orderUnitDiv_<?=$divid?>">
            <select class="form-control" name="orderUnit[]" id="orderUnit_<?=$divid?>" data-cntid="<?=$divid?>" style="width:20% !important; float:left;" placeholder="Unit" required >
                <option value="">-Unit-</option>
                <? foreach($products as $weightUnit){ ?>
                   <option value="<?=$weightUnit['productUnit']?>"><?=$weightUnit['productUnit']?></option>
                <? } ?>   
                </select> 
        </span>
           
<?php }
    
   function loadOrderunitForm(){
    $db = new DB();
    $productId = $_REQUEST['productId'];
    $divid = $_REQUEST['divid'];
    $productWt = $_REQUEST['productWt'];
    $query = "SELECT productUnit FROM ".product_options." WHERE productId='".$productId."' AND active ='1' AND productWeight ='".$productWt."'";
    $products = $db->get_results($query);
    ?>
    <select class="form-control" name="orderUnit[]" id="orderUnit_<?=$divid?>" data-cntid="<?=$divid?>" style="width:20% !important; float:left;" placeholder="Unit" required >
                <option value="">-Unit-</option>
                <? foreach($products as $weightUnit){ ?>
                   <option value="<?=$weightUnit['productUnit']?>"><?=$weightUnit['productUnit']?></option>
                <? } ?>   
                </select> 
   <?php } 
    function getProductprice($productid,$orderweight,$orderqty,$orderUnit){
        $db = new DB();
        if(is_numeric($orderUnit)){
           $prd_options = $db->get_row("SELECT product_options.id,productCost FROM ".PRODUCT_OPTIONS." INNER JOIN product_attribute_values on (product_attribute_values.attributeValue = product_options.productUnit) WHERE productId = '".$productid."' AND productWeight = '".$orderweight."' AND product_attribute_values.id = '".$orderUnit."' AND product_options.active = '1'",true);
         }else{
            $prd_options = $db->get_row("SELECT product_options.id,productCost FROM ".PRODUCT_OPTIONS." WHERE productId = '".$productid."' AND productWeight = '".$orderweight."' AND productUnit = '".$orderUnit."' AND product_options.active = '1'",true);
         }
       // echo "SELECT product_options.id,productCost FROM ".PRODUCT_OPTIONS." INNER JOIN product_attribute_values on (product_attribute_values.attributeValue = product_options.productUnit) WHERE productId = '".$productid."' AND productWeight = '".$orderweight."' AND product_attribute_values.id = '".$orderUnit."' AND product_options.active = '1'";
        if($prd_options){
            echo "{\"p_optid\":\"".$prd_options->id."\",\"price\":\"".$prd_options->productCost."\"}";
        }else{
            echo "{\"p_optid\":\" \",\"price\":\" \"}";
        }

    }
    function getaddressbyphoneno(){
        $db = new DB();
        $userPhone = $_REQUEST['userPhone'];
        $userdetails = $db->get_row("SELECT fullName,email,address FROM ".ORDER_DETAILS." WHERE mobileNumber = '".$userPhone."' ORDER BY id DESC",true);
        if($userdetails){
            echo "{\"name\":\"".$userdetails->fullName."\",\"email\":\"".$userdetails->email."\",\"address\":\"".$userdetails->address."\"}";
        }else{
            echo "{\"name\":\" \",\"email\":\" \",\"address\":\" \"}";
        }
    }
    function saveNewOrders(){

        $db = new DB();
        // for now
        date_default_timezone_set("Asia/Calcutta");
        $dateTime  = date('Y-m-d H:i:s', time());
        $grandTotal = $db->filter($_POST['subtotal']);
        $deliveryCost = $db->filter($_POST['deliverycharge']);  
        $totalAmount = $db->filter($_POST['grandTotal']); 
        $mobileNumber = $db->filter($_POST['userPhone']);
        $invoiceNo = $db->filter($_POST['invoiceNo']);
        $invoiceExits = $db->get_row("SELECT id FROM ".ORDER_DETAILS." WHERE invoiceNo = '".$invoiceNo."'",true);
        if($invoiceExits){
            return 'invoiceExits';
            exit;
        }
        $userdetails = $db->get_row("SELECT id FROM ".USERS." WHERE mobileNumber = '".$mobileNumber."' ",true);
        if($userdetails){
            $userId = $userdetails->id;
        }else{
            $password = $db->filter(randomPassword());
            $userdata = array(
                'fullName' => $db->filter($_POST['userName']),
                'email' => $db->filter($_POST['userEmail']),
                'mobileNumber' => $mobileNumber,
                'address' => $db->filter($_POST['shippingAddress']),
                'dateTime' => $dateTime,
                'password' => $password,
                'active' => '1'
            );
            $db->insert(USERS, $userdata);
            $userId = $db->lastid();
        }

        $data = array(
            'fullName' => $db->filter($_POST['userName']),
            'email' => $db->filter($_POST['userEmail']),
            'mobileNumber' => $mobileNumber,
            'address' => $db->filter($_POST['shippingAddress']),
            'dateTime' => $dateTime,
            'subTotal' => $grandTotal,
            'orderStatus' => 'Pending',
            'deliveryCost' => $deliveryCost,
            'totalAmount' => $totalAmount,
            'userId' => $userId,
            'invoiceNo' => $db->filter($_POST['invoiceNo'])
        );

        $rs = $db->insert(ORDER_DETAILS, $data);

        $order_detailsId = $db->lastid();

        if($rs){

            $productWeight = $_POST['productWeight'];
            $productUnit   = $_POST['orderUnit'];
            $price   = $_POST['price'];
            $orderQty  = $_POST['orderQty'];
            $productId   = $_POST['productId'];
            $totalPrice = $_POST['totalPrice'];
            $productoptionId = $_POST['productoptionId'];

            $i=0;

            foreach($productWeight as $productWt){
               if($productId[$i]!=''){
                   if(is_numeric($productUnit[$i])){
                                $attributeResult = $db->get_row("SELECT attributeValue FROM ".PRODUCT_ATTRIBUTE_VALUES." WHERE product_attribute_values.id = '".$productUnit[$i]."' ",true);
                                $attributeValue = $attributeResult->attributeValue;
                           }else{
                                $attributeValue = $productUnit[$i];
                           } 
                   if(is_numeric($productId[$i])){
                    
                       $productResult = $db->get_row("SELECT productName FROM ".PRODUCTS." WHERE products.id = '".$productId[$i]."' ",true);
                       $productName = $productResult->productName;

                       // $productResult = $db->get_row("SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE product_options.id = '".$productoptionId[$i]."' ",true);
                       // $productStock = $productResult->productStock;
                       
                       // $newproductStock =  $productStock - $orderQty[$i];
                       // if($newproductStock > 0){
                       //  $newproductStock = $newproductStock;
                       // }else{
                       //  $newproductStock = 0;
                       // }
                      
                       $records = array(
                            'orderId' => $order_detailsId,
                            'productWeight' => $productWeight[$i],
                            'productUnit' => $attributeValue,
                            'unitPrice' => $price[$i],
                            'quantity' => $orderQty[$i],
                            'productName' => $productName,
                            'productTotalPrice' => $totalPrice[$i],
                            'productOptionId' => $productoptionId[$i],
                            'productId' => $productId[$i],
                        );

                        $inserted = $db->insert(ORDER_ITEMS, $records);

                        // $updateStock = array(
                        //     'productStock' => $newproductStock
                        // );
                        // $stock_where_clause = array(
                        // 'id' => $productoptionId[$i]
                        // );
                        // $db->update(PRODUCT_OPTIONS, $updateStock, $stock_where_clause);
                        
                 }else{
                       $records = array(
                            'orderId' => $order_detailsId,
                            'productWeight' => $productWeight[$i],
                            'productUnit' => $attributeValue,
                            'unitPrice' => $price[$i],
                            'quantity' => $orderQty[$i],
                            'productName' => $productId[$i],
                            'productTotalPrice' => $totalPrice[$i]
                        );

                        $inserted = $db->insert(ORDER_ITEMS, $records); 
                }
            }
                $i++;
            }
            
           if($inserted){
                return $order_detailsId;
            }else{
                return false;
            }
        }


    }

    function updateOrderDetails(){

        $db = new DB();
        // for now
        date_default_timezone_set("Asia/Calcutta");
        $dateTime  = date('Y-m-d H:i:s', time());
        $order_detailsid = $_POST['order_detailsid'];
        $invoiceNo = $db->filter($_POST['invoiceNo']);
        $invoiceExits = $db->get_row("SELECT id FROM ".ORDER_DETAILS." WHERE invoiceNo = '".$invoiceNo."' AND id !='".$order_detailsid."'",true);
        if($invoiceExits){
            return 'invoiceExits';
            exit;
        }
        $grandTotal = $db->filter($_POST['grandTotal']);
        $subtotal = $db->filter($_POST['subtotal']);
        $deliveryCost = $db->filter($_POST['deliverycharge']);
        $totalAmount = $grandTotal;

        $mobileNumber = $db->filter($_POST['userPhone']);
        $userdetails = $db->get_row("SELECT id FROM ".USERS." WHERE mobileNumber = '".$mobileNumber."' ",true);
        if($userdetails){
            $userId = $userdetails->id;
        }else{
            $password = $db->filter(randomPassword());
            $userdata = array(
                'fullName' => $db->filter($_POST['userName']),
                'email' => $db->filter($_POST['userEmail']),
                'mobileNumber' => $mobileNumber,
                'address' => $db->filter($_POST['shippingAddress']),
                'dateTime' => $dateTime,
                'password' => $password,
                'active' => '1'
            );
            $db->insert(USERS, $userdata);
            $userId = $db->lastid();
        }

        $update = array(
            'fullName' => $db->filter($_POST['userName']),
            'email' => $db->filter($_POST['userEmail']),
            'mobileNumber' => $mobileNumber,
            'address' => $db->filter($_POST['shippingAddress']),
            'updatedtime' => $dateTime,
            'subTotal' => $subtotal,
            'orderStatus' => 'Pending',
            'deliveryCost' => $deliveryCost,
            'totalAmount' => $totalAmount,
            'userId' => $userId,
            'invoiceNo' => $db->filter($_POST['invoiceNo']),
            'updatedBy' => $_SESSION['adminId'],
            'note' => $db->filter($_POST['note'])
        );

        $where_clause = array(
            'id' => $order_detailsid
        );

        $rs = $db->update(ORDER_DETAILS, $update, $where_clause);



        $order_detailsId = $order_detailsid;

        if($rs){

            $update = array(
                'active' => '0'
            );
            $where_clause = array(
            'orderId' => $order_detailsid
            );
            $db->update(ORDER_ITEMS, $update, $where_clause);

            $productWeight = $_POST['productWeight'];
            $productUnit   = $_POST['orderUnit'];
            $price   = $_POST['price'];
            $orderQty  = $_POST['orderQty'];
            $productId   = $_POST['productId'];
            $totalPrice = $_POST['totalPrice'];
            $productoptionId = $_POST['productoptionId'];

            $i=0;

            foreach($productWeight as $productWt){
                if($productId[$i]!=''){
                       if(is_numeric($productUnit[$i])){
                            $attributeResult = $db->get_row("SELECT attributeValue FROM ".PRODUCT_ATTRIBUTE_VALUES." WHERE product_attribute_values.id = '".$productUnit[$i]."' ",true);
                            $attributeValue = $attributeResult->attributeValue;
                       }else{
                            $attributeValue = $productUnit[$i];
                       } 
                       

                       if(is_numeric($productId[$i])){
                        
                           $productResult = $db->get_row("SELECT productName FROM ".PRODUCTS." WHERE products.id = '".$productId[$i]."' ",true);
                           $productName = $productResult->productName;
                          
                           $records = array(
                                'orderId' => $order_detailsId,
                                'productWeight' => $productWeight[$i],
                                'productUnit' => $attributeValue,
                                'unitPrice' => $price[$i],
                                'quantity' => $orderQty[$i],
                                'productName' => $productName,
                                'productTotalPrice' => $totalPrice[$i],
                                'productOptionId' => $productoptionId[$i],
                                'productId' => $productId[$i],
                            );

                            $inserted = $db->insert(ORDER_ITEMS, $records);
                     }else{
                           $records = array(
                                'orderId' => $order_detailsId,
                                'productWeight' => $productWeight[$i],
                                'productUnit' => $attributeValue,
                                'unitPrice' => $price[$i],
                                'quantity' => $orderQty[$i],
                                'productName' => $productId[$i],
                                'productTotalPrice' => $totalPrice[$i]
                            );

                            $inserted = $db->insert(ORDER_ITEMS, $records); 
                    }
                }
                $i++;
            }

           if($inserted){
                return $order_detailsId;
            }else{
                return false;
            }
        }


    }
    function viewOrderDetail($orderId){

        $db = new DB();

        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, address, note, subTotal, deliveryCost, totalAmount, orderStatus, dateTime,invoiceNo FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
// pre($orderDetails);
      
        $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");
// pre($records);
        $update = array(
            'viewOrders' => '1'
        );
        $where_clause = array(
            'id' => $orderId
        );
        $updated = $db->update(ORDER_DETAILS, $update, $where_clause);
        ?>

        <script type="text/javascript">
            function ruSure(status,orderId,oldStatus){
                
                if(!confirm("Are you sure you want to change the order status to "+status)){
                    //$("#orderStatusOpt").val(oldStatus);
                     $("#orderStatusOpt option[value='"+oldStatus+"']").prop('selected', true);
                    //document.forms[0].reset();
                }else{
                    if((oldStatus == 'Confirmed' || oldStatus == 'Shipped' || oldStatus == 'Delivered') && (status =='Pending')){
                        alert("You cannot change the "+oldStatus+" order to "+status);
                        $("#orderStatusOpt option[value='"+oldStatus+"']").prop('selected', true);
                        return false;
                    }
                    if((oldStatus == 'Shipped' || oldStatus == 'Delivered') && (status =='Confirmed')){
                        alert("You cannot change the "+oldStatus+" order to "+status);
                        $("#orderStatusOpt option[value='"+oldStatus+"']").prop('selected', true);
                        return false;
                    }
                    if((oldStatus == 'Pending') && (status =='Cancel')){
                        alert("You cannot change the "+oldStatus+" order to "+status);
                        $("#orderStatusOpt option[value='"+oldStatus+"']").prop('selected', true);
                        return false;
                    }
                    if((oldStatus == 'Delivered' || oldStatus == 'Cancel' || oldStatus == 'Pending') && (status =='Shipped')){
                        alert("You cannot change the "+oldStatus+" order to "+status);
                        $("#orderStatusOpt option[value='"+oldStatus+"']").prop('selected', true);
                        return false;
                    }
                    if((oldStatus == 'Confirmed' || oldStatus == 'Cancel' || oldStatus == 'Pending') && (status =='Delivered')){
                        alert("You cannot change the "+oldStatus+" order to "+status);
                        $("#orderStatusOpt option[value='"+oldStatus+"']").prop('selected', true);
                        return false;
                    }   

                    $.ajax
                        ({
                            type: "POST",
                            url: "index.php",
                            data:{ action:'changeOrderStatus',status:status,orderId:orderId},  
                            success: function(msg)
                            {                                          
                                // alert(msg);
                                 //alert(status);
                                 //$("#orderStatusOpt").find('option').removeAttr("selected");
                                
                                $('.rsSure').css('display','block');
                                $('.rsSure').html("Status Change to "+status);
                                setTimeout(function(){
                                     location.reload();}, 1500);
                               
                                // confirm("Status Change to  "+status)
        
                            }
                        });
                }
            }


        </script>
        <div class="row">
                <div class="col-lg-12 alert alert-success rsSure"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Order Detail</h1>
                </div>
                <div class="col-lg-12 text-right margin-bottom10">
                        <a href="<?=APP_URL?>/index.php?page=editOrderDetail&orderId=<?=$orderId?>&orderStatus=<?=$orderDetails->orderStatus?>&prevPage=viewOrderDetail" title="Edit Order Detail" class="btn btn-primary">Edit</a>
                        <a href="<?=APP_URL?>/printorders.php?orderId=<?=$orderId;?>" title="Print order" target="_blank" class="btn btn-info">Print</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Order Detail
                           <!--  <form name="orderFrom" action="" method="post">
                                <input type="hidden" name="action" value="changeOrderStatus" /> -->
                                <!-- <input type="hidden" name="orderId" value="<?=$orderDetails->id?>"/> -->

                                <span style="float:right">
                                    <label>Order Status: </label>&nbsp;
                                    
                                    <select name="orderStatus" id="orderStatusOpt" onchange="ruSure(this.value,'<?=$orderDetails->id?>','<?=$orderDetails->orderStatus?>')">
                                        <option value="Pending" <?=($orderDetails->orderStatus=='Pending')?'selected=selected':''?>>Pending</option>
                                        <option value="Confirmed" <?=($orderDetails->orderStatus=='Confirmed')?'selected=selected':''?>>Confirmed</option>
                                        <option value="Cancel" <?=($orderDetails->orderStatus=='Cancel')?'selected=selected':''?>>Cancel</option>
                                        <option value="Shipped" <?=($orderDetails->orderStatus=='Shipped')?'selected=selected':''?>>Shipped</option>
                                        <option value="Delivered" <?=($orderDetails->orderStatus=='Delivered')?'selected=selected':''?>>Delivered</option>
                                    </select>
                                   
                                </span>
                            <!-- </form> -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                       <div class="col-md-12 paymentSteps">

    <table cellspacing="0" cellpadding="0" style="width:800px;margin:0 auto;padding:20px;background-color:#F3F3F3;">
   
    <tr style="font-family:arial;background-color:#ffffff;">
        <td colspan="3" style="padding:0 15px;">
            <div style="margin-bottom:15px;">
                <h2 style="margin-bottom: 5px;padding-bottom: 5px;font-weight:normal;font-size:20px;color:#00A1E2;">
                    Shipping Address 
                    <p style="margin:0;float:right;color:#000000;"><span style="color:#00A1E2;">Invoice No :</span> <?=$orderDetails->invoiceNo?></p>
                </h2>
                <p style="margin:0;"><?=$orderDetails->fullName?></p>
                <p style="margin:0;"><?=$orderDetails->mobileNumber?></p>
                <p style="margin:0;"><?=$orderDetails->address?></p>
                <p style="margin:0;"><?=$orderDetails->note?></p>
                <p style="margin:0;"><?=stdDateFormat($orderDetails->dateTime)?></p>
            </div>
        </td>
    </tr>
    <tr style="font-family:arial;background-color:#ffffff;">
        <td colspan="3" style="padding:0 15px;">
            <h2 style="margin-bottom: 5px;margin-top:5px;padding-bottom: 5px;font-weight:normal;font-size:20px;color:#00A1E2;">Order Detail</h2>
            <table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:100%;text-align:center;border-color:#e5e5e5;">
                <tr>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Item</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Description</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Quantity</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Unit Price</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Total</th>
                </tr>

                <?  foreach($records as $record){

                        // $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                        //                               WHERE id='".$record['productId']."'", true);

                        $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                      WHERE productId='".$record['productId']."'", true);
                        $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                        // pre($productOption);
                        $productTotal = $record['quantity']*$record['unitPrice'];
                        $totalItems+= $record['quantity'];
                        $subTotal+=$productTotal;
                ?>
                <tr>
                    <td style="padding:5px;border-color:#e5e5e5;">
                        <? if(isset($productImageData->image) && $productImageData->image!=''){ ?> 
                            <img src="productFiles/images/thumb/<?=$productImageData->image?>"  title="Chitki - <?=$record['productName']?>" alt="Chitki - Grocery Shopping Mangalore">
                        <? }else{ ?>

                            <img src="productFiles/images/default.png" style="witdh:150px;height:150px;" class="center-block" title="Chitki - Grocery Shopping Mangalore" alt="Chitki - Grocery Shopping Mangalore">
            
                        <? } ?>
                    </td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productName']?> (<?=$record['productWeight']?> <?=$record['productUnit']?>)</td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['quantity']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($record['unitPrice'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($productTotal,2)?></td>
                </tr>
                <?}?>
                           
            </table>
            <p style="margin:10px 0 0 0;text-align:right;color:#5b5b5b;font-size:14px;">Sub Total : &#8377; <?=number_format($orderDetails->subTotal, 2)?></p>
            <p style="margin:0;text-align:right;color:#5b5b5b;font-size:14px;">Delivery Charges : &#8377; <?=number_format($orderDetails->deliveryCost, 2)?></p>
            <p style="margin:5px 0 10px 0;text-align:right;font-size:20px;font-weight:normal;">Total Payable : &#8377; <?=number_format($orderDetails->totalAmount, 2)?></p>
        </td>
    </tr>
    
</table>

            <div style="clear:both;width:100%;"></div>
            <div class="separator"></div>
            </div>
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

    function changeOrderStatus($orderId){
        $db = new DB();

        // $confirmedExits = $db->get_row("SELECT orderStatus FROM ".ORDER_DETAILS." WHERE id = '".$orderId."'",true);
        // $confirmedExits->orderStatus;
        // exit;
        // if($confirmedExits->orderStatus == 'Confirmed'){
        //     return 'confirmedExits';
        //     exit;
        // }
        if($_REQUEST['status'] == 'Confirmed'){
          $item_records = $db->get_results("SELECT productOptionId,quantity FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");  
       
          foreach($item_records as $item_record){  
                $productOption = $db->get_row("SELECT product_options.id, productStock FROM ".PRODUCT_OPTIONS." WHERE product_options.id='".$item_record['productOptionId']."'", true);
                // pre($productOption);
                $old_stockqty = $productOption->productStock;
                $itemqty = $item_record['quantity'];
                $newStock = $old_stockqty - $itemqty;
                if($newStock > 0){
                    $newStock = $newStock;
                }else{
                    $newStock = 0;
                }
                $updateStock = array(
                    'productStock' => $newStock
                );
                $where_stockclause = array(
                    'id' => $item_record['productOptionId']
                 );
                $updated = $db->update(PRODUCT_OPTIONS, $updateStock, $where_stockclause, 1 );
            }    
                
        }
        if($_REQUEST['status'] == 'Cancel'){
          $item_records = $db->get_results("SELECT productOptionId,quantity FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");  
       
          foreach($item_records as $item_record){  
                $productOption = $db->get_row("SELECT product_options.id, productStock FROM ".PRODUCT_OPTIONS." WHERE product_options.id='".$item_record['productOptionId']."'", true);
                // pre($productOption);
                $old_stockqty = $productOption->productStock;
                $itemqty = $item_record['quantity'];
                $newStock = $old_stockqty + $itemqty;
                if($newStock > 0){
                    $newStock = $newStock;
                }else{
                    $newStock = 0;
                }
                $updateStock = array(
                    'productStock' => $newStock
                );
                $where_stockclause = array(
                    'id' => $item_record['productOptionId']
                 );
                $updated = $db->update(PRODUCT_OPTIONS, $updateStock, $where_stockclause, 1 );
            }    
                
        }
        $update = array(
            'orderStatus' => $_REQUEST['status']
        
        );

        $where_clause = array(
            'id' => $orderId
        );

        $updated = $db->update(ORDER_DETAILS, $update, $where_clause, 1 );

        if($updated){
            return true;
        }else{
            return false;
        }

    }

function editOrderDetail($orderId){

        $db = new DB();

        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, address, note, subTotal, deliveryCost, totalAmount, orderStatus, dateTime,invoiceNo FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
// pre($orderDetails);
        $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");
         $update = array(
            'viewOrders' => '1'
        );
        $where_clause = array(
            'id' => $orderId
        );
        $updated = $db->update(ORDER_DETAILS, $update, $where_clause);
        if($orderDetails->invoiceNo == ''){
            $invoiceNoOrderDetails = $db->get_row("SELECT invoiceNo FROM order_details WHERE invoiceNo IS NOT NULL AND TRIM(invoiceNo) <> '' ORDER BY id DESC LIMIT 1 ", true);
            $oldinvoice = substr($invoiceNoOrderDetails->invoiceNo,4);
            $newinvoiceNo = $oldinvoice + 1;
            $orderDetails->invoiceNo = "CTKI".$newinvoiceNo;
        }
        ?>

            <link href="css/magicsuggest-min.css" rel="stylesheet">
            <script src="js/magicsuggest-min.js"></script>      
            
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Order Detail</h1>
                </div>
               
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Order Detail
                           <!--  <form name="orderFrom" action="" method="post">
                                <input type="hidden" name="action" value="changeOrderStatus" /> -->
                                <!-- <input type="hidden" name="orderId" value="<?=$orderDetails->id?>"/> -->

                                
                            <!-- </form> -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                       <div class="col-md-12 paymentSteps">
                                        <form action="" name="order_form" method="post" role="form" enctype="multipart/form-data" >
                                        <input type="hidden" name="action" value="updateOrderDetails" />
                                        <input type="hidden" name="order_detailsid" value="<?=$orderDetails->id?>" />
                                        <input type="hidden" name="orderStatus" value="<?=$_REQUEST['orderStatus']?>" />
                                        <section>
                                            <div class="panel-body">
                                                <h3>Shipping Address : </h3>
                                                 <div class="form-group">
                                                    <label>Phone number:</label>
                                                    <input type="text" class="form-control" required="" value="<?=$orderDetails->mobileNumber?>" id="userPhone" name="userPhone" onblur="getEditaddressbyphoneno();">
                                                </div>  
                                                <div class="form-group">
                                                    <label>Name:</label>
                                                    <input type="text" class="form-control" required="" value="<?=$orderDetails->fullName?>" id="userName" name="userName">
                                                </div>   
                                              
                                                <div class="form-group">
                                                    <label> Email:</label>
                                                    <input type="text" class="form-control" value="<?=$orderDetails->email?>" id="userEmail" name="userEmail">
                                                </div> 
                                                <div class="form-group">
                                                    <label> Shipping address:</label>
                                                    <textarea class="form-control" name="shippingAddress" id="shippingAddress" rows="3" required=""><?=$orderDetails->address?></textarea>
                                                </div> 
                                                <div class="form-group">
                                                    <label> Invoice number:</label>
                                                    <input type="text" class="form-control" name="invoiceNo" rows="3" required="" value="<?=$orderDetails->invoiceNo?>"/>
                                                </div> 
                                                <div class="form-group">
                                                    <label> Note:</label>
                                                    <textarea class="form-control" name="note" rows="3" ><?=$orderDetails->note?></textarea>
                                                </div> 
                                            </div>
                                        </section>
                                        
                                        <section>
                                            <div class="panel-body additemFields">
                                               <div class="">
                                                    <h2 style="margin-bottom: 5px;margin-top:5px;padding-bottom: 5px;font-weight:normal;font-size:20px;color:#00A1E2;">Order Detail</h2><br/>
                                                    <?  
                                                    $orderCount = 0;
                                                    foreach($records as $record){  
                                                         $productOption = $db->get_row("SELECT product_options.id, productWeight, productUnit, productCost, productStock FROM ".PRODUCT_OPTIONS." WHERE product_options.id='".$record['productOptionId']."'", true);
                                                            // pre($productOption);
                                                            $productTotal = $record['quantity']*$record['unitPrice'];
                                                            $totalItems+= $record['quantity'];
                                                            $subTotal+=$productTotal;
                                                    ?>

                                                    <div class="row orderDetailsrow">
                                                    <div class="orderaddsuggest" id="ordersuggest_<?=$orderCount?>" style="width:25% !important; float:left;" placeholder="Product name"></div>
                                                    <input type="hidden" name="productId[]" id="productId_<?=$orderCount?>" value="<?=$record['productId']?>">
                                                    <input type="text" class="form-control getPriceval" data-ordercnt="<?=$orderCount?>" id="orderweight_<?=$orderCount?>" name="productWeight[]" value="<?=$record['productWeight']?>" style="width:15% !important; float:left;" placeholder="Weight/Qty" required>
                                                    <div class="orderaddsuggest1 getPriceval" id="ordersuggest1_<?=$orderCount?>" style="width:20% !important; float:left;" placeholder="Unit"></div>
                                                    <input type="hidden" name="orderUnit[]" id="orderUnit_<?=$orderCount?>" value="<?=$productOption->prod_unitId?>"  />
                                                    <input type="text" class="form-control getPriceval" data-ordercnt="<?=$orderCount?>" name="orderQty[]" id="orderqty_<?=$orderCount?>" value="<?=$record['quantity']?>" style="width:10% !important; float:left;" placeholder="Qty" required>
                                                    <input type="text" class="form-control getTotalval" name="price[]" value="<?=$record['unitPrice']?>" id="orderprice_<?=$orderCount?>"  onfocus="getorderPrice(<?=$orderCount?>);" data-ordercnt="<?=$orderCount?>" style="width:10% !important; float:left;" placeholder="Price" required>   
                                                    <input type="hidden" name="productoptionId[]" id="productOptionId_<?=$orderCount?>" value="<?=$record['productOptionId']?>"> 
                                                    <input type="text" class="form-control" name="totalPrice[]" value="<?=$productTotal?>" id="ordertotal_<?=$orderCount?>" style="width:10% !important; float:left;" placeholder="Total price" readonly>
                                                    <a onclick="deleteOrderedItems('<?=$record['id'];?>',<?=$record['orderId']?>,'<?=$record['productName']?>','<?=$productTotal?>','<?=$orderDetails->subTotal?>');" title="Delete Orders" data-val="<?=$record['id'];?>" href="javascript:void(0);">
                                                        <i class="fa fa-trash-o fa-lg"></i>
                                                    </a>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            
                                                            var productid = "<?=$record['productId']?>";
                                                            var productName = "<?=$record['productName']?>";
                                                            var productunit = "<?=$record['productUnit']?>";
                                                            var count = "<?=$orderCount?>";
                                                            if(productid == 0){
                                                                productid = productName;
                                                            }
                                                            
                                                            var prdord_name = $('#ordersuggest_'+count).magicSuggest({
                                                                    value: [productid],
                                                                    data: 'get_productnames.php'

                                                            });
                                                           var prdord_unit = $('#ordersuggest1_'+count).magicSuggest({
                                                                    value: [productunit],
                                                                    data: 'get_productunits.php'
                                                                 });
                                                              
                                                             $(prdord_name).on('selectionchange', function(e,m){
                                                                        
                                                                        $('#productId_'+count).val(this.getValue());

                                                                });
                                                             $(prdord_unit).on('selectionchange', function(e,m){
                                                                        
                                                                        $('#orderUnit_'+count).val(this.getValue());

                                                                });


                                                            });
                                                            
                                                    </script>
                                                    
                                                    </div>
                                                    <?php $orderCount++;
                                                             } ?>
                                                     </div>         
                                                    <div class="">
                                                        <div class="row orderDetailsrow">
                                                            <div class="orderaddsuggest" style="width:25% !important; float:left;" placeholder="Product name" data-ordercnt="<?=$orderCount?>"></div>
                                                            <input type="hidden" name="productId[]" id="productId_<?=$orderCount?>">
                                                            <input type="text" class="form-control getPriceval" data-ordercnt="<?=$orderCount?>" id="orderweight_<?=$orderCount?>" name="productWeight[]" style="width:15% !important; float:left;" placeholder="Weight/Qty" >
                                                            <div class="orderaddsuggest1 getPriceval" style="width:20% !important; float:left;" placeholder="Unit"></div>
                                                            <input type="hidden" name="orderUnit[]" id="orderUnit_<?=$orderCount?>"  >
                                                            <input type="text" class="form-control getPriceval" data-ordercnt="<?=$orderCount?>" name="orderQty[]" id="orderqty_<?=$orderCount?>" value="" style="width:10% !important; float:left;" placeholder="Qty" >
                                                            
                                                            <input type="text" class="form-control getTotalval" name="price[]" value="" id="orderprice_<?=$orderCount?>"  onfocus="getorderPrice(<?=$orderCount?>);" data-ordercnt="<?=$orderCount?>" style="width:10% !important; float:left;" placeholder="Price" >   
                                                            <input type="hidden" name="productoptionId[]" id="productOptionId_<?=$orderCount?>"> 
                                                            <input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_<?=$orderCount?>" style="width:10% !important; float:left;" placeholder="Total price" readonly>
                                                             
                                                            <a href="javascript:void(0);" id="addMoreOrderdetails"  data-val="moreOrderdetails" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
                                                            <a href="javascript:void(0);" id="removeMoreOrderdetails" data-val="moreOrderdetails" Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>
                                                       </div>
                                                    </div> 
                                                    <input type="hidden" id="orderCount" name="orderCount" value="<?=$orderCount?>" >
                                                       
                                                    <div class='moreOrderdetails' id="moreOrderdetails">
                                                    </div> 
                                                   
                                                
                                                
                                                   
                                                

                                             </div>   
                                         </section>  
                                         <section>
                                            <div class="panel-body">
                                               <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <a href="javascript:void(0);" onClick="getGrandtotal();" Title="Grand total" class="btn btn-default ">Get Grand Total</a>
                                                </div>
                                                <div class="totalOrders col-lg-offset-4 col-lg-2 ">
                                                        <input type="hidden" name="totalQty" id="totalQty" class="form-control"  required /> 
                                                        <p >Sub Total : <input type="text" name="subtotal" id="subtotal" class="form-control" required value="<?=$orderDetails->subTotal?>" /></p>
                                                        <p >Delivery Charges : <input type="text" name="deliverycharge" id="deliverycharge" class="form-control" required value="<?=$orderDetails->deliveryCost?>" /></p>
                                                        <p >Total Payable : <input type="text" name="grandTotal" id="grandTotal" class="form-control" required value="<?=$orderDetails->totalAmount?>" /></p>
                                                </div>  
                                               </div> 
                                               
                                                <div class="form-group">
                                                 <button type="submit" class="btn btn-default text-right editOrdersubmit">Submit</button> 
                                                </div>
                                               </div> 
                                            </div>   
                                       </section> 
                                       </form>  
            <div style="clear:both;width:100%;"></div>
            <div class="separator"></div>
            </div>
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
            <script type="text/javascript">
                $(document).ready(function() {
                  $('.editOrdersubmit').attr("disabled", "true"); 
                    
                  var prdorder_name = $('.orderaddsuggest').magicSuggest({
                        //data: ['Paris', 'New York', 'Gotham']
                        data: 'get_productnames.php'

                    });
                  var prdorder_unit = $('.orderaddsuggest1').magicSuggest({
                        data: 'get_productunits.php'
                       

                    });

                    $(prdorder_name).on('selectionchange', function(){
                                              
                        $('#productId_'+orderCount).val(this.getValue());

                    });
                    $(prdorder_unit).on('selectionchange', function(){
                        $('#orderUnit_'+orderCount).val(this.getValue());
                        
                     });
                   

                });
                $(window).load(function() {
                    $('.editOrdersubmit').removeAttr("disabled");
                });
                function deleteOrderedItems(orderItemid,orderId,productname,itemtotal,subtotal){
                //$('#deleteOrderedItems').click(function(){
                    
               

                    if(confirm("Are you sure you want to delete this item ?")){
                        $.ajax
                            ({
                                type: "POST",
                                url: "ajxHandler.php",
                                data: "action=deleteOrderedItems&orderItemid="+orderItemid+"&orderId="+orderId+"&itemtotal="+itemtotal+"&subtotal="+subtotal,
                                success: function(msg){       
                                    if(msg=='success'){
                                        // $('.option_'+productOptionId).css('display', 'none');
                                        sessionStorage.reloadAfterPageLoad = true;
                                        sessionStorage.reloadAfterProductname = productname;
                                        window.location.reload(true);
                                         
                                    }                                                               
                                }
                            });
                    }
               // });
                }
                $(function(){
                     
                    if ((sessionStorage.reloadAfterPageLoad !=='false') && (sessionStorage.reloadAfterPageLoad !== undefined)) {
                        alert(sessionStorage.reloadAfterProductname+' has been deleted from order items!');
                        sessionStorage.reloadAfterPageLoad = false;
                    }
                });
                $(".getPriceval").on("keyup keypress blur change focus", function(){
                    
                    var id = $(this).attr("data-ordercnt");
                    
                    var productid = $('#productId_'+id).val();
                    var orderweight = $('#orderweight_'+id).val();
                    var orderqty = $('#orderqty_'+id).val();
                    var orderUnit = $('#orderUnit_'+id).val();
                    // alert(productid);
                    // alert(orderweight);
                    // alert(orderqty);
                    // alert(orderUnit);
                    if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                        $.ajax({
                                type: "POST",
                                url: "index.php",
                                dataType: 'json',
                                data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                                success: function(data)
                                {    
                                     
                                     $('#productOptionId_'+id).val(data.p_optid);                                      
                                     $('#orderprice_'+id).val(data.price);
                                     getorderTotal(id);
            
                                }
                            });
                         
                    }
                });
                $(".getTotalval").on("keyup keydown keypress blur change focus", function(){
                    var id = $(this).attr("data-ordercnt");
                    getorderTotal(id);
                });
            
            var orderCount = "<?=$orderCount?>";
            $('#addMoreOrderdetails').click(function(){
                var content = $(this).attr("data-val");
            
                orderCount= parseInt(orderCount) + 1;
                var contentID = document.getElementById(content);
                console.log(contentID);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+orderCount;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+= '<div class="row orderDetailsrow"><div class="orderaddsuggest" style="width:25% !important; float:left;" placeholder="Product name"></div><input type="hidden" name="productId[]" id="productId_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" id="orderweight_'+orderCount+'" name="productWeight[]" style="width:15% !important; float:left;" placeholder="Weight/Qty" required><div class="orderaddsuggest1 getPriceval" style="width:20% !important; float:left;" placeholder="Unit"></div><input type="hidden" name="orderUnit[]" id="orderUnit_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderQty[]" id="orderqty_'+orderCount+'" style="width:10% !important; float:left;" placeholder="Qty" required><input type="text" class="form-control getTotalval" name="price[]" value="" id="orderprice_'+orderCount+'"  onfocus="getorderPrice( \''+orderCount+'\');"  data-ordercnt="'+orderCount+'" style="width:10% !important; float:left;" placeholder="Price" required><input type="hidden" name="productoptionId[]" id="productOptionId_'+orderCount+'"><input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_'+orderCount+'" onfocus="getorderTotal(\''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Total price" readonly></div>';
                //newTBDiv.innerHTML+='<div class="magicsuggest" style="width:25% !important; float:left;" placeholder="Product name"></div><input type="hidden" name="productId[]" id="productId_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="productWeight[]" id="orderweight_'+orderCount+'" style="width:15% !important; float:left;" placeholder="Weight/Qty" required><div class="magicsuggest1" style="width:20% !important; float:left;" placeholder="Unit"></div><input type="hidden" name="orderUnit[]" id="orderUnit_'+orderCount+'"><input type="text" class="form-control getPriceval" data-ordercnt="'+orderCount+'" name="orderQty[]" id="orderqty_'+orderCount+'" value="" style="width:10% !important; float:left;" placeholder="Qty" required><input type="text" class="form-control" name="price[]" id="orderprice_'+orderCount+'" value="" onfocus="getorderPrice( \''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Price" required><input type="hidden" name="productoptionId[]" id="productOptionId_'+orderCount+'"><input type="text" class="form-control" name="totalPrice[]" value="" id="ordertotal_'+orderCount+'" onfocus="getorderTotal(\''+orderCount+'\');" style="width:10% !important; float:left;" placeholder="Total price" required>';
                contentID.appendChild(newTBDiv);
                $('#orderCount').val(orderCount);
                var ms = $('.orderaddsuggest').magicSuggest({
                        data: 'get_productnames.php'

                    });
                var ord_unit =   $('.orderaddsuggest1').magicSuggest({
                        data: 'get_productunits.php'

                    });
                    
                    $(ms).on('selectionchange', function(){
                        $('#productId_'+orderCount).val(this.getValue());
                    });
                    $(ord_unit).on('selectionchange', function(){
                        $('#orderUnit_'+orderCount).val(this.getValue());
                    });
                    $(".getPriceval").on("keyup keydown keypress blur change focus", function(){

                    var id = $(this).attr("data-ordercnt");
                    
                    var productid = $('#productId_'+id).val();
                    var orderweight = $('#orderweight_'+id).val();
                    var orderqty = $('#orderqty_'+id).val();
                    var orderUnit = $('#orderUnit_'+id).val();
                    
                    if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                        $.ajax({
                                type: "POST",
                                url: "index.php",
                                dataType: 'json',
                                data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                                success: function(data)
                                {    
                                     
                                     $('#productOptionId_'+id).val(data.p_optid);                                      
                                     $('#orderprice_'+id).val(data.price);
                                     getorderTotal(id);
            
                                }
                            });
                        

                    }
                });
                $(".getTotalval").on("keyup keydown keypress blur change focus", function(){
                            var id = $(this).attr("data-ordercnt");
                            getorderTotal(id);
                        });
            });
            
            $('#removeMoreOrderdetails').click(function(){
                var content = $(this).attr("data-val");
                var orderCount = parseInt($('#orderCount').val());

                if(orderCount != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+orderCount));
                    orderCount = orderCount-1;
                    $('#orderCount').val(orderCount);
                }
            });

            function getorderPrice(id){
                var productid = $('#productId_'+id).val();
                var orderweight = $('#orderweight_'+id).val();
                var orderqty = $('#orderqty_'+id).val();
                var orderUnit = $('#orderUnit_'+id).val();
                if(orderweight==''){
                    alert('Select Weight');
                }
                if(orderqty==''){
                    alert('Select Qty');
                }
                if(orderUnit==''){
                    alert('Select Unit');
                }
                if(productid!='' && orderweight!='' && orderqty!='' && orderUnit!=''){
                    $.ajax({
                            type: "POST",
                            url: "index.php",
                            dataType: 'json',
                            data:{ action:'getProductprice',productid:productid,orderweight:orderweight,orderqty:orderqty,orderUnit:orderUnit},  
                            success: function(data)
                            {    
                                 
                                 $('#productOptionId_'+id).val(data.p_optid);                                      
                                 $('#orderprice_'+id).val(data.price);
                                 getorderTotal(id);
        
                            }
                        });
                }
                
            }
            function getorderTotal(id){
                var orderqty = $('#orderqty_'+id).val();
                var orderprice = $('#orderprice_'+id).val();
                var totalPrice = +(orderqty*orderprice);
                totalPrice = totalPrice.toFixed(2);
                $('#ordertotal_'+id).val(totalPrice);
                getGrandtotal();
            }
            function getGrandtotal(){
                var orderCount = $('#orderCount').val();
                var subtotal = 0.00;
                var totalQty = 0;
                var deliveryCharge = 0.00;
                var gradnd_total = 0.00;
                var qtyvalue = 0;
                var subtotval = 0;

                for(var i=0; i <= orderCount; i++){
                    qtyvalue = isNumber($('#orderqty_'+i).val());
                    if(qtyvalue){
                      qtyvalue = parseInt($('#orderqty_'+i).val());  
                    }else{
                      qtyvalue = 0;
                    }
                    totalQty = parseInt(totalQty) + qtyvalue;
                    if(isNumber($('#ordertotal_'+i).val())){
                        subtotval = parseFloat($('#ordertotal_'+i).val());
                    } else{
                        subtotval = 0;
                    }
                    subtotal = parseFloat(subtotal) + subtotval;
                }
                
                if(subtotal >= 300){
                    gradnd_total = subtotal;
                    deliveryCharge = 0.00;

                }else{
                    deliveryCharge = 30.00;
                    gradnd_total = parseFloat(subtotal) + parseFloat(deliveryCharge);
                    
                }
                subtotal = subtotal.toFixed(2);
                deliveryCharge = deliveryCharge.toFixed(2);
                gradnd_total = gradnd_total.toFixed(2);
                $('#subtotal').val(subtotal);
                $('#deliverycharge').val(deliveryCharge);
                $('#totalQty').val(totalQty);
                $('#grandTotal').val(gradnd_total);
            }
            function getEditaddressbyphoneno(){
                    var userPhone = $('#userPhone').val();
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        dataType: 'json',
                        data: "action=getEditaddressbyphoneno&userPhone="+userPhone,
                        success: function(msg){       
                            $('#userName').val(msg.name);  
                            $('#userEmail').val(msg.email);  
                            $('#shippingAddress').val(msg.address);                                          
                        }
                    });
                }
            function isNumber(num) {
              return (typeof num == 'string' || typeof num == 'number') && !isNaN(num - 0) && num !== '';
            };
          </script>

        <?
    }
    function getEditaddressbyphoneno(){
        $db = new DB();
        $userPhone = $_REQUEST['userPhone'];
        $userdetails = $db->get_row("SELECT fullName,email,address FROM ".ORDER_DETAILS." WHERE mobileNumber = '".$userPhone."' ORDER BY id DESC",true);
        if($userdetails){
            echo "{\"name\":\"".$userdetails->fullName."\",\"email\":\"".$userdetails->email."\",\"address\":\"".$userdetails->address."\"}";
        }else{
            echo "{\"name\":\" \",\"email\":\" \",\"address\":\" \"}";
        }
    }
function deleteOrderedItems(){
        $db = new DB();
        date_default_timezone_set("Asia/Calcutta");
        $dateTime  = date('Y-m-d H:i:s', time());
        $_REQUEST['itemtotal'];
        $_REQUEST['subtotal'];
        
        $newsubtotal = $_REQUEST['subtotal'] - $_REQUEST['itemtotal'];
        if($newsubtotal >= 300){
            $deliveryTotal = 0.00;
        }else{
            $deliveryTotal = 30.00;
        }
        $gradnd_total = $deliveryTotal + $newsubtotal;
        $orderData = array(
                'subTotal' => $newsubtotal,
                'deliveryCost' => $deliveryTotal,
                'totalAmount' => $gradnd_total,
                'updatedBy' => $_SESSION['adminId'],
                'updatedtime' => $dateTime,
        );

        $where_clause_order = array(
                'id' => $_REQUEST['orderId']
          );

        $inactiveData = array(
                'active' => '0',
        );

        $where_clause_inactive = array(
                'id' => $_REQUEST['orderItemid']
          );
        $updated1 = $db->update(ORDER_DETAILS, $orderData, $where_clause_order);
        $updated = $db->update(ORDER_ITEMS, $inactiveData, $where_clause_inactive);
        if($updated1 && $updated){
            echo 'success';
        }else{
            echo 'fail';
        }

    }
function manageSuppliers(){
            $db = new DB();
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Suppliers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Suppliers
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Contact Person</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                      $db = new DB();

                                    $query = "SELECT * FROM ".SUPPLIERS."";
                                    $suppliers = $db->get_results( $query );
                                    

                                     if(count($suppliers)>0){
                                     foreach ($suppliers as $supplier) {

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$supplier['companyName']?></td>
                                            <td><?=$supplier['contactPersonName']?></td>
                                            <td><?=$supplier['mobileNo']?></td>
                                            <td><?=$supplier['email']?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editSupplier&supplierId=<?=$supplier['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
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

    function addNewSupplier(){

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Suppliers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Supplier
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveSupplier" /> 
                                       
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input class="form-control" name="companyName" value="" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Contact Person Name</label>
                                            <input class="form-control" name="contactPersonName" value="">                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Mobile No.</label>
                                            <input class="form-control" name="mobileNo" value="">                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" value="">                                            
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



    function saveSupplier(){
        $db = new DB();

        $data = array(
            'companyName' => $db->filter($_POST['companyName']),
            'contactPersonName' => $db->filter($_POST['contactPersonName']),
            'mobileNo' => $db->filter($_POST['mobileNo']),
            'email' => $db->filter($_POST['email'])
        );

        $rs = $db->insert(SUPPLIERS, $data);

        if($rs){
            return true;
        }

    }

    function editSupplier($supplierId){
        $db = new DB();

        $query = "SELECT * FROM ".SUPPLIERS." WHERE id ='".$supplierId."'";
        $supplier = $db->get_row( $query, true );

        //pre($supplier);

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Suppliers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Supplier
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateSupplier" />      
                                         <input type="hidden" name="supplierId" value="<?=$supplier->id?>" /> 
                                       
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input class="form-control" name="companyName" value="<?=$supplier->companyName?>" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Contact Person Name</label>
                                            <input class="form-control" name="contactPersonName" value="<?=$supplier->contactPersonName?>">                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Mobile No.</label>
                                            <input class="form-control" name="mobileNo" value="<?=$supplier->mobileNo?>">                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" value="<?=$supplier->email?>">                                            
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


   function updateSupplier(){
        $db = new DB();

        $update = array(
            'companyName' => $db->filter($_REQUEST['companyName']), 
            'contactPersonName' => $db->filter($_REQUEST['contactPersonName']),
            'mobileNo' => $db->filter($_REQUEST['mobileNo']),
            'email' => $db->filter($_REQUEST['email'])
        );

        $where_clause = array(
            'id' => $_REQUEST['supplierId']
        );

        $updated = $db->update(SUPPLIERS, $update, $where_clause, 1 );

        if($updated){
            return true;
        }else{
            return false;
        }

    }

function manageBrand(){
            $db = new DB();
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Brands</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Brands
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Brand Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                      $db = new DB();

                                    $query = "SELECT * FROM ".BRANDS."";
                                    $brands = $db->get_results( $query );
                                    

                                     if(count($brands)>0){
                                     foreach ($brands as $brand) {

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$brand['brandName']?></td>
                                            <td><?=$brand['description']?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editBrands&brandId=<?=$brand['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
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

    function addNewBrand(){

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Brands</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Brands
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveBrands" /> 
                                       
                                        <div class="form-group">
                                            <label>Brand Name</label>
                                            <input class="form-control" name="brandName" value="" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="3" ></textarea>                                            
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



    function saveBrands(){
        $db = new DB();

        $data = array(
            'brandName' => $_POST['brandName'],
            'description' => $_POST['description']
            
        );

        $rs = $db->insert(BRANDS, $data);

        if($rs){
            return true;
        }

    }

    function editBrands(){
        $db = new DB();

        $query = "SELECT * FROM ".BRANDS." WHERE id = '".$_REQUEST['brandId']."'";
        $brand = $db->get_row( $query, true );

     

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Brands</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Brands
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateBrands" />      
                                         <input type="hidden" name="brandId" value="<?=$brand->id?>" /> 
                                       
                                        <div class="form-group">
                                            <label>Brand Name</label>
                                            <input class="form-control" name="brandName" value="<?=$brand->brandName?>" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="3" ><?=$brand->description?></textarea>                                            
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


   function updateBrands(){
        $db = new DB();

        $update = array(
            'brandName' => $_REQUEST['brandName'], 
            'description' => $_REQUEST['description']
        );

        $where_clause = array(
            'id' => $_REQUEST['brandId']
        );

        $updated = $db->update(BRANDS, $update, $where_clause, 1 );

        if($updated){
            return true;
        }else{
            return false;
        }

    }
function saveBill(){
      $db = new DB();

      $data = array(
            'supplier_id' => $_REQUEST['categoryId'],
            'total' => $db->filter($_REQUEST['productGrandTotal'])
        );

        $rs = $db->insert(PRODUCT_SUPPLY, $data);
        $product_supplyId = $db->lastid();
        if($rs){
           

            $productName = $db->filter($_REQUEST['productName']);
            $chitkiprice   = $db->filter($_REQUEST['chitkiprice']);
            $mrp = $db->filter($_REQUEST['mrp']);
            $productCost = $db->filter($_REQUEST['productCost']);
            $productQty   = $db->filter($_REQUEST['productQty']);
            $productWeight   = $db->filter($_REQUEST['productWeight']);
            $productUnit = $db->filter($_REQUEST['productUnit']);
            $productDiscount = $db->filter($_REQUEST['productDiscount']);
            $productVat = $db->filter($_REQUEST['productVat']);
            
            $productIndTotal = $db->filter($_REQUEST['productIndTotal']);
            $productTotal = $db->filter($_REQUEST['productTotal']);
            $productVat = $db->filter($_REQUEST['productVat']);
            $expiryDate = $db->filter($_REQUEST['expiryDate']);
            
            $i=0;

            foreach($productName as $productname){
               

                $productoptionResult = $db->get_row("SELECT id,productCost,productStock,productMRP,expiryDate FROM ".PRODUCT_OPTIONS." WHERE productId = '".$productName[$i]."' AND active = '1' AND productUnit ='".$productUnit[$i]."' AND productWeight ='".$productWeight[$i]."' ",true);
                $productOptionId = $productoptionResult->id;
                $productStock = $productoptionResult->productStock;
                $oldproductCost = $productoptionResult->productCost;
                $productMRP = $productoptionResult->productMRP;
                $oldexpiryDate = $productoptionResult->expiryDate;
                       
                list($dd, $mm, $yy) = explode('/', $expiryDate[$i]);
                $expDate = $yy.'-'.$mm.'-'.$dd;
                if($mrp[$i]!='' || $mrp[$i]!=0){
                    $productMRPAmount = $mrp[$i];

                }else{
                   $productMRPAmount =  $productMRP;
                }
                if($chitkiprice[$i]!='' || $chitkiprice[$i]!=0){
                    $newProductCost = $chitkiprice[$i];
                }else{
                    $newProductCost = $oldproductCost;
                }
                if($expDate !=''){
                    $newexpDate =  $expDate;
                }else{
                    $newexpDate =  $oldexpiryDate;
                }

                $newproductStock = $productStock + $productQty[$i];

                $update = array(
                    'productCost' => $newProductCost, 
                    'productStock' => $newproductStock,
                    'productMRP' => $productMRPAmount,
                    'expiryDate' => $newexpDate
                );

                $where_clause = array(
                    'id' => $productOptionId
                );

                $updated = $db->update(PRODUCT_OPTIONS, $update, $where_clause );

                 $records = array(
                    'productId' => $productName[$i],
                    'chitkiprice' => $chitkiprice[$i],
                    'product_supplyId' => $product_supplyId,
                    'product_optionId' => $productOptionId,
                    'productmrp' => $mrp[$i],
                    'productWeight' => $productWeight[$i],
                    'productCost' => $productCost[$i],
                    'productQty' => $productQty[$i],
                    'productUnit' => $productUnit[$i],
                    'productDiscount' => $productDiscount[$i],
                    'productVat' => $productVat[$i],
                    'productIndTotal' => $productIndTotal[$i],
                    'productTotal' => $productTotal[$i],
                    'expiryDate' => $expDate
                );

                $inserted = $db->insert(PRODUCT_SUPPLY_ITEMS, $records);
               
                $i++;
            }  

            return true;
        }else{
            return false;
        }

    }

    function manageBills(){
      $db = new DB();
       
       ?>



         <div class="row">
                <div class="col-lg-12 alert alert-success deleteBillsuccess"> </div>
                <div class="col-lg-12 alert alert-danger deleteBillerror"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Supply Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Suppliers Bill
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Bill ID</th>
                                            <th>Supplier Name</th>
                                            <th>Date</th>
                                            <th>Total Amount</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                   

                                    $query = "SELECT product_supply.*,suppliers.companyName FROM ".PRODUCT_SUPPLY." LEFT JOIN ".SUPPLIERS." on (suppliers.id=product_supply.supplier_id) WHERE product_supply.active = '1'";
                                    $suppliers = $db->get_results( $query );
                                    

                                     if(count($suppliers)>0){
                                     foreach ($suppliers as $supplier) {

                                        ?>
                                        <tr class="odd gradeX deleteBill_<?=$supplier['id']?>">
                                            <td><?=$supplier['id']?></td>
                                            <td><?=$supplier['companyName']?></td>
                                            <td><?=stdDateFormat($supplier['datetime'])?></td>
                                            <td><?=number_format($supplier['total'],2)?></td>
                                           <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=viewBills&product_supplyId=<?=$supplier['id']?>" title="View Bills"><i class="fa fa-eye"></i></a>
                                                <a href="javascript:void(0);" title="Delete Bills" onclick="deleteBills(<?=$supplier['id']?>);"><i class="fa fa-trash-o"></i></a>
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
            function deleteBills(supplierId){
                if(confirm("Are you sure you want to delete supplier bill?")){
                 $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=deleteBills&supplierId="+supplierId,
                        success: function(msg){       
                            
                            if(msg =='success'){
                                        $('.deleteBill_'+supplierId).css('display', 'none');
                                        $('.deleteBillsuccess').show('slow');
                                        $('.deleteBillsuccess').html('Supply bill has been deleted.');
                                        setTimeout(function(){
                                          $('.deleteBillsuccess').hide('slow');
                                        }, 3000);
                                   }else{
                                        $('.deleteBillerror').show('slow');
                                        $('.deleteBillerror').html('Problem while deleting. Please try again!');
                                        setTimeout(function(){
                                          $('.deleteBillerror').hide('slow');
                                        }, 3000);
                                   }                                            
                        }
                    });
             }
            }
            </script>


        <?
    }

    function viewBills($product_supplyId){ 
    $db = new DB();
    //$query = "SELECT product_supply.*,suppliers.companyName FROM ".PRODUCT_SUPPLY." LEFT JOIN ".SUPPLIERS." on (suppliers.id=product_supply.supplier_id) WHERE product_supply.supplier_id = '".$supplierId."'";
    $supplier = $db->get_row("SELECT product_supply.*,suppliers.companyName FROM ".PRODUCT_SUPPLY." LEFT JOIN ".SUPPLIERS." on (suppliers.id=product_supply.supplier_id) WHERE product_supply.id = '".$product_supplyId."'", true);
   // $supplier = $db->get_row( $query );
    

     if(count($supplier)>0){
        $query = "SELECT product_supply_items.*,products.productName FROM ".PRODUCT_SUPPLY_ITEMS." LEFT JOIN ".PRODUCTS." on (product_supply_items.productId=products.id) WHERE product_supplyId='".$supplier->id."' ORDER BY productName ASC";
        $product_supply = $db->get_results($query);
     //foreach ($suppliers as $supplier) {

        ?>
     <div class="row">
                <div class="col-lg-12 alert alert-success rsSure"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Supplier Bill Detail</h1>
                </div>
                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Supplier Detail
                           <!--  <form name="orderFrom" action="" method="post">
                                <input type="hidden" name="action" value="changeOrderStatus" /> -->
                                <!-- <input type="hidden" name="orderId" value="<?=$orderDetails->id?>"/> -->

                               
                            <!-- </form> -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="">
                                       <div class="col-md-12 paymentSteps">

    <table cellspacing="0" cellpadding="0" style="width:100%;argin:0 auto;padding:20px;background-color:#F3F3F3;">
   
    <tr style="font-family:arial;background-color:#ffffff;">
        <td colspan="3" style="padding:0 15px;">
            <div style="margin-bottom:15px;">
               
                <p style="margin:0;">Supplier Name : <?=$supplier->companyName;?></p>
                <p style="margin:0;">Date: <?=stdDateFormat($supplier->datetime)?></p>
                
                
            </div>
        </td>
    </tr>
    <tr style="font-family:arial;background-color:#ffffff;">
        <td colspan="3" style="padding:0 15px;">
            <h2 style="margin-bottom: 5px;margin-top:5px;padding-bottom: 5px;font-weight:normal;font-size:20px;color:#00A1E2;">Order Detail</h2>
            <table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:100%;text-align:left;border-color:#e5e5e5;">
                <tr>
                    <th style="width:33%;padding:5px;border-color:#e5e5e5;font-weight:normal;">Item (Weight - Unit)</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Cost</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Discount</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Vat (%)</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Qty</th>                    
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Ind Total</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Total</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">Chitki price</th>
                    <th style="padding:5px;border-color:#e5e5e5;font-weight:normal;">MRP</th>
                </tr>

                <?  foreach($product_supply as $record){

                        
                ?>
                <tr>
                    
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productName']?> (<?=$record['productWeight']?> <?=$record['productUnit']?>)</td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($record['productCost'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productDiscount']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productVat']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productQty']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($record['productIndTotal'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($record['productTotal'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($record['chitkiprice'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($record['productmrp'],2)?></td>
                </tr>
                <?}?>
                 <tr >
                    <td colspan="6" style="padding:5px;border-color:#e5e5e5;font-size:14px;" align="right">
                         Total Amount:  </td>
                    
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#8377; <?=number_format($supplier->total,2)?></td> 
                    </tr>
               
                </tr>    
            </table>
            
        </td> 
    </tr>
    
</table>

            <div style="clear:both;width:100%;"></div>
            <div class="separator"></div>
            </div>
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
            <?php 
        }
}
function deleteBills($supplyId){ 
    $db = new DB();

    $query = "SELECT product_optionId,productQty FROM ".PRODUCT_SUPPLY_ITEMS."  WHERE product_supply_items.product_supplyId = '".$supplyId."'";
    $suppliers_items = $db->get_results($query);
    if(count($suppliers_items)>0){
     foreach ($suppliers_items as $suppliers_item) {
            $productOpt = $db->get_row("SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE id ='".$suppliers_item['product_optionId']."'", true);
            $oldStock = $productOpt->productStock;  
            $newStock = $oldStock - $suppliers_item['productQty'];
            if($newStock < 0){
                $newStock = 0;
            } 
              $updateStock = array(
                    'productStock' => $newStock
                );
            $stock_where_clause = array(
                    'id' => $suppliers_item['product_optionId']
             );
            $db->update(PRODUCT_OPTIONS, $updateStock, $stock_where_clause );   
         }
     }
    $data = array(
            'active' => '0'
        );

        $where_clause = array(
                    'id' => $supplyId
                );

        $rs = $db->update(PRODUCT_SUPPLY, $data, $where_clause );
        if($rs){
            echo "success";

        }else{
             echo "fails";
        }

}
    function newBill(){ // Suppliers bill generation

            $db = new DB();

            $categories = $this->getAllProductCategories();
            // Weight Units
            $weightUnits = $this->getProductAttributeValsByWeight();
        
            $supplierId = $_REQUEST['supplierId'];

            $query = "SELECT * FROM ".PRODUCTS." WHERE supplierId='".$supplierId."' AND active = '1' ORDER BY productName ASC";
            $products = $db->get_results($query);
        ?>

     
        <script type="text/javascript">

             function loadReceiptForm(ele){

                if(confirm("Are you sure you want to change supplier name?")){

                    var supplierId = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadReceiptForm&supplierId="+supplierId,
                        success: function(msg){       
                            $('#productDetailsDiv').html(msg);                                              
                        }
                    });

                }

            }

        </script>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">New Bill</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Bill
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" name="product_form" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="saveBill" /> 
                                        
                                        <div class="form-group">
                                            <label>Supplier</label>

                                            <?php

                                                $query = "SELECT * FROM ".SUPPLIERS."";
                                                $suppliers = $db->get_results($query);

                                            ?>
                                           <select name="categoryId" class="form-control" required onChange="loadReceiptForm(this)">
                                                <option value="">SELECT</option>
                                                <? foreach ($suppliers as $supplier) { ?>
                                                <option value="<?=$supplier['id']?>"><?=$supplier['companyName']?></option>
                                                <? } ?>
                                            </select>
                                        </div>

                                        <div class="form-group" id="productDetailsDiv">
                                            
                                        </div> 

                                        <div class="form-group" id="productDetailsDiv">
                                            
                                            <!-- <label>Product Cost/Weight(Qty)</label><br/> -->

                                            

                                            <!-- <input type="hidden" min="1" class="form-control" step="0.01" name="productWeight[]" value="" style="width:35% !important; display:inline !important" placeholder="Weight/Qty" required>
                                             
                                            <input type="text" min="0" class="form-control" name="productQty[]" value="" style="width:10% !important; display:inline !important" placeholder="Stock" required>
                                            <input type="text" min="1" class="form-control" name="productCost[]" value="" style="width:10% !important; display:inline !important" placeholder="Cost" required>   
                                            <input type="text" class="form-control" name="productDiscount[]" value="" style="width:10% !important; display:inline !important" placeholder="Discount">   
                                            <input type="text" class="form-control" name="productVat[]" value="" style="width:10% !important; display:inline !important" placeholder="Vat">   
                                           -->  <input type="text" class="form-control" name="productGrandTotal" id="supplyProductTotal" value="" style="width:10% !important; display:inline !important" placeholder="Total">   

                                            <br/><br/>
                                            <button type="submit" class="btn btn-default">Save</button>

                                        </div> 
                            </form>
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


    function loadReceiptForm(){

        $db = new DB();
        
        // Weight Units
        $weightUnits = $this->getProductAttributeValsByWeight();

        $supplierId = $_REQUEST['supplierId'];

        $query = "SELECT * FROM ".PRODUCTS." WHERE active = '1' ORDER BY productName ASC";
        $products = $db->get_results($query);
        ?>

           <script type="text/javascript">

            var costPerWtVal=0;
            $('#addMoreCostsPerWeightElement').click(function(){ 
                var content=$(this).attr("data-val");
            

                costPerWtVal=costPerWtVal + 1;
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+costPerWtVal;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+="<select class='form-control' name='productName[]' style='width:12% !important; display:inline !important' required onChange='loadWeightunitForm(this,"+costPerWtVal+")'><option value=''>-Select Item-</option><? foreach($products as $product){ ?><option value='<?=$product['id']?>'><?=$product['productName']?></option><? } ?></select>&nbsp;<span id='productWeightunitsDiv_"+costPerWtVal+"'><input type='number' min='1' step='0.01' class='form-control' name='productWeight[]' id='productWeight_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:9% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' id='productUnit_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' style='width:8% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select></span>&nbsp;<input type='date' class='form-control expiryDate' name='expiryDate[]' value='' style='width:10% !important; display:inline !important' placeholder='Expiry Date'> &nbsp;<input type='text' min='1' class='form-control getIndTotal getProdTot' name='productCost[]' id='productCost_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:7% !important; display:inline !important' placeholder='Cost' required>&nbsp;<input type='text' class='form-control getIndTotal getProdTot' name='productDiscount[]' data-cntid='"+costPerWtVal+"' id='productDiscount_"+costPerWtVal+"' value='' style='width:7% !important; display:inline !important' placeholder='Discount'>&nbsp;<input type='text' class='form-control getIndTotal getProdTot' name='productVat[]' id='productVat_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:5% !important; display:inline !important' placeholder='Vat'>&nbsp;<input type='text' class='form-control getIndTotal getProdTot' name='productIndTotal[]' id='productIndTotal_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:7% !important; display:inline !important' placeholder='Ind. Total' readonly >&nbsp;<input type='text' min='0' class='form-control getProdTot' name='productQty[]' id='productQty_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:5% !important; display:inline !important' placeholder='Qty' required>&nbsp;<input type='text' min='0' class='form-control getProdTot' name='productTotal[]' id='productTotal_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:7% !important; display:inline !important' placeholder='Total' required readonly>&nbsp;<input type='text' class='form-control' name='chitkiprice[]' placeholder='Chitki price' style='width:7% !important; display:inline !important'>&nbsp;<input type='text' class='form-control' name='mrp[]' placeholder='M.R.P.' style='width:7% !important; display:inline !important'><br/><br/>";
                contentID.appendChild(newTBDiv);
                $('#costPerWtVal').val(costPerWtVal);
                $(function(){
                    var nowDate = new Date();
                    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

                    $('.expiryDate').datepicker({
                        startDate: today,
                        autoclose:true,
                        format:'dd/mm/yyyy'
                    });
                });
                $(".getIndTotal").on("keyup keypress blur change focus", function(){
                    var countid = $(this).attr("data-cntid");
                    var cost = $('#productCost_'+countid).val(); 
                    var discount = $('#productDiscount_'+countid).val(); 
                    var vat = $('#productVat_'+countid).val(); 
                    var subtot = '';
                    if(isNumber(discount)){
                        discount = discount;
                    }else{
                        discount = 0;
                    }
                    if(isNumber(vat)){
                        subtot = parseFloat(cost) - parseFloat(discount);
                        if(subtot <0){
                            subtot = 0;
                        }
                        vat = vat*(subtot/100);
                    }else{
                        vat = 0;
                    }
                    var indTotal = (parseFloat(cost) - parseFloat(discount)) + parseFloat(vat);
                    $('#productIndTotal_'+countid).val(indTotal);
                    //alert(indTotal);
                });
                $(".getProdTot").on("keyup keypress blur change focus", function(){
                    var countid=$(this).attr("data-cntid");
                    var indTotal = $('#productIndTotal_'+countid).val();; 
                    var qty = $('#productQty_'+countid).val(); 
                    if(isNumber(qty)){
                        qty = qty;
                    }else{
                        qty = 0;
                    }
                    var grdTotal = parseFloat(qty) * parseFloat(indTotal);
                    $('#productTotal_'+countid).val(grdTotal);
                    supplybilltotal();
                });

            });

            $('#removeCostsPerWeightElement').click(function(){ 
            var content=$(this).attr("data-val");
                
                if(costPerWtVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+costPerWtVal));
                    costPerWtVal = costPerWtVal-1;
                    $('#costPerWtVal').val(costPerWtVal);
                }
            });

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
        <style type="text/css">
            .mangBillsTitle label{margin-right: 5px !important;}
        </style>
        <label>Item Qty/Cost/Discount/Vat</label><br/>
        <p class="mangBillsTitle"><label style="width:12% !important; display:inline-block !important">Select Product</label><label style='width:9% !important; display:inline-block !important'>Weight</label><label style='width:8% !important; display:inline-block !important'>Unit</label><label style="width:10% !important; display:inline-block !important">Expiry Date</label><label style="width:7% !important; display:inline-block !important">Cost</label>
            <label style='width:8% !important; display:inline-block !important'>Discount</label><label style="width:5% !important; display:inline-block !important">VAT</label><label style="width:7% !important; display:inline-block !important">Ind. Total</label><label style="width:5% !important; display:inline-block !important">Qty</label><label style="width:7% !important; display:inline-block !important">Total</label><label style="width:7% !important; display:inline-block !important">Chitki price</label><label style="width:7% !important; display:inline-block !important">M.R.P.</label></p>
        <select class="form-control" name="productName[]" style="width:12% !important; display:inline !important" required onChange="loadWeightunitForm(this,0)">
        <option value="">-Select Item-</option>
        <? foreach($products as $product){ ?>
           <option value="<?=$product['id']?>"><?=$product['productName']?></option>
        <? } ?>   
        </select>  

        <!-- <input type="number" min="1"  class="form-control" step="0.01" name="productWeight[]" value="" style="width:10% !important; display:inline !important" placeholder="Weight/Qty" required>
        <select class="form-control" name="productUnit[]" style="width:10% !important; display:inline !important" required >
            <option value="">-Unit-</option>
            <? foreach($weightUnits as $weightUnit){ ?>
               <option value="<?=$weightUnit['attributeValue']?>"><?=$weightUnit['attributeValue']?></option>
            <? } ?>   
            </select>  -->
        
        <span id="productWeightunitsDiv_0">
            <input type='number' min='1' step='0.01' class='form-control' name='productWeight[]' id='productWeight_0' value='' style='width:9% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;
            <select class='form-control' name='productUnit[]' id='productUnit_0' style='width:8% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?>   </select>
        </span> 
        
        <input type="date" class="form-control expiryDate" name="expiryDate[]" value="" style="width:10% !important; display:inline !important" placeholder="Expiry Date">    
        <input type="text" min="1" class="form-control getIndTotal getProdTot" name="productCost[]" id="productCost_0" value="" style="width:7% !important; display:inline !important" placeholder="Cost" required>   
        <input type="text" class="form-control getIndTotal getProdTot" name="productDiscount[]" id="productDiscount_0" value="" style="width:7% !important; display:inline !important" placeholder="Discount">   
        <input type="text" class="form-control getIndTotal getProdTot" name="productVat[]" id="productVat_0" value="" style="width:5% !important; display:inline !important" placeholder="Vat">   
        <input type="text" class="form-control getIndTotal getProdTot" name="productIndTotal[]" id="productIndTotal_0" value="" style="width:7% !important; display:inline !important" placeholder="Ind. Total" readonly>   
        <input type="text" min="0" class="form-control getProdTot" name="productQty[]" id="productQty_0" value="" style="width:5% !important; display:inline !important" placeholder="Qty" required>
        <input type="text" class="form-control getProdTot" name="productTotal[]" id="productTotal_0" value="" style="width:7% !important; display:inline !important" placeholder="Total" readonly>   
        <input type="text" class="form-control" name="chitkiprice[]" placeholder="Chitki price" style="width:7% !important; display:inline !important">
        <input type="text" class="form-control" name="mrp[]" placeholder="M.R.P." style="width:7% !important; display:inline !important">

        <a href="javascript:void(0);" id="addMoreCostsPerWeightElement" data-val="moreWeights" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
        <a href="javascript:void(0);" id="removeCostsPerWeightElement" data-val="moreWeights"  Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>

        <br/><br/>
        <input type="hidden" id="costPerWtVal" name="costPerWtVal" value="0" >
        <div class='moreWeights' id="moreWeights">

        </div>  
        <br/>                                 

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
                $(".getIndTotal").on("keyup keypress blur change focus", function(){
                    var countid=0;
                    var cost = $('#productCost_'+countid).val(); 
                    var discount = $('#productDiscount_'+countid).val(); 
                    var vat = $('#productVat_'+countid).val(); 
                    var subtot ='';
                    if(isNumber(discount)){
                        discount = discount;
                    }else{
                        discount = 0;
                    }
                    if(isNumber(vat)){
                        subtot = parseFloat(cost) - parseFloat(discount);
                        if(subtot <0){
                            subtot = 0;
                        }
                        vat = vat*(subtot/100);
                        
                    }else{
                        vat = 0;
                    }
                    var indTotal = (parseFloat(cost) - parseFloat(discount)) + parseFloat(vat);
                    $('#productIndTotal_'+countid).val(indTotal);
                    //alert(indTotal);
                });
                $(".getProdTot").on("keyup keypress blur change focus", function(){
                    var countid=0;
                    var indTotal = $('#productIndTotal_'+countid).val();; 
                    var qty = $('#productQty_'+countid).val(); 
                    if(isNumber(qty)){
                        qty = qty;
                    }else{
                        qty = 0;
                    }
                    var grdTotal = parseFloat(qty) * parseFloat(indTotal);
                    $('#productTotal_'+countid).val(grdTotal);
                    supplybilltotal();
                }); 
                function loadWeightunitForm(ele,val){
                    var productId = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadWeightunitForm&productId="+productId+"&divid="+val,
                        success: function(msg){       
                            $('#productWeightunitsDiv_'+val).html(msg);                                              
                        }
                    });
                }
                function loadunitFormweight(ele,pid,val){
                    var productId = pid;
                    var productWt = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadunitFormweight&productId="+productId+"&productWt="+productWt+"&divid="+val,
                        success: function(msg){       
                            $('#productUnitDiv_'+val).html(msg);                                              
                        }
                    });
                }
                function isNumber(num) {
                  return (typeof num == 'string' || typeof num == 'number') && !isNaN(num - 0) && num !== '';
                };

                function supplybilltotal(){
                    var costPerWtVal = $('#costPerWtVal').val();
                    var gradnd_total = 0.00;
                    for(var i=0; i <= costPerWtVal; i++){
                       gradnd_total = parseFloat(gradnd_total) + parseFloat($('#productTotal_'+i).val());
                    }
                    gradnd_total = gradnd_total.toFixed(2);
                    $('#supplyProductTotal').val(gradnd_total);
                }
            </script>

        
                                   
    <?
    }
    function loadWeightunitForm(){
        $db = new DB();
        $productId = $_REQUEST['productId'];
        $divid = $_REQUEST['divid'];
        $query = "SELECT productWeight,productUnit FROM ".product_options." WHERE productId='".$productId."' AND active ='1'";
        $products = $db->get_results($query);
    ?>
        
        <select class="form-control" name="productWeight[]" id="productWeight_<?=$divid?>" data-cntid="<?=$divid?>" style="width:9% !important; display:inline !important" placeholder="Weight/Qty" required onChange='loadunitFormweight(this,"<?=$productId?>","<?=$divid?>")'>
            <option value="">-Select Weight-</option>
            <? foreach($products as $product){ ?>
               <option value="<?=$product['productWeight']?>"><?=$product['productWeight']?></option>
            <? } ?>   
        </select> 
        <span id="productUnitDiv_<?=$divid?>">
            <select class="form-control" name="productUnit[]" id="productUnit_<?=$divid?>" data-cntid="<?=$divid?>" style="width:8% !important; display:inline !important" required >
                <option value="">-Unit-</option>
                <? foreach($products as $weightUnit){ ?>
                   <option value="<?=$weightUnit['productUnit']?>"><?=$weightUnit['productUnit']?></option>
                <? } ?>   
                </select> 
        </span>
           
<?php }
    
   function loadunitFormweight(){
    $db = new DB();
    $productId = $_REQUEST['productId'];
    $divid = $_REQUEST['divid'];
    $productWt = $_REQUEST['productWt'];
    $query = "SELECT productUnit FROM ".product_options." WHERE productId='".$productId."' AND active ='1' AND productWeight ='".$productWt."'";
    $products = $db->get_results($query);
    ?>
    <select class="form-control" name="productUnit[]" id="productUnit_<?=$divid?>" data-cntid="<?=$divid?>" style="width:8% !important; display:inline !important" required >
                <option value="">-Unit-</option>
                <? foreach($products as $weightUnit){ ?>
                   <option value="<?=$weightUnit['productUnit']?>"><?=$weightUnit['productUnit']?></option>
                <? } ?>   
                </select> 
   <?php } 



   function manageAdminUsers(){
            $db = new DB();
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Admin User
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                      $db = new DB();

                                    $query = "SELECT * FROM ".ADMIN_USERS."";
                                    $admins = $db->get_results( $query );
                                    

                                     if(count($admins)>0){
                                     foreach ($admins as $admin) {

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$admin['fullName']?></td>
                                            <td><?=$admin['email']?></td>
                                            <td><?=$admin['accessLevel']?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editAdminUsers&adminId=<?=$admin['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
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

    function addNewAdminUser(){

        ?>

        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admins</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Admin User
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveAdminUsers" /> 
                                       
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input class="form-control" name="fullName" value="" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input name="password" class="form-control" required="required" type="password" id="password" oninput="passwordLength(this)" />                                          
                                        </div>

                                        <div class="form-group">
                                             <label>Confirm Password</label>
                                            <input name="password_confirm" class="form-control" required="required" type="password" id="password_confirm" oninput="checkPassword(this)" />                                           
                                        </div>
                                        <div class="form-group">
                                             <label>Access level</label>
                                            <select name="accessLevel" class="form-control" required>
                                                <option value="">Select access level</option>
                                                <option value="admin">Admin</option>
                                                <option value="manager">Manager</option>
                                                <option value="staff">staff</option>
                                               
                                            </select>                                           
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

            <script language='javascript' type='text/javascript'>
                function passwordLength(input){
                    if (input.value.length < 8) {
                        input.setCustomValidity('Password Must be minimum 8 character.');
                    } else {
                        
                        input.setCustomValidity('');
                    }
                }
                function checkPassword(input) {
                    if (input.value != document.getElementById('password').value) {
                        input.setCustomValidity('Password Must be Matching.');
                    } else {
                        // input is valid -- reset the error message
                        input.setCustomValidity('');
                    }
                }
            </script>
        <?
    }



    function saveAdminUsers(){
        $db = new DB();
        $emailExits = $db->get_row("SELECT id FROM ".ADMIN_USERS." WHERE email = '".$db->filter($_POST['email'])."'",true);
        if($emailExits){
            return 'emailExits';
            exit;
        }
        $data = array(
            'fullName' => $db->filter($_POST['fullName']),
            'email' => $db->filter($_POST['email']),
            'password' => $db->filter($_POST['password']),
            'accessLevel' => $db->filter($_POST['accessLevel'])
            
        );

        $rs = $db->insert(ADMIN_USERS, $data);

        if($rs){
                $msg='';
                $mail = new PHPMailer();
                $mail->IsHTML(true);
                $mail->From = $db->filter($_POST['email']);
                $mail->FromName = 'Chitki admin details';
                $mail->AddAddress($db->filter($_POST['email']));
                
                $mail->Subject = 'Chitki Login Details';      

                $msg.=  'Email : '.$_POST['email'].'<br>';
                $msg.=  'Password : '.$db->filter($_POST['password']).'<br>';
               
                $mail->Body  =$msg;                    
                $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
                if($mail->Send()){

                    return true;
                }else{
                   return false;
                }
            
        }

    }

    function editAdminUsers(){
        $db = new DB();

        $query = "SELECT * FROM ".ADMIN_USERS." WHERE id = '".$_REQUEST['adminId']."'";
        $admin = $db->get_row( $query, true );

     

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Admin User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Admin
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateAdminUsers" />      
                                         <input type="hidden" name="adminId" value="<?=$admin->id?>" /> 
                                       
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input class="form-control" name="fullName" value="<?=$admin->fullName?>" required>                                            
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" readonly value="<?=$admin->email?>" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Reset Password</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio"  value="1" id="optionsRadios1" name="resetpassword">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" checked="" value="0" id="optionsRadios2" name="resetpassword">No
                                                </label>
                                            </div>                                         
                                        </div>

                                        
                                        <div class="form-group">
                                             <label>Access level</label>
                                            <select name="accessLevel" class="form-control" required>
                                                <option value="">Select access level</option>
                                                <option value="admin" <?php if($admin->accessLevel == 'admin'){ echo "selected='selected'";}?>>Admin</option>
                                                <option value="manager" <?php if($admin->accessLevel == 'manager'){ echo "selected='selected'";}?>>Manager</option>
                                                <option value="staff" <?php if($admin->accessLevel == 'staff'){ echo "selected='selected'";}?>>staff</option>
                                               
                                            </select>                                           
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


   function updateAdminUsers(){
        $db = new DB();

       if($_POST['resetpassword'] == '1'){
            $password = $db->filter(randomPassword());
            $update = array(
                'fullName' => $db->filter($_POST['fullName']),
                'password' => $password,
                'accessLevel' => $db->filter($_POST['accessLevel'])
                
            );
       }else{
            $update = array(
                'fullName' => $db->filter($_POST['fullName']),
                'accessLevel' => $db->filter($_POST['accessLevel'])
            );
        }
        $where_clause = array(
            'id' => $_REQUEST['adminId']
        );

        $updated = $db->update(ADMIN_USERS, $update, $where_clause, 1 );

        if($updated){
            if($_POST['resetpassword'] == '1'){

                $msg='';
                $mail = new PHPMailer();
                $mail->IsHTML(true);
                $mail->From = $db->filter($_POST['email']);
                $mail->FromName = 'Chitki admin details';
                $mail->AddAddress($db->filter($_POST['email']));
                
                $mail->Subject = 'Chitki Login Details';      

                $msg.=  'Email : '.$_POST['email'].'<br>';
                $msg.=  'Password : '.$password.'<br>';
               
                $mail->Body  =$msg;                    
                $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
                if($mail->Send()){

                    return true;
                }else{
                  return false;
                }
             }   
            return true;
        }else{
            return false;
        }

    }

}
 ?>