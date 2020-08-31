<?php
ini_set('error_reporting', E_ALL);
ini_set("display_errors","1"); 
include('includes/header.inc.php');
$products = new products();
$cart = new cart();
$coupons = new coupons();
$oauth = new oauth();

$action = isset($_POST['action'])?$_POST['action']:NULL;
// pre($)	
if($action){
	switch ($action) {	

		case 'loadProductsByCategory':
			$products->loadProductsByCategory();
			exit;
		break;
		
		case 'loadProductsBySearch':
			$products->loadProductsBySearch();
			exit;
		break;

		
		case 'getProductCostByOptionId':
			$products->getProductCostByOptionId();
			exit;
		break;

		case 'addToCartChitki':
			$cart->addToCartChitki();
			exit;
		break;
		
		case 'addToCartItems':
			$cart->addToCartItems();
			exit;
		break;
		case 'addToCart':
			$cart->addToCart();
			exit;
		break;
		

		case 'miniCartChitki':
			$cart->miniCartChitki();
			exit;
		break;

		case 'miniCartBeautyMineral':
			$cart->miniCartBeautyMineral();
			exit;
		break;

		case 'removeItemFromCart':
			$cart->removeItemFromCart();
			exit;
		break;

		case 'updateCartItems':
			$cart->updateCartItems();
			exit;
		break;
		case 'checkNewNumberOffer':
			$cart->checkNewNumberOffer();
			exit;
		break;
		case 'loadProductsByBrands':
			$products->loadProductsByBrands();
			exit;
		break;
		case 'applyCouponCode':
			$coupons->applyCouponCode();
			exit;
		break;
		case 'registrationEmailCheck':
			$oauth->registrationEmailCheck();
			exit;
		break;
		case 'addToWishlist':
			$cart->addToWishlist();
			exit;
		break;
		case 'removeFromWishlist':
			$cart->removeFromWishlist();
			exit;
		break;
		case 'loadProductsByOffers':
			$products->loadProductsByOffers();
			exit;
		break;
		case 'notifyUsers':
			$oauth->notifyUsers();
			exit;
		break;
		case 'applyBusinessUserOffer':
			$cart->applyBusinessUserOffer();
			exit;
		break;
		case 'getUserOrderListData':
			$orders->getUserOrderListData();
			exit;
		break;
		case 'showOutofStockModal':
			$cart->showOutofStockModal();
			exit;
		break;

		
		case 'getShippingAddress':
			$orders->getShippingAddress();
			exit;
		break;
		case 'addtional_note':
			$orders->addtional_note();
			exit;
		break;
		case 'getBillingAddress':
			$orders->getBillingAddress();
			exit;
		break;

		case 'removeShippingAddress':
			$orders->removeShippingAddress();
			exit;
		break;

		case 'removeBillingAddress':
			$orders->removeBillingAddress();
			exit;
		break;

		
		case 'subCategoryMenu':
			$products->subCategoryMenu();
			exit;
		break;



		case 'getProductOptionByAttr':
			$products->getProductOptionByAttr();
			exit;
		break;
		case 'getProductAttributes':
			$products->getProductAttributes();
			exit;
		break;
		case 'getProductNextAttribute':
			
			$products->getProductNextAttribute();
			exit;
		break;
		case 'checkoutCustomerDetails':
			$cart->checkoutCustomerDetails();
			exit;
		break;
		case 'getProductCostByOptionId':
			$products->getProductCostByOptionId();
			exit;
		break;

		case 'fblogin':
			$oauth->fblogin();
			exit;
		break;
		case 'getProductsBySearch':
			$products->getProductsBySearch();
			exit;
		break;
	    default:
			echo "Invalid Action.";
		break;
	}
}
?>