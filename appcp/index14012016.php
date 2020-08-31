<?
header("Cache-control: private"); // IE 6 Fix.
ini_set('session.gc_maxlifetime', '28800');
ob_start();
session_start();

if(isset($_REQUEST['page']) && $_REQUEST['page']!=''){
	$page=$_REQUEST['page'];
}else{
	$page='login';
	$_REQUEST['page']='login';
}

require_once('admin.fns.php');
$adminEnd = new adminEnd();

$action = isset($_POST['action'])?$_POST['action']:NULL;
$oauth = new oauth();
$report= new report_handler();


//$adminEnd->displayContent();


if($action) {

	switch ($action) {
	
		case 'login':
		
			if($oauth->logUserIn()) {			
				$report->setReport('success_message','You are successfully logged into the site!');
				$adminEnd->redirect('/index.php?page=home'); //Redirect to the referrer page if there is one
				exit;
			}else{
				$report->setReport('error_message','Invalid Email or Password');
			}
		break;

        case 'saveNewCategory':

            if($adminEnd->saveNewCategory()) {            
                $report->setReport('success_message','Record has been added successfully!');
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page']); //Redirect to the referrer page if there is one
                exit;
            }else{
                $report->setReport('error_message','Error occured while adding the record. Please try again!'); 
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page']);
                exit;
            }

        break;

        case 'updateCategory':

            if($adminEnd->updateCategory()) {            
                $report->setReport('success_message','Record has been added successfully!');
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page'].'&categoryId='.$_REQUEST['categoryId']); //Redirect to the referrer page if there is one
                exit;
            }else{
                $report->setReport('error_message','Error occured while adding the record. Please try again!'); 
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page'].'&categoryId='.$_REQUEST['categoryId']);
                exit;
            }

        break;

        case 'saveNewProduct':
            if($adminEnd->saveNewProduct()) {            
                $report->setReport('success_message','Record has been added successfully!');
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page']); //Redirect to the referrer page if there is one
                exit;
            }else{
                $report->setReport('error_message','Error occured while adding the record. Please try again!'); 
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page']);
                exit;
            }
        break;

        case 'updateProduct':
            if($adminEnd->updateProduct()) {            
                $report->setReport('success_message','Record has been updated successfully!');
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page'].'&productId='.$_REQUEST['productId']); //Redirect to the referrer page if there is one
                exit;
            }else{
                $report->setReport('error_message','Error occured while adding the record. Please try again!'); 
                $adminEnd->redirect('/index.php?page='.$_REQUEST['page'].'&productId='.$_REQUEST['productId']);
                exit;
            }
        break;

        case 'default':
        echo 'Error!';
        break;

	}

}

if((isset($_GET['page']) && ($_GET['page']=='logout') || ($_GET['action']=='logout'))){
	$oauth->logoutUser();
	$adminEnd->redirect('/index.php?page=login'); //Redirect to the referrer page if there is one
	exit;
}


?>

<?php
if(!$oauth->authUser()){
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chitki.com - Control Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

				<? if(isset($_SESSION['error_message'])) { ?>
					<br/><div class="alert alert-danger">
					<?=$_SESSION['error_message']?>
					</div>
				<? 	unset($_SESSION['error_message']);
				} ?>

				<? if(isset($_SESSION['success_message'])) { ?>
					<br/><div class="alert alert-success">
					<?=$_SESSION['success_message']?>
					</div>
				<? 	unset($_SESSION['success_message']);
				} ?>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chitki.com CP - Sign In</h3>
                    </div>
                    <div class="panel-body">
						<!-- login form -->
                        <?php
                        $adminEnd->loginPage();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>

<?php }else{ 

//INNERPAGES

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Chitki - Control Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
   <!--  <link href="css/timeline.css" rel="stylesheet"> -->


       <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
   <!--  <link href="bower_components/morrisjs/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



     <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

     <!-- DataTables JavaScript -->
   

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           

            <?php include('includes/header.php'); ?>

            <!-- /.navbar-top-links -->
            <?php include('includes/sidebar.php'); ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

        	<? if(isset($_SESSION['error_message'])) { ?>
					<br/><div class="alert alert-danger">
					<?=$_SESSION['error_message']?>
					</div>
				<? 	unset($_SESSION['error_message']);
				} ?>

				<? if(isset($_SESSION['success_message'])) { ?>
					<br/><div class="alert alert-success">
					<?=$_SESSION['success_message']?>
					</div>
				<? 	unset($_SESSION['success_message']);
				} ?>
				
            <?php 	$adminEnd->displayContent($page); ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   
 

</body>

</html>


<?php } ?>