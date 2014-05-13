<?php

class User extends CW_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function getGeneralFeedback(){
		
		$this->load->view('pages/user/feedback/general_feedback');
	}

}