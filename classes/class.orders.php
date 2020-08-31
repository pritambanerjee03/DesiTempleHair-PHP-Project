<?php

class orders{
	var $userId;
	
	function orders(){
		
	}

    function saveShippingAddress(){

        $db = new DB();
        $oauth = new oauth();

        if($_POST['sameadd']=='Yes'){

            $dataShipping = array(
                    'type' => $db->filter('shipping'),
                    'userId'=> $db->filter($_SESSION['regId']),
                    'first_name' => $db->filter($_POST['first_name']),
                    'last_name' => $db->filter($_POST['last_name']),
                    'address_1' => $db->filter($_POST['address_1']),
                    'address_2' => $db->filter($_POST['address_2']),
                    'landmark' => $db->filter($_POST['landmark']),
                    'country' => $db->filter($_POST['country']),
                    'state' => $db->filter($_POST['state']),
                    'city' => $db->filter($_POST['city']),
                    'pincode' => $db->filter($_POST['pincode']),
                    'phone' => $db->filter($_POST['phone'])
                );

            $userInsertShipping = $db->insert(USER_ADDRESSES, $dataShipping);

            $dataBilling = array(
                    'type' => $db->filter('billing'),
                    'userId'=> $db->filter($_SESSION['regId']),
                    'first_name' => $db->filter($_POST['first_name']),
                    'last_name' => $db->filter($_POST['last_name']),
                    'address_1' => $db->filter($_POST['address_1']),
                    'address_2' => $db->filter($_POST['address_2']),
                    'landmark' => $db->filter($_POST['landmark']),
                    'country' => $db->filter($_POST['country']),
                    'state' => $db->filter($_POST['state']),
                    'city' => $db->filter($_POST['city']),
                    'pincode' => $db->filter($_POST['pincode']),
                    'phone' => $db->filter($_POST['phone'])
                );

            $userInsertBilling = $db->insert(USER_ADDRESSES, $dataBilling);
             return ture;
        }else{

            $data = array(
                    'type' => $db->filter($_POST['type']),
                    'userId'=> $db->filter($_SESSION['regId']),
                    'first_name' => $db->filter($_POST['first_name']),
                    'last_name' => $db->filter($_POST['last_name']),
                    'address_1' => $db->filter($_POST['address_1']),
                    'address_2' => $db->filter($_POST['address_2']),
                    'landmark' => $db->filter($_POST['landmark']),
                    'country' => $db->filter($_POST['country']),
                    'state' => $db->filter($_POST['state']),
                    'city' => $db->filter($_POST['city']),
                    'pincode' => $db->filter($_POST['pincode']),
                    'phone' => $db->filter($_POST['phone'])
                );

            $userInsert = $db->insert(USER_ADDRESSES, $data);
             return ture;
        }
    }

    function saveBillingAddress(){

        $db = new DB();
        $oauth = new oauth();

       
            $data = array(
                    'type' => $db->filter($_POST['type']),
                    'userId'=> $db->filter($_SESSION['regId']),
                    'first_name' => $db->filter($_POST['first_name']),
                    'last_name' => $db->filter($_POST['last_name']),
                    'address_1' => $db->filter($_POST['address_1']),
                    'address_2' => $db->filter($_POST['address_2']),
                    'landmark' => $db->filter($_POST['landmark']),
                    'country' => $db->filter($_POST['country']),
                    'state' => $db->filter($_POST['state']),
                    'city' => $db->filter($_POST['city']),
                    'pincode' => $db->filter($_POST['pincode']),
                    'phone' => $db->filter($_POST['phone'])
                );

            $userInsert = $db->insert(USER_ADDRESSES, $data);

            return ture;
    }

    function addtional_note(){
        $db = new DB();
        $qry = "SELECT * FROM ".CART_ADDRESS." WHERE cartId='".session_id()."'";

        if($db->num_rows( $qry ) > 0 ){
            $updateCart = array(
                'note' => $db->filter($_POST['note'])        
            );
            $where_clause = array(
                'cartId' => session_id()
            );
            $updated = $db->update(CART_ADDRESS, $updateCart, $where_clause, 1);
        }else{
            $data = array(
                'cartId' => session_id(),
                'note' => $db->filter($_POST['note']) 
            );
            $rs = $db->insert(CART_ADDRESS, $data);
        }
    }
    function getShippingAddress(){

        // echo 'Hiii';
        // exit;
        $db = new DB();
        $qry = "SELECT * FROM ".CART_ADDRESS." WHERE cartId='".session_id()."'";

        if($db->num_rows( $qry ) > 0 ){
            $updateCart = array(
                'shippingId' => $db->filter($_POST['id'])        
            );

            $where_clause = array(
                'cartId' => session_id()
            );

            $updated = $db->update(CART_ADDRESS, $updateCart, $where_clause, 1);
        }else{

            $data = array(
                'cartId' => session_id(),
                'shippingId' => $db->filter($_POST['id']) 
            );

            $rs = $db->insert(CART_ADDRESS, $data);
        }

        // session_unset($_SESSION['shippingId']);
        // $_SESSION['shippingId'] = $_POST['id'];
    }



    function getBillingAddress(){
        $db = new DB();
        $qry = "SELECT * FROM ".CART_ADDRESS." WHERE cartId='".session_id()."'";

        if($db->num_rows( $qry ) > 0 ){
            $updateCart = array(
                'billingId' => $db->filter($_POST['id'])       
            );

            $where_clause = array(
                'cartId' => session_id()
            );

            $updated = $db->update(CART_ADDRESS, $updateCart, $where_clause, 1);
        }else{

            $data = array(
                'cartId' => session_id(),
                'billingId' => $db->filter($_POST['id'])
            );

            $rs = $db->insert(CART_ADDRESS, $data);
        }
        // session_unset($_SESSION['billingId']);
        // $_SESSION['billingId'] = $_POST['id'];
    }

