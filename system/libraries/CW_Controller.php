<?php
class CW_Controller extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->refreshSessionByCookie();
	}
	
	
	public function refreshSessionByCookie(){
		@session_start;
		if ( !isset($_SESSION['user']) ){
			if ( isset($_COOKIE['user']) ){
				$_SESSION['user'] = $_COOKIE['user'];
				$_SESSION['name'] = $_COOKIE['name'];
				$_SESSION['email'] = $_COOKIE['email'];
				$_SESSION['id_users'] = $_COOKIE['id_users'];
				$_SESSION['status'] = $_COOKIE['status'];
				$_SESSION['img'] = $_COOKIE['img'];
			}
		}	
	}
}

?>