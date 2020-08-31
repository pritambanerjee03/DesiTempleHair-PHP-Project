<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?=APP_URL?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

            <?php  if($oauth->authAccessLevel()=='admin' || $oauth->authAccessLevel()=='staff'){?>
             <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Orders<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageOrders">Manage Orders</a>
                    </li>
                    <!--  <li>
                        <a href="<?=APP_URL?>/index.php?page=allOrders">All Orders</a>
                    </li> -->
                    
                </ul>
                
            </li>

            <?php } ?>
            <?php if($oauth->authAccessLevel()=='admin'){?>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Products<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageProducts">Manage Products</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewProduct">Add New Product</a>
                    </li>  
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=orderProduct">Order Product</a>
                    </li>
                     
                    <!-- <li>
                        <a href="<?=APP_URL?>/index.php?page=expiringProduct">Expiring Product</a>
                    </li>   
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=allowProduct">Not Allowed Products</a>
                    </li>   -->                
                </ul>
               
            </li>

            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Ingredients<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageIngredients">Manage Ingredients</a>
                    </li>
                    
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewIngredients">Add New Ingredients</a>
                    </li>
                </ul>
                
            </li>


            
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Categories<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageCategories">Manage Categories</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewCategory">Add New Category</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


           <!--  <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i>Review<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageReview">Manage Review</a>
                    </li>
                  
                </ul>
               
            </li> -->


           <!--   <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Suppliers<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageSuppliers">Manage Suppliers</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewSupplier">Add New Supplier</a>
                    </li>
                </ul>
                
            </li> -->

          <!--   <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i>Supply Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=newBill">New Bill</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageBills">Manage Bills</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=returnProducts">Return Products</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=viewReturnProducts">View Returned Products</a>
                    </li>
                </ul>
                
            </li> -->
           <!--  <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Brands<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageBrand">Manage Brands</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewBrand">Add New Brand</a>
                    </li>
                </ul>
                
            </li> -->
           <!--   <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageAdminUsers">Manage Admin Users</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewAdminUser">Add New Admin User</a>
                    </li>
                </ul>
                
            </li> -->
           <!--  <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Customers<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                   
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageCustomers">Manage ordered Users</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageEnquiredUser">Enquired User</a>
                    </li>
                </ul>
                
            </li> -->
           <!--  <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Coupons<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageCoupons">Manage Coupons</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addCoupon">Add Coupon</a>
                    </li>
                </ul>
                
            </li> -->
            <!-- <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageReports">Manage Reports</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=sellingInfo">Product Selling Info</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=userOrderInfo">Users Order Info</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=movingProductInfo">Fastest Moving Products</a>
                    </li>  
                     <li>
                        <a href="<?=APP_URL?>/index.php?page=viewCategoryStock">View Stock Bar Chart</a>
                    </li> 
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=viewNewUserStatus">View New User Status</a>
                    </li> 
                    
                </ul>
                
            </li> -->
            <?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>