	function completeOrder(){ 


        $db = new DB();
        pre($_SESSION['regId']);

        $oauth = new oauth();
        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

        $shipBillDetail = $db->get_row("SELECT * FROM ".CART_ADDRESS." WHERE cartId = '".session_id()."' ",true);
        $shippingDetail = $this->getShippingDetails($shipBillDetail->shippingId);
        $billingDetail = $this->getBillingDetails($shipBillDetail->billingId);

        // $shippingAddress = $shippingDetail->first_name $shippingDetail->last_name.'<br>'.$shippingDetail->address_1, $shippingDetail->address_2,.'<br>'.$shippingDetail->landmark.'<br>'.$shippingDetail->city, $shippingDetail->pincode .'<br>'.$shippingDetail->state;
        $shippingAddress = $shippingDetail->address_1.', '.$shippingDetail->address_2.', '.$shippingDetail->landmark.' '.$shippingDetail->city.', '.$shippingDetail->pincode.' '.$shippingDetail->state.', '.$shippingDetail->country;
        $billingAddress = $billingDetail->address_1.', '.$billingDetail->address_2.', '.$billingDetail->landmark.' '.$billingDetail->city.', '.$billingDetail->pincode.' '.$billingDetail->state.', '.$billingDetail->country;
// echo "SELECT * FROM ".REGISTERED_USER." WHERE id = '".$_SESSION['regId']."' ";
        $usersDetail = $db->get_row("SELECT * FROM ".REGISTERED_USER." WHERE id = '".$_SESSION['regId']."' ",true);
       // pre($usersDetail);
       //  exit;
            $data = array(
                'userId' => $_SESSION['regId'],
                'cartId' => session_id(),
                'shippingId' => $shipBillDetail->shippingId,
                'billingId' => $shipBillDetail->billingId,
                'mobileNumber' => $db->filter($billingDetail->phone),
                'fullName' => $db->filter($billingDetail->first_name),
                'email' => $db->filter($usersDetail->email),
                'address_shipping' => $db->filter($shippingAddress),
                'address_billing' => $db->filter($billingAddress),
                'note' => $shipBillDetail->note,
                'dateTime' => $dateTime
                // 'paymentType' => 'Online',
                // 'onlinePaymentStatus' => 'Pending'
            );

            $res = $db->insert(ORDER_DETAILS, $data);

            $orderId = $db->lastid();

            if($res){

                $qry = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."'";

                    $totalItems = 0;

                    if($db->num_rows( $qry ) > 0 ){
                   
                        $records = $db->get_results($qry);

                        $subTotal = 0;
                        $grandtotal = 0;
                        $productTotal = 0;
                        $totalItems = 0;

                        foreach($records as $record){

                            $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                              WHERE id='".$record['productId']."'", true);

                            $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, orderCount,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                            if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
                                $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
                                if($offerPrice < 1){
                                    $offerPrice = 1;
                                }
                                $productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
                            }

                            $unitPrice = $productOption->productCost;
                            $productTotalPrice = $record['quantity']*$productOption->productCost;

                            $orderedItems = array(
                                'orderId' => $orderId,
                                'productId' => $record['productId'],
                                'productName' => $productData->productName,
                                'productOptionId' => $record['productOptionId'],
                                'productWeight' =>  $productOption->productWeight,
                                'productUnit' =>  $productOption->productUnit,
                                'unitPrice' => $unitPrice,
                                'quantity' => $record['quantity'],
                                'productTotalPrice' => $productTotalPrice
                            );

                            $orderItemInsert = $db->insert(ORDER_ITEMS, $orderedItems);

                            if($orderItemInsert){

                                $orderCount = $productOption->orderCount+$record['quantity'];

                                // Stock Update ----

                                $productStock=0;

                                $currentStock = $productOption->productStock;
                                $updatedStock = $currentStock-$record['quantity'];

                                if($updatedStock>=0){
                                    $productStock= $updatedStock;
                                }else{
                                    // mail('santhosh@evol.co.in', 'CHITKI ALERT - '.$record['productId'], 'Stock goes minus : ProdId - '.$record['productId']);
                                }

                                //-----------------

                                $orderCountDetail = array(
                                    'orderCount' => $orderCount
                                );

                                $where_clause_ordercount = array(
                                    'id' => $productOption->id
                                );

                                $db->update(PRODUCT_OPTIONS, $orderCountDetail, $where_clause_ordercount, 1);

                                $productTotal = $record['quantity']*$productOption->productCost;
                                $totalItems+= $record['quantity'];
                                $subTotal+=$productTotal;
                            }

                        }



                        if($orderItemInsert){

                                $grandTotal = $subTotal;

                                $deliveryCost = DELIVERY_CHARGE;
                                $grandTotal+=DELIVERY_CHARGE;
                                $offerTotal = 0;

                                // if($subTotal<FREE_DELIVERYAMOUNT_LIMIT && $subTotal>0 ){ 
                                //     $deliveryCost = DELIVERY_CHARGE;
                                //     $grandTotal+=DELIVERY_CHARGE;
                                // } 

                                $ORDERNUMBER = $orderId+1000;
                                if($_SESSION['businessUserOffer'] =='Yes'){
                                   $offerTotal = round(( BUSINESS_OFFER_PERCENT / 100) * $subTotal);
                                    if($offerTotal < 1){
                                        $offerTotal = 1;
                                    } 
                                    unset($_SESSION['BUSINESS_OFFER_PERCENT']);
                                    unset($_SESSION['businessUserOfferAmount']);
                                }
                                if($_SESSION['offerAvailable'] =='Yes'){
                                   $offerTotal = round(( OFFER_PERCENT / 100) * $subTotal);
                                    if($offerTotal < 1){
                                        $offerTotal = 1;
                                    } 
                                    unset($_SESSION['offerAvailable']);
                                    unset($_SESSION['offerAmount']);
                                }
                                if($_SESSION['couponAvailable'] =='Yes'){
                                    $couponDiscount = $_SESSION['couponAmount'];
                                    $regId = $oauth->authUser();
                                    $coupouData = array('regId' => $regId,
                                                          'couponId' =>$_SESSION['couponId'],
                                                          'couponCode' => $_SESSION['couponCode'],
                                                          'dateTime' => $dateTime,
                                                          'orderId' => $orderId
                                                         );
                                    $couponUsersInsert = $db->insert(COUPON_USERS, $coupouData);
                                    unset($_SESSION['couponAvailable']);
                                    unset($_SESSION['couponAmount']);
                                    unset($_SESSION['couponCode']);
                                    unset($_SESSION['couponId']);
                                }
                                $updateOrderDetails = array(
                                    'invoiceNumber' => $db->filter($ORDERNUMBER),
                                    'subTotal' => $subTotal,
                                    'deliveryCost' => $deliveryCost,
                                    'totalAmount' => $grandTotal,
                                    'offerAmt' => $offerTotal,
                                    'couponDiscount' => $couponDiscount 
                                );

                                $where_clause = array(
                                    'id' => $orderId
                                );

                                $rs = $db->update(ORDER_DETAILS, $updateOrderDetails, $where_clause, 1);


                            }


                    }


            // }
        }


        if($rs){

           

            $this->emailNotifications($orderId);

            session_regenerate_id();
            $_SESSION['orderinvoice'] = $ORDERNUMBER;
            return $ORDERNUMBER;
        }else{
            return false;
        }

	}

     function completePayumoneyOrder(){ 


        $db = new DB();
        $oauth = new oauth();
        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

        $shipBillDetail = $db->get_row("SELECT * FROM ".CART_ADDRESS." WHERE cartId = '".session_id()."' ",true);
        $shippingDetail = $this->getShippingDetails($shipBillDetail->shippingId);
        $billingDetail = $this->getBillingDetails($shipBillDetail->billingId);

        // $shippingAddress = $shippingDetail->first_name $shippingDetail->last_name.'<br>'.$shippingDetail->address_1, $shippingDetail->address_2,.'<br>'.$shippingDetail->landmark.'<br>'.$shippingDetail->city, $shippingDetail->pincode .'<br>'.$shippingDetail->state;
        $shippingAddress = $shippingDetail->address_1.', '.$shippingDetail->address_2.', '.$shippingDetail->landmark.' '.$shippingDetail->city.', '.$shippingDetail->pincode.' '.$shippingDetail->state.', '.$shippingDetail->country;
        $billingAddress = $billingDetail->address_1.', '.$billingDetail->address_2.', '.$billingDetail->landmark.' '.$billingDetail->city.', '.$billingDetail->pincode.' '.$billingDetail->state.', '.$billingDetail->country;

        // echo "SELECT * FROM ".USERS." WHERE id = '".$_SESSION['regId']."' ";
        
        $usersDetail = $db->get_row("SELECT * FROM ".REGISTERED_USER." WHERE id = '".$_SESSION['regId']."' ",true);
        // pre($usersDetail);
        // exit;
            $data = array(
                'userId' => $_SESSION['regId'],
                'cartId' => session_id(),
                'shippingId' => $shipBillDetail->shippingId,
                'billingId' => $shipBillDetail->billingId,
                'mobileNumber' => $db->filter($billingDetail->phone),
                'fullName' => $db->filter($billingDetail->first_name),
                'email' => $db->filter($usersDetail->email),
                'address_shipping' => $db->filter($shippingAddress),
                'address_billing' => $db->filter($billingAddress),
                'note' => $shipBillDetail->note,
                'dateTime' => $dateTime,
                'paymentType' => 'Online',
                'onlinePaymentStatus' => 'Pending'
            );

            $res = $db->insert(ORDER_DETAILS, $data);

            $orderId = $db->lastid();

            if($res){

                $qry = "SELECT id, productId, productOptionId, quantity FROM ".CART." WHERE cartId='".session_id()."'";

                    $totalItems = 0;

                    if($db->num_rows( $qry ) > 0 ){
                   
                        $records = $db->get_results($qry);

                        $subTotal = 0;
                        $grandtotal = 0;
                        $productTotal = 0;
                        $totalItems = 0;

                        foreach($records as $record){

                            $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                              WHERE id='".$record['productId']."'", true);

                            $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, orderCount,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);

                            if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
                                $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
                                if($offerPrice < 1){
                                    $offerPrice = 1;
                                }
                                $productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
                            }
                            $unitPrice = $productOption->productCost;
                            $productTotalPrice = $record['quantity']*$productOption->productCost;

                            $orderedItems = array(
                                'orderId' => $orderId,
                                'productId' => $record['productId'],
                                'productName' => $productData->productName,
                                'productOptionId' => $record['productOptionId'],
                                'productWeight' =>  $productOption->productWeight,
                                'productUnit' =>  $productOption->productUnit,
                                'unitPrice' => $unitPrice,
                                'quantity' => $record['quantity'],
                                'productTotalPrice' => $productTotalPrice
                            );

                            $orderItemInsert = $db->insert(ORDER_ITEMS, $orderedItems);

                            if($orderItemInsert){

                                $orderCount = $productOption->orderCount+$record['quantity'];

                                // Stock Update ----

                                $productStock=0;

                                $currentStock = $productOption->productStock;
                                $updatedStock = $currentStock-$record['quantity'];

                                if($updatedStock>=0){
                                    $productStock= $updatedStock;
                                }else{
                                    mail('santhosh@evol.co.in', 'Beauty-Mineral ALERT - '.$record['productId'], 'Stock goes minus : ProdId - '.$record['productId']);
                                }

                                //-----------------

                                $orderCountDetail = array(
                                    'orderCount' => $orderCount
                                );

                                $where_clause_ordercount = array(
                                    'id' => $productOption->id
                                );

                                $db->update(PRODUCT_OPTIONS, $orderCountDetail, $where_clause_ordercount, 1);

                                $productTotal = $record['quantity']*$productOption->productCost;
                                $totalItems+= $record['quantity'];
                                $subTotal+=$productTotal;
                            }

                        }



                        if($orderItemInsert){

                                $grandTotal = $subTotal;

                                $deliveryCost = DELIVERY_CHARGE;
                                $offerTotal = 0;
                                $grandTotal+=DELIVERY_CHARGE;

                                // if($subTotal<FREE_DELIVERYAMOUNT_LIMIT && $subTotal>0 ){ 
                                //     $deliveryCost = DELIVERY_CHARGE;
                                //     $grandTotal+=DELIVERY_CHARGE;
                                // } 

                                $ORDERNUMBER = $orderId+1000;
                                if($_SESSION['businessUserOffer'] =='Yes'){
                                   $offerTotal = round(( BUSINESS_OFFER_PERCENT / 100) * $subTotal);
                                    if($offerTotal < 1){
                                        $offerTotal = 1;
                                    } 
                                    unset($_SESSION['BUSINESS_OFFER_PERCENT']);
                                    unset($_SESSION['businessUserOfferAmount']);
                                }
                                if($_SESSION['offerAvailable'] =='Yes'){
                                   $offerTotal = round(( OFFER_PERCENT / 100) * $subTotal);
                                    if($offerTotal < 1){
                                        $offerTotal = 1;
                                    } 
                                    unset($_SESSION['offerAvailable']);
                                    unset($_SESSION['offerAmount']);
                                }
                                if($_SESSION['couponAvailable'] =='Yes'){
                                    $couponDiscount = $_SESSION['couponAmount'];
                                    $regId = $oauth->authUser();
                                    $coupouData = array('regId' => $regId,
                                                          'couponId' =>$_SESSION['couponId'],
                                                          'couponCode' => $_SESSION['couponCode'],
                                                          'dateTime' => $dateTime,
                                                          'orderId' => $orderId
                                                         );
                                    $couponUsersInsert = $db->insert(COUPON_USERS, $coupouData);
                                    unset($_SESSION['couponAvailable']);
                                    unset($_SESSION['couponAmount']);
                                    unset($_SESSION['couponCode']);
                                    unset($_SESSION['couponId']);
                                }
                                $updateOrderDetails = array(
                                    'invoiceNumber' => $db->filter($ORDERNUMBER),
                                    'subTotal' => $subTotal,
                                    'deliveryCost' => $deliveryCost,
                                    'totalAmount' => $grandTotal,
                                    'offerAmt' => $offerTotal,
                                    'couponDiscount' => $couponDiscount   
                                );

                                $where_clause = array(
                                    'id' => $orderId
                                );

                                $rs = $db->update(ORDER_DETAILS, $updateOrderDetails, $where_clause, 1);

                                
                            }


                    }


            }
        // }


        if($rs){

            $_SESSION['orderinvoice'] = $ORDERNUMBER;
            return $orderId;
        }else{
            return false;
        }

    }

      function completeGiftOffersOrder(){ 


        $db = new DB();
        $oauth = new oauth();
        date_default_timezone_set("Asia/Calcutta");

        $dateTime  = date('Y-m-d H:i:s', time());

      

        $query = "SELECT id, mobileNumber FROM ".USERS." WHERE mobileNumber='".$_POST['sendermobileNumber']."' ";
        
        if($db->num_rows($query)==0){

            $data = array(
                'fullName' => $db->filter($_POST['fullName']),
                'email' => $db->filter($_POST['email']),
                'mobileNumber' => $db->filter($_POST['mobileNumber']),
                'password' => $db->filter(randomPassword()),
                'address' => $db->filter($_POST['address']),
                'dateTime' => $dateTime
            );

            $userInsert = $db->insert(USERS, $data);

            $userId = $db->lastid();

        }else{
            $userData = $db->get_row($query, true);          
            $userId = $userData->id;        

        }

        if($userId){


            $data = array(
                'userId' => $userId,
                'cartId' => session_id(),
                'mobileNumber' => $db->filter($_POST['mobileNumber']),
                'fullName' => $db->filter($_POST['fullName']),
                'email' => $db->filter($_POST['email']),
                'address' => $db->filter($_POST['address']),
                'note' => $db->filter($_POST['note']),
                'dateTime' => $dateTime,
                'paymentType' => 'Online',
                'onlinePaymentStatus' => 'Pending',
                'giftOrder' => 'Yes',
                'senderfullName' => $db->filter($_POST['senderfullName']),
                'sendermobileNumber' => $db->filter($_POST['sendermobileNumber']),
                'giftMessage' => $db->filter($_POST['giftMessage'])
            );

            $res = $db->insert(ORDER_DETAILS, $data);

            $orderId = $db->lastid();

            if($res){

                $qry = "SELECT id, productId, productOptionId, quantity,timeslotVal FROM ".CART." WHERE cartId='".session_id()."'";

                    $totalItems = 0;

                    if($db->num_rows( $qry ) > 0 ){
                   
                        $records = $db->get_results($qry);

                        $subTotal = 0;
                        $grandtotal = 0;
                        $productTotal = 0;
                        $totalItems = 0;

                        foreach($records as $record){

                            $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                              WHERE id='".$record['productId']."'", true);

                            $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock, orderCount,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);

                            if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
                                $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
                                if($offerPrice < 1){
                                    $offerPrice = 1;
                                }
                                $productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
                            }
                            $unitPrice = $productOption->productCost;
                            $productTotalPrice = $record['quantity']*$productOption->productCost;

                            $orderedItems = array(
                                'orderId' => $orderId,
                                'productId' => $record['productId'],
                                'productName' => $productData->productName,
                                'productOptionId' => $record['productOptionId'],
                                'productWeight' =>  $productOption->productWeight,
                                'productUnit' =>  $productOption->productUnit,
                                'unitPrice' => $unitPrice,
                                'quantity' => $record['quantity'],
                                'productTotalPrice' => $productTotalPrice,
                                'timeslotVal' => $record['timeslotVal']
                            );

                            $orderItemInsert = $db->insert(ORDER_ITEMS, $orderedItems);

                            if($orderItemInsert){

                                $orderCount = $productOption->orderCount+$record['quantity'];

                                // Stock Update ----

                                $productStock=0;

                                $currentStock = $productOption->productStock;
                                $updatedStock = $currentStock-$record['quantity'];

                                if($updatedStock>=0){
                                    $productStock= $updatedStock;
                                }else{
                                    mail('sandesh@evol.co.in', 'CHITKI ALERT - '.$record['productId'], 'Stock goes minus : ProdId - '.$record['productId']);
                                }

                                //-----------------

                                $orderCountDetail = array(
                                    'orderCount' => $orderCount
                                );

                                $where_clause_ordercount = array(
                                    'id' => $productOption->id
                                );

                                $db->update(PRODUCT_OPTIONS, $orderCountDetail, $where_clause_ordercount, 1);

                                $productTotal = $record['quantity']*$productOption->productCost;
                                $totalItems+= $record['quantity'];
                                $subTotal+=$productTotal;
                            }

                        }



                        if($orderItemInsert){

                                $grandTotal = $subTotal;

                                $deliveryCost = 0;
                                $offerTotal = 0;

                                if($subTotal<FREE_DELIVERYAMOUNT_LIMIT && $subTotal>0 ){ 
                                    $deliveryCost = DELIVERY_CHARGE;
                                    $grandTotal+=DELIVERY_CHARGE;
                                } 

                                $ORDERNUMBER = $orderId+1000;
                                if($_SESSION['businessUserOffer'] =='Yes'){
                                   $offerTotal = round(( BUSINESS_OFFER_PERCENT / 100) * $subTotal);
                                    if($offerTotal < 1){
                                        $offerTotal = 1;
                                    } 
                                    unset($_SESSION['BUSINESS_OFFER_PERCENT']);
                                    unset($_SESSION['businessUserOfferAmount']);
                                }
                                if($_SESSION['offerAvailable'] =='Yes'){
                                   $offerTotal = round(( OFFER_PERCENT / 100) * $subTotal);
                                    if($offerTotal < 1){
                                        $offerTotal = 1;
                                    } 
                                    unset($_SESSION['offerAvailable']);
                                    unset($_SESSION['offerAmount']);
                                }
                                if($_SESSION['couponAvailable'] =='Yes'){
                                    $couponDiscount = $_SESSION['couponAmount'];
                                    $regId = $oauth->authUser();
                                    $coupouData = array('regId' => $regId,
                                                          'couponId' =>$_SESSION['couponId'],
                                                          'couponCode' => $_SESSION['couponCode'],
                                                          'dateTime' => $dateTime,
                                                          'orderId' => $orderId
                                                         );
                                    $couponUsersInsert = $db->insert(COUPON_USERS, $coupouData);
                                    unset($_SESSION['couponAvailable']);
                                    unset($_SESSION['couponAmount']);
                                    unset($_SESSION['couponCode']);
                                    unset($_SESSION['couponId']);
                                }
                                $updateOrderDetails = array(
                                    'invoiceNumber' => $db->filter($ORDERNUMBER),
                                    'subTotal' => $subTotal,
                                    'deliveryCost' => $deliveryCost,
                                    'totalAmount' => $grandTotal,
                                    'offerAmt' => $offerTotal,
                                    'couponDiscount' => $couponDiscount   
                                );

                                $where_clause = array(
                                    'id' => $orderId
                                );

                                $rs = $db->update(ORDER_DETAILS, $updateOrderDetails, $where_clause, 1);

                                
                            }


                    }


            }
        }


        if($rs){

            $_SESSION['orderinvoice'] = $ORDERNUMBER;
            return $orderId;
        }else{
            return false;
        }

    }
    function emailNotifications($orderId){
        $this->emailtoservice($orderId);
        $db = new DB();

        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, shippingId, billingId, address, note, subTotal, deliveryCost, totalAmount, dateTime,offerAmt,couponDiscount FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
        
        $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->shippingId."' ",true);
        $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->billingId."' ",true);

        $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderDetails->id."'");
        

        ob_start();
        ?>


            <div class="col-md-12 paymentSteps">
                <table class="itemSummery">
                <thead>
                   <tr>
                        <th width="30%;" style="padding-bottom:30px;"><a href="<?=APP_URL?>"><img src="<?=APP_URL?>/images/logo-dark.png"></a></th>
                        <th width="70%;" style="padding-bottom:30px;"><h3 style="font-size:24px;text-align:center;margin:0px;"><a style="color:#000;text-decoration:none;" href="<?=APP_URL?>">desitemplehair.com</a></h3>
                                        <p style="font-size:14px;text-align:right;margin:10px 10px 0px 0px;">Invoice Number: # <?=$orderDetails->invoiceNumber?></p>
                                        <p style="font-size:14px;text-align:right;margin:0px 10px 0px 0px;">Invoice Date: # <?=date('j m Y H:i:s',strtotime($orderDetails->dateTime))?></p>
                        </th>
                   </tr>
                </thead>    
                <tbody>
                    <tr><td width="50%;" valign="top"><h3 style="font-size:20px;text-align:left;margin:0px;">Shipping Details:</h3>
                            <table>
                                <tr><td>Name: <?=$shippingDetail->first_name?> <?=$shippingDetail->last_name?></td></tr>
                                <tr><td>Mobile No.: <?=$shippingDetail->phone?></td></tr>
                                <tr><td>Address: <?=$shippingDetail->address_1?>, <?=$shippingDetail->address_2?>, <?=$shippingDetail->landmark?><br><?=$shippingDetail->city?> <?=$shippingDetail->pincode?><br><?=$shippingDetail->state?> <?=$shippingDetail->country?></td></tr>
                            </table>
                        </td>
                        <td width="50%;" valign="top"><h3 style="font-size:20px;text-align:left;margin:0px;">Billing Details:</h3>
                            <table>
                                <tr><td>Name: <?=$billingDetail->first_name?> <?=$billingDetail->last_name?></td></tr>
                                <tr><td>Mobile No.: <?=$billingDetail->phone?></td></tr>
                                <tr><td>Address: <?=$billingDetail->address_1?>, <?=$billingDetail->address_2?>, <?=$billingDetail->landmark?><br><?=$billingDetail->city?> <?=$billingDetail->pincode?><br><?=$billingDetail->state?> <?=$billingDetail->country?></td></tr>
                            </table>
                        </td>
                    </tr>  
                     <?php if($orderDetails->note!=''){?> 
                            <tr><td colspan="2" width="100%;" valign="top">Note: <?=$orderDetails->note?> </td>  </tr>
                    <?php } ?>                    
                 </tbody>
                </table>
                <br/>
            <table class="itemSummery">
            <tbody><tr>
            <th style="background:#ddd;padding:5px;">Item</th>
            <th style="background:#ddd;padding:5px;">Description</th>
            <th style="background:#ddd;padding:5px;">Quantity</th>
            <th style="background:#ddd;padding:5px;">Unit Price</th>
            <th style="background:#ddd;padding:5px;">Total</th>
            </tr>
            <?
            foreach($records as $record){

                $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                              WHERE id='".$record['productId']."'", true);

                $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                              WHERE productId='".$record['productId']."'", true);

                $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                        $attrValueSet='';   
                            foreach ($productAttrubutes as $productAttrubute) {
                                $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                            }
                if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
                    $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
                    if($offerPrice < 1){
                        $offerPrice = 1;
                    }
                    $productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
                    $productTotal = $record['quantity']*$productOption->productCost;
                    $totalItems+= $record['quantity'];
                    $subTotal+=$productTotal;
                }else{
                    $productTotal = $record['quantity']*$productOption->productCost;
                    $totalItems+= $record['quantity'];
                    $subTotal+=$productTotal;
                }
            ?>

            <tr>
            <td style="border-bottom: 1px solid #ddd;">
                 <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
            
                    <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="Beauty-Mineral - <?=$record['productName']?>" alt="Desi temple hair">
                
                <? }else{ ?>

                    <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png" class="center-block" title="Desi temple hair" alt="Desi temple hair">
            
                <? } ?>

                </td>
                <td style="border-bottom: 1px solid #ddd;"><?=$productData->productName?> <p style="font-size: 13px;"><?php if($attrValueSet !=''){ echo rtrim($attrValueSet,','); } ?></p></td>
                <td style="border-bottom: 1px solid #ddd;"><?=$record['quantity']?></td>
                <td style="border-bottom: 1px solid #ddd;"> &#36; <?=number_format($productOption->productCost,2)?></td>
                <td style="border-bottom: 1px solid #ddd;"> &#36; <?=number_format($productTotal,2)?></td>
            </tr>
            
            <? } ?>

            </tbody>

            <tfoot>
            <tr>
                <td colspan="5" align="right" style="border-bottom: 1px solid #ddd;">
                    <p class="textright">Sub total : &#36; <?=number_format($orderDetails->subTotal, 2)?></p>
                    <p>Shipping<span> &#36; <?=number_format($orderDetails->deliveryCost,2)?></span></p>
                    <!-- <p class="textright">Delivery Charge : &#36; <?=number_format($orderDetails->deliveryCost, 2)?></p> -->
                    <?php $totalPay = $orderDetails->totalAmount; ?>
                    <?php if($orderDetails->couponDiscount > 0){?>
                    <p class="textright">Coupon Discount : &#36; <?=number_format($orderDetails->couponDiscount,2)?></p>
                    <?php 
                        $totalPay = $totalPay - $orderDetails->couponDiscount;
                   } ?>
                    <?php if($orderDetails->offerAmt > 0){?>
                    <p class="textright">Discount : &#36; <?=number_format($orderDetails->offerAmt,2)?></p>
                    <?php 
                    $totalPay = $totalPay - $orderDetails->offerAmt;
                    } ?>
                    <?php 
                       if($totalPay < 0){
                           $totalPay = 0;
                        }
                     ?> 
                    <p class="grandtiotal">
                      Grand Total :  <span> &#36; <?=number_format($totalPay, 2)?></span>
                    </p>
                </td>
            </tr>

            </tfoot>
        </table>

            <p>Thank You for your business with DesiTempleHair, your order is being processed and will be shipped within 7 business days.</p>
            <p>If you have any questions, Please feel free to contact us at - <a href="mailto:support@desitemplehair.com">support@desitemplehair.com</a> </p>  

            <div style="clear:both;width:100%;"></div>
            <div class="separator"></div>
            </div>
        <?

        $contents = ob_get_flush();

        $msg="";
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->From = 'support@desitemplehair.com';
        $mail->FromName = 'desitemplehair.com';
        $mail->AddAddress($orderDetails->email);
        $mail->AddBCC('santhosh@evol.co.in');
             
        $mail->Subject = 'desitemplehair.com: New Order - Order Ref Number :'.$orderDetails->invoiceNumber;      

        $msg.=$contents.'<br><br>';

        $mail->Body  =$msg;                    
        $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
        $mail->Send();

        return true;

    }


 function sendSMSViaMsgClub($mobileNo, $message){

        $authKey = "9920AY2HD6VT6o5569a17d1";

        //Multiple mobiles numbers seperated by comma
        $mobileNumber = $mobileNo;

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "CHITKI";

        //Your message to send, Add URL endcoding here.
        $message = urlencode($message);

        //Define route
        $route = "4";
        //Prepare you post parameters
       
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );

        //API URL
        $url="http://panel.msgclub.net/sendhttp.php";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));

        //get response
        $output = curl_exec($ch);

        curl_close($ch);

        if($output){
            return true;
        }

    }

    function getorderDetails($orderId){ 
        $db = new DB();
        return $orderDetails = $db->get_row("SELECT invoiceNumber as txnid, fullName as firstname, mobileNumber as phone, email, billingId, shippingId, address, note, totalAmount as amount,offerAmt,couponDiscount FROM ".ORDER_DETAILS." WHERE order_details.id='".$orderId."'", true);
     
    }

   function getBillingDetails($billingId){
        $db = new DB();
       // echo "SELECT * FROM ".USER_ADDRESSES." WHERE id='".$billingId."'";
        return $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id='".$billingId."'", true);
   }

   function getShippingDetails($shippingId){
        $db = new DB();
       // echo "SELECT * FROM ".USER_ADDRESSES." WHERE id='".$billingId."'";
        return $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id='".$shippingId."'", true);
   }

   function updatepayuMoneyStatus($invoiceNumber){
            $db = new DB();
            $updateOrderDetails = array(
                'onlinePaymentStatus' => 'Complete'
            );

            $where_clause = array(
                'invoiceNumber' => $invoiceNumber
            );

            $rs = $db->update(ORDER_DETAILS, $updateOrderDetails, $where_clause, 1);
            if($rs){
                return true;
            }else{
                return false;
            }
   }
   function payuMoneyemailNotifications($invoiceNumber){

        $db = new DB();

        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, shippingId, billingId, address, note, subTotal, deliveryCost, totalAmount, dateTime,offerAmt,couponDiscount FROM ".ORDER_DETAILS." WHERE invoiceNumber='".$invoiceNumber."'", true);
        $this->emailtoservice($orderDetails->id);
        $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->shippingId."' ",true);
        $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->billingId."' ",true);

        $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderDetails->id."'");
        

        ob_start();
        ?>


            <div class="col-md-12 paymentSteps">
                <table class="itemSummery">
                <thead>
                   <tr>
                        <th width="30%;" style="padding-bottom:30px;"><a href="<?=APP_URL?>"><img src="<?=APP_URL?>/images/logo-dark.png"></a></th>
                        <th width="70%;" style="padding-bottom:30px;"><h3 style="font-size:24px;text-align:center;margin:0px;"><a style="color:#000;text-decoration:none;" href="<?=APP_URL?>">desitemplehair.com</a></h3>
                                        <p style="font-size:14px;text-align:right;margin:10px 10px 0px 0px;">Invoice Number: # <?=$orderDetails->invoiceNumber?></p>
                                        <p style="font-size:14px;text-align:right;margin:0px 10px 0px 0px;">Invoice Date: # <?=date('j m Y H:i:s',strtotime($orderDetails->dateTime))?></p>
                        </th>
                   </tr>
                </thead>    
                <tbody>
                    <tr><td width="50%;" valign="top"><h3 style="font-size:20px;text-align:left;margin:0px;">Shipping Details:</h3>
                            <table>
                                <tr><td>Name: <?=$shippingDetail->first_name?> <?=$shippingDetail->last_name?></td></tr>
                                <tr><td>Mobile No.: <?=$shippingDetail->phone?></td></tr>
                                <tr><td>Address: <?=$shippingDetail->address_1?>, <?=$shippingDetail->address_2?>, <?=$shippingDetail->landmark?><br><?=$shippingDetail->city?> <?=$shippingDetail->pincode?><br><?=$shippingDetail->state?> <?=$shippingDetail->country?></td></tr>
                            </table>
                        </td>
                        <td width="50%;" valign="top"><h3 style="font-size:20px;text-align:left;margin:0px;">Billing Details:</h3>
                            <table>
                                <tr><td>Name: <?=$billingDetail->first_name?> <?=$billingDetail->last_name?></td></tr>
                                <tr><td>Mobile No.: <?=$billingDetail->phone?></td></tr>
                                <tr><td>Address: <?=$billingDetail->address_1?>, <?=$billingDetail->address_2?>, <?=$billingDetail->landmark?><br><?=$billingDetail->city?> <?=$billingDetail->pincode?><br><?=$billingDetail->state?> <?=$billingDetail->country?></td></tr>
                            </table>
                        </td>
                    </tr>
                      <?php if($orderDetails->note!=''){?> 
                            <tr><td colspan="2" width="100%;" valign="top">Note: <?=$orderDetails->note?> </td>  </tr>
                    <?php } ?>                    
                 </tbody>
                </table>
                <br/>
            <table class="itemSummery">
            <tbody><tr>
            <th style="background:#ddd;padding:5px;">Item</th>
            <th style="background:#ddd;padding:5px;">Description</th>
            <th style="background:#ddd;padding:5px;">Quantity</th>
            <th style="background:#ddd;padding:5px;">Unit Price</th>
            <th style="background:#ddd;padding:5px;">Total</th>
            </tr>
            <?
            foreach($records as $record){

                $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                              WHERE id='".$record['productId']."'", true);

                $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                              WHERE productId='".$record['productId']."'", true);

                $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                        $attrValueSet='';   
                            foreach ($productAttrubutes as $productAttrubute) {
                                $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                            }
                if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
                    $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
                    if($offerPrice < 1){
                        $offerPrice = 1;
                    }
                    $productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
                    $productTotal = $record['quantity']*$productOption->productCost;
                    $totalItems+= $record['quantity'];
                    $subTotal+=$productTotal;
                }else{
                    $productTotal = $record['quantity']*$productOption->productCost;
                    $totalItems+= $record['quantity'];
                    $subTotal+=$productTotal;
                }
            ?>

            <tr>
            <td style="border-bottom: 1px solid #ddd;">
                 <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
            
                    <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="<?=$record['productName']?>" >
                
                <? }else{ ?>

                    <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png" class="center-block" >
            
                <? } ?>

                </td>
                <td style="border-bottom: 1px solid #ddd;"><?=$productData->productName?> <p style="font-size: 13px;"><?php if($attrValueSet !=''){ echo rtrim($attrValueSet,','); } ?></p></td>
                <td style="border-bottom: 1px solid #ddd;"><?=$record['quantity']?></td>
                <td style="border-bottom: 1px solid #ddd;"> &#36; <?=number_format($productOption->productCost,2)?></td>
                <td style="border-bottom: 1px solid #ddd;"> &#36; <?=number_format($productTotal,2)?></td>
            </tr>
            
            <? } ?>

            </tbody>

            <tfoot>
            <tr>
                <td colspan="5" align="right" style="border-bottom: 1px solid #ddd;">
                    <p class="textright">Sub total : &#36; <?=number_format($orderDetails->subTotal, 2)?></p>
                    <p>Shipping<span> &#36; <?=number_format($orderDetails->deliveryCost,2)?></span></p>
                    <!-- <p class="textright">Delivery Charge : &#36; <?=number_format($orderDetails->deliveryCost, 2)?></p> -->
                    <?php $totalPay = $orderDetails->totalAmount; ?>
                    <?php if($orderDetails->couponDiscount > 0){?>
                    <p class="textright">Coupon Discount : &#36; <?=number_format($orderDetails->couponDiscount,2)?></p>
                    <?php 
                        $totalPay = $totalPay - $orderDetails->couponDiscount;
                   } ?>
                    <?php if($orderDetails->offerAmt > 0){?>
                    <p class="textright">Discount : &#36; <?=number_format($orderDetails->offerAmt,2)?></p>
                    <?php 
                    $totalPay = $totalPay - $orderDetails->offerAmt;
                    } ?>
                    <?php 
                       if($totalPay < 0){
                           $totalPay = 0;
                        }
                     ?> 
                    <p class="grandtiotal">
                      Grand Total :  <span> &#36; <?=number_format($totalPay, 2)?></span>
                    </p>
                </td>
            </tr>

            </tfoot>
        </table>

            <p>Thank You for your business with DesiTempleHair, your order is being processed and will be shipped within 7 business days.</p>
            <p>If you have any questions, Please feel free to contact us at - <a href="mailto:support@desitemplehair.com">support@desitemplehair.com</a> </p>  

            <div style="clear:both;width:100%;"></div>
            <div class="separator"></div>
            </div>
        <?

        $contents = ob_get_flush();

        $msg="";
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->From = 'support@desitemplehair.com';
        $mail->FromName = 'desitemplehair.com';
        $mail->AddAddress($orderDetails->email);
        $mail->AddBCC('santhosh@evol.co.in');
             
        $mail->Subject = 'desitemplehair.com: New Order - Order Ref Number :'.$orderDetails->invoiceNumber;      

        $msg.=$contents.'<br><br>';

        $mail->Body  =$msg;                    
        $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
        $mail->Send();

        return true;

    }
    function getUserOrder($regId){ 
        $db = new DB();
        $userDetails = $db->get_row("SELECT userId FROM ".REGISTERED_USER." WHERE id = '".$regId."'",true);
        $userId = $userDetails->userId;
        $query = "SELECT id,totalAmount,offerAmt,invoiceNo,orderStatus,dateTime,couponDiscount FROM ".ORDER_DETAILS." WHERE order_details.userId='".$userId."' ORDER BY id DESC";
        if($db->num_rows($query) > 0){
            $results = $db->get_results($query);
            
            foreach( $results as $row ){
                $orderDetails[]=$row;
            }
            return $orderDetails;
        }
   }

   function getUserOrderNew($regId){
        ?>
         <script type="text/javascript">
                      

                       jQuery( document ).ready(function($) {
                                function loading_show(){
                                    $('#loading').html("<img src='images/loader.gif' style=''/>").fadeIn('fast');
                                }
                                function loading_hide(){
                                    $('#loading').fadeOut('fast');
                                }                
                                function loadData(page, regId){

                                    loading_show();                   
                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: "ajxHandler.php",
                                        data: "action=getUserOrderListData&page="+page+"&regId="+regId,
                                        success: function(msg)
                                        {                                      
                                            loading_hide();
                                            $("#viewOrderList").html(msg);    
                                            $('html, body').animate({scrollTop:0}, 'slow');     
                                            var is_loading = false; // initialize is_loading by false to accept new loading
                                                $(function() {
                                                    $(window).scroll(function() {
                                                        var scrollHeight = ($('.viewOrderPage').height() - $(window).height());
                                                        if($(window).scrollTop() >= scrollHeight) {
                                                            if (is_loading == false && last_id !== '-1') { // stop loading many times for the same page
                                                                is_loading = true;
                                                                loading_show(); 
                                                               setTimeout(function(){
                                                                $.ajax
                                                                ({
                                                                    type: "POST",
                                                                    url: "ajxHandler.php",
                                                                    data: "action=getUserOrderListData&page="+page+"&regId="+regId+"&last_id="+last_id,
                                                                    success: function(msg)
                                                                    {                                      
                                                                        loading_hide();
                                                                        $("#viewOrderList").append(msg);  
                                                                        is_loading = false;
                                                                                                               
                                                                    }
                                                                });
                                                            }, 500);
                                                            }
                                                       }
                                                    });
                                                });                            
                                        }
                                    });
                                }
                                loadData(1, '<?=$regId?>');  // For first time page load default results      

                            });
                        </script>
        <div class="searchitem" id="viewOrderList"></div>
        <div class="row"><div id="loading" class="loaderClass col-xs-12"></div></div>
    <?
    }

    function removeShippingAddress(){
        $db = new DB();

        $delete = array(
            'id' => $db->filter($_POST['id'])
        );

        $deleted = $db->delete(USER_ADDRESSES, $delete, 1);
        
        if($deleted){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    function removeBillingAddress(){
        $db = new DB();

        $delete = array(
            'id' => $db->filter($_POST['id'])
        );

        $deleted = $db->delete(USER_ADDRESSES, $delete, 1);
        
        if($deleted){
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    function getUserOrderListData(){
        $db = new DB();
        date_default_timezone_set('Asia/Kolkata');
        $regId = $db->filter($_POST['regId']);
        $page = $db->filter($_POST['page']);
        $cur_page = $page;
        $page -= 1;
        $per_page = 20;
        $last_id = $_POST['last_id'];
        if(!isset($last_id) && $last_id ==''){
            $last_id = 0;
        }        
        $start = $last_id * $per_page;
        $k = $start;
        $userDetails = $db->get_row("SELECT userId FROM ".REGISTERED_USER." WHERE id = '".$regId."'",true);
        $userId = $userDetails->userId;
        $totalOrderCount = $db->num_rows("SELECT id FROM ".ORDER_DETAILS." WHERE order_details.userId='".$userId."' ORDER BY id DESC");
        $query = "SELECT id,totalAmount,offerAmt,invoiceNo,orderStatus,dateTime,couponDiscount,dateTime FROM ".ORDER_DETAILS." WHERE order_details.userId='".$userId."' ORDER BY id DESC LIMIT $start, $per_page";
        if($db->num_rows($query) > 0){
            $results = $db->get_results($query);                   
            foreach( $results as $row ){           
                $totalAmount = $row['totalAmount'];
                $offerAmt = $row['offerAmt'];
                $couponDiscount = $row['couponDiscount'];
                if($offerAmt > 0){
                    $totalAmount = $totalAmount - $offerAmt;
                }
                if($couponDiscount > 0){
                    $totalAmount = $totalAmount - $couponDiscount;
                }
                if($totalAmount < 0){
                    $totalAmount = 0;
                }
                $k++;
                 $processStatus = '';
                if(($row['orderStatus'] =='Cancel') && (strtotime($row['dateTime']) < (time()-14400))){
                    $processStatus = 'Cancel';
                }
                if( ($row['orderStatus']=='Cancel') && ($processStatus != 'Cancel')){
                    $row['orderStatus'] = 'Processing';
                }
            ?>
            <div class="col-xs-12 col-sm-6 ">
                <div class="viewOrderBox clearfix">
                    <div class="orderTopBox">
                        <div class="row">
                            <div class="col-xs-7 col-sm-6"><?php if($row['invoiceNo'] !=''){ ?><p> Order No:&nbsp; <?php echo $row['invoiceNo']; ?>  </p><?php }?><p><?=stdDateFormat($row['dateTime'])?></p></div>
                            <div class="col-xs-5 col-sm-6"><p class="textRight"> Status:&nbsp;<?=$row['orderStatus']?></p><p class="textRight"> Total:&nbsp; &#x20b9; <?=number_format($totalAmount,2)?></p></div>                     
                        </div>  
                    </div>  
                    <div class="orderBottomBox">
                        <?php 
                        
                        if($processStatus == 'Cancel'){
                            echo "<p class='text-center'>Your order has been canceled!</p>";
                        }else{ ?>
                             <ul class="progressbar">
                                <li class="active" >Processing</li>
                                <li <?php if($row['orderStatus'] =='Shipped' || $row['orderStatus'] =='Delivered'){ ?> class="active" <?php } ?>>Shipped</li>
                                <li <?php if($row['orderStatus'] =='Delivered'){ ?> class="active" <?php } ?>>Delivered</li>
                            </ul>
                        <?php } ?>
                       
                           
                       
                    </div>
                    <div class="col-xs-12">
                        <p class="text-right"> <a class="viewOrderDetails" href="<?=APP_URL?>/userorder.php?id=<?=base64_encode($row['id'])?>" title="View Order Detail">View Details <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
            </div>
            <?php if(($k%2)==0){?><div class="clearfix"></div> <?php } ?>
            <script type="text/javascript">
                var last_id = '<?=$last_id?>';
                last_id = parseInt(last_id)+parseInt(1);
            </script>
        <?php } 
        }else{ ?>
            <script type="text/javascript">var last_id = '-1';</script>
        <?php if($totalOrderCount < 1){ echo "<p class='text-center'>New to Chitki.com?! Order now!</p>"; }
        }
    }

    function updateShippingAddress(){

        $db = new DB();
        $updateOrderDetails = array(
            'first_name' => $db->filter($_POST['first_name']),
            'last_name' => $db->filter($_POST['last_name']),
            'address_1' => $db->filter($_POST['address_1']),
            'address_2' => $db->filter($_POST['address_2']),
            'landmark' => $db->filter($_POST['landmark']),
            'country' => $db->filter($_POST['country']),
            'state' => $db->filter($_POST['state']),
            'city' => $db->filter($_POST['city']),
            'pincode' => $db->filter($_POST['pincode']),
            'phone' => $db->filter($_POST['phone'])
        );

        $where_clause = array(
            'id' => base64_decode($_POST['shippingId'])
        );

        $rs = $db->update(USER_ADDRESSES, $updateOrderDetails, $where_clause, 1);
        if($rs){
            return true;
        }else{
            return false;
        }

    }

    function updateBillingAddress(){

        $db = new DB();
        $updateOrderDetails = array(
            'first_name' => $db->filter($_POST['first_name']),
            'last_name' => $db->filter($_POST['last_name']),
            'address_1' => $db->filter($_POST['address_1']),
            'address_2' => $db->filter($_POST['address_2']),
            'landmark' => $db->filter($_POST['landmark']),
            'country' => $db->filter($_POST['country']),
            'state' => $db->filter($_POST['state']),
            'city' => $db->filter($_POST['city']),
            'pincode' => $db->filter($_POST['pincode']),
            'phone' => $db->filter($_POST['phone'])
        );

        $where_clause = array(
            'id' => base64_decode($_POST['billingId'])
        );

        $rs = $db->update(USER_ADDRESSES, $updateOrderDetails, $where_clause, 1);
        if($rs){
            return true;
        }else{
            return false;
        }

    }

    function saveNewReview(){

        $db = new DB();
        $review_date  = date('Y-m-d');
        $data = array(
                'product_id' => $db->filter($_POST['productId']),
                'nickname'=> $db->filter($_POST['nickname']),
                'summary_review ' => $db->filter($_POST['summary_review']),
                'review' => $db->filter($_POST['review']),
                'review_date' => $db->filter($review_date)
            );

        $insert = $db->insert(REVIEW, $data);

        if($insert){
            return ture;
        }else{
            return false;
        }
    }

    function emailtoservice($orderId){
         $db = new DB();

        $orderDetails = $db->get_row("SELECT id, userId, invoiceNumber, fullName, mobileNumber, email, shippingId, billingId, address, note, subTotal, deliveryCost, totalAmount, dateTime,offerAmt,couponDiscount FROM ".ORDER_DETAILS." WHERE id='".$orderId."'", true);
        
        $shippingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->shippingId."' ",true);
        $billingDetail = $db->get_row("SELECT * FROM ".USER_ADDRESSES." WHERE id = '".$orderDetails->billingId."' ",true);

        $records = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderDetails->id."'");
        

        ob_start();
        ?>


            <div class="col-md-12 paymentSteps">
                <table class="itemSummery">
                <thead>
                   <tr>
                        <th width="30%;" style="padding-bottom:30px;"><a href="<?=APP_URL?>"><img src="<?=APP_URL?>/images/logo-dark.png"></a></th>
                        <th width="70%;" style="padding-bottom:30px;"><h3 style="font-size:24px;text-align:center;margin:0px;"><a style="color:#000;text-decoration:none;" href="<?=APP_URL?>">desitemplehair.com</a></h3>
                                        <p style="font-size:14px;text-align:right;margin:10px 10px 0px 0px;">Invoice Number: # <?=$orderDetails->invoiceNumber?></p>
                                        <p style="font-size:14px;text-align:right;margin:0px 10px 0px 0px;">Invoice Date: # <?=date('j m Y H:i:s',strtotime($orderDetails->dateTime))?></p>
                        </th>
                   </tr>
                </thead>  
                    <?php if($orderDetails->note!=''){?>  
                        <tbody>
                            <tr><td colspan="2" width="100%;" valign="top">Note: <?=$orderDetails->note?> </td>  </tr>
                        </tbody>
                    <?php } ?>
                </table>
                <br/>
            <table class="itemSummery">
            <tbody><tr>
            <th style="background:#ddd;padding:5px;">Item</th>
            <th style="background:#ddd;padding:5px;">Description</th>
            <th style="background:#ddd;padding:5px;">Quantity</th>
            <th style="background:#ddd;padding:5px;">Unit Price</th>
            <th style="background:#ddd;padding:5px;">Total</th>
            </tr>
            <?
            foreach($records as $record){

                $productData = $db->get_row("SELECT id, productName FROM ".PRODUCTS." 
                                              WHERE id='".$record['productId']."'", true);

                $productImageData = $db->get_row("SELECT image FROM ".PRODUCT_IMAGES." 
                                              WHERE productId='".$record['productId']."'", true);

                $productOption = $db->get_row("SELECT id, productWeight, productUnit, productCost, productStock,productOffer FROM ".PRODUCT_OPTIONS." WHERE id='".$record['productOptionId']."'", true);
                $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES."  WHERE productOptionId='".$productOption->id."'", true);
                        $attrValueSet='';   
                            foreach ($productAttrubutes as $productAttrubute) {
                                $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." LEFT JOIN ".ATTRIBUTES." ON ( attribute_values.attributeId = attributes.id) WHERE attributes.active='1' AND attribute_values.active='1' AND attribute_values.id='".$productAttrubute->attributeValueId."'", true);
                                if(count($attrValues)>0){ $attrValueSet .= ' '.$attrValues->attributeValue.','; }
                            }
                if((isset($productOption->productOffer)) && ($productOption->productOffer!='') && ($productOption->productOffer > 0) && (count($productOption->productOffer)>0)){
                    $offerPrice = round(($productOption->productOffer*$productOption->productCost)/100);
                    if($offerPrice < 1){
                        $offerPrice = 1;
                    }
                    $productOption->productCost = number_format(($productOption->productCost - $offerPrice),2);
                    $productTotal = $record['quantity']*$productOption->productCost;
                    $totalItems+= $record['quantity'];
                    $subTotal+=$productTotal;
                }else{
                    $productTotal = $record['quantity']*$productOption->productCost;
                    $totalItems+= $record['quantity'];
                    $subTotal+=$productTotal;
                }
            ?>

            <tr>
            <td style="border-bottom: 1px solid #ddd;">
                 <? if(isset($productImageData->image) && $productImageData->image!=''){ ?>
            
                    <img src="<?=PRODUCT_CART_PATH?>/<?=$productImageData->image?>"  title="Beauty-Mineral - <?=$record['productName']?>" alt="Desi temple hair">
                
                <? }else{ ?>

                    <img src="<?=PRODUCT_CART_PATH?>/defaultsmall.png" class="center-block" title="Desi temple hair" alt="Desi temple hair">
            
                <? } ?>

                </td>
                <td style="border-bottom: 1px solid #ddd;"><?=$productData->productName?> <p style="font-size: 13px;"><?php if($attrValueSet !=''){ echo rtrim($attrValueSet,','); } ?></p></td>
                <td style="border-bottom: 1px solid #ddd;"><?=$record['quantity']?></td>
                <td style="border-bottom: 1px solid #ddd;"> &#36; <?=number_format($productOption->productCost,2)?></td>
                <td style="border-bottom: 1px solid #ddd;"> &#36; <?=number_format($productTotal,2)?></td>
            </tr>
            
            <? } ?>

            </tbody>

            <tfoot>
            <tr>
                <td colspan="5" align="right" style="border-bottom: 1px solid #ddd;">
                    <p class="textright">Sub total : &#36; <?=number_format($orderDetails->subTotal, 2)?></p>
                    <p>Shipping<span> &#36; <?=number_format($orderDetails->deliveryCost,2)?></span></p>
                    <!-- <p class="textright">Delivery Charge : &#36; <?=number_format($orderDetails->deliveryCost, 2)?></p> -->
                    <?php $totalPay = $orderDetails->totalAmount; ?>
                    <?php if($orderDetails->couponDiscount > 0){?>
                    <p class="textright">Coupon Discount : &#36; <?=number_format($orderDetails->couponDiscount,2)?></p>
                    <?php 
                        $totalPay = $totalPay - $orderDetails->couponDiscount;
                   } ?>
                    <?php if($orderDetails->offerAmt > 0){?>
                    <p class="textright">Discount : &#36; <?=number_format($orderDetails->offerAmt,2)?></p>
                    <?php 
                    $totalPay = $totalPay - $orderDetails->offerAmt;
                    } ?>
                    <?php 
                       if($totalPay < 0){
                           $totalPay = 0;
                        }
                     ?> 
                    <p class="grandtiotal">
                      Grand Total :  <span> &#36; <?=number_format($totalPay, 2)?></span>
                    </p>
                </td>
            </tr>

            </tfoot>
        </table>

            <p>Thank You for your business with DesiTempleHair, your order is being processed and will be shipped within 7 business days.</p>
            <p>If you have any questions, Please feel free to contact us at - <a href="mailto:support@desitemplehair.com">support@desitemplehair.com</a> </p>  

            <div style="clear:both;width:100%;"></div>
            <div class="separator"></div>
            </div>
        <?

        $contents = ob_get_flush();

        $msg="";
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->From = 'support@desitemplehair.com';
        $mail->FromName = 'desitemplehair.com';
        $mail->AddAddress($orderDetails->email);
        $mail->AddBCC('santhosh@evol.co.in');
             
        $mail->Subject = 'desitemplehair.com: New Order - Order Ref Number :'.$orderDetails->invoiceNumber;      

        $msg.=$contents.'<br><br>';

        $mail->Body  =$msg;                    
        $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
        $mail->Send();

        return true;
    }

    function getTotalByInvoice($id){
        $db = new db();
        $order_qry = "SELECT totalAmount,subTotal,deliveryCost,invoiceNumber FROM ".ORDER_DETAILS." WHERE id = '".$db->filter($id)."'";
        return $db->get_row($order_qry,true);
    }
    function getInvoiceOrderItems($orderId){
        $db = new db();
       
        $results = $db->get_results("SELECT * FROM ".ORDER_ITEMS." WHERE orderId='".$orderId."' AND active = '1'");
        foreach ($results as $row) {
            $productAttrubutes = $db->get_results("SELECT attributeValueId FROM ".PRODUCT_ATTRIBUTES." WHERE productOptionId='".$row['productOptionId']."'", true);
            $attrValueSet='';   
            foreach ($productAttrubutes as $productAttrubute) {
                $attrValues = $db->get_row("SELECT attributeValue FROM ".ATTRIBUTE_VALUES." WHERE id='".$productAttrubute->attributeValueId."'", true);
                $attrValueSet .= ' '.$attrValues->attributeValue.',';
            }
            
           
            $row['attr']=rtrim($attrValueSet,',');
            $records[]=$row;
        }
        return $records;
    }

}