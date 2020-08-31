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
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Products<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageProducts">Manage Products</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=addNewProduct">Add New Product</a>
                    </li>                    
                </ul>
                <!-- /.nav-second-level -->
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

             <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Orders<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageOrders">Manage Orders</a>
                    </li>
                    <li>
                        <a href="<?=APP_URL?>/index.php?page=manageCustomers">Manage Customers</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>