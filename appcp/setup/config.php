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
define('APP_URL', 			'http://localhost/desitemplehair/appcp'); 		  	// Application url
define('APP_SURL', 			'http://localhost/desitemplehair/appcp');        // Application secure url

define('ASSET_PATH',        APP_PATH);                  // file path for upload files
define('ASSET_URL',         APP_URL); 
define("SITE_URL","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp");

define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'].'/desitemplehair/appcp');

define("PRODUCT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/appcp/productFiles/images/thumb");
define("PRODUCT_CART_PATH","http://".$_SERVER['HTTP_HOST']."/appcp/productFiles/images/cart");
define("PRODUCT_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/appcp/productFiles/image");

define("INGREDIENT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/ingredientFiles/images/thumb");
define("INGREDIENT_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/ingredientFiles/image");

#=================== DATABASE CONFIGURATIONS =================================================


define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'root' ); // set database user
define( 'DB_PASS', '' ); // set database password
define( 'DB_NAME', 'desitemplehair' ); // set database name
define( 'SEND_ERRORS_TO', 'sandesh@evol.co.in' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

}else{

#=================== PATH CONFIGURATIONS ====================================================
define('APP_PATH', 			dirname(__FILE__));				 		    // Application file system path.
define('APP_URL', 			'http://www.desitemplehair.com/appcp/'); 		  	// Application url
define('APP_SURL', 			'http://www.desitemplehair.com/appcp/');	        // Application secure url

define('ASSET_PATH',        APP_PATH);                  // file path for upload files
define('ASSET_URL',         APP_URL);                   // url path for upload file

#=================== DATABASE CONFIGURATIONS =================================================


define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'desitemplehair' ); // set database user
define( 'DB_PASS', 'Qo}Z1NKquZB7'); // set database password
define( 'DB_NAME', 'desitemplehair'); // set database name
define( 'SEND_ERRORS_TO', 'santhosh@evol.co.in' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

define("SITE_URL", "http://".$_SERVER['HTTP_HOST']."/appcp");
define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']."/appcp");

define("PRODUCT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/appcp/productFiles/images/thumb");
define("PRODUCT_CART_PATH","http://".$_SERVER['HTTP_HOST']."/appcp/productFiles/images/cart");
define("PRODUCT_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/appcp/productFiles/image");


define("INGREDIENT_THUMBNAIL_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/ingredientFiles/images/thumb");
define("INGREDIENT_IMAGe_PATH","http://".$_SERVER['HTTP_HOST']."/desitemplehair/appcp/ingredientFiles/image");

}




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
//net profit category id checks
define('netProfitCatids', '1,2');
define('OFFER_PERCENT', '5'); //5% offer
define('BUSINESS_OFFER_PERCENT', '5'); //5% offer
// Chitki Tables

define('PRODUCT_CATEGORIES', 'product_categories');
define('PRODUCTS', 'products');
define('PRODUCT_ATTRIBUTES', 'product_attributes');
define('PRODUCT_ATTRIBUTE_VALUES', 'product_attribute_values');
define('PRODUCT_OPTIONS', 'product_options');
define('PRODUCT_IMAGES', 'product_images');
define('ORDER_DETAILS', 'order_details');
define('ORDER_ITEMS', 'order_items');
define('USERS', 'users');
define('PRODUCT_SUPPLY','product_supply');
define('PRODUCT_SUPPLY_ITEMS','product_supply_items');
define('SUPPLIERS', 'suppliers');
define('BRANDS', 'brands');
define('ADMIN_USERS', 'admin_users');
define('ENQUIRED_USERS', 'enquired_users');
define('PRODUCT_RETURN_ITEMS', 'product_return_items');
define('COUPONS', 'coupons');
define('COUPON_METHOD', 'coupon_method');
define('COUPON_TYPE', 'coupon_type');
define('COUPON_APPLY', 'coupon_apply');
define('COUPON_USERS', 'coupon_users');
define('REGISTERED_USER', 'registered_user');
define('PRODUCT_OFFERS', 'product_offers');
define('CART_ADDRESS', 'cart_address');
define('USER_ADDRESSES', 'user_addresses');
define('INGREDIENTS', 'ingredients');
define('REVIEW', 'review');
define('ATTRIBUTE_VALUES','attribute_values');
define('ATTRIBUTES','attributes');
?>
