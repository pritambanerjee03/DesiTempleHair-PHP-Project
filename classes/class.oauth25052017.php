<?php
if(!isset($_SESSION))
	session_start();

class oauth {
	var $userId;
	
	function oauth()
	{
		
	}
	
	function logUserIn(){
		//Register The session
		if($this->authenticate_user())
		{
			$_SESSION['fullName'] = $this->authFullName;
			$_SESSION['regId'] = $this->authAdminId;
			$_SESSION['email'] = $this->email;
			$year = time() + 31536000;
			// setcookie('regId', base64_encode($_SESSION['regId']), $year);
			return $_SESSION['regId'];
		}
	} 
	
	
	function getUsername(){
		$db = new DB();
		//$this->validate = new validate();
		if(isset($_POST['email']) && $_POST['email']!='')
			return $user = $db->filter($_POST['email']);
		else
			return false;
	}
	
	function getPassword() {
		$db = new DB();
		return $passwd = $db->filter($_POST['password']);
	}
	
	
	
	function authenticate_user(){
		$db = new DB();

		$email = $this->getUsername();
		$password = $this->getPassword();

		$query = "SELECT * FROM ".REGISTERED_USER." WHERE email = '".$email."' AND password = '".$password."' AND active='1'";
		if($db->num_rows($query) > 0 ){
		    $authUser = $db->get_row($query, true);		
			$this->authAdminId =   $authUser->id;
			$this->authFullName =  $authUser->fullName;
			$this->email =  $authUser->email;
			$this->mobileNumber =  $authUser->mobileNumber;
			return true;
		}else{
		   return false;
		}

		
	}
	
	function authUser(){
		// if(isset($_COOKIE["regId"]) && $_COOKIE["regId"]!=''){
		// 	$_SESSION['regId'] = base64_decode($_COOKIE["regId"]);
		// }
		if(isset($_SESSION['regId']) && $_SESSION['regId']!=''){
			return $_SESSION['regId'];
		}
	}
	
	function logoutUser(){
		setcookie("regId", "", time()-3600);
		session_unset();
		session_destroy();
	}
	function registerUser(){
		$db = new DB();
		date_default_timezone_set("Asia/Calcutta");
        $dateTime  = date('Y-m-d H:i:s', time());
		$registerExits = $db->get_row("SELECT id,mobileNumber FROM ".REGISTERED_USER." WHERE email = '".$db->filter($_POST['email'])."'",true);
        if($registerExits){
        	return 'alredyRegistred';
        	exit;
        }else{
// echo "SELECT id FROM ".USERS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."'";
        	// $userExits = $db->get_row("SELECT id FROM ".USERS." WHERE mobileNumber = '".$db->filter($_POST['mobileNumber'])."'",true);
        	// pre($userExits);
        	// exit;
        	// if($userExits){
        	// 	$userId = $userExits->id;
	        // }else{
	        $data = array(
	            'fullName' => $db->filter($_POST['fullName']),
	            'email' => $db->filter($_POST['email']),
	            'password' => $db->filter($_POST['password']),
	            'mobileNumber' => $db->filter($_POST['mobileNumber']),
	            'dateTime' => $dateTime
                );
              
			$rs = $db->insert(USERS, $data);
			$userId = $db->lastid();
	        // }	

	       	$regData = array(
	            'fullName' => $db->filter($_POST['fullName']),
	            'email' => $db->filter($_POST['email']),
	            'password' => $db->filter($_POST['password']),
	            'mobileNumber' => $db->filter($_POST['mobileNumber']),
	            'dateTime' => $dateTime,
	            'userId' => $userId
                );

	         $rs = $db->insert(REGISTERED_USER, $regData);
	        	$msg="";
		        $mail = new PHPMailer();
		        $mail->IsHTML(true);
		        $mail->From = 'contact@beautymineral.in';
		        $mail->FromName = 'Beautymineral.in';
		        $mail->AddAddress($db->filter($_POST['email']));
		        $mail->AddBcc('santhosh@evol.co.in');
		        	             
		        $mail->Subject = 'beautymineral.in: Registering Confirmation';      
		        $contents = "Dear ".$db->filter($_POST['fullName']).", <br/> Thank you for registering at <a href='http://beautymineral.in'>beautymineral.in</a>. This email confirms that you have registred to beautymineral.in <br/> If you have not registred with beautymineral.in please contact us.";
		        $msg.=$contents.'<br><br>';

		        $mail->Body  =$msg;                    
		        $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
		        $mail->Send();
	        return true;
        }
        return false;
	}

	function changePassword(){
		$db = new DB();
		$regId = $this->authUser();
		$rowExits = $db->get_row("SELECT id,userId FROM ".REGISTERED_USER." WHERE id = '".$regId."' AND password ='".$db->filter($_POST['oldpassword'])."'",true);
        if($rowExits){
            $data = array(
	            'password' => $db->filter($_POST['newpassword']),
	            );
                
	        $where_clause = array(
	            'id' => $rowExits->id
	        );

        	$updated = $db->update(REGISTERED_USER, $data, $where_clause, 1 );
	        	if($updated ){
			        	$data = array(
				            'password' => $db->filter($_POST['newpassword']),
				            );
			                
				        $where_clause = array(
				            'id' => $rowExits->userId
				        );

			        	$updated = $db->update(USERS, $data, $where_clause, 1 );
			    }    	
            return true;
            exit;
        }else{
        	return false;
        	exit;
        }
	}

	function forgotpassword(){
		$db = new DB();
		$rowExits = $db->get_row("SELECT id,userId FROM ".REGISTERED_USER." WHERE email = '".$db->filter($_POST['email'])."' ",true);
        if($rowExits){
        	$password = randomPassword();
        	$data = array(
	            'password' => $password,
	            );
                
	        $where_clause = array(
	            'id' => $rowExits->id
	        );

        	$updated = $db->update(REGISTERED_USER, $data, $where_clause, 1 );
        	if($updated){
        			$data = array(
			            'password' => $password,
			            );
		                
			        $where_clause = array(
			            'id' => $rowExits->userId
			        );

		        	$updated = $db->update(USERS, $data, $where_clause, 1 );


	        	$msg="";
		        $mail = new PHPMailer();
		        $mail->IsHTML(true);
		        $mail->From = 'contact@beautymineral.in';
		        $mail->FromName = 'beautymineral.in';
		        $mail->AddAddress($db->filter($_POST['email']));
		        	             
		        $mail->Subject = 'beautymineral.in: New Password';      
		        $contents = "Password : ".$password;
		        $msg.=$contents.'<br><br>';

		        $mail->Body  =$msg;                    
		        $mail->AltBody   = "To view the message, please use an HTML compatible email viewer!";         
		        $mail->Send();

		        return true;
	    	}
        }else{
        	return false;
        }	
        
	}	

	function getUserDetails(){
		$db = new DB();
		$regId = $this->authUser();
		return $rowExits = $db->get_row("SELECT * FROM ".REGISTERED_USER." WHERE id = '".$regId."' ",true);
   	}

	function getLastOrderAddress($userId){
		$db = new DB();
		return $db->get_row("SELECT address FROM ".ORDER_DETAILS." WHERE userId = '".$userId."' ORDER BY id DESC",true);
	}

	function checkoutLogin(){
		//Register The session
		if($this->authenticate_user())
		{
			$_SESSION['fullName'] = $this->authFullName;
			$_SESSION['regId'] = $this->authAdminId;
			echo '{"msg":"success","fullName":"'.$this->authFullName.'","email":"'.$this->email.'","mobileNumber":"'.$this->mobileNumber.'"}';
		}else{
			echo '{"msg":"fail"}';
		}
	} 
	function updateUserDetails(){
		$db = new DB();
		$data = array(
	            'fullName' => $db->filter($_POST['fullName']),
	            'mobileNumber' => $db->filter($_POST['mobileNumber'])
	            );
                
	        $where_clause = array(
	            'id' => $db->filter($_POST['regid'])
	        );

		$updated = $db->update(REGISTERED_USER, $data, $where_clause, 1 );

		$data = array(
	            'fullName' => $db->filter($_POST['fullName']),
	            'mobileNumber' => $db->filter($_POST['mobileNumber'])
	            );
                
	        $where_clause = array(
	            'id' => $db->filter($_POST['regid'])
	        );

		$updated = $db->update(USERS, $data, $where_clause, 1 );

		if($updated){
			return true;
		}else{
			return false;
		}
	}
	function checkoutLogout(){
		session_unset();
		session_destroy();
		echo 'success';
	}

	function registrationEmailCheck(){
		$db = new DB();
		$email = $db->filter($_POST['email']);
		$numRowCount =  $db->num_rows("SELECT * FROM ".REGISTERED_USER." WHERE email = '".$email."' ");
		if($numRowCount > 0){
			echo "emailexits";
		}else{
			echo "";
		}
	}

	function notifyUsers(){
		$db = new DB();
		$regId = $this->authUser();

		date_default_timezone_set("Asia/Calcutta");
        $dateTime  = date('Y-m-d H:i:s', time());
        if(preg_match('/^\d{10}$/',$_POST['notifyNumber'])) // phone number is valid
		{	
			if($db->num_rows("SELECT id FROM ".NOTIFY_USERS." WHERE mobileNumber = '".$db->filter($_POST['notifyNumber'])."' AND productId ='".$db->filter($_POST['notifyProductId'])."' AND active ='1'")>0){
				echo "alreadynotified";
				exit;
			}
			if(isset($regId) && $regId!=''){
	        	$data = array(
			        'mobileNumber' => $db->filter($_POST['notifyNumber']),
			        'productId' => $db->filter($_POST['notifyProductId']),
			        'dateTime' => $dateTime,
			        'regId' => $regId
	        	);
	        }else{
	        	$data = array(
			        'mobileNumber' => $db->filter($_POST['notifyNumber']),
			        'productId' => $db->filter($_POST['notifyProductId']),
			        'dateTime' => $dateTime
	       		 );
	        }
			$rs = $db->insert(NOTIFY_USERS, $data);
			if($rs){
				echo "success";
			}else{
				echo "fail";
			}
		}else{
			echo "invalidphone";
		}	
	}
	
}