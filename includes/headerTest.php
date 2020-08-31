
<?php include('includes/header.inc.php');
    $db = new DB();
    $sql = "SELECT sum(quantity) as quantity FROM ".CART." WHERE cartId='".session_id()."'";
    $res = $db->get_row($sql, true);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title> Flavors & Spices</title>
    <!-- <base href="http://evol.co.in/flavors&spices/"></base> -->
    <!-- <base href="http://localhost/flavors&spices/"></base> -->

    
    <!-- <link rel="shortcut icon" href="image/flavors&spices-Favicon.png" /> -->
    <link type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800'>
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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
    <script type="text/javascript" src="js/flavorsandspicesScript.js"></script>
</head>

<body>
       

    <main  class="body-container">
        
        <!-- Menu Container -->
        <div class="menu-container">
            <div class="menu-inner">
                <div class="menu-head">
                    <div class="menu-tabs">
                        <a href="javascript:void(0);" class="tlink mtoggle active" data-target="#menu-spices">Spices</a>
                        <a href="javascript:void(0);" class="tlink mtoggle" data-target="#menu-pickle">Pickles</a>
                        <a href="javascript:void(0);" class="tlink mtoggle" data-target="#menu-aftermeals">Papad</a>
                    </div>
                </div>
                <div class="menu-body">
                    <div class="menu-wrap">
                              <!-- Spices -->
                        <div class="menu-pane active" id="menu-spices">
                            <div class="menu-block">
                                
                                <p>Seasoning</p>
                                <ul>
                                    
                                    <li><a href="detail.php?categoryId='1'" class="tlink">Cloves<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Dry Ginger</a></li>
                                    <li><a href="detail.php" class="tlink">White Pepper</a></li>
                                    <li><a href="detail.php" class="tlink">Bay Leaf</li>
                                    <li><a href="detail.php" class="tlink">Coriander Powder(Dhania)</a></li>
                                    <li><a href="detail.php" class="tlink">khus khus (khasakhasa)<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Shahi Jeera</a></li>
                                    <li><a href="detail.php" class="tlink">Kalonji Seeds</a></li>
                                    
                                </ul>
                                
                                <p>Flavouring</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Black Salt (Kala Namak)</a></li>
                                    <li><a href="detail.php" class="tlink">Marathi Moggu Small</a></li>
                                    <li><a href="detail.php" class="tlink">Cinnamon Sticks(Cassia-Dalchini)</a></li>
                                    <li><a href="detail.php" class="tlink">Coriander</a></li>
                                    <li><a href="detail.php" class="tlink">Fenugreek</a></li>
                                    <li><a href="detail.php" class="tlink">cumin seeds</a></li>
                                    <li><a href="detail.php" class="tlink">Nutmeg</a></li>
                                    <li><a href="detail.php" class="tlink">Chilly Powder (Mirchi)</a></li>
                                    
                                </ul>

                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Black Pepper Powder</a></li>
                                    <li><a href="detail.php" class="tlink">Flax seeds (Alsi)</a></li>
                                    <li><a href="detail.php" class="tlink">Kapok Buds (Marathi Moggu)</a></li>
                                    <li><a href="detail.php" class="tlink">White Pepper Powder</a></li>
                                    <li><a href="detail.php" class="tlink">Sabja Seeds(Basil Seeds)</a></li>
                                    <li><a href="detail.php" class="tlink">Mustard</a></li>
                                    <li><a href="detail.php" class="tlink">Turmeric Powder</a></li>
                                    <li><a href="detail.php" class="tlink">Star Anise</a></li>
                                    
                                </ul>

                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Cumin Powder (Jira)<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Turmeric whole (Haldi)<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Black Sesame Seeds (Till)<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Black Stone Flower ( Kalpasi)<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Mace-Javitri<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Edible Gum<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Cardamom<span class='badge'>New</span></a></li>
                                    <li><a href="detail.php" class="tlink">Black Pepper<span class='badge'>New</span></a></li>
                                    
                                </ul>
                                
                            </div>
                            <div class="menu-block">
                                <h3>My Account</h3>
                                <p>Manage your account</p>
                                <ul>
                                    
                                    
                                    <li><a href="login.php" class="tlink">Login</a></li>
                                    <li><a href="login.php" class="tlink">sign up</a></li>
                                    
                                    <!-- <li><a href="custom-gifting" class="tlink ">Custom Gifting</a></li>
                                    <li><a href="gift-pack-of-3" class="tlink">The Three-bulous Surprise</a></li>
                                    <li><a href="gift-pack-of-4" class="tlink">The Four-tastic Surprise</a></li> -->
                                    <li><a href="viewcart.php" class="tlink">Cart (<span class="cnote miniCartFlavors"><?if($res->quantity!=''){?><?=$res->quantity?><?}else{?>0<?}?></span>)</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Spices -->

                        <!-- Pickles -->
                        <div class="menu-pane" id="menu-pickle">
                            <div class="menu-block">
                                
                                <p>Exclusive</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Ker Sangri<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Olives and Jalapeno</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Amba Halad</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Carrots and Chillies</a></li>
                                    
                                </ul>
                                
                                <p>Vintage</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Vintage Gol Keri</a></li>
                                    
                                </ul>
                                
                                <p>Sweet // Spicy</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Lime (sweet)<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Chunda</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Katki<span class='badge green'>In Stock</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Gol Keri</a></li>
                                    
                                </ul>
                                
                                <p>Sour // Spicy</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Khatti Keri in Mustard<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Khatti Keri in Methi<span class='badge green'>In Stock</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Gunda Keri<span class='badge green'>In Stock</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Chana Methi</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Red Chillies</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Green Chillies</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Garlic</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Lime (sour)</a></li>
                                    
                                </ul>
                                
                                <p>Custom</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Make Your Own</a></li>
                                    
                                </ul>
                                
                            </div>
                            <div class="menu-block">
                                <h3>My Account</h3>
                                <p>Manage your account</p>
                                <ul>
                                    
                                    
                                    <li><a href="login.php" class="tlink">Login</a></li>
                                    <li><a href="login.php" class="tlink">sign up</a></li>
                                    
                                   <!--  <li><a href="custom-gifting" class="tlink ">Custom Gifting</a></li>
                                    <li><a href="gift-pack-of-3" class="tlink">The Three-bulous Surprise</a></li>
                                    <li><a href="gift-pack-of-4" class="tlink">The Four-tastic Surprise</a></li> -->
                                    <li><a href="viewcart.php" class="tlink">Cart (<span class="cnote miniCartFlavors"><?if($res->quantity!=''){?><?=$res->quantity?><?}else{?>0<?}?></span>)</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Pickles -->
                  
                        <!-- Aftermeals -->
                        <div class="menu-pane" id="menu-aftermeals">
                            <div class="menu-block">
                                
                                <p>Digestive</p>
                                <ul>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Plums<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Guava<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Cherry<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Strawberry<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Pineapple<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Cherry Berry<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Blueberry<span class='badge'>New</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Cranberries</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Cherry Tomato</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Assorted Masala Fruits</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Kiwi</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Pomelo</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Orange</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Mango<span class='badge green'>In Stock</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Ginger</a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Dates<span class='badge green'>In Stock</span></a></li>
                                    
                                    <li><a href="detail.php" class="tlink">Masala Grapes<span class='badge green'>In Stock</span></a></li>
                                    
                                </ul>
                                
                            </div>

                            <div class="menu-block">
                                <h3>My Account</h3>
                                <p>Manage your account</p>
                                <ul>
                                    
                                    
                                    <li><a href="login.php" class="tlink">Login</a></li>
                                    <li><a href="login.php" class="tlink">sign up</a></li>
                                    
                                   <!--  <li><a href="custom-gifting" class="tlink ">Custom Gifting</a></li>
                                    <li><a href="gift-pack-of-3" class="tlink">The Three-bulous Surprise</a></li>
                                    <li><a href="gift-pack-of-4" class="tlink">The Four-tastic Surprise</a></li> -->
                                    <li><a href="viewcart.php" class="tlink">Cart (<span class="cnote miniCartFlavors"><?if($res->quantity!=''){?><?=$res->quantity?><?}else{?>0<?}?></span>)</a></li>
                                </ul>
                            </div>

                        </div>
                        <!-- /Aftermeals -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Container -->
        
        <main class="main-container">

            <!-- Title Bar -->
            <header class="title-container trans fixed ">
                <div class="title-wrapper clearfix">
                    
                    <!-- Main Section -->
                    <a href="index.php" class="logo">
                      
                        <img src="images/logo-dark.png">
                    </a>
                    <div class="sidelinks vcenter">
                        <div class="slinks">
                            <a href="javascript:void(0);" class="navicon trans menu-toggle"><span class="line"></span></a>
                            <?php if($oauth->authUser()){ ?>
                                <a href="login.php" class="tlink pc">My Account</a>
                            <?php }else{ ?>
                                <a href="myaccount.php" class="tlink pc">My Account</a>
                            <?}?>
                            <!--<a href="log-in" class="tlink pc">login</a>-->
                            <a href="viewcart.php" class="tlink">cart <span class="cnote miniCartFlavors"><?if($res->quantity!=''){?><?=$res->quantity?><?}else{?>0<?}?></span></a>
                        </div>
                    </div>
                    <div class="mainlinks vcenter">
                        <ul class="mlinks">
                            
                            <li><a href="javascript:void(0);" class="tlink dlink" data-target="#tspices">Spices</a></li>
                            <li><a href="javascript:void(0);" class="tlink dlink" data-target="#tpickles">Pickles</a></li>
                            <li><a href="javascript:void(0);" class="tlink dlink" data-target="#taftermeals">Papad</a></li>
                            <!-- <li><a href="javascript:void(0);" class="tlink dlink" data-target="#taftermeals">After Meals</a></li> -->
                            <!-- <li><a href="javascript:void(0);" class="tlink dlink" data-target="#tgifting">Gift a Goosebump</a></li> -->
                            <!--<li><a href="custom-gifting" class="tlink ">Custom Gifting</a></li>-->
                            <!--<li><a href="pickle-week-contest" class="tlink">Pickle Innovation</a></li>-->
                        </ul>
                    </div>
                    <!-- /Main Section -->
                    
                    <!-- Drop Section -->
                    <div class="title-drop">
                        <div class="td-wrap">
                            <div class="td-main bpad clearfix" id="tspices">
                                
                                <div class="td-block">
                                    <ul>
                                        <li><a href="detail.php?categoryId=<?=base64_encode(4)?>" class="tlink">Cloves<span class='badge'>New</span><span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php?categoryId=<?=base64_encode(5)?>" class="tlink">Coriander<span class="sub trans">Seasoning</span></a></li>
                                       <!--  <li><a href="detail.php" class="tlink">White Pepper<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Bay Leaf<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Coriander Powder(Dhania)<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">khus khus (khasakhasa)<span class='badge'>New</span><span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Shahi Jeera<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Kalonji Seeds<span class="sub trans">Seasoning</span></a></li> -->
                                        
                                    </ul>
                                </div>

                               <!--  <div class="td-block">
                                    <ul>
                                        <li><a href="detail.php" class="tlink">Black Salt (Kala Namak)<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Marathi Moggu Small<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Cinnamon Sticks(Cassia-Dalchini)<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Coriander<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Fenugreek<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">cumin seeds<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Nutmeg<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Chilly Powder (Mirchi)<span class="sub trans">Seasoning</span></a></li>
                                    </ul>
                                </div>

                                <div class="td-block">
                                    <ul>
                                        <li><a href="detail.php" class="tlink">Black Pepper Powder<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Flax seeds (Alsi)<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Kapok Buds (Marathi Moggu)<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">White Pepper Powder<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Sabja Seeds(Basil Seeds)<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Mustard<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Turmeric Powder<span class="sub trans">Seasoning</span></a></li>
                                        <li><a href="detail.php" class="tlink">Star Anise<span class="sub trans">Seasoning</span></a></li>
                                    </ul>
                                </div>
                                
                                <div class="td-block">
                                    <ul>
                                        
                                        <li><a href="detail.php" class="tlink">Cumin Powder (Jira)<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Turmeric whole (Haldi)<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Black Sesame Seeds (Till)<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Black Stone Flower ( Kalpasi)<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Mace-Javitri<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Edible Gum<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Cardamom<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                        <li><a href="detail.php" class="tlink">Black Pepper<span class='badge'>New</span><span class="sub trans">Flavouring</span></a></li>
                                    </ul>
                                </div>
                                
                                <a href="detail.php" class="td-all tlink">View all spices</a> -->
                            </div>

                            <div class="td-main clearfix" id="tpickles">
                               <!--  
                                <div class="td-block">
                                    <h6>Exclusive</h6>
                                    <ul>
                                        
                                        <li><a href="detail.php" class="tlink">Ker Sangri<span class='badge'>New</span><span class="sub trans">Mustard base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Olives and Jalapeno<span class="sub trans">Mustard base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Amba Halad<span class="sub trans">Fenugreek base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Carrots and Chillies<span class="sub trans">Mustard base</span></a></li>
                                        
                                    </ul>
                                </div>
                                
                                <div class="td-block">
                                    <h6>Vintage</h6>
                                    <ul>
                                        
                                        <li><a href="detail.php" class="tlink">Vintage Gol Keri<span class="sub trans">Jaggery base</span></a></li>
                                        
                                    </ul>
                                </div>
                                
                                <div class="td-block">
                                    <h6>Sweet // Spicy</h6>
                                    <ul>
                                        
                                        <li><a href="detail.php" class="tlink">Lime (sweet)<span class='badge'>New</span><span class="sub trans">Sugar base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Chunda<span class="sub trans">Sugar base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Katki<span class='badge green'>Back in stock</span><span class="sub trans">Sugar base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Gol Keri<span class="sub trans">Jaggery base</span></a></li>
                                        
                                    </ul>
                                </div>
                                
                                <div class="td-block">
                                    <h6>Sour // Spicy</h6>
                                    <ul>
                                        
                                        <li><a href="detail.php" class="tlink">Khatti Keri in Mustard<span class='badge'>New</span><span class="sub trans">Mustard base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Khatti Keri in Methi<span class='badge green'>Back in stock</span><span class="sub trans">Fenugreek base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Gunda Keri<span class='badge green'>Back in stock</span><span class="sub trans">Fenugreek base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Chana Methi<span class="sub trans">Fenugreek base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Red Chillies<span class="sub trans">Mustard base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Green Chillies<span class="sub trans">Mustard base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Garlic<span class="sub trans">Mustard + Fenugreek base</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Lime (sour)<span class="sub trans">Mustard base</span></a></li>
                                        
                                    </ul>
                                </div>
                                
                                <div class="td-block">
                                    <h6>Custom</h6>
                                    <ul>
                                        
                                        <li><a href="detail.php" class="tlink">Make Your Own<span class="sub trans">Mustard base</span></a></li>
                                        
                                    </ul>
                                </div>
                                 -->
                            </div>
                            
                            <div class="td-main bpad clearfix" id="taftermeals">
                                
                              <!--   <div class="td-block">
                                    <ul class="v2 col3">
                                        
                                        <li><a href="detail.php" class="tlink">Masala Plums<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Guava<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Cherry<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Strawberry<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Pineapple<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Cherry Berry<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Blueberry<span class='badge'>New</span><span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Cranberries<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Cherry Tomato<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Assorted Masala Fruits<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Kiwi<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Pomelo<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Orange<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Mango<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Ginger<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Dates<span class="sub trans">Digestive</span></a></li>
                                        
                                        <li><a href="detail.php" class="tlink">Masala Grapes<span class="sub trans">Digestive</span></a></li>
                                        
                                    </ul>
                                </div>
                                
                                <a href="detail.php" class="td-all tlink">View all aftermeals</a> -->
                            </div>
                           <!--  <div class="td-main clearfix" id="tgifting">
                                <div class="td-block">
                                    <ul class="v2 col3">
                                        <li>
                                            <a href="detail.php" class="tlink center">
                                                <div class="tdi vcenter">
                                                    <img src="images/gift-icon-1.png">
                                                </div>
                                                The Three-bulous Surprise
                                                <span class="sub trans">Pick any 3 Aftermeals for your gift</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="detail.php" class="tlink center">
                                                <div class="tdi vcenter">
                                                    <img src="images/gift-icon-2.png">
                                                </div>
                                                The Four-tastic Surprise
                                                <span class="sub trans">Pick any 4 Aftermeals for your gift</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="detail.php" class="tlink center">
                                                <div class="tdi vcenter">
                                                    <img src="images/gift-icon-3.png">
                                                </div>
                                                'Just for you' Surprise
                                                <span class="sub trans">Customise your Aftermeals</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- /Drop Section -->
                    
                </div>
            </header>
            <!-- Title Bar -->