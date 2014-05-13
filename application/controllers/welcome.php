<?php

class Welcome extends CW_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	/* Funcion para mostrar el landing page */
	public function view(){

		$user = $this->input->post('user');
		$pass = $this->input->post('pass');

		if ( strcmp($user,'antonio') == 0 and strcmp($pass,'antonio') == 0 ){

			@session_start();
			$_SESSION['init'] = $user;
			setcookie("init", $user, time()+(3600*10));
			header("Location: ".base_url().'init');	
		}
		else{
			if ( ! file_exists('application/views/pages/welcome.php')){
				show_404();
			}
			
			$data['title'] = 'Collecworld';
			$this->load->view('pages/welcome.php', $data);
		}
	}

}