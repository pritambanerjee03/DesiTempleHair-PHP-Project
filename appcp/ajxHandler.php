<?php
ini_set('error_reporting', E_ALL);
ini_set("display_errors","1"); 

require_once('admin.fns.php');
$adminEnd = new adminEnd();

$action = isset($_POST['action'])?$_POST['action']:NULL;
	
if($action){
	switch ($action) {	

		case 'deleteProductOption':
			$adminEnd->deleteProductOption();
			exit;
		break;

		case 'deleteProductPhoto':
			$adminEnd->deleteProductPhoto();
			exit;
		break;
		
		case 'loadReceiptForm':
			$adminEnd->loadReceiptForm();
			exit;
		break;
		case 'loadWeightunitForm':
			$adminEnd->loadWeightunitForm();
			exit;
		break;
		case 'loadunitFormweight':
			$adminEnd->loadunitFormweight();
			exit;
		break;
		case 'loadReturnReceiptForm':
			$adminEnd->loadReturnReceiptForm();
			exit;
		break;
		case 'updatecoststock':
			$adminEnd->updatecoststock();
			exit;
		break;
		case 'updateDistPrice':
			$adminEnd->updateDistPrice();
			exit;
		break;
		case 'deleteOrderedItems':
			$adminEnd->deleteOrderedItems();
			exit;
		break;
		case 'loadOrderweightForm':
			$adminEnd->loadOrderweightForm();
			exit;
		break;
		case 'loadOrderunitForm':
			$adminEnd->loadOrderunitForm();
			exit;
		break;
		case 'loadeditOrderweightForm':
			$adminEnd->loadeditOrderweightForm();
			exit;
		break;
		case 'loadeditOrderunitForm':
			$adminEnd->loadeditOrderunitForm();
			exit;
		break;
		case 'getaddressbyphoneno':
			$adminEnd->getaddressbyphoneno();
			exit;
		break;
		case 'getEditaddressbyphoneno':
			$adminEnd->getEditaddressbyphoneno();
			exit;
		break;
		case 'sortProducts':
			$adminEnd->sortProducts();
			exit;
		break;
		case 'allowSupplyProducts':
			$adminEnd->allowSupplyProducts();
			exit;
		break;
		case 'deleteBills':
            $adminEnd->deleteBills($_REQUEST['supplierId']);
            exit;   
        break;
        case 'updatereturnProducts':
            $adminEnd->updatereturnProducts();
            exit;   
        break;
        case 'loadApplyFieldForm':
            $adminEnd->loadApplyFieldForm();
            exit;   
        break;
        case 'loadCouponTypeFieldsForm':
            $adminEnd->loadCouponTypeFieldsForm();
            exit;   
        break;
        case 'loadCouponMethodFieldsForm':
            $adminEnd->loadCouponMethodFieldsForm();
            exit;   
        break;
        case 'checkCouponCode':
            $adminEnd->checkCouponCode();
            exit;   
        break;
        case 'removeCouponProduct':
            $adminEnd->removeCouponProduct();
            exit;   
        break;
        case 'removeCouponCategory':
            $adminEnd->removeCouponCategory();
            exit;   
        break;
        case 'supportComment':
            $adminEnd->supportComment();
            exit;   
        break;
        case 'getOrderReport':
            $adminEnd->getOrderReport();
            exit;   
        break;
        case 'updateLastCheckTime':
            $adminEnd->updateLastCheckTime();
            exit;   
        break;
        case 'applyOfferFromViewOrders':
            $adminEnd->applyOfferFromViewOrders();
            exit;   
        break;
        case 'getsellingInfoDetails':
            $adminEnd->getsellingInfoDetails();
            exit;   
        break;
        case 'getuserOrderInfoDetails':
            $adminEnd->getuserOrderInfoDetails();
            exit;   
        break;
        case 'getmovingProductInfoDetails':
        	$adminEnd->getmovingProductInfoDetails();
            exit;
        break;
        case 'getNewUserStatusDetails':
        	$adminEnd->getNewUserStatusDetails();
            exit;
        break;
        case 'deleteIngredientPhoto':
			$adminEnd->deleteIngredientPhoto();
			exit;
		break;

		case 'reviewstatus':
			$adminEnd->reviewstatus();
			exit;
		break;
		
		case 'attributeStatus':
			$adminEnd->attributeStatus();
			exit;
		break;
		case 'selectedAllAttribute':
			$adminEnd->selectedAllAttribute();
			exit;
		break;

		case 'attributeValueStatus':
			$adminEnd->attributeValueStatus();
			exit;
		break;
		case 'selectedAllattributeValue':
			$adminEnd->selectedAllattributeValue();
			exit;
		break;
		case 'attributesSelectValue':
			$adminEnd->attributesSelectValue();
			exit;
		break;
		case 'unitsSelectValue':
			$adminEnd->unitsSelectValue();
			exit;
		break;
	    default:
			echo "Invalid Action.";
		break;
	}
}
?>