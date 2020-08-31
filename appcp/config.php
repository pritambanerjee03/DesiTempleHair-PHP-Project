<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
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
define('APP_URL', 			'http://localhost/chitkiapp/appcp'); 		  	// Application url
define('APP_SURL', 			'http://localhost/chitkiapp/appcp');        // Application secure url

define('ASSET_PATH',        APP_PATH);                  // file path for upload files
define('ASSET_URL',         APP_URL); 
define("SITE_URL","http://".$_SERVER['HTTP_HOST']."/chitkiapp/appcp");

#=================== DATABASE CONFIGURATIONS =================================================


define( 'DB_HOST', '127.0.0.1' ); // set database host
define( 'DB_USER', 'root' ); // set database user
define( 'DB_PASS', '' ); // set database password
define( 'DB_NAME', 'chitkiapp' ); // set database name
define( 'SEND_ERRORS_TO', 'sandesh@evol.co.in' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?

}else{

#=================== PATH CONFIGURATIONS ====================================================
define('APP_PATH', 			dirname(__FILE__));				 		    // Application file system path.
define('APP_URL', 			'http://chitki.com/appcp/'); 		  	// Application url
define('APP_SURL', 			'http://chitki.com/appcp/');	        // Application secure url

define('ASSET_PATH',        APP_PATH);                  // file path for upload files
define('ASSET_URL',         APP_URL);                   // url path for upload file

#=================== DATABASE CONFIGURATIONS =================================================


define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'chitkidg3_chitki' ); // set database user
define( 'DB_PASS', 'q4M!4mL@bxdX​' ); // set database password
define( 'DB_NAME', 'chitkdg3_chitkiapp' ); // set database name
define( 'SEND_ERRORS_TO', 'sandesh@evol.co.in' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?


define("SITE_URL", "http://".$_SERVER['HTTP_HOST']."/realtyems");
define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']);

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

define('SITE_EMAIL_ADDRESS', 'sandesh@evol.co.in');
define('SITE_FROM_NAME', 'Chitki.com');

define('SITE_NAME', 'Chitki.com');




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

?>
