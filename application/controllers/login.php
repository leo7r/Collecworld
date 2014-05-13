<?php

class Login extends CW_Controller {

	function __construct(){
		parent::__construct();
	}

	public function view( ){
		
		$this->landingPageVerification();
		$data['title'] = 'Login / Sign up';
		
		if ( isset($_SESSION['user']) ){
			header('Location: '.base_url().'init');
		}
		
		$this->load->model('phonecard_model');
		//$data['countries'] = $this->phonecard_model->get_countries();

		$this->load->view('templates/header', $data);
		$this->load->view('pages/login', $data);
		$this->load->view('templates/footer', $data);
	}
}

?>