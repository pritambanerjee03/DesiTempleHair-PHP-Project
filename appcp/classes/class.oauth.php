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
			$_SESSION['adminId'] = $this->authAdminId;
			$_SESSION['accessLevel'] = $this->authAccessLevel;
			return $_SESSION['adminId'];
		}
	} 
	
	
	function getUsername(){
		//$this->validate = new validate();
		if(isset($_POST['email']) && $_POST['email']!='')
			return $user = $_POST['email'];
		else
			return false;
	}
	
	function getPassword() {
		return $passwd = $_POST['password'];
	}
	
	
	
	function authenticate_user(){
		$db = new DB();

		$email = $this->getUsername();
		$password = $this->getPassword();

		$query = "SELECT * FROM admin_users WHERE email = '".$email."' AND password = '".$password."'";
		
		if($db->num_rows( $query ) > 0 ){
		    $authUser = $db->get_row( $query, true );		
			$this->authAdminId =   $authUser->id;
			$this->authFullName =  $authUser->fullName;
			$this->authAccessLevel =  $authUser->accessLevel;
			return true;
		}else{
		   return false;
		}

		
	}
	
	function authUser(){
		if(isset($_SESSION['adminId']) && $_SESSION['adminId']!=''){
			return $_SESSION['adminId'];
		}
	}
	function authAccessLevel(){
		if(isset($_SESSION['accessLevel']) && $_SESSION['accessLevel']!=''){
			return $_SESSION['accessLevel'];
		}
	}
	function logoutUser(){
		session_unset();
		session_destroy();
	}
	
}