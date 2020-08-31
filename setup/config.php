<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 0);
set_time_limit(0);
ini_set('memory_limit', '80M');
ini_set('post_max_size', '80M');
ini_set('upload_max_filesize', '100M');

error_reporting(E_ALL & ~E_NOTICE);

if ( function_exists( 'date_default_timezone_set' ) )
date_default_timezone_set( 'UTC' );

if($_SERVER['HTTP_HOST']=='localhost'){

#=================== PATH CONFIGURATIONS ====================================================
define('APP_PATH', 			dirname(__FILE__));				 		    // Application file system path.
define('APP_URL', 			'http://localhost/desitemplehair'); 		  	// Application url
define('APP_SURL', 			'http://localhost/desitemplehair');        // Application secure url

define('ASSET_PATH',        APP_PATH);                  // file path for upload files
define('ASSET_URL',         APP_URL); 
define("SITE_URL","http://".$_SERVER['HTTP_HOST']."/desitemplehair");

define("PRODUCT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/productFiles/images/thumb");
define("PRODUCT_CART_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/productFiles/images/cart");
define("PRODUCT_IMAGE_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/productFiles/images");

define("INGREDIENT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/ingredientFiles/images/thumb");
define("INGREDIENT_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/ingredientFiles/image");

#=================== DATABASE CONFIGURATIONS =================================================


define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'root' ); // set database user
define( 'DB_PASS', '' ); // set database password
define( 'DB_NAME', 'desitemplehair' ); // set database name
define( 'SEND_ERRORS_TO', 'santhosh@evol.co.in' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

}else{

#=================== PATH CONFIGURATIONS ====================================================
define('APP_PATH', 			dirname(__FILE__));				 		    // Application file system path.
define('APP_URL', 			"http://".$_SERVER['HTTP_HOST'].""); 		  	// Application url
define('APP_SURL', 			"http://".$_SERVER['HTTP_HOST']."");	        // Application secure url

define('ASSET_PATH',        APP_PATH);                  // file path for upload files
define('ASSET_URL',         APP_URL);                   // url path for upload file

#=================== DATABASE CONFIGURATIONS =================================================



define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'desitemplehair' ); // set database user
define( 'DB_PASS', 'Qo}Z1NKquZB7'); // set database password
define( 'DB_NAME', 'desitemplehair'); // set database name
define( 'SEND_ERRORS_TO', 'santhosh@evol.co.in' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

define("SITE_URL", "http://".$_SERVER['HTTP_HOST']."");
define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']);


define("PRODUCT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/productFiles/images/thumb");
define("PRODUCT_CART_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/productFiles/images/cart");
define("PRODUCT_IMAGE_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/productFiles/images");

define("CATEGORY_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/categoryFiles/images/thumb");
define("CATEGORY_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/categoryFiles/image");

define("INGREDIENT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/ingredientFiles/images/thumb");
define("INGREDIENT_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/beautyappcp/ingredientFiles/image");

}



/** CSS Cache Buster */
define('CSS_VERSION', @filemtime('/var/www/html/beauty-mineral/css/style.css'));
define('JS_VERSION', @filemtime('/var/www/html/beauty-mineral/js/beautymineralScript.js'));

//--------


define("WIDTH",181);
define("HEIGHT",100);

/*image resize*/
define('IMAGE_WIDTH', 120);
define('IMAGE_HEIGHT', 90); 

define('FAVICON_WIDTH', 16);
define('FAVICON_HEIGHT', 16);


define('FOO_USERNAME','deshetty');
define('FOO_PASSWORD','evol123456');
define('FOO_SENDERID','RTYWEB');
define('FOO_PRIORITY','11'); //4-Promotional root

define('SITE_EMAIL_ADDRESS', 'santhosh@evol.co.in');
define('SITE_FROM_NAME', 'Flavorsandspices.in');

define('SITE_NAME', 'Flavorsandspices.in');


define('FREE_DELIVERYAMOUNT_LIMIT', '300.00'); //300 and above
define('DELIVERY_CHARGE', '20.00'); //300 and above

define('OFFER_PERCENT', '5'); //5% offer
define('BUSINESS_OFFER_PERCENT', '5'); //5% offer


//-----General funtions-----

function pre($data){
	echo '<PRE>';
	print_r($data);
	echo '<PRE>';
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function mdyDateFormat($date){
	
	list($date, $time)=explode(' ', $date);
	
	list($y, $m, $d)=explode('-', $date);
	
	list($h, $i, $s)=explode(':', $time);
	
	return  date("M j, Y", mktime(00, 00, 00, $m, $d, $y));
	
}

function stdDateFormat($date){
	
	list($date, $time)=explode(' ', $date);
	
	list($y, $m, $d)=explode('-', $date);
	
	list($h, $i, $s)=explode(':', $time);
	
	return  date("M j, Y, g:i A", mktime($h, $i, $s, $m, $d, $y));
	
}

function stdTimeFormat($date){
	
	list($date, $time)=explode(' ', $date);
	
	list($y, $m, $d)=explode('-', $date);
	
	list($h, $i, $s)=explode(':', $time);
	
	return  date("g:i A", mktime($h, $i, $s, $m, $d, $y));
	
}

//gift card category ids
define('giftCatIds', '69,70,71');
// Chitki Tables

define('PRODUCT_CATEGORIES', 'product_categories');
define('PRODUCTS', 'products');
define('PRODUCT_ATTRIBUTES', 'product_attributes');
define('PRODUCT_ATTRIBUTE_VALUES', 'product_attribute_values');
define('PRODUCT_OPTIONS', 'product_options');
define('PRODUCT_IMAGES', 'product_images');
define('ORDERS', 'orders');
define('ORDER_DETAILS', 'order_details');
define('ORDER_ITEMS', 'order_items');
define('CART', 'cart');
define('USERS', 'users');
define('USER_ADDRESSES', 'user_addresses');
define('BRANDS', 'brands');
define('REGISTERED_USER', 'registered_user');
define('COUPONS', 'coupons');
define('COUPON_METHOD', 'coupon_method');
define('COUPON_TYPE', 'coupon_type');
define('COUPON_APPLY', 'coupon_apply');
define('COUPON_USERS', 'coupon_users');
define('WISHLIST', 'wishlist');
define('NOTIFY_USERS', 'notify_users');
define('PRODUCT_OFFERS', 'product_offers');
define('CART_ADDRESS', 'cart_address');
define('REVIEW', 'review');
define('INGREDIENTS', 'ingredients');
define('ATTRIBUTE_VALUES','attribute_values');
define('ATTRIBUTES','attributes');
?>