
<?php include('includes/header.inc.php');
 
    $db = new DB();
    $sql = "SELECT sum(quantity) as quantity FROM ".CART." WHERE cartId='".session_id()."'";
    $res = $db->get_row($sql, true);

    // $parentCategories = $products->getMainCategories();
    // pre($parentCategories);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title> Desi Temple Hair </title>
    
    <!-- <link rel="shortcut icon" href="image/flavors&spices-Favicon.png" /> -->
    <link type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800'>
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/font-awesome.min.css" type="text/css" media="screen">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen">
    <link type="text/css" rel="stylesheet" href="css/jquery.bxslider.css">
    
    
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/rating.js"></script>
    <script src="js/platform.js" async defer></script>
    <script type="text/javascript" src="js/jquery.sticky-kit.min.js"></script>
    <script type="text/javascript" src="js/beautymineralScript.js"></script>

    <script type="text/javascript" src="js/jquery.validate.js"></script>

    <script type="text/javascript" src="js/form.js"></script>
    
    <link rel="stylesheet"  href="css/lightslider.css"/>
    <script src="js/lightslider.js"></script>

    <!-- popup -->
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen" />
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>



</head>

<body>



<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '148870929161409',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.12'
    });
     
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response,'loggedin','');
    });  
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  

  function checkLoginState(nexturl) {
   if (typeof yourvar !== 'undefined'){
      var nexturl = nexturl;
   } else{
      nexturl = '';
   }
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response,'login',nexturl);
  });
 
  // FB.login(function(response) {
  //   statusChangeCallback(response);
  // }, {scope: 'public_profile,email'});
}

function statusChangeCallback(response,logtype,nexturl){
     
     if(response.status=='connected' && logtype =='login' ){
      var access_token = response.authResponse.accessToken;
        jQuery.ajax
        ({
            type: "POST",
            url: APPURL+"ajxHandler.php",
            data: "action=fblogin&access_token="+access_token,
            success: function(msg)
            { 
              if(nexturl!=''){
                window.location = 'checkout.php';
              }else{
                window.location = 'myaccount.php';
              }
              
            }
        });
     } 
}
</script>
       <script type="text/javascript">
          $( document ).ready(function() {
              $('ul.nav li.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
              }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
              });

          });


      </script>

    <main  class="body-container">
        
        <main class="main-container">

            <!-- Title Bar -->
            <header class="title-container trans fixed ">

                <div class="title-wrapper clearfix">
                    
                    <!-- Main Section -->
                    <a href="index.php" class="logo img-responsive">
                      
                        <img src="images/logo.png" class="img-responsive" >
                    </a>
                    <div class="sidelinks vcenter">
                        <div class="slinks">
                            <!-- <a href="javascript:void(0);" class="navicon trans menu-toggle"><span class="line"></span></a> -->
                            
                            <?php if($oauth->authUser()){ ?>
                                <a href="myaccount.php" class="tlink pc">My Account</a>
                            <?php }else{ ?>
                                <a href="login.php" class="tlink pc">Sign In/Login</a>
                            <?}?>
                            <!--<a href="log-in" class="tlink pc">login</a>-->
                            <!-- <a href="viewcart.php" class="tlink">cart <span class="cnote miniCartFlavors"><?if($res->quantity!=''){?><?=$res->quantity?><?}else{?>0<?}?></span></a> -->
                              <a href="viewcart.php" class="tlink">Cart <span class="miniCartBeautyMineral"><?php $cart->miniCartBeautyMineral(); ?></span></a>
                            <!-- <span class="miniCartBeautyMineral"></span> -->
                        </div>
                    </div>
                    <div class="mainlinks vcenter">
                      <div class="body-wrap">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                        <!-- <div class="container"> -->
                          <nav class="navbar navbar-inverse" role="navigation">
                            <div class="container-fluid">
                              <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                </button>
                                <!-- <a class="navbar-brand" href="#">Brand</a> -->
                              </div>

                              <!-- Collect the nav links, forms, and other content for toggling -->
                              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                  <li><a href="index.php">Home</a></li>
                                  <li><a href="shop.php">Shop</a></li>
                                  <li><a href="terms.php">Terms and Conditions</a></li>
                                  <li><a href="contactUs.php">Contact</a></li>
                                   
                                  <?php if($oauth->authUser()){ ?>
                                      <li class="onlymob"><a href="myaccount.php">My Account</a></li>
                                  <?php }else{ ?>
                                      <li class="onlymob"><a href="login.php">Sign In/Login</a></li>
                                  <?}?>
                                </ul>
                              </div>
                              <!-- /.navbar-collapse -->
                            </div>
                            <!-- /.container-fluid -->
                          </nav>
                          </div>
                        <!--   </div> -->
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 headerWrapRow">
                            <div class="headerWrapCol">
                              <div class="headerSearch">
                                <form action="search.php" method="POST">
                                  <input type="text" class="searchField" name="search" placeholder="Search entire shop here...">
                                  <input type="image" class="searchIcon" src="images/searchIcon.png">
                                </form> 
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                    <!-- /Main Section -->
                   
                </div>
            </header>
            <!-- Title Bar -->
