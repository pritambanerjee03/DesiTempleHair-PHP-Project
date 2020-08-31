<?
ob_start();
session_start();

require_once('setup/config.php');
require_once('setup/common.functions.php');

//LIBRARIES
require_once('classes/class.db.php');
require_once('classes/class.oauth.php');
require_once('classes/class.report_handler.php');
require_once('classes/class.front_end.php');
require_once('classes/class.phpmailer.php');
require_once('classes/class.smtp.php');

// CHITKI CLASSES
require_once('classes/class.products.php');
require_once('classes/class.cart.php');
require_once('classes/class.orders.php');
require_once('classes/class.coupons.php');

$products = new products();
$cart = new cart();
$orders = new orders();
$oauth = new oauth();
$report= new report_handler();
?>