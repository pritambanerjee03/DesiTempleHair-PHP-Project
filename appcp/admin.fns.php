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
            case 'allowProduct':
                if($oauth->authUser()){
                     if($oauth->authAccessLevel() == 'admin'){
                        $this->allowProduct();
                    }else{
                        $this->welcomePage();
                    }
                    
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'expiringProduct':
                if($oauth->authUser()){
                     if($oauth->authAccessLevel() == 'admin'){
                        $this->expiringProduct();
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
            case 'allOrders':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin' || $oauth->authAccessLevel() == 'staff'){
                       $this->allOrders();
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
                    
                     if($oauth->authAccessLevel() == 'admin'){
                       $this->manageCustomers();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            
            
            case 'manageEnquiredUser':
                if($oauth->authUser()){
                    
                     if($oauth->authAccessLevel() == 'admin'){
                       $this->manageEnquiredUser();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'editEnquiredUser':
                if($oauth->authUser()){
                    
                     if($oauth->authAccessLevel() == 'admin'){
                       $this->editEnquiredUser();
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
            case 'returnProducts':
                if($oauth->authUser()){
                   
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->returnProducts();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'viewReturnProducts':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                       $this->viewReturnProducts();
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
            case 'addNewEnquire':
                if($oauth->authUser()){
                        
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addNewEnquire();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break; 
            case 'manageCoupons':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageCoupons();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'addCoupon':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addCoupon();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'editCoupon':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->editCoupon($_REQUEST['id']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'manageReports':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageReports();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'runCouponScript':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->runCouponScript();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'sellingInfo':
                if($oauth->authUser()){
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->sellingInfo();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'userOrderInfo':
                if($oauth->authUser()){
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->userOrderInfo();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'runOrderDetailsScript':
                if($oauth->authUser()){
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->runOrderDetailsScript();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'movingProductInfo':
                if($oauth->authUser()){
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->movingProductInfo();
                    }else{
                       $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'viewCategoryStock':
                if($oauth->authUser()){
                   if($oauth->authAccessLevel() == 'admin'){
                        $this->viewCategoryStock();
                    }else{
                       $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'viewNewUserStatus':
                if($oauth->authUser()){
                  if($oauth->authAccessLevel() == 'admin'){
                        $this->viewNewUserStatus();
                    }else{
                       $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'manageIngredients':
                if($oauth->authUser()){
                    
                     if($oauth->authAccessLevel() == 'admin'){
                       $this->manageIngredients();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'addNewIngredients':
                if($oauth->authUser()){
                        
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->addNewIngredients();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break; 

            
            case 'editIngredients':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->editIngredients($_REQUEST['ingredientId']);
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;

            case 'manageReview':
                if($oauth->authUser()){
                    
                    if($oauth->authAccessLevel() == 'admin'){
                        $this->manageReview();
                    }else{
                        $this->welcomePage();
                    }
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;



            case 'manageAttributes':
                if($oauth->authUser()){
                    $this->manageAttributes();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'addNewAttributes':
                if($oauth->authUser()){
                    $this->addNewAttributes();
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'editAttribute':
                if($oauth->authUser() && $_REQUEST['id']!=''){
                    $this->editAttribute($_REQUEST['id']);
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'manageAttributeValues':
                if($oauth->authUser()){
                   $this->manageAttributeValues();
                   
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'addNewAttributeValues':
                if($oauth->authUser()){
                   $this->addNewAttributeValues();
                    
                }else{
                    $this->redirect('/index.php?page=logout'); 
                }
            break;
            case 'editAttributeValues':
                if($oauth->authUser() && $_REQUEST['id']!=''){
                   $this->editAttributeValues($_REQUEST['id']);
                    
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
        $todayordersResult = $db->get_row("SELECT COUNT(id) AS todayorders FROM order_details WHERE dateTime >= '".$todayTime."' AND orderStatus!='Cancel'", true);
        $todayorders = $todayordersResult->todayorders;

        $confirmedOrdersResult = $db->get_row("SELECT COUNT(id) AS confirmedOrders FROM order_details WHERE orderStatus='Confirmed' AND dateTime >= '".$todayTime."'", true);
        $confirmedOrders = $confirmedOrdersResult->confirmedOrders;

        $deliveredOrdersResult = $db->get_row("SELECT COUNT(id) AS deliveredOrders FROM order_details WHERE orderStatus='Delivered' AND dateTime >= '".$todayTime."'", true);
        $deliveredOrders = $deliveredOrdersResult->deliveredOrders;

        // $confirmedOrdersResult = $db->get_row("SELECT COUNT(id) AS confirmedOrders FROM order_details WHERE orderStatus='Confirmed' dateTime >= '".$todayTime."'", true);
        // $confirmOrders = $confirmedOrdersResult->confirmedOrders;

        $todayprofitResult = $db->get_row("SELECT SUM(netProfit) AS netprofit FROM order_details WHERE dateTime like '".$todayTime."%'", true);
        $todaynetProfit = $todayprofitResult->netprofit;
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

                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$confirmedOrders?></div>
                                    <div>Confirmed Orders</div>                                    
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
                                    <div class="huge"><?=$deliveredOrders?></div>
                                    <div>Delivered Orders</div>                                    
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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa fa-inr fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$todaynetProfit?></div>
                                    <div>Today's Net Profit</div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">

                               <div class="clearfix">&nbsp;</div>
                                 
                        </div>
                    </div>
                </div>
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
            <!-- <div class="row"> 

                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row"><div class="col-md-6">Expiring Products</div><div class="col-md-6 text-right"><a href="<?=APP_URL?>/index.php?page=expiringProduct" >View More</a></div></div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover table-striped">
                                
                            
                            <?php
                                        date_default_timezone_set("Asia/Calcutta");
                                        $nextMntdate = date('Y-m-d', strtotime('+1 month'));
                                        $todayDate = date('Y-m-d');
                                        //$qry1 = "SELECT products.* FROM ".PRODUCTS." LEFT JOIN product_options on(products.id = product_options.productId) WHERE products.active = '1' AND product_options.expiryDate <= '".$nextMntdate."' AND product_options.expiryDate != '0000-00-00' AND product_options.active = '1' ORDER BY product_options.expiryDate LIMIT 10";
                                        $qry1 = "SELECT products.* FROM ".PRODUCTS." LEFT JOIN product_options on(products.id = product_options.productId) WHERE products.active = '1' AND product_options.expiryDate <= '".$nextMntdate."' AND product_options.expiryDate != '0000-00-00' AND product_options.active = '1' GROUP BY product_options.productId ORDER BY product_options.expiryDate LIMIT 10";
                                        $productsList = $db->get_results( $qry1, true );
                                        ?>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Options</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                        <?php
                                        foreach($productsList as $products){
                                            

                                            if($products->categoryId>0){
                                                   $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$products->categoryId."'";
                                                   $categoryData = $db->get_row($qry, true);
                                            }
                                            
                                            $query = "SELECT * FROM ".PRODUCT_OPTIONS." WHERE productId =".$products->id." AND expiryDate <= '".$nextMntdate."' AND expiryDate != '0000-00-00' AND active = '1' ORDER BY expiryDate";
                                            $results = $db->get_results($query);
                                     ?>
                                    
                                        <tr>
                                            <td><a href="<?=APP_URL?>/index.php?page=editProduct&productId=<?=$products->id?>" title="Edit"><?=$products->productName?></a></td>
                                            <td><?php foreach ($results as $row) { 
                                                if($row['expiryDate'] < $todayDate){ ?> <span class="expiredProduct"> <?php } ?>
                                                <?=$row['productWeight'].' '.$row['productUnit'];?><br/>
                                                <?php if($row['expiryDate'] < $todayDate){ ?> </span> <?php } 
                                                 } ?>
                                            </td>
                                            <td><?php foreach ($results as $row) { if($row['expiryDate'] < $todayDate){ ?><span class="expiredProduct"><?php } ?><?php echo date('d-m-Y',strtotime($row['expiryDate'])); ?><?php if($row['expiryDate'] < $todayDate){ ?> </span> <?php } ?><br/><?php } ?>
                                            </td>
                                            
                                        </tr>
                                     <? } ?>
                                    
                                </table>            
                        </div>    
                    </div>    
                 </div>
                 <script type="text/javascript">
                    function blinker() {
                        $('.blink_me').fadeOut(500);
                        $('.blink_me').fadeIn(500);
                    }

                    setInterval(blinker, 1000);
                 </script>
                 <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <blink><b class="blink_me" style="color:red">OUT OF STOCKS!</b></blink>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Options</th>
                                    <th>Stock empty</th>
                                </tr>
                                <?php   
                                    
                                        date_default_timezone_set("Asia/Calcutta");
                                        $todayDate = date('Y-m-d H:i:s', time());
                                        $qry1 = "SELECT stockEmptydate, productWeight,productUnit,productId FROM ".PRODUCT_OPTIONS."  WHERE productStock < 1 AND stockEmptydate <= '".$todayDate."' AND stockEmptydate != '0000-00-00 00:00:00' AND product_options.active = '1' ORDER BY product_options.stockEmptydate";
                                        $productsOptions = $db->get_results( $qry1, true );
                                        foreach($productsOptions as $productsOption){
                                            $query = "SELECT productName FROM ".PRODUCTS." WHERE id =".$productsOption->productId;
                                            $results = $db->get_row($query,true);
                                     ?>
                                    
                                        <tr>
                                            <td><?=$results->productName?></td>
                                            <td><?=$productsOption->productWeight.' '.$productsOption->productUnit;?></td>
                                            <td><?php echo humanTiming(strtotime($productsOption->stockEmptydate)).' ago'; ?></td>
                                        </tr>
                                <? } ?>
                            </table>    
                        </div>    
                    </div>
                </div>        
            </div>  -->

            <? if(isset($_REQUEST['stat']) && $_REQUEST['stat']==1){ ?>
            <div class="row">


                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row"><div class="col-md-6">Found Us on!</div><div class="col-md-6 text-right"></div></div>
                        </div>
                        <div class="panel-body">
                            <?php

                                $mediums =array('Pamphlet','Email','Newspaper','Banner','Google','Facebook','Reference','TV','Vehicle','Other');

                            ?>
                            <table class="table table-hover table-striped">                   
                                        <tr>
                                            <th>Medium</th>
                                            <th>Orders</th>
                                        </tr>

                                        <?php foreach($mediums as $medium){ 

                                        $orderDetails = $db->get_row("SELECT COUNT(*) AS totalCount FROM order_details WHERE foundUsOn='".$medium."'", true);

                                        ?>
                                        <tr>
                                            <td><?=$medium?></td>
                                            <td><?=$orderDetails->totalCount?></td>
                                        </tr>
                                        <?php } ?>
                                    
                                </table>            
                        </div>    
                    </div>    
                 </div>  
                </div>

                <? } ?>
                <!--Notify Data-->

                <!--<div class="row">


                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row"><div class="col-md-6">Notify!</div><div class="col-md-6 text-right"></div></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            $qryNotifyUsers ="SELECT * FROM notify_users WHERE active='1' GROUP BY productId";
                            $notifyData = $db->get_results($qryNotifyUsers, true);

                            ?>
                            <table class="table table-hover table-striped">                   
                                        <tr>
                                            <th>Products</th>
                                            <th>Notify Count</th>
                                        </tr>

                                        <?php foreach($notifyData as $notify){ 

                $product = $db->get_row("SELECT productName FROM products WHERE id='".$notify->productId."'", true);


                $notifyCount = $db->num_rows("SELECT * FROM notify_users WHERE productId='".$notify->productId."' AND active='1'");



                                        ?>
                                        <tr>
                                            <td><?=$product->productName?></td>
                                            <td><?=$notifyCount?></td>
                                        </tr>
                                        <?php } ?>
                                    
                                </table>            
                        </div>    
                    </div>    
                 </div>  
                </div> --> 

                

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
                                                   $categoryName = $parentCategoryData->categoryName;
                                            }else{
                                                $categoryName = '';
                                            }


                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$category['categoryName']?></td>
                                            <td><?=$categoryName?></td>
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
                                    <?php /*    <div class="form-group">
                                            <label>Parent Category</label>

                                            <?
                                                $this->categoryTree($categories, 0, 0, '-',''); 
                                            ?>
                                           <select name="parentCategory" class="form-control">
                                                <option value="0">ROOT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div>
                                        */ ?>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input class="form-control" name="categoryName" value="" required>                                            
                                        </div>
                                         <!-- <div class="form-group">
                                            <label>Category image</label><br/>
                                            <input type="file" name="categoryImage" accept="image/png, image/jpeg" > 
                                             
                                        </div>
                                         <div class="form-group">
                                            <label>Category Mobile Icon</label><br/>
                                            <input type="file" name="categoryImageIcon" accept="image/png, image/jpeg"> 
                                             
                                        </div> -->
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
               
                $imagename = 'beauty-mineral_'.$date.'_'.$_FILES['categoryImage']['name'];
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
            'categoryName' => $db->filter($_POST['categoryName']),
            'parentCategory' => $db->filter($_POST['parentCategory']),
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

    function getAllProductOrderCategories($parentId){
        $db = new DB();

        $query = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE parentCategory ='".$parentId."'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
             $categories[]=$row;
        }

        return $categories;
    }

    function getAllOrderDetails(){
        
        $db = new DB();

        //$query = "SELECT * FROM ".ORDER_DETAILS." ORDER BY dateTime DESC LIMIT 100";
        $query = "SELECT id,userId,invoiceNo,invoiceNumber,fullName,mobileNumber,orderStatus,paymentType,onlinePaymentStatus,viewOrders,foundUsOn,supportComment,chicken,mutton,source,giftOrder FROM ".ORDER_DETAILS." ORDER BY dateTime DESC LIMIT 100";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $orders[]=$row;
        }

        return $orders;

    }
    function getTotalOrderDetails(){
        
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

        $query = "SELECT * FROM ".ORDER_DETAILS." WHERE userId = '".$userId."' AND orderStatus != 'Cancel' ORDER BY dateTime DESC";
        
        $results = $db->num_rows( $query );
        
        return $results;
    }
    function updateChickenStatus(){
        $db = new DB();
       $query = "SELECT id FROM ".ORDER_DETAILS." WHERE orderStatus = 'Pending' AND id > 6500";     
       if($db->num_rows( $query )>0){
            $orders = $db->get_results($query);
            foreach ($orders as $order){
                   $chickenStatus = $this->getUserOrderedChicken($order['id']);
                   if($chickenStatus){
                        $update = array(
                            'chicken' => '1'
                            );
                        $where_clause = array(
                            'id' => $order['id']
                            );
                        $updated = $db->update(ORDER_DETAILS, $update, $where_clause, 1 );
                   }
            }
        }        
    }
     function updateMuttonStatus(){
        $db = new DB();
        $query = "SELECT id FROM ".ORDER_DETAILS." WHERE orderStatus = 'Pending' AND id > 6500";   
       //$query = "SELECT id FROM ".ORDER_DETAILS;     
        if($db->num_rows( $query )>0){ 
            $orders = $db->get_results($query);
            foreach ($orders as $order){
                   $muttonStatus = $this->getUserOrderedMutton($order['id']);
                   if($muttonStatus){
                        $update = array(
                            'mutton' => '1'
                            );
                        $where_clause = array(
                            'id' => $order['id']
                            );
                        $updated = $db->update(ORDER_DETAILS, $update, $where_clause, 1 );
                   }
            }
        }        
    }
     function getUserOrderedChicken($orderId){
        $db = new DB();
        $chikenCatId = 64;
        $query = "SELECT productId FROM ".ORDER_ITEMS." WHERE orderId = '".$orderId."' AND active = '1'";
         if($db->num_rows( $query ) > 0 ){
           $orderItems = $db->get_results( $query, true );
           $productIds = array();
           $categoryIds = array();
           foreach ($orderItems as $orderItem) {
               $productIds[] = $orderItem->productId;
           }
           $productId = implode("','",$productIds);
           $query1 = "SELECT categoryId FROM ".PRODUCTS." WHERE id IN ('".$productId."')";
               if($db->num_rows( $query1 ) > 0 ){
                   $productItems = $db->get_results( $query1, true );
                    foreach ($productItems as $productItem) {
                       //$categoryIds[] = $productItem->categoryId;
                       if($productItem->categoryId ==$chikenCatId){
                         return true;
                       }
                   }
                   return false;
                   // if (in_array($chikenCatId, $categoryIds))
                   //      {
                   //          return true;
                   //      }else{
                   //          return false;
                   //      }
               }else{
                    return false;
               }
        }else{
           return false;
        }

    }

    function getUserOrderedMutton($orderId){
        $db = new DB();
        $muttonCatId = 66;
        $query = "SELECT productId FROM ".ORDER_ITEMS." WHERE orderId = '".$orderId."' AND active = '1'";
         if($db->num_rows( $query ) > 0 ){
           $orderItems = $db->get_results( $query, true );
           $productIds = array();
           $categoryIds = array();
           foreach ($orderItems as $orderItem) {
               $productIds[] = $orderItem->productId;
           }
           $productId = implode("','",$productIds);
           $query1 = "SELECT categoryId FROM ".PRODUCTS." WHERE id IN ('".$productId."')";
               if($db->num_rows( $query1 ) > 0 ){
                   $productItems = $db->get_results( $query1, true );
                    foreach ($productItems as $productItem) {
                       //$categoryIds[] = $productItem->categoryId;
                       if($productItem->categoryId ==$muttonCatId){
                         return true;
                       }
                   }
                   return false;
                   // if (in_array($muttonCatId, $categoryIds))
                   //      {
                   //          return true;
                   //      }else{
                   //          return false;
                   //      }
               }else{
                    return false;
               }
        }else{
           return false;
        }
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

    function getAllEnquiredUsers(){
        $db = new DB();

        $query = "SELECT * FROM ".ENQUIRED_USERS." ORDER BY id DESC";
        $results = $db->get_results( $query );
        if($db->num_rows( $query ) > 0 ){
            foreach( $results as $row ){
                $users[]=$row;
            }
        }

        return $users;
    }



    function categoryTree(&$output, $preselected, $parent=0, $indent="",$type){

        $db = new DB();

        $query = "SELECT id, categoryName,parentCategory FROM ".PRODUCT_CATEGORIES." WHERE parentCategory=".$parent." ORDER BY categoryName";

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

        $query = "SELECT id, brandName FROM ".BRANDS." ORDER BY brandName";

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["brandName"] . "</option>";
               
               

        }

    }

    function supplierTree(&$output, $preselected, $indent=""){

        $db = new DB();

        $query = "SELECT id, companyName FROM ".SUPPLIERS." ORDER BY companyName";

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
                                        <?php /*<div class="form-group">
                                            <label>Parent Category</label>

                                            <?
                                                $this->categoryTree($categories, $categoryData->parentCategory, 0, '-',''); 
                                            ?>
                                           <select name="parentCategory" class="form-control">
                                                <option value="0">ROOT</option>
                                               <?php echo $categories ?>
                                            </select>
                                        </div> */ ?>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input class="form-control" name="categoryName" value="<?=$categoryData->categoryName?>" required>                                            
                                        </div>
                                        <!--  <div class="form-group">
                                            <label>Category Image</label><br/>
                                            <input type="file" name="categoryImage" accept="image/png, image/jpeg"> 
                                             
                                        </div> -->


                                           <?php if($categoryData->categoryImg !=''){?>
                                            <div class="row" >
                                                <img src="<?=APP_URL?>/categoryFiles/images/thumb/<?=$categoryData->categoryImg?>" title="<?=$categoryData->categoryName?>" width="100">
                                                
                                                
                                            </div>
                                            <?php } ?>
                                           <!--   <div class="form-group">
                                            <label>Category Mobile Icon</label><br/>
                                            <input type="file" name="categoryImageIcon" accept="image/png, image/jpeg"> 
                                             
                                        </div> -->


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
               
                $imagename = 'beauty-mineral_'.$date.'_'.$_FILES['categoryImage']['name'];
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
            'categoryName' => $db->filter($_REQUEST['categoryName']), 
            'parentCategory' => $db->filter($_REQUEST['parentCategory']),
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

    function expiringProduct(){
            
            $db = new DB();
            
        ?>

         <div class="row">
                <div class="col-lg-12 alert alert-success updateproductCostsuccess"> </div>
                <div class="col-lg-12 alert alert-danger updateproductCosterror"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Expiring Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Expiring Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="30%">Product Name</th>
                                            <th width="20%">Category</th>
                                            <th width="25%">Product Wt/Qty - Stock - Price</th>
                                            <th width="20%">Expiry Date</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php
                                        $nextMntdate = date('Y-m-d', strtotime('+1 month'));
                                        $todayDate = date('Y-m-d');
                                        $qry1 = "SELECT products.* FROM ".PRODUCTS." LEFT JOIN product_options on(products.id = product_options.productId) WHERE products.active = '1' AND product_options.expiryDate <= '".$nextMntdate."' AND product_options.expiryDate != '0000-00-00' AND product_options.active = '1' GROUP BY product_options.productId ORDER BY product_options.expiryDate";
                                        $productsList = $db->get_results( $qry1, true );
                                        foreach($productsList as $products){
                                            

                                            if($products->categoryId>0){
                                                   $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$products->categoryId."'";
                                                   $categoryData = $db->get_row($qry, true);
                                            }
                                            
                                            $query = "SELECT * FROM ".PRODUCT_OPTIONS." WHERE productId =".$products->id." AND expiryDate <= '".$nextMntdate."' AND expiryDate != '0000-00-00' AND active = '1' ORDER BY expiryDate";
                                            $results = $db->get_results($query);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$products->productName?></td>
                                            <td><?=$categoryData->categoryName?></td>
                                            <td><?php foreach ($results as $row) { 
                                                if($row['expiryDate'] < $todayDate){ ?> <span class="expiredProduct"> <?php } ?>
                                                <?=$row['productWeight'].' '.$row['productUnit'].' - '.$row['productStock'].' - '.$row['productCost'];?><br/>
                                                <?php if($row['expiryDate'] < $todayDate){ ?> </span> <?php } 
                                                 } ?>
                                            </td>
                                            <td><?php foreach ($results as $row) { if($row['expiryDate'] < $todayDate){ ?><span class="expiredProduct"><?php } ?><?php echo date('d-m-Y',strtotime($row['expiryDate'])); ?><?php if($row['expiryDate'] < $todayDate){ ?> </span> <?php } ?><br/><?php } ?>
                                            </td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editProduct&productId=<?=$products->id?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                                
                                             </td>
                                        </tr>
                                     <?php } ?>
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
                    "order": [[ 3,"desc" ]],
                    "columnDefs": [
                                { "orderable": false, "targets": 2 },
                                { type: 'date-uk', targets: 3 }
                             ]
            });

            });
            </script>
    <?php
    }        

    function manageProducts(){
            
            $db = new DB();
            
        ?>
        <link rel="stylesheet" type="text/css" href="css/jquery.toast.css" media="all">
        <script src="js/jquery.toast.js" defer></script>
        <script src="js/jquery.dataTables.yadcf.js"></script>
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
                            <div id="external_filter_container"></div>
                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="30%">Product Name</th>
                                            <!-- <th width="15%">Category</th> -->
                                            <th width="50%">Product Wt/Qty - Stock - Price</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php
                                        $query = "SELECT * FROM ".PRODUCTS ;
                                        $results = $db->get_results($query);
                                    
        
                                        foreach($results as $row){

                                            // if($row['categoryId']>0){
                                            //        $qry = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE id='".$row['categoryId']."'";
                                            //        $categoryData = $db->get_row( $qry, true );
                                            // }
                                            
                                            $qry1 = "SELECT * FROM ".PRODUCT_OPTIONS." WHERE productId='".$row['id']."' AND active = '1'";
                                            $productOptions = $db->get_results( $qry1, true );
                                                                                     

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$row['productName']?><?php if(($row['brandId'] == 0) && ($row['brandId'] =='')){ echo " &nbsp;&nbsp;<span class='nostock' title='No brand'>#NB</span>";}?></td>
                                            <!-- <td><?=$categoryData->categoryName?></td> -->
                                            <td ><?php foreach($productOptions as $prdOptiondetails){
                                                    $checked = 0;
                                                    $lastCheckTime = 'Unchecked';
                                                    if($prdOptiondetails->lastCheckTime !='' && $prdOptiondetails->lastCheckTime != '0000-00-00'){
                                                        $lastCheckTime = mdyDateFormat($prdOptiondetails->lastCheckTime);
                                                        if(strtotime($prdOptiondetails->lastCheckTime) > strtotime('-30 days')) {
                                                            $checked = 1;
                                                        }else{
                                                            $checked = 0;
                                                        }
                                                    }else{
                                                        $checked = 0;
                                                    }
                                                  $disabled = '';
                                                 // if($row['categoryId']!='1' && $row['categoryId']!='2' ) {
                                                 //    $disabled = "disabled"; 
                                                 // } 
                                                //if($row['categoryId']!='1' && $row['categoryId']!='2' ) {echo "<span class='disableUpdateOpt'>";}    
                                               if($prdOptiondetails->productStock <= 5){ echo "<span class='stock_alert'>";}


                                               echo '<span class="prodWordspace">'.$prdOptiondetails->productWeight.' '.$prdOptiondetails->productUnit.' </span>- <input type="text" pattern="[0-9]*" class="stockOptTxt" id="stockopt_'.$prdOptiondetails->id.'" value="'.$prdOptiondetails->productStock.'" size="2" '.$disabled.' />'; 
                                               echo '&nbsp; - &nbsp;<input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" class="optPriceTxt" id="optPrice_'.$prdOptiondetails->id.'" value="'.$prdOptiondetails->productCost.'" size="4" '.$disabled.' />';
                                               echo '<a href="javascript:void(0)" class="updateProductcost" onclick="updateProductcost(\''.$prdOptiondetails->id.'\' , \''.$row["id"].'\');" title="Update stock and Cost" ><i class="fa fa-refresh"></i></a>'; 
                                               if($checked == 1){
                                                    echo "<span class='checkTimeText'>Yes</span>";
                                                    echo '<a href="javascript:void(0)" id="prdOptCheck_'.$prdOptiondetails->id.'" class="lastCheckTime check" onclick="updateLastCheckTime(\''.$prdOptiondetails->id.'\' ,\''.$row["id"].'\', \'uncheck\');" title="Checked - '.$lastCheckTime.'" ><i class="fa fa-check-square fa-lg" aria-hidden="true"></i></a>'; 
                                               }else{
                                                    echo "<span class='checkTimeText'>No</span>";
                                                    echo '<a href="javascript:void(0)" id="prdOptUncheck_'.$prdOptiondetails->id.'" class="lastCheckTime uncheck" onclick="updateLastCheckTime(\''.$prdOptiondetails->id.'\' ,\''.$row["id"].'\', \'check\');" title="Unchecked" ><i class="fa fa-square-o fa-lg" aria-hidden="true"></i></a>';     
                                               }
                                               echo '<span id="lastCheckTime_'.$prdOptiondetails->id.'"></span>';
                                                if($prdOptiondetails->productStock <= 5){ echo " </span> &nbsp;&nbsp;<span class='lessThan5' title='<=5'>#L5</span>";}
                                                if($prdOptiondetails->productStock <= 0){ echo " &nbsp;&nbsp;<span class='nostock' title='No stock'>#NS</span>";}
                                               // if($row['categoryId']!='1' && $row['categoryId']!='2' ) {echo "</span>";} 
                                                echo "<br/>";
                                            } ?>

                                            </td>
                                            <!-- <td><?php foreach($productOptions as $prdOptiondetails){?>
                                                <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" class="optPriceTxt" id="optDistPrice_<?=$prdOptiondetails->id?>" value="<?=$prdOptiondetails->productDistributerPrice?>" size="4"/>
                                                <a href="javascript:void(0)" class="updateDistPrice" onclick="updateDistPrice('<?=$prdOptiondetails->id?>' , '<?=$row["id"]?>');" title="Update distributer price" ><i class="fa fa-refresh"></i></a>
                                                <?php } ?>
                                            </td> -->
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
            // $('#dataTables-example').dataTable().yadcf([
            //     {column_number: 2, data: [{value: 'Yes', label: 'Checked'}, { value: 'No', label: 'Unchecked'}],filter_default_label: "Select"}
            // ]);
             //$(".disableUpdateOpt .stockOptTxt").prop('disabled', true);
             //$(".disableUpdateOpt .optPriceTxt").prop('disabled', true);
            });
            function updateProductcost(prdOptid,prdId){
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
                            data: "action=updatecoststock&productOptionId="+prdOptid+"&productId="+prdId+"&stockqty="+qty+"&productCost="+cost,
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
            function updateLastCheckTime(prdOptid,prdId,status){
                    var qty = $('#stockopt_'+prdOptid).val(); 
                    var cost = $('#optPrice_'+prdOptid).val(); 
                    if(!/^([0-9]*)$/.test(qty)){
                        return false;
                    }
                    if(!/^([0-9]+(\.[0-9]{1,2})?$)/.test(cost)){
                        return false;
                    }
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth(); //January is 0!
                    var yyyy = today.getFullYear();
                    var monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    var month = monthShortNames[mm] 
                    var today = month+' '+dd+', '+yyyy;
                   
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=updateLastCheckTime&productOptionId="+prdOptid+"&status="+status+"&productId="+prdId+"&stockqty="+qty+"&productCost="+cost,
                            success: function(msg){       
                                   if(msg =='success'){
                                      if(status == 'check'){
                                            $('#prdOptUncheck_'+prdOptid).hide();
                                            $('#lastCheckTime_'+prdOptid).html('<a href="javascript:void(0)" id="prdOptCheck_'+prdOptid+'" class="lastCheckTime check" onclick="updateLastCheckTime(\''+prdOptid+'\' ,\''+prdId+'\' , \'uncheck\');" title="Checked - '+today+'" ><i class="fa fa-check-square fa-lg" aria-hidden="true"></i></a>');
                                            jQuery.toast({
                                                heading: 'Checked',
                                                text: 'Product checked',
                                                showHideTransition: 'slide',
                                                icon: 'success',
                                                hideAfter: 2000
                                            })
                                       }else{
                                            $('#prdOptCheck_'+prdOptid).hide();
                                            $('#lastCheckTime_'+prdOptid).html('<a href="javascript:void(0)" id="prdOptUncheck_'+prdOptid+'" class="lastCheckTime uncheck" onclick="updateLastCheckTime(\''+prdOptid+'\' ,\''+prdId+'\' , \'check\');" title="Unchecked" ><i class="fa fa-square-o fa-lg" aria-hidden="true"></i></a>');
                                            jQuery.toast({
                                                heading: 'Unchecked',
                                                text: 'Product Unchecked',
                                                showHideTransition: 'slide',
                                                icon: 'success',
                                                hideAfter: 2000
                                            })
                                       }
                                       
                                   }else{
                                        jQuery.toast({
                                            heading: 'Error',
                                            text: 'Problem while updating. Please try again!',
                                            showHideTransition: 'slide',
                                            icon: 'error',
                                            hideAfter: 3500,

                                        })
                                        
                                   }                                                            
                            }
                        });
                
            }
            function updateDistPrice(prdOptid,prdId){
                
                var cost = $('#optDistPrice_'+prdOptid).val(); 
                
                if(confirm("Are you sure you want to update distributer price ?")){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=updateDistPrice&productOptionId="+prdOptid+"&productId="+prdId+"&distPrice="+cost,
                            success: function(msg){       
                                   if(msg =='success'){
                                        $('.updateproductCostsuccess').show('slow');
                                        $('.updateproductCostsuccess').html('Distributer price is updated.');
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
            $categories = $this->getAllProductOrderCategories(0);
            //pre($categories);
        ?>
            <script type="text/javascript" src="js/jquery-ui.js"></script>
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
                                 <?php foreach ($categories as $categorie) { 
                                    $catId = $categorie['id'];
                                    $subquery = '';
                                    echo "<h3>".$categorie['categoryName']."</h3>";
                                    echo "<div id='loading".$catId."' class='text-center'> </div><ul id='sortme".$catId."' class='productSort'>";
                                    $subcategories = $this->getAllProductOrderCategories($categorie['id']);
                                    if(count($subcategories) > 0){
                                        foreach ($subcategories as $subcategorie) {
                                            $subcatid[] = $subcategorie['id'];
                                        }
                                        $subcat = implode(',', $subcatid);
                                        $subquery = " OR categoryId IN (".$subcat.")";
                                    }   
                                    $query = "SELECT * FROM ".PRODUCTS." WHERE active = '1' AND categoryId=".$categorie['id']." ".$subquery." ORDER BY product_orders ASC" ;
                                    $results = $db->get_results($query);
                                    foreach($results as $row){
                                        $qry = "SELECT categoryName,parentCategory FROM ".PRODUCT_CATEGORIES." WHERE id='".$row['categoryId']."'";
                                        $categoryData = $db->get_row( $qry, true );
                                        if($categoryData->parentCategory == '0'){
                                            $categoryName = '';
                                        }else{
                                            $categoryName = $categoryData->categoryName;
                                        }
                                       
                                         echo '<li id="questions_' . $row['id'] . '">' . $row['productName'] ."<span>".$categoryName."</span></li>\n";
                                     } 
                                    echo "</ul>";    
                                    ?>
                                    <script>
                                        $(document).ready(function() {
                                                    var catId = '<?=$catId?>';
                                                    $("#sortme"+catId).sortable({
                                                    update : function () {
                                                        serial = 'action=sortProducts&' + $('#sortme'+catId).sortable('serialize');
                                                        $('#loading'+catId).html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
                                                        $.ajax({
                                                            url: "ajxHandler.php",
                                                            type: "post",
                                                            data: serial,
                                                            success:function(response){
                                                                console.log(response);

                                                                $('#loading'+catId).html('');
                                                                 $('.updateproductCostsuccess').show('slow');
                                                                 $('.updateproductCostsuccess').html('Product order is updated.');
                                                                    setTimeout(function(){
                                                                      $('.updateproductCostsuccess').hide('slow');
                                                                    }, 2000);
                                                            },
                                                            error: function(){
                                                                $('#loading'+catId).html('');
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
                                <?php } ?>
                              
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

    
    function updateLastCheckTime(){
        $db = new DB();
        $productOptionId = $db->filter($_REQUEST['productOptionId']);
        $status = $db->filter($_REQUEST['status']);
        $stockqty = $db->filter($_REQUEST['stockqty']);
        $productCost = $db->filter($_REQUEST['productCost']);
        $productId = $db->filter($_REQUEST['productId']);
        if($status == 'check'){
            date_default_timezone_set("Asia/Calcutta");
             $dateTime  = date('Y-m-d', time());
        }else{
            $dateTime =NULL;
        }
        
        $updateData = array(
                'productCost' => $productCost,
                'productStock' => $stockqty,
                'lastCheckTime' => $dateTime
        );

        $where_clause_optid = array(
                'id' => $productOptionId
          );

        $update = $db->update(PRODUCT_OPTIONS, $updateData, $where_clause_optid);
        if($update){
            $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active='1'";
            $productOptions = $db->get_results($query);
            $totalStock = 0;
            foreach($productOptions as $productOption){
                $totalStock += $productOption['productStock'];
            }
            $stockData = array(
            'productStock' => $totalStock,
            );
            $where_clause_stock = array(
                'id' => $productId
            );
            $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
            echo "success";
        }else{
            echo "fail";
        }
    }

    function updatecoststock(){
        $db = new DB();
        $productOptionId = $db->filter($_REQUEST['productOptionId']);
        $stockqty = $db->filter($_REQUEST['stockqty']);
        $productCost = $db->filter($_REQUEST['productCost']);
        $productId = $db->filter($_REQUEST['productId']);
        $updateData = array(
                'productCost' => $productCost,
                'productStock' => $stockqty
        );

        $where_clause_optid = array(
                'id' => $productOptionId
          );

        $update = $db->update(PRODUCT_OPTIONS, $updateData, $where_clause_optid);
        if($update){
                $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active='1'";
                $productOptions = $db->get_results($query);
                $totalStock = 0;
                foreach($productOptions as $productOption){
                    $totalStock += $productOption['productStock'];
                }
                $stockData = array(
                'productStock' => $totalStock,
                );
                $where_clause_stock = array(
                    'id' => $productId
                );
                $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);

            echo 'success';
        }else{
            echo 'fail';
        }
    }
    function updateDistPrice(){
        $db = new DB();
        $productOptionId = $db->filter($_REQUEST['productOptionId']);
        $distPrice = $db->filter($_REQUEST['distPrice']);
        $productId = $db->filter($_REQUEST['productId']);
        $updateData = array(
                'productDistributerPrice' => $distPrice
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

    function allowProduct(){
            
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
                           Allow Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="35%">Product Name</th>
                                            <th width="40%">Product Wt/Qty - Stock </th>
                                            <th width="20%">Price</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php
                                        $query = "SELECT * FROM ".PRODUCT_SUPPLY_ITEMS." WHERE donot_allow = '1'";
                                        $results = $db->get_results($query);
                                        foreach($results as $row){
                                           $qry1 = "SELECT productName FROM ".PRODUCTS." WHERE id='".$row['productId']."'";
                                            $product = $db->get_row( $qry1, true );
                                                                                     

                                        ?>
                                        <tr class="odd gradeX" id="productSupply_<?=$row['id']?>">
                                            <td><?=$product->productName?></td>
                                            <td><?=$row['productWeight']?><?=$row['productUnit']?>&nbsp;-&nbsp;<?=$row['productQty']?></td>
                                            <td><?=$row['chitkiprice']?></td>
                                            <td class="center"> 
                                               <a href="javascript:void(0)" onclick="allowSupplyProducts('<?=$row["id"]?>');" title="Allow products " ><i class="fa fa-check-square"></i></a>
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
            function allowSupplyProducts(prdSupplyId){
               
                if(confirm("Are you sure you want to update cost and stock ?")){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=allowSupplyProducts&prdSupplyId="+prdSupplyId,
                            success: function(msg){       
                                   if(msg =='success'){
                                        $('#productSupply_'+prdSupplyId).css('display','none');
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

    function allowSupplyProducts(){
        $db = new DB();
        $product_supplyId = $db->filter($_REQUEST['prdSupplyId']);
        $prdoctSupplyDetails = $db->get_row("SELECT * FROM ".PRODUCT_SUPPLY_ITEMS." WHERE id = '".$product_supplyId."'",true);
        if($prdoctSupplyDetails){
        
            $productName = $prdoctSupplyDetails->productId;
            $chitkiprice   = $prdoctSupplyDetails->chitkiprice;
            $mrp = $prdoctSupplyDetails->productmrp;
            $productQty   = $prdoctSupplyDetails->productQty;
            $productWeight   = $prdoctSupplyDetails->productWeight;
            $productUnit = $prdoctSupplyDetails->productUnit;
            $expiryDate = $prdoctSupplyDetails->expiryDate;
            $distributerPrice = $prdoctSupplyDetails->productDistributerPrice;
            
                $productoptionResult = $db->get_row("SELECT id,productCost,productStock,productMRP,expiryDate,productDistributerPrice FROM ".PRODUCT_OPTIONS." WHERE productId = '".$productName."' AND active = '1' AND productUnit ='".$productUnit."' AND productWeight ='".$productWeight."' ",true);
                $productOptionId = $productoptionResult->id;
                $productStock = $productoptionResult->productStock;
                $oldproductCost = $productoptionResult->productCost;
                $productMRP = $productoptionResult->productMRP;
                $oldexpiryDate = $productoptionResult->expiryDate;
                $productDistributerPrice = $productoptionResult->productDistributerPrice;       
                $expDate = $expiryDate;
                if($mrp!='' || $mrp!=0){
                    $productMRPAmount = $mrp;

                }else{
                   $productMRPAmount =  $productMRP;
                }
                if($chitkiprice!='' || $chitkiprice!=0){
                    $newProductCost = $chitkiprice;
                }else{
                    $newProductCost = $oldproductCost;
                }
                if($expDate !=''){
                    $newexpDate =  $expDate;
                }else{
                    $newexpDate =  $oldexpiryDate;
                }
                if($distributerPrice !=''){
                    $productDistributerPrice =  $distributerPrice;
                }else{
                    $productDistributerPrice =  $productDistributerPrice;
                }

                $newproductStock = $productStock + $productQty;
                
                $update = array(
                    'productCost' => $newProductCost, 
                    'productStock' => $newproductStock,
                    'productMRP' => $productMRPAmount,
                    'expiryDate' => $newexpDate,
                    'productDistributerPrice' => $productDistributerPrice
                );

                $where_clause = array(
                    'id' => $productOptionId
                );
                
                $updated = $db->update(PRODUCT_OPTIONS, $update, $where_clause );
                if($updated){
                    $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productName."' AND active='1'";
                    $productOptions = $db->get_results($query);
                    $totalStock = 0;
                    foreach($productOptions as $productOption){
                        $totalStock += $productOption['productStock'];
                    }
                    $stockData = array(
                    'productStock' => $totalStock,
                    );
                    $where_clause_stock = array(
                        'id' => $productName
                    );
                    $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
                }
               
                 $records = array(
                    'donot_allow' => '0'
                );

                  $where_supply_clause = array(
                        'id' => $product_supplyId
                    );
                $updateSupply = $db->update(PRODUCT_SUPPLY_ITEMS, $records, $where_supply_clause);
               
                $i++;
           
            
            echo 'success';
        }else{
             echo 'fail';
        }
    }
    function addNewProduct(){
            $db = new DB();
            $categories = $this->getAllProductCategories();
            $attributes = $this->getAllAttributes();

            // Weight Units
            $weightUnits = $this->getProductAttributeValsByWeight();

        ?>

        <script type="text/javascript">
           $( document ).ready(function() {
            var selectContent = '';
            var costPerWtVal = parseInt($('#costPerWtCount').val());
            $.ajax
            ({
                type: "POST",
                url: "ajxHandler.php",
                data: "action=attributesSelectValue&costPerWtVal="+costPerWtVal,
                success: function(msg){       
                    selectContent = msg;                                             
                }
            });
            var unitsContent = '';
            $.ajax
            ({
                type: "POST",
                url: "ajxHandler.php",
                data: "action=unitsSelectValue",
                success: function(msg){       
                    unitsContent = msg;                                             
                }
            });
            // <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productDiscount[]" id="productDiscount_0" style="width:10% !important; display:inline !important" placeholder="Discount">&nbsp;
           var costPerWtVal=0;
           $('#addMoreCostsPerWeightElement').click(function(){
                var content = $(this).attr("data-val");
                costPerWtVal=costPerWtVal + 1;
                $.ajax
                    ({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=attributesSelectValue&costPerWtVal="+costPerWtVal,
                        success: function(msg){       
                            selectContent = msg;                                             
                        }
                    });
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+costPerWtVal;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+= selectContent+'<input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productCost[]" id="productPrice_0" style="width:9% !important; display:inline !important" placeholder="Price" required>&nbsp;<input type="number" class="form-control" name="productStock[]" value="1" id="productStockt_0" style="width:9% !important; display:inline !important" placeholder="Stock" required>&nbsp;<br/><br/>';
               contentID.appendChild(newTBDiv);
                $('#costPerWtCount').val(costPerWtVal);
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
                var costPerWtVal = parseInt($('#costPerWtCount').val());       
                if(costPerWtVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+costPerWtVal));
                    costPerWtVal = costPerWtVal-1;
                    $('#costPerWtCount').val(costPerWtVal);
                     $.ajax
                    ({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=attributesSelectValue&costPerWtVal="+costPerWtVal,
                        success: function(msg){       
                            selectContent = msg;                                             
                        }
                    });
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

            $("form").submit(function(e) {
                var attrAry = new Array(); 
                var costPerWtVal = parseInt($('#costPerWtCount').val());  
                for(var i=0; i <= costPerWtVal; i++){
                    var arr = new Array();             
                    $('.attrgroup_'+i).each(function(){
                        arr.push(this.value);                        
                    });
                    attrAry.push(arr);                    
               }
               console.log(attrAry);
               var uniqueCoors = [];
                var doneCoors = [];
                for(var x = 0; x < attrAry.length; x++) {
                    var coorStr = attrAry[x].toString();
                    if(doneCoors.indexOf(coorStr) != -1) {
                        var optno1 = parseInt(doneCoors.indexOf(coorStr))+1;
                        var optno2 = parseInt(x)+1;

                        alert("Product Attributes are repeated in product option -> "+optno1+" and "+optno2);
                        return false;
                    }

                    doneCoors.push(coorStr);
                    uniqueCoors.push(attrAry[x]);
                }
               
                var ref = $(this).find("[required]");
                $(ref).each(function(){
                    if ( $(this).val() == '' )
                    {
                        alert("Required field should not be blank.");
                        $(this).focus();
                        e.preventDefault();
                        return false;
                    }
                });  return true;
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
        <link href="css/magicsuggest-min.css" rel="stylesheet">
        <script src="js/magicsuggest-min.js"></script>   
        
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
                                    <form action="" name="product_form" id="addProductForm" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="saveNewProduct" />

                                        <!-- <div class="form-group">
                                            <label>Stock Keeping Unit (SKU) </label>
                                            <input class="form-control" name="sku" value="" required>                                            
                                        </div> -->

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
                                       
                                        <!-- <div class="form-group">
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
                                        </div> -->

                                         


                                        <div class="form-group">
                                            <p class="Title">
                                                <?php if(count($attributes)>0){ foreach($attributes as $attribute){ ?>
                                                    <label style="width:11% !important; display:inline-block !important"><?=$attribute['attributeName']?></label>
                                                <? } } ?>
                                                <label style='width:10% !important; display:inline-block !important'>Price</label><!-- <label style='width:10% !important; display:inline-block !important'>Discount (%)</label> --><label style="width:10% !important; display:inline-block !important">Stocks</label>
                                            </p>
                                            <?php if(count($attributes)>0){ foreach($attributes as $attribute){ 
                                                
                                                   $attributeValues = $db->get_results("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$attribute['id']."' AND active='1'");
                                                   
                                                    //if(!empty($attributeValues)){
                                                   
                                              ?>            <input type="hidden" name="attributeId[]" value="<?=$attribute['id']?>">
                                                            <select class="form-control attrgroup_0" name="attributeValueId[<?=$attribute['id']?>][]" style="width:11% !important; display:inline-block !important">
                                                                <option value="">Select <?=$attribute['attributeName']?></option>
                                                                <? foreach($attributeValues as $attributeValue){ ?>
                                                                   <option value="<?=$attributeValue['id']?>"><?=$attributeValue['attributeValue']?></option>
                                                                <? } ?>
                                                            </select>    
                                                <?php // }
                                                
                                                } } ?>
                                               
                                                <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productCost[]" id="productPrice_0" style="width:9% !important; display:inline !important" placeholder="Price" required>
                                                <!-- <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productDiscount[]" id="productDiscount_0" style="width:10% !important; display:inline !important" placeholder="Discount"> -->
                                                <input type="number" class="form-control" name="productStock[]" value="1" id="productStockt_0" style="width:9% !important; display:inline !important" placeholder="Stock" required>
                                                                                                
                                        
                                                <a href="javascript:void(0);" id="addMoreCostsPerWeightElement" data-val="moreWeights" Title="Add more"><i class="fa fa-plus-square fa-lg"></i></a>
                                                <a href="javascript:void(0);" id="removeCostsPerWeightElement" data-val="moreWeights" Title="Remove"><i class="fa fa-minus-square fa-lg"></i></a>
                                                <br/><br/>
                                                <div class='moreWeights' id="moreWeights"></div>  
                                                <input type="hidden" id="costPerWtCount" name="costPerWtCount" value="0">
                                                <br/>     
                                        </div>

                                         <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" rows="3" name="productDescription"></textarea>
                                            <!--  <script type="text/javascript">
                                                CKEDITOR.replace('productDescription');
                                            </script>  -->
                                            <script type="text/javascript">
                                                 var editor = CKEDITOR.replace( 'productDescription', {
                                                    filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
                                                    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
                                                    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
                                                    filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                });
                                                CKFinder.setupCKEditor( editor, '../' );
                                            </script>      
                                        </div>

                                        <div class="form-group">
                                            <label>Search Keyword</label>
                                            <textarea class="form-control" rows="3" name="keywordSearch"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Product Photos</label><br/>
                                            <input type="file" name="productPhotos[]" accept="image/png, image/jpeg" onChange="document.getElementById('moreUploadsLink').style.display = 'block';" style="width:50% !important; display:inline !important"> 
                                             <!-- <a href="javascript:void(0)" id="addFileInput" title="Upload more photos"><i class="fa fa-plus-square fa-lg"></i></a> -->
                                             <div id="moreUploads"></div>                                           
                                             <input type="hidden" id="uploadsNeeded" name="uploadsNeeded" value="">
                                        </div>
                                       <!--  <hr><h3>Ingredients</h3><hr>
                                        <div class="form-group">
                                            <label>Ingredient Name</label>
                                            <input type="text" maxlength="50" class="form-control" name="title[]">
                                        </div> 

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3" name="description[]"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Ingredient Photo</label><br/>
                                            <input type="file" name="image[]" accept="image/png, image/jpeg" style="width:50% !important; display:inline !important"> 
                                             <a href="javascript:void(0);" id="addMoreIngredientsElement" data-val="moreIngredient" Title="Add more Ingredients"><i class="fa fa-plus-square fa-lg"></i></a>
                                            <a href="javascript:void(0);" id="removeIngredientsElement" data-val="moreIngredient" Title="Remove Ingredients"><i class="fa fa-minus-square fa-lg"></i></a>
                                        </div>
                                        <div class='moreIngredient' id="moreIngredient">
                                            
                                        </div>   -->
                                       <!--  <div class="form-group">
                                            <label>Products Offers </label>
                                            <div class="productOffers" placeholder="Product Offers"></div>
                                            <input type="hidden" name="productOfferId" id="productOfferId" >
                                        </div>                            
                                        <div class="form-group">
                                            <label>Special Offers?</label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="1" id="specialOffers" name="specialOffers" onchange="checkSploffer();">Yes
                                                </label>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Ultra Fresh?</label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="1" id="ultraFresh" name="ultraFresh">Yes
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
                                            <label>Ramzan offer?</label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="1"  name="ramzanOffer"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="0"   checked="" name="ramzanOffer" class="radio-inline"> No
                                                </label>
                                            
                                        </div>  
                                        <div class="form-group">
                                            <label>Combo offer?</label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="1"  name="comboOffer"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="0"  checked="" name="comboOffer" class="radio-inline"> No
                                                </label>
                                            
                                        </div>  
                                        <div class="form-group">
                                            <label>Recommended  Products?</label>
                                                <label class="radio-inline">
                                                    <input type="checkbox" value="1"  name="ad"> Yes
                                                </label>
                                        </div>  -->

                                        <!-- <div class="form-group">
                                            <label>Product Type</label>
                                            <label class="radio-inline">
                                                <input type="checkbox" value="natureBalance" name="productType"> Nature balance
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="ourTopSellers" name="productType" class="radio-inline"> Our Top Sellers
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" value="skinCarebundles" name="productType" class="radio-inline"> Skin Care bundles
                                            </label>
                                        </div> 
 -->

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
                                        
                                        
                                        <button type="submit" class="btn btn-default" >Submit</button>
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
            
           <script type="text/javascript">
                $(function(){
                   
                  var ms = $('.productOffers').magicSuggest({
                        data: 'get_productoffers.php',
                        maxSelection: null
                    });
                  $(ms).on('selectionchange', function(){
                      $('#productOfferId').val(this.getValue());
                    });
                   
                });
            </script>
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
            $attributes = $this->getAllAttributes();
           // pre($productData);

            $query = "SELECT * FROM ".PRODUCT_OPTIONS." WHERE productId='".$productId."' AND active='1'";
            $productOptions = $db->get_results($query);

            $query = "SELECT * FROM ".PRODUCT_IMAGES." WHERE productId='".$productId."'";
            $productPhotos = $db->get_results($query);

            $productOptAttr = $db->get_results("SELECT DISTINCT prdOpt.id, prdOpt.productId,  prdOpt.productCost, prdOpt.productMRP, prdOpt.productStock, prdOpt.productWeight, prdOpt.productUnit  FROM product_options as prdOpt LEFT JOIN product_attributes as prdAtVal on prdOpt.id = prdAtVal.productOptionId WHERE prdOpt.productId='".$productId."' AND prdOpt.active = '1' ORDER BY prdAtVal.attributeValueId",true);

            // pre($productPhotos);
            $query = "SELECT * FROM ".INGREDIENTS." WHERE product_id='".$productId."'";
            $productIngredients = $db->get_results($query);


        ?>

        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
            $( document ).ready(function() {
            var selectContent = '';
            var costPerWtVal = parseInt($('#costPerWtCount').val());
            $.ajax
            ({
                type: "POST",
                url: "ajxHandler.php",
                data: "action=attributesSelectValue&costPerWtVal="+costPerWtVal,
                success: function(msg){       
                    selectContent = msg;                                             
                }
            });
            var unitsContent = '';
            $.ajax
            ({
                type: "POST",
                url: "ajxHandler.php",
                data: "action=unitsSelectValue",
                success: function(msg){       
                    unitsContent = msg;                                             
                }
            });
            // <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productDiscount[]" id="productDiscount_0" style="width:10% !important; display:inline !important" placeholder="Discount">&nbsp;
           var costPerWtVal=0;
           $('#addMoreCostsPerWeightElement').click(function(){
                var content = $(this).attr("data-val");
                costPerWtVal=costPerWtVal + 1;
                $.ajax
                    ({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=attributesSelectValue&costPerWtVal="+costPerWtVal,
                        success: function(msg){       
                            selectContent = msg;                                             
                        }
                    });
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var descriptionId = content+costPerWtVal;
                newTBDiv.setAttribute("id",descriptionId);
                newTBDiv.innerHTML+= selectContent+'<input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productCost[]" id="productPrice_0" style="width:9% !important; display:inline !important" placeholder="Price" required>&nbsp;<input type="number" class="form-control" name="productStock[]" value="1" id="productStockt_0" style="width:9% !important; display:inline !important" placeholder="Stock" required>&nbsp;<br/><br/>';
               contentID.appendChild(newTBDiv);
                $('#costPerWtCount').val(costPerWtVal);
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
                var costPerWtVal = parseInt($('#costPerWtCount').val());       
                if(costPerWtVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+costPerWtVal));
                    costPerWtVal = costPerWtVal-1;
                    $('#costPerWtCount').val(costPerWtVal);
                     $.ajax
                    ({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=attributesSelectValue&costPerWtVal="+costPerWtVal,
                        success: function(msg){       
                            selectContent = msg;                                             
                        }
                    });
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

            $("form").submit(function(e) {
                var attrAry = new Array(); 
                var costPerWtVal = parseInt($('#costPerWtCount').val());  
                for(var i=0; i <= costPerWtVal; i++){
                    var arr = new Array();             
                    $('.attrgroup_'+i).each(function(){
                        arr.push(this.value);                        
                    });
                    attrAry.push(arr);                    
               }
               var uniqueCoors = [];
                var doneCoors = [];
                for(var x = 0; x < attrAry.length; x++) {
                    var coorStr = attrAry[x].toString();
                    if(doneCoors.indexOf(coorStr) != -1) {
                        var optno1 = parseInt(doneCoors.indexOf(coorStr))+1;
                        var optno2 = parseInt(x)+1;

                        alert("Product Attributes are repeated in product option -> "+optno1+" and "+optno2);
                        return false;
                    }

                    doneCoors.push(coorStr);
                    uniqueCoors.push(attrAry[x]);
                }
               
                var ref = $(this).find("[required]");
                $(ref).each(function(){
                    if ( $(this).val() == '' )
                    {
                        alert("Required field should not be blank.");
                        $(this).focus();
                        e.preventDefault();
                        return false;
                    }
                });  return true;
            });

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
                                    <form action="" name="product_form" id="editProductForm" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="updateProduct" /> 
                                         <input type="hidden" name="productId" value="<?=$productData->id?>" /> 

                                       <!--  <div class="form-group">
                                            <label>Stock Keeping Unit (SKU) </label>
                                            <input class="form-control" name="sku" value="<?=$productData->sku?>" required>                                            
                                        </div> -->
                                        
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
                                        
                                       <!--  <div class="form-group">
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
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <p class="Title">
                                             <?php if(count($attributes)>0){ foreach($attributes as $attribute){ ?>
                                                    <label style="width:11% !important; display:inline-block !important"><?=$attribute['attributeName']?></label>
                                                <? } } ?>   
                                            <label style='width:10% !important; display:inline-block !important'>Cost</label><label style="width:10% !important; display:inline-block !important">Stock</label>
                                            </p>
                                            
                                            <?php
                                            $i=0;
                                            foreach ($productOptAttr as $productOptAttrVal) { ?>
                                            <div id="productOpt_<?=$productOptAttrVal->id?>" style="margin-bottom:5px;">
                                                
                                                <?php if(count($attributes)>0){ foreach($attributes as $attribute){ 
                                                    $attributeValueId = $db->get_row("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES." WHERE attributeId = '".$attribute['id']."' AND productOptionId = '".$productOptAttrVal->id."' AND active='1'",true);
                                                    //$attributeValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." WHERE id = '".$attributeValueId->attributeValueId."' AND active='1'",true);
                                                     $attributeValues = $db->get_results("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$attribute['id']."' AND active='1'");
                                                    ?>
                                                <?php //echo $attributeValues->attributeValue; ?>
                                                        <input type="hidden" name="attributeId[]" value="<?=$attribute['id']?>">
                                                            <select class="form-control attrgroup_<?=$i?>" name="attributeValueId[<?=$attribute['id']?>][]" style="width:11% !important; display:inline-block !important">
                                                                <option value="">Select <?=$attribute['attributeName']?></option>
                                                                <? foreach($attributeValues as $attributeValue){ ?>
                                                                   <option value="<?=$attributeValue['id']?>" <?php echo ($attributeValue['id']==$attributeValueId->attributeValueId)?"selected='selected'":"";?> ><?=$attributeValue['attributeValue']?></option>
                                                                <? } ?>
                                                            </select> 
                                               
                                                <?php } } ?>  
                                                
                                                                                              
                                                <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" name="productCost[]" value="<?=$productOptAttrVal->productCost?>" style="width:9% !important; display:inline !important" class="form-control" id="productOptPrice_<?=$productOptAttrVal->id?>" placeholder="Price" required >
                                                
                                                <input type="number" class="form-control" name="productStock[]" value="<?=$productOptAttrVal->productStock?>" id="productOptStock_<?=$productOptAttrVal->id?>" style="width:9% !important; display:inline !important" placeholder="Stock" required>
                                                
                                                <a href="javascript:void(0);" id="deleteProductOption" onclick="deleteProductOption('<?=$productOptAttrVal->id?>');" data-val="<?=$productOptAttrVal->id?>" Title="Delete Option"><i class="fa fa-trash-o fa-lg"></i></a>&nbsp;<!-- <a href="javascript:void(0);" id="updateProductOption" onclick="updateProductOption('<?=$productOptAttrVal->id?>','<?=$productDetails->id?>');"  Title="Update Option"><i class="fa fa-refresh fa-lg" ></i></a> -->
                                                
                                            </div>

                                            <?php $i++; } ?>
                                          
                                            
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
                                            </div>  
                                            <br/>   
                                             <div class="form-group">
                                            
                                            <?php if(count($attributes)>0){ foreach($attributes as $attribute){ 
                                                   $attributeValues = $db->get_results("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$attribute['id']."' AND active='1'");
                                                    if(!empty($attributeValues)){
                                              ?>            <input type="hidden" name="attributeId[]" value="<?=$attribute['id']?>">
                                                            <select class="form-control attrgroup_<?=$i?>" name="attributeValueId[<?=$attribute['id']?>][]" style="width:11% !important; display:inline-block !important">
                                                                <option value="">Select <?=$attribute['attributeName']?></option>
                                                                <? foreach($attributeValues as $attributeValue){ ?>
                                                                   <option value="<?=$attributeValue['id']?>"><?=$attributeValue['attributeValue']?></option>
                                                                <? } ?>
                                                            </select>    
                                                <?php  }
                                                } } ?>
                                               
                                                <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?$" title="only numbers" class="form-control" name="productCost[]" id="productPrice_0" style="width:9% !important; display:inline !important"  placeholder="Price" >
                                                
                                                <input type="number" class="form-control" name="productStock[]" value="1" id="productStockt_0" style="width:9% !important; display:inline !important" placeholder="Stock"  >
                                               
                                               
                                        
                                                <a href="javascript:void(0);" id="addMoreCostsPerWeightElement" data-val="moreWeights" Title="Add more"><i class="fa fa-plus-square fa-lg"></i></a>
                                                <a href="javascript:void(0);" id="removeCostsPerWeightElement" data-val="moreWeights" Title="Remove"><i class="fa fa-minus-square fa-lg"></i></a>
                                                <br/><br/>
                                                <input type="hidden" id="costPerWtCount" name="costPerWtCount" value="<?=$i?>">
                                                <div class='moreWeights' id="moreWeights"></div>  
                                                <br/>     
                                        </div>                              

                                           
                                        <!-- <div class="form-group">
                                            <label>Product Stock</label>
                                            <input type="number" min="0" class="form-control" name="productStock" value="<?=$productData->productStock?>" >   
                                        </div> -->

                                         <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" rows="3" name="productDescription"><?=$productData->productDescription?></textarea>
                                             <script type="text/javascript">
                                                 var editor = CKEDITOR.replace( 'productDescription', {
                                                    filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
                                                    filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
                                                    filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
                                                    filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                    filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                    filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                });
                                                CKFinder.setupCKEditor( editor, '../' );
                                            </script>   
                                        </div>
                                        <div class="form-group">
                                            <label>Search Keyword</label>
                                            <textarea class="form-control" rows="3" name="keywordSearch"><?=$productData->keywordSearch?></textarea>
                                        </div>

                                         <div class="form-group">
                                            <label>Product Photos</label><br/>
                                            <input type="file" name="productPhotos[]" accept="image/png, image/jpeg" onChange="document.getElementById('moreUploadsLink').style.display = 'block';" style="width:50% !important; display:inline !important"> 
                                             <!-- <a href="javascript:void(0)" id="addFileInput" title="Upload more photos"><i class="fa fa-plus-square fa-lg"></i></a> -->
                                             <div id="moreUploads"></div>                                           
                                             <input type="hidden" id="uploadsNeeded" name="uploadsNeeded" value="">
                                        </div>


                                            <?php foreach ($productPhotos as $productPhoto) { 

                                                  $productImageId = $productPhoto['id'];
                                                ?>
                                            <div class="row" id="row_<?=$productImageId?>">
                                                <img src="<?=APP_URL?>/productFiles/images/cart/<?=$productPhoto['image']?>" title="<?=$productData->productName?>">
                                                 <a href="javascript:void(0);" id="deleteProductPhoto" onclick="deleteProductPhoto('<?=$productImageId?>');" data-val="<?=$productImageId?>" Title="Delete Photo"><i class="fa fa-trash-o fa-lg"></i></a>
                                                <br>
                                            </div>
                                            <? } ?>

                                            <?//if(!empty($productIngredients)){?>
                                           <!--  <hr><h3>Ingredients</h3><hr>
                                            <?php foreach ($productIngredients as $productIngredient) { ?>
                                                    <div class="form-group">
                                                        <label>Ingredient Name</label>
                                                        <input type="text" maxlength="50" class="form-control" name="title[]" value="<?=$productIngredient['title']?>">
                                                    </div> 

                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="description[]" rows="3"><?=$productIngredient['description']?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Ingredient Photo</label><br/>
                                                        <img src="<?=APP_URL?>/ingredientFiles/images/thumb/<?=$productIngredient['image']?>" title="<?=$productIngredient['title']?>">
                                                    </div>
                                                <?}?> -->
                                             
                                               <!--  <div class="form-group">
                                                    <label>Ingredient Name</label>
                                                    <input type="text" maxlength="50" class="form-control" name="title[]">
                                                </div> 

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="3" name="description[]"></textarea>
                                                </div>
 -->
                                              <!--   <div class="form-group">
                                                    <label>Ingredient Photo</label><br/>
                                                    <input type="file" name="image[]" accept="image/png, image/jpeg" style="width:50% !important; display:inline !important">  -->
                                                   <!--   <a href="javascript:void(0);" id="addMoreIngredientsElement" data-val="moreIngredient" Title="Add more Ingredients"><i class="fa fa-plus-square fa-lg"></i></a>
                                                    <a href="javascript:void(0);" id="removeIngredientsElement" data-val="moreIngredient" Title="Remove Ingredients"><i class="fa fa-minus-square fa-lg"></i></a> -->
                                                <!-- </div> -->

                                                <!-- <div class='moreIngredient' id="moreIngredient"> </div>   -->

                                                

                                           <!--  <div class="form-group">
                                            <label>Product Type</label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="new" <? if($productData->productType=='new'){ ?> checked="" <? } ?>  name="productType"> New
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="backInStock" <? if($productData->productType=='backInStock'){ ?> checked="" <? } ?> name="productType" class="radio-inline"> Back In Stock
                                                </label>
                                            
                                            </div>  -->
                                     <!--    <div class="form-group">
                                            <label>Products Offers </label>
                                            <div class="productOffers" placeholder="Product Offers"></div>
                                            <input type="hidden" name="productOfferId" id="productOfferId" value="<?=trim($productData->productOfferId)?>" >
                                        </div>  

                                        <div class="form-group">
                                            <label>Special Offers?</label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="1" id="specialOffers" name="specialOffers" <?php if($productData->specialOffers==1){ ?> checked="checked" <? } ?> onchange="checkSploffer()" >Yes
                                                </label>                                            
                                        </div>
                                        <?php if($productData->categoryId =='1' || $productData->categoryId=='2'){?> 
                                        <div class="form-group">
                                            <label>Ultra Fresh?</label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="1" id="ultraFresh" name="ultraFresh" <?php if($productData->ultraFresh==1){ ?> checked="checked" <? } ?> >Yes
                                                </label>                                            
                                        </div>  
                                        <?php } ?>
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
                                            <label>Ramzan offer?</label>
                                                <label class="radio-inline">
                                                    <input type="radio" <? if($productData->ramzanOffer=='1'){ ?> checked="" <? } ?> value="1"  name="ramzanOffer"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="0"  <? if($productData->ramzanOffer=='0'){ ?> checked="" <? } ?>  name="ramzanOffer" class="radio-inline"> No
                                                </label>
                                            
                                        </div>  
                                        <div class="form-group">
                                            <label>Combo offer?</label>
                                                <label class="radio-inline">
                                                    <input type="radio" <? if($productData->comboOffer=='1'){ ?> checked="" <? } ?> value="1"  name="comboOffer"> Yes
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" value="0"  <? if($productData->comboOffer=='0'){ ?> checked="" <? } ?>  name="comboOffer" class="radio-inline"> No
                                                </label>
                                            
                                        </div> 
                                        <div class="form-group">
                                            <label>Recommended  Products?</label>
                                                <label class="radio-inline">
                                                    <input type="checkbox" value="1" <? if($productData->ad=='1'){ ?> checked="" <? } ?> name="ad"> Yes
                                                </label>
                                        </div>  -->

                                       <!--  <div class="form-group">
                                            <label>Product Type</label>
                                            <label class="radio-inline">
                                                <input type="checkbox" <?php if($productData->productType=='natureBalance'){ ?> checked="checked" <? } ?> value="natureBalance" name="productType"> Nature Balance
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" <? if($productData->productType=='ourTopSellers'){ ?> checked="" <? } ?> value="ourTopSellers" name="productType" class="radio-inline"> Our Top Sellers
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" <? if($productData->productType=='skinCarebundles'){ ?> checked="" <? } ?> value="skinCarebundles" name="productType" class="radio-inline"> Skin Care bundles
                                            </label>
                                        </div> 
 -->
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
            <link href="css/magicsuggest-min.css" rel="stylesheet">
            <script src="js/magicsuggest-min.js"></script> 
            <script type="text/javascript">
                $(function(){  
                 productOffersIds = '[<?=$productData->productOfferId?>]';   
                 var ms = $('.productOffers').magicSuggest({
                        data: 'get_productoffers.php',
                        maxSelection: null,
                        valueField: 'id',
                        displayField: 'name',
                        value: productOffersIds // select 'hello', 'world'
                    });
                  $(ms).on('selectionchange', function(){
                      $('#productOfferId').val(this.getValue());
                    });                   
                });
            </script>

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

    function getAllAttributes(){
        $db = new DB();
        // productAttributeId=1 for weight

        $query = "SELECT * FROM ".ATTRIBUTES." WHERE active ='1'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $attrValues[]=$row;
        }

        return $attrValues;
    }
    function attributesSelectValue(){
        $db = new DB();
        $attributes = $this->getAllAttributes();
        $costPerWtVal = $_REQUEST['costPerWtVal']+1;
       // ob_start();
         foreach($attributes as $attribute){ 
             $attributeValues = $db->get_results("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE attributeId = '".$attribute['id']."' AND active='1'");
            ?>
                <input type="hidden" name="attributeId[]" value="<?=$attribute['id']?>">
                <select class="form-control attrgroup_<?=$costPerWtVal?>" name="attributeValueId[<?=$attribute['id']?>][]" style="width:11% !important; display:inline-block !important">
                    <option value="">Select <?=$attribute['attributeName']?></option>
                    <? foreach($attributeValues as $attributeValue){ ?>
                       <option value="<?=$attributeValue['id']?>"><?=$attributeValue['attributeValue']?></option>
                    <? } ?>
                </select> 
        <?php        
        }         
       // $results = ob_get_contents();
       // return $results;
    }

    function unitsSelectValue(){
        $db = new DB();
        $query = "SELECT * FROM ".PRODUCT_ATTRIBUTE_VALUES." WHERE productAttributeId='1'";
        $weightUnits = $db->get_results( $query );        
         ?>
            <select class="form-control" name="productUnit[]" style="width:10% !important; display:inline !important" required >
                <option value="">-Unit-</option>
                <? foreach($weightUnits as $weightUnit){ ?>
                   <option value="<?=$weightUnit['attributeValue']?>"><?=$weightUnit['attributeValue']?></option>
                <? } ?>  
            </select>
   <?php  }
    function getProductUnitsValsByWeight(){
        $db = new DB();
        // productAttributeId=1 for weight
        $query = "SELECT * FROM ".PRODUCT_UNITS_VALUES." WHERE productUnitId='1'";
        $results = $db->get_results( $query );        
        foreach( $results as $row ){
            $attrValues[]=$row;
        }
        return $attrValues;
    }

    function saveNewProduct(){

        $db = new DB();
        if($db->filter($_POST['ad']) !='1'){
            $ad = 0;
        }else{
            $ad = 1;
        }
        // for now

        //$_POST['supplierId'] = 1;
        $prodOrdsql = "SELECT id FROM ".PRODUCTS."";
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
        $ultraFresh = (isset($_POST['ultraFresh']) && $_POST['ultraFresh']=='1')?'1':'0';
         
         if($_POST['brandId'] ==''){
            $data = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'sku' => $_POST['sku'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'productOfferId' => $db->filter($_POST['productOfferId']),
            'specialOffers' => $specialOffers,
            'ultraFresh' => $ultraFresh,
            'featuredProduct' => $featuredProduct,
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription']),
            'product_orders' => $newprd_orders,
            'ramzanOffer' => $db->filter($_POST['ramzanOffer']),
            'comboOffer' => $db->filter($_POST['comboOffer']),
            'keywordSearch' => $db->filter($_POST['keywordSearch']),
            'productType' => $db->filter($_POST['productType']),
            'ad' => $ad
            );
        }else{
        $data = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'brandId' => $_POST['brandId'],
            'sku' => $_POST['sku'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'productOfferId' => $db->filter($_POST['productOfferId']),
            'specialOffers' => $specialOffers,
            'ultraFresh' => $ultraFresh,
            'featuredProduct' => $featuredProduct,
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription']),
            'product_orders' => $newprd_orders,
            'ramzanOffer' => $db->filter($_POST['ramzanOffer']),
            'comboOffer' => $db->filter($_POST['comboOffer']),
            'keywordSearch' => $db->filter($_POST['keywordSearch']),
            'productType' => $db->filter($_POST['productType']),
            'ad' => $ad

            );
        }
      
        $rs = $db->insert(PRODUCTS, $data);

        $productId = $db->lastid();

        if($rs){

            $subs = get_all_substrings($db->filter($_POST['productName']), " ");
            file_put_contents("../keywords.txt", (serialize($subs)."<!-- E -->"), FILE_APPEND);
            
            $productWeight = $_POST['productWeight'];
            $productUnit   = $_POST['productUnit'];
            $productCost   = $_POST['productCost'];
            $productStock  = $_POST['productStock'];
            $productMRP   = $_POST['productMRP'];
            $expiryDate   = $_POST['expiryDate'];
            $productOffer   = $_POST['productOffer'];

            $i=0;
            $totalStock = 0;
            $productOptId = array();
            foreach($productCost as $productWt){

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
                    'dateTime' => $dateTime,
                    'productOffer' => $productOffer[$i]
                );

                $inserted = $db->insert(PRODUCT_OPTIONS, $records);
                $productOptId[] = $db->lastid();
                $totalStock += $productStock[$i];
                

                $i++;
            }
            $attributeValueId = $_POST['attributeValueId'];
            $k=0;
            foreach($attributeValueId as $key => $value){
                $j=0;
                $attributeId = $key;
                foreach ($productOptId as $productOptIds) {
                    $records = array(
                        'productId' => $productId,
                        'productOptionId' => $productOptId[$j],
                        'attributeId' => $attributeId,
                        'attributeValueId' => $attributeValueId[$attributeId][$j]
                    );
                    if($attributeValueId[$attributeId][$j] !=''){
                         $inserted = $db->insert(PRODUCT_ATTRIBUTES, $records);
                    }
                    

                 $j++;    
                }
              $k++; 
            }

            if($inserted){
                    $stockData = array(
                    'productStock' => $totalStock,
                    );
                    $where_clause_stock = array(
                        'id' => $productId
                    );
                    $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);

                    if(isset($uploadsNeeded)){

                        for($j = 0; $j < $uploadsNeeded; $j++){
                            
                            if(isset($file['productPhotos']['size'][$j]) && $file['productPhotos']['size'][$j] > 0){
                                
                                

                                $imagename = 'beauty-mineral_'.$date.'_'.$file['productPhotos']['name'][$j];
                                $imagename1 = SITE_URL."/productFiles/images/".$imagename; 
                                
                                $uploadedfile = $file['productPhotos']['tmp_name'][$j];

                                // pre($uploadedfile);
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
                                
                                $newwidth=400;
                                $newheight=400;
                                $tmp=imagecreatetruecolor($newwidth,$newheight);
                                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                $filename = "productFiles/images/thumb/".$imagename;
                                // pre($filename);
                                // exit;
                                imagejpeg($tmp,$filename,100);

                                $cartNewwidth=200;
                                $cartNewheight=200;
                                $tmp=imagecreatetruecolor($cartNewwidth,$cartNewheight);
                                imagecopyresampled($tmp,$src,0,0,0,0,$cartNewwidth,$cartNewheight,$width,$height);
                                $cartfilename = "productFiles/images/cart/".$imagename;
                                imagejpeg($tmp,$cartfilename,100);
                                
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

        //exit;
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
        if($db->filter($_POST['ad']) !='1'){
            $ad = 0;
        }else{
            $ad = 1;
        }
        // for now
       // $_POST['supplierId'] = 1;

        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());
        $checkTime  = date('Y-m-d', time());

        $data = $_POST;
        $file = $_FILES;
        $productId = $_POST['productId'];

        if($data['uploadsNeeded']==0 || $data['uploadsNeeded']==1){
            $uploadsNeeded = 2; 
        }else{
            $uploadsNeeded = $data['uploadsNeeded']; 
        }

        
        $date = date("shdmy");

        $specialOffers = (isset($_POST['specialOffers']) && $_POST['specialOffers']=='1')?'1':'0';
        $featuredProduct = (isset($_POST['featuredProduct']) && $_POST['featuredProduct']=='1')?'1':'0';
        $ultraFresh = (isset($_POST['ultraFresh']) && $_POST['ultraFresh']=='1')?'1':'0';
        if($_POST['brandId'] ==''){
             $updateData = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'sku' => $_POST['sku'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'productOfferId' => $db->filter($_POST['productOfferId']),
            'specialOffers' => $specialOffers,
            'ultraFresh' => $ultraFresh,
            'featuredProduct' => $featuredProduct,            
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription']),
            'ramzanOffer' => $db->filter($_POST['ramzanOffer']),
            'comboOffer' => $db->filter($_POST['comboOffer']),
            'keywordSearch' => $db->filter($_POST['keywordSearch']),
            'productType' => $db->filter($_POST['productType']),
            'ad' => $ad
            );
        }else{
           $updateData = array(
            'categoryId' => $_POST['categoryId'],
            'supplierId' => $_POST['supplierId'],
            'brandId' => $_POST['brandId'],
            'sku' => $_POST['sku'],
            'productName' => $db->filter($_POST['productName']),
            'productDescription' => $db->filter($_POST['productDescription']),
            'dateTime' => $dateTime,
            'productOfferId' => $db->filter($_POST['productOfferId']),
            'specialOffers' => $specialOffers,
            'ultraFresh' => $ultraFresh,
            'featuredProduct' => $featuredProduct,            
            'active' => $_POST['active'],
            'updatedBy' => $_SESSION['adminId'],
            'offersDescription' => $db->filter($_POST['offersDescription']),
            'ramzanOffer' => $db->filter($_POST['ramzanOffer']),
            'comboOffer' => $db->filter($_POST['comboOffer']),
            'keywordSearch' => $db->filter($_POST['keywordSearch']),
            'productType' => $db->filter($_POST['productType']),
            'ad' => $ad
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

            $inactiveData = array(
                'active' => '0'
            );
            $where_clause_inactive = array(
                'productId' => $productId
            );
            $db->update(PRODUCT_ATTRIBUTES, $inactiveData, $where_clause_inactive);


            $productWeight = $_POST['productWeight'];
            $productUnit = $_POST['productUnit'];
            $productCost   = $_POST['productCost'];
            $productStock   = $_POST['productStock'];
            $productMRP   = $_POST['productMRP'];
            $expiryDate   = $_POST['expiryDate'];
            $productOffer   = $_POST['productOffer'];
            $productDistributerPrice = $_POST['productDistributerPrice'];

            // pre($productCost);
            // exit;

           // $i=0;
            $totalStock = 0;
            $productOptId = array();
            for($i=0; $i<count($productCost); $i++){
                if($productCost[$i] !=''){
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
                    'productOffer' => $productOffer[$i],
                    'dateTime' => $dateTime,
                    'productDistributerPrice' => $productDistributerPrice[$i],
                    'lastCheckTime' => $checkTime
                );
                $totalStock +=$productStock[$i];
                $inserted = $db->insert(PRODUCT_OPTIONS, $records);
                $productOptId[] = $db->lastid();
                }
               // $i++;
            }
            $attributeValueId = $_POST['attributeValueId'];
            $k=0;
            foreach($attributeValueId as $key => $value){
                $j=0;
                $attributeId = $key;
                foreach ($productOptId as $productOptIds) {
                    $records = array(
                        'productId' => $productId,
                        'productOptionId' => $productOptId[$j],
                        'attributeId' => $attributeId,
                        'attributeValueId' => $attributeValueId[$attributeId][$j]
                    );
                    
                    if($attributeValueId[$attributeId][$j] !=''){
                         $inserted = $db->insert(PRODUCT_ATTRIBUTES, $records);
                    }
                 $j++;    
                }
              $k++; 
            }

            if($inserted){
                    
                
                    $stockData = array(
                    'productStock' => $totalStock,
                    );
                    $where_clause_stock = array(
                        'id' => $productId
                    );
                    $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
                    if(isset($uploadsNeeded)){

                        for($j = 0; $j < $uploadsNeeded; $j++){
                            
                            if(isset($file['productPhotos']['size'][$j]) && $file['productPhotos']['size'][$j] > 0){
                                
                                

                                $imagename = 'beauty-mineral_'.$date.'_'.$file['productPhotos']['name'][$j];
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
                                
                                $newwidth=400;
                                $newheight=400;
                                $tmp=imagecreatetruecolor($newwidth,$newheight);
                                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                $filename = "productFiles/images/thumb/".$imagename;
                                imagejpeg($tmp,$filename,100);

                                $cartNewwidth=200;
                                $cartNewheight=200;
                                $tmp=imagecreatetruecolor($cartNewwidth,$cartNewheight);
                                imagecopyresampled($tmp,$src,0,0,0,0,$cartNewwidth,$cartNewheight,$width,$height);
                                $cartfilename = "productFiles/images/cart/".$imagename;
                                imagejpeg($tmp,$cartfilename,100);
                                
                                move_uploaded_file($file['productPhotos']['tmp_name'][$j], "productFiles/images/".$imagename);


                                $imageData = array(
                                    'productId' => $productId
                                );

                                $db->delete(PRODUCT_IMAGES, $imageData);

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
        $this->updateChickenStatus();
        $this->updateMuttonStatus();
        $orders = $this->getAllOrderDetails();
        // pre($orders);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Orders</h1>
                </div>
               <!--  <div class="col-lg-12 text-right margin-bottom10">
                        <a href="<?=APP_URL?>/index.php?page=addNewOrder" title="Add new order" class="btn btn-primary">Add New Order</a>
                </div>     -->
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
                                            <th width="20%">Order status</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php $slno = 1;
                                            foreach ($orders as $order){

                                                // pre($order);
                                                $userOrdercount = $this->getUserOrderCount($order['userId']);
                                                $userOrderedChicken = $order['chicken'];
                                                $userOrderedMutton = $order['mutton'];
                                                 //$userOrderedChicken = $this->getUserOrderedChicken($order['id']);
                                                 //$userOrderedMutton = $this->getUserOrderedMutton($order['id']);
                                                ?>
                                        <tr class="odd gradeX <?php if($order['viewOrders']=='0'){ echo 'newOrderRow';}?>" >
                                            <td><?=$slno?><span class="orderSource">
                                                <?php if($order['source']=='web'){ 
                                                    //echo '<span class="fa fa-globe fa-lg" aria-hidden="true" title="Web"></span>';
                                                 }else if($order['source']=='android'){
                                                    echo '<span class="fa fa-android fa-lg" aria-hidden="true" title="Android"></span>';
                                                 }else if($order['source']=='ios'){
                                                   echo '<
                                                   span class="fa fa-apple fa-lg" aria-hidden="true" title="Ios"></span>'; 
                                                 }else if($order['source']=='windows'){
                                                   echo '<span class="fa fa-windows fa-lg" aria-hidden="true" title="windows"></span>'; 
                                                 } 
                                                 ?></span>
                                            </td>
                                            <td><?=$order['invoiceNumber']?></td>
                                            <td><?=$order['fullName']?></td>
                                            <td><?=$order['mobileNumber']?></td>
                                            <td <?php if($order['orderStatus'] == 'Confirmed'){ echo "class='confirmedOrder'"; } else if($order['orderStatus'] == 'Pending'){ echo "class='pendingOrder'"; } else if($order['orderStatus'] == 'Cancel'){ echo "class='cancelOrder'"; }else if($order['orderStatus'] == 'Delivered'){ echo "class='deliveredOrder'"; }?>><?php if($order['orderStatus'] == 'Cancel'){ echo "Canceled";}else{ echo $order['orderStatus']; }?>
                                                <?php if($order['supportComment'] !=''){?>
                                                <span class="supportCommentTooltip">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="<?=$order['supportComment']?>"><i class="fa fa-comments" aria-hidden="true"></i></a>
                                                </span>
                                                <script>
                                                $(document).ready(function(){
                                                    $('.supportCommentTooltip [data-toggle="tooltip"]').tooltip();
                                                });
                                                </script>
                                                <?php } ?>

                                            </td>
                                            <td><span class="paymentType"><?=$order['paymentType']?></span> <?php if($order['paymentType']=='Online'){?>- <?php  if($order['onlinePaymentStatus']=='Complete'){ echo 'Paid'; }else{ echo $order['onlinePaymentStatus']; } }?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=viewOrderDetail&orderId=<?=$order['id']?>" title="View Order Detail"><i class="fa fa-eye"></i></a>
                                                <!-- <a href="<?=APP_URL?>/index.php?page=editOrderDetail&orderId=<?=$order['id']?>&orderStatus=<?=$order['orderStatus']?>&prevPage=manageOrders" title="Edit Order Detail"><i class="fa fa-pencil-square-o"></i></a> -->
                                                <?php if($userOrdercount =='1'){?><i class="fa fa-th-list alert-success" title="New order"></i>&nbsp;<span class="alert-success" title="New order">(<?=$userOrdercount?>)</span><?php }else{ ?><a href="<?=APP_URL?>/index.php?page=manageUsersOrder&userId=<?=$order['userId']?>" title="See all orders"><i class="fa fa-th-list"></i></a>&nbsp;<span title="Save order">(<?=$userOrdercount?></span>)<?php } ?>
                                                <!-- <?php if($order['foundUsOn']!='NA'){?> <a href="#" title=<?=$order['foundUsOn']?> style="width:10px;height:10px;-webkit-border-radius: 99px;-moz-border-radius: 99px;border-radius: 99px;background-color:#E3A20B;padding:3px">#<?=substr($order['foundUsOn'], 0, 1); ?></a> <? } ?> -->
                                                <!-- <?php if($userOrderedChicken){ ?><a href="#" title="Chicken" style="width:10px;height:10px;-webkit-border-radius: 99px;-moz-border-radius: 99px;border-radius: 99px;background-color:#BD1212;color:#fff;padding:3px">#C</a><?php } ?> -->
                                                <!-- <?php if($userOrderedMutton){ ?><a href="#" title="Mutton" style="width:10px;height:10px;-webkit-border-radius: 99px;-moz-border-radius: 99px;border-radius: 99px;background-color:#BD1212;color:#fff;padding:3px">#M</a><?php } ?> -->
                                                <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#orderCommentModal<?=$order['id']?>" title="write comments"><i class="fa fa-commenting"></i></a> -->
                                                <!-- <?php if($order['giftOrder'] =='Yes'){?><a href="#" title="Gift Order"><i class="fa fa-lg fa-gift" aria-hidden="true" style="color:#BD1212;"></i></a><?php } ?> -->

                                                    <!-- Modal -->
                                                    <div id="orderCommentModal<?=$order['id']?>" class="modal fade" role="dialog">
                                                      <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Comments</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                            <div class="modalMsgContent">
                                                            </div>
                                                            <div class="modalFormContent">
                                                             <form action="" method="post" onsubmit="supportComment('<?=$order['id']?>');return false">
                                                                 <div class="form-group col-xs-12">
                                                                    <textarea class="form-control" style="width:100%;"  id="comment<?=$order['id']?>"  name="comment" placeholder="Comment" ><?=$order['supportComment']?></textarea>
                                                                  </div>
                                                                  <p>&nbsp;</p>
                                                                  <p class="text-right"><input type="submit" class="btn btn-primary" value="Submit"/></p>

                                                             </form>
                                                            </div>

                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>

                                                      </div>
                                                    </div>
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
                    iDisplayLength: 50,
                    "columnDefs": [
                                { "orderable": false}
                             ]
            });
            $('#dataTables-example').dataTable()
                  .columnFilter({
                    sPlaceHolder: "head:after",
                   aoColumns: [ 
                            null,
                            null,
                            null,
                            null,
                            { type: "select", values: [ 'Confirmed', 'Pending', 'Cancel', 'Shipped', 'Delivered']  },
                            null,
                            null 
                        ]

                });
            $('#dataTables-example thead .select_filter').click(function (evt) {
                   // alert('j');
                    evt.stopPropagation();
                });
            });
            
             function supportComment(orderId){
                var commentId = "comment"+orderId;
                 var comment = document.getElementById(commentId).value;
                $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=supportComment&orderId="+orderId+"&comment="+comment,
                        success: function(msg){ 
                         
                            if(msg == 'success'){
                                jQuery('#orderCommentModal'+orderId+' .modal-body .modalFormContent').css('display','none');
                                jQuery('#orderCommentModal'+orderId+' .modal-body .modalMsgContent').html('<p class="text-center">Comment has been saved successfully</p>');
                            }else if(msg == 'fails'){
                                jQuery('#orderCommentModal'+orderId+' .modal-body .modalMsgContent').html('<p class="text-center" style="color:#FE002D;">Error! Please try again.</p>');
                            }                                 
                        }
                    });
                   return false;
                }
            </script>


        <?
    }

    function supportComment(){
        $db = new DB();
        $data = array('supportComment' => $db->filter($_POST['comment']));
        
        $where_clause = array(
            'id' => $db->filter($_POST['orderId'])
        );
        $updated = $db->update(ORDER_DETAILS, $data, $where_clause, 1 );
        if($updated){
            echo "success";
        }else{
            echo "fails";
        }
    }
    function allOrders(){
        $db = new DB();

        $orders = $this->getTotalOrderDetails();
        // pre($orders);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Orders</h1>
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
                                            <th width="20%">Order status</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
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
             $('#dataTables-example').dataTable({
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "allOrderResponse.php",
                "iDisplayLength": 20,
                "columnDefs": [
                                { "orderable": false}
                             ],
                 "createdRow": function( row, data, dataIndex ) {
                if ( data[4] == "Pending" ) {
                    $(row).find('td:eq(4)').addClass( 'pendingOrder' );
                }else if(data[4] == "Confirmed" ){
                    $(row).find('td:eq(4)').addClass( 'confirmedOrder' );
                }else if(data[4] == "Canceled" ){
                    $(row).find('td:eq(4)').addClass( 'cancelOrder' );
                }else if(data[4] == "Delivered" ){
                    $(row).find('td:eq(4)').addClass( 'deliveredOrder' );
                }
              }
            });    
            $('#dataTables-example').dataTable()
                  .columnFilter({
                    sPlaceHolder: "head:after",
                   aoColumns: [ 
                            null,
                            null,
                            null,
                            null,
                            { type: "select", values: [ 'Confirmed', 'Pending', 'Cancel', 'Shipped', 'Delivered'] },
                            null,
                            null
                        ]

                }); 
            $('#dataTables-example thead .select_filter').click(function (evt) {
                   // alert('j');
                    evt.stopPropagation();
                });
            });
            
             function supportComment(orderId){
                var commentId = "comment"+orderId;
                 var comment = document.getElementById(commentId).value;
                $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=supportComment&orderId="+orderId+"&comment="+comment,
                        success: function(msg){ 
                         
                            if(msg == 'success'){
                                jQuery('#orderCommentModal'+orderId+' .modal-body .modalFormContent').css('display','none');
                                jQuery('#orderCommentModal'+orderId+' .modal-body .modalMsgContent').html('<p class="text-center">Comment has been saved successfully</p>');
                            }else if(msg == 'fails'){
                                jQuery('#orderCommentModal'+orderId+' .modal-body .modalMsgContent').html('<p class="text-center" style="color:#FE002D;">Error! Please try again.</p>');
                            }                                 
                        }
                    });
                   return false;
                }
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
                                            <th>Date time</th>
                                            <th>Order status</th>
                                            <th>Payment status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php $slno = 1;
                                            foreach ($orders as $order){?>
                                        <tr class="odd gradeX <?php if($order['viewOrders']=='0'){ echo 'newOrderRow';}?>" >
                                            <td><?=$slno?><span class="orderSource">
                                                <?php if($order['source']=='web'){ 
                                                    //echo '<span class="fa fa-globe fa-lg" aria-hidden="true" title="Web"></span>';
                                                 }else if($order['source']=='android'){
                                                    echo '<span class="fa fa-android fa-lg" aria-hidden="true" title="Android"></span>';
                                                 }else if($order['source']=='ios'){
                                                   echo '<span class="fa fa-apple fa-lg" aria-hidden="true" title="Ios"></span>'; 
                                                 }else if($order['source']=='windows'){
                                                   echo '<span class="fa fa-windows fa-lg" aria-hidden="true" title="windows"></span>'; 
                                                 } 
                                                 ?></span></td>
                                            <td><?=$order['invoiceNumber']?></td>
                                            <td><?=$order['fullName']?></td>
                                            <td><?=$order['mobileNumber']?></td>
                                            <td><?=stdDateFormat($order['dateTime'])?></td>
                                            <td><?=$order['orderStatus']?></td>
                                            <td><span class="paymentType"><?=$order['paymentType']?></span> <?php if($order['paymentType']=='Online'){?>- <?php  if($order['onlinePaymentStatus']=='Complete'){ echo 'Paid'; }else{ echo $order['onlinePaymentStatus']; } }?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=viewOrderDetail&orderId=<?=$order['id']?>" title="View Order Detail"><i class="fa fa-eye"></i></a>
                                                <!-- <a href="<?=APP_URL?>/index.php?page=editOrderDetail&orderId=<?=$order['id']?>&orderStatus=<?=$order['orderStatus']?>&prevPage=manageOrders" title="Edit Order Detail"><i class="fa fa-pencil-square-o"></i></a> -->
                                                
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

                                     <?php foreach ($usersData as $users){
                                        $orderedEnquires = $db->get_results("SELECT id FROM ".ENQUIRED_USERS." WHERE mobileNumber = '".$users['mobileNumber']."'",true);
                                        if(count($orderedEnquires) > 0){
                                            foreach ($orderedEnquires as $orderedEnquire){
                                                $delete = array(
                                                    'id' => $orderedEnquire->id
                                                );
                                                $deleted = $db->delete(ENQUIRED_USERS, $delete);
                                            }
                                        }    
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$users['fullName']?></td>
                                            <td><?=$users['mobileNumber']?></td>
                                            <td><?=$users['email']?></td>
                                            <td><?=stdDateFormat($users['dateTime'])?></td>
                                            <!-- <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editCustomer&id=<?=$users['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
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

  function manageEnquiredUser(){

        $db = new DB();

        $usersData = $this->getAllEnquiredUsers();

        // pre($orders);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enquired Users</h1>
                </div>
                <div class="col-lg-12 text-right margin-bottom10">
                        <a href="<?=APP_URL?>/index.php?page=addNewEnquire" title="Add new Enquired user" class="btn btn-primary">Add Enquired User</a>
                </div> 
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Enquired Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile No</th>
                                            <th>Date time</th>
                                            <th>Comment</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 
                                     if(count($usersData)>0){
                                     foreach ($usersData as $users){
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$users['fullName']?></td>
                                            <td><?=$users['mobileNumber']?></td>
                                            <td><?=stdDateFormat($users['dateTime'])?></td>
                                            <td><?=substr($users['comment'],0,50)?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editEnquiredUser&id=<?=$users['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
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
                                { "orderable": false}
                             ]
            });
            });
            </script>


        <?
    }
     function addNewEnquire(){

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enquired users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Enquire
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveEnquiredUser" /> 
                                       
                                       <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" class="form-control" pattern=".{10,}" name="mobileNumber" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Full name</label>
                                            <input type="text" class="form-control" name="fullName" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" >                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <textarea class="form-control" name="comment" rows="3" ></textarea>                                            
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



    function saveEnquiredUser(){
        $db = new DB();
        $userNoExits = $db->get_row("SELECT id FROM ".USERS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."'",true);
        $enquireNoExits = $db->get_row("SELECT id FROM ".ENQUIRED_USERS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."'",true);
        if($userNoExits || $enquireNoExits){
            return 'phonenoExits';
            exit;
        }
        $dateTime  = date('Y-m-d H:i:s', time());
        $data = array(
            'mobileNumber' => $db->filter($_POST['mobileNumber']),
            'fullName' => $db->filter($_POST['fullName']),
            'email' => $db->filter($_POST['email']),
            'comment' => $db->filter($_POST['comment']),
            'dateTime' =>$dateTime
            
        );

        $rs = $db->insert(ENQUIRED_USERS, $data);

        if($rs){
            return true;
        }else{
            return false;
        }

    }

    function editEnquiredUser(){
        $db = new DB();

        $query = "SELECT * FROM ".ENQUIRED_USERS." WHERE id = '".$_REQUEST['id']."'";
        $enquiredUser = $db->get_row( $query, true );

     ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enquired user</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update User
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateEnquiredUser" />      
                                         <input type="hidden" name="id" value="<?=$enquiredUser->id?>" /> 
                                       
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" class="form-control" pattern=".{10,}" value="<?=$enquiredUser->mobileNumber?>" name="mobileNumber" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Full name</label>
                                            <input type="text" class="form-control" name="fullName" value="<?=$enquiredUser->fullName?>" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?=$enquiredUser->email?>" >                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <textarea class="form-control" name="comment" rows="3" ><?=$enquiredUser->comment?></textarea>                                            
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


   function updateEnquiredUser(){
        $db = new DB();

       $userNoExits = $db->get_row("SELECT id FROM ".USERS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."'",true);
        $enquireNoExits = $db->get_row("SELECT id FROM ".ENQUIRED_USERS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."' AND id!='".$_REQUEST['id']."'",true);
        if($userNoExits || $enquireNoExits){
            return 'phonenoExits';
            exit;
        }
        $update = array(
            'mobileNumber' => $db->filter($_POST['mobileNumber']),
            'fullName' => $db->filter($_POST['fullName']),
            'email' => $db->filter($_POST['email']),
            'comment' => $db->filter($_POST['comment'])
            
        );

        $where_clause = array(
            'id' => $_REQUEST['id']
        );

        $updated = $db->update(ENQUIRED_USERS, $update, $where_clause, 1 );

        if($updated){
            return true;
        }else{
            return false;
        }

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
                                        <p >Sub Total : <input type="text" name="subtotal" id="subtotal" class="form-control" required  readonly/></p>
                                        <p >Delivery Charges : <input type="text" name="deliverycharge" id="deliverycharge" class="form-control" required  readonly/></p>
                                        <p >Grand Total : <input type="text" name="grandTotal" id="grandTotal" class="form-control" required readonly/></p>
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
                        data: 'get_productnames.php',
                        allowFreeEntries: false

                    });
                  var ord_unit = $('.magicsuggest1').magicSuggest({
                        data: 'get_productunits.php',
                        allowFreeEntries: false
                       

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
                    getGrandtotal();
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
                    getGrandtotal();
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
           $prd_options = $db->get_row("SELECT product_options.id,productCost,productOffer FROM ".PRODUCT_OPTIONS." INNER JOIN product_attribute_values on (product_attribute_values.attributeValue = product_options.productUnit) WHERE productId = '".$productid."' AND productWeight = '".$orderweight."' AND product_attribute_values.id = '".$orderUnit."' AND product_options.active = '1'",true);
         }else{
            $prd_options = $db->get_row("SELECT product_options.id,productCost,productOffer FROM ".PRODUCT_OPTIONS." WHERE productId = '".$productid."' AND productWeight = '".$orderweight."' AND productUnit = '".$orderUnit."' AND product_options.active = '1'",true);
         }
       // echo "SELECT product_options.id,productCost FROM ".PRODUCT_OPTIONS." INNER JOIN product_attribute_values on (product_attribute_values.attributeValue = product_options.productUnit) WHERE productId = '".$productid."' AND productWeight = '".$orderweight."' AND product_attribute_values.id = '".$orderUnit."' AND product_options.active = '1'";
        if((isset($prd_options->productOffer)) && ($prd_options->productOffer!='') && ($prd_options->productOffer > 0) && (count($prd_options->productOffer)>0)){
            $offerPrice = round(($prd_options->productOffer*$prd_options->productCost)/100);
            if($offerPrice < 1){
                $offerPrice = 1;
            }
            $prd_options->productCost = $prd_options->productCost - $offerPrice;
        }
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
        if($totalAmount <= 0){
            return 'invalidTotal';
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
        $offerAmt = $db->filter($_POST['offerAmt']);
        $totalAmount = $grandTotal;
        if($totalAmount <= 0){
            return 'invalidTotal';
            exit;
        }
        // $mobileNumber = $db->filter($_POST['userPhone']);
        // $userdetails = $db->get_row("SELECT id FROM ".USERS." WHERE mobileNumber = '".$mobileNumber."' ",true);
        // if($userdetails){
        //     $userId = $userdetails->id;
        // }else{
        //     $password = $db->filter(randomPassword());
        //     $userdata = array(
        //         'fullName' => $db->filter($_POST['userName']),
        //         'email' => $db->filter($_POST['userEmail']),
        //         'mobileNumber' => $mobileNumber,
        //         'address' => $db->filter($_POST['shippingAddress']),
        //         'dateTime' => $dateTime,
        //         'password' => $password,
        //         'active' => '1'
        //     );
        //     $db->insert(USERS, $userdata);
        //     $userId = $db->lastid();
        // }

        $update = array(
            'fullName' => $db->filter($_POST['userName']),
            'email' => $db->filter($_POST['userEmail']),
            // 'mobileNumber' => $mobileNumber,
            'address' => $db->filter($_POST['shippingAddress']),
            'updatedtime' => $dateTime,
            'subTotal' => $subtotal,
            'orderStatus' => 'Pending',
            'deliveryCost' => $deliveryCost,
            'totalAmount' => $totalAmount,
            'offerAmt' => $offerAmt,
            'invoiceNo' => $db->filter($_POST['invoiceNo']),
            'updatedBy' => $_SESSION['adminId'],
            'note' => $db->filter($_POST['note']),
            'supportComment' => $db->filter($_POST['supportComment'])
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

    function applyOfferFromViewOrders(){
        $db = new DB();
        $orderId = $_POST['orderId'];
        $userType = $_POST['userType'];
        $subTotal = $_POST['subTotal'];
        $grandTotal = $_POST['totalPay'];
        if($userType == 'Business'){
                
                $offerTotal = round(( BUSINESS_OFFER_PERCENT / 100) * $subTotal);
                if($offerTotal < 1){
                    $offerTotal = 1;
                }
                $totalPay = $grandTotal - $offerTotal;
                if($totalPay < 0){
                    $totalPay = 0;
                }
                $updateOrderDetails = array(
                    'offerAmt' => $offerTotal
                );
                $where_clause = array(
                    'id' => $orderId
                );
               $rs = $db->update(ORDER_DETAILS, $updateOrderDetails, $where_clause, 1); 
               echo "{\"offer\":\" <p style='margin:0;text-align:right;color:#5b5b5b;font-size:14px;'>Discount &#36;".number_format($offerTotal,2)."</p>\",\"totalpay\":\" &#36; ".number_format($totalPay,2)."\"}"; 
        }else{
                $offerTotal = round(( OFFER_PERCENT / 100) * $subTotal);
                if($offerTotal < 1){
                    $offerTotal = 1;
                }
                $totalPay = $grandTotal - $offerTotal;
                if($totalPay < 0){
                    $totalPay = 0;
                }
                $updateOrderDetails = array(
                    'offerAmt' => $offerTotal
                );
                $where_clause = array(
                    'id' => $orderId
                );
               $rs = $db->update(ORDER_DETAILS, $updateOrderDetails, $where_clause, 1);
               echo "{\"offer\":\" <p style='margin:0;text-align:right;color:#5b5b5b;font-size:14px;'>Discount &#36;".number_format($offerTotal,2)."</p>\",\"totalpay\":\" &#36; ".number_format($totalPay,2)."\"}";
        }

    }
    function viewOrderDetail($orderId){

        $db = new DB();
        $netProfitCatids = explode(',', netProfitCatids);
        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, address,shippingId,billingId, address_shipping, note, subTotal, deliveryCost, totalAmount, orderStatus, dateTime,invoiceNo,paymentType,onlinePaymentStatus,netProfit,offerAmt,foundUsOn,couponDiscount,senderfullName,sendermobileNumber,giftMessage,giftOrder FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
// pre($orderDetails);
        $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->shippingId."' ",true);
        // pre($shippingDetail);
        $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->billingId."' ",true);
      
        $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");
        $appliedCouponCode = $db->get_row("SELECT couponCode FROM ".COUPON_USERS." WHERE orderId='".$orderId."'",true);
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
                var totalNetProfit = $('#totalNetProfit').val();
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
                            data:{ action:'changeOrderStatus',status:status,orderId:orderId,totalNetProfit:totalNetProfit},  
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

            function foundUsOn(orderId,foundOn){

                   $.ajax
                        ({
                            type: "POST",
                            url: "index.php",
                            data:{ action:'foundUsOn',foundUsOn:foundOn,orderId:orderId},  
                            success: function(msg)
                            {                                          
                                // alert(msg);
                                 //alert(status);
                                 //$("#orderStatusOpt").find('option').removeAttr("selected");
                                
                                if(msg==1){
                                    $('.rsSure').css('display','block');
                                    $('.rsSure').html("UPDATED: Found us on "+foundOn);
                                    setTimeout(function(){ $('.rsSure').css('display','none');}, 1500);
                                }else{
                                    $('.rsSure').html("ERROR UPDATING!");
                                }
                               
                                // confirm("Status Change to  "+status)
        
                            }
                        });

            }

           function applyOfferFromViewOrders(orderId,userType,subTotal,totalPay){
                if(confirm("Are you sure you want to apply offer?")){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            dataType: 'json',
                            data: "action=applyOfferFromViewOrders&orderId="+orderId+"&userType="+userType+"&subTotal="+subTotal+"&totalPay="+totalPay,
                            success: function(data){   
                                $('.applyOfferBtnWrapper').css('display','none');
                                $('#discountAmt').html(data.offer);
                                $('#totalPayable').html(data.totalpay);                                                          
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
                        <!-- <a href="<?=APP_URL?>/index.php?page=editOrderDetail&orderId=<?=$orderId?>&orderStatus=<?=$orderDetails->orderStatus?>&prevPage=viewOrderDetail" title="Edit Order Detail" class="btn btn-primary">Edit</a> -->
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
                                <span>&nbsp;&nbsp;</span>
                                <!--  <span style="float:right">
                                    <label>Found us on: </label>&nbsp;
                                    
                                    <select name="foundUsOn" onchange="foundUsOn('<?=$orderDetails->id?>',this.value)">
                                        <option value="NA" <?=($orderDetails->foundUsOn=='NA')?'selected=selected':''?>>NA</option>
                                        <option value="Pamphlet" <?=($orderDetails->foundUsOn=='Pamphlet')?'selected=selected':''?>>Pamphlet</option>
                                        <option value="Email" <?=($orderDetails->foundUsOn=='Email')?'selected=selected':''?>>Email</option>
                                        <option value="Newspaper" <?=($orderDetails->foundUsOn=='Newspaper')?'selected=selected':''?>>Newspaper</option>
                                        <option value="Banner" <?=($orderDetails->foundUsOn=='Banner')?'selected=selected':''?>>Banner</option>
                                        <option value="Google" <?=($orderDetails->foundUsOn=='Google')?'selected=selected':''?>>Google</option>
                                        <option value="Facebook" <?=($orderDetails->foundUsOn=='Facebook')?'selected=selected':''?>>Facebook</option>
                                        <option value="Reference" <?=($orderDetails->foundUsOn=='Reference')?'selected=selected':''?>>Reference</option>
                                        <option value="TV" <?=($orderDetails->foundUsOn=='TV')?'selected=selected':''?>>TV</option>
                                        <option value="Vehicle" <?=($orderDetails->foundUsOn=='Vehicle')?'selected=selected':''?>>Vehicle</option>
                                        <option value="Other" <?=($orderDetails->foundUsOn=='Other')?'selected=selected':''?>>Other</option>
                                    </select>
                                   
                                </span> -->
                            <!-- </form> -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                       <div class="col-md-12 paymentSteps">

    <table cellspacing="0" cellpadding="0" style="width:900px;margin:0 auto;padding:20px;background-color:#F3F3F3;">
   
    <tr style="font-family:arial;background-color:#ffffff;">
        <td colspan="3" style="padding:0 15px;">
            <div style="margin-bottom:15px;">
                <h2 style="margin-bottom: 0px;padding-bottom: 0px;font-weight:normal;font-size:20px;color:#00A1E2;">
                    
                    <div style="margin:0;float:right;color:#000000;">
                         <p><span style="color:#00A1E2;">Invoice No :</span> <?=$orderDetails->invoiceNumber?></p>
                        <?php if($orderDetails->paymentType == 'Online'){?>
                        <p><span style="color:#00A1E2;">Payment :</span> <?php if($orderDetails->onlinePaymentStatus=='Complete'){ echo 'Paid'; }else{ echo $orderDetails->onlinePaymentStatus; } ?></p>
                        <?php } ?>
                        <?php if($appliedCouponCode->couponCode != ''){?>
                        <p><span style="color:#00A1E2;">Coupon Code :</span> <?php echo $appliedCouponCode->couponCode; ?></p>
                        <?php } ?>

                    </div>    
                </h2>
                <?php if($orderDetails->giftOrder=='Yes'){ ?>
                <h4 style="margin-bottom: 0px;padding-bottom: 0px;font-weight:600;font-size:14px;color:#ED9E2E;">Recipient's Details:</h4> 
                <p style="margin:0;"><?=$orderDetails->fullName?></p>
                <p style="margin:0;"><?=$orderDetails->mobileNumber?></p>
                <p style="margin:0;"><?=$orderDetails->email?></p>
                <p style="margin:0;"><?=$orderDetails->address_shipping?></p>
                <p style="margin:0;">Message : <?=$orderDetails->giftMessage?></p>
                <h4 style="margin-bottom: 0px;padding-bottom: 0px;font-weight:600;font-size:14px;color:#ED9E2E;">Sender Details:</h4>                
                <p style="margin:0;"><?=$orderDetails->senderfullName?></p>
                <p style="margin:0;"><?=$orderDetails->sendermobileNumber?></p>
                <p style="margin:0;">Note : <?=$orderDetails->note?></p>
                <p style="margin:0;"><?=stdDateFormat($orderDetails->dateTime)?></p>    
                <?php }else{?>
                <div style="float:left;padding-right:20px;padding-bottom:15px;">
                    <h2 style="margin-bottom: 5px;padding-bottom: 5px;font-weight:normal;font-size:20px;color:#00A1E2;">
                        Shipping Address  </h2>
                    <p style="margin:0;"><?=$shippingDetail->first_name?> <?=$shippingDetail->last_name?></p>
                    <p style="margin:0;"><?=$shippingDetail->phone?></p>
                    <p style="margin:0;"><?=$orderDetails->email?></p>
                    <p style="margin:0;"><?=$shippingDetail->address_1?>,<br> <?=$shippingDetail->address_2?>,<br> <?=$shippingDetail->landmark?><br><?=$shippingDetail->city?> <?=$shippingDetail->pincode?><br><?=$shippingDetail->state?> <?=$shippingDetail->country?></p>
                    <!-- <p style="margin:0;"><?=$orderDetails->note?></p> -->
                    <p style="margin:0;"><?=stdDateFormat($orderDetails->dateTime)?></p> 
                </div>
                <?php } ?>
                <div style="float:left;padding-right:20px;padding-bottom:15px;">
                     <h2 style="margin-bottom: 5px;padding-bottom: 5px;font-weight:normal;font-size:20px;color:#00A1E2;">
                        Billing Address </h2>
                         <p style="margin:0;"><?=$billingDetail->first_name?> <?=$billingDetail->last_name?></p>
                    <p style="margin:0;"><?=$billingDetail->phone?></p>
                    <p style="margin:0;"><?=$orderDetails->email?></p>
                    <p style="margin:0;"><?=$billingDetail->address_1?>,<br> <?=$billingDetail->address_2?>,<br> <?=$billingDetail->landmark?><br><?=$billingDetail->city?> <?=$billingDetail->pincode?><br><?=$billingDetail->state?> <?=$billingDetail->country?></p>
                    <!-- <p style="margin:0;"><?=$orderDetails->note?></p> -->
                    <p style="margin:0;"><?=stdDateFormat($orderDetails->dateTime)?></p> 
                </div>
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
                        $unitProfit = 0;
                        $distributerPrice = 0;
                        // $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                        //                               WHERE id='".$record['productId']."'", true);

                        $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                                      WHERE productId='".$record['productId']."'", true);
                        $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productDistributerPrice FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                        $productCategoryId = $db->get_row("SELECT categoryId,productDescription FROM ".PRODUCTS." 
                                                      WHERE id='".$record['productId']."'", true);

                        $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                                    $attrValueSet='';   
                                        foreach ($productAttrubutes as $productAttrubute) {
                                            $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                            if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                                        }
                        // pre($productOption);
                        $productTotal = $record['quantity']*$record['unitPrice'];
                        $totalItems+= $record['quantity'];
                        $subTotal+=$productTotal;
                       
                        if (!in_array($productCategoryId->categoryId, $netProfitCatids)) {
                            if(isset($productOption->productDistributerPrice) && ($productOption->productDistributerPrice !='') && ($productOption->productDistributerPrice > 0)){
                                $distributerPrice = $record['quantity']*$productOption->productDistributerPrice;
                                $unitProfit = $productTotal - $distributerPrice;
                                $netProfit +=$unitProfit;
                            }    
                        }
                ?>
                <tr>
                    <td style="padding:5px;border-color:#e5e5e5;">
                        <? if(isset($productImageData->image) && $productImageData->image!=''){ ?> 
                            <img src="productFiles/images/cart/<?=$productImageData->image?>"  title="Beauty-Mineral - <?=$record['productName']?>" alt="Beauty-Mineral - Health & Beauty from the Dead Sea">
                        <? }else{ ?>

                            <img src="productFiles/images/cart/defaultsmall.png" style="witdh:150px;height:150px;" class="center-block" title="Beauty-Mineral - Health & Beauty from the Dead Sea" alt="Beauty-Mineral - Health & Beauty from the Dead Sea">
            
                        <? } ?>
                    </td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productName']?> <?php if($attrValueSet !=''){ echo '<br/>('.rtrim($attrValueSet,',').')'; } ?> <?php if($productCategoryId->categoryId == '65'){ echo " - ".$productCategoryId->productDescription; } ?><br/><?=$record['timeslotVal']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['quantity']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($record['unitPrice'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($productTotal,2)?></td>
                </tr>
                <?}?>
                           
            </table>
            <?php if($subTotal != $orderDetails->subTotal) { ?>
            <div class="subTotalMismatch">Sub total mistmatch! Please verify Product sub total : <b>&#36;<?=number_format($subTotal, 2)?> </b> and Order sub total : <b>&#36; <?=number_format($orderDetails->subTotal, 2)?></b></div>
            <?php } ?>
            <p style="margin:10px 0 0 0;text-align:right;color:#5b5b5b;font-size:14px;">Sub Total : &#36; <?=number_format($orderDetails->subTotal, 2)?></p>
            <p style="margin:0;text-align:right;color:#5b5b5b;font-size:14px;">Shipping : &#36; <?=number_format($orderDetails->deliveryCost, 2)?></p>
            <?php $totalPay = $orderDetails->totalAmount; ?>
            <?php if($orderDetails->couponDiscount > 0){?>
            <p style="margin:0;text-align:right;color:#5b5b5b;font-size:14px;">Coupon Discount : &#36; <?=number_format($orderDetails->couponDiscount,2)?></p>
            <?php 
            $totalPay = $totalPay  - $orderDetails->couponDiscount;

            } ?>
            <?php if($orderDetails->offerAmt > 0){?>
            <p style="margin:0;text-align:right;color:#5b5b5b;font-size:14px;">Discount : &#36; <?=number_format($orderDetails->offerAmt,2)?></p>
            <?php 
            $totalPay = $totalPay - $orderDetails->offerAmt;
            } ?>
            <?php if($totalPay < 0){
                $totalPay = 0;
            } ?>
            <span id="discountAmt"></span>
            <p style="margin:5px 0 10px 0;text-align:right;font-size:20px;font-weight:normal;">Total Payable : <span id="totalPayable"> &#36; <?=number_format($totalPay, 2)?></span></p>
            <div class="applyOfferBtnWrapper text-right">
            <?php 
              if($orderDetails->offerAmt <= 0){
                if($orderDetails->couponDiscount  <= 0){
                    $registeredUsers = $db->get_row("SELECT userType FROM ".REGISTERED_USER." WHERE userId='".$orderDetails->userId."'",true);
                    $userType = $registeredUsers->userType;
                    if($userType == 'Business'){ ?>
                        <!-- <a href="javascript:void(0);" class="btn btn-primary" onclick="applyOfferFromViewOrders(<?=$orderId?>,'Business','<?=$orderDetails->subTotal?>','<?=$totalPay?>');">Apply offer</a> -->
                    <?php
                    }else{
                        $numberCount =  $db->num_rows( "SELECT id FROM ".ORDER_DETAILS." WHERE mobileNumber = '".$orderDetails->mobileNumber."' AND orderStatus !='Pending' AND orderStatus !='Cancel'");
                        if($numberCount == 0){ ?>
                        <!-- <a href="javascript:void(0);" class="btn btn-primary" onclick="applyOfferFromViewOrders(<?=$orderId?>,'Client','<?=$orderDetails->subTotal?>','<?=$totalPay?>');">Apply offer</a> -->
                        <?php }
                    }
                }
            }
            ?>
        </div>
        </td>
    </tr>
    <!-- <tr style="font-family:arial;background-color:#ffffff;">
                <td colspan="3" style="padding:0 15px;">
                    <?php if($orderDetails->netProfit == ''){ $totalNetProfit = $netProfit; }else{ $totalNetProfit = $orderDetails->netProfit; }?>
                  <p style="margin:5px 0 10px 0;text-align:left;font-size:20px;font-weight:normal;">Net Profit: &#36; <?=number_format($totalNetProfit, 2)?> </p>(exculding fruits & vegetables)
                    <input type="hidden" id="totalNetProfit" value="<?=$totalNetProfit?>"> 
                </td>
     </tr> -->
    
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

    function foundUsOn($orderId){
        $db = new DB();

        $update = array(
            'foundUsOn' => $_REQUEST['foundUsOn']
        );

        $where_clause = array(
            'id' => $orderId
        );

        $updated = $db->update(ORDER_DETAILS, $update, $where_clause, 1 );

        if($updated){
            echo '1';
        }else{
            echo '0';
        }

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
            $netProfitData = array(
                'netProfit' => $db->filter($_REQUEST['totalNetProfit']),
            );
            $where_clause_netprofit = array(
                'id' => $orderId
            );
            $profitUpdate = $db->update(ORDER_DETAILS, $netProfitData, $where_clause_netprofit);
          date_default_timezone_set("Asia/Calcutta");
          $stockEmptydateTime  = date('Y-m-d H:i:s', time());
          foreach($item_records as $item_record){  
                $productOption = $db->get_row("SELECT product_options.id, productStock,productId,negativeStock FROM ".PRODUCT_OPTIONS." WHERE product_options.id='".$item_record['productOptionId']."'", true);
                // pre($productOption);
                $old_stockqty = $productOption->productStock;
                $negativeStock = $productOption->negativeStock;
                $itemqty = $item_record['quantity'];
                $newStock = $old_stockqty - $itemqty;
                if($newStock > 0){
                    $newStock = $newStock;
                    $newNegativeStock = 0;
                    
                }else{
                    $newNegativeStock = abs($newStock) + $negativeStock;
                    $newStock = 0;
                    $dateTime = $stockEmptydateTime;
                    $updateStock = array(
                       'stockEmptydate' => $dateTime
                    );
                    $where_stockclause = array(
                        'id' => $item_record['productOptionId']
                     );
                    $updated = $db->update(PRODUCT_OPTIONS, $updateStock, $where_stockclause, 1 );
                }
                $updateStock = array(
                    'productStock' => $newStock,
                    'negativeStock'=> $newNegativeStock
                );
                $where_stockclause = array(
                    'id' => $item_record['productOptionId']
                 );
                $updated = $db->update(PRODUCT_OPTIONS, $updateStock, $where_stockclause, 1 );
                if($updated){
                    $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productOption->productId."' AND active='1'";
                    $productStocks = $db->get_results($query);
                    $totalStock = 0;
                    foreach($productStocks as $productStock){
                        $totalStock += $productStock['productStock'];
                    }
                    $stockData = array(
                        'productStock' => $totalStock,
                    );
                    $where_clause_stock = array(
                        'id' => $productOption->productId
                    );
                    $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
                }
            }    
                
        }
        if($_REQUEST['status'] == 'Cancel'){
          $item_records = $db->get_results("SELECT productOptionId,quantity FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");  
       
          foreach($item_records as $item_record){  
                $productOption = $db->get_row("SELECT product_options.id, productStock,productId,negativeStock FROM ".PRODUCT_OPTIONS." WHERE product_options.id='".$item_record['productOptionId']."'", true);
                // pre($productOption);
                $old_stockqty = $productOption->productStock;
                $negativeStock = $productOption->negativeStock;
                $itemqty = $item_record['quantity'];
                $newStock = $old_stockqty + $itemqty;
                $newStock = $newStock - $negativeStock;
                if($newStock > 0){
                    $newStock = $newStock;
                    $newNegativeStock = 0;
                }else{
                    $newNegativeStock = abs($newStock);
                    $newStock = 0;
                }
                $updateStock = array(
                    'productStock' => $newStock,
                    'negativeStock'=> $newNegativeStock
                );
                $where_stockclause = array(
                    'id' => $item_record['productOptionId']
                 );
                $updated = $db->update(PRODUCT_OPTIONS, $updateStock, $where_stockclause, 1 );
                if($updated){
                    $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productOption->productId."' AND active='1'";
                    $productStocks = $db->get_results($query);
                    $totalStock = 0;
                    foreach($productStocks as $productStock){
                        $totalStock += $productStock['productStock'];
                    }
                    $stockData = array(
                        'productStock' => $totalStock,
                    );
                    $where_clause_stock = array(
                        'id' => $productOption->productId
                    );
                    $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
                }
            }    
                
        }
        date_default_timezone_set("Asia/Calcutta");
        
        if($_REQUEST['status'] == 'Delivered'){
           $deliveryDate  = date('Y-m-d', time());
        }else{
           $deliveryDate  = NULL;
        }

        $update = array(
            'orderStatus' => $_REQUEST['status'],
            'deliveryDate' => $deliveryDate
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

        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, address, address_shipping, address_billing, note, subTotal, deliveryCost, totalAmount, orderStatus, dateTime,invoiceNo,offerAmt,couponDiscount,supportComment FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
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
            $orderDetails->invoiceNo = "BTML".$newinvoiceNo;
        }
        ?>


            <link href="css/magicsuggest-min.css" rel="stylesheet">
            <script src="js/magicsuggest-min.js"></script>      
            <script type="text/javascript">
                $(document).ready(function() {              
                    $('.editOrdersubmit').attr("disabled", "true"); 
                });
            </script>
            
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
                                                    <textarea class="form-control" name="shippingAddress" id="shippingAddress" rows="3" required=""><?=$orderDetails->address_shipping?></textarea>
                                                </div> 
                                                <div class="form-group">
                                                    <label> Invoice number:</label>
                                                    <input type="text" class="form-control" name="invoiceNo" rows="3" required="" value="<?=$orderDetails->invoiceNo?>"/>
                                                </div> 
                                                <div class="form-group">
                                                    <label> Note:</label>
                                                    <textarea class="form-control" name="note" rows="3" ><?=$orderDetails->note?></textarea>
                                                </div> 
                                                <div class="form-group">
                                                    <label> Support Comment:</label>
                                                    <textarea class="form-control" name="supportComment" placeholder="Comment" ><?=$orderDetails->supportComment?></textarea>
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
                                                    <a onclick="deleteOrderedItems('<?=$record['id'];?>',<?=$record['orderId']?>,'<?=base64_encode($record['productName'])?>','<?=$productTotal?>','<?=$orderDetails->subTotal?>');" title="Delete Orders" data-val="<?=$record['id'];?>" href="javascript:void(0);">
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
                                                                    data: 'get_productnames.php',
                                                                    allowFreeEntries: false

                                                            });
                                                           var prdord_unit = $('#ordersuggest1_'+count).magicSuggest({
                                                                    value: [productunit],
                                                                    data: 'get_productunits.php',
                                                                    allowFreeEntries: false
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
                                                        <p >Sub Total : <input type="text" name="subtotal" id="subtotal" class="form-control" required value="<?=$orderDetails->subTotal?>" readonly /></p>
                                                        <p >Delivery Charges : <input type="text" name="deliverycharge" id="deliverycharge" class="form-control" required value="<?=$orderDetails->deliveryCost?>" readonly/></p>
                                                        <input type="hidden" name="grandTotal" id="grandTotal" class="form-control" required value="<?=$orderDetails->totalAmount?>" readonly />
                                                        <?php $totalPay = $orderDetails->totalAmount; ?>
                                                        <?php if($orderDetails->couponDiscount > 0){?>
                                                        <p >Coupon Discount : <input type="text" name="couponDiscount" id="couponDiscount" class="form-control" required value="<?=$orderDetails->couponDiscount?>" readonly/></p>
                                                        <input type="hidden" id="applyCoupon" value="1">
                                                        <?php 
                                                        $totalPay = $totalPay - $orderDetails->couponDiscount;
                                                        }else{ ?>
                                                        <input type="hidden" id="applyCoupon" value="0">
                                                        <?php } ?>
                                                        <?php if($orderDetails->offerAmt > 0){?>
                                                        <p >Discount : <input type="text" name="offerAmt" id="offerAmt" class="form-control" required value="<?=$orderDetails->offerAmt?>" readonly/></p>
                                                        <input type="hidden" id="applyOffer" value="1">
                                                        <?php 
                                                        $totalPay = $totalPay - $orderDetails->offerAmt;
                                                        }else{ ?>
                                                        <input type="hidden" id="applyOffer" value="0">
                                                        <?php } ?>
                                                        
                                                        <p >Total Payable : <input type="text" class="form-control" id="offerTotal" required value="<?=$totalPay?>" readonly /></p>
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
                  //$('.editOrdersubmit').attr("disabled", "true"); 
                    
                  var prdorder_name = $('.orderaddsuggest').magicSuggest({
                        //data: ['Paris', 'New York', 'Gotham']
                        data: 'get_productnames.php',
                        allowFreeEntries: false

                    });
                  var prdorder_unit = $('.orderaddsuggest1').magicSuggest({
                        data: 'get_productunits.php',
                        allowFreeEntries: false
                    });

                    $(prdorder_name).on('selectionchange', function(){
                                              
                        $('#productId_'+orderCount).val(this.getValue());

                    });
                    $(prdorder_unit).on('selectionchange', function(){
                        $('#orderUnit_'+orderCount).val(this.getValue());
                        
                     });  
                     $(prdorder_unit).on('load', function(){
                        $('.editOrdersubmit').removeAttr("disabled");
                    });                 
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
                        alert(atob(sessionStorage.reloadAfterProductname)+' has been deleted from order items!');
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
                    getGrandtotal();
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
                var offerTotal = 0;
                var offerAmt = 0;
                var couponDiscount = 0;
                var applyOffer = $('#applyOffer').val();
                var applyCoupon = $('#applyCoupon').val();
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
                offerAmt = Math.round((parseFloat(5)/100)*parseFloat(subtotal));
                if(offerAmt < 1){
                    offerAmt = 1;
                }
                subtotal = subtotal.toFixed(2);
                deliveryCharge = deliveryCharge.toFixed(2);
                gradnd_total = gradnd_total.toFixed(2);
                offerTotal = parseFloat(gradnd_total)-parseFloat(offerAmt);
                $('#subtotal').val(subtotal);
                $('#deliverycharge').val(deliveryCharge);
                $('#totalQty').val(totalQty);
                $('#grandTotal').val(gradnd_total);
                if(applyCoupon == 1 && applyOffer == 1){
                   couponDiscount = $('#couponDiscount').val();
                   offerTotal = parseFloat(offerTotal) - parseFloat(couponDiscount);
                   if(offerTotal < 0){
                    offerTotal = 0;
                   } 
                   $('#offerTotal').val(offerTotal.toFixed(2));
                   $('#offerAmt').val(offerAmt.toFixed(2));

                }else if(applyCoupon == 1){
                    couponDiscount = $('#couponDiscount').val();
                    gradnd_total = parseFloat(gradnd_total) - parseFloat(couponDiscount);
                    $('#offerTotal').val(gradnd_total.toFixed(2));
                    
                }else if(applyOffer == 1){
                    $('#offerTotal').val(offerTotal.toFixed(2));
                    $('#offerAmt').val(offerAmt.toFixed(2));
                }else{
                    $('#offerTotal').val(gradnd_total);
                    //$('#offerAmt').val(offerAmt);
                }
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
            $donot_allow = $db->filter($_REQUEST['donot_allow']);
            
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
                    'expiryDate' => $newexpDate,
                    'productDistributerPrice' =>$productIndTotal[$i]
                );

                $where_clause = array(
                    'id' => $productOptionId
                );
                if($donot_allow[$i] == '0'){
                    $updated = $db->update(PRODUCT_OPTIONS, $update, $where_clause );
                    if($updated){
                        $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productName[$i]."' AND active='1'";
                        $productOptions = $db->get_results($query);
                        $totalStock = 0;
                        foreach($productOptions as $productOption){
                            $totalStock += $productOption['productStock'];
                        }
                        $stockData = array(
                        'productStock' => $totalStock,
                        );
                        $where_clause_stock = array(
                            'id' => $productName[$i]
                        );
                        $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
                    }
                 }
                
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
                    'expiryDate' => $expDate,
                    'donot_allow' => $donot_allow[$i],
                    'productDistributerPrice' =>$productIndTotal[$i]
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
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($record['productCost'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productDiscount']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productVat']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;"><?=$record['productQty']?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($record['productIndTotal'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($record['productTotal'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($record['chitkiprice'],2)?></td>
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($record['productmrp'],2)?></td>
                </tr>
                <?}?>
                 <tr >
                    <td colspan="6" style="padding:5px;border-color:#e5e5e5;font-size:14px;" align="right">
                         Total Amount:  </td>
                    
                    <td style="padding:5px;border-color:#e5e5e5;font-size:14px;">&#36; <?=number_format($supplier->total,2)?></td> 
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
                newTBDiv.innerHTML+="<select class='form-control' name='productName[]' style='width:12% !important; display:inline !important' required onChange='loadWeightunitForm(this,"+costPerWtVal+")'><option value=''>-Select Item-</option><? foreach($products as $product){ ?><option value='<?=$product['id']?>'><?=$product['productName']?></option><? } ?></select>&nbsp;<span id='productWeightunitsDiv_"+costPerWtVal+"'><input type='number' min='1' step='0.01' class='form-control' name='productWeight[]' id='productWeight_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:9% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' id='productUnit_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' style='width:8% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select></span>&nbsp;<input type='date' class='form-control expiryDate' name='expiryDate[]' value='' style='width:10% !important; display:inline !important' placeholder='Expiry Date'> &nbsp;<input type='text' min='1' class='form-control getIndTotal getProdTot' name='productCost[]' id='productCost_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:6% !important; display:inline !important' placeholder='Cost' required>&nbsp;<input type='text' class='form-control getIndTotal getProdTot' name='productDiscount[]' data-cntid='"+costPerWtVal+"' id='productDiscount_"+costPerWtVal+"' value='' style='width:6% !important; display:inline !important' placeholder='Discount'>&nbsp;<input type='text' class='form-control getIndTotal getProdTot' name='productVat[]' id='productVat_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:5% !important; display:inline !important' placeholder='Vat'>&nbsp;<input type='text' class='form-control getIndTotal getProdTot' name='productIndTotal[]' id='productIndTotal_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:7% !important; display:inline !important' placeholder='Ind. Total' readonly >&nbsp;<input type='text' min='0' class='form-control getProdTot' name='productQty[]' id='productQty_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:5% !important; display:inline !important' placeholder='Qty' required>&nbsp;<input type='text' min='0' class='form-control getProdTot' name='productTotal[]' id='productTotal_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:7% !important; display:inline !important' placeholder='Total' required readonly>&nbsp;<input type='text' class='form-control' name='chitkiprice[]' placeholder='Chitki price' style='width:7% !important; display:inline !important'>&nbsp;<input type='text' class='form-control' name='mrp[]' placeholder='M.R.P.' style='width:7% !important; display:inline !important'>&nbsp;<input type='checkbox' onclick='donotAllow("+costPerWtVal+");' id='allowchecked_"+costPerWtVal+"'  title='do not allow update the changes to product table'><input type='hidden' name='donot_allow[]' id='donotAllow_"+costPerWtVal+"' value='0'><br/><br/>";
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

           function donotAllow(val){
                if (document.getElementById('allowchecked_'+val).checked) {
                    $('#donotAllow_'+val).val('1');
                }
                else {
                    $('#donotAllow_'+val).val('0');
                }
           }

        </script>

        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
        <style type="text/css">
            .mangBillsTitle label{margin-right: 5px !important;}
        </style>
        <label>Item Qty/Cost/Discount/Vat</label><br/>
       <p class="mangBillsTitle"><label style="width:12% !important; display:inline-block !important">Select Product</label><label style='width:9% !important; display:inline-block !important'>Weight</label><label style='width:8% !important; display:inline-block !important'>Unit</label><label style="width:10% !important; display:inline-block !important">Expiry Date</label><label style="width:5% !important; display:inline-block !important">Cost</label>
            <label style='width:7% !important; display:inline-block !important'>Discount</label><label style="width:5% !important; display:inline-block !important">VAT</label><label style="width:7% !important; display:inline-block !important">Ind. Total</label><label style="width:5% !important; display:inline-block !important">Qty</label><label style="width:7% !important; display:inline-block !important">Total</label><label style="width:7% !important; display:inline-block !important">Chitki price</label><label style="width:5% !important; display:inline-block !important">M.R.P.</label><label style="width:3% !important; display:inline-block !important">don't allow</label></p>
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
        <input type="text" min="1" class="form-control getIndTotal getProdTot" name="productCost[]" id="productCost_0" value="" style="width:6% !important; display:inline !important" placeholder="Cost" required>   
        <input type="text" class="form-control getIndTotal getProdTot" name="productDiscount[]" id="productDiscount_0" value="" style="width:6% !important; display:inline !important" placeholder="Discount">   
        <input type="text" class="form-control getIndTotal getProdTot" name="productVat[]" id="productVat_0" value="" style="width:5% !important; display:inline !important" placeholder="Vat">   
        <input type="text" class="form-control getIndTotal getProdTot" name="productIndTotal[]" id="productIndTotal_0" value="" style="width:7% !important; display:inline !important" placeholder="Ind. Total" readonly>   
        <input type="text" min="0" class="form-control getProdTot" name="productQty[]" id="productQty_0" value="" style="width:5% !important; display:inline !important" placeholder="Qty" required>
        <input type="text" class="form-control getProdTot" name="productTotal[]" id="productTotal_0" value="" style="width:7% !important; display:inline !important" placeholder="Total" readonly>   
        <input type="text" class="form-control" name="chitkiprice[]" placeholder="Chitki price" style="width:7% !important; display:inline !important">
        <input type="text" class="form-control" name="mrp[]" placeholder="M.R.P." style="width:7% !important; display:inline !important">
        <input type="checkbox" onclick="donotAllow('0');" id="allowchecked_0" title="do not allow update the changes to product table">
        <input type="hidden" name="donot_allow[]" id="donotAllow_0" value="0">
       
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

   function returnProducts(){ // Suppliers bill generation

            $db = new DB();
            
        ?>

     
        <script type="text/javascript">

             function loadReturnReceiptForm(ele){

                if(confirm("Are you sure you want to change supplier name?")){

                    var supplierId = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadReturnReceiptForm&supplierId="+supplierId,
                        success: function(msg){       
                            $('#productDetailsDiv').html(msg);                                              
                        }
                    });

                }

            }

        </script>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Return Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Return Products
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" name="product_form" method="post" role="form" enctype="multipart/form-data" >            
                                         <input type="hidden" name="action" value="saveReturnProducts" /> 
                                        
                                        <div class="form-group">
                                            <label>Supplier</label>

                                            <?php

                                                $query = "SELECT * FROM ".SUPPLIERS."";
                                                $suppliers = $db->get_results($query);

                                            ?>
                                           <select name="supplierId" class="form-control" required onChange="loadReturnReceiptForm(this)">
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
                                            <input type="text" class="form-control" name="productGrandTotal" id="supplyProductTotal" value="" style="width:10% !important; display:inline !important" placeholder="Total">   
--> 
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


    function loadReturnReceiptForm(){

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
                newTBDiv.innerHTML+="<select class='form-control' name='productName[]' style='width:22% !important; display:inline !important' required onChange='loadWeightunitForm(this,"+costPerWtVal+")'><option value=''>-Select Item-</option><? foreach($products as $product){ ?><option value='<?=$product['id']?>'><?=$product['productName']?></option><? } ?></select>&nbsp;<span id='productWeightunitsDiv_"+costPerWtVal+"'><input type='number' min='1' step='0.01' class='form-control' name='productWeight[]' id='productWeight_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:9% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;<select class='form-control' name='productUnit[]' id='productUnit_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' style='width:8% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?></select></span>&nbsp;<input type='text' min='0' class='form-control getProdTot' name='productQty[]' id='productQty_"+costPerWtVal+"' data-cntid='"+costPerWtVal+"' value='' style='width:10% !important; display:inline !important' placeholder='Qty' required>&nbsp;<br/><br/>";
                contentID.appendChild(newTBDiv);
                $('#costPerWtVal').val(costPerWtVal);
                               
               

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
        <p class="mangBillsTitle"><label style="width:22% !important; display:inline-block !important">Select Product</label><label style='width:9% !important; display:inline-block !important'>Weight</label><label style='width:8% !important; display:inline-block !important'>Unit</label><label style="width:10% !important; display:inline-block !important">Qty</label></p>
        
        <select class="form-control" name="productName[]" style="width:22% !important; display:inline !important" required onChange="loadWeightunitForm(this,0)">
        <option value="">-Select Item-</option>
        <? foreach($products as $product){ ?>
           <option value="<?=$product['id']?>"><?=$product['productName']?></option>
        <? } ?>   
        </select>  

        
        <span id="productWeightunitsDiv_0">
            <input type='number' min='1' step='0.01' class='form-control' name='productWeight[]' id='productWeight_0' value='' style='width:9% !important; display:inline !important' placeholder='Weight/Qty' required>&nbsp;
            <select class='form-control' name='productUnit[]' id='productUnit_0' style='width:8% !important; display:inline !important' required ><option value=''>-Unit-</option><? foreach($weightUnits as $weightUnit){ ?><option value='<?=$weightUnit['attributeValue']?>'><?=$weightUnit['attributeValue']?></option><? } ?>   </select>
        </span> 
        
        <!-- <input type="date" class="form-control expiryDate" name="expiryDate[]" value="" style="width:10% !important; display:inline !important" placeholder="Expiry Date">    
        <input type="text" min="1" class="form-control getIndTotal getProdTot" name="productCost[]" id="productCost_0" value="" style="width:6% !important; display:inline !important" placeholder="Cost" required>   
        <input type="text" class="form-control getIndTotal getProdTot" name="productDiscount[]" id="productDiscount_0" value="" style="width:6% !important; display:inline !important" placeholder="Discount">   
        <input type="text" class="form-control getIndTotal getProdTot" name="productVat[]" id="productVat_0" value="" style="width:5% !important; display:inline !important" placeholder="Vat">   
        <input type="text" class="form-control getIndTotal getProdTot" name="productIndTotal[]" id="productIndTotal_0" value="" style="width:7% !important; display:inline !important" placeholder="Ind. Total" readonly>   
        --> <input type="text" min="0" class="form-control getProdTot" name="productQty[]" id="productQty_0" value="" style="width:10% !important; display:inline !important" placeholder="Qty" required>
       <!--  <input type="text" class="form-control getProdTot" name="productTotal[]" id="productTotal_0" value="" style="width:7% !important; display:inline !important" placeholder="Total" readonly>   
        <input type="text" class="form-control" name="chitkiprice[]" placeholder="Chitki price" style="width:7% !important; display:inline !important">
        <input type="text" class="form-control" name="mrp[]" placeholder="M.R.P." style="width:7% !important; display:inline !important">
        <input type="checkbox" onclick="donotAllow('0');" id="allowchecked_0" title="do not allow update the changes to product table">
        -->  <a href="javascript:void(0);" id="addMoreCostsPerWeightElement" data-val="moreWeights" Title="Add more Cost/Weight(qty)"><i class="fa fa-plus-square fa-lg"></i></a>
        <a href="javascript:void(0);" id="removeCostsPerWeightElement" data-val="moreWeights"  Title="Remove Cost/Weight(qty)"><i class="fa fa-minus-square fa-lg"></i></a>

        <br/><br/>
        <input type="hidden" id="costPerWtVal" name="costPerWtVal" value="0" >
        <div class='moreWeights' id="moreWeights">

        </div>  
        <br/>                                 

            <script type="text/javascript">

                
                 
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

                
            </script>

        
                                   
    <?
    }
   
   function saveReturnProducts(){
      $db = new DB();
      date_default_timezone_set("Asia/Calcutta");
      $dateTime  = date('Y-m-d H:i:s', time());
          
            $supplierId = $db->filter($_REQUEST['supplierId']);    
            $productName = $db->filter($_REQUEST['productName']);
            $productQty   = $db->filter($_REQUEST['productQty']);
            $productWeight = $db->filter($_REQUEST['productWeight']);
            $productUnit = $db->filter($_REQUEST['productUnit']);
               
            $i=0;
            
            foreach($productName as $productname){
               

                $productoptionResult = $db->get_row("SELECT id,productStock FROM ".PRODUCT_OPTIONS." WHERE productId = '".$productName[$i]."' AND active = '1' AND productUnit ='".$productUnit[$i]."' AND productWeight ='".$productWeight[$i]."' ",true);
                $productOptionId = $productoptionResult->id;
                
                 
                 $records = array(
                    'productId' => $productName[$i],
                    'product_optionId' => $productOptionId,
                    'supplierId' => $supplierId,
                    'productWeight' => $productWeight[$i],
                    'productQty' => $productQty[$i],
                    'productUnit' => $productUnit[$i],
                    'dateTime' => $dateTime
                );

                $inserted = $db->insert(PRODUCT_RETURN_ITEMS, $records);
               
                $i++;
            }  
        if($inserted){    
            return true;
        }else{
            return false;
        }

    }

    function viewReturnProducts(){
      $db = new DB();
       
       ?>



         <div class="row">
                <div class="col-lg-12 alert alert-success deleteBillsuccess"> </div>
                <div class="col-lg-12 alert alert-danger deleteBillerror"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Returned Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Returned Products
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Supplier Name</th>
                                            <th>Date</th>
                                            <th>Weight - unit</th>
                                            <th>Qty</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                   

                                    $query = "SELECT * FROM ".PRODUCT_RETURN_ITEMS;
                                    $returnItems = $db->get_results( $query );
                                    

                                     if(count($returnItems)>0){
                                     foreach ($returnItems as $returnItem) {
                                        
                                        $product = $db->get_row("SELECT productName FROM ".PRODUCTS." WHERE id= '".$returnItem['productId']."'",true);
                                        $supplier = $db->get_row("SELECT companyName FROM ".suppliers." WHERE id= '".$returnItem['supplierId']."'",true);
                                        ?>
                                        <tr class="odd gradeX ">
                                            <td><?=$product->productName?></td>
                                            <td><?=$supplier->companyName?></td>
                                            <td><?=stdDateFormat($returnItem['dateTime'])?></td>
                                            <td><?=$returnItem['productWeight']?> - <?=$returnItem['productUnit']?></td>
                                            <td><?=$returnItem['productQty']?></td>
                                            <td class="return_<?=$returnItem['id']?>"><?php if($returnItem['active']=='0'){?><a href="javascript:void(0);" title="Update product" onclick="updatereturnProducts('<?=$returnItem['id']?>','<?=$returnItem['product_optionId']?>','<?=$returnItem['productQty']?>');"><i class="fa fa-reply"></i></a>
                                                <?php } else{ echo "Returned"; } ?>
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
            function updatereturnProducts(id,optId,qty){
                if(confirm("Are you sure you want to return product?")){
                 $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=updatereturnProducts&id="+id+"&optId="+optId+"&qty="+qty,
                        success: function(msg){       
                            
                            if(msg =='success'){
                                        $('.return_'+id).html('Returned');
                                        $('.deleteBillsuccess').show('slow');
                                        $('.deleteBillsuccess').html('Product has been returned.');
                                        
                                   }else{
                                        $('.deleteBillerror').show('slow');
                                        $('.deleteBillerror').html('Problem while returning. Please try again!');
                                       
                                   }                                            
                        }
                    });
             }
            }
            </script>


        <?
    }
    function updatereturnProducts(){
                $db = new DB();
                $productoptionResult = $db->get_row("SELECT id,productStock,productId FROM ".PRODUCT_OPTIONS." WHERE id = '".$_REQUEST['optId']."' AND active = '1' ",true);
                $productOptionId = $productoptionResult->id;
                $productStock = $productoptionResult->productStock;
                $newproductStock = $productStock - $_REQUEST['qty'];
                if( $newproductStock <= 0){
                    $newproductStock = 0;
                }
                $update = array(
                 'productStock' => $newproductStock
                );
                $where_clause = array(
                    'id' => $productOptionId
                );
                
                    $updated = $db->update(PRODUCT_OPTIONS, $update, $where_clause );
                    if($updated){
                        $query = "SELECT productStock FROM ".PRODUCT_OPTIONS." WHERE productId='".$productoptionResult->productId."' AND active='1'";
                        $productOptions = $db->get_results($query);
                        $totalStock = 0;
                        foreach($productOptions as $productOption){
                            $totalStock += $productOption['productStock'];
                        }
                        $stockData = array(
                        'productStock' => $totalStock,
                        );
                        $where_clause_stock = array(
                            'id' => $productName[$i]
                        );
                        $stockUpdate = $db->update(PRODUCTS, $stockData, $where_clause_stock);
                         $records = array(
                            'active' => '1'
                        );
                        $where_clause_return = array(
                            'id' => $_REQUEST['id']
                        );
                        $returnedItem = $db->update(PRODUCT_RETURN_ITEMS, $records,$where_clause_return);
                    }
                    if($returnedItem){
                        echo 'success';
                    }else{
                        echo 'fail';
                    }
    }

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

    function manageCoupons(){
            $db = new DB();

            $coupons = $this->getAllCoupons();

        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Coupons</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Coupons
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Coupons Name</th>
                                            <th>Coupons Active</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                     if(count($coupons)>0){
                                     foreach ($coupons as $coupon) {

                                           


                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$coupon['name']?></td>
                                            <td><?=mdyDateFormat($coupon['dateFrom'])?> - <?=mdyDateFormat($coupon['dateTo'])?></td>
                                            <td><?php if($coupon['active']=='1'){ echo "Active";}else{ echo "Inactive";}?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editCoupon&id=<?=$coupon['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
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

    function addCoupon(){

            $couponType = $this->getAllCouponType();
            $couponMethod = $this->getAllCouponMethod();
            $couponApply = $this->getAllCouponApply();
        ?>
        <!-- <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script> -->
        <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Coupons</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Coupon
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form" enctype="multipart/form-data">            
                                        <input type="hidden" name="action" value="saveNewCoupon" /> 
                                        <div class="form-group">
                                            <label>Coupon Type</label>

                                            <?
                                                $this->couponTypeTree($couponType, 0, ''); 
                                            ?>
                                           <select name="couponType" class="form-control" required onChange="loadCouponTypeFields(this)">
                                                <option value="">Select Coupon Type</option>
                                               <?php echo $couponType ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Coupon Method</label>

                                            <?
                                                $this->couponMethodTree($couponMethod, 0, ''); 
                                            ?>
                                           <select name="couponMethod" class="form-control" required onChange="loadCouponMethodFields(this)">
                                                <option value="">Select Coupon Method</option>
                                               <?php echo $couponMethod ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Coupon Apply To</label>

                                            <?
                                                $this->couponApplyTree($couponApply, 0, ''); 
                                            ?>
                                           <select name="couponApply" class="form-control" required onChange="loadApplyFields(this)">
                                                <option value="">Coupon Apply to</option>
                                               <?php echo $couponApply ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="name" value="" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description"></textarea>
                                                                                       
                                        </div>
                                        <div id="typeFieldForm"></div>
                                        <div id="methodFieldForm"></div>
                                        <div id="applyFieldForm"></div>
                                        
                                         <div class="form-group input-group col-xs-12">
                                            <label>Coupon starts from</label>
                                            <input type='text' class='form-control' id='dateFrom' name='dateFrom' value='' required>                                            
                                        </div>
                                        <div class="form-group input-group col-xs-12">
                                            <label>Coupon end </label>
                                            <input type='text' class='form-control' id='dateTo' name='dateTo' value='' required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Minimum Total Cart Ammount </label>
                                            <input type="text" name="minimumAmount" class="form-control" required >
                                        </div>
                                        <div class="form-group">
                                            <label>Number of use / user</label>
                                            <input type="number" class="form-control" name="useCount" value="1" required>                                            
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
             <script type="text/javascript">

                $(function(){

                        $('#dateFrom').datetimepicker({
                            format: 'DD-MM-YYYY HH:mm:ss',
                        });
                        $('#dateTo').datetimepicker({
                            format: 'DD-MM-YYYY HH:mm:ss',
                        });
                });
                $(document).on('dp.change', '#dateFrom', function (e) {
                    $('#dateTo').data("DateTimePicker").minDate(e.date);
                    $('#dateFrom').val(e.currentTarget.value);
                });
                $(document).on('dp.change', '#dateTo', function (e) {
                    $('#dateFrom').data("DateTimePicker").maxDate(e.date);
                    $('#dateTo').val(e.currentTarget.value);
                });
                 function loadApplyFields(ele){
                    var id = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadApplyFieldForm&id="+id,
                        success: function(msg){       
                            $('#applyFieldForm').html(msg);                                              
                        }
                    });
                }

                function loadCouponTypeFields(ele){
                     var id = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadCouponTypeFieldsForm&id="+id,
                        success: function(msg){       
                            $('#typeFieldForm').html(msg);                                              
                        }
                    });
                }
                function loadCouponMethodFields(ele){
                    var id = ele.value;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadCouponMethodFieldsForm&id="+id,
                        success: function(msg){       
                            $('#methodFieldForm').html(msg);                                              
                        }
                    });
                }

                function checkCouponCode(couponcode){
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=checkCouponCode&code="+couponcode,
                        success: function(msg){  
                            if(msg=='codeExits'){
                                $('#couponCodeVal').css('border','1px solid #ff0000'); 
                                $('#couponExits').html('Coupon code already used!');     
                            }else{
                                $('#couponCodeVal').css('border','1px solid #ccc'); 
                                $('#couponExits').html('');   
                            }                                        
                        }
                    });
                }
            </script>

        <?
    }
    function checkCouponCode(){
        $db = new DB();
        $code = $_REQUEST['code'];
        $id = $_REQUEST['id'];
        if(isset($id) && $id !=''){
            $query = "SELECT id FROM ".COUPONS." WHERE couponValue = '".$code."' AND id !='".$id."'";
        }else{
            $query = "SELECT id FROM ".COUPONS." WHERE couponValue = '".$code."'";  
        }
        $results = $db->num_rows( $query );
        if($results > 0){
            echo "codeExits";
        }else{
            echo "";
        }
    }
    function loadApplyFieldForm(){ ?>
        <link href="css/magicsuggest-min.css" rel="stylesheet">
        <script src="js/magicsuggest-min.js"></script>      
        <?php
        $id = $_REQUEST['id'];
        if($id =='2'){ ?>
        <div class="form-group">
        <label>Products </label>
        <div class="productsuggest" placeholder="Product name"></div>
        <input type="hidden" name="productIds" id="productIds" >
        </div>
           <script type="text/javascript">
                $(function(){
                   
                  var ms = $('.productsuggest').magicSuggest({
                        data: 'get_productnames.php',
                        maxSelection: null
                    });
                  $(ms).on('selectionchange', function(){
                      $('#productIds').val(this.getValue());
                    });
                   
                });
        </script>
        <?php
        }else if($id =='3'){ ?>
        <div class="form-group">
        <label>Categories </label>
        <div class="categorysuggest" placeholder="Categories"></div>
        <input type="hidden" name="categoryIds" id="categoryIds" >
        </div>
           <script type="text/javascript">
                $(function(){
                   
                 var ms = $('.categorysuggest').magicSuggest({
                        data: 'get_categorynames.php',
                        maxSelection: null
                    });
                    $(ms).on('selectionchange', function(){
                        $('#categoryIds').val(this.getValue());
                    });
                });
        </script>
        <?php
        }
    }

    function loadCouponTypeFieldsForm(){
        $id = $_REQUEST['id'];
        $discountValue = $_REQUEST['discountValue'];
        if($id =='1'){ ?>
        <div class="form-group">
            <label>Fixed Discount Amount </label>
            <input type="number" name="discountValue" class="form-control" value="<?=$discountValue?>" required>
        </div>
        <?php }else if($id =='2'){?>
        <div class="form-group">
            <label>Discount Percentage </label>
            <input type="number" name="discountValue" class="form-control" value="<?=$discountValue?>" required>
        </div>
        <?php }
    }
    function loadCouponMethodFieldsForm(){
        $id = $_REQUEST['id'];
        $couponCodeVal = $_REQUEST['couponCodeVal'];
        if($id =='1'){ ?>
        <div class="form-group">
            <label>Coupon Code</label>
            <input type="text" class="form-control" id="couponCodeVal" name="couponValue" value="<?=$couponCodeVal?>" required onblur="checkCouponCode(this.value);" onkeyup="checkCouponCode(this.value);">                                            
            <span id="couponExits" style="color:#ff0000;"></span>
        </div>
        <?php }else if($id =='2'){?>
        <div class="form-group">
            <label>Minimum Price value</label>
            <input type="number" step="any" class="form-control" name="couponValue" value="<?=$couponCodeVal?>" required>                                            
        </div>
        <?php }
    }
    function saveNewCoupon(){
        $db = new DB();
        if($db->filter($_POST['couponMethod'])=='1'){
            $query = "SELECT id FROM ".COUPONS." WHERE couponValue = '".$db->filter($_POST['couponValue'])."'";
            $results = $db->num_rows( $query );
            if($results > 0){
                return false;
                exit;
            }
        }
        $data = array(
            'typeId' => $db->filter($_POST['couponType']),
            'methodId' => $db->filter($_POST['couponMethod']),
            'applyId' => $db->filter($_POST['couponApply']),
            'name' => $db->filter($_POST['name']),
            'description' => $db->filter($_POST['description']),
            'discountValue' => $db->filter($_POST['discountValue']),
            'couponValue' => $db->filter($_POST['couponValue']),
            'dateFrom' => date('Y-m-d H:i:s', strtotime($db->filter($_POST['dateFrom']))),
            'dateTo' => date('Y-m-d H:i:s', strtotime($db->filter($_POST['dateTo']))),
            'useCount' => $db->filter($_POST['useCount']),
            'active' => $db->filter($_POST['active']),
            'minimumAmount' => $db->filter($_POST['minimumAmount'])
        );

        $rs = $db->insert(COUPONS, $data);
        $couponId = $db->lastid();
        if($rs){
            if(isset($_POST['productIds']) && $_POST['productIds']!=''){
                $update = array(
                      'productIds'=> $db->filter($_POST['productIds'])
                );
                $where_clause = array(
                    'id' => $couponId
                );
                $updated = $db->update(COUPONS, $update, $where_clause, 1 );

            }else if(isset($_POST['categoryIds']) && $_POST['categoryIds']!=''){
                $update = array(
                      'categoryIds'=> $db->filter($_POST['categoryIds'])
                );
                $where_clause = array(
                    'id' => $couponId
                );
                $updated = $db->update(COUPONS, $update, $where_clause, 1 );

            }
            return true;
        }

    }

    function getAllCoupons(){
        
        $db = new DB();

        $query = "SELECT * FROM ".COUPONS."";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $coupons[]=$row;
        }

        return $coupons;

    }
    function getAllCouponType(){
        $db = new DB();

        $query = "SELECT * FROM ".COUPON_TYPE." WHERE active ='1'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $coupons[]=$row;
        }

        return $coupons;
    }
    function getAllCouponMethod(){
        $db = new DB();

        $query = "SELECT * FROM ".COUPON_METHOD." WHERE active ='1'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $coupons[]=$row;
        }

        return $coupons;
    }
    function getAllCouponApply(){
        $db = new DB();

        $query = "SELECT * FROM ".COUPON_APPLY." WHERE active ='1'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $coupons[]=$row;
        }

        return $coupons;
    }
    function couponTypeTree(&$output, $preselected, $indent=""){

        $db = new DB();

        $query = "SELECT id, typeName FROM ".COUPON_TYPE." WHERE active = '1'";

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["typeName"] . "</option>";
               
               

        }

    }
    function couponMethodTree(&$output, $preselected, $indent=""){

        $db = new DB();

        $query = "SELECT id, methodName FROM ".COUPON_METHOD." WHERE active = '1'";

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["methodName"] . "</option>";
               
               

        }

    }
    function couponApplyTree(&$output, $preselected, $indent=""){

        $db = new DB();

        $query = "SELECT id, applyName FROM ".COUPON_APPLY." WHERE active = '1'";

        $results = $db->get_results( $query);
        
        foreach($results as $row ){

            $selected = ($row["id"] == $preselected) ? "selected=\"selected\"" : "";
            
            $output .= "<option value=\"" . $row["id"] . "\" " . $selected . ">" . $indent.'&gt;'. $row["applyName"] . "</option>";
               
               

        }

    }

    function getCouponsById($id){
        $db = new DB();
        $query = "SELECT * FROM ".COUPONS." WHERE id='".$id."'";
        if($db->num_rows($query) > 0){
           return $db->get_row($query, true);
        }else{
           return false;
        }
    }

    function getCouponProducts($productIds){
        $db = new DB();
        $array=array_map('intval', explode(',', $productIds));
        $array = implode("','",$array);
        $query = "SELECT id,productName FROM ".PRODUCTS." WHERE id IN ('".$array."')";
        if($db->num_rows($query) > 0){
           return $db->get_results($query);
        }else{
           return false;
        }
    }

    function getCouponCategory($categoryIds){
        $db = new DB();
        $array=array_map('intval', explode(',', $categoryIds));
        $array = implode("','",$array);
        $query = "SELECT id,categoryName FROM ".PRODUCT_CATEGORIES." WHERE id IN ('".$array."')";
        if($db->num_rows($query) > 0){
           return $db->get_results($query);
        }else{
           return false;
        }
    }

    function editCoupon($id){
          $couponType = $this->getAllCouponType();
          $couponMethod = $this->getAllCouponMethod();
          $couponApply = $this->getAllCouponApply();
          $couponData = $this->getCouponsById($id);

        ?>
        <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Coupons</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Coupon
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form" enctype="multipart/form-data">            
                                        <input type="hidden" name="action" value="updateNewCoupon" /> 
                                        <input type="hidden" name="couponId" value="<?=$couponData->id?>" />
                                        <div class="form-group">
                                            <label>Coupon Type</label>

                                            <?
                                                $this->couponTypeTree($couponType,$couponData->typeId,''); 
                                            ?>
                                           <select name="couponType" class="form-control" required onChange="editCouponTypeFields(this.value,'<?=$couponData->discountValue?>')">
                                                <option value="">Select Coupon Type</option>
                                               <?php echo $couponType ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Coupon Method</label>

                                            <?
                                                $this->couponMethodTree($couponMethod, $couponData->methodId, ''); 
                                            ?>
                                           <select name="couponMethod" class="form-control" required onChange="editCouponMethodFields(this.value,'<?=$couponData->couponValue?>')">
                                                <option value="">Select Coupon Method</option>
                                               <?php echo $couponMethod ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Coupon Apply To</label>

                                            <?
                                                $this->couponApplyTree($couponApply, $couponData->applyId, ''); 
                                            ?>
                                           <select name="couponApply" class="form-control" required onChange="editApplyFields(this.value)">
                                                <option value="">Coupon Apply to</option>
                                               <?php echo $couponApply ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <?php if($couponData->applyId == '2' && $couponData->productIds!='' ){
                                                $couponProducts = $this->getCouponProducts($couponData->productIds);
                                                foreach ($couponProducts as $couponProduct) {
                                                    echo "<span id='couponPrd_".$couponProduct['id']."'>".$couponProduct['productName'];
                                                    ?>
                                                    <a href="javascript:void(0);" onclick="removeCouponProduct('<?=$couponData->id?>','<?=$couponProduct['id']?>');" title="Remove Product"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                <?php echo "</span>";
                                                }

                                          }else if($couponData->applyId == '3' && $couponData->categoryIds!=''){
                                                $couponCategories = $this->getCouponCategory($couponData->categoryIds);
                                                foreach ($couponCategories as $couponCategory) {
                                                   echo "<span id='couponCat_".$couponCategory['id']."'>".$couponCategory['categoryName'];
                                                    ?>
                                                    <a href="javascript:void(0);" onclick="removeCouponCategory('<?=$couponData->id?>','<?=$couponCategory['id']?>');" title="Remove Category"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                <?php echo "</span>";
                                                }
                                          } ?>
                                          <span class="alert-danger" id="removeCouponCatid"></span>
                                        </div>  
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="name" value="<?=$couponData->name?>" required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description"><?=$couponData->description?></textarea>
                                                                                       
                                        </div>
                                        <div id="typeFieldForm"></div>
                                        <div id="methodFieldForm"></div>
                                        <div id="applyFieldForm"></div>
                                        
                                         <div class="form-group input-group col-xs-12">
                                            <label>Coupon starts from</label>
                                            <?php $dateFrom = date('d-m-Y h:i:s',strtotime($couponData->dateFrom));?>
                                            <input type='text' class='form-control' id='dateFrom' name='dateFrom' value='<?=$dateFrom?>' required>                                            
                                        </div>
                                        <div class="form-group input-group col-xs-12">
                                            <label>Coupon end </label>
                                            <?php $dateTo = date('d-m-Y h:i:s',strtotime($couponData->dateTo));?>
                                            <input type='text' class='form-control' id='dateTo' name='dateTo' value='<?=$dateTo?>' required>                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Minimum Total Cart Ammount </label>
                                            <input type="text" name="minimumAmount" class="form-control" required value="<?=$couponData->minimumAmount?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Number of use / user</label>
                                            <input type="number" class="form-control" name="useCount" value="<?=$couponData->useCount?>" required>                                            
                                        </div>
                                       <div class="form-group">
                                            <label>Active?</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" checked="" value="1" id="optionsRadios1" <? if($couponData->active==1){?> checked='checked' <?}else{ ?> <? } ?> name="active">Yes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" id="optionsRadios2" <? if($couponData->active==0){?> checked='checked' <?}else{ ?> <? } ?> name="active">No
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
             <script type="text/javascript">
                $( document ).ready(function() {
                    var applyId = '<?=$couponData->applyId?>';
                    if(applyId !=''){
                        editApplyFields(applyId);
                     }
                    var couponVal = '<?=$couponData->couponValue?>';
                    var discountValue = '<?=$couponData->discountValue?>';
                    if(couponVal !=''){
                        editCouponMethodFields('<?=$couponData->methodId?>','<?=$couponData->couponValue?>');
                    }
                    if(discountValue !=''){
                        editCouponTypeFields('<?=$couponData->typeId?>','<?=$couponData->discountValue?>');
                    }    

                });
                $(function(){

                        $('#dateFrom').datetimepicker({
                            format: 'DD-MM-YYYY HH:mm:ss',
                        });
                        $('#dateTo').datetimepicker({
                            format: 'DD-MM-YYYY HH:mm:ss',
                        });
                });
                // $(document).on('dp.change', '#dateFrom', function (e) {
                //     $('#dateTo').data("DateTimePicker").minDate(e.date);
                //     $('#dateFrom').val(e.currentTarget.value);
                // });
                // $(document).on('dp.change', '#dateTo', function (e) {
                //     $('#dateFrom').data("DateTimePicker").maxDate(e.date);
                //     $('#dateTo').val(e.currentTarget.value);
                // });
                 function editApplyFields(ele){
                    var id = ele;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadApplyFieldForm&id="+id,
                        success: function(msg){       
                            $('#applyFieldForm').html(msg);                                              
                        }
                    });
                }

                function editCouponTypeFields(ele,discountCodeValue){
                     var id = ele;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadCouponTypeFieldsForm&id="+id+"&discountValue="+discountCodeValue,
                        success: function(msg){       
                            $('#typeFieldForm').html(msg);                                              
                        }
                    });
                }
                function editCouponMethodFields(ele,couponCodeVal){
                    var id = ele;
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=loadCouponMethodFieldsForm&id="+id+"&couponCodeVal="+couponCodeVal,
                        success: function(msg){       
                            $('#methodFieldForm').html(msg);                                              
                        }
                    });
                }

                function checkCouponCode(couponcode){
                    var id = '<?=$couponData->id?>';
                    $.ajax({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=checkCouponCode&code="+couponcode+"&id="+id,
                        success: function(msg){  
                            if(msg=='codeExits'){
                                $('#couponCodeVal').css('border','1px solid #ff0000'); 
                                $('#couponExits').html('Coupon code already used!');     
                            }else{
                                $('#couponCodeVal').css('border','1px solid #ccc'); 
                                $('#couponExits').html('');   
                            }                                        
                        }
                    });
                }

                function removeCouponProduct(id,pid){
                    if(confirm("Are you sure you want to remove ?")){
                        $.ajax({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=removeCouponProduct&id="+id+"&pid="+pid,
                            success: function(msg){  
                                if(msg=='success'){
                                    $('#couponPrd_'+pid).css('display','none'); 
                                        
                                }else{
                                    $('#removeCouponCatid').html('Error while removing please try again!');   
                                }                                      
                            }
                        });
                    }    
                }

                function removeCouponCategory(id,cid){
                    if(confirm("Are you sure you want to remove ?")){
                        $.ajax({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=removeCouponCategory&id="+id+"&cid="+cid,
                            success: function(msg){ 
                             
                                if(msg=='success'){
                                    $('#couponCat_'+cid).css('display','none'); 
                                        
                                }else{
                                    $('#removeCouponCatid').html('Error while removing please try again!');   
                                }                                        
                            }
                        });
                    }
                }
            </script>

        <?
    }

    function updateNewCoupon(){
        $db = new DB();
        if($db->filter($_POST['couponMethod'])=='1'){
            $query = "SELECT id FROM ".COUPONS." WHERE couponValue = '".$db->filter($_POST['couponValue'])."' AND id != '".$_POST['couponId']."'";
            $results = $db->num_rows( $query );
            if($results > 0){
                return false;
                exit;
            }
        }
        $data = array(
            'typeId' => $db->filter($_POST['couponType']),
            'methodId' => $db->filter($_POST['couponMethod']),
            'applyId' => $db->filter($_POST['couponApply']),
            'name' => $db->filter($_POST['name']),
            'description' => $db->filter($_POST['description']),
            'discountValue' => $db->filter($_POST['discountValue']),
            'couponValue' => $db->filter($_POST['couponValue']),
            'dateFrom' => date('Y-m-d H:i:s', strtotime($db->filter($_POST['dateFrom']))),
            'dateTo' => date('Y-m-d H:i:s', strtotime($db->filter($_POST['dateTo']))),
            'useCount' => $db->filter($_POST['useCount']),
            'active' => $db->filter($_POST['active']),
            'minimumAmount' => $db->filter($_POST['minimumAmount'])
        );

        $where_clause = array(
            'id' => $_REQUEST['couponId']
        );

        $updated = $db->update(COUPONS, $data, $where_clause, 1 );
        if($updated){
            $query = "SELECT productIds FROM ".COUPONS." WHERE id='".$_REQUEST['id']."'";
            $productIds = $db->get_row($query, true);
            $newproductsIds = $productIds->productIds.$db->filter($_POST['productIds']);
            if($productIds->productIds !=''){
                    $newproductsIds = $productIds->productIds.','.$db->filter($_POST['productIds']);
                }else{
                    $newproductsIds = $db->filter($_POST['productIds']);
                }
            if(isset($_POST['productIds']) && $_POST['productIds']!=''){
                $update = array(
                      'productIds'=> $newproductsIds
                );
                $where_clause = array(
                    'id' => $_REQUEST['couponId']
                );
                $updated = $db->update(COUPONS, $update, $where_clause, 1 );

            }else if(isset($_POST['categoryIds']) && $_POST['categoryIds']!=''){
                $query = "SELECT categoryIds FROM ".COUPONS." WHERE id='".$_REQUEST['id']."'";
                $categoryIds = $db->get_row($query, true);
                if($categoryIds->categoryIds !=''){
                    $newcategoryIds = $categoryIds->categoryIds.','.$db->filter($_POST['categoryIds']);
                }else{
                    $newcategoryIds = $db->filter($_POST['categoryIds']);
                }
                
                $update = array(
                      'categoryIds'=> $newcategoryIds
                );
                $where_clause = array(
                    'id' => $_REQUEST['couponId']
                );
                $updated = $db->update(COUPONS, $update, $where_clause, 1 );

            }
            return true;
        }else{
            return false;
        }
    }

    function removeCouponProduct(){
        $db = new DB();
        $query = "SELECT productIds FROM ".COUPONS." WHERE id='".$_REQUEST['id']."'";
        $productIds = $db->get_row($query, true);
        
        $parts = explode(',', $productIds->productIds);
        while(($i = array_search($_REQUEST['pid'], $parts)) !== false) {
            unset($parts[$i]);
        }
        $newProductIds = implode(',', $parts);
        
        $data = array('productIds' => $newProductIds );
        
        $where_clause = array(
            'id' => $_REQUEST['id']
        );

        $updated = $db->update(COUPONS, $data, $where_clause, 1 );
        if($updated){
            echo "success";
        }else{
            echo "fails";
        }
    }
    function removeCouponCategory(){
        $db = new DB();
        $query = "SELECT categoryIds FROM ".COUPONS." WHERE id='".$_REQUEST['id']."'";
        $categoryIds = $db->get_row($query, true);

        $parts = explode(',', $categoryIds->categoryIds);
        while(($i = array_search($_REQUEST['cid'], $parts)) !== false) {
            unset($parts[$i]);
        }
        $newcategoryIds = implode(',', $parts);
        
        $data = array('categoryIds' => $newcategoryIds );
        
        $where_clause = array(
            'id' => $_REQUEST['id']
        );

        $updated = $db->update(COUPONS, $data, $where_clause, 1 );
        if($updated){
            echo "success";
        }else{
            echo "fails";
        }
    }

    function manageReports(){
            $db = new DB();
        ?>
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reports</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Reports
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php date_default_timezone_set("Asia/Calcutta");
                                  $today  = date('d-m-Y', time()); ?>
                            <input type="text" class="form-control reportDate" id="reportDate" name="reportDate[]" value="<?=$today?>" placeholder="select date" style="width:15% !important; display:inline !important" placeholder="Report Date">   
                            <button class="btn btn-primary" onclick="getOrderReport('currentdate');">Get Report</button>
                           <!--   <button class="btn btn-warning" onclick="getOrderReport('30days');";>Last 30 day's Report</button>
                          <button class="btn btn-primary" onclick="getDate('today');";>Today</button>
                           <button class="btn btn-info" onclick="getDate('yesterday');";>Yesterday</button>
                           <button class="btn btn-warning" onclick="getDate('30days');";>Last 30 day's</button>
                           <div class="form-group" ><br/>
                                <input type="text" id="reportDisplayDate" class="form-control" readonly>
                            </div>
                           <input type="hidden" id="reportDate" name="reportDate"> -->
                        </div>
                        <div id="displayReport" style="padding:15px;"></div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <script type="text/javascript">
            $( document ).ready(function() {
               // $('#reportDisplayDate').hide();
                var nowDate = new Date();
                var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                
                $('.reportDate').datepicker({
                        format: 'dd-mm-yyyy',
                        endDate: '+0d',
                        autoclose: true
                 });
            });
            function getOrderReport(ele){
                var reportDate = $('#reportDate').val();
                if(ele == 'currentdate'){
                    if(reportDate == ''){
                        alert('Please select date');
                        return false;
                    }
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=getOrderReport&reportDate="+reportDate+"&duration="+ele,
                            success: function(msg){       
                                $('#displayReport').html(msg);                                                                                   
                            }
                        });

                }else if(ele == '30days'){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=getOrderReport&duration="+ele,
                            success: function(msg){       
                                $('#displayReport').html(msg);                                                                                   
                            }
                        });
                }
                
            }
                // function getDate(ele){
                //     var monthNames = [
                //       "January", "February", "March",
                //       "April", "May", "June", "July",
                //       "August", "September", "October",
                //       "November", "December"
                //     ];

                //     if(ele == 'today'){
                //         var nowDate = new Date();
                //         var day = nowDate.getDate();
                //         var monthIndex = nowDate.getMonth();
                //         var year = nowDate.getFullYear();
                //         var today = day +' '+ monthNames[monthIndex]+' '+year;
                //         $('#reportDisplayDate').val(today);
                //         $('#reportDate').val('today');
                //         $('#reportDisplayDate').fadeIn('slow');
                //     }else if(ele == 'yesterday'){
                //             var nowDate = new Date(); 
                //             var oneDayTimeStamp = 1000 * 60 * 60 * 24; // Milliseconds in a day
                //             var diff = nowDate - oneDayTimeStamp;
                //             var yesterdayDate = new Date(diff);
                //             var day = yesterdayDate.getDate();
                //             var monthIndex = yesterdayDate.getMonth();
                //             var year = yesterdayDate.getFullYear();
                //             var yesterday = day +' '+monthNames[monthIndex]+' '+year;
                //             $('#reportDisplayDate').val(yesterday);
                //             $('#reportDate').val('yesterday');
                //             $('#reportDisplayDate').fadeIn('slow');
                //     }else if(ele == '30days'){
                //         var nowDate = new Date(); 
                //         var monthTimeStamp = 1000 * 60 * 60 * 24 * 29; // Milliseconds in a 30 days
                //         var diff = nowDate - monthTimeStamp;
                //         var oneMonth = new Date(diff);
                //         var lastMonthDay = oneMonth.getDate();
                //         var lastMonthIndex = oneMonth.getMonth();
                //         var lastMonthYear = oneMonth.getFullYear();

                //         var day = nowDate.getDate();
                //         var monthIndex = nowDate.getMonth();
                //         var year = nowDate.getFullYear();
                //         var lastMonth = lastMonthDay +' '+ monthNames[lastMonthIndex]+' '+lastMonthYear +' - '+day +' '+monthNames[monthIndex]+' '+year;
                //         $('#reportDisplayDate').val(lastMonth);
                //         $('#reportDate').val('30days');
                //         $('#reportDisplayDate').fadeIn('slow');
                //     }
                // }
                

            </script>

        <?
    }

    function getOrderReport(){
         $db = new DB();
         $lastMonthDate = '';
         $duration = $db->filter($_POST['duration']);
         if($duration == 'currentdate'){
             $reportDate = $db->filter($_POST['reportDate']);
             list($dd, $mm, $yy) = explode('-', $reportDate);
             $dateTime = $yy.'-'.$mm.'-'.$dd;
             if($dateTime < '2016-07-21'){
                $query = "SELECT invoiceNo,fullName,totalAmount,offerAmt,couponDiscount,orderStatus,paymentType,deliveryDate,dateTime,source FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND dateTime LIKE '".$dateTime."%'";
             }else{
                $query = "SELECT invoiceNo,fullName,totalAmount,offerAmt,couponDiscount,orderStatus,paymentType,deliveryDate,dateTime,source FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND deliveryDate LIKE '".$dateTime."%'";
             }
             
         }else if($duration == '30days'){
            date_default_timezone_set("Asia/Calcutta");
            $today  = date('Y-m-d', time());
            $lastMonthDate = date('Y-m-d', strtotime('-30 days')); 
            if($dateTime < '2016-07-21'){
             $query = "SELECT invoiceNo,fullName,totalAmount,offerAmt,couponDiscount,orderStatus,paymentType,deliveryDate,dateTime,source FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND dateTime BETWEEN '".$lastMonthDate."%' AND '".$today."%'";
            }else{
             $query = "SELECT invoiceNo,fullName,totalAmount,offerAmt,couponDiscount,orderStatus,paymentType,deliveryDate,dateTime,source FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND deliveryDate BETWEEN '".$lastMonthDate."%' AND '".$today."%'";   
            }
         }
           $results = $db->get_results($query);
           if(count($results)>0){
         ?>
          <div class="dataTable_wrapper">
            <?php if($lastMonthDate !=''){ ?>
            <p class="text-center"> Orders from <b><?=date('d-m-Y',strtotime($lastMonthDate))?></b> to <b><?=date('d-m-Y',strtotime($today))?></b></p>
            <?php /* }else{ ?>
            <p class="text-center"> Orders on  <?=$reportDate?></p>
            <?php */ } ?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="8%">Sl. No.</th>
                        <th>Invoice</th>
                        <th>Name</th>
                        <th>Order status</th>
                        <th>Payment status</th>
                        <th>Ordered on</th>
                        <th>Delivered on</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>

                 <?php $slno = 1;
                       $grandTotal = 0;
                       $codTotal = 0;
                       $codCount = 0;
                       $onlineCount = 0;
                       $onlineTotal = 0;
                       $totalCount = 0;
                       $web = 0;
                       $android = 0;
                       $ios = 0;
                       $windows = 0;
                       foreach ($results as $result){
                             ?>
                    <tr class="odd gradeX" >
                        <td><?=$slno?></td>
                        <td><?=$result['invoiceNo']?></td>
                        <td><?=$result['fullName']?></td>
                        <td><?=$result['orderStatus']?></td>
                        <td><?=$result['paymentType']?></td>
                        <td><?=mdyDateFormat($result['dateTime'])?></td>
                        <td><?php if($result['deliveryDate'] !='' && $result['deliveryDate'] != '0000-00-00'){
                            echo mdyDateFormat($result['deliveryDate']);
                        } ?>
                        </td>
                        <td><?php $totalPay = $result['totalAmount'];
                                if($result['couponDiscount'] > 0){
                                    $totalPay = $totalPay  - $result['couponDiscount'];
                                }
                                if($result['offerAmt'] > 0){
                                    $totalPay = $totalPay - $result['offerAmt'];
                                }
                                if($totalPay < 0){
                                    $totalPay = 0;
                                }
                                if($result['paymentType'] == 'COD'){
                                  $codTotal += $totalPay; 
                                  $codCount++;
                                }else if($result['paymentType'] == 'Online'){
                                  $onlineTotal+= $totalPay;  
                                  $onlineCount++;
                                }
                                $totalCount++;
                                $grandTotal += $totalPay;
                            echo '&#36; '.number_format($totalPay, 2); ?>
                        </td>
                        
                         
                    </tr>
                    <?php if($result['source']=='web'){ $web +=1;}else if($result['source']=='android'){ $android +=1;}else if($result['source']=='ios'){ $ios +=1;}else if($result['source']=='windows'){ $windows +=1;} ?>
                 <? $slno++; } ?>
                </tbody>

            </table>
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr><th>Payment Type</th><th>Total Count</th><th>Total Amount</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>COD</td><td><?=$codCount?></td><td><?php echo '&#36; '.number_format($codTotal, 2); ?></td></tr>
                            <tr><td>Online paid</td><td><?=$onlineCount?></td><td><?php echo '&#36; '.number_format($onlineTotal, 2);?></td></tr>
                            <tr class="info"><td>Grand Total</td><td><?php echo $totalCount;?></td><td><?php echo '&#36; '.number_format($grandTotal, 2); ?></td></tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr><th>Source</th><th>Order Count</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Web</td><td><?=$web?></td></tr>
                            <tr><td>Android</td><td><?=$android?></td></tr>
                            <tr><td>ios</td><td><?=$ios?></td></tr>
                            <tr><td>Windows</td><td><?=$windows?></td></tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6"><p style="margin:5px 0 10px 0; padding-right:95px;text-align:right;font-size:20px;font-weight:normal;">Grand Total : &#36; <?=number_format($grandTotal, 2)?></p></div>
            </div>
            
        </div>
     <?php   
     }else{
        echo "<p class='text-center'>Delivered orders are not found!</p>";
     } 
    }


     function runCouponScript(){
        $db = new DB();

        for($i=51;$i<=550;$i++){
        
            $couponValue = 'UP'.mt_rand(1000, 9999);
            $newCouponValue = $this->checkCouponExit($couponValue);
            $data = array(
                'typeId' => '2',
                'methodId' => '1',
                'applyId' => '1',
                'name' => 'Chitki coupon code UP '.$i,
                'discountValue' => '10',
                'couponValue' => $newCouponValue,
                'dateFrom' => '2016-07-27 00:00:00',
                'dateTo' => '2016-08-30 23:59:59',
                'useCount' => '1',
                'active' => '1',
                'minimumAmount' => '0'
            );

            $rs = $db->insert(COUPONS, $data);
        }
     
    }

    function checkCouponExit($couponValue){
            $db = new DB();
            $query = "SELECT id FROM ".COUPONS." WHERE couponValue = '".$couponValue."'";
            $results = $db->num_rows( $query );
            if($results > 0){
                $couponValue = 'UP'.mt_rand(1000, 9999);
                return $this->checkCouponExit($couponValue);
                exit;
            }else{
                return $couponValue;
                exit;
            }
    }

    function sellingInfo(){
            $db = new DB();
        ?>
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">selling info</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           selling info
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            
                            <input class="sellingFromDate form-control" id="sellingFromDate" placeholder="Select start date" type="text" name="sellingFromDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                            <input class="sellingToDate form-control" id="sellingToDate" placeholder="Select end date" type="text" name="sellingToDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                            <div class="sellingInfoSuggest" style="width:25% !important; float:left !important;margin-right: 15px;" placeholder="Product name"></div>
                            <input type="hidden" name="sellingProductId" id="sellingProductId">
                            <button class="btn btn-primary" onclick="getsellingInfoDetails();">Search</button>
                        </div>
                        <div id="displayReport" style="padding:15px;"></div>
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
                var ord_name = $('.sellingInfoSuggest').magicSuggest({
                       //data: ['Paris', 'New York', 'Gotham']
                        data: 'get_productnames.php'
                    });
                $(ord_name).on('selectionchange', function(){
                        $('#sellingProductId').val(this.getValue());
                    });
            });
            $(document).ready(function() {
                $(".sellingFromDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $('.sellingToDate').datepicker('setStartDate', startDate);
                }).on('clearDate', function (selected) {
                    $('.sellingToDate').datepicker('setStartDate', null);
                });

                $(".sellingToDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var endDate = new Date(selected.date.valueOf());
                    $('.sellingFromDate').datepicker('setEndDate', endDate);
                }).on('clearDate', function (selected) {
                    $('.sellingFromDate').datepicker('setEndDate', null);
                });
               
            });
            function getsellingInfoDetails(ele){
                var sellingFromDate = $('#sellingFromDate').val();
                var sellingToDate = $('#sellingToDate').val();
                var sellingProductId = $('#sellingProductId').val();
                    if(sellingFromDate == '' || sellingToDate == '' || sellingProductId == ''){
                        alert('Please select the fields');
                        return false;
                    }
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=getsellingInfoDetails&sellingFromDate="+sellingFromDate+"&sellingToDate="+sellingToDate+"&sellingProductId="+sellingProductId,
                            success: function(msg){       
                                $('#displayReport').html(msg);                                                                                   
                            }
                        });
            }      
           </script> 
    <?php        
    }

    function getsellingInfoDetails(){
        $db = new DB();
        $sellingFromDate = $db->filter($_POST['sellingFromDate']);
        list($dd, $mm, $yy) = explode('-', $sellingFromDate);
        $sellingFromDate = $yy.'-'.$mm.'-'.$dd;
        $sellingToDate = $db->filter($_POST['sellingToDate']);
        list($dd, $mm, $yy) = explode('-', $sellingToDate);
        $sellingToDate = $yy.'-'.$mm.'-'.$dd;

        $sellingProductId = $db->filter($_POST['sellingProductId']);
        //$query = "SELECT id,totalAmount,offerAmt,couponDiscount,deliveryDate FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND deliveryDate BETWEEN '".$sellingFromDate."%' AND '".$sellingToDate."'";
        $query = "SELECT id FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND deliveryDate BETWEEN '".$sellingFromDate."%' AND '".$sellingToDate."%'";
        $orderIds = array();
        $results = $db->get_results($query);
        if(count($results)>0){
                foreach ($results as $value) {
                    $orderIds[] = $value['id']; 
                }
                $orderId = implode(',', $orderIds);

                $productUnits = "SELECT productWeight ,productUnit FROM ".PRODUCT_OPTIONS." WHERE productId = '".$sellingProductId."' AND active = '1'";
                $productUnitsResults = $db->get_results($productUnits);
                if(count($productUnitsResults)>0){
                ?>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="8%">Sl. No.</th>
                                <!-- <th>Delivered on</th>
                                <th>Product Name</th> -->
                                <th>Wt Unit</th>
                                <th>Qty</th>
                                <!-- <th>Unit Price</th> -->
                                <th>Total Weight</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php    
                $slno = 1;
                $grandTotal = 0; 
                $grandWtUnit = 0;       
                foreach ($productUnitsResults as $productUnitsValue) {
                    $query1 = "SELECT id,orderId,productName,productWeight,productUnit,unitPrice,quantity,productTotalPrice FROM ".ORDER_ITEMS." WHERE productId = '".$sellingProductId."' AND orderId IN(".$orderId.") AND active = '1' AND productWeight = '".$productUnitsValue['productWeight']."'  AND productUnit = '".$productUnitsValue['productUnit']."'";
                    $results1 = $db->get_results($query1);
                    if(count($results1)>0){
                        $orderQty = 0;
                        $productTotalPrice = 0;
                        $unitPrice = 0;
                        foreach ($results1 as $value1) { 
                            $orderQty += $value1['quantity'];
                            $unitPrice = $value1['unitPrice'];
                            $productTotalPrice += $value1['productTotalPrice'];
                        }
                    }else{ 
                        $orderQty = 0;
                        $productTotalPrice = 0;
                        $unitPrice = 0;
                    } ?>
                    <tr class="odd gradeX" >
                            <td><?=$slno?></td>
                            <!-- <td><?php if($orderDetails->deliveryDate !='' && $orderDetails->deliveryDate != '0000-00-00'){
                                echo mdyDateFormat($orderDetails->deliveryDate);
                            } ?>
                            </td> 
                            <td><?=$value1['productName']?></td>
                            -->
                            <?php $totalWtUnit = $productUnitsValue['productWeight'] * $orderQty;
                                   $unitWt = $productUnitsValue['productUnit']; 
                                  if($productUnitsValue['productUnit'] == 'gm' || $productUnitsValue['productUnit'] == 'gms'){
                                   $totalWtUnit = ($totalWtUnit/1000);
                                   $unitWt = 'kg';
                                  } 
                                  if($productUnitsValue['productUnit'] == 'ml'){
                                    $totalWtUnit = ($totalWtUnit/1000);
                                    $unitWt = 'ltr';
                                  }  
                             ?>
                            <td><?=$productUnitsValue['productWeight']?>&nbsp;<?=$productUnitsValue['productUnit']?></td>
                            <td><?=$orderQty?></td>
                            <!-- <td><?php echo '&#36; '.number_format($unitPrice, 2);?></td> -->
                            <td><?php echo $totalWtUnit.'&nbsp;'.$unitWt; ?></td>
                            <td><?php echo '&#36; '.number_format($productTotalPrice, 2); ?></td>
                            <?php $grandWtUnit += $totalWtUnit; ?>
                            <?php $grandTotal += $productTotalPrice; ?>
                       </tr>
                    <?php $slno++; } ?>
                        </tbody>

                    </table>
                    <div class="row">
                        
                        <div class="col-xs-12"><p style="margin:5px 0 10px 0; padding-right:95px;text-align:right;font-size:20px;font-weight:normal;">Total Weight: <?php echo $grandWtUnit.'&nbsp;'.$unitWt;?>&nbsp;&nbsp;&nbsp;&nbsp; Grand Total : &#36; <?=number_format($grandTotal, 2)?></p></div>
                    </div>
                    
                </div>
             <?php   
             }else{
                echo "<p class='text-center'>Orders are not found!</p>";
             } 
        }else{
            echo "<p class='text-center'>Orders are not found!</p>";
         } 
       // $query1 = "SELECT id,orderId,productName,productWeight,productUnit,unitPrice,quantity,productTotalPrice FROM ".ORDER_ITEMS." WHERE productId = '".$sellingProductId."' AND orderId IN(".$orderId.") AND active = '1'";
      
        //pre($orderIds);
    
  }

  function userOrderInfo(){
            $db = new DB();
        ?>
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users Order Info</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Users Order Info
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <input class="orderFromDate form-control" id="orderFromDate" placeholder="Select start date" type="text" name="orderFromDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                            <input class="orderToDate form-control" id="orderToDate" placeholder="Select end date" type="text" name="orderToDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                           <!--  <div class="sellingInfoSuggest" style="width:25% !important; float:left !important;margin-right: 15px;" placeholder="Product name"></div>
                            <input type="hidden" name="sellingProductId" id="sellingProductId"> -->
                            <select required class="form-control" id="userType" name="userType" style="width:25% !important; float:left !important;margin-right: 15px;">
                                <option value=''>Select Users Type</option>
                                <option value='active'>Active</option>
                                <option value='nonactive'>Non Active</option>
                            </select>   
                            <button class="btn btn-primary" onclick="getuserOrderInfoDetails();">Search</button>
                        </div>
                        <div id="displayReport" style="padding:15px;"></div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <script type="text/javascript">
            $(document).ready(function() {
                $(".orderFromDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $('.orderToDate').datepicker('setStartDate', startDate);
                }).on('clearDate', function (selected) {
                    $('.orderToDate').datepicker('setStartDate', null);
                });

                $(".orderToDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var endDate = new Date(selected.date.valueOf());
                    $('.orderFromDate').datepicker('setEndDate', endDate);
                }).on('clearDate', function (selected) {
                    $('.orderFromDate').datepicker('setEndDate', null);
                });
            });
            function getuserOrderInfoDetails(ele){
                var orderFromDate = $('#orderFromDate').val();
                var orderToDate = $('#orderToDate').val();
                var userType = $('#userType').val();
                    if(orderFromDate == '' || orderToDate == '' || userType == ''){
                        alert('Please select the fields');
                        return false;
                    }
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=getuserOrderInfoDetails&orderFromDate="+orderFromDate+"&orderToDate="+orderToDate+"&userType="+userType,
                            success: function(msg){       
                                $('#displayReport').html(msg);                                                                                   
                            }
                        });
            }      
           </script> 
    <?php
  }
  function getuserOrderInfoDetails(){
        $db = new DB();
        $orderFromDate = $db->filter($_POST['orderFromDate']);
        list($dd, $mm, $yy) = explode('-', $orderFromDate);
        $orderFromDate = $yy.'-'.$mm.'-'.$dd;
        $orderToDate = $db->filter($_POST['orderToDate']);
        list($dd, $mm, $yy) = explode('-', $orderToDate);
        $orderToDate = $yy.'-'.$mm.'-'.$dd;
        $userType = $db->filter($_POST['userType']);
        //$query = "SELECT id,totalAmount,offerAmt,couponDiscount,deliveryDate FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND deliveryDate BETWEEN '".$sellingFromDate."%' AND '".$sellingToDate."'";
        $allordersQuery = "SELECT userId FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered'";
        $allordersResults = $db->get_results($allordersQuery);
        $allOrdersUserIds = array();
        $inactiveUserIds = array(); 
        $activeUserIds = array();
            foreach ($allordersResults as $allordersValue) {
                $allOrdersUserIds[] = $allordersValue['userId']; 
            }
        $query = "SELECT userId FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND deliveryDate BETWEEN '".$orderFromDate."%' AND '".$orderToDate."%'";
        $results = $db->get_results($query);
        if(count($results)>0){
                foreach ($results as $value) {
                    $activeUserIds[] = $value['userId']; 
                }
                $activeUserId = implode(',', $activeUserIds);
                $inactiveUserIds = array_diff($allOrdersUserIds,$activeUserIds);
                if((count($inactiveUserIds) > 0 && $userType == 'nonactive')|| $userType == 'active' ){
                    $inactiveUserId = implode(',', $inactiveUserIds);
                    if($userType == 'active'){
                      $registredUsers = "SELECT userId,fullName ,email,mobileNumber FROM ".REGISTERED_USER." WHERE userId IN(".$activeUserId.") AND active = '1'";
                    }else if($userType == 'nonactive'){
                      $registredUsers = "SELECT userId,fullName ,email,mobileNumber FROM ".REGISTERED_USER." WHERE userId IN(".$inactiveUserId.") AND active = '1'";
                    }
                    $userCount = $db->num_rows($registredUsers);
                    $registredUsersResults = $db->get_results($registredUsers);
                    if(count($registredUsersResults)>0){
                    ?>
                   <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="8%">Sl. No.</th>
                                    <th>Order date</th>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Mobile Number</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php    
                            $slno = 1;
                            foreach ($registredUsersResults as $registredUsersValue) {
                                 $orderDate = $db->get_row("SELECT dateTime FROM ".ORDER_DETAILS." WHERE orderStatus = 'Delivered' AND userId = '".$registredUsersValue['userId']."' ORDER BY  dateTime DESC",true);
                                 $userOrdercount = $this->getUserOrderCount($registredUsersValue['userId']);
                                 ?>
                                <tr class="odd gradeX" >
                                        <td><?=$slno?></td>
                                        <td><?php if($orderDate->dateTime !=''){ echo stdDateFormat($orderDate->dateTime); } ?></td>
                                      
                                        <!-- <td><?php echo $orderDate->dateTime;  ?></td> -->
                                        <td><?=$registredUsersValue['fullName']?></td>
                                        <td><?=$registredUsersValue['email']?></td>
                                        <td><?=$registredUsersValue['mobileNumber']?></td>
                                        <td><a href="<?=APP_URL?>/index.php?page=manageUsersOrder&userId=<?=$registredUsersValue['userId']?>" title="See all orders"><i class="fa fa-th-list"></i></a>&nbsp;<span title="Save order">(<?=$userOrdercount?></span>)</td>
                                </tr>
                                <?php $slno++; } ?>
                            </tbody>

                        </table>
                           <p style="font-size: 18px;margin-right: 40px;margin-top: 60px;position: absolute;right: 0;top: 0;">Total Users : <?=$userCount?></p>                
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#dataTables-example').DataTable({
                                    responsive:true,
                                    iDisplayLength: 50,
                                   // "order": [[ 5, "asc" ]],
                                    "columnDefs": [
                                                { "orderable": false, "targets": 2 }
                                             ]
                            });
                        });
                    </script>
                 <?php   
                 }else{
                    echo "<p class='text-center'>Orders are not found!</p>";
                 } 
            }else{
              echo "<p class='text-center'>Orders are not found!</p>";
            }  
        }else{
          echo "<p class='text-center'>Orders are not found!</p>";
        } 
    }

    function runOrderDetailsScript(){
        $db = new DB();
        $orderResults = $db->get_results("SELECT id,dateTime FROM ".ORDER_DETAILS." WHERE orderStatus != 'Delivered' AND orderStatus != 'Cancel' AND invoiceNo !='' AND dateTime < '2016-09-01 01:00:00' ");
       //pre($orderResults);
        foreach ($orderResults as $value) {
           $deliveryDate = date('Y-m-d',strtotime($value['dateTime']));
           $data = array(
            'deliveryDate' => $deliveryDate,
            'orderStatus' => 'Delivered'         
        );

        $where_clause = array(
            'id' => $value['id']
        );
        $updated = $db->update(ORDER_DETAILS, $data, $where_clause, 1 );
        }
    }

    function movingProductInfo(){        
        $db = new DB();
        $categories = $this->getAllProductCategories();
        ?>
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Fastest Moving Products</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Order Info
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <input class="orderFromDate form-control" id="orderFromDate" placeholder="Select start date" type="text" name="orderFromDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                            <input class="orderToDate form-control" id="orderToDate" placeholder="Select end date" type="text" name="orderToDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                           <!--  <div class="sellingInfoSuggest" style="width:25% !important; float:left !important;margin-right: 15px;" placeholder="Product name"></div>
                            <input type="hidden" name="sellingProductId" id="sellingProductId"> -->
                           <?
                                $this->categoryTree($categories, 0, 0, '-','products'); 
                            ?>
                            <select name="categoryId" required class="form-control" id="categoryId" style="width:25% !important; float:left !important;margin-right: 15px;">
                                <option value="all">All</option>
                               <?php echo $categories ?>
                            </select>
                            <select required class="form-control" id="stockType" name="stockType" style="width:25% !important; float:left !important;margin-right: 15px;">
                                <option value='all'>All</option>
                                <option value='outofstock'>Out of stock</option>                                
                            </select>
                            <button class="btn btn-primary" onclick="getmovingProductInfoDetails();">Search</button>
                        </div>
                        <div id="displayReport" style="padding:15px;"></div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <script type="text/javascript">
            $(document).ready(function() {
                $(".orderFromDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $('.orderToDate').datepicker('setStartDate', startDate);
                }).on('clearDate', function (selected) {
                    $('.orderToDate').datepicker('setStartDate', null);
                });

                $(".orderToDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var endDate = new Date(selected.date.valueOf());
                    $('.orderFromDate').datepicker('setEndDate', endDate);
                }).on('clearDate', function (selected) {
                    $('.orderFromDate').datepicker('setEndDate', null);
                });
            });
            function getmovingProductInfoDetails(ele){
                var orderFromDate = $('#orderFromDate').val();
                var orderToDate = $('#orderToDate').val();
                var stockType = $('#stockType').val();
                var categoryId = $('#categoryId').val();
                    if(orderFromDate == '' || orderToDate == '' || stockType == '' || categoryId ==''){
                        alert('Please select the fields');
                        return false;
                    }
                    $('#displayReport').html("<p class='text-center'><img src='images/loader.gif' style=''/></p>").fadeIn('fast');
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=getmovingProductInfoDetails&orderFromDate="+orderFromDate+"&orderToDate="+orderToDate+"&stockType="+stockType+"&categoryId="+categoryId,
                            success: function(msg){       
                                $('#displayReport').html(msg);                                                                                   
                            }
                        });
            }      
           </script> 
    <?php
  }

    function getmovingProductInfoDetails(){
        $db = new DB();
        $orderFromDate = $db->filter($_POST['orderFromDate']);
        list($dd, $mm, $yy) = explode('-', $orderFromDate);
        $orderFromDate = $yy.'-'.$mm.'-'.$dd;
        $orderToDate = $db->filter($_POST['orderToDate']);
        list($dd, $mm, $yy) = explode('-', $orderToDate);
        $orderToDate = $yy.'-'.$mm.'-'.$dd;
        $stockType = $db->filter($_POST['stockType']);
        $categoryId = $db->filter($_POST['categoryId']);
        if($categoryId =='all'){
            $catQuery = " ";
        }else{
            $catQuery = " AND products.categoryId = '".$categoryId."'";
        }
        if($stockType == 'outofstock'){
           $query = "SELECT products.id,products.productName,product_categories.categoryName,count(order_items.productId) AS prdCount FROM ".PRODUCTS." LEFT JOIN order_items ON (order_items.productId = products.id) LEFT JOIN order_details ON (order_details.id = order_items.orderId) LEFT JOIN product_categories ON (product_categories.id = products.categoryId) WHERE products.active ='1' ".$catQuery." AND products.productStock < 1 AND order_details.orderStatus = 'Delivered' AND order_details.deliveryDate BETWEEN '".$orderFromDate."%' AND '".$orderToDate."%' GROUP BY products.id ORDER BY prdCount DESC";
        }else{
           $query = "SELECT products.id,products.productName,product_categories.categoryName,count(order_items.productId) AS prdCount FROM ".PRODUCTS." LEFT JOIN order_items ON (order_items.productId = products.id) LEFT JOIN order_details ON (order_details.id = order_items.orderId) LEFT JOIN product_categories ON (product_categories.id = products.categoryId) WHERE products.active ='1' ".$catQuery." AND order_details.orderStatus = 'Delivered' AND order_details.deliveryDate BETWEEN '".$orderFromDate."%' AND '".$orderToDate."%' GROUP BY products.id ORDER BY prdCount DESC";
       }
        
        $results = $db->get_results($query);
        if(count($results)>0){               
                    ?>
                   <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="8%">Sl. No.</th>
                                    <th width="45%">Product Name</th> 
                                    <th>Category</th>  
                                    <th>No of orders</th>                                 
                                </tr>
                            </thead>
                            <tbody>
                            <?php    
                            $slno = 1;
                            foreach ($results as $row) {
                                  ?>
                                <tr class="odd gradeX" >
                                        <td><?=$slno?></td>
                                        <td><?=$row['productName']?></td>
                                        <td><?=$row['categoryName']?></td>
                                        <td><?=$row['prdCount']?></td>
                               </tr>
                                <?php $slno++; } ?>
                            </tbody>

                        </table>
                    </div>
                     <script>
                        $(document).ready(function() {
                            $('#dataTables-example').DataTable({
                                    responsive:true,
                                    iDisplayLength: 50,
                                   // "order": [[ 5, "asc" ]],
                                    "columnDefs": [
                                                { "orderable": false, "targets": 2 }
                                             ]
                            });
                        });
                    </script>
                 <?php                 
            }else{
              echo "<p class='text-center'>Orders are not found!</p>";
            } 
    }

    function viewCategoryStockDetails($parentCategory){
        $db = new DB();
        $query = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE active ='1' AND parentCategory ='".$parentCategory."'";
        if($db->num_rows($query)>0){
            $categories = $db->get_results($query);
            foreach ($categories as $category) {
                $totalProducts = $db->get_row("SELECT count(id) as pid FROM ".PRODUCTS." WHERE categoryId ='".$category['id']."' AND  active ='1'",true);
                $outofstockProducts = $db->get_row("SELECT count(id) as outofstockId FROM ".PRODUCTS." WHERE productStock < 1 AND categoryId ='".$category['id']."' AND  active ='1'",true);
                $instockProducts = $db->get_row("SELECT count(id) as instockId FROM ".PRODUCTS." WHERE productStock > 0 AND categoryId ='".$category['id']."' AND  active ='1'",true);
                @$outStockPercent = ((100 * $outofstockProducts->outofstockId)/$totalProducts->pid);
                @$inStockPercent = ((100 * $instockProducts->instockId)/$totalProducts->pid);
                if(!$outStockPercent > 0){
                  $outStockPercent = 0;  
                }
                if(!$inStockPercent > 0){
                  $inStockPercent = 0;  
                }
                 ?>
                <div class="row catStockBlock">
                    <div class="col-xs-4"><?=$category['categoryName']?> </div>  
                    <div class="col-xs-8">
                        <div class="stock-fill">
                            <span class="outofstock" style="width:<?=$outStockPercent?>%;" title="Out of stock <?=round($outStockPercent,2)?>%"><?=round($outStockPercent,2)?>%</span>
                            <span class="instock" style="width:<?=$inStockPercent?>%;" title="In stock <?=round($inStockPercent,2)?>%"><?=round($inStockPercent,2)?>%</span>
                        </div>
                    </div>
                </div>
                
            <?php 
                $this->viewCategoryStockDetails($category['id']);
            } 
        }                               
    }
    function viewCategoryStock(){
         $db = new DB();
        $query = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE active ='1' AND parentCategory ='0'";
        $categories = $db->get_results($query);        
        ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category Stocks</h1>
            </div>              
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       View Category Stocks
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <?php                                 
                                foreach ($categories as $category) {
                                    $countquery = "SELECT * FROM ".PRODUCT_CATEGORIES." WHERE active ='1' AND parentCategory ='".$category['id']."'";
                                    $subCatCount = $db->num_rows($countquery);
                                    $totalProducts = $db->get_row("SELECT count(id) as pid FROM ".PRODUCTS." WHERE categoryId ='".$category['id']."' AND  active ='1'",true);
                                    $outofstockProducts = $db->get_row("SELECT count(id) as outofstockId FROM ".PRODUCTS." WHERE productStock < 1 AND categoryId ='".$category['id']."' AND  active ='1'",true);
                                    $instockProducts = $db->get_row("SELECT count(id) as instockId FROM ".PRODUCTS." WHERE productStock > 0 AND categoryId ='".$category['id']."' AND  active ='1'",true);
                                    @$outStockPercent = ((100 * $outofstockProducts->outofstockId)/$totalProducts->pid);
                                    @$inStockPercent = ((100 * $instockProducts->instockId)/$totalProducts->pid);
                                    if(!$outStockPercent > 0){
                                      $outStockPercent = 0;  
                                    }
                                    if(!$inStockPercent > 0){
                                      $inStockPercent = 0;  
                                    }
                                     ?>
                                <div class="row catStockBlock">
                                    <div class="col-xs-4"><b><?=$category['categoryName']?></b> </div>  
                                    <div class="col-xs-8 catParentChart">
                                        <?php if(!$subCatCount > 0){ ?>
                                        <div class="stock-fill">
                                            <span class="outofstock" style="width:<?=$outStockPercent?>%;" title="Out of stock <?=round($outStockPercent,2)?>%"><?=round($outStockPercent,2)?>%</span>
                                            <span class="instock" style="width:<?=$inStockPercent?>%;" title="In stock <?=round($inStockPercent,2)?>%"><?=round($inStockPercent,2)?>%</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="catStockSubBlockWrap">
                            <?php 
                                $this->viewCategoryStockDetails($category['id']);
                                ?>
                            </div>
                                <?php
                                }
                            ?>
                              
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
         <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive:true,
                        iDisplayLength: 100,
                       // "order": [[ 5, "asc" ]],
                        "columnDefs": [
                                    { "orderable": false, "targets": 2 }
                                 ]
                });               
            });
        </script>
        <?php
    }


    function viewNewUserStatus(){
               $db = new DB();
        ?>
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="http://www.chartjs.org/assets/Chart.js"></script>
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View New User Status</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           View New User Status
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <input class="orderFromDate form-control" id="orderFromDate" placeholder="Select start date" type="text" name="orderFromDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                           <input class="orderToDate form-control" id="orderToDate" placeholder="Select end date" type="text" name="orderToDate" style="width:15% !important; float:left !important;margin-right: 15px;">
                           <!--  <div class="sellingInfoSuggest" style="width:25% !important; float:left !important;margin-right: 15px;" placeholder="Product name"></div>
                            <input type="hidden" name="sellingProductId" id="sellingProductId"> -->
                           <!--  <select required class="form-control" id="userType" name="userType" style="width:25% !important; float:left !important;margin-right: 15px;">
                                <option value=''>Select Users Type</option>
                                <option value='active'>Active</option>
                                <option value='nonactive'>Non Active</option>
                            </select>    -->
                            <button class="btn btn-primary" onclick="getNewUserStatusDetails();">Search</button>
                        </div>
                        <div id="displayReport" style="padding:15px;"></div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <script type="text/javascript">
            $(document).ready(function() {
                $(".orderFromDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $('.orderToDate').datepicker('setStartDate', startDate);
                }).on('clearDate', function (selected) {
                    $('.orderToDate').datepicker('setStartDate', null);
                });

                $(".orderToDate").datepicker({
                    format: 'dd-mm-yyyy',
                    endDate: '+0d',
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var endDate = new Date(selected.date.valueOf());
                    $('.orderFromDate').datepicker('setEndDate', endDate);
                }).on('clearDate', function (selected) {
                    $('.orderFromDate').datepicker('setEndDate', null);
                });
            });
            function getNewUserStatusDetails(ele){
                var orderFromDate = $('#orderFromDate').val();
                var orderToDate = $('#orderToDate').val();
               
                    if(orderFromDate == '' || orderToDate == ''){
                        alert('Please select the fields');
                        return false;
                    }
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=getNewUserStatusDetails&orderFromDate="+orderFromDate+"&orderToDate="+orderToDate,
                            success: function(msg){       
                                $('#displayReport').html(msg);                                                                                   
                            }
                        });
            }      
           </script> 
    <?php
    }
    function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }
       
    function getNewUserStatusDetails(){
        date_default_timezone_set('Asia/Kolkata'); // CDT   
        $db = new DB();
        $orderFromDate = $db->filter($_POST['orderFromDate']);
        list($dd, $mm, $yy) = explode('-', $orderFromDate);
        $orderFromDate = $yy.'-'.$mm.'-'.$dd;
        $orderToDate = $db->filter($_POST['orderToDate']);
        list($dd, $mm, $yy) = explode('-', $orderToDate);
        $orderToDate = $yy.'-'.$mm.'-'.$dd;     
        $start_date = date('Y-m-d', strtotime($orderFromDate));
        $end_date = date('Y-m-d', strtotime( $orderToDate));
        $end_date1 = date('Y-m-d', strtotime( $orderToDate.' + 6 days'));
        $query = "SELECT id FROM ".USERS." WHERE dateTime BETWEEN '".$orderFromDate."%' AND '".$orderToDate."%'";
        $totalUserCount = $db->num_rows($query);

        for($date = $start_date; $date <= $end_date; $date = date('Y-m-d', strtotime($date. ' + 7 days')))
        {
            $week =  date('W', strtotime($date));
            $year =  date('Y', strtotime($date));
            $from = date("Y-m-d", strtotime("{$year}-W{$week}+1")); //Returns the date of monday in week
            if($from < $start_date) $from = $start_date;
            $to = date("Y-m-d", strtotime("{$year}-W{$week}-6"));   //Returns the date of sunday in week
            if($to > $end_date) $to = $end_date;
            $query = "SELECT id FROM ".USERS." WHERE dateTime BETWEEN '".$from."%' AND '".$to."%'";            
            $userData .= $db->num_rows($query).',';
            //$userLabel .= date("jS D M",strtotime($from)).''.date("jS D M",strtotime($to));
            
            $weekNoFormat = $this->getWeeks($to, "sunday");
            if($weekNoFormat==1){$suffix='st';}elseif ($weekNoFormat==2) { $suffix='nd'; }elseif($weekNoFormat==3){$suffix='rd';}else{ $suffix='th'; }     
            $userLabel .= $weekNoFormat.''.$suffix.' '.date('M',strtotime($to)).',';
            
        }
        $userData = rtrim($userData,',');        
        $userLabel = rtrim($userLabel,',');
       // echo $weekNotxt;
        
        // $query = "SELECT id FROM ".USERS." WHERE dateTime BETWEEN '".$orderFromDate."%' AND '".$orderToDate."%'";
        // $userCount = $db->num_rows($query);
       // if(count($userCount )>0){                
            ?>
           <div class="dataTable_wrapper">                
                   <p style="font-size: 18px;margin-right: 40px;margin-top: 60px;">Total Users : <?=$totalUserCount?></p>       
                   <!-- <canvas id="orderChart" width="1000" height="400"></canvas> -->
                   <canvas id="myChart" width="800" height="400"></canvas>
                   <script type="text/javascript">
                     //var userData = '1,2,3,4,5,6';
                     var uservalue = "<?php echo $userData; ?>";
                     var temp = new Array();
                     temp = uservalue.split(",");
                     for (a in temp ) {
                        temp[a] = parseInt(temp[a], 10); // Explicitly include base as per Álvaro's comment
                    }
                   
                     var label = '<?php echo $userLabel; ?>';
                     var temp1 = new Array();
                     temp1 = label.split(","); 
                     console.log(label);
                     
                     //userData = parseInt(userData);
                     // var orderData = {
                     //    labels : temp1,
                     //    xAxisLabel: "test",                    
                     //    datasets :
                     //     [
                     //        {
                     //          fillColor : "rgba(172,194,132,0.4)",
                     //          strokeColor : "#ACC26D",
                     //          pointColor : "#fff",
                     //          pointStrokeColor : "#9DB86D",
                     //          data : temp
                     //        }
                     //     ]
                     //    }
                     //    options = {
                     //      scales: {
                     //        yAxes: [{
                     //          scaleLabel: {
                     //            display: true,
                     //            labelString: 'probability'
                     //          }
                     //        }]
                     //      }     
                     //    }
                     //    var orderChart = document.getElementById('orderChart').getContext('2d');
                     //    new Chart(orderChart).Line(orderData, options);



                        Chart.types.Line.extend({
                          name: "LineAlt",
                          initialize: function (data) {
                            this.chart.height -= 30;

                            Chart.types.Line.prototype.initialize.apply(this, arguments);

                            var ctx = this.chart.ctx;
                            ctx.save();
                            // text alignment and color
                            ctx.textAlign = "center";
                            ctx.textBaseline = "bottom";
                            ctx.fillStyle = this.options.scaleFontColor;
                            // position
                            var x = this.chart.width / 2;
                            var y = this.chart.height + 15 + 5;
                            // change origin
                            ctx.translate(x, y)
                            ctx.fillText("Week Number", 0, 0);
                            ctx.restore();
                          }
                        });


                        var data = {
                          labels : temp1,
                          xAxisLabel: "",
                          datasets: [
                            {
                              label: "",
                              fillColor : "rgba(172,194,132,0.4)",
                              strokeColor : "#ACC26D",
                              pointColor : "#fff",
                              pointStrokeColor : "#9DB86D",
                              pointHighlightFill: "#fff",
                              pointHighlightStroke: "rgba(220,220,220,1)",
                              data: temp
                            }
                          ]
                        };

                        var ctx = document.getElementById('myChart').getContext('2d');
                        new Chart(ctx).LineAlt(data);
                </script>         
            </div>             
         <?php               
        //} 
    }

    function productKeywords(){
       $db = new DB();
       $arrKeywords = array();
       $result = $db->get_results("SELECT productName FROM ".PRODUCTS." WHERE active='1'");
       $productName = '';
       foreach ($result as $row) {
           if($row['productName']!=''){ 
               $productName = $row['productName'].' '; 
               $subs = get_all_substrings($productName, " ");
               $arrKeywords = array_merge($arrKeywords, $subs);
            }
        } 
        file_put_contents("../keywords.txt", (serialize($arrKeywords)."<!-- E -->"), FILE_APPEND);       
    }


    function manageIngredients(){

            $db = new DB();

            $query = "SELECT * FROM ".INGREDIENTS." ORDER BY id ASC";
            $results = $db->get_results($query);
        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Ingredients</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Ingredients
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Ingredient Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                      $db = new DB();

                                   
                                     if(count($results)>0){
                                     foreach ($results as $result) {

                                        $qry = "SELECT * FROM ".PRODUCTS." WHERE id='".$result['product_id']."'";
                                        $productData = $db->get_row( $qry, true );

                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$productData->productName?></td>
                                            <td><?=$result['title']?></td>
                                            <td><img src="<?=INGREDIENT_THUMBNAIL_PATH?>/<?=$result['image']?>"></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editIngredients&ingredientId=<?=$result['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                                <?php if($result['active'] == '1'){ echo " <span class='prodActive' title='Active'>#A</span>";} ?>
                                                <?php if($result['active'] == '0'){ echo " <span class='prodInactive' title='Inactive'>#I</span>";} ?>
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


    function addNewIngredients(){

        $db = new DB();
        $query = "SELECT id, productName FROM ".PRODUCTS." ORDER BY productName ASC";
        $results = $db->get_results($query);
        // pre($results);                            
        ?>

        <script type="text/javascript">

            $( document ).ready(function() {
           
            var ingredientsVal=0;

            $('#addMoreIngredientsElement').click(function(){
                var content = $(this).attr("data-val");
                ingredientsVal=ingredientsVal + 1;
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var ingredientsId = content+ingredientsVal;
                newTBDiv.setAttribute("id",ingredientsId);
                newTBDiv.innerHTML+="<div class='form-group'><label>Ingredient Name</label><input type='text' class='form-control' name='title[]'></div><div class='form-group'><label>Description</label><textarea class='form-control' name='description[]'></textarea></div><div class='form-group'><label>Ingredient Photo</label><br/><input type='file' name='image[]' accept='image/png, image/jpeg' style='width:50% !important; display:inline !important'></div> ";
                contentID.appendChild(newTBDiv);
                
            });

            $('#removeIngredientsElement').click(function(){
                var content = $(this).attr("data-val");           
                if(ingredientsVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+ingredientsVal));
                    ingredientsVal = ingredientsVal-1;
                }
            });

            // var upload_number = 1;
            // $('#addFileInput').click(function(){
            
            //     var d = document.createElement("div");
            //     var file = document.createElement("input");
            //     file.setAttribute("type", "file");
            //     file.setAttribute("name", "productPhotos[]");
            //     file.setAttribute("class", "file_1");
            //     file.setAttribute("accept", "image/png, image/jpeg");
            //     d.appendChild(file);
            //     document.getElementById("moreUploads").appendChild(d);
                
            //     upload_number++;
            //     document.getElementById("uploadsNeeded").value=upload_number;
            
            // });

            $('#addProductForm').on('submit', function(e){
               for(var i=0; i <= costPerWtVal; i++){
                    cost = $('#productCost_'+i).val();
                    mrp = $('#productMRP_'+i).val();
                    offer = $('#productOffer_'+i).val();
                    if(offer.length>0 && offer!=0){
                        if(cost != mrp){
                            var optno = parseInt(i)+parseInt(1);
                            alert("Product cost and MRP doesnot match in product option -> "+optno );
                            return false;
                        }
                    }
               }
               return;
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
        <link href="css/magicsuggest-min.css" rel="stylesheet">
        <script src="js/magicsuggest-min.js"></script>   
        
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ingredients</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Ingredients
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" name="product_form" id="addProductForm" method="post" role="form" enctype="multipart/form-data" >            
                                        <input type="hidden" name="action" value="saveNewIngredients" />

                                        <div class="form-group">
                                            <label>Products</label>
                                           <select name="productId" class="form-control" required>
                                                <option value="">SELECT</option>
                                                <?foreach($results as $products){?>
                                                    <option value="<?=$products['id']?>"><?=$products['productName']?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>Ingredient Name</label>
                                            <input type="text" maxlength="50" class="form-control" name="title[]">
                                        </div> 

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description[]"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Ingredient Photo</label><br/>
                                            <input type="file" name="image[]" accept="image/png, image/jpeg" style="width:50% !important; display:inline !important"> 
                                            <a href="javascript:void(0);" id="addMoreIngredientsElement" data-val="moreIngredient" Title="Add more Ingredients"><i class="fa fa-plus-square fa-lg"></i></a>
                                            <a href="javascript:void(0);" id="removeIngredientsElement" data-val="moreIngredient" Title="Remove Ingredients"><i class="fa fa-minus-square fa-lg"></i></a>
                                        </div>

                                        <div class='moreIngredient' id="moreIngredient">
                                            
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
                                        
                                        
                                        <button type="submit" class="btn btn-default" >Submit</button>
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
            
           <script type="text/javascript">
                $(function(){
                   
                  var ms = $('.productOffers').magicSuggest({
                        data: 'get_productoffers.php',
                        maxSelection: null
                    });
                  $(ms).on('selectionchange', function(){
                      $('#productOfferId').val(this.getValue());
                    });
                   
                });
            </script>
            <!-- /.row -->
     <?
    }

    function saveNewIngredients(){

        $db = new DB();

        $data = $_POST;
        $file = $_FILES;
        $date = date("shdmy");

        $ingredientTitle = $db->filter($_POST['title']);
        $description   = $db->filter($_POST['description']);
        $i=0;
        foreach($ingredientTitle as $title){

            if(isset($file['image']['size'][$i]) && $file['image']['size'][$i] > 0){
                        
                $imagename = 'beauty-mineral_'.$date.'_'.$file['image']['name'][$i];
                $imagename1 = SITE_URL."/ingredientFiles/images/".$imagename; 
                
                $uploadedfile = $file['image']['tmp_name'][$i];
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
                
                $newwidth=125;
                $newheight=125;
                $tmp=imagecreatetruecolor($newwidth,$newheight);
                imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                $filename = "ingredientFiles/images/thumb/".$imagename;
                imagejpeg($tmp,$filename,100);

                move_uploaded_file($file['image']['tmp_name'][$i], "ingredientFiles/images/".$imagename);

            }

            $records = array(
                'product_id' => $_POST['productId'],
                'title' => $ingredientTitle[$i],
                'description' => $description[$i],
                'image' => $imagename
               
            );

            // exit;

            $inserted = $db->insert(INGREDIENTS, $records);

            $i++;
        }
        return true;
    }

    function editIngredients($ingredientId){

        $db = new DB();
        $query = "SELECT id, productName FROM ".PRODUCTS." ORDER BY productName ASC";
        $results = $db->get_results($query);
        // pre($results);  

        $sql = "SELECT * FROM ".INGREDIENTS." WHERE id='".$ingredientId."' ORDER BY id ASC";
        $ingredientData = $db->get_row($sql, ture);                          
    ?>

        <script type="text/javascript">

            $( document ).ready(function() {
           
            var ingredientsVal=0;

            $('#addMoreIngredientsElement').click(function(){
                var content = $(this).attr("data-val");
                ingredientsVal=ingredientsVal + 1;
                var contentID = document.getElementById(content);
                var newTBDiv = document.createElement("div");
                var ingredientsId = content+ingredientsVal;
                newTBDiv.setAttribute("id",ingredientsId);
                newTBDiv.innerHTML+="<div class='form-group'><label>Ingredient Name</label><input type='text' class='form-control' name='title[]'></div><div class='form-group'><label>Description</label><textarea class='form-control' name='description[]'></textarea></div><div class='form-group'><label>Ingredient Photo</label><br/><input type='file' name='image[]' accept='image/png, image/jpeg' style='width:50% !important; display:inline !important'></div> ";
                contentID.appendChild(newTBDiv);
                
            });

            $('#removeIngredientsElement').click(function(){
                var content = $(this).attr("data-val");           
                if(ingredientsVal != 0){
                    var contentID = document.getElementById(content);
                    contentID.removeChild(document.getElementById(content+ingredientsVal));
                    ingredientsVal = ingredientsVal-1;
                }
            });

        
            $('#addProductForm').on('submit', function(e){
               for(var i=0; i <= costPerWtVal; i++){
                    cost = $('#productCost_'+i).val();
                    mrp = $('#productMRP_'+i).val();
                    offer = $('#productOffer_'+i).val();
                    if(offer.length>0 && offer!=0){
                        if(cost != mrp){
                            var optno = parseInt(i)+parseInt(1);
                            alert("Product cost and MRP doesnot match in product option -> "+optno );
                            return false;
                        }
                    }
               }
               return;
            }); 
 
        });
        
        function checkSploffer(){
            if ($('input#specialOffers').is(':checked')) {
                
                $('#offersDescription').fadeIn();
            }else{
               $('#offersDescription').fadeOut(); 
            }
        }

        function deleteIngredientPhoto(ingredientId){
            if(confirm("Are you sure you want to delete this?")){
                        $.ajax
                            ({
                                type: "POST",
                                url: "ajxHandler.php",
                                data: "action=deleteIngredientPhoto&ingredientId="+ingredientId,
                                success: function(msg){       

                                    if(msg=='success'){
                                        $('#row_'+ingredientId).css('display', 'none');
                                        window.location.reload(true);
                                    }                                                               
                                }
                            });
                    }
        }


        </script>

        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js"></script>
        <link href="css/magicsuggest-min.css" rel="stylesheet">
        <script src="js/magicsuggest-min.js"></script>   
        
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ingredients</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Ingredients
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" name="product_form" id="addProductForm" method="post" role="form" enctype="multipart/form-data" >            
                                        <input type="hidden" name="action" value="updateIngredients" />
                                        <input type="hidden" name="id" value="<?=$ingredientData->id?>" />

                                        <div class="form-group">
                                            <label>Products</label>
                                           <select name="productId" class="form-control" required>
                                                <option value="">SELECT</option>
                                                <?foreach($results as $products){?>
                                                    <option value="<?=$products['id']?>" <? if($products['id']==$ingredientData->product_id){ ?> selected <? } ?>><?=$products['productName']?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>Ingredient Name</label>
                                            <input type="text" maxlength="50" value="<?=$ingredientData->title?>" class="form-control" name="title">
                                        </div> 

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" row="5" name="description"><?=$ingredientData->description?></textarea>
                                        </div>

                                        <?if($ingredientData->image!=''){?>

                                            <div class="row" id="row_<?=$ingredientData->id?>">
                                                <img src="<?=INGREDIENT_THUMBNAIL_PATH?>/<?=$ingredientData->image?>" title="<?=$ingredientData->title?>">
                                                 <a href="javascript:void(0);" id="deleteIngredientPhoto" onclick="deleteIngredientPhoto('<?=$ingredientData->id?>');" data-val="<?=$ingredientData->id?>" Title="Delete Photo"><i class="fa fa-trash-o fa-lg"></i></a>
                                                <br>
                                            </div>
                                       
                                        <?}else{?>

                                            <div class="form-group">
                                                <label>Ingredient Photo</label><br/>
                                                <input type="file" name="image" accept="image/png, image/jpeg" style="width:50% !important; display:inline !important"> 
                                                <!-- <a href="javascript:void(0);" id="addMoreIngredientsElement" data-val="moreIngredient" Title="Add more Ingredients"><i class="fa fa-plus-square fa-lg"></i></a> -->
                                                <!-- <a href="javascript:void(0);" id="removeIngredientsElement" data-val="moreIngredient" Title="Remove Ingredients"><i class="fa fa-minus-square fa-lg"></i></a> -->
                                            </div>

                                        <?}?>

                                        <div class='moreIngredient' id="moreIngredient">
                                            
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
                                        
                                        
                                        <button type="submit" class="btn btn-default" >Submit</button>
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
            
           <script type="text/javascript">
                $(function(){
                   
                  var ms = $('.productOffers').magicSuggest({
                        data: 'get_productoffers.php',
                        maxSelection: null
                    });
                  $(ms).on('selectionchange', function(){
                      $('#productOfferId').val(this.getValue());
                    });
                   
                });
            </script>
            <!-- /.row -->
     <?
    }

    function deleteIngredientPhoto(){
        $db = new DB();

        $update = array(
            'image'=> ''

        );

        $where_clause = array(
            'id' => $_REQUEST['ingredientId']
        );

        $updated = $db->update(INGREDIENTS, $update, $where_clause, 1 );
        
        if($updated){
            echo 'success';
        }else{
            echo 'fail';
        }

    }

    function updateIngredients(){

        $db = new DB();

        $data = $_POST;
        $file = $_FILES;
        $date = date("shdmy");

        if(isset($file['image']['size']) && $file['image']['size'] > 0){
                    
            $imagename = 'beauty-mineral_'.$date.'_'.$file['image']['name'];
            $imagename1 = SITE_URL."/ingredientFiles/images/".$imagename; 
            
            $uploadedfile = $file['image']['tmp_name'];
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
            
            $newwidth=125;
            $newheight=125;
            $tmp=imagecreatetruecolor($newwidth,$newheight);
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
            $filename = "ingredientFiles/images/thumb/".$imagename;
            imagejpeg($tmp,$filename,100);

            move_uploaded_file($file['image']['tmp_name'], "ingredientFiles/images/".$imagename);

        }

        $update = array(
            'product_id' => $db->filter($_POST['productId']),
            'title' =>  $db->filter($_POST['title']),
            'description' => $db->filter($_POST['description']),
            'image' => $imagename
        );

        $where_clause = array(
            'id' => $_REQUEST['id']
        );

        $updated = $db->update(INGREDIENTS, $update, $where_clause, 1 );


        if($updated){
            return ture;
        }else{
            return false;
        }

    }


    function manageReview(){
            $db = new DB();

            $reviews = $this->getAllReviews();

        ?>

         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reviews</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Reviews
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Name</th>
                                            <th>Review Summary</th>
                                            <th>Review</th>
                                            <th>Review Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                     if(count($reviews)>0){
                                     foreach ($reviews as $review) {

                                        $qry = "SELECT * FROM ".PRODUCTS." WHERE id='".$review['product_id']."'";
                                        $productData = $db->get_row( $qry, true );
                                            
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?=$productData->productName?></td>
                                            <td><?=$review['nickname']?></td>
                                            <td><?=$review['summary_review']?></td>
                                            <td><?=$review['review']?></td>
                                            <td><?=mdyDateFormat($review['review_date'])?></td>
                                            <td class="center"> 
                                                <!-- <a href="<?=APP_URL?>/index.php?page=editCategory&categoryId=<?=$category['id']?>" title="Edit"><i class="fa fa-edit fa-lg"></i></a> -->
                                                 <?php if($review['active'] == '1'){?>
                                                    <img src="images/2.png"> <a href="javascript:void(0);" title="Inactive Review" onclick="reviewstatus('<?=$review['id']?>','inactive')" ><img src="images/3.png"></a>
                                                <?php }else{ ?>
                                                    <a href="javascript:void(0);" title="Active Review" onclick="reviewstatus('<?=$review['id']?>','active')"><img src="images/1.png"></a> <img src="images/4.png">
                                                <?php } ?>

                                                <a href="javascript:void(0);" title="Delete Review" onclick="reviewstatus('<?=$review['id']?>','delete')"><i class="fa fa-trash"></i></a>
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

             function reviewstatus(id,status){
                
                 var confirmMsg = '';
                if(status == 'active'){
                    confirmMsg = "Are you sure you want to activate this review?";
                }else if(status == 'delete'){
                    confirmMsg = "Are you sure you want to delete this review ?";
                }else{
                    confirmMsg = "Are you sure you want to inactivate review?";
                }

                if(confirm(confirmMsg)){
                    $.ajax
                        ({
                            type: "POST",
                            url: "ajxHandler.php",
                            data: "action=reviewstatus&id="+id+"&status="+status,
                            success: function(msg){    
                                if(msg =='success'){
                                    $('.successMsg').show('slow');
                                    $('.successMsg').html('Status has been updated.');
                                    setTimeout(function(){
                                      $('.successMsg').hide('slow');
                                      window.location.reload(true);
                                    }, 1000);
                                }else if(msg =='deleted'){
                                        // $('#slide_'+id).css('display','none');
                                        $('.successMsg').show('slow');
                                        $('.successMsg').html('Review has been deleted.');
                                    setTimeout(function(){
                                      $('.successMsg').hide('slow');
                                      window.location.reload(true);
                                    }, 1000);    
                                }else{
                                    $('.errorMsg').show('slow');
                                    $('.errorMsg').html('Problem while updating. Please try again!');
                                    setTimeout(function(){
                                      $('.errorMsg').hide('slow');
                                      window.location.reload(true);
                                    }, 1000);
                               }  
                                                                                            
                            }
                        });
                }
            }
            </script>


        <?
    }


     function getAllReviews(){
        
        $db = new DB();

        $query = "SELECT * FROM ".REVIEW." ORDER BY id DESC";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $reviews[]=$row;
        }

        return $reviews;

    }

    function reviewstatus(){

        $db = new DB();

        if($_REQUEST['status'] =='delete'){

           $delete = array(
            'id' => $_REQUEST['id']
            );
            $deleted = $db->delete(REVIEW, $delete);

           
            
            if($deleted){
                echo "deleted";
            }else{
                echo "fail";
            }
           exit; 



        }else if($_REQUEST['status'] =='active'){
            $val = '1';
         }else{
            $val = '0';
         }

         $Data = array(
                'active' =>  $val,
        );
        $where_clause = array(
                'id' => $_REQUEST['id']
        );

        $updated = $db->update(REVIEW, $Data, $where_clause);

       

        if($updated){
            echo "success";
        }else{
            echo "fail";
        }
    }




    function manageAttributes(){

          $db = new DB();
        ?>

         <div class="row">
                <div class="col-lg-12 alert alert-success successMsg"> </div>
                <div class="col-lg-12 alert alert-danger errorMsg"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Attributes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Attributes
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>X</th>
                                            <th>Sl. No.</th>
                                            <th>Attribute Name</th>
                                            <th>Status</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                      $db = new DB();

                                    $query = "SELECT * FROM ".ATTRIBUTES."";
                                    $attributesData = $db->get_results( $query );
                                    

                                     if(count($attributesData)>0){
                                        $slno = 1;
                                     foreach ($attributesData as $attributes) {

                                        ?>
                                        <tr class="odd gradeX attributeList" id="attribute_<?=$attributes['id']?>">
                                            <td><input type="checkbox" value="<?=$attributes['id']?>" class="attributeListCheck" name="attributecheck[]"></td>
                                            <td><?=$slno?></td>
                                            <td><?=$attributes['attributeName']?></td>
                                            <td><?php if($attributes['active'] == '1'){ echo "Active";}else{ echo "Inactive";}?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editAttribute&id=<?=$attributes['id']?>" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                <?php if($attributes['active'] == '1'){?>
                                                    <a href="javascript:void(0);" title="Inactive Detail" onclick="attributeStatus('<?=$attributes['id']?>','inactive')"><i class="fa fa-times"></i></a>
                                                <?php }else{ ?>
                                                    <a href="javascript:void(0);" title="Active Detail" onclick="attributeStatus('<?=$attributes['id']?>','active')"><i class="fa fa-check"></i></a>
                                                <?php } ?>
                                            </td> 
                                        </tr>
                                     <? $slno++; } 
                                 } ?>
                                    </tbody>
                                </table>
                                <div><input type="button" class="btn btn-primary" id="select_all" value="Select all"> &nbsp; <input type="button" class="btn btn-primary" id="select_none" value="Select None"> &nbsp;<input type="button" class="btn  btn-success" value="Active" onclick="selectedAllAttribute('active');"> &nbsp;<input type="button" class="btn  btn-danger" value="In Active" onclick="selectedAllAttribute('inactive');"></div>
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
            $('#select_all').click(function(event) {   
               checkboxes = $('.attributeListCheck');   

              for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = true;
              }
               
            });
             $('#select_none').click(function(event) {   
               checkboxes = $('.attributeListCheck');   

              for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = false;
              }
               
            });
             function selectedAllAttribute(status){
                  var selchbox = [];
                  var inpfields = $('.attributeListCheck');
                  var nr_inpfields = inpfields.length;
                  for(var i=0; i<nr_inpfields; i++) {
                    if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
                  }
                var confirmMsg = '';
                if(status == 'active'){
                    confirmMsg = "Are you sure you want to activate?";
                }else{
                    confirmMsg = "Are you sure you want to inactivate?";
                }
                if(confirm(confirmMsg)){
                $.ajax
                    ({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=selectedAllAttribute&ids="+selchbox+"&status="+status,
                        success: function(msg){   

                            if(msg =='success'){
                                $('.successMsg').show('slow');
                                $('.successMsg').html('Status has been updated.');
                                setTimeout(function(){
                                  $('.successMsg').hide('slow');
                                  window.location.reload(true);
                                }, 1000);
                           }else{
                                $('.errorMsg').show('slow');
                                $('.errorMsg').html('Problem while updating. Please try again!');
                                setTimeout(function(){
                                  $('.errorMsg').hide('slow');
                                  window.location.reload(true);
                                }, 1000);
                           }  
                                                                                        
                        }
                    });
                }
             }
            function attributeStatus(id,status){
                
                var confirmMsg = '';
                if(status == 'active'){
                    confirmMsg = "Are you sure you want to activate?";
                }else{
                    confirmMsg = "Are you sure you want to inactivate?";
                }
                if(confirm(confirmMsg)){
                        $.ajax
                            ({
                                type: "POST",
                                url: "ajxHandler.php",
                                data: "action=attributeStatus&id="+id+"&status="+status,
                                success: function(msg){    
                                   
                                    if(msg =='success'){
                                        $('.successMsg').show('slow');
                                        $('.successMsg').html('Status has been updated.');
                                        setTimeout(function(){
                                          $('.successMsg').hide('slow');
                                          window.location.reload(true);
                                        }, 1000);
                                   }else{
                                        $('.errorMsg').show('slow');
                                        $('.errorMsg').html('Problem while updating. Please try again!');
                                        setTimeout(function(){
                                          $('.errorMsg').hide('slow');
                                          window.location.reload(true);
                                        }, 1000);
                                   }  
                                                                                                
                                }
                            });
                    }
            }
            </script>


        <?
    }

    function attributeStatus(){

         $db = new DB();
         
         if($_REQUEST['status'] =='active'){
            $val = '1';
         }else{
            $val = '0';
         }

         $Data = array(
                'active' =>  $val,
        );
        $where_clause = array(
                'id' => $_REQUEST['id']
        );

        $updated = $db->update(ATTRIBUTES, $Data, $where_clause);
        if($updated){
            echo "success";
        }else{
            echo "fail";
        }
    }
    function selectedAllAttribute(){
        $db = new DB();
        
        $ids = explode(',', $_REQUEST['ids']);
        if($_REQUEST['status'] =='active'){
            $val = '1';
         }else{
            $val = '0';
         }
        foreach ($ids as $value) {
            $Data = array(
                'active' =>  $val,
            );
            $where_clause = array(
                    'id' => $value
            );

            $updated = $db->update(ATTRIBUTES, $Data, $where_clause);
        }
        
        if($updated){
            echo "success";
        }else{
            echo "fail";
        }
        exit;
    }

    function addNewAttributes(){

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Attributes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Attributes
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveAttributes" /> 
                                       
                                        <div class="form-group">
                                            <label>Attributes</label>
                                            <input class="form-control" name="attributeName" value="" required>                                            
                                        </div>

                                       <!--  <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="3" ></textarea>                                            
                                        </div> -->
          
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


    function saveAttributes(){
        $db = new DB();

        $data = array(
            'attributeName' => $db->filter($_POST['attributeName'])
            
        );

        $rs = $db->insert(ATTRIBUTES, $data);

        if($rs){
            return true;
        }

    }

    function editAttribute($id){
        $db = new DB();
        $attributeDetails = $db->get_row("SELECT * FROM ".ATTRIBUTES." WHERE id='".$id."'",true);
        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Attributes</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Attributes
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateAttributes" /> 
                                         <input type="hidden" name="id" value="<?=$attributeDetails->id?>">
                                       
                                        <div class="form-group">
                                            <label>Attributes</label>
                                            <input class="form-control" name="attributeName" value="<?=$attributeDetails->attributeName?>" required>                                            
                                        </div>
                                         <button type="submit" class="btn btn-default">Submit</button>
                                       
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

    function updateAttributes(){
        $db = new DB();

        $data = array(
            'attributeName' => $db->filter($_POST['attributeName'])
            
        );

        $where_clause = array(
                'id' => $_POST['id']
        );

        $updated = $db->update(ATTRIBUTES, $data, $where_clause);
       
        if($updated){
            return true;
        }else{
            return false;
        }

    }

    function manageAttributeValues(){

          $db = new DB();
        ?>

         <div class="row">
                <div class="col-lg-12 alert alert-success successMsg"> </div>
                <div class="col-lg-12 alert alert-danger errorMsg"> </div>
                <div class="col-lg-12">
                    <h1 class="page-header">Attribute Values</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Attribute Values
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>X</th>
                                            <th>Sl. No.</th>
                                            <th>Attributes Name</th>
                                            <th>Attribute Values</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                     <?php 

                                      $db = new DB();

                                    $query = "SELECT * FROM ".ATTRIBUTE_VALUES." ORDER BY attributeId";
                                    $attributeValuesData = $db->get_results( $query );
                                    

                                     if(count($attributeValuesData)>0){
                                        $slno = 1;
                                     foreach ($attributeValuesData as $attributeValue) {

                                        $qry = "SELECT * FROM ".ATTRIBUTES." WHERE id='".$attributeValue['attributeId']."'";
                                        $$attribute = $db->get_row( $qry, true );

                                        ?>
                                        <tr class="odd gradeX attributeValuesList" id="attributeValues_<?=$attributeValue['id']?>" >
                                            <td><input type="checkbox" value="<?=$attributeValue['id']?>" class="attributeValuesListCheck" name="attributeValuescheck[]"></td>
                                            <td><?=$slno?></td>
                                            <td><?=$$attribute->attributeName?></td>
                                            <td><?=$attributeValue['attributeValue']?></td>
                                            <td><?php if($attributeValue['active'] == '1'){ echo "Active";}else{ echo "Inactive";}?></td>
                                            <td class="center"> 
                                                <a href="<?=APP_URL?>/index.php?page=editAttributeValues&id=<?=$attributeValue['id']?>" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                <?php if($attributeValue['active'] == '1'){?>
                                                    <a href="javascript:void(0);" title="Inactive Detail" onclick="attributeValueStatus('<?=$attributeValue['id']?>','inactive')"><i class="fa fa-times"></i></a>
                                                <?php }else{ ?>
                                                    <a href="javascript:void(0);" title="Active Detail" onclick="attributeValueStatus('<?=$attributeValue['id']?>','active')"><i class="fa fa-check"></i></a>
                                                <?php } ?>
                                            </td> 
                                        </tr>
                                     <? $slno++; } 
                                 } ?>
                                    </tbody>
                                </table>
                                <div><input type="button" class="btn btn-primary" id="select_all" value="Select all"> &nbsp; <input type="button" class="btn btn-primary" id="select_none" value="Select None"> &nbsp;<input type="button" class="btn  btn-success" value="Active" onclick="selectedAllattributeValue('active');"> &nbsp;<input type="button" class="btn  btn-danger" value="In Active" onclick="selectedAllattributeValue('inactive');"></div>
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
            $('#select_all').click(function(event) {   
               checkboxes = $('.attributeValuesListCheck');   

              for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = true;
              }
               
            });
             $('#select_none').click(function(event) {   
               checkboxes = $('.attributeValuesListCheck');   

              for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = false;
              }
               
            });
             function selectedAllattributeValue(status){
                  var selchbox = [];
                  var inpfields = $('.attributeValuesListCheck');
                  var nr_inpfields = inpfields.length;
                  for(var i=0; i<nr_inpfields; i++) {
                    if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) selchbox.push(inpfields[i].value);
                  }
                var confirmMsg = '';
                if(status == 'active'){
                    confirmMsg = "Are you sure you want to activate?";
                }else{
                    confirmMsg = "Are you sure you want to inactivate?";
                }
                if(confirm(confirmMsg)){
                $.ajax
                    ({
                        type: "POST",
                        url: "ajxHandler.php",
                        data: "action=selectedAllattributeValue&ids="+selchbox+"&status="+status,
                        success: function(msg){   

                            if(msg =='success'){
                                $('.successMsg').show('slow');
                                $('.successMsg').html('Status has been updated.');
                                setTimeout(function(){
                                  $('.successMsg').hide('slow');
                                  window.location.reload(true);
                                }, 1000);
                           }else{
                                $('.errorMsg').show('slow');
                                $('.errorMsg').html('Problem while updating. Please try again!');
                                setTimeout(function(){
                                  $('.errorMsg').hide('slow');
                                  window.location.reload(true);
                                }, 1000);
                           }  
                                                                                        
                        }
                    });
                }
             }
            function attributeValueStatus(id,status){
                
                var confirmMsg = '';
                if(status == 'active'){
                    confirmMsg = "Are you sure you want to activate this?";
                }else{
                    confirmMsg = "Are you sure you want to inactivate this?";
                }
                if(confirm(confirmMsg)){
                        $.ajax
                            ({
                                type: "POST",
                                url: "ajxHandler.php",
                                data: "action=attributeValueStatus&id="+id+"&status="+status,
                                success: function(msg){    
                                   
                                    if(msg =='success'){
                                        $('.successMsg').show('slow');
                                        $('.successMsg').html('Status has been updated.');
                                        setTimeout(function(){
                                          $('.successMsg').hide('slow');
                                          window.location.reload(true);
                                        }, 1000);
                                   }else{
                                        $('.errorMsg').show('slow');
                                        $('.errorMsg').html('Problem while updating. Please try again!');
                                        setTimeout(function(){
                                          $('.errorMsg').hide('slow');
                                          window.location.reload(true);
                                        }, 1000);
                                   }  
                                                                                                
                                }
                            });
                    }
            }
            </script>


        <?
    }

    function attributeValueStatus(){

         $db = new DB();
         
         if($_REQUEST['status'] =='active'){
            $val = '1';
         }else{
            $val = '0';
         }

         $Data = array(
                'active' =>  $val,
        );
        $where_clause = array(
                'id' => $_REQUEST['id']
        );

        $updated = $db->update(ATTRIBUTE_VALUES, $Data, $where_clause);
        if($updated){
            echo "success";
        }else{
            echo "fail";
        }
    }
    function selectedAllattributeValue(){
        $db = new DB();
        
        $ids = explode(',', $_REQUEST['ids']);
        if($_REQUEST['status'] =='active'){
            $val = '1';
         }else{
            $val = '0';
         }
        foreach ($ids as $value) {
            $Data = array(
                'active' =>  $val,
            );
            $where_clause = array(
                    'id' => $value
            );

            $updated = $db->update(ATTRIBUTE_VALUES, $Data, $where_clause);
        }
        
        if($updated){
            echo "success";
        }else{
            echo "fail";
        }
        exit;
    }

    function addNewAttributeValues(){

        $productAttributes = $this->getAllProductAttributes();

        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Attribute Values</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Attribute Values
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="saveAttributeValues" /> 
                                       
                                        <div class="form-group">
                                            <label>Attributes<span style="color:red">*</span></label>
                                            <!-- <input class="form-control" name="attributeName" value="" required>-->
                                            <select class="form-control" name="attributeId" required>
                                                <option value="">---Select---</option>
                                                <?foreach($productAttributes as $productAttribute){?>
                                                    <option value="<?=$productAttribute['id']?>"><?=$productAttribute['attributeName']?></option>
                                                <?}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Attribute Values<span style="color:red">*</span></label>
                                            <input class="form-control" name="attributeValue" required>                                            
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


    function saveAttributeValues(){

        $db = new DB();

        $data = array(
            'attributeId' => $_POST['attributeId'],
            'attributeValue' => $db->filter($_POST['attributeValue'])
            
        );

        $rs = $db->insert(ATTRIBUTE_VALUES, $data);

        if($rs){
            return true;
        }

    }


    function getAllProductAttributes(){
        
        $db = new DB();

        $query = "SELECT * FROM ".ATTRIBUTES." WHERE active= '1'";
        $results = $db->get_results( $query );
        
        foreach( $results as $row ){
            $orders[]=$row;
        }

        return $orders;

    }

     function editAttributeValues($id){
        $db = new DB();
        $productAttributes = $this->getAllProductAttributes();
        $attributeValueDetails = $db->get_row("SELECT * FROM ".ATTRIBUTE_VALUES." WHERE id='".$id."'",true);
        ?>
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Attribute Values</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Attribute Values
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" name="login_form" method="post" role="form">            
                                         <input type="hidden" name="action" value="updateAttributeValues" />
                                         <input type="hidden" name="id" value="<?=$attributeValueDetails->id?>" /> 
                                       
                                        <div class="form-group">
                                            <label>Attributes<span style="color:red">*</span></label>
                                            <!-- <input class="form-control" name="attributeName" value="" required>-->
                                            <select class="form-control" name="attributeId" required>
                                                <option value="">---Select---</option>
                                                <?foreach($productAttributes as $productAttribute){?>
                                                    <option value="<?=$productAttribute['id']?>" <?php if($attributeValueDetails->attributeId == $productAttribute['id']){ echo "selected='selected'";}else{ echo "";}?>><?=$productAttribute['attributeName']?></option>
                                                <?}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Attribute Values<span style="color:red">*</span></label>
                                            <input class="form-control" name="attributeValue" value="<?=$attributeValueDetails->attributeValue?>" required>                                            
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

    function updateAttributeValues(){
        $db = new DB();
        $data = array(
            'attributeId' => $db->filter($_POST['attributeId']),
            'attributeValue' => $db->filter($_POST['attributeValue'])
        );
        $where_clause = array(
            'id' => $_POST['id']
        );
        $updated = $db->update(ATTRIBUTE_VALUES, $data, $where_clause);
        if($updated){
            return true;
        }else{
            return false;
        }
    }

}
 ?